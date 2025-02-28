@extends('layouts.portal')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1 class="m-0 text-capitalize">Welcome, {{ Auth::user()->name }}</h1>
            </div>
            <!-- /.col -->
        </div>
    </div>
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-3 mb-3">
                <a href="{{ route('users.info') }}">
                    <div class="info-box h-100 shadow-sm border-0 mb-3">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Users</span>
                            <span class="info-box-number">
                                {{ number_format(count($users)) }}
                            </span>
                        </div>
                    </div>
                </a>
            </div>
            <!-- /.col -->
            <div class="col-md-3 mb-3">
                <a href="{{ route('catalogue.info') }}">
                    <div class="info-box h-100 shadow-sm border-0 mb-3">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-shopping-cart"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Categories</span>
                            <span class="info-box-number">{{ number_format(count($categories)) }}</span>
                        </div>
                    </div>
                </a>
            </div>
            <!-- /.col -->
            <div class="col-md-3 mb-3">
                <a href="{{ route('product.info') }}">
                    <div class="info-box h-100 shadow-sm border-0 mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-tag"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Products</span>
                            <span class="info-box-number">{{ number_format(count($products)) }}</span>
                        </div>
                    </div>
                </a>
            </div>
            <!-- /.col -->
            <div class="col-md-3 mb-3">
                <div class="info-box h-100 shadow-sm border-0 mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-wallet"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Customers</span>
                        <span class="info-box-number">0</span>
                    </div>
                </div>
            </div>
            <!-- /.col -->


            <div class="col-md-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3 col-6">
                                <div class="description-block border-right">
                                    <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i> 0%</span>
                                    <h5 class="description-header">Ksh {{ number_format($totalPaid,2) }}</h5>
                                    <span class="description-text">TOTAL REVENUE</span>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-3 col-6">
                                <div class="description-block border-right">
                                    <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i> 0%</span>
                                    <h5 class="description-header">Ksh {{ number_format($totalBilled,2) }}</h5>
                                    <span class="description-text">TOTAL COST</span>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-3 col-6">
                                <div class="description-block border-right">
                                    <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i> 0%</span>
                                    <h5 class="description-header">Ksh {{ number_format(($totalPaid-$totalBilled),2) }}</h5>
                                    <span class="description-text">TOTAL PROFIT</span>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-3 col-6">
                                <div class="description-block">
                                    <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i> 0%</span>
                                    <h5 class="description-header">0</h5>
                                    <span class="description-text">GOAL COMPLETIONS</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- /.content -->

@endsection