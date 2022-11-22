<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class RelationController extends Controller
{
    public function index(){
        $products = Product::all();
        return view('welcome', compact('products'));
    }
}
