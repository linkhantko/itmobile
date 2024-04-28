@extends('front.layouts.master')
@section('front-content')
    <section class="hero">
        <div class="container">
            @foreach ($orders as $order)
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="{{ asset('/storage/photos/' . $order->product->photo) }}"
                                class="img-fluid rounded-start" alt="Product Image">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{ $order->product->name }}</h5>
                                <p class="card-text">Price: ${{ $order->product->price }}</p>
                                <p class="card-text">
                                    <small class="text-muted">
                                        Status:
                                        @if ($order->status == 1)
                                            Pending
                                        @elseif($order->status == 2)
                                            Check
                                        @elseif($order->status == 3)
                                            Confirm
                                        @elseif($order->status == 4)
                                            Cancel
                                        @endif
                                    </small>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
