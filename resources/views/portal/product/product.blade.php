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
        <div class="row">
            <div class="col-md-12 mb-3">
                <a href="{{ route('product.add_product') }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus-circle"></i> Add New Product
                </a>
            </div>
            <div class="col-md-12 mb-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table m-0" id="product-table">
                                <thead class="text-capitalize text-nowrap">
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Buying Price</th>
                                        <th>Marked Price</th>
                                        <th>Quantity</th>
                                        <th>Supplier</th>
                                        <th>Status</th>
                                        <th style="width: 15%">Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/. container-fluid -->
</section>
<!-- /.content -->

@push('script')
<script>
    $(document).ready(function() {
        // Fetch data from database
        $('#product-table').DataTable({
            processing: true,
            serverSide: true,
            order: [
                [0, 'asc']
            ],
            ajax: "{{ route('product.product_data') }}",
            columns: [
                {
                    data: 'image_URL'
                },
                {
                    data: 'product_name'
                },
                {
                    data: 'buying_price'
                },
                {
                    data: 'marked_price'
                },
                {
                    data: 'stock_quantity'
                },
                {
                    data: 'supplier'
                },
                {
                    data: 'status'
                },
                {
                    data: 'action'
                },
            ]
        });
    });
</script>
@endpush

@else

@include('portal.no_permission')

@endif

@endsection