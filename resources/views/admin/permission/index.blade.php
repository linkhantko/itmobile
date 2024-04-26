@extends('admin.Layout.master')
@section('title', 'Permission')
@section('subtitle', 'Permission List')
@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-1"></i>
            Successfully Created a User!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <!--Create Success Message -->

    {{-- Update Success Message --}}
    @if (session('updated'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-1"></i>
            Successfully Updated a User!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    {{-- Update Success Message --}}

    {{-- deleted Success Message --}}
    @if (session('deleted'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-1"></i>
            Successfully Deleted a User!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-lg">
        <div class="card-body">
            <h5 class="card-title">Permission Create Form</h5>
            <!-- Floating Labels Form -->
            @if (empty($permission->id))
                <form class="row g-3" action="{{ url('admin/permission') }}" method="post">
                @else
                    <form action="{{ url('admin/permission/' . $permission->id) }}" method="post" class="row g-3">
                        @method('PATCH')
            @endif
            @csrf
            <div class="col-md-12">
                <div class="form-floating">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        placeholder="Permission Name" name="name" value="{{ old('name') ?? $permission->name }}" required>
                    <label for="name">Permission Name</label>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="text-end">
                @if (empty($permission->id))
                    <button type="reset" class="btn btn-secondary">Clear</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                @else
                    <a href="{{ url('admin/permission') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-warning">Update</button>
                @endif
            </div>
            </form><!-- End floating Labels Form -->
        </div>
    </div>

    <!-- list -->
    <div class="card shadow-lg">
        <div class="card-body">
            <h5 class="card-title">Permission Lists</h5>

            <!-- Permission List -->
            <table class="display nowrap" style="width:100%" id="datatable">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Permission</th>
                        <th scope="col">##</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permissions as $key => $permission)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $permission->name }}</td>
                            <td>
                                <a href="{{ url('admin/permission/' . $permission->id . '/edit') }}" class="text-primary"><i
                                        class="bi bi-pencil-square"></i></a> |

                                <a href="" class="text-danger" data-bs-toggle="modal"
                                    data-bs-target="#basicModal{{ $permission->id }}"><i class="bi bi-trash-fill"></i></a>
                            </td>
                        </tr>
                        {{-- Delete Model --}}
                        <div class="modal fade" id="basicModal{{ $permission->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Delete permission</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you Sure you want to delete!
                                    </div>
                                    <form action="{{ url('admin/permission/' . $permission->id) }}" method="post">
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
                        </div>
                        {{-- Delete Model --}}
                    @endforeach
                </tbody>
            </table>
            <!-- End Enquiry List -->
        </div>
    </div>
@endsection
