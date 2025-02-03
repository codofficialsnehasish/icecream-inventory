<?php

namespace App\Http\Controllers;

use App\Models\ExpenceCategory;
use Illuminate\Http\Request;

class ExpenceCategoryController extends Controller
{
    public function __construct(){
        $this->view_path = 'admin.expence_categorys.';
    }

    public function index()
    {
        $data['title'] = 'Expence Category';
        $data['expence_categorys'] = ExpenceCategory::all();
        return view($this->view_path.'index')->with($data);
    }

    public function create()
    {
        $data['title'] = 'Expence Category';
        return view($this->view_path.'create')->with($data);
    }

    public function store(Request $request)
    {
        $expence_category = new ExpenceCategory();
        $expence_category->name = $request->name;
        $expence_category->is_visible = $request->is_visible;
        $res = $expence_category->save();

        if($res){
            return redirect()->back()->with(['success'=>'Data Added Successfully']);
        }else{
            return redirect()->back()->with(['error'=>'Data Not Added']);
        }
    }

    public function show(ExpenceCategory $expenceCategory)
    {
        
    }

    public function edit(string $id)
    {
        $data['title'] = 'Expence Category';
        $data['expence_category'] = ExpenceCategory::find($id);
        return view($this->view_path.'edit')->with($data);
    }

    public function update(Request $request, string $id)
    {
        $expence_category = ExpenceCategory::find($id);
        $expence_category->name = $request->name;
        $expence_category->is_visible = $request->is_visible;
        $res = $expence_category->update();

        if($res){
            return redirect()->back()->with(['success'=>'Data Updated Successfully']);
        }else{
            return redirect()->back()->with(['error'=>'Data Not Updated']);
        }
    }

    public function destroy(string $id)
    {
        $expence_category = ExpenceCategory::find($id);
        $res = $expence_category->delete();
        if($res){
            return back()->with(['success'=>'Data Deleted Successfully.']);
        }else{
            return back()->with(['error'=>'Data Not Deleted.']);
        }
    }
}
