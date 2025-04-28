<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\DailySales;
use App\Models\AssignedProducts;

class CategoryAPI extends Controller
{
    public function index(Request $request){
        $dailysales_id = DailySales::where('outing_date', date('Y-m-d'))
                        ->where('salesman_id', $request->user()->id)
                        ->latest('created_at') // Order by the latest 'created_at' timestamp
                        ->value('id');
                        
        if(!empty($dailysales_id)){
            $assign_products_json = AssignedProducts::where('daily_sales',$dailysales_id)->value('products');
            $assign_products = json_decode($assign_products_json, true);
            $category_ids = array_column($assign_products, 'category');
            $category = Category::whereIn('id', $category_ids)
                                ->get();
            return response()->json([
                'status' => 'true',
                'data' => $category
            ]);
        }else{
            return response()->json([
                'status' => 'false',
                'massage'=> 'Not have any sales for today. ThankYou !'
            ]);
        }
    }
    
}