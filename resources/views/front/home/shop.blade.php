@extends('front.layouts.master')
@section('front-content')
    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-lg-3 col-md-4 col-sm-6 mix {{ $product->category->name }} fresh-meat">
                        <div class="featured__item">
                            <form action="{{ url('cart') }}" method="POST" id="add-to-cart-form-{{ $product->id }}">
                                @csrf
                                <div class="featured__item__pic set-bg"
                                    data-setbg="{{ asset('/storage/photos/' . $product->photo) }}">
                                    <ul class="featured__item__pic__hover">
                                        <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                        <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                        @auth
                                            @php
                                                $addedToCart = false;
                                                foreach (auth()->user()->carts as $cart) {
                                                    if ($cart->status === 1 && $cart->product_id === $product->id) {
                                                        $addedToCart = true;
                                                        break;
                                                    }
                                                }
                                            @endphp
                                            @if (!$addedToCart)
                                                <li>
                                                    <a href="#"
                                                        onclick="event.preventDefault(); document.getElementById('add-to-cart-form-{{ $product->id }}').submit();">
                                                        <i class="fa fa-shopping-cart"></i>
                                                    </a>
                                                </li>
                                            @endif
                                        @endauth
                                    </ul>
                                </div>
                                <div class="featured__item__text">
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <h6><a href="#">{{ $product->name }}</a></h6>
                                    <h5>${{ $product->price }}</h5>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        </div>
    </section>
    <!-- Product Section End -->
@endsection
