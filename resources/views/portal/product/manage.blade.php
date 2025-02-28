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
                    <li class="breadcrumb-item active">Product</li>
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
        <div class="col-12 mb-3">
            <form id="delete_product" action="{{ route('product.delete') }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="del_product_id" value="{{ $product->product_id }}">
                <button type="submit" class="btn btn-sm btn-danger">
                    <i class="fas fa-trash-alt"></i> Delete Product
                </button>
            </form>
        </div>

        <hr>

        <form id="update_product" action="{{ route('product.update') }}" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-3 mb-2">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-1">
                            <img src="/assets/images/products/{{ $product->image_URL }}" class="w-100 rounded" alt="Product Image">
                        </div>
                    </div>
                </div>
                <div class="col-md-9 mb-2">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header text-end">
                            <button type="submit" class="btn btn-sm btn-primary text-nowrap"><i class="fas fa-save"></i> Save Changes</button>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="ed_product_id" value="{{ $product->product_id }}">
                                </div>
                                <div class="form-group col-md-12 mb-3">
                                    <label for="product_name" class="form-label">Product Name</label>
                                    <input type="text" class="form-control" placeholder="Product Name" id="product_name" name="ed_product_name" value="{{ $product->product_name }}" required>
                                </div>
                                <div class="form-group col-md-4 mb-3">
                                    <label for="category_id" class="form-label">Category ID</label>
                                    <select class="form-control text-capitalize" id="category_id" name="ed_category_id" required>
                                        <option value="">--Select product category--</option>
                                        @foreach ($menu as $category)
                                        @if($product->category_id==$category['category_id'])
                                        <option value="{{ $category['category_id'] }}" selected>{{ $category['name'] }}</option>
                                        @endif
                                        <option value="{{ $category['category_id'] }}">{{ $category['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4 mb-3">
                                    <label for="sub_category_id" class="form-label">Sub Category ID</label>
                                    <select class="form-control text-capitalize" id="sub_category_id" name="ed_sub_category_id">
                                        <option value="">--Select product sub category--</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4 mb-3">
                                    <label for="supplier" class="form-label">Supplier</label>
                                    <select class="form-control text-capitalize" id="supplier" name="ed_supplier" required>
                                        <option value="">--Select Supplier--</option>
                                        @foreach($supliers as $suplier)
                                        @if($product->supplier==$suplier)
                                        <option value="{{ $suplier }}" selected>{{ $suplier }}</option>
                                        @endif
                                        <option value="{{ $suplier }}">{{ $suplier }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4 mb-3">
                                    <label for="image" class="form-label">Image URL</label>
                                    <input type="file" class="form-control" id="image" name="image">
                                </div>
                                <div class="form-group col-md-4 mb-3">
                                    <label for="SKU" class="form-label">SKU</label>
                                    <input type="text" class="form-control" placeholder="SKU" id="SKU" name="ed_SKU" value="{{ $product->SKU }}" required>
                                </div>
                                <div class="form-group col-md-4 mb-3">
                                    <label for="stock_quantity" class="form-label">Stock Quantity</label>
                                    <input type="number" class="form-control" placeholder="Stock Quantity" id="stock_quantity" name="ed_stock_quantity" value="{{ $product->stock_quantity }}" required>
                                </div>
                                <div class="form-group col-md-4 mb-3">
                                    <label for="buying_price" class="form-label">Unit Buying Price</label>
                                    <input type="number" step="0.01" class="form-control" placeholder="Unit Buying Price" id="buying_price" name="ed_buying_price" value="{{ $product->buying_price }}" required>
                                </div>
                                <div class="form-group col-md-4 mb-3">
                                    <label for="marked_price" class="form-label">Unit marked Price</label>
                                    <input type="number" step="0.01" class="form-control" placeholder="Unit marked Price" id="marked_price" name="ed_marked_price" value="{{ $product->marked_price }}" required>
                                </div>
                                <div class="form-group col-md-4 mb-3">
                                    <label for="status" class="form-label">status</label>
                                    <select class="form-control text-capitalize" id="status" name="ed_status" required>
                                        <option value="">--Select status--</option>
                                        @foreach($products_statuses as $products_status)
                                        @if($product->status==$products_status)
                                        <option value="{{ $products_status }}" selected>{{ $products_status }}</option>
                                        @endif
                                        <option value="{{ $products_status }}">{{ $products_status }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-muted">
                            <span class="text-capitalize badge bg-{{ $product->status == 'active' ? 'success' : ($product->status == 'discontinued' ? 'danger' : 'warning') }}">{{ $product->status }}</span>
                            Last updated: {{ $product->updated_at->format('Y-m-d H:i:s') }}
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-2">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header h5">
                            Description
                        </div>
                        <div class="card-body">
                            <textarea id="editor" name="ed_description">{{ $product->description }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
</section>
<!-- /.content -->

@push('script')
<script>
    $(document).ready(function() {

        // Form submission validation
        $("#update_product").validate({
            submitHandler: function(form, event) {
                event.preventDefault();
                swal.fire({
                    title: 'Update product',
                    text: 'Are you sure you want to update the product?',
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

        $("#delete_product").validate({
            submitHandler: function(form, event) {
                event.preventDefault();
                swal.fire({
                    title: 'Delete product',
                    text: 'Are you sure you want to delete the product?',
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

    });
</script>
@endpush

@else

@include('portal.no_permission')

@endif

@endsection