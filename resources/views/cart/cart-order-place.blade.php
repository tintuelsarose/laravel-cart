@php
use Carbon\Carbon;
@endphp
@extends('layouts.cart')
@section('content')
<div class="container">
    <div class="col-lg-7 col-md-7 col-sm-6 col-xs-12">
        <div class="checkout-progress-wrap">
            <ul class="steps">
                <li class="step 1st">
                    <div class="checkout-act active">
                        <h3 class="title-box"><span class="number">1</span>Shipping Address</h3>
                        <div class="box-content">
                            <div class="login-on-checkout">
                                {!! Form::open(['url' => ['/add-shipping'],'method'=>'POST']) !!}
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>Name:</strong>
                                                {!! Form::text('name', old('name'), ['placeholder' => 'Name','class' => 'form-control','id'=>'name', 'required' => true]) !!}
                                                <span id="name-error" class="error invalid-feedback"></span>

                                            </div>
                                            <div class="form-group">
                                                <strong>Address Line 1:</strong>
                                                {!! Form::textArea('address1', old('address1'), ['rows' => 4, 'cols' => 40, 'placeholder' => 'Address Line 1','class' => 'form-control','id'=>'desc', 'required' => true]) !!}
                                                <span id="desc-error" class="error invalid-feedback"></span>

                                            </div>
                                            <div class="form-group">
                                                <strong>Address Line 2:</strong>
                                                {!! Form::textArea('address2', old('address2'), ['rows' => 4, 'cols' => 40, 'placeholder' => 'Address Line 1','class' => 'form-control','id'=>'desc', 'required' => true]) !!}
                                                <span id="desc-error" class="error invalid-feedback"></span>

                                            </div>

                                            <div class="form-group">
                                                <strong>City:</strong>
                                                {!! Form::text('city', old('city'), ['placeholder' => 'City','class' => 'form-control','id'=>'name', 'required' => true]) !!}
                                                <span id="name-error" class="error invalid-feedback"></span>

                                            </div>
                                            <div class="form-group">
                                                <strong>District:</strong>
                                                {!! Form::text('district', old('district'), ['placeholder' => 'District','class' => 'form-control','id'=>'name', 'required' => true]) !!}
                                                <span id="name-error" class="error invalid-feedback"></span>

                                            </div>
                                            <div class="form-group">
                                                <strong>State:</strong>
                                                {!! Form::text('state', old('state'), ['placeholder' => 'State','class' => 'form-control','id'=>'name', 'required' => true]) !!}
                                                <span id="name-error" class="error invalid-feedback"></span>

                                            </div>
                                            <div class="form-group">
                                                <strong>Postal Code:</strong>
                                                {!! Form::text('postal_code', old('postal_code'), ['placeholder' => 'Postal Code','class' => 'form-control','id'=>'name', 'required' => true]) !!}
                                                <span id="name-error" class="error invalid-feedback"></span>

                                            </div>
                                            <div class="modal-footer">
                                                <a href="{{ route('cart.index') }}" class="btn btn-default" data-dismiss="modal">Cancel</a>
                                                <button type="submit" class="btn btn-primary">Continue</button>
                                            </div>
                                            {!! Form::close() !!}

                                        </div>
                                    </div>
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