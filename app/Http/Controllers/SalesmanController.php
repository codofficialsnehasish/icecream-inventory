<?php

namespace App\Http\Controllers;

use App\Models\Salesman;
use Illuminate\Http\Request;

class SalesmanController extends Controller
{
    public function __construct(){
        $this->view_path = 'admin.salesmans.';
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] = 'Sales Man';
        $data['salesmans'] = Salesman::all();
        return view($this->view_path.'index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['title'] = 'Sales Man';
        return view($this->view_path.'create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|digits:10|regex:/^[6789]/|unique:salesmen,phone',
            'password' => 'required',
        ]);
        $salesman = new Salesman();
        $salesman->status = $request->status;
        $salesman->name = $request->name;
        if ($request->hasFile('salesman_image')) {
            $img = $request->file('salesman_image');
            $filename = time(). '_' .$img->getClientOriginalName();
            $directory = public_path('web_directory/salesman_images');
            $img->move($directory, $filename);
            $filePath = "web_directory/salesman_images/".$filename;
            $salesman->image = $filePath;
        }
        $salesman->phone = $request->phone;
        $salesman->password = $request->password;
        $res = $salesman->save();

        if($res){
            return redirect()->back()->with(['success'=>'Data Added Successfully']);
        }else{
            return redirect()->back()->with(['error'=>'Data Not Added']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Salesman $salesman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['title'] = 'Sales Man';
        $data['salesman'] = Salesman::find($id);
        return view($this->view_path.'edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|digits:10|regex:/^[6789]/',
            'password' => 'required',
        ]);
        $salesman = Salesman::find($id);
        $salesman->status = $request->status;
        $salesman->name = $request->name;
        if ($request->hasFile('salesman_image')) {
            $img = $request->file('salesman_image');
            $filename = time(). '_' .$img->getClientOriginalName();
            $directory = public_path('web_directory/salesman_images');
            $img->move($directory, $filename);
            $filePath = "web_directory/salesman_images/".$filename;
            $salesman->image = $filePath;
        }
        $salesman->phone = $request->phone;
        $salesman->password = $request->password;
        $res = $salesman->update();

        if($res){
            return redirect()->back()->with(['success'=>'Data Updated Successfully']);
        }else{
            return redirect()->back()->with(['error'=>'Data Not Updated']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $salesman = Salesman::find($id);
        $res = $salesman->delete();
        if($res){
            return back()->with(['success'=>'Data Deleted Successfully.']);
        }else{
            return back()->with(['error'=>'Data Not Deleted.']);
        }
    }
}
