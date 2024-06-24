@php
use Carbon\Carbon;
@endphp
@extends('layouts.cart')
@section('content')
<div class="container">
    <div class="page-contain">
        <!-- Main content -->
        <div id="main-content" class="main-content">
            <!--Block 03: Product Tab-->
            <div class="product-tab z-index-20 sm-margin-top-193px xs-margin-top-30px">
                <div class="container">
                    <div class="biolife-tab biolife-tab-contain sm-margin-top-34px">
                        <div class="tab-content">
                            <div id="tab01_1st" class="tab-contain active">
                                <ul class="products-list biolife-carousel nav-center-02 nav-none-on-mobile eq-height-contain" data-slick='{"rows":2 ,"arrows":true,"dots":false,"infinite":true,"speed":400,"slidesMargin":10,"slidesToShow":4, "responsive":[{"breakpoint":1200, "settings":{ "slidesToShow": 4}},{"breakpoint":992, "settings":{ "slidesToShow": 3, "slidesMargin":25 }},{"breakpoint":768, "settings":{ "slidesToShow": 2, "slidesMargin":15}}]}'>
                                    @if(isset($data) && $data->isNotEmpty())
                                    @foreach($data as $value)
                                    <li class="product-item">
                                        <div class="contain-product layout-default">
                                            <div class="product-thumb">
                                                <a href="{{ route('product-view', ['id' => $value->id]) }}" class="link-to-product">
                                                    <img src='{{ \URL::to("/") . "/images/uploads/{$value->image}" }}' alt="Vegetables" width="270" height="270" class="product-thumnail">
                                                </a>
                                            </div>
                                            <div class="info">
                                                <b class="categories">{{ $value->category_name }}</b>
                                                <h4 class="product-title"><a href="#" class="pr-name">{{ $value->name }}</a></h4>
                                                <div class="price ">
                                                    <ins><span class="price-amount"><span class="currencySymbol">Rs.</span>{{ $value->price}}</span></ins>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                    @endif
                                </ul>
                            </div>
                            <div>
                                <a href="{{ url('auth/google') }}" style="margin-top: 0px !important;background: #C84130;color: #ffffff;padding: 8px;border-radius:6px;" class="ml-2">
                                    <strong>Login with Google</strong>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<style>
    .slick-slide.slick-current.slick-active.first-slick.last-slick {
        width: 100% !important;
        display: flex !important;
        flex-wrap: wrap !important
    }

    .slick-track {
        width: 100% !important;
    }

    .row-item {
        width: 25% !important;
    }
</style>