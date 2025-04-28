<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Expence;
use App\Models\Trucks;
use App\Models\Salesman;
use App\Models\ExpenceCategory;

class ExpencesController extends Controller
{
    public function __construct(){
        $this->middleware('role_or_permission:All Expences', ['only' => ['index']]);
        $this->middleware('role_or_permission:Expence Report', ['only' => ['generate_expence_report']]);
    }

    public function index()
    {
        $title = "Expences";

        $expences = Expence::all();
        $trucks = Trucks::all();
        $salesmans = Salesman::all();
        $expence_categorys = ExpenceCategory::all();

        return view('admin.expences.index',compact('expences','trucks','salesmans','title','expence_categorys'));
    }

    public function generate_expence_report(Request $request){

        // return $request->all();
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        $expences = Expence::query()
                            ->when(!empty($request->salesmen_id), function ($query) use ($request) {
                                $query->where('salesmen_id', $request->salesmen_id);
                            })
                            ->when(!empty($request->trucks_id), function ($query) use ($request) {
                                $query->where('trucks_id', $request->trucks_id);
                            })
                            ->when(!empty($startDate) && !empty($endDate), function ($query) use ($startDate, $endDate) {
                                $query->whereDate('created_at', '>=', $startDate)
                                    ->whereDate('created_at', '<=', $endDate);
                            })
                            ->when(!empty($request->expence_category_id), function ($query) use ($request) {
                                $query->where('expence_category_id', $request->expence_category_id);
                            })
                            ->get();


        $title = "Expences";

        // $expences = Expence::all();
        $trucks = Trucks::all();
        $salesmans = Salesman::all();
        $expence_categorys = ExpenceCategory::all();

        return view('admin.expences.index',compact('expences','trucks','salesmans','title','expence_categorys'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
