@extends('layouts.portal')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <h4>User profile management</h4>
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form method="POST" id="user_update" action="{{ route('users.user_update') }}">
                    @csrf
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="row">
                                <input type="hidden" name="update_id" value="{{ $user_info->id }}">
                                <div class="col-md-3 text-center">
                                    <img id="previewImage" src="{{ asset('assets/images/profiles/'.$user_info->passport) }}" alt="" class="p-1 bg-white shadow-sm rounded-circle" style="max-width: 100%; max-height: 150px;">
                                    <hr>
                                    <label for="file-upload" class="custom-file-upload small">
                                        <i class="fas fa-cloud-upload-alt"></i> Choose Photo
                                    </label>
                                    <input id="file-upload" type="file" accept="" class="d-none" />
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group mb-2">
                                        <label for="name" class="col-form-label text-md-end">{{ __('Name') }}</label>
                                        <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user_info->name }}" placeholder="Name" required />
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="phone" class="col-form-label text-md-end">{{ __('Phone') }}</label>
                                        <input id="phone" type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $user_info->phone }}" placeholder="Phone" required />
                                        @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-2">
                                                <label for="category" class="col-form-label text-md-end">{{ __('Category/Role') }}</label>
                                                @if(Auth::user()->category=="admin")
                                                <select class="form-control @error('category') is-invalid @enderror" name="category">
                                                    @foreach ($user_categories as $category)
                                                    @if($category==$user_info->category)
                                                    <option value="{{ $category }}" selected>{{ ucwords($category) }}</option>
                                                    @else
                                                    <option value="{{ $category }}">{{ ucwords($category) }}</option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                                @else
                                                <input type="text" class="form-control @error('category') is-invalid @enderror" name="category" value="{{ $user_info->category }}" readonly />
                                                @endif
                                                @error('category')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary text-white">
                                            <i class="fas fa-save"></i> {{ __('Save Changes') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</section>
<!-- /.content -->

@push('script')
<script>
    $(document).ready(function() {

        $("#user_update").validate({
            submitHandler: function(form, event) {
                event.preventDefault();
                swal.fire({
                    title: 'Update Profile Information',
                    text: 'Are you sure you want to update your profile information?',
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
    });
</script>
@endpush
@endsection