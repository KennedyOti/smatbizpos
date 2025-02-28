@extends('layouts.portal')

@section('content')

@if(Auth::user()->category=='admin')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <h4>System users management</h4>
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table m-0" id="users-table">
                                <thead class="text-capitalize text-nowrap">
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone number</th>
                                        <th>Category</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->

@push('script')
<script>
    $(document).ready(function() {
        // Fetch data from database
        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            order: [
                [0, 'asc']
            ],
            ajax: "{{ route('users.users_data') }}",
            columns: [{
                    data: 'id'
                },
                {
                    data: 'name'
                },
                {
                    data: 'email'
                },
                {
                    data: 'phone'
                },
                {
                    data: 'category'
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