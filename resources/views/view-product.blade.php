@extends('layouts.app')

@section('content')

<!-- Shop Detail Start -->
<div class="container-fluid py-5">
    <div class="row px-xl-5">
        <div class="col-lg-5 pb-5">
            <div id="product-carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner border">
                    <div class="carousel-item active">
                        <img class="w-100 h-100" src="/assets/images/products/{{ $product->image_URL }}" alt="Image">
                    </div>
                    <div class="carousel-item">
                        <img class="w-100 h-100" src="/assets/images/products/{{ $product->image_URL }}" alt="Image">
                    </div>
                    <div class="carousel-item">
                        <img class="w-100 h-100" src="/assets/images/products/{{ $product->image_URL }}" alt="Image">
                    </div>
                    <div class="carousel-item">
                        <img class="w-100 h-100" src="/assets/images/products/{{ $product->image_URL }}" alt="Image">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                    <i class="fa fa-2x fa-angle-left text-dark"></i>
                </a>
                <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                    <i class="fa fa-2x fa-angle-right text-dark"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-7 pb-5">
            <form action="" method="post" id="make_order">
                <h3 class="font-weight-semi-bold">{{ ucfirst($product->product_name) }}</h3>
                <div class="d-flex mb-3">
                    <div class="text-primary mr-2">
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star-half-alt"></small>
                        <small class="far fa-star"></small>
                    </div>
                    <small class="pt-1">({{ $product->views }} Reviews)</small>
                </div>
                <h3 class="font-weight-semi-bold mb-4">Ksh {{ number_format($product->price,2) }}</h3>
                <p class="mb-4"></p>
                <div class="d-flex mb-3">
                    <p class="text-dark font-weight-medium mb-0 mr-3">Sizes:</p>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" id="size-1" name="size">
                        <label class="custom-control-label" for="size-1">XS</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" id="size-2" name="size">
                        <label class="custom-control-label" for="size-2">S</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" id="size-3" name="size">
                        <label class="custom-control-label" for="size-3">M</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" id="size-4" name="size">
                        <label class="custom-control-label" for="size-4">L</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" id="size-5" name="size">
                        <label class="custom-control-label" for="size-5">XL</label>
                    </div>
                </div>
                <div class="d-flex mb-4">
                    <p class="text-dark font-weight-medium mb-0 mr-3">Colors:</p>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" id="color-1" name="color">
                        <label class="custom-control-label" for="color-1">Black</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" id="color-2" name="color">
                        <label class="custom-control-label" for="color-2">White</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" id="color-3" name="color">
                        <label class="custom-control-label" for="color-3">Red</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" id="color-4" name="color">
                        <label class="custom-control-label" for="color-4">Blue</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" id="color-5" name="color">
                        <label class="custom-control-label" for="color-5">Green</label>
                    </div>
                </div>
                <div class="d-flex align-items-center mb-4 pt-2">
                    <div class="input-group quantity mr-3" style="width: 130px;">
                        <div class="input-group-btn">
                            <button class="btn btn-primary btn-minus">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <input type="text" class="form-control bg-secondary text-center" value="1">
                        <div class="input-group-btn">
                            <button class="btn btn-primary btn-plus">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary px-3"><i class="fa fa-shopping-cart mr-1"></i> Add To Cart</button>
                </div>
                <div class="d-flex pt-2">
                    <p class="text-dark font-weight-medium mb-0 mr-2">Share on:</p>
                    <div class="d-inline-flex">
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-pinterest"></i>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row px-xl-5">
        <div class="col-lg-12">
            <textarea id="editor">{{ $product->description }}</textarea>
        </div>
    </div>
</div>
<!-- Shop Detail End -->

@endsection
@push('script')
<script>
    $(document).ready(function() {
        $('#make_order').submit(function(event) {
            event.preventDefault(); // Prevent the form from submitting via the browser
            var formData = $(this).serialize();

            // $(this).find('input').each(function() {
            //     alert($(this).attr('name'));
            // });
        });
    });
</script>
@endpush