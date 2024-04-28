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
                                        <img src="{{ asset('/storage/photos/' . $order->product->photo) }}" alt="photo"
                                            width="100px">
                                    </td>
                                    <td>{{ $order->product->name }}</td>
                                    <td>{{ $order->product->brand->name }}</td>
                                    <td>{{ $order->product->category->name }}</td>
                                    <td>{{ $order->product->price }}</td>
                                    <td>{{ $order->user->name }}</td>
                                    <td>
                                        <button class="btn btn-primary dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                            Actions
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <li><a class="dropdown-item" href="{{ 'check/' . $order->id }}"
                                                    onclick="handleAction('check', {{ $order->id }})">Check</a></li>
                                            <li><a class="dropdown-item" href="{{ 'confirm/' . $order->id }}"
                                                    onclick="handleAction('confirm', {{ $order->id }})">Confirm</a></li>
                                        </ul>

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
                                            <div class="modal-footer">
                                                <button type="reset" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <a type="submit" class="btn btn-danger"
                                                    href="{{ 'cancel/' . $order->id }}">Delete</a>
                                            </div>
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
