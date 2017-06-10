<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;

class CartsController extends Controller
{
    public function index(Request $request){
        $cart = $request->session()->get('cart');
        return compact('cart');
    }

    public function store(Request $request){
        $cart = $request->input('cart');
        $request->session()->put('cart',$cart);
    }
    
    public function update(Request $request, $id){
        $updatingCart = [$request->input('cart')];
        $existingCart = $request->session()->get('cart');
        $request->session()->put('cart',$this->processCartData($existingCart,$updatingCart));
    }

    public function updateBulk(Request $request){
        $updatingCart = $request->input('cart');
        $existingCart = $request->session()->get('cart');
        $request->session()->put('cart',$this->processCartData($existingCart,$updatingCart));
    }

    public function delete(Request $request){
        $request->session()->forget('cart');
        $cart = $request->session()->get('cart');
        return compact('cart');
    }

    private function processCartData($existingCart,$updatingCart){
        if(count($existingCart) == 0 || $updatingCart == null || count($updatingCart)== 0)
            return $existingCart;
        foreach ($existingCart as $key => $product){            
                $id = $product['product_id'];
                $updatingProduct = $this->findProductById($id,$updatingCart);
                if($product['product_id'] == $id)
                    $existingCart[$key]['name'] = $updatingProduct['name'];

        }
        return $existingCart;
    }

    private function findProductById($id,$products){
        foreach ($products as $product) {            
                if($product['product_id'] == $id)
                    return $product;
        }
        return [];
    }
}
