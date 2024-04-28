<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        $categories = Category::all();
        $products = Product::all();
        $carts = Cart::all();

        return view('front.home.index', compact('brands', 'categories', 'products', 'carts'));
    }


    public function contact(){
        $brands = Brand::all();
        $categories = Category::all();
        $products = Product::all();
        $carts = Cart::all();
        return view('front.home.contact', compact('brands', 'categories', 'products', 'carts'));
    }
}
