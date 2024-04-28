@extends('admin.Layout.master')
@section('title', 'Blog')
@section('subtitle', 'Blog List')
@section('content')
    <section class="section">
        <!--Create Success Message -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-1"></i>
                Successfully Created a Blog!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <!--Create Success Message -->

        {{-- Update Success Message --}}
        @if (session('updated'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-1"></i>
                Successfully Updated a Blog!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        {{-- Update Success Message --}}

        {{-- deleted Success Message --}}
        @if (session('deleted'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-1"></i>
                Successfully Deleted a Blog!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        {{-- deleted Success Message --}}

        <div class="card shadow-lg">
            <div class="card-body">
                <h5 class="card-title">Blog Create Form</h5>
                <!-- Floating Labels Form -->
                @if (empty($blog->id))
                    <form class="row g-3" action="{{ url('admin/blog') }}" method="post" enctype="multipart/form-data">
                    @else
                        <form action="{{ url('admin/blog/' . $blog->id) }}" method="post" class="row g-3"
                            enctype="multipart/form-data">
                            @method('PATCH')
                @endif
                @csrf
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                            placeholder="Blog Title" name="title" value="{{ old('title') ?? $blog->title }}" required>
                        <label for="title">Blog Title</label>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <div class="form-floating">
                            <textarea class="form-control" name="description" placeholder="Blog Description" id="floatingTextarea">{{ old('description') ?? $blog->description }}</textarea>
                            <label for="floatingTextarea">Blog Description</label>
                        </div>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <label for="photo">Blog Photo</label>
                    <input type="file" name="photo" id="photo">
                </div>
                <div class="text-end">
                    @if (empty($blog->id))
                        <button type="reset" class="btn btn-secondary">Clear</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    @else
                        <a href="{{ url('admin/blog') }}" class="btn btn-secondary">Cancel</a>
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
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>##</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($blogs as $blog)
                                    <tr>
                                        <td>
                                            <img src="{{ asset('/storage/blogs/' . $blog->photo) }}" alt="photo"
                                                width="100px">
                                        </td>
                                        <td>{{ $blog->title }}</td>
                                        <td>{{ $blog->description }}</td>
                                        <td>
                                            <a href="{{ url('admin/blog/' . $blog->id . '/edit') }}" class="text-primary"><i
                                                    class="bi bi-pencil-square"></i></a> |

                                            <a href="" class="text-danger" data-bs-toggle="modal"
                                                data-bs-target="#basicModal{{ $blog->id }}"><i
                                                    class="bi bi-trash-fill"></i></a>
                                        </td>
                                    </tr>

                                    {{-- Delete Model --}}
                                    <div class="modal fade" id="basicModal{{ $blog->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Delete blog</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you Sure you want to delete!
                                                </div>
                                                <form action="{{ url('admin/blog/' . $blog->id) }}" method="post">
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
