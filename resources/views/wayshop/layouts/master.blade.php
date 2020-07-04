<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Site Metas -->
    <title>Shop</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{csrf_token()}}">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="{{asset('public/front_assets/images/favicon.ico')}}" type="image/x-icon">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('public/front_assets/css/bootstrap.min.css')}}">
    <!-- Site CSS -->
    <link rel="stylesheet" href="{{asset('public/front_assets/css/style.css')}}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{asset('public/front_assets/css/responsive.css')}}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{asset('public/front_assets/css/custom.css')}}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>

    @include('wayshop.layouts.header')
    @yield('content')
    @include('wayshop.layouts.footer')

    <a href="#" id="back-to-top" title="Back to top" style="display: none;">&uarr;</a>

    <!-- ALL JS FILES -->
    <script src="{{asset('public/front_assets/js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('public/front_assets/js/jquery-ui.js')}}"></script>
    <script src="{{asset('public/front_assets/js/popper.min.js')}}"></script>
    <script src="{{asset('public/front_assets/js/bootstrap.min.js')}}"></script>
    <!-- ALL PLUGINS -->
    <script src="{{asset('public/front_assets/js/jquery.superslides.min.js')}}"></script>
    <script src="{{asset('public/front_assets/js/bootstrap-select.js')}}"></script>
    <script src="{{asset('public/front_assets/js/inewsticker.js')}}"></script>
    <script src="{{asset('public/front_assets/js/bootsnav.js')}}"></script>
    <script src="{{asset('public/front_assets/js/images-loded.min.js')}}"></script>
    <script src="{{asset('public/front_assets/js/isotope.min.js')}}"></script>
    <script src="{{asset('public/front_assets/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('public/front_assets/js/baguetteBox.min.js')}}"></script>
    <script src="{{asset('public/front_assets/js/form-validator.min.js')}}"></script>
    <script src="{{asset('public/front_assets/js/contact-form-script.js')}}"></script>
    <script src="{{asset('public/front_assets/js/custom.js')}}"></script>
    <script>
        $(document).ready(function() {
            // change price
            $("#selSize").change(function() {
                $(".errorSize").html('');
                var idSize = $(this).val();
                if (idSize == "" || idSize == "0") {
                    return false;
                }
                $.ajax({
                    type: 'get',
                    url: '/get-product-price',
                    data: {idSize: idSize},
                    success: function(resp) {
                        var arr = resp.split('#');
                        $('#getPrice').html('Giá : ' + formatNumber(arr[0]) + ' đ');
                        $('#product_price').val(arr[0]);
                    },
                    error: function() {
                        alert('Error');
                    }
                });
            });

            $("#quantity").change(function() {
                $(".errorQuantity").html('');
            });

            // Shipping Address Same As Billing Address
            $("#billtoship").click(function() {
                if (this.checked) {
                    $("#shipping_name").val($("#billing_name").val());
                    $("#shipping_address").val($("#billing_address").val());
                    $("#shipping_city").val($("#billing_city").val());
                    $("#shipping_district").val($("#billing_district").val());
                    $("#shipping_country").val($("#billing_country").val());
                    $("#shipping_pincode").val($("#billing_pincode").val());
                    $("#shipping_mobile").val($("#billing_mobile").val());
                } else {
                    $("#shipping_name").val('');
                    $("#shipping_address").val('');
                    $("#shipping_city").val('');
                    $("#shipping_district").val('');
                    $("#shipping_country").val('');
                    $("#shipping_pincode").val('');
                    $("#shipping_mobile").val('');
                }
            });
        });

        function selectPaymentMethod() {
            if ($('.stripe').is(':checked') || $('.cod').is(':checked')) {
                // alert('checked');
            } else {
                alert('Vui lòng chọn phương thức thanh toán!');
                return false;
            }
        }

        // submit add to cart
        function submitAddtocart() {
            var size = $("#selSize").val();
            var quantity = $("#quantity").val();
            if (size == 0) {
                $(".errorSize").html('Vui lòng chọn size');
                return false;
            }

            if (quantity <= 0) {
                $(".errorQuantity").html('Vui lòng chọn số lượng');
                return false;
            }

            // ajax add to cart
            if (size != 0 && quantity != 0) {
                var product_id      = $('#product_id').val();
                var product_name    = $('#product_name').val();
                var product_color   = $('#product_color').val();
                var product_code    = $('#product_code').val();
                var product_price   = $('#product_price').val();
                var product_size   = $('#selSize').val();
                var total = $('#totalHeader').html();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'post',
                    url: '/add-cart',
                    data: {
                        product_id: product_id,
                        product_name: product_name,
                        product_color: product_color,
                        product_code: product_code,
                        product_price: product_price,
                        size: product_size,
                        quantity: quantity,
                    },
                    success: function(resp) {
                        var response = JSON.parse(resp);
                        if (response != 0) {
                            $('.badge').html(response.countCart);
                            $('.side').addClass('on');
                            // thêm sản phẩm vào header cart
                            var link = '{{url('/products/')}}' + '/' + product_id;
                            var product = `<li>
                                            <a href="#" class="photo"><img src="`+response.image.image+`" class="cart-thumb" alt="" /></a>
                                            <h6><a href="`+ link +`">` + product_name + `</a></h6>
                                            <p>` + quantity + ` - <span class="price">` + formatNumber(product_price) + ` đ</span></p>
                                        </li>`;
                            var cartHeader = $('.cart-list').html();
                            $('.cart-list').html(product + cartHeader);
                            // thay đổi tổng tiền trên header cart
                            var total = $('#totalHeader').html();
                            $('#totalHeader').html(formatNumber(parseInt(total.replace(',','')) + (product_price*quantity)))
                        }
                    },
                    error: function() {
                        alert('Error');
                    }
                });
            }
        }

        function formatNumber(num) {
            return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
        }
    </script>
</body>

</html>
