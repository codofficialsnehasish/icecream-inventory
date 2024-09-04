<?php

namespace App\Http\Controllers;

use App\Models\Trucks;
use Illuminate\Http\Request;

class TrucksController extends Controller
{
    public function __construct(){
        $this->view_path = 'admin.trucks.';
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] = 'Truck';
        $data['trucks'] = Trucks::all();
        return view($this->view_path.'index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['title'] = 'Truck';
        return view($this->view_path.'create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $truck = new Trucks();
        $truck->name = $request->name;
        if ($request->hasFile('trucks_image')) {
            $img = $request->file('trucks_image');
            $filename = time(). '_' .$img->getClientOriginalName();
            $directory = public_path('web_directory/truck_images');
            $img->move($directory, $filename);
            $filePath = "web_directory/truck_images/".$filename;
            $truck->image = $filePath;
        }
        $truck->is_visible = $request->is_visible;
        $res = $truck->save();

        if($res){
            return redirect()->back()->with(['success'=>'Data Added Successfully']);
        }else{
            return redirect()->back()->with(['error'=>'Data Not Added']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Trucks $tracks)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['title'] = 'Truck';
        $data['truck'] = Trucks::find($id);
        return view($this->view_path.'edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $truck = Trucks::find($id);
        $truck->name = $request->name;
        if ($request->hasFile('trucks_image')) {
            $img = $request->file('trucks_image');
            $filename = time(). '_' .$img->getClientOriginalName();
            $directory = public_path('web_directory/truck_images');
            $img->move($directory, $filename);
            $filePath = "web_directory/truck_images/".$filename;
            $truck->image = $filePath;
        }
        $truck->is_visible = $request->is_visible;
        $res = $truck->update();

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
        $truck = Trucks::find($id);
        $res = $truck->delete();
        if($res){
            return back()->with(['success'=>'Data Deleted Successfully.']);
        }else{
            return back()->with(['error'=>'Data Not Deleted.']);
        }
    }
}
