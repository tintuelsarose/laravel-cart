@extends('adminlte::page')
@section('title', $title)
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">{{ $title }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                    <li class="breadcrumb-item active">{{ $title }}</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ $title }}</h3>
            </div>
            <div class="card-body">
                @if ($action == 'create')
                {!! Form::open(['url' => ['product/save'],'method'=>'POST', 'enctype' => 'multipart/form-data']) !!}
                @else
                {!! Form::open(['url' => ['product/update'],'method'=>'POST', 'enctype' => 'multipart/form-data']) !!}
                @endif
                @csrf
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <strong>Name:</strong>
                                {!! Form::text('name', $data->name ?? old('name'), ['placeholder' => 'Name','class' => 'form-control','id'=>'name', 'required' => true]) !!}
                                <span id="name-error" class="error invalid-feedback"></span>

                            </div>
                            <div class="form-group">
                                <strong>Category:</strong>
                                {!! Form::select('id_category', $categories, $data->id_category ?? old('id_category'), ['rows' => 4, 'cols' => 40, 'placeholder' => 'Select Category','class' => 'form-control','id'=>'id_category', 'required' => true]) !!}
                                <span id="category-error" class="error invalid-feedback"></span>

                            </div>
                            <div class="form-group">
                                <strong>Description:</strong>
                                {!! Form::textArea('desc', $data->desc ?? old('desc'), ['rows' => 4, 'cols' => 40, 'placeholder' => 'Description','class' => 'form-control','id'=>'desc', 'required' => true]) !!}
                                <span id="desc-error" class="error invalid-feedback"></span>

                            </div>
                            <div class="form-group">
                                <strong>Brand:</strong>
                                {!! Form::text('brand', $data->brand ?? old('brand'), ['placeholder' => 'Brand','class' => 'form-control','id'=>'brand', 'required' => true]) !!}
                                <span id="brand-error" class="error invalid-feedback"></span>

                            </div>
                            <div class="form-group">
                                <strong>Price:</strong>
                                {!! Form::number('price', $data->price ?? old('price'), ['placeholder' => 'Price','class' => 'form-control','id'=>'price', 'required' => true]) !!}
                                <span id="price-error" class="error invalid-feedback"></span>

                            </div>
                            <div class="form-group">
                                <strong>Quantity:</strong>
                                {!! Form::number('qty', $data->qty ?? old('qty'), ['placeholder' => 'Quantity','class' => 'form-control','id'=>'price', 'required' => true]) !!}
                                <span id="price-error" class="error invalid-feedback"></span>

                            </div>
                            <div class="form-group">
                                <strong>Upload Image:</strong>
                                {!! Form::file('image',  ['class' => 'form-control','id'=>'image', 'accept' => 'image/*']) !!}
                                <span id="image-error" class="error invalid-feedback"></span>

                            </div>
                            @if ($action == 'update')
                            <div class="form-group">
                                <strong>Image:</strong>
                                <img src="{{ $url }}" class="image"/>
                                <span id="status-error" class="error invalid-feedback"></span>
                            </div>
                            <div class="form-group">
                                <strong>Status:</strong>
                                {!! Form::select('status', $status, $data->status, ['placeholder' => 'Select Status','class' => 'form-control','id'=>'status']) !!}
                                <span id="status-error" class="error invalid-feedback"></span>
                            </div>

                            {!! Form::hidden('id_product',$data->id) !!}
                            @endif
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <a href="{{ route('product.index') }}" class="btn btn-default">Cancel</a>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

</section>

<style>
    .image {
        width: 100px;
        height: 100px;
    }

</style>
@stop