@extends('adminlte::page')

@section('title', 'Thêm mới sản phẩm')

@section('content_header')
    <h1 class="m-0 text-dark">Thêm mới sản phẩm</h1>
@stop

@section('content')
    <form action="{{route('products_variants.update',$products->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <div class="form-group">
                            <label for="exampleInputEmail">Danh mục sản phẩm</label>
                            <select class="form-control" name="product_id" id="">
                               @foreach ( as )

                               @endforeach
                            </select>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail">Tên biến thể</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   id="exampleInputEmail" name="name" value="{{ $products->name ?? old('name') }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail">Mã sản phẩm</label>
                            <input type="text" class="form-control @error('code') is-invalid @enderror"
                                   id="exampleInputEmail" name="code" value="{{ $products->code ?? old('code') }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail">Giá sản phẩm</label>
                            <input type="text" class="form-control @error('price') is-invalid @enderror"
                                   id="exampleInputEmail" name="price" value="{{ $products->price ?? old('price') }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail">Số lượng sản phẩm</label>
                            <input type="text" class="form-control @error('quantity') is-invalid @enderror"
                                   id="exampleInputEmail" name="quantity" value="{{ $products->quantity ?? old('quantity') }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail">Màu sắc</label>
                            <input type="text" class="form-control @error('color') is-invalid @enderror"
                                   id="exampleInputEmail" name="color" value="{{ $products->color ?? old('color') }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail">Kích cỡ</label>
                            <input type="text" class="form-control @error('size') is-invalid @enderror"
                                   id="exampleInputEmail" name="size" value="{{ $products->size ?? old('size') }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                        <a href="{{route('products_variants.index')}}" class="btn btn-default">
                            Danh sách sản phẩm
                        </a>
                    </div>
                </div>
            </div>
        </div>
@stop
