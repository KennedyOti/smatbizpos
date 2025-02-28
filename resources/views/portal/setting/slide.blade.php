@extends('layouts.portal')

@section('content')

@if(Auth::user()->category=='admin')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="m-0">Settings</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">Settings</li>
                    <li class="breadcrumb-item active">Slides Management</li>
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

            <div class="col-md-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        This page is currently being updated, the content will be available once complet
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