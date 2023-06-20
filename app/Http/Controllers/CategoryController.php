<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index(){
       $categories = Category::with('products')->get();
       return $this->sendResponse(CategoryResource::collection($categories),"categories");
    }

    public function store(Request $request){

        $full_path = "";
        if($request->hasFile('image')){
            $image = $request->file('image');
            $path = "uploads/images/";
            $file_name = time() + rand(1,1000000) . "." . $image->getClientOriginalExtension();
            $full_path = $path . $file_name;
            Storage::disk('public')->put($path.$file_name,file_get_contents($image));
        }

       $category=  Category::create([
            'name' => $request->name,
            'image' =>$full_path
        ]);

        return $this->sendResponse($category,"Created");
    
    }


    public function update(Request $request){
        $category = Category::find($request->id);
        $full_path = $category->image;
        if($request->hasFile('image')){
            $image = $request->file('image');
            $path = "uploads/images/";
            $file_name = time() + rand(1,1000000) . "." . $image->getClientOriginalExtension();
            $full_path = $path . $file_name;
            Storage::disk('public')->put($path.$file_name,file_get_contents($image));
        }

       $category->update(
        [
            'name' => $request->name,
            'image' =>$full_path
        ]
       );

       return $this->sendResponse(new CategoryResource($category),"Created");
    }


    public function destroy(Request $request){
        $category = Category::find($request->id);
        if(!$category){
            return $this->errorResponse("Daleted");
        }
        $category->delete();
        return $this->sendResponse(new CategoryResource($category),"Created");
    }
}