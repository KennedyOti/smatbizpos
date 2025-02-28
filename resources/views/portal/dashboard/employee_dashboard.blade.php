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
            
        </div>
    </div>
</section>
<!-- /.content -->

@endsection