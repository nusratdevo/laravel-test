<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;

class CartController extends Controller
{

    public function cartProduct(){
        return view('cart');
    }
    public function index(){
        $products = Cart::all();
       return view('cart_product', compact('products'));
    }

    public function addToCart($id){
      $product = Cart::findOrfail($id);
      $cart = session()->get('cart', []);
       if(isset($cart[$id])){
        $cart['$id']['quantity']++;
       }else{
        $cart[$id] = [
             'name'=> $product->name,
             'quantity'=>1,
             'price'=>$product->price,
             'image'=>$product->image
        ];
       }
       session()->put('cart', $cart);
       return redirect()->back()->with('success', 'product added');

    }

    public function update(Request $request){
        if($request->id && $request->Quantity){
            $cart = session()->get('cart');
            $cart[$request->id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'cart updated successfully');
        }
    }

    public function remove(Request $request){
      if($request->id){
        $cart = session()->get('cart');
        if(isset($cart[$request->id])){
            unset($cart[$request->id]);
            session()->put('cart', $cart);
        }
        session()->flush('success', 'product delated successfully');
      }
    } 
}
