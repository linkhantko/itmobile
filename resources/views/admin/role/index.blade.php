@extends('admin.Layout.master')
@section('title', 'Role')
@section('subtitle', 'Role List')
@section('content')
    <!--Create Success Message -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-1"></i>
            Successfully Created a Role!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <!--Create Success Message -->

    {{-- Update Success Message --}}
    @if (session('updated'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-1"></i>
            Successfully Updated a Role!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    {{-- Update Success Message --}}

    {{-- deleted Success Message --}}
    @if (session('deleted'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-1"></i>
            Successfully Deleted a Role!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-lg">
        <div class="card-body">
            <h5 class="card-title">Role Create Form</h5>
            <!-- Floating Labels Form -->
            @if (empty($role->id))
                <form class="row g-3" action="{{ url('admin/role') }}" method="post">
                @else
                    <form action="{{ url('admin/role/' . $role->id) }}" method="post" class="row g-3">
                        @method('PATCH')
            @endif
            @csrf
            <div class="col-md-12">
                <div class="form-floating">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        placeholder="Role Name" name="name" value="{{ old('name') ?? $role->name }}" required>
                    <label for="name">Role Name</label>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            @if (!empty($role->id))
                <div class="col-md-12">
                    @foreach ($permissions as $permission)
                        <label for="{{ $permission->id }}">{{ $permission->name }}</label>
                        <input type="checkbox" name="permission_ids[]" class="checkbox checkbox-primary"
                            value="{{ $permission->id }}" id="{{ $permission->id }}"
                            @if (!empty($role->permissions) && $role->permissions->contains('id', $permission->id)) checked @endif>
                    @endforeach
                </div>
            @endif
            <div class="text-end">
                @if (empty($role->id))
                    <button type="reset" class="btn btn-secondary">Clear</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                @else
                    <a href="{{ url('admin/role') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-warning">Update</button>
                @endif
            </div>
            </form><!-- End floating Labels Form -->
        </div>
    </div>

    <!-- list -->
    <div class="card shadow-lg">
        <div class="card-body">
            <h5 class="card-title">Role Lists</h5>

            <!-- Role List -->
            <table class="display nowrap" style="width:100%" id="datatable">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Role</th>
                        <th scope="col">Permission</th>
                        <th scope="col">##</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $key => $role)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $role->name }}</td>
                            <td>
                                <ul>
                                    @foreach ($role->permissions as $permission)
                                        <li>{{ $permission->name }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>
                                <a href="{{ url('admin/role/' . $role->id . '/edit') }}" class="text-primary"><i
                                        class="bi bi-pencil-square"></i></a> |

                                <a href="" class="text-danger" data-bs-toggle="modal"
                                    data-bs-target="#basicModal{{ $role->id }}"><i class="bi bi-trash-fill"></i></a>
                            </td>
                        </tr>
                        {{-- Delete Model --}}
                        <div class="modal fade" id="basicModal{{ $role->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Delete role</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you Sure you want to delete!
                                    </div>
                                    <form action="{{ url('admin/role/' . $role->id) }}" method="post">
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
