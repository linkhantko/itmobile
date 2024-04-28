@extends('admin.Layout.master')
@section('title', 'Order')
@section('subtitle', 'Order List')
@section('content')
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
                                <th>Customer Name</th>
                                <th>##</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>
                                        <img src="{{ asset('/storage/photos/' . $order->photo) }}" alt="photo"
                                            width="100px">
                                    </td>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->id }}</td>
                                    <td>
                                        <a href="{{ url('admin/order/' . $order->id . '/edit') }}" class="text-primary"><i
                                                class="bi bi-pencil-square"></i></a> |

                                        <a href="" class="text-danger" data-bs-toggle="modal"
                                            data-bs-target="#basicModal{{ $order->id }}"><i
                                                class="bi bi-trash-fill"></i></a>
                                    </td>
                                </tr>

                                {{-- Delete Model --}}
                                <div class="modal fade" id="basicModal{{ $order->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Delete order</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you Sure you want to delete!
                                            </div>
                                            <form action="{{ url('admin/order/' . $order->id) }}" method="post">
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
@endsection
