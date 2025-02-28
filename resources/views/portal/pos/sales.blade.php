@extends('layouts.portal')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="m-0">Point of Sale</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Point of Sale
                    </li>
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
                <a href="{{ route('pos.make_sale') }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus-circle"></i> Make new sale
                </a>
            </div>
            <div class="col-md-12 mb-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table m-0" id="sales_table">
                                <thead class="text-capitalize text-nowrap">
                                    <tr>
                                        <th># ID</th>
                                        <th>Payment Method</th>
                                        <th>Sale Amount</th>
                                        <th>Amount Paid</th>
                                        <th>Made By</th>
                                        <th>Date</th>
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

<form action="{{ route('pos.delete') }}" method="post" id="del_sale_form">
    {{ csrf_field() }}
    <input type="hidden" name="del_sale_id" id="del_sale_id">
</form>

@push('script')
<script>
    $(document).ready(function() {
        // Fetch data from database
        $('#sales_table').DataTable({
            processing: true,
            serverSide: true,
            order: [
                [0, 'asc']
            ],
            ajax: "{{ route('pos.sale_data') }}",
            columns: [{
                    data: 'ref_no'
                },
                {
                    data: 'payment_method'
                },
                {
                    data: 'sale_amount'
                },
                {
                    data: 'amount_paid'
                },
                {
                    data: 'created_by'
                },
                {
                    data: 'created_at'
                },
                {
                    data: 'action'
                },
            ]
        });

        $('.dataTable').on('click', 'tbody td #del_sale', function() {
            var sale_id = $(this).closest('tr').find('td:eq(6)').find('#del_sale').val();
            swal.fire({
                title: 'Are you sure?',
                text: 'Do you want to delete this sale record?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    $("#del_sale_id").val(sale_id);
                    $('#del_sale_form').submit();
                }
            });
        });
    });
</script>
@endpush
@endsection