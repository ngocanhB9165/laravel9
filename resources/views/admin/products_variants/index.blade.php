@extends('adminlte::page')

@section('title', 'List Product')

@section('content_header')
    <h1 class="m-0 text-dark">List Product</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <a href="{{ route('products.create') }}" class="btn btn-primary mb-2">
                        Create
                    </a>

                    <table class="table table-hover table-bordered table-stripped" id="example2">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Product_Id</th>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Color</th>
                                <th>Size</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($productsVariants as $key => $products)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $products->product_id }}</td>
                                    <td>{{ $products->name }}</td>
                                    <td>{{ $products->code }}</td>
                                    <td>{{ $products->price }}</td>
                                    <td>{{ $products->quantity }}</td>
                                    <td>{{ $products->color }}</td>
                                    <td>{{ $products->size}}</td>
                                    <td>
                                        <a href="{{ route('products_variants.edit', $products) }}" class="btn btn-primary btn-xs">
                                            Edit
                                        </a>
                                        <a href="{{ route('products_variants.destroy', $products) }}"
                                            onclick="notificationBeforeDelete(event, this)" class="btn btn-danger btn-xs">
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
    <form action="" id="delete-form" method="post">
        @method('delete')
        @csrf
    </form>
    <script>
        $('#example2').DataTable({
            "responsive": true,
        });

        function notificationBeforeDelete(event, el) {
            event.preventDefault();
            if (confirm('Do you want to delete this product variant ?')) {
                $("#delete-form").attr('action', $(el).attr('href'));
                $("#delete-form").submit();
            }
        }
    </script>
@endpush
