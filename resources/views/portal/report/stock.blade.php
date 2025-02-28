@extends('layouts.portal')

@section('content')

@if(Auth::user()->category=='admin')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="m-0">Reports</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">Reports</li>
                    <li class="breadcrumb-item active">Stock List</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 mb-3 text-end">
                <button type="button" class="btn btn-sm  btn-secondary" onclick="printDivContent('stock_list')">Print Stock List</button>
            </div>
            <div class="col-md-12" id="stock_list">
                <div class="card shadow-sm border-0">
                    <div class="card-header border-0 text-center">
                        <h4>STOCK LIST AS ON {{ date('D d/m/Y h:i A') }}</h4>
                        <h6>Report printed by: {{ ucwords(Auth::user()->name) }}</h6>
                        <hr class="border border-dark">
                    </div>
                    <div class="card-body pt-0">
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered text-capitalize">
                                <thead class="bg-light text-nowrap">
                                    <tr>
                                        <th>Category</th>
                                        <th>Sub Category</th>
                                        <th>Products</th>
                                        <th>Qty Balance</th>
                                        <th>Status</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($stock as $value)

                                    <tr>
                                        <td rowspan="{{ $value['cat_rowspan'] }}">{{ $value['name'] }}</td>
                                        @if(!(count($value['sub_categories'])>0))
                                        <td>--</td>
                                        <td>--</td>
                                        <td>--</td>
                                        <td>--</td>
                                        <td>--</td>
                                        @endif
                                    </tr>

                                    @foreach ($value['sub_categories'] as $sub_category)
                                    <tr>
                                        <td rowspan="{{ $sub_category['sub_rowspan'] }}">{{ $sub_category['sub_category_name'] }}</td>
                                        @if(!(count($sub_category['products'])>0))
                                        <td>--</td>
                                        <td>--</td>
                                        <td>--</td>
                                        <td>--</td>
                                        @endif
                                    </tr>

                                    @foreach ($sub_category['products'] as $product)
                                    <tr>
                                        <td>{{ $product->product_name }}</td>
                                        <td>{{ $product->remaining_stock }}</td>
                                        <td>
                                            <span class="badge bg-{{ $product->status == 'active' ? 'success' : ($product->status == 'discontinued' ? 'danger' : 'warning') }}">{{ $product->status }}</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-{{ $product->remaining_stock > 10 ? 'success' : ($product->remaining_stock == 0 ? 'danger' : 'warning') }}">
                                                {{ $product->remaining_stock > 10 ? 'Well stocked' : ($product->remaining_stock == 0 ? 'Out of stock' : 'Low quantity') }}
                                            </span>
                                        </td>
                                    </tr>
                                    @endforeach

                                    @endforeach

                                    @endforeach

                                </tbody>
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

    });
</script>
@endpush

@else

@include('portal.no_permission')

@endif

@endsection