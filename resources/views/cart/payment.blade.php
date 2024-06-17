@php
use Carbon\Carbon;
@endphp
@extends('layouts.cart')
@section('content')
<div class="container">
    <div class="col-lg-7 col-md-7 col-sm-6 col-xs-12">
        <div class="checkout-progress-wrap">
            <ul class="steps">
                <li class="step 3rd">
                    <div class="checkout-act active">
                        <h3 class="title-box"><span class="number">2</span>Payment</h3>
                        <div class="box-content">
                            <div class="order-summary sm-margin-bottom-80px">
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
                                <div class="modal-footer">
                                    <a href="{{ route('cart.index') }}" class="btn btn-default">Cancel</a>
                                    <a href="{{ route('payment') }}" class="btn btn-primary">Proceed to Pay</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection