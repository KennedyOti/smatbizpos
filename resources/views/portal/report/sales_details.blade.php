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
                    <li class="breadcrumb-item active">Sales Details</li>
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

            <div class="col-md-8 mb-3">
                <ul class="list-group list-group-horizontal-md">
                    <li class="list-group-item border-0 p-1">
                        <input type="text" name="daterange" id="daterange" value="{{ $startDate }} - {{ $endDate }}" />
                    </li>
                </ul>
            </div>

            <div class="col-md-4 mb-3 text-end">
                <table class="table table-sm table-borderless m-0 h6" id="arithmeticsTable"></table>
            </div>

            <div class="col-md-12 mb-3">
                <div class="card border-0 rounded-0 shadow-sm">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm" id="sales-table">
                                <thead class="text-capitalize bg-light text-nowrap">
                                    <tr>
                                        <th>DATE</th>
                                        <th>ITEM NO</th>
                                        <th>ITEM NAME</th>
                                        <th>PRICE</th>
                                        <th>QTY</th>
                                        <th>AMOUNT</th>
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

        fetchData('{{ $startDate }}', '{{ $endDate }}');

        $(function() {
            $('input[name="daterange"]').daterangepicker({
                opens: 'right'
            }, function(start, end, label) {
                fetchData(formatDate(start), formatDate(end));
            });
        });

        // Fetch data from database
        function fetchData(startDate, endDate) {
            $('#sales-table').DataTable({
                bDestroy: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("report.sales_details_data") }}',
                    data: function(d) {
                        d.sale_id = '{{ $sale_id }}';
                        d.startDate = startDate;
                        d.endDate = endDate;
                    }
                },
                columns: [{
                        data: 'date'
                    },
                    {
                        data: 'product_id'
                    },
                    {
                        data: 'product_name'
                    },
                    {
                        data: 'product_buying_price'
                    },
                    {
                        data: 'product_quantity'
                    },
                    {
                        data: 'product_amount'
                    }
                ]
            });

            $.ajax({
                type: "GET",
                url: "{{ route('report.sales_details_arithmetics') }}",
                data: {
                    sale_id: '{{ $sale_id }}',
                    startDate: startDate,
                    endDate: endDate
                },
                cache: false,
                success: function(response) {
                    if (response.length > 3) {
                        var json = $.parseJSON(response);
                        html = '<tbody>';
                        $(json).each(function(i, val) {
                            $.each(val, function(key, value) {
                                html += `<tr><th>Total ${key}:</th><td>Ksh ${value}</td></tr>`;
                            });
                        });
                        html += '</tbody>';
                        $('#arithmeticsTable').html(html);
                    }
                }
            });
        }

        function formatDate(date) {
            var d = new Date(date),
                month = '' + (d.getMonth() + 1),
                day = '' + d.getDate(),
                year = d.getFullYear();

            if (month.length < 2)
                month = '0' + month;
            if (day.length < 2)
                day = '0' + day;

            return [year, month, day].join('-');
        }
    });
</script>
@endpush

@else

@include('portal.no_permission')

@endif

@endsection