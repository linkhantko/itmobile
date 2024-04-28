@extends('admin.Layout.master')
@section('title', 'User')
@section('subtitle', 'User List')
@section('content')
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
                            {{-- <td>
                                <a href="{{ url('admin/user/' . $user->id . '/edit') }}" class="text-primary"><i
                                        class="bi bi-pencil-square"></i></a>
                            </td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- End Enquiry List -->
        </div>
    </div>
@endsection
