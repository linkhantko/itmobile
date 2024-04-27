<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        $cart = new Cart();
        $cart->product_id = $request->input('product_id');
        $cart->user_id = auth()->user()->id;
        $cart->status = true;
        $cart->save();

        return back()->with('success', 'Your Product is Added to Cart!');
    }

    public function destroy(string $id)
    {
        Cart::find($id)->delete();

        return back()->with('deleted', 'Cart Deleted!');
    }
}
