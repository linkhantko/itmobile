<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $product = new Product();
        $products = Product::where('status', true)->get();

        $brand = new Brand();
        $brands = Brand::all();

        $category = new Category();
        $categories = Category::all();

        $supplier = new Supplier();
        $suppliers = Supplier::all();
        return view('admin.product.index', compact('product', 'products', 'brand', 'brands', 'category', 'categories', 'supplier', 'suppliers'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'brand_id' => 'required',
            'category_id' => 'required',
            'supplier_id' => 'required',
            'price' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate the photo
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->brand_id = $request->brand_id;
        $product->category_id = $request->category_id;
        $product->supplier_id = $request->supplier_id;
        $product->price = $request->price;

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoName = time() . '.' . $photo->getClientOriginalName();
            $photo->storeAs('/public/photos', $photoName);
            // $product->photo = 'storage/photos/' . $photoName;
            $product->photo = $photoName;
        }

        $product->save();

        return redirect('/admin/product')->with('success', 'Product created successfully.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $product = Product::find($id);
        $products = Product::where('status', true)->get();

        $brand = new Brand();
        $brands = Brand::all();

        $category = new Category();
        $categories = Category::all();

        $supplier = new Supplier();
        $suppliers = Supplier::all();
        return view('admin.product.index', compact('product', 'products', 'brand', 'brands', 'category', 'categories', 'supplier', 'suppliers'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'brand_id' => 'required',
            'category_id' => 'required',
            'supplier_id' => 'required',
            'price' => 'required',
        ]);

        $product = Product::find($id);
        $product->name = $request->name;
        $product->brand_id = $request->brand_id;
        $product->category_id = $request->category_id;
        $product->supplier_id = $request->supplier_id;
        $product->price = $request->price;
        $product->update();

        return redirect('/admin/product')->with('updated', 'Product created successfully.');
    }

    public function destroy(string $id)
    {
        $product = Product::find($id);
        // if ($product->photo) {
        //     Storage::delete('/public/photos/' . $product->photo);
        // }
        Storage::delete('/public/photos/' . $product->photo);
        $product->delete();
        return redirect('/admin/product')->with('deleted', 'Product deleted successfully.');
    }
}
