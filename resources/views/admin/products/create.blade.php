@extends('adminlte::page')

@section('title', 'Thêm mới sản phẩm')

@section('content_header')
    <h1 class="m-0 text-dark">Thêm mới sản phẩm</h1>
@stop

@section('content')
    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <div class="form-group">
                            <label for="exampleInputEmail">Danh mục sản phẩm</label>
                            <select class="form-control" name="categories_id" id="">
                                @foreach ($categories as $subcategory)
                                    @include('admin.categories.categories', [
                                        'parent_id' => 0,
                                        'category' => $subcategory,
                                        'level' => '',
                                    ])
                                @endforeach
                            </select>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail">Tên sản phẩm</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                id="exampleInputEmail" name="name" value="{{ old('name') }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail">Mã sản phẩm</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                id="exampleInputEmail" name="code" value="{{ old('code') }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail">Mô tả sản phẩm</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                id="exampleInputEmail" name="description" value="{{ old('description') }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail">Biến thể</label>
                            <br>
                            <button type="button" id="add_variant">Thêm biến thể</button>
                            <table id="table_variant" class="table table-responsive d-none">
                                <thead>
                                    <tr>
                                        <th>Tên biến thể</th>
                                        <th>Code</th>
                                        <th>Giá</th>
                                        <th>Số lượng</th>
                                        <th>Màu</th>
                                        <th>Size</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="record_variant">
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail">Giá sản phẩm</label>
                            <input type="text" class="form-control @error('price') is-invalid @enderror"
                                id="exampleInputEmail" name="price" value="{{ old('price') }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail">Số lượng sản phẩm</label>
                            <input type="text" class="form-control @error('quantity') is-invalid @enderror"
                                id="exampleInputEmail" name="quantity" value="{{ old('quantity') }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail">Bộ sưu tập</label>
                            <input type="text" class="form-control @error('collection') is-invalid @enderror"
                                id="exampleInputEmail" name="collection" value="{{ old('collection') }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail">Xuất xứ</label>
                            <input type="text" class="form-control @error('made_in') is-invalid @enderror"
                                id="exampleInputEmail" name="made_in" value="{{ old('made_in') }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail">Chất liệu</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                id="exampleInputEmail" name="material" value="{{ old('material') }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Thêm mới</button>
                        <a href="{{ route('products.index') }}" class="btn btn-default">
                            Danh sách sản phẩm
                        </a>
                    </div>
                </div>
            </div>
        </div>

        @push('js')
            <script type="text/javascript">
                $(document).ready(function() {
                    var max_fields = 15; //maximum input boxes allowed
                    var wrapper = $("#record_variant"); //Fields wrapper
                    var add_button = $("#add_variant"); //Add button ID
                    var x = 1; //initlal text box count
                    $("#add_variant").click(function() {
                        $("#table_variant").removeClass('d-none');
                        if (x < max_fields) { //max input box allowed
                            x++; //text box increment
                            $(wrapper).append(
                                ` <tr>
                                        <td> <input type = 'text'
                                        name = 'product_variants[name][]' > </td>
                                        <td> <input type = 'text'
                                        name = 'product_variants[code][]' > </td>
                                        <td> <input type = 'text'
                                        name = 'product_variants[price][]' > </td>
                                        <td> <input type = 'text'
                                        name = 'product_variants[quantity][]' > </td>
                                        <td> <input type = 'text'
                                        name = 'product_variants[color][]' > </td>
                                        <td> <input type = 'text'
                                        name = 'product_variants[size][]' > </td>
                                        <td> <button type="button" class="remove_field btn btn-info">Remove</button>
                            </tr>`); //add input box
                        }
                    });
                    $(wrapper).click(".remove_field", function() { //user click on remove text
                        $(this).remove();
                        x--;
                        if (x == 1) $("#table_variant").addClass('d-none');
                    })
                });
            </script>
        @endpush
    @stop
