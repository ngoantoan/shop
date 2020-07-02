<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title') - Way Shop</title>
        <meta name="csrf-token" content="{{csrf_token()}}">
        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="{{asset('public/admin_assets/dist/img/ico/favicon.png')}}" type="image/x-icon">
        <!-- Start Global Mandatory Style
            =====================================================================-->
        <!-- jquery-ui css -->
        <link href="{{asset('public/admin_assets/plugins/jquery-ui-1.12.1/jquery-ui.min.css')}}" rel="stylesheet" type="text/css"/>
        <!-- Bootstrap -->
        <link href="{{asset('public/admin_assets/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
        <!-- Bootstrap rtl -->
        <!--<link href="assets/bootstrap-rtl/bootstrap-rtl.min.css" rel="stylesheet" type="text/css"/>-->
        <!-- Lobipanel css -->
        <link href="{{asset('public/admin_assets/plugins/lobipanel/lobipanel.min.css')}}" rel="stylesheet" type="text/css"/>
        <!-- Pace css -->
        <link href="{{asset('public/admin_assets/plugins/pace/flash.css')}}" rel="stylesheet" type="text/css"/>
        <!-- Font Awesome -->
        <link href="{{asset('public/admin_assets/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css"/>
        <!-- Pe-icon -->
        <link href="{{asset('public/admin_assets/pe-icon-7-stroke/css/pe-icon-7-stroke.css')}}" rel="stylesheet" type="text/css"/>
        <!-- Themify icons -->
        <link href="{{asset('public/admin_assets/themify-icons/themify-icons.css')}}" rel="stylesheet" type="text/css"/>
        <!-- End Global Mandatory Style
            =====================================================================-->
        <!-- Start page Label Plugins
            =====================================================================-->
        <!-- Emojionearea -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
        <link href="{{asset('public/admin_assets/plugins/emojionearea/emojionearea.min.css')}}" rel="stylesheet" type="text/css"/>
        <!-- Monthly css -->
        <link href="{{asset('public/admin_assets/plugins/monthly/monthly.css')}}" rel="stylesheet" type="text/css"/>
        <!-- End page Label Plugins
            =====================================================================-->
        <!-- Start Theme Layout Style
            =====================================================================-->
        <!-- Theme style -->
        <link href="{{asset('public/admin_assets/dist/css/stylecrm.css')}}" rel="stylesheet" type="text/css"/>
        <!-- Theme style rtl -->
        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <!-- jquery-ui -->
        <script src="{{asset('public/admin_assets/plugins/jquery-ui-1.12.1/jquery-ui.min.js')}}" type="text/javascript"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="{{asset('public/ckeditor/ckeditor.js')}}"></script>
        <script src="{{asset('public/ckfinder/ckfinder.js')}}"></script>
    </head>
    <body class="hold-transition sidebar-mini">
        <!--preloader-->
        <div id="preloader">
            <div id="status"></div>
        </div>
        <!-- Site wrapper -->
        <div class="wrapper">

            @include('admin.layouts.header')

            @include('admin.layouts.sidebar')

            @yield('content')

            @include('admin.layouts.footer')

        </div>

        <script>
            $( function() {
                $( "#datepicker" ).datepicker({
                    minDate: 0,
                    dateFormat: 'yy-mm-dd'
                });
            } );
        </script>
        <!-- Bootstrap -->
        <script src="{{asset('public/admin_assets/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
        <!-- lobipanel -->
        <script src="{{asset('public/admin_assets/plugins/lobipanel/lobipanel.min.js')}}" type="text/javascript"></script>
        <!-- Pace js -->
        <script src="{{asset('public/admin_assets/plugins/pace/pace.min.js')}}" type="text/javascript"></script>
        <!-- SlimScroll -->
        <script src="{{asset('public/admin_assets/plugins/slimScroll/jquery.slimscroll.min.js')}}" type="text/javascript">    </script>
        <!-- FastClick -->
        <script src="{{asset('public/admin_assets/plugins/fastclick/fastclick.min.js')}}" type="text/javascript"></script>
        <!-- CRMadmin frame -->
        <script src="{{asset('public/admin_assets/dist/js/custom.js')}}" type="text/javascript"></script>
        <!-- End Core Plugins
            =====================================================================-->
        <!-- Start Page Lavel Plugins
            =====================================================================-->
        <!-- ChartJs JavaScript -->
        <script src="{{asset('public/admin_assets/plugins/chartJs/Chart.min.js')}}" type="text/javascript"></script>
        <!-- Counter js -->
        <script src="{{asset('public/admin_assets/plugins/counterup/waypoints.js')}}" type="text/javascript"></script>
        <script src="{{asset('public/admin_assets/plugins/counterup/jquery.counterup.min.js')}}" type="text/javascript"></script>
        <!-- Monthly js -->
        <script src="{{asset('public/admin_assets/plugins/monthly/monthly.js')}}" type="text/javascript"></script>
        <!-- End Page Lavel Plugins
            =====================================================================-->
        <!-- Start Theme label Script
            =====================================================================-->
        <!-- Dashboard js -->
        <script src="{{asset('public/admin_assets/dist/js/dashboard.js')}}" type="text/javascript"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
        <script>
            $(document).ready( function () {
                $('#table_id').DataTable({
                    "paging":false
                });
                $(this).closest('td').attr('id');
                // ajax update product status
                $(".ProductStatus").change(function() {
                    var id = $(this).attr('rel');
                    if ($(this).prop("checked") == true) {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type:  'post',
                            url: '/admin/update-product-status',
                            data: {status: '1', id: id},
                            success: function(resp) {
                                $("#message_success").show();
                                setTimeout(function() { $("#message_success").fadeOut('slow'); }, 2000)
                            },
                            error: function() {
                                alert("Error");
                            }
                        });
                    } else {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type:  'post',
                            url: '/admin/update-product-status',
                            data: {status: '0', id: id},
                            success: function(resp) {
                                $("#message_error").show();
                                setTimeout(function() { $("#message_error").fadeOut('slow'); }, 3000)
                            },
                            error: function() {
                                alert("Error");
                            }
                        });
                    }
                });

                // ajax update category status
                $(".CategoryStatus").change(function() {
                    var id = $(this).attr('rel');
                    if ($(this).prop("checked") == true) {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type:  'post',
                            url: '/admin/update-category-status',
                            data: {status: '1', id: id},
                            success: function(resp) {
                                $("#message_success").show();
                                setTimeout(function() { $("#message_success").fadeOut('slow'); }, 2000)
                            },
                            error: function() {
                                alert("Error");
                            }
                        });
                    } else {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type:  'post',
                            url: '/admin/update-category-status',
                            data: {status: '0', id: id},
                            success: function(resp) {
                                $("#message_error").show();
                                setTimeout(function() { $("#message_error").fadeOut('slow'); }, 3000)
                            },
                            error: function() {
                                alert("Error");
                            }
                        });
                    }
                });

                // ajax update banner status
                $(".BannerStatus").change(function() {
                    var id = $(this).attr('rel');
                    if ($(this).prop("checked") == true) {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type:  'post',
                            url: '/admin/update-banner-status',
                            data: {status: '1', id: id},
                            success: function(resp) {
                                $("#message_success").show();
                                setTimeout(function() { $("#message_success").fadeOut('slow'); }, 2000)
                            },
                            error: function() {
                                alert("Error");
                            }
                        });
                    } else {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type:  'post',
                            url: '/admin/update-banner-status',
                            data: {status: '0', id: id},
                            success: function(resp) {
                                $("#message_error").show();
                                setTimeout(function() { $("#message_error").fadeOut('slow'); }, 3000)
                            },
                            error: function() {
                                alert("Error");
                            }
                        });
                    }
                });

                // ajax update coupon status
                $(".CouponStatus").change(function() {
                    var id = $(this).attr('rel');
                    if ($(this).prop("checked") == true) {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type:  'post',
                            url: '/admin/update-coupon-status',
                            data: {status: '1', id: id},
                            success: function(resp) {
                                $("#message_success").show();
                                setTimeout(function() { $("#message_success").fadeOut('slow'); }, 2000)
                            },
                            error: function() {
                                alert("Error");
                            }
                        });
                    } else {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type:  'post',
                            url: '/admin/update-coupon-status',
                            data: {status: '0', id: id},
                            success: function(resp) {
                                $("#message_error").show();
                                setTimeout(function() { $("#message_error").fadeOut('slow'); }, 3000)
                            },
                            error: function() {
                                alert("Error");
                            }
                        });
                    }
                });

                // ajax update featured products
                $(".FeaturedStatus").change(function() {
                    var id = $(this).attr('rel');
                    if ($(this).prop("checked") == true) {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type:  'post',
                            url: '/admin/update-featured-product',
                            data: {featured_products: '1', id: id},
                            success: function(resp) {
                                $("#message_success").show();
                                setTimeout(function() { $("#message_success").fadeOut('slow'); }, 2000)
                            },
                            error: function() {
                                alert("Error");
                            }
                        });
                    } else {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type:  'post',
                            url: '/admin/update-featured-product',
                            data: {featured_products: '0', id: id},
                            success: function(resp) {
                                $("#message_error").show();
                                setTimeout(function() { $("#message_error").fadeOut('slow'); }, 3000)
                            },
                            error: function() {
                                alert("Error");
                            }
                        });
                    }
                });
            });

            // Add Remove Fields Dynamically
            $(document).ready(function(){
                var maxField = 10; //Input fields increment limitation
                var addButton = $('.add_button'); //Add button selector
                var wrapper = $('.field_wrapper'); //Input field wrapper
                var fieldHTML = '<div style="display:flex;"><input type="text" name="sku[]" id="sku" placeholder="SKU" class="form-control" style="width: 120px;margin-right:5px;margin-top:5px;"/><input type="text" name="size[]" id="size" placeholder="Size" class="form-control" style="width: 120px;margin-right:5px;margin-top:5px;"/><input type="text" name="price[]" id="price" placeholder="Price" class="form-control" style="width: 120px;margin-right:5px;margin-top:5px;"/><input type="text" name="stock[]" id="stock" placeholder="Stock" class="form-control" style="width: 120px;margin-right:5px;margin-top:5px;"/><a href="javascript:void(0);" class="remove_button">Remove</a></div>'; //New input field html
                var x = 1; //Initial field counter is 1

                //Once add button is clicked
                $(addButton).click(function(){
                    //Check maximum number of input fields
                    if(x < maxField){
                        x++; //Increment field counter
                        $(wrapper).append(fieldHTML); //Add field html
                    }
                });

                //Once remove button is clicked
                $(wrapper).on('click', '.remove_button', function(e){
                    e.preventDefault();
                    $(this).parent('div').remove(); //Remove field html
                    x--; //Decrement field counter
                });
            });

            function selectFileWithCKFinder( elementId ) {
                CKFinder.modal( {
                    chooseFiles: true,
                    width: 800,
                    height: 600,
                    onInit: function( finder ) {
                        finder.on( 'files:choose', function( evt ) {
                            var file = evt.data.files.first();
                            var output = document.getElementById( elementId );
                            output.value = file.getUrl();
                        } );

                        finder.on( 'file:choose:resizedImage', function( evt ) {
                            var output = document.getElementById( elementId );
                            output.value = evt.data.resizedUrl;
                        } );
                    }
                } );
            }
        </script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/css/bootstrap-toggle.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/js/bootstrap-toggle.js"></script>
        @include('sweetalert::alert')
    </body>

</html>

