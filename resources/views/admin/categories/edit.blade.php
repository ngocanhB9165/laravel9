@extends('adminlte::page')

@section('title', 'Tambah User')

@section('content_header')
    <h1 class="m-0 text-dark">Thêm mới danh mục</h1>
@stop

@section('content')
    <form action="{{route('categories.update', $categories->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <div class="form-group">
                          <label for="">Lựa chọn danh mục</label>
                          <select class="form-control" name="parent_id" id="">
                            <option value="0">Root</option>
                          </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail">Tên danh mục</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="exampleInputEmail"  name="name" value="{{$categories->name ?? old('name')}}">
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                        <a href="{{route('users.index')}}" class="btn btn-default">
                            Batal
                        </a>
                    </div>
                </div>
            </div>
        </div>
@stop
