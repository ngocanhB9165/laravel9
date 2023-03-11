@extends('adminlte::page')

@section('title', 'Thêm mới sản phẩm')

@section('content_header')
    <h1 class="m-0 text-dark">Thêm mới sản phẩm</h1>
@stop

@section('content')
    <form action="{{route('products.update',$product->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <div class="form-group">
                            <label for="exampleInputEmail">Danh mục sản phẩm</label>
                            <select class="form-control" name="categories_id" id="">
                                @foreach ($categories as $subcategory)
                                    @include('admin.categories.categories', ['parent_id'=>0,'category' => $subcategory, 'level' =>''])
                                @endforeach
                            </select>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail">Tên sản phẩm</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   id="exampleInputEmail" name="name" value="{{ $product->name ?? old('name') }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail">Mã sản phẩm</label>
                            <input type="text" class="form-control @error('code') is-invalid @enderror"
                                   id="exampleInputEmail" name="code" value="{{ $product->code ?? old('code') }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail">Mô tả sản phẩm</label>
                            <input type="text" class="form-control @error('description') is-invalid @enderror"
                                   id="exampleInputEmail" name="description" value="{{ $product->description ?? old('description') }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail">Giá sản phẩm</label>
                            <input type="text" class="form-control @error('price') is-invalid @enderror"
                                   id="exampleInputEmail" name="price" value="{{ $product->price ?? old('price') }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail">Số lượng sản phẩm</label>
                            <input type="text" class="form-control @error('quantity') is-invalid @enderror"
                                   id="exampleInputEmail" name="quantity" value="{{ $product->quantity ?? old('quantity') }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail">Bộ sưu tập</label>
                            <input type="text" class="form-control @error('collection') is-invalid @enderror"
                                   id="exampleInputEmail" name="collection" value="{{ $product->collection ?? old('collection') }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail">Xuất xứ</label>
                            <input type="text" class="form-control @error('made_in') is-invalid @enderror"
                                   id="exampleInputEmail" name="made_in" value="{{ $product->made_in ?? old('made_in') }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail">Chất liệu</label>
                            <input type="text" class="form-control @error('material') is-invalid @enderror"
                                   id="exampleInputEmail" name="material" value="{{ $product->material ?? old('material') }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                        <a href="{{route('products.index')}}" class="btn btn-default">
                            Danh sách sản phẩm
                        </a>
                    </div>
                </div>
            </div>
        </div>
@stop