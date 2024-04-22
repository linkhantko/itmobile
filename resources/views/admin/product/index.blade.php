@extends('admin.Layout.master')
@section('title', 'Product')
@section('subtitle', 'Product List')
@section('content')

    <section class="section">

        <!--Create Success Message -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-1"></i>
                Successfully Created a Product!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <!--Create Success Message -->

        {{-- Update Success Message --}}
        @if (session('updated'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-1"></i>
                Successfully Updated a Product!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        {{-- Update Success Message --}}

        {{-- deleted Success Message --}}
        @if (session('deleted'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-1"></i>
                Successfully Deleted a Product!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        {{-- Update Success Message --}}
        <div class="card shadow-lg">
            <div class="card-body">
                <h5 class="card-title">Product Create Form</h5>
                <!-- Floating Labels Form -->
                @if (empty($product->id))
                    <form class="row g-3" action="{{ url('admin/product') }}" method="post" enctype="multipart/form-data">
                    @else
                        <form action="{{ url('admin/product/' . $product->id) }}" method="post" class="row g-3"
                            enctype="multipart/form-data">
                            @method('PATCH')
                @endif
                @csrf
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            placeholder="Product Name" name="name" value="{{ old('name') ?? $product->name }}" required>
                        <label for="name">Product Name</label>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control @error('price') is-invalid @enderror" id="price"
                            placeholder="Product Name" name="price" value="{{ old('price') ?? $product->price }}"
                            required>
                        <label for="price">Price</label>
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-floating">
                        <select name="brand_id" id="" class="form-control" required>
                            <option value="" selected>Choose Brand</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}"
                                    {{ $brand->id == old('brand_id', $product->brand_id) ? 'selected' : '' }}>
                                    {{ $brand->name }}</option>
                            @endforeach
                        </select>
                        <label for="floatingPassword">Brand</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-floating">
                        <select name="category_id" id="" class="form-control" required>
                            <option value="" selected>Choose Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $category->id == old('category_id', $product->category_id) ? 'selected' : '' }}>
                                    {{ $category->name }}</option>
                            @endforeach
                        </select>
                        <label for="floatingPassword">Category</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-floating">
                        <select name="supplier_id" id="" class="form-control" required>
                            <option value="" selected>Choose Supplier</option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}"
                                    {{ $supplier->id == old('supplier_id', $product->supplier_id) ? 'selected' : '' }}>
                                    {{ $supplier->name }}</option>
                            @endforeach
                        </select>
                        <label for="floatingPassword">Supplier</label>
                    </div>
                </div>
                <div class="col-md-12">
                    <label for="photo">Photo</label>
                    <input type="file" name="photo" id="">
                </div>
                <div class="text-end">
                    @if (empty($product->id))
                        <button type="reset" class="btn btn-secondary">Clear</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    @else
                        <a href="{{ url('admin/product') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-warning">Update</button>
                    @endif
                </div>
                </form><!-- End floating Labels Form -->
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Product List</h5>

                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>Photo</th>
                                    <th>Name</th>
                                    <th>Brand</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Supplier</th>
                                    <th>##</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>
                                            <img src="{{ asset('/storage/photos/' . $product->photo) }}" alt="photo"
                                                width="100px">
                                        </td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->brand->name }}</td>
                                        <td>{{ $product->category->name }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>{{ $product->supplier->name }}</td>
                                        <td>
                                            <a href="{{ url('admin/product/' . $product->id . '/edit') }}"
                                                class="text-primary"><i class="bi bi-pencil-square"></i></a> |

                                            <a href="" class="text-danger" data-bs-toggle="modal"
                                                data-bs-target="#basicModal{{ $product->id }}"><i
                                                    class="bi bi-trash-fill"></i></a>
                                        </td>
                                    </tr>

                                    {{-- Delete Model --}}
                                    <div class="modal fade" id="basicModal{{ $product->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Delete product</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you Sure you want to delete!
                                                </div>
                                                <form action="{{ url('admin/product/' . $product->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <div class="modal-footer">
                                                        <button type="reset" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        {{-- Delete Model --}}
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
