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
                        <label for="exampleInputName">Ảnh</label>
                        <div class="input-group hdtuto control-group lst increment">
                            <div class="list-input-hidden-upload">
                                <input hidden type="file" name="images[]" id="file_upload"
                                       class="myfrm form-control hidden">
                            </div>
                            <div class="input-group-btn">
                                <button class="btn btn-success btn-add-image" type="button"><i
                                        class="fldemo glyphicon glyphicon-plus"></i>+Add image
                                </button>
                            </div>
                        </div>
                        <div class="list-images">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail">Nội dung</label>
                            <textarea class="summernote form-control @error('description') is-invalid @enderror"
                                      id="text" cols="30" rows="10" placeholder="Mô tả"
                                      name="description">{{old('description')}}</textarea>
                            @error('description') <span class="text-danger">{{$message}}</span> @enderror
                            @include('ckfinder::setup')
                        </div>
                        <div class="col-md-12 mb-2" id="none-image">
                            <img id="preview-image-before-upload"
                                 src="{{asset('images-UI/notfound.jpg')}}"
                                 alt="preview image" style="max-height: 250px;">
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
                    var x = 0; //initlal text box count
                    $("#add_variant").click(function() {
                        $("#table_variant").removeClass('d-none');
                        if (x < max_fields) { //max input box allowed
                            x++; //text box increment
                            $(wrapper).append(
                                ` <tr id='record-${x}'>
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
                                        <td> <button id='${x}' type="button" class='remove_field btn btn-info'>Remove</button>
                            </tr>`); //add input box
                        }
                    });
                    $(document).on('click', `.remove_field`, function(){
                        var button_id = $(this).attr("id");
                        $('#record-'+button_id+'').remove();
                        x--;
                        if (x == 0) $("#table_variant").addClass('d-none');
                    });
                });
            </script>
        @include('ckfinder::setup')
        <script src={{ url('ckeditor/ckeditor.js') }}></script>
            <script>
                CKEDITOR.replace('text', {
                    filebrowserBrowseUrl: '{{ route('ckfinder_browser') }}',
                    filebrowserUploadUrl: '{{ route('ckfinder_connector') }}',
                    filebrowserWindowWidth: '1000',
                    filebrowserWindowHeight: '700',
                    height: '1000'
                });
            </script>


            <script type="text/javascript">
                $(document).ready(function () {
                    $(".btn-add-image").click(function () {
                        let countImage = $("input[name='images[]']").map(function () {
                            if ($(this).val() !== '')
                                return $(this).val();
                        })
                        if (countImage.length > 9) {
                            alert('Không được up quá 10 ảnh!')
                        } else $('#file_upload').trigger('click');

                    });

                    $('.list-input-hidden-upload').on('change', '#file_upload', function (event) {
                        let today = new Date();
                        let time = today.getTime();
                        let image = event.target.files[0];
                        let file_name = event.target.files[0].name;
                        let box_image = $('<div class="box-image"></div>');
                        box_image.append('<img src="' + URL.createObjectURL(image) + '" class="picture-box">');
                        box_image.append('<div class="wrap-btn-delete"><span data-id=' + time + ' class="btn-delete-image">x</span></div>');
                        $(".list-images").append(box_image);

                        $(this).removeAttr('id');
                        $(this).attr('id', time);
                        let input_type_file = '<input type="file" hidden name="images[]" id="file_upload" class="myfrm form-control hidden">';
                        $('.list-input-hidden-upload').append(input_type_file);
                        let countImage = $("input[name='images[]']").map(function () {
                            if ($(this).val() !== '')
                                return $(this).val();
                        })
                        if (countImage.length > 0) {
                            $("#none-image").addClass("d-none");
                        }

                    });

                    $(".list-images").on('click', '.btn-delete-image', function () {
                        let id = $(this).data('id');
                        $('#' + id).remove();
                        $(this).parents('.box-image').remove();
                        let countImage = $("input[name='images[]']").map(function () {
                            if ($(this).val() !== '')
                                return $(this).val();
                        })
                        if (countImage.length == 0) {
                            $("#none-image").removeClass("d-none");
                        }
                    });
                });
            </script>
        @endpush
    @stop
