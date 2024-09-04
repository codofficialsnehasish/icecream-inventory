<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

use App\Models\Shops;
use Illuminate\Http\Request;

class ShopsController extends Controller
{
    public function __construct(){
        $this->view_path = 'admin.shops.';
    }

    public function index()
    {
        $data['title'] = 'Shops';
        $data['shops'] = Shops::all();
        return view($this->view_path.'index')->with($data);
    }

    public function create()
    {
        $data['title'] = 'Shops';
        return view($this->view_path.'create')->with($data);
    }

    public function store(Request $request)
    {
        // return $request;
        $validator = Validator::make($request->all(), [
            'shop_name' => 'required|string|max:255',
            'owner_name' => 'required|string|max:255',
            'whatsapp_number' => 'required|digits:10|regex:/^[6789]/',
            'address' => 'required|string'
        ]);
        if ($request->is('api/*') && $validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }elseif($validator->fails()){
            return $request;
            return redirect()->back()->withErrors($validator->errors());
        }
        
        $shop = new Shops();
        $shop->shop_name = $request->shop_name;
        $shop->owner_name = $request->owner_name;
        $shop->whatsapp_number = $request->whatsapp_number;
        $shop->address = $request->address;
        $shop->freezer = $request->freezer;
        $shop->freezer_capacity = $request->freezer_capacity;
        $shop->freezer_serial_number = $request->freezer_serial_number;
        if($request->is('api/*')){
            $shop->is_visible = 1;
        }else{
            $shop->is_visible = $request->is_visible;
        }
        $res = $shop->save();

        if($res){
            if($request->is('api/*')){
                return response()->json([
                    'status'=>'true',
                    'massage'=>'Shop added successfully',
                    'data'=>$shop
                ]);
            }else{
                return redirect()->back()->with(['success'=>'Data Added Successfully']);
            }
        }else{
            if($request->is('api/*')){
                return response()->json([
                    'status'=>'false',
                    'massage'=>'Shop not added'
                ]);
            }else{
                return redirect()->back()->with(['error'=>'Data Not Added']);
            }
        }
    }

    public function show(shops $shops)
    {
        //
    }

    public function edit(string $id)
    {
        $data['title'] = 'Shops';
        $data['shop'] = Shops::find($id);
        return view($this->view_path.'edit')->with($data);
    }

    public function update(Request $request, string $id)
    {
        $shop = Shops::find($id);
        $shop->shop_name = $request->shop_name;
        $shop->owner_name = $request->owner_name;
        $shop->whatsapp_number = $request->whatsapp_number;
        $shop->address = $request->address;
        $shop->freezer = $request->freezer;
        $shop->freezer_capacity = $request->freezer_capacity;
        $shop->freezer_serial_number = $request->freezer_serial_number;
        $shop->is_visible = $request->is_visible;
        $res = $shop->update();

        if($res){
            return redirect()->back()->with(['success'=>'Data Updated Successfully']);
        }else{
            return redirect()->back()->with(['error'=>'Data Not Updated']);
        }
    }

    public function destroy(string $id)
    {
        $shop = Shops::find($id);
        $res = $shop->delete();
        if($res){
            return back()->with(['success'=>'Data Deleted Successfully.']);
        }else{
            return back()->with(['error'=>'Data Not Deleted.']);
        }
    }
}
