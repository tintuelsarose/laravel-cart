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
                {!! Form::open(['url' => ['category/save'],'method'=>'POST', 'enctype' => 'multipart/form-data']) !!}
                @else
                {!! Form::open(['url' => ['category/update'],'method'=>'POST', 'enctype' => 'multipart/form-data']) !!}
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
                                <strong>Description:</strong>
                                {!! Form::textArea('desc', $data->desc ?? old('desc'), ['rows' => 4, 'cols' => 40, 'placeholder' => 'Description','class' => 'form-control','id'=>'desc', 'required' => true]) !!}
                                <span id="desc-error" class="error invalid-feedback"></span>

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

                            {!! Form::hidden('id_category',$data->id) !!}
                            @endif
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <a href="{{ route('category.index') }}" class="btn btn-default" data-dismiss="modal">Cancel</a>
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
