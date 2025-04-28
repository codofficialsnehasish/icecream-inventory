<?php

namespace App\Http\Controllers;

use App\Models\DamagePaid;
use App\Models\Shops;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DamagePaidController extends Controller
{
    public function __construct(){
        $this->middleware('role_or_permission:Damage Paid Show', ['only' => ['index','show']]);
        $this->middleware('role_or_permission:Damage Paid Create', ['only' => ['create','store']]);
        $this->middleware('role_or_permission:Damage Paid Edit', ['only' => ['edit','update']]);
        $this->middleware('role_or_permission:Damage Paid Delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $title = "Damage Paid";
        $damage_paid = DamagePaid::all();
        return view('admin.damage-paid.index',compact('damage_paid','title'));
    }

    public function create()
    {
        $title = "Damage Paid";
        $shops = Shops::where('is_visible',1)->get();
        return view('admin.damage-paid.create',compact('title','shops'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required',
            'shop_id' => 'required|exists:shops,id',
            'paid_value' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }
        $damage_paid = new DamagePaid();
        $damage_paid->date = format_date_for_db($request->date);
        $damage_paid->shop_id = $request->shop_id;
        $damage_paid->paid_value = $request->paid_value;
        $damage_paid->remarks = $request->remarks;
        $res = $damage_paid->save();

        if($res){
            return back()->with(['success'=>'Data Saved Successfully.']);
        }else{
            return back()->with(['error'=>'Data Not Saved.']);
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $title = "Damage Paid";
        $damage_paid = DamagePaid::findOrFail($id);
        $shops = Shops::where('is_visible',1)->get();
        return view('admin.damage-paid.edit',compact('damage_paid','title','shops'));
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required',
            'shop_id' => 'required|exists:shops,id',
            'paid_value' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }
        $damage_paid = DamagePaid::findOrFail($id);
        $damage_paid->date = format_date_for_db($request->date);
        $damage_paid->shop_id = $request->shop_id;
        $damage_paid->paid_value = $request->paid_value;
        $damage_paid->remarks = $request->remarks;
        $res = $damage_paid->update();

        if($res){
            return back()->with(['success'=>'Data Updated Successfully.']);
        }else{
            return back()->with(['error'=>'Data Not Updated.']);
        }
    }

    public function destroy(string $id)
    {
        $damage_paid = DamagePaid::findOrFail($id);
        $res = $damage_paid->delete();
        if($res){
            return back()->with(['success'=>'Data Deleted Successfully.']);
        }else{
            return back()->with(['error'=>'Data Not Deleted.']);
        }
    }
}
