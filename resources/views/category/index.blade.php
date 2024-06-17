@extends('adminlte::page')
@section('title', 'Manage Categories')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Manage Categories</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Manage Categories</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Categories</h3>
            </div>
            <div class="card-body">
                @if (Session::has('message'))
                <div class="alert alert-info alert-msg">{{ Session::get('message') }}</div>
                @endif
                <p>
                    <a href="{{ route('category.create') }}" class="btn btn-primary">Add Category</a>
                </p>
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 10px">Sl.No</th>
                            <th style="width: 100px">Category Name</th>
                            <th style="width: 100px">Description</th>
                            <th style="width: 100px">Active</th>
                            <th style="width: 100px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $number = 0;
                        @endphp
                        @if(isset($data) && $data->isNotEmpty())
                        @foreach ($data as $key => $item)
                        <tr>
                            <td>{{ ($data->firstItem() + $number) }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->desc }}</td>
                            <td>{{ $item->status == 1 ? 'Yes' : 'No'}}</td>
                            <td>

                                <a href="{{ route('category.edit', ['id' => $item->id]) }}" title="Edit"><i class="fas fa-edit"></i></a>
                                <a href="{{ route('category.delete', ['id' => $item->id]) }}" title="Delete" onclick="return confirm('Are you sure you want to delete this category?')"><i class="fas fa-trash"></i></a>

                            </td>

                        </tr>
                        @php
                        $number++;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer clearfix">
                {{ $data->render() }}
            </div>
            @else
            <div">
                No results found!
        </div>
        @endif
    </div>
    </div>

</section>

@stop
@section('scripts')
<script>
    $(".alert-msg").fadeTo(2000, 500).slideUp(500, function() {
        $(".alert-msg").slideUp(500);
    });
</script>
@stop