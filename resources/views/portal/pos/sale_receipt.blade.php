@extends('layouts.portal')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="m-0">Point of Sale</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('pos.sales') }}">Point of Sale</a>
                    </li>
                    <li class="breadcrumb-item">Receipt</li>
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
                <div class="card border-0 rounded-0 shadow-sm">
                    <div class="card-header border-0 text-end">
                        <button type="button" class="btn btn-sm  btn-secondary" onclick="printDivContent('sales_receipt')">Print Receipt</button>
                    </div>
                    <div class="card-body bg-dark" style="height: 400px; overflow-y:scroll">

                        <div class="col-md-7 mx-auto" id="sales_receipt">
                            <div class="card text-dark border-0 rounded-0 shadow-none">
                                <div class="card-header border-0 h2 text-center">
                                    <img src="{{ asset('logo.png') }}" alt="company logo" style="max-width: 100px; max-height: 100px;" class="mb-3">
                                    <h5>Smart Business Solutions</h5>
                                    <h6>P.O BOX 02</h6>
                                    <h6 class="mb-2 text-muted">Nairobi</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <p class="p-0 m-0"><strong>Transaction #:</strong> {{ $receipt_info->ref_no }}</p>
                                            <p class="p-0 m-0"><strong>Date:</strong> {{ date('d/m/Y',strtotime($receipt_info->created_at)) }}</p>
                                            <p class="p-0 m-0"><strong>Cashier:</strong> {{ $receipt_info->created_by }}</p>
                                        </div>
                                        <div class="col text-right">
                                            <p class="p-0 m-0"><strong>Customer:</strong> Null</p>
                                            <p class="p-0 m-0"><strong>Time:</strong> {{ date('h:i:s A',strtotime($receipt_info->created_at)) }}</p>
                                            <p class="p-0 m-0"><strong>Payment Mode:</strong> {{ $receipt_info->payment_method }}</p>
                                        </div>
                                    </div>
                                    <table class="table table-sm table-borderless">
                                        <thead>
                                            <tr>
                                                <th class="px-0">
                                                    Item
                                                    <div class="col-md-12 mb-1 p-0 hrSeparator"></div>
                                                    <div class="col-md-12 m-0 p-0 hrSeparator"></div>
                                                </th>
                                                <th class="">
                                                    Qty
                                                    <div class="col-md-12 mb-1 p-0 hrSeparator"></div>
                                                    <div class="col-md-12 m-0 p-0 hrSeparator"></div>
                                                </th>
                                                <th class="">
                                                    Each
                                                    <div class="col-md-12 mb-1 p-0 hrSeparator"></div>
                                                    <div class="col-md-12 m-0 p-0 hrSeparator"></div>
                                                </th>
                                                <th class="px-0 text-end">
                                                    Total
                                                    <div class="col-md-12 mb-1 p-0 hrSeparator"></div>
                                                    <div class="col-md-12 m-0 p-0 hrSeparator"></div>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($receipt_items as $item)
                                            <tr>
                                                <td class="px-0">{{ $item->product_name }}</td>
                                                <td class="">{{ $item->product_quantity }}</td>
                                                <td class="">{{ number_format($item->product_amount,2) }}</td>
                                                <td class="px-0 text-end">{{ number_format(($item->product_amount * $item->product_quantity),2) }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td class="px-0 text-nowrap text-end" colspan="3"></td>
                                                <td class="px-0 text-nowrap text-end">
                                                    <div class="col-md-12 mb-1 p-0 hrSeparator"></div>
                                                    <div class="col-md-12 m-0 p-0 hrSeparator"></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="px-0 text-nowrap text-end" colspan="3"><strong>Total Billed:</strong></td>
                                                <td class="px-0 text-nowrap text-end"><strong>{{ number_format($receipt_info->sale_amount,2) }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="px-0 text-nowrap text-end" colspan="3"><strong>Total Paid:</strong></td>
                                                <td class="px-0 text-nowrap text-end"><strong>{{ number_format($receipt_info->amount_paid,2) }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="px-0 text-nowrap text-end" colspan="3"><strong>Balance:</strong></td>
                                                <td class="px-0 text-nowrap text-end"><strong>{{ number_format(($receipt_info->sale_amount-$receipt_info->amount_paid),2) }}</strong></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <div class="card-text text-center">
                                        <div class="col-md-12 mb-1 p-0 hrSeparator"></div>
                                        <div class="col-md-12 mb-2 p-0 hrSeparator"></div>
                                        <p>Thank you for your business!</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!--/. container-fluid -->
</section>
<!-- /.content -->

@endsection