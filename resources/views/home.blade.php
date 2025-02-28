@extends('layouts.app')

@section('content')

<!-- Featured Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5 pb-3">
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center border mb-4" style="padding: 30px">
                <h1 class="fa fa-check text-primary m-0 mr-3"></h1>
                <h5 class="font-weight-semi-bold m-0">Quality Product</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center border mb-4" style="padding: 30px">
                <h1 class="fa fa-shipping-fast text-primary m-0 mr-2"></h1>
                <h5 class="font-weight-semi-bold m-0">Free Shipping</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center border mb-4" style="padding: 30px">
                <h1 class="fas fa-exchange-alt text-primary m-0 mr-3"></h1>
                <h5 class="font-weight-semi-bold m-0">14-Day Return</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center border mb-4" style="padding: 30px">
                <h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1>
                <h5 class="font-weight-semi-bold m-0">24/7 Support</h5>
            </div>
        </div>
    </div>
</div>
<!-- Featured End -->

<!-- Categories Start -->
<div class="container-fluid pt-5" id="displayByCategory"></div>
<!-- Categories End -->

<!-- Offer Start -->
<div class="container-fluid offer pt-5">
    <div class="row px-xl-5">
        <div class="col-md-6 pb-4">
            <div class="position-relative bg-secondary text-center text-md-right text-white mb-2 py-5 px-5">
                <img src="{{ asset('assets/images/products/offer-1.png') }}" alt="" />
                <div class="position-relative" style="z-index: 1">
                    <h5 class="text-uppercase text-primary mb-3">
                        20% off the all order
                    </h5>
                    <h1 class="mb-4 font-weight-semi-bold">
                        Spring Collection
                    </h1>
                    <a href="" class="btn btn-outline-primary py-md-2 px-md-3">Shop Now</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 pb-4">
            <div class="position-relative bg-secondary text-center text-md-left text-white mb-2 py-5 px-5">
                <img src="{{ asset('assets/images/products/offer-2.png') }}" alt="" />
                <div class="position-relative" style="z-index: 1">
                    <h5 class="text-uppercase text-primary mb-3">
                        20% off the all order
                    </h5>
                    <h1 class="mb-4 font-weight-semi-bold">
                        Winter Collection
                    </h1>
                    <a href="" class="btn btn-outline-primary py-md-2 px-md-3">Shop Now</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Offer End -->

<!-- Products Start -->
<div class="container-fluid pt-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5">
            <span class="px-2">Trandy Products</span>
        </h2>
    </div>
    <div class="" id="tradyProducts"></div>
</div>
<!-- Products End -->

<!-- Subscribe Start -->
<div class="container-fluid bg-secondary my-5">
    <div class="row justify-content-md-center py-5 px-xl-5">
        <div class="col-md-6 col-12 py-5">
            <div class="text-center mb-2 pb-2">
                <h2 class="section-title px-5 mb-3">
                    <span class="bg-secondary px-2">Stay Updated</span>
                </h2>
                <p>
                    Get updates on new products immediately they are posted
                </p>
            </div>
            <form action="">
                <div class="input-group">
                    <input type="text" class="form-control border-white p-4" placeholder="Email Goes Here" />
                    <div class="input-group-append">
                        <button class="btn btn-primary px-4">
                            Subscribe
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Subscribe End -->

<!-- Products Start -->
<div class="container-fluid pt-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5">
            <span class="px-2">Just Arrived</span>
        </h2>
    </div>
    <div class="" id="latestProducts"></div>
</div>
<!-- Products End -->

<!-- Vendor Start -->
<div class="container-fluid py-5">
    <div class="row px-xl-5">
        <div class="col">
            <div class="owl-carousel vendor-carousel">
                <div class="vendor-item border p-4">
                    <img src="{{ asset('assets/images/others/vendor-1.jpg') }}" alt="" />
                </div>
                <div class="vendor-item border p-4">
                    <img src="{{ asset('assets/images/others/vendor-2.jpg') }}" alt="" />
                </div>
                <div class="vendor-item border p-4">
                    <img src="{{ asset('assets/images/others/vendor-3.jpg') }}" alt="" />
                </div>
                <div class="vendor-item border p-4">
                    <img src="{{ asset('assets/images/others/vendor-4.jpg') }}" alt="" />
                </div>
                <div class="vendor-item border p-4">
                    <img src="{{ asset('assets/images/others/vendor-5.jpg') }}" alt="" />
                </div>
                <div class="vendor-item border p-4">
                    <img src="{{ asset('assets/images/others/vendor-6.jpg') }}" alt="" />
                </div>
                <div class="vendor-item border p-4">
                    <img src="{{ asset('assets/images/others/vendor-7.jpg') }}" alt="" />
                </div>
                <div class="vendor-item border p-4">
                    <img src="{{ asset('assets/images/others/vendor-8.jpg') }}" alt="" />
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Vendor End -->

@endsection
@push('script')
<script>
    $(document).ready(function() {
        displayByCategory();
        tradyProducts();
        latestProducts();
    });

    function displayByCategory() {
        $.ajax({
            type: "GET",
            url: "{{ route('displayByCategory.info') }}",
            data: {},
            cache: false,
            success: function(response) {
                if (response.length > 3) {
                    var json = $.parseJSON(response);
                    html = '<div class="row px-xl-5 pb-3">';
                    $(json).each(function(i, val) {
                        html += '<div class="col-lg-4 col-md-6 pb-1">';
                        html += '<div class="cat-item d-flex flex-column border mb-4" style="padding: 30px">';
                        html += '<p class="text-right">' + val.count + ' Products</p>';
                        html += '<a href="" class="cat-img position-relative overflow-hidden mb-3">';
                        html += '<img class="img-fluid" src="/assets/images/products/' + val.product.image_URL + '" alt="" />';
                        html += '</a>';
                        html += '<h5 class="font-weight-semi-bold m-0 text-capitalize">' + val.sub_category_name + '</h5>';
                        html += '</div>';
                        html += '</div>';
                    });
                    html += '</div>';
                    $('#displayByCategory').html(html);
                }
            }
        });
    }

    function tradyProducts() {
        $.ajax({
            type: "GET",
            url: "{{ route('tradyProducts.info') }}",
            data: {},
            cache: false,
            success: function(response) {
                if (response.length > 3) {
                    var json = $.parseJSON(response);
                    html = '<div class="row px-xl-5 pb-3">';
                    $(json).each(function(i, val) {
                        var price = parseFloat(val.price);
                        var discount = parseFloat(price) * 0.1;
                        var delPrice = price + discount;
                        html += '<div class="col-lg-3 col-md-6 col-sm-12 pb-1">';
                        html += '<div class="card product-item border-0 mb-4">';
                        html += '<div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">';
                        html += '<img class="img-fluid w-100" src="/assets/images/products/' + val.image_URL + '" alt="" />';
                        html += '</div>';
                        html += '<div class="card-body border-left border-right text-center p-0 pt-4 pb-3">';
                        html += '<h6 class="text-truncate mb-3">C' + val.product_name + '</h6>';
                        html += '<div class="d-flex justify-content-center">';
                        html += '<h6>Ksh ' + price + '</h6>';
                        html += '<h6 class="text-muted ml-2">';
                        html += '<del>Ksh ' + delPrice + '</del>';
                        html += '</h6>';
                        html += '</div>';
                        html += '</div>';
                        html += '<div class="card-footer d-flex justify-content-between bg-light border">';
                        html += '<a href="/product_details/' + val.product_id + '" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>';
                        html += '<a href="https://wa.me/254796594366?text=Hello, I have been interested by ' + val.product_name + ', can i get more details about it for order?" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Order Now</a>';
                        html += '</div>';
                        html += '</div>';
                        html += '</div>';
                    });
                    html += '</div>';
                    $('#tradyProducts').html(html);
                }
            }
        });
    }

    function latestProducts() {
        $.ajax({
            type: "GET",
            url: "{{ route('latestProducts.info') }}",
            data: {},
            cache: false,
            success: function(response) {
                if (response.length > 3) {
                    var json = $.parseJSON(response);
                    html = '<div class="row px-xl-5 pb-3">';
                    $(json).each(function(i, val) {
                        var price = parseFloat(val.price);
                        var discount = parseFloat(price) * 0.1;
                        var delPrice = price + discount;
                        html += '<div class="col-lg-3 col-md-6 col-sm-12 pb-1">';
                        html += '<div class="card product-item border-0 mb-4">';
                        html += '<div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">';
                        html += '<img class="img-fluid w-100" src="/assets/images/products/' + val.image_URL + '" alt="" />';
                        html += '</div>';
                        html += '<div class="card-body border-left border-right text-center p-0 pt-4 pb-3">';
                        html += '<h6 class="text-truncate mb-3">C' + val.product_name + '</h6>';
                        html += '<div class="d-flex justify-content-center">';
                        html += '<h6>Ksh ' + price + '</h6>';
                        html += '<h6 class="text-muted ml-2">';
                        html += '<del>Ksh ' + delPrice + '</del>';
                        html += '</h6>';
                        html += '</div>';
                        html += '</div>';
                        html += '<div class="card-footer d-flex justify-content-between bg-light border">';
                        html += '<a href="/product_details/' + val.product_id + '" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>';
                        html += '<a href="https://wa.me/254796594366?text=Hello, I have been interested by ' + val.product_name + ', can i get more details about it for order?" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Order Now</a>';
                        html += '</div>';
                        html += '</div>';
                        html += '</div>';
                    });
                    html += '</div>';
                    $('#latestProducts').html(html);
                }
            }
        });
    }
</script>
@endpush