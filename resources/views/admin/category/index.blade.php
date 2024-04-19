@extends('admin.Layout.master')
@section('title', 'Category')
@section('subtitle', 'Category List')
@section('content')
    <!--Create Success Message -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-1"></i>
            Successfully Created a Category!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <!--Create Success Message -->

    {{-- Update Success Message --}}
    @if (session('updated'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-1"></i>
            Successfully Updated a Category!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    {{-- Update Success Message --}}

    {{-- deleted Success Message --}}
    @if (session('deleted'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-1"></i>
            Successfully Deleted a Category!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Update Success Message --}}
    <div class="card shadow-lg">
        <div class="card-body">
            <h5 class="card-title">Category Create Form</h5>
            <!-- Floating Labels Form -->
            @if (empty($category->id))
                <form class="row g-3" action="{{ url('admin/category') }}" method="post">
                @else
                    <form action="{{ url('admin/category/' . $category->id) }}" method="post" class="row g-3">
                        @method('PATCH')
            @endif
            @csrf
            <div class="col-md-12">
                <div class="form-floating">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        placeholder="Category Name" name="name" value="{{ old('name') ?? $category->name }}" required>
                    <label for="name">Category Name</label>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="text-end">
                @if (empty($category->id))
                    <button type="reset" class="btn btn-secondary">Clear</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                @else
                    <a href="{{ url('admin/category') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-warning">Update</button>
                @endif
            </div>
            </form><!-- End floating Labels Form -->
        </div>
    </div>

    <!-- list -->
    <div class="card shadow-lg">
        <div class="card-body">
            <h5 class="card-title">Category Lists</h5>

            <!-- Category List -->
            <table class="display nowrap" style="width:100%" id="datatable">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">##</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $key => $category)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $category->name }}</td>
                            <td>
                                <a href="{{ url('admin/category/' . $category->id . '/edit') }}" class="text-primary"><i
                                        class="bi bi-pencil-square"></i></a> |

                                <a href="" class="text-danger" data-bs-toggle="modal"
                                    data-bs-target="#basicModal{{ $category->id }}"><i class="bi bi-trash-fill"></i></a>
                            </td>
                        </tr>
                        {{-- Delete Model --}}
                        <div class="modal fade" id="basicModal{{ $category->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Delete category</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you Sure you want to delete!
                                    </div>
                                    <form action="{{ url('admin/category/' . $category->id) }}" method="post">
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
            <!-- End Enquiry List -->
        </div>
    </div>
@endsection
