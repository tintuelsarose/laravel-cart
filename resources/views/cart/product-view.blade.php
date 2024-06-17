@php
use Carbon\Carbon;
@endphp
@extends('layouts.cart')
@section('content')
<div class="container">
    <div class="page-contain single-product">
        <div class="container">
            <!-- Main content -->
            <div id="main-content" class="main-content">
                <!-- summary info -->
                <div class="sumary-product single-layout">
                    <div class="media">
                        <ul class="biolife-carousel slider-for" data-slick='{"arrows":false,"dots":false,"slidesMargin":30,"slidesToShow":1,"slidesToScroll":1,"fade":true,"asNavFor":".slider-nav"}'>
                            <li><img src='{{ \URL::to("/") . "/images/uploads/{$data->image}" }}' alt="" width="500" height="500">
                            </li>
                        </ul>
                    </div>
                    <div class="product-attribute">
                        <h3 class="title"> {{ $data->name }}</h3>
                        <p class="excerpt">{{ $data->category_name }}</p>
                        <p class="excerpt">{{ $data->desc }}</p>
                        <p class="excerpt">{{ $data->category_desc }}</p>
                        <div class="price">
                            <ins><span class="price-amount"><span class="currencySymbol">RS. </span>{{ $data->price }}</span></ins>
                        </div>

                        <div class="shipping-info">
                            <p class="shipping-day">3-Day Shipping</p>
                            <p class="for-today">Pree Pickup Today</p>
                        </div>
                    </div>
                    <div class="action-form">
                        @if (Session::has('success'))
                        <div class="alert alert-info alert-msg">{{ Session::get('success') }}</div>
                        @endif
                        <form method="post" action="/add-to-cart">
                            @csrf
                            <div class="quantity-box">
                                <span class="title">Quantity:</span>
                                <div class="qty-input">

                                    <input type="text" name="qty" value="1" data-max_value="20" data-min_value="1" data-step="1" id="qty">
                                    <a href="#" class="qty-btn btn-up add-up"><i class="fa fa-caret-up" aria-hidden="true"></i></a>
                                    <a href="#" class="qty-btn btn-down add-down"><i class="fa fa-caret-down" aria-hidden="true"></i></a>
                                    <input type="hidden" id="id" name="id" value="{{ $data->id }}" />

                                </div>
                            </div>
                            <div class="total-price-contain">
                                <span class="title">Total Price:</span>
                                <p class="price">

                                </p>

                            </div>
                            <div class="buttons">
                                
                                <button type="submit" class="btn add-to-cart-btn">add to cart</button>
                               
                            </div>
                            <div class="buttons">
                            <a href="{{ route('cart.index') }}" class="btn add-to-cart-btn">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        var price = "{{$data->price}}";
        var qty = parseInt($('#qty').val());
        var totalPrice = qty * price;
        $('.price').html('Rs.' + totalPrice);

        $(".add-up").click(function() {
            var price = "{{$data->price}}";
            var qty = parseInt($('#qty').val()) + 1;
            var totalPrice = qty * price;
            $('.price').html('Rs.' + totalPrice);
        });
        $(".add-down").click(function() {
            var price = "{{$data->price}}";
            var qty = parseInt($('#qty').val()) - 1;
            var totalPrice = qty * price;
            $('.price').html('Rs.' + totalPrice);
        });
        $(".alert-msg").fadeTo(2000, 500).slideUp(500, function() {
            $(".alert-msg").slideUp(500);
        });
    });
</script>
@stop