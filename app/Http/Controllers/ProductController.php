<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd($request->all());
        $request->validate([
        'name' => 'required',
        'brand' => 'required',
        'category' => 'required',
        'supplier' => 'required',
        'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate the photo
    ]);

        $product = new Product();
        $product->name = $request->name;
        $product->brand = $request->brand;
        $product->category = $request->category;
        $product->supplier = $request->supplier;

    if ($request->hasFile('photo')) {
        $photo = $request->file('photo');
        $photoName = time() . '.' . $photo->getClientOriginalExtension();
        $photo->storeAs('public/photos', $photoName);
        $product->photo_path = 'storage/photos/' . $photoName;
    }
    dd($product);
    $product->save();

    return view('admin.product.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
