@extends('adminlte::page')

@section('title', 'Thêm mới danh mục')

@section('content_header')
    <h1 class="m-0 text-dark">Thêm mới danh mục</h1>
@stop

@section('content')
    <form action="{{route('categories.store')}}" method="POST">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Lựa chọn danh mục</label>
                            <select name="parent_id" id="" class="form-control">
                                <option value="0">Root</option>
                            @foreach ($categories as $subcategory)
                                    @include('admin.categories.categories', ['parent_id'=>0,'category' => $subcategory, 'level' =>''])
                                @endforeach
                            </select>

                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail">Tên danh mục</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   id="exampleInputEmail" name="name" value="{{old('name')}}">
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Thêm mới</button>
                        <a href="{{route('categories.index')}}" class="btn btn-default">
                            Danh sách
                        </a>
                    </div>
                </div>
            </div>
        </div>
@stop
