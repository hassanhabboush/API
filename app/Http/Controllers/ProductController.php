<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        return  $this->sendResponse(ProductResource::collection($products), "index");
    }

    public function store(Request $request)
    {
        $product = Product::create([
            'name' => $request->name,
            'categories_id' => $request->categories_id,

        ]);

        return $this->sendResponse(new ProductResource($product), "create");
    }

    public function update(Request $request)
    {
        $product = Product::find($request->id);
        if (!$product) {
            return $this->errorResponse("Product Not Fund");
        }
        $product->update([
            'name' => $request->name,
            'categories_id' => $request->categories_id,
        ]);
        return $this->sendResponse(new ProductResource($product), "update");
    }

    public function destroy(Request $request)
    {
        $product = Product::find($request->id);
        if (!$product) {
            return $this->errorResponse("Product Not Fund");
        }
        $product->delete();
        return $this->sendResponse(new ProductResource($product), "destroy");
    }
}