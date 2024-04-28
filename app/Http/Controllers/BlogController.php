<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index()
    {
        return view('admin.blog.index', [
            'blog' => new Blog(),
            'blogs' => Blog::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $blog = new Blog();
        $blog->title = $request->title;
        $blog->description = $request->description;

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoName = time() . '.' . $photo->getClientOriginalName();
            $photo->storeAs('/public/blogs', $photoName);
            $blog->photo = $photoName;
        }

        $blog->save();

        return redirect('/admin/blog')->with('success', 'Blog created successfully.');
    }

    public function edit(string $id)
    {
        return view('admin.blog.index', [
            'blog' => Blog::find($id),
            'blogs' => Blog::all(),
        ]);
    }

    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        Blog::find($id)->update($data);

        return redirect('/admin/blog')->with('updated', 'Blog created successfully.');
    }

    public function destroy(string $id)
    {
        $blog = Blog::find($id);
        Storage::delete('/public/blogs/' . $blog->photo);
        $blog->delete();

        return redirect('/admin/blog')->with('deleted', 'Blog deleted successfully.');
    }
}
