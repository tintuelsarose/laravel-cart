@php
use Carbon\Carbon;
@endphp
@extends('layouts.cart')
@section('content')
<div class="container">
    <div class="page-contain checkout">

        <!-- Main content -->
        <div id="main-content" class="main-content">
            <div class="container sm-margin-top-37px">
                <div class="row">
                    <!--Order Summary-->
                    <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12 sm-padding-top-48px sm-margin-bottom-0 xs-margin-bottom-15px">
                        <div class="order-summary sm-margin-bottom-80px">
                            <div class="title-block">
                                <h3 class="title">Order Summary</h3>
                            </div>
                            <div class="cart-list-box short-type">
                                <span class="number">{{ count(Session::get('cart')) }} items</span>
                                <ul class="cart-list">
                                    @php
                                    $grandTotal = 0;
                                    @endphp
                                    @if(isset($data) && !empty($data))
                                    @foreach($data as $value)
                                    @php
                                    $url = \URL::to("/") . "/images/uploads/{$value['photo']}";
                                    $totalPrice = $value['quantity'] * $value['price'];
                                    @endphp
                                    <li class="cart-elem">
                                        <div class="cart-item">
                                            <div class="product-thumb">
                                                <a class="prd-thumb" href="#">
                                                    <figure><img src='{{ $url }}' width="113" height="113" alt="shop-cart"></figure>
                                                </a>
                                            </div>
                                            <div class="info">
                                                <span class="txt-quantity">{{ $value['quantity'] }}</span>
                                                <a href="#" class="pr-name">{{ $value['name'] }}</a>
                                            </div>
                                            <div class="price price-contain">
                                                <ins><span class="price-amount"><span class="currencySymbol">Rs.</span>{{ $totalPrice }}</span></ins>

                                            </div>
                                        </div>
                                    </li>
                                    @php
                                    $grandTotal = $totalPrice + $grandTotal;
                                    @endphp
                                    @endforeach
                                    @endif
                                </ul>
                                <ul class="subtotal">
                                    <li>
                                        <div class="subtotal-line">
                                            <b class="stt-name">total:</b>
                                            <span class="stt-price">Rs. {{ $grandTotal }}</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="login-on-checkout">
                                <p class="form-row">
                                    <a href="{{ route('place-order') }}" name="btn-sbmt" class="btn btn-primary">Place Order</a>
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
@endsection