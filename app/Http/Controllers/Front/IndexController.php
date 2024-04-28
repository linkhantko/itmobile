<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Blog;
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
        $products = Product::where('status', true)->get();
        $blogs = Blog::all();

        $carts = null;
        if (auth()->check()) {
            $carts = Cart::where('user_id', auth()->user()->id)->get();
        }

        return view('front.home.index', compact('brands', 'categories', 'products', 'blogs', 'carts'));
    }


    public function contact()
    {
        $brands = Brand::all();
        $categories = Category::all();
        $products = Product::where('status', true)->get();

        $carts = null;
        if (auth()->check()) {
            $carts = Cart::where('user_id', auth()->user()->id)->get();
        }
        return view('front.home.contact', compact('brands', 'categories', 'products', 'carts'));
    }

    public function shop()
    {
        $brands = Brand::all();
        $categories = Category::all();
        $products = Product::where('status', true)->get();

        $carts = null;
        if (auth()->check()) {
            $carts = Cart::where('user_id', auth()->user()->id)->get();
        }
        return view('front.home.shop', compact('brands', 'categories', 'products', 'carts'));
    }

    public function blog(string $id)
    {
        $brands = Brand::all();
        $categories = Category::all();
        $products = Product::where('status', true)->get();
        $blogs = Blog::all();
        $blog = Blog::find($id);

        $carts = null;
        if (auth()->check()) {
            $carts = Cart::where('user_id', auth()->user()->id)->get();
        }

        return view('front.home.blog', compact('brands', 'categories', 'products', 'blogs', 'blog', 'carts'));
    }
}
