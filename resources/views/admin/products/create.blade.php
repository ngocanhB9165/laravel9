@extends('adminlte::page')

@section('title', 'Thêm mới sản phẩm')

@section('content_header')
    <h1 class="m-0 text-dark">Thêm mới sản phẩm</h1>
@stop

@section('content')
    <form action="{{route('products.store')}}" method="POST">
        @csrf
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
                                   id="exampleInputEmail" name="name" value="{{old('name')}}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail">Mã sản phẩm</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   id="exampleInputEmail" name="code" value="{{old('code')}}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail">Mô tả sản phẩm</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   id="exampleInputEmail" name="description" value="{{old('description')}}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail">Biến thể</label>
                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th>Tên biến thể</th>
                                        <th>Code</th>
                                        <th>Giá</th>
                                        <th>Số lượng</th>
                                        <th>Màu</th>
                                        <th>Size</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input type="text" name="product_variants[name][]"></td>
                                        <td><input type="text" name="product_variants[code][]"></td>
                                        <td><input type="text" name="product_variants[price][]"></td>
                                        <td><input type="text" name="product_variants[quantity][]"></td>
                                        <td><input type="text" name="product_variants[color][]"></td>
                                        <td><input type="text" name="product_variants[size][]"></td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" name="product_variants[name][]"></td>
                                        <td><input type="text" name="product_variants[code][]"></td>
                                        <td><input type="text" name="product_variants[price][]"></td>
                                        <td><input type="text" name="product_variants[quantity][]"></td>
                                        <td><input type="text" name="product_variants[color][]"></td>
                                        <td><input type="text" name="product_variants[size][]"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail">Giá sản phẩm</label>
                            <input type="text" class="form-control @error('price') is-invalid @enderror"
                                   id="exampleInputEmail" name="price" value="{{old('price')}}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail">Số lượng sản phẩm</label>
                            <input type="text" class="form-control @error('quantity') is-invalid @enderror"
                                   id="exampleInputEmail" name="quantity" value="{{old('quantity')}}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail">Bộ sưu tập</label>
                            <input type="text" class="form-control @error('collection') is-invalid @enderror"
                                   id="exampleInputEmail" name="collection" value="{{old('collection')}}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail">Xuất xứ</label>
                            <input type="text" class="form-control @error('made_in') is-invalid @enderror"
                                   id="exampleInputEmail" name="made_in" value="{{old('made_in')}}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail">Chất liệu</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   id="exampleInputEmail" name="material" value="{{old('material')}}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Thêm mới</button>
                        <a href="{{route('products.index')}}" class="btn btn-default">
                            Danh sách sản phẩm
                        </a>
                    </div>
                </div>
            </div>
        </div>
@stop
