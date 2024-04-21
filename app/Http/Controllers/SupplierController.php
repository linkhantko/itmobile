<?php

namespace App\Http\Controllers;

use App\Models\Suppler;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $supplier = new Supplier();
        $suppliers = Supplier::all();
        return view('admin.supplier.index', compact('supplier', 'suppliers'));
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
        $data = $request->validate([
            'name' => 'required|unique:suppliers',
            'phone' => 'required',
            'address' => 'required',
        ]);
        Supplier::create($data);
        return back()->with('success', 'New Supplier added!');
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
        return view('admin.supplier.index', [
            'supplier' => Supplier::find($id),
            'suppliers' => Supplier::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'required|unique:suppliers,name,' . $id,
            'phone' => 'required',
            'address' => 'required',
        ]);
        Supplier::find($id)->update($data);
        return redirect('admin/supplier')->with('updated', 'Supplier Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Supplier::find($id)->delete();
        return back()->with('deleted', 'successfully deleted!');
    }
}
