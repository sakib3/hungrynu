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

    public function store(Request $request){
        $product = Product::create([
            'name' => $request->input('name'),
            'parent' => $request->input('parent'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        //return $product;
        $product->save();
    }
}
