@extends('admin.Layout.master')
@section('title', 'User')
@section('subtitle', 'User List')
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
            <h5 class="card-title">User Create Form</h5>
            <!-- Floating Labels Form -->
            @if (!empty($user->id))
                <form action="{{ url('admin/user/' . $user->id) }}" method="post" class="row g-3">
                    @method('PATCH')
                    @csrf
                    <div class="col-md-12">
                        @foreach ($roles as $role)
                            <label for="{{ $role->id }}">{{ $role->name }}</label>
                            <input type="checkbox" name="role_ids[]" class="checkbox checkbox-primary"
                                value="{{ $role->id }}" id="{{ $role->id }}"
                                @if (!empty($user->roles) && $user->roles->contains('id', $role->id)) checked @endif>
                        @endforeach
                    </div>
                    <div class="text-end">
                        <a href="{{ url('admin/user') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-warning">Update</button>
                </form>
            @endif
        </div>
    </div>

    <!-- list -->
    <div class="card shadow-lg">
        <div class="card-body">
            <h5 class="card-title">User Lists</h5>

            <!-- User List -->
            <table class="display nowrap" style="width:100%" id="datatable">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">User</th>
                        <th scope="col">Role</th>
                        <th scope="col">##</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $key => $user)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $user->name }}</td>
                            <td>
                                <ul>
                                    @foreach ($user->roles as $role)
                                        <li>{{ $role->name }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>
                                <a href="{{ url('admin/user/' . $user->id . '/edit') }}" class="text-primary"><i
                                        class="bi bi-pencil-square"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- End Enquiry List -->
        </div>
    </div>
@endsection
