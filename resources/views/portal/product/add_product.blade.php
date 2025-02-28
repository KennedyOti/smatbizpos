@extends('layouts.portal')

@section('content')

@if(Auth::user()->category=='admin')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="m-0">Product</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('product.info') }}">Product</a>
                    </li>
                    <li class="breadcrumb-item active">Add Product</li>
                </ol>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header">Add New Product</div>
                    <div class="card-body">
                        <form id="store_catalogue" action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="form-group">
                                    {{ csrf_field() }}
                                </div>
                                <div class="form-group col-md-4 mb-3">
                                    <label for="category_id" class="form-label">Category ID</label>
                                    <select class="form-control text-capitalize" id="category_id" name="category_id" required>
                                        <option value="">--Select product category--</option>
                                        @foreach ($menu as $category)
                                        <option value="{{ $category['category_id'] }}">{{ $category['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4 mb-3">
                                    <label for="sub_category_id" class="form-label">Sub Category ID</label>
                                    <select class="form-control text-capitalize" id="sub_category_id" name="sub_category_id" required>
                                        <option value="">--Select product sub category--</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4 mb-3">
                                    <label for="supplier" class="form-label">Supplier</label>
                                    <select class="form-control text-capitalize" id="supplier" name="supplier" required>
                                        <option value="">--Select Supplier--</option>
                                        <option value="smatbiz">Smat Biz</option>
                                        <option value="techno">Techno</option>
                                        <option value="muthoni_agrovet">Muthoni Agrovet</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <hr>
                                </div>
                                <div class="form-group col-md-12 mb-3">
                                    <label for="product_name" class="form-label">Product Name</label>
                                    <input type="text" class="form-control" placeholder="Product Name" id="product_name" name="product_name" required>
                                </div>
                                <div class="form-group col-md-4 mb-3">
                                    <label for="image" class="form-label">Image URL</label>
                                    <input type="file" class="form-control" id="image" name="image">
                                </div>
                                <div class="form-group col-md-4 mb-3">
                                    <label for="SKU" class="form-label">SKU</label>
                                    <input type="text" class="form-control" placeholder="SKU" id="SKU" name="SKU" required>
                                </div>
                                <div class="form-group col-md-4 mb-3">
                                    <label for="stock_quantity" class="form-label">Stock Quantity</label>
                                    <input type="number" class="form-control" placeholder="Stock Quantity" id="stock_quantity" name="stock_quantity">
                                </div>
                                <div class="form-group">
                                    <hr>
                                </div>
                                <div class="form-group col-md-4 mb-3">
                                    <label for="buying_price" class="form-label">Unit Buying Price</label>
                                    <input type="number" step="0.01" class="form-control" placeholder="Unit Buying Price" id="buying_price" name="buying_price" required>
                                </div>
                                <div class="form-group col-md-4 mb-3">
                                    <label for="marked_price" class="form-label">Unit marked Price</label>
                                    <input type="number" step="0.01" class="form-control" placeholder="Unit marked Price" id="marked_price" name="marked_price" required>
                                </div>
                                <div class="form-group col-md-12 mb-3">
                                    <label for="editor" class="form-label">Description</label>
                                    <textarea class="form-control" placeholder="Description" id="editor" name="description" rows="3"></textarea>
                                </div>
                                <div class="form-group col-md-12 text-end mb-3">
                                    <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-save"></i> Save Product</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->

@push('script')
<script>
    $(document).ready(function() {

        // Form submission validation
        $("#store_catalogue").validate({
            submitHandler: function(form, event) {
                event.preventDefault();
                swal.fire({
                    title: 'Add product',
                    text: 'Are you sure you want to add the product?',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            }
        });

        $('#category_id').change(function() {
            var category_id = $(this).val();
            $('#sub_category_id').html('<option value="">--Select product sub category--</option>');
            $.ajax({
                type: "GET",
                url: "{{ route('product.get_category_subcategories') }}",
                data: {
                    category_id: category_id
                },
                cache: false,
                success: function(response) {
                    if (response.length > 3) {
                        var json = $.parseJSON(response);
                        html = '<option value="">--Select product sub category--</option>';
                        $(json).each(function(i, val) {
                            html += '<option value="' + val.sub_category_id + '">' + val.sub_category_name + '</option>';
                        });
                        $('#sub_category_id').html(html);
                    }
                }
            });
        });
    });
</script>
@endpush

@else

@include('portal.no_permission')

@endif

@endsection