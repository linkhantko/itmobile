@extends('admin.Layout.master')
@section('title', 'Product')
@section('subtitle', 'Product List')
@section('content')

    <section class="section">

        <!--Create Success Message -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-1"></i>
                Successfully Created a Course!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <!--Create Success Message -->

        {{-- Update Success Message --}}
        @if (session('updated'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-1"></i>
                Successfully Updated a Course!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        {{-- Update Success Message --}}

        {{-- deleted Success Message --}}
        @if (session('deleted'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-1"></i>
                Successfully Deleted a Course!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        {{-- Update Success Message --}}
        <div class="card shadow-lg">
            <div class="card-body">
                <h5 class="card-title">Product Create Form</h5>
                <!-- Floating Labels Form -->
                @if (empty($product->id))
                    <form class="row g-3" action="{{ url('admin/product') }}" method="post">
                    @else
                        <form action="{{ url('admin/product/' . $product->id) }}" method="post" class="row g-3">
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
                        <select name="brand" id="" class="form-control" required>
                            @if ($product->id)
                                <option value="{{ $product->id }}" selected>{{ $product->users->name }}</option>
                            @else
                                <option value="" selected>Choose Brand</option>
                            @endif
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                        <label for="floatingPassword">Brand</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-floating">
                        <select name="category" id="" class="form-control" required>
                            @if ($product->id)
                                <option value="{{ $product->id }}" selected>{{ $product->users->name }}</option>
                            @else
                                <option value="" selected>Choose Category</option>
                            @endif
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <label for="floatingPassword">Category</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-floating">
                        <select name="supplier" id="" class="form-control" required>
                            @if ($product->id)
                                <option value="{{ $product->id }}" selected>{{ $product->users->name }}</option>
                            @else
                                <option value="" selected>Choose Supplier</option>
                            @endif
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
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
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Unity Pugh</td>
                                    <td>9958</td>
                                    <td>Curicó</td>
                                    <td>2005/02/11</td>
                                    <td>37%</td>
                                    <td>37%</td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
