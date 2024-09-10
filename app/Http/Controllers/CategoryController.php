<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Models\DailySales;
use App\Models\AssignedProducts;

class CategoryController extends Controller
{
    public function __construct(){
        $this->view_path = "admin.category.";
    }

    public function index(Request $request){
        if($request->is('api/*')){
            // $dailysales_id = DailySales::where('outing_date',date('Y-m-d'))->where('salesman_id',$request->user()->id)->value('id');
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
        $data['title'] = 'Category';
        $data['categorys'] = Category::all();
        return view($this->view_path.'index')->with($data);
    }

    public function create(){
        $data['title'] = 'Category';
        return view($this->view_path.'create')->with($data);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
        ]);
        $category = new Category();
        $category->name = $request->name;
        $category->slug = createSlug($request->name,Category::class);
        
        if ($request->hasFile('category_image')) {
            $img = $request->file('category_image');
            $filename = time(). '_' .$img->getClientOriginalName();
            $directory = public_path('web_directory/category_images');
            $img->move($directory, $filename);
            $filePath = "web_directory/category_images/".$filename;
            $category->image = $filePath;
        }

        $category->visibility = $request->is_visible;
        $res = $category->save();
        if($res){
            return back()->with(['success'=>'Category Stored Successfully.']);
        }else{
            return back()->with(['error'=>'Category Not Stored.']);
        }
    }

    public function edit(Request $r){
        $data['title'] = 'Category';
        $data['category'] = Category::find($r->id);
        return view($this->view_path.'edit')->with($data);
    }

    public function update(Request $request){
        $request->validate([
            'name' => 'required',
        ]);
        $category = Category::find($request->id);
        $category->name = $request->name;
        $category->slug = createSlug($request->name,Category::class);
        
        if ($request->hasFile('category_image')) {
            $img = $request->file('category_image');
            $filename = time(). '_' .$img->getClientOriginalName();
            $directory = public_path('web_directory/category_images');
            $img->move($directory, $filename);
            $filePath = "web_directory/category_images/".$filename;
            $category->image = $filePath;
        }

        $category->visibility = $request->is_visible;
        $res = $category->update();
        if($res){
            return back()->with(['success'=>'Category Updated Successfully.']);
        }else{
            return back()->with(['error'=>'Category Not Updated.']);
        }
    }

    public function delete(Request $r){
        $category = Category::find($r->id);
        $res = $category->delete();
        if($res){
            return back()->with(['success'=>'Category Deleted Successfully.']);
        }else{
            return back()->with(['error'=>'Category Not Deleted.']);
        }
    }
}
