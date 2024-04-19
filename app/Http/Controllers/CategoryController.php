<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.category.index', [
            'categories' => Category::all(),
            'category' => new Category(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:categories',
        ]);
        Category::create($data);
        return back()->with('success', 'New Category added!');
    }

    public function edit(string $id)
    {
        return view('admin.category.index', [
            'category' => Category::find($id),
            'categories' => Category::all(),
        ]);
    }

    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'required|unique:categories,name,' . $id,
        ]);
        Category::find($id)->update($data);
        return redirect('admin/category')->with('updated', 'Category Updated!');
    }

    public function destroy(string $id)
    {
        Category::find($id)->delete();
        return back()->with('deleted', 'successfully deleted!');
    }
}
