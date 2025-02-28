@extends('layouts.portal')

@section('content')

@if(Auth::user()->category=='admin')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="m-0">Catalogue</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Catalogue</li>
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
                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addCategory">
                    <i class="fas fa-plus-circle"></i> Add New Category
                </button>
            </div>
            <div class="col-md-12 mb-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table m-0" id="catalogue-table">
                                <thead class="text-capitalize text-nowrap">
                                    <tr>
                                        <th>Category ID</th>
                                        <th>Category Name</th>
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

{{-- //Start of modal --}}
<div class="modal fade" id="addCategory" tabindex="-1" aria-labelledby="addCategoryLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addCategoryLabel">Add Catalogue</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="store_catalogue" action="{{ route('catalogue.store_catalogue') }}" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        {{ csrf_field() }}
                    </div>
                    <div class="form-group">
                        <label class="form-label">Catalogue Name</label>
                        <input type="text" class="form-control" placeholder="Catalogue Name" aria-label="Catalogue Name" id="name" name="name" required />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                    <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editCategory" tabindex="-1" aria-labelledby="editCategoryLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editCategoryLabel">Edit Catalogue</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="update_catalogue" action="{{ route('catalogue.update_catalogue') }}" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        {{ csrf_field() }}
                    </div>
                    <div class="form-group">
                        <input type="hidden" id="ed_category_id" name="ed_category_id">
                        <label class="form-label">Catalogue Name</label>
                        <input type="text" class="form-control" placeholder="Catalogue Name" aria-label="Catalogue Name" id="ed_category_name" name="ed_category_name" required />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                    <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- //End of modal --}}

<form action="{{ route('catalogue.catalogue_delete') }}" method="post" id="delete_category_form">
    {{ csrf_field() }}
    <input type="hidden" name="delete_category_id" id="delete_category_id">
</form>

@push('script')
<script>
    $(document).ready(function() {
        // Fetch data from database
        $('#catalogue-table').DataTable({
            processing: true,
            serverSide: true,
            order: [
                [0, 'asc']
            ],
            ajax: "{{ route('catalogue.catalogue_data') }}",
            columns: [{
                    data: 'category_id'
                },
                {
                    data: 'name'
                },
                {
                    data: 'action'
                },
            ]
        });

        $('.dataTable').on('click', 'tbody td #edit_category', function() {
            var category_id = $(this).closest('tr').find('td:eq(0)').text();
            var category_name = $(this).closest('tr').find('td:eq(1)').text();
            $("#ed_category_id").val(category_id);
            $("#ed_category_name").val(category_name);
            $('#editCategory').modal('show');
        });

        // Form submission validation
        $("#store_catalogue").validate({
            submitHandler: function(form, event) {
                event.preventDefault();

                swal.fire({
                    title: 'Create Category',
                    text: 'Are you sure you want to create the category?',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            }
        });

        $("#update_catalogue").validate({
            submitHandler: function(form, event) {
                event.preventDefault();

                swal.fire({
                    title: 'Update Category',
                    text: 'Are you sure you want to update the category?',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            }
        });

        $('.dataTable').on('click', 'tbody td #delete_category', function() {
            var category_id = $(this).closest('tr').find('td:eq(2)').find('#delete_category').val();
            swal.fire({
                title: 'Delete category?',
                text: 'Are you sure you want to delete this category?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    $("#delete_category_id").val(category_id);
                    $('#delete_category_form').submit();
                }
            });
        });
    });
</script>
@endpush

@else

@include('portal.no_permission')

@endif

@endsection