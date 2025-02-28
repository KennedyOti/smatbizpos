@extends('layouts.portal')

@section('content')

@if(Auth::user()->category=='admin')

<style>
    /* th,
    td {
        padding: 2px !important;
    } */

    td {
        cursor: pointer;
    }
</style>

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
                    <li class="breadcrumb-item active">Sales</li>
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

            <div class="col-md-12 mb-3">
                <ul class="list-group list-group-horizontal-md">
                    <li class="list-group-item border-0 p-1">
                        <input type="text" name="daterange" id="daterange" value="{{ $startDate }} - {{ $endDate }}" />
                    </li>
                </ul>
            </div>

            <div class="col-md-12 mb-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm table-borderless m-0 h6" id="arithmeticsTable"></table>
                        </div>
                    </div>
                </div>
                <div class="card border-0 rounded-0 shadow-sm">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm" id="sales-table">
                                <thead class="text-capitalize bg-light text-nowrap text-capitalize">
                                    <tr>
                                        <th>date</th>
                                        <th>invoice no</th>
                                        <th>customer</th>
                                        <th>count</th>
                                        <th>total amount</th>
                                        <th>amount paid</th>
                                        <th>balance</th>
                                    </tr>
                                </thead>
                                <tbody id="sales-table-data">
                                    <!-- table data -->
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
                    url: '{{ route("report.sales_data") }}',
                    data: function(d) {
                        d.startDate = startDate;
                        d.endDate = endDate;
                    }
                },
                columns: [{
                        data: 'date'
                    },
                    {
                        data: 'ref_no'
                    },
                    {
                        data: 'customer'
                    },
                    {
                        data: 'item_count'
                    },
                    {
                        data: 'sale_amount'
                    },
                    {
                        data: 'amount_paid'
                    },
                    {
                        data: 'balance'
                    }
                ],
                createdRow: function(row, data, dataIndex) {
                    $(row).find('td:eq(0)').attr('data-url', '/report/sales_details/' + data.sale_id);
                }
            });

            $.ajax({
                type: "GET",
                url: "{{ route('report.sales_arithmetics') }}",
                data: {
                    startDate: startDate,
                    endDate: endDate
                },
                cache: false,
                success: function(response) {
                    if (response.length > 3) {
                        var json = $.parseJSON(response);
                        html = '<tbody><tr>';
                        $(json).each(function(i, val) {
                            $.each(val, function(key, value) {
                                html += `<th>Total ${key}:</th><td>Ksh ${value}</td>`;
                            });
                        });
                        html += '</tr></tbody>';
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

        $('.dataTable').on('click', 'tbody tr', function() {
            var url = $(this).closest('tr').find('td:eq(0)').attr('data-url');
            window.location = url;
            return false;
        });

    });
</script>
@endpush

@else

@include('portal.no_permission')

@endif

@endsection