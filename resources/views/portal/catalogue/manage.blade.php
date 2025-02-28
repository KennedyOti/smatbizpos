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
                    <li class="breadcrumb-item">
                        <a href="{{ route('catalogue.info') }}">Catalogue</a>
                    </li>
                    <li class="breadcrumb-item active">Manage</li>
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
            <div class="col-md-9 mb-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-header text-uppercase">
                        managing <strong>{{ $manage_category->name }}</strong> category
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn btn-sm btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addCategory">
                            <i class="fas fa-plus-circle"></i> Add Sub Category
                        </button>

                        <div class="table-responsive">
                            <table class="table m-0" id="sub-categories-table">
                                <thead class="text-capitalize text-nowrap">
                                    <tr>
                                        <th>Sub Category ID</th>
                                        <th>Sub Category Name</th>
                                        <th style="width: 15%">Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <ul class="list-group shadow-sm border-0">
                    <li class="list-group-item border-0 bg-light">OTHER CATEGORIES</li>
                    @foreach ($menu as $category)
                    <li class="list-group-item border-0 mt-1">
                        <a href="{{ route('catalogue.manage', $category['category_id']) }}" class="d-block text-capitalize">{{ $category['name'] }} <span class="badge rounded-pill bg-primary float-end">{{ count($category['sub_categories']) }} Groups</span></a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->

{{-- //Start of modal --}}
<div class="modal fade" id="addCategory" tabindex="-1" aria-labelledby="addCategoryLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addCategoryLabel">Add Sub Catalogue</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="store_sub_category" action="{{ route('catalogue.store_sub_category') }}" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        {{ csrf_field() }}
                    </div>
                    <div class="form-group">
                        <input type="hidden" id="category_id" name="category_id" value="{{ $manage_category->category_id }}">
                        <label class="form-label">Sub Catalogue Name</label>
                        <input type="text" class="form-control" placeholder="Sub Catalogue Name" aria-label="Catalogue Name" id="sub_category_name" name="sub_category_name" required />
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

<form action="{{ route('catalogue.sub_category_delete',[$manage_category->category_id]) }}" method="post" id="delete_sub_category_form">
    {{ csrf_field() }}
    <input type="hidden" name="delete_sub_category_id" id="delete_sub_category_id">
</form>

@push('script')
<script>
    $(document).ready(function() {
        // Fetch data from database
        $('#sub-categories-table').DataTable({
            processing: true,
            serverSide: true,
            order: [
                [0, 'asc']
            ],
            ajax: "{{ route('catalogue.getSubCategories', $manage_category->category_id) }}",
            columns: [{
                    data: 'sub_category_id'
                }, {
                    data: 'sub_category_name'
                },
                {
                    data: 'action'
                },
            ]
        });

        // Form submission validation
        $("#store_sub_category").validate({
            submitHandler: function(form, event) {
                event.preventDefault();
                swal.fire({
                    title: 'Create Sub Category',
                    text: 'Are you sure you want to create the sub category?',
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

        $('.dataTable').on('click', 'tbody td #delete_sub_category', function() {
            var category_id = $(this).closest('tr').find('td:eq(2)').find('#delete_sub_category').val();
            swal.fire({
                title: 'Delete sub category?',
                text: 'Are you sure you want to delete this sub category?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    $("#delete_sub_category_id").val(category_id);
                    $('#delete_sub_category_form').submit();
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