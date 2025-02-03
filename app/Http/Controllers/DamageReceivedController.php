<?php

namespace App\Http\Controllers;

use App\Models\DamageReceived;
use App\Models\Shops;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DamageReceivedController extends Controller
{
    public function index()
    {
        $title = "Damage Received";
        $damage_receiveds = DamageReceived::all();
        return view('admin.damage-received.index',compact('damage_receiveds','title'));
    }

    public function create()
    {
        $title = "Damage Received";
        $shops = Shops::where('is_visible',1)->get();
        return view('admin.damage-received.create',compact('title','shops'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required',
            'shop_id' => 'required|exists:shops,id',
            'recived_value' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }
        $damage_received = new DamageReceived();
        $damage_received->date = format_date_for_db($request->date);
        $damage_received->shop_id = $request->shop_id;
        $damage_received->recived_value = $request->recived_value;
        $damage_received->remarks = $request->remarks;
        $res = $damage_received->save();

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
        $title = "Damage Received";
        $damage_received = DamageReceived::findOrFail($id);
        $shops = Shops::where('is_visible',1)->get();
        return view('admin.damage-received.edit',compact('damage_received','title','shops'));
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required',
            'shop_id' => 'required|exists:shops,id',
            'recived_value' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }
        $damage_received = DamageReceived::findOrFail($id);
        $damage_received->date = format_date_for_db($request->date);
        $damage_received->shop_id = $request->shop_id;
        $damage_received->recived_value = $request->recived_value;
        $damage_received->remarks = $request->remarks;
        $res = $damage_received->update();

        if($res){
            return back()->with(['success'=>'Data Updated Successfully.']);
        }else{
            return back()->with(['error'=>'Data Not Updated.']);
        }
    }

    public function destroy(string $id)
    {
        $damage_received = DamageReceived::findOrFail($id);
        $res = $damage_received->delete();
        if($res){
            return back()->with(['success'=>'Data Deleted Successfully.']);
        }else{
            return back()->with(['error'=>'Data Not Deleted.']);
        }
    }
}
