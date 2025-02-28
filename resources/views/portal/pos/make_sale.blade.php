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
                    <li class="breadcrumb-item">
                        <a href="{{ route('pos.sales') }}">Point of Sale</a>
                    </li>
                    <li class="breadcrumb-item active">Make sale</li>
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

            <!-- Products search -->
            <div class="col-md-3 mb-3">
                <input type="search" id="search_product" class="form-control" placeholder="Product Code" list="searchList" autofocus>
                <datalist id="searchList">
                    @foreach ($productsIDs as $productId)
                    <option value="{{ $productId->product_id }}">
                        @endforeach
                </datalist>
            </div>

            <!-- listing -->
            <div class="col-md-12 mb-3">
                <form id="store_sale" action="{{ route('pos.store_sale') }}" method="post">
                    {{ csrf_field() }}
                    <div class="card border-0 shadow-sm">
                        <div class="card-header border-0 text-end pb-0">
                            <select name="payment_method" id="payment_method" class="form-control-sm">
                                <option value="">--Payment Method--</option>
                                <option value="cash" selected>Cash</option>
                                <option value="mpesa">Mpesa</option>
                            </select>
                            <hr class="border-dark">
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-sm table-striped table-hover table-borderless border m-0 align-middle">
                                    <thead class="bg-light">
                                        <tr>
                                            <th style="width: 15%;">#</th>
                                            <th style="width: 40%;">Name</th>
                                            <th style="width: 20%;">Quantity</th>
                                            <th style="width: 20%;">Price</th>
                                            <th style="width: 5%;"></th>
                                        </tr>
                                    </thead>
                                    <tbody class="cart-items">
                                        <tr>
                                            <td colspan="5" class="text-center py-5">
                                                <i class="fas fa-shopping-cart text-muted border p-4 rounded-circle fa-4x mb-3"></i>
                                                <h6>Your sales list is empty!</h6>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot class="bg-light">
                                        <tr>
                                            <th colspan="3" class="h5 fw-bold text-end">Total Billed: Ksh</th>
                                            <th colspan="2" class="h5 fw-bold"><span id="cart-total">0.00</span></th>
                                        </tr>
                                        <tr>
                                            <th colspan="3" class="h5 fw-bold text-end">Total Paid: Ksh</th>
                                            <th colspan="2" class="h5 fw-bold text-nowrap">
                                                <input type="number" id="cart-paid" name="amount_paid" class="form-input w-100 px-0 h5 m-0 fw-bolder rounded-0 border-0 bg-transparent" value="0.00" />
                                            </th>
                                        </tr>
                                        <tr>
                                            <th colspan="3" class="h5 fw-bold text-end">Total Balance: Ksh</th>
                                            <th colspan="2" class="h5 fw-bold"><span id="cart-balance">0.00</span></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent text-end receiptSubmit d-none pt-0">
                            <hr class="border-dark">
                            <button class="btn btn-sm btn-primary"><i class="fas fa-save"></i> Process & Save Receipt</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <!--/. container-fluid -->
</section>
<!-- /.content -->

<div class="modal fade" id="editCategory" tabindex="-1" aria-labelledby="editCategoryLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" id="addToCart" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card border-0 shadow-none rounded-0 h-100">
                                <div class="card-body p-1">
                                    <img src="" id="search_image_URL" alt="" style="max-width: 100%; max-height: 100%">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card border-0 shadow-none rounded-0 h-100">
                                <div class="card-body p-1">
                                    <input type="hidden" value="" id="search_product_id">
                                    <table class="table table-sm table-striped table-hover table-borderless">
                                        <tr>
                                            <th class="h5" colspan="2" id="search_product_name"></th>
                                        </tr>
                                        <tr>
                                            <th class="text-nowrap" style="width: 20%">Buying Price:</th>
                                            <td id="search_buying_price"></td>
                                        </tr>
                                        <tr>
                                            <th class="text-nowrap" style="width: 20%">Marked Price:</th>
                                            <td id="search_marked_price"></td>
                                        </tr>
                                        <tr>
                                            <th class="text-nowrap" style="width: 20%">Quantity Available:</th>
                                            <td id="search_remaining_stock"></td>
                                        </tr>
                                        <tr>
                                            <th class="text-nowrap" style="width: 20%">Your Quantity:</th>
                                            <td><input type="number" id="search_quantity" value="1" placeholder="Quantity" class="form-control form-control-sm" autofocus required></td>
                                        </tr>
                                        <tr>
                                            <th class="text-nowrap" style="width: 20%">Selling Price:</th>
                                            <td><input type="number" id="search_selling_price" placeholder="Selling Price" class="form-control form-control-sm" required></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-primary" id="add_to_cart"><i class="fas fa-plus-circle"></i> Add to sales list</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('script')
<script>
    $(document).ready(function() {

        $('#search_quantity').keyup(function() {
            var keyInQuantity = parseInt($(this).val());
            var exisistingQnty = parseInt($('#search_remaining_stock').html());

            if (keyInQuantity > exisistingQnty) {
                $('#search_quantity').val('');
                swal.fire({
                    title: 'Sale restriction',
                    text: 'You cannot sale more than the quantity available in the stock',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Okay'
                }).then((result) => {
                    $('#search_quantity').val('');
                });
            }
        });

        $("#store_sale").validate({
            submitHandler: function(form, event) {
                event.preventDefault();

                if ($('#cart-paid').val() > 0) {
                    swal.fire({
                        title: 'Sale Processing',
                        text: 'Are you sure you want to process and save the sale?',
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
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Kindly enter amount paid by customer, it cannot be 0!',
                        confirmButtonText: 'OK'
                    });
                }
            }
        });

        $('#search_product').keyup(function() {
            var product_id = $(this).val();
            $.ajax({
                type: "GET",
                url: "{{ route('pos.search_product') }}",
                data: {
                    product_id: product_id
                },
                cache: false,
                success: function(response) {
                    if (response.length > 3) {
                        var json = $.parseJSON(response);
                        if (parseFloat(json['remaining_stock']) > 0) {
                            $('#search_image_URL').attr('src', '/assets/images/products/' + json['image_URL']);
                            $('#search_product_name').html(json['product_name']);
                            $('#search_buying_price').html(json['buying_price']);
                            $('#search_marked_price').html(json['marked_price']);
                            $('#search_remaining_stock').html(json['remaining_stock']);
                            $('#search_product_id').val(json['product_id']);
                            $('#search_selling_price').val(json['marked_price']);
                            $('#editCategory').modal('show');
                        } else {
                            swal.fire({
                                title: json['product_name'],
                                text: 'Is out of stock hence you are not allowed to sale it anymore until its restocked!',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'Okay'
                            });
                        }
                    }
                }
            });
        });

        $('#cart-paid').keyup(function() {
            updateBalance();
        });

        function updateBalance() {
            var cart_total = parseFloat($('#cart-total').html());
            var cart_paid = $('#cart-paid').val();
            if (cart_paid > 0) {
                var cart_balance = cart_total - cart_paid;
            } else {
                var cart_balance = cart_total;
            }
            $('#cart-balance').html(cart_balance);
        }

        // Function to get cookie value by name
        function getCookie(name) {
            var value = "; " + document.cookie;
            var parts = value.split("; " + name + "=");
            if (parts.length == 2) return parts.pop().split(";").shift();
        }

        // Function to set cookie value
        function setCookie(name, value) {
            document.cookie = name + "=" + value + "; path=/";
        }

        // Function to add product to cart
        function addToCart(productIdToAdd, productName, productQuantity, productBuyingPrice, productSellingPrice, productImageUrl) {
            var cart = getCookie('cart');
            cart = cart ? JSON.parse(cart) : [];

            // Check if the product is already in the cart
            var existingItem = cart.find(item => item.productId == productIdToAdd);
            if (existingItem) {
                existingItem.productQuantity++;
            } else {
                cart.push({
                    productId: productIdToAdd,
                    productName: productName,
                    productQuantity: productQuantity,
                    productBuyingPrice: productBuyingPrice,
                    productSellingPrice: productSellingPrice,
                    productImageUrl: productImageUrl
                });
            }

            setCookie('cart', JSON.stringify(cart));

            updateCartUI();
        }

        // Function to remove product from cart
        function removeFromCart(productIdToRemove) {
            var cart = getCookie('cart');
            cart = cart ? JSON.parse(cart) : [];

            // Find the index of the product in the cart
            var index = cart.findIndex(item => item.productId == productIdToRemove);
            if (index !== -1) {
                // Remove the product from the cart array
                cart.splice(index, 1);
                setCookie('cart', JSON.stringify(cart));
            }

            updateCartUI();
        }

        // Function to update the cart UI
        function updateCartUI() {
            var cart = getCookie('cart');
            cart = cart ? JSON.parse(cart) : [];

            if (cart.length > 0) {
                var total = 0;
                var cartItemsHTML = '';

                cart.forEach(function(item) {
                    total += item.productSellingPrice * item.productQuantity;
                    cartItemsHTML += `<tr>
                                <td><img src="${item.productImageUrl}" alt="" style="max-width: 50px; max-height: 50px;"></td>
                                <td>${item.productName}</td>
                                <td>${item.productQuantity}</td>
                                <td>Ksh ${item.productSellingPrice}</td>
                                <td class="text-end"><button type="button" class="btn btn-sm btn-danger remove-item" data-id="${item.productId}">Remove</button></td>
                            </tr>`;
                });

                $('.cart-items').html(cartItemsHTML);
                $('#cart-total').text(total);
                $('.receiptSubmit').removeClass('d-none');

                // Add click event handler to remove buttons
                $('.remove-item').click(function() {
                    var productId = $(this).data('id');
                    removeFromCart(productId);
                });
            } else {
                $('.receiptSubmit').addClass('d-none');
            }

            updateBalance();
        }

        // Add click event handler to products
        $("#addToCart").validate({
            submitHandler: function(form, event) {
                event.preventDefault();
                var productIdToAdd = $('#search_product_id').val();
                var productName = $('#search_product_name').html();
                var productQuantity = $('#search_quantity').val();
                var productBuyingPrice = parseFloat($('#search_buying_price').html());
                var productSellingPrice = parseFloat($('#search_selling_price').val());
                var productImageUrl = $('#search_image_URL').attr('src');
                addToCart(productIdToAdd, productName, productQuantity, productBuyingPrice, productSellingPrice, productImageUrl);
                $('#editCategory').modal('hide');
            }
        });

        // Update cart UI on page load
        updateCartUI();

    });
</script>
@endpush
@endsection