<?php

namespace App\Http\Controllers;

use App\Models\Accounts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AccountsController extends Controller
{
    public function __construct(){
        $this->view_path = "admin.accounts.";
    }

    public function index()
    {
        $data['title'] = 'Accounts 1';
        $data['accounts'] = Accounts::all();
        return view($this->view_path.'index')->with($data);
    }

    public function create()
    {
        $data['title'] = 'Accounts 1';
        return view($this->view_path.'create')->with($data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bill_date' => 'required',
            'bill_type' => 'required',
            'bill_number' => 'required',
            'total_bill_amount' => 'required',
            'bill_paid_moment' => 'required',
            'bill_paid_amount' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }
        $acc = new Accounts();
        $acc->date = format_date_for_db($request->bill_date);
        $acc->bill_type = $request->bill_type;
        $acc->bill_no = $request->bill_number;
        $acc->bill_amount = $request->total_bill_amount;
        $acc->bill_pay_type = $request->bill_paid_moment;
        $acc->bill_pay_amount = $request->bill_paid_amount;
        $acc->extra_recived_value = $request->extra_value;
        $acc->sortage_value = $request->sortage_value;
        $acc->free_goods_recived_value = $request->free_goods_recived_value;
        $acc->remarks = $request->remarks;
        $res = $acc->save();

        if($res){
            return back()->with(['success'=>'Data Saved Successfully.']);
        }else{
            return back()->with(['error'=>'Data Not Saved.']);
        }
    }

    public function show(Accounts $accounts)
    {
        //
    }

    public function edit(string $id)
    {
        $data['title'] = 'Accounts 1';
        $data['account'] = Accounts::find($id);
        return view($this->view_path.'edit')->with($data);
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'bill_date' => 'required',
            'bill_type' => 'required',
            'bill_number' => 'required',
            'total_bill_amount' => 'required',
            'bill_paid_moment' => 'required',
            'bill_paid_amount' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }
        $acc = Accounts::find($id);
        $acc->date = format_date_for_db($request->bill_date);
        $acc->bill_type = $request->bill_type;
        $acc->bill_no = $request->bill_number;
        $acc->bill_amount = $request->total_bill_amount;
        $acc->bill_pay_type = $request->bill_paid_moment;
        $acc->bill_pay_amount = $request->bill_paid_amount;
        $acc->extra_recived_value = $request->extra_value;
        $acc->sortage_value = $request->sortage_value;
        $acc->free_goods_recived_value = $request->free_goods_recived_value;
        $acc->remarks = $request->remarks;
        $res = $acc->update();

        if($res){
            return back()->with(['success'=>'Data Updated Successfully.']);
        }else{
            return back()->with(['error'=>'Data Not Updated.']);
        }
    }

    public function destroy(string $id)
    {
        $acc = Accounts::find($id);
        $res = $acc->delete();
        if($res){
            return back()->with(['success'=>'Data Deleted Successfully.']);
        }else{
            return back()->with(['error'=>'Data Not Deleted.']);
        }
    }
}
