<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductsController extends Controller
{
    public function index(){
        $products = Product::all();
        return compact('products');
    }

    public function store(){
        $product = Product::create([
            'name' => $request->name,
            'parent' => $request->parent,
            'price' => $request->price,
            'description' => $request->description,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        $product->save();
    }
}
