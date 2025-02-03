<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

use App\Models\ExpenceCategory;
use App\Models\Expence;
use App\Models\DailySales;

class ExpenceAPI extends Controller
{
    public function expence_category(){
        $ExpenceCategory = ExpenceCategory::where('is_visible',1)->get();

        return response()->json([
            'status' => 'true',
            'data'=> $ExpenceCategory
        ]);
    }

    public function process_expence(Request $request){
        if (!is_array($request->input('expence_id'))) {
            return response()->json(["status"=>"false",'message' => 'The expense IDs must be provided as an array.'], 422);
        }
        if (!is_array($request->input('expence_amount'))) {
            return response()->json(["status"=>"false",'message' => 'The expence amount must be provided as an array.'], 422);
        }
        $validator = Validator::make($request->all(), [
            'expence_id' => ['required', 'array', 'min:1'], // Ensure 'expence_id' is an array with at least one element
            'expence_id.*' => ['exists:expence_categories,id'], // Validate each item in the array exists in the database
            'expence_amount' => ['required', 'array', 'min:1'], // Ensure 'expence_amount' is also an array
            'expence_amount.*' => ['numeric'], // Validate each item in the 'expence_amount' array is numeric
        ], [
            'expence_id.required' => 'The expense IDs are required.',
            'expence_id.array' => 'The expense IDs must be provided as an array.',
            'expence_id.min' => 'The expense IDs must contain at least one item.',
            'expence_id.*.exists' => 'This expense ID not avaliable in database. Please check and try again.',
            'expence_amount.required' => 'The expense amounts are required.',
            'expence_amount.array' => 'The expense amounts must be provided as an array.',
            'expence_amount.min' => 'The expense amounts must contain at least one item.',
            'expence_amount.*.numeric' => 'Each expense amount must be a valid number.',
        ]);
    
        // Custom validation for equal lengths
        $validator->after(function ($validator) use ($request) {
            if (count($request->input('expence_id', [])) !== count($request->input('expence_amount', []))) {
                $validator->errors()->add('expence_amount', 'The number of expense amounts must match the number of expense IDs.');
            }
        });
    
        if ($validator->fails()) {
            return response()->json(["status" => "false",'errors' => $validator->errors()], 422);
        }
    
        $daily_sales = DailySales::where('salesman_id',$request->user()->id)
                                ->where('outing_date',date('Y-m-d'))
                                ->latest()
                                ->first();

        if (!$daily_sales) { 
            return response()->json([
                'status' => 'false',
                'massage'=> 'Not have any sales for today. ThankYou !'
            ]); 
        }

        try{
            foreach ($request->expence_id as $key => $id) {
                $expence = new Expence();
                $expence->expence_category_id = $request->expence_id[$key];
                $expence->salesmen_id = $request->user()->id;
                $expence->trucks_id = $daily_sales->truck_id;
                $expence->amount = $request->expence_amount[$key];
                $expence->save();
            }
            return response()->json([
                'status' => 'true',
                'massage'=> 'Expence Seved successfully'
            ]);
        }catch(QueryException $e){
            return response()->json([
                'status' => 'false',
                'message' => 'A database error occurred.',
                'error' => $e->getMessage(),
            ], 500);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'false',
                'message' => 'An error occurred while saving expenses.',
                'error' => $e->getMessage(),
            ], 500);
        }
        
    }

    public function get_expences(Request $request){
        $daily_sales = DailySales::where('salesman_id',$request->user()->id)
                                ->where('outing_date',date('Y-m-d'))
                                ->latest()
                                ->first();

        $expences = Expence::leftJoin('expence_categories','expences.expence_category_id','expence_categories.id')
                            ->where('expences.salesmen_id',$request->user()->id)
                            ->where('expences.trucks_id',$daily_sales->truck_id)
                            ->whereDate('expences.created_at',date('Y-m-d'))
                            ->get(['expences.*','expence_categories.name as expence_categories_name']);
        
        $total_expence = Expence::where('salesmen_id',$request->user()->id)
                                ->where('trucks_id',$daily_sales->truck_id)
                                ->whereDate('created_at',date('Y-m-d'))
                                ->sum('amount');

        return response()->json([
            'status' => 'true',
            'total_expence' => $total_expence,
            'data'=> $expences
        ]);
    }

    public function delete_expence(Request $request){
        $validator = Validator::make($request->all(), [
            'expence_id' => 'required|numeric|exists:expences,id',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $expence = Expence::find($request->expence_id);
        $res = $expence->delete();

        if($res){
            return response()->json([
                'status' => 'true',
                'massage'=> 'Deleted Successfully'
            ]);
        }else{
            return response()->json([
                'status' => 'false',
                'massage'=> 'Not Deleted'
            ]);
        }
    }
}