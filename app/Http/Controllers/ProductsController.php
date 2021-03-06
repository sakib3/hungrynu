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
        $product->save();
    }

    public function update(Request $request, $id){
        $product = Product::find($id);
        
        $product->name = $request->input('name');
        $product->parent = $request->input('parent');
        $product->price = $request->input('price');
        $product->description = $request->input('description');
 
        $product->save();
    }
}
