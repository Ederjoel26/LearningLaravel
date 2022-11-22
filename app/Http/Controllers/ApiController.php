<?php

namespace App\Http\Controllers;


use App\Models\Product;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function Products(Request $request)
    {
        if($request->has('id_category'))
        {
            $Products = Product::where('id_category', $request->id_category)->get();
        }
        else
        {
            $Products = Product::all();
            foreach($Products as $product)
            {
                $product->categories->description;
            }
        }
        return response()->json($Products);
    }

    public function InsertProduct(Request $request)
    {
        $product = new Product();
        $product->id = $request->id;
        $product->description = $request->description;
        $product->id_category = $request->id_category;
        $product->save();
    }

    public function UpdateProduct(Request $request)
    {
        $product = Product::where('id', $request->id)->first();
        $product->description = $request->description;
        $product->save();
    }

    public function DeleteProduct(Request $request)
    {
        $product = Product::where('id', $request->id)->first()->delete();
    }
}
