<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <title>{{ config('app.name') }}</title>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">

    <!-- Font Awesome-->
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/assets/css/fontawesome.css">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/assets/css/vendors/icofont.css">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/assets/css/vendors/themify.css">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/assets/css/vendors/flag-icon.css">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/assets/css/vendors/feather-icon.css">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/assets/css/vendors/slick.css">
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/assets/css/vendors/slick-theme.css">
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/assets/css/vendors/scrollbar.css">
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/assets/css/vendors/animate.css">
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/assets/css/vendors/select.bootstrap5.css">
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/assets/css/vendors/select2.css">
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/assets/css/vendors/flatpickr/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/assets/css/vendors/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/assets/css/vendors/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/assets/css/vendors/dataTables.bootstrap5.css">
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/assets/css/vendors/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/assets/css/style.css">
    <link id="color" rel="stylesheet" href="{{ url('') }}/assets/css/color-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/assets/css/responsive.css">

    @yield('css-library')
    @yield('css-custom')
</head>

<body>
{{-- <body onload="startTime()"> --}}
    <!-- loader starts-->
    <div class="loader-wrapper">
        <div class="loader-index"> <span></span></div>
        <svg>
            <defs></defs>
            <filter id="goo">
            <fegaussianblur in="SourceGraphic" stddeviation="11" result="blur"></fegaussianblur>
            <fecolormatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo"> </fecolormatrix>
            </filter>
        </svg>
    </div>
    <!-- loader ends-->
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <!-- Page Header Start-->
        <div class="page-header">
            @include('layouts.header')
        </div>
        <!-- Page Header Ends -->
        <!-- Page Body Start -->
        <div class="page-body-wrapper">
            <!-- Page Sidebar Start-->
            @include('layouts.sidebar')
            <!-- Page Sidebar Ends-->
            @yield('content')

            @if (Auth::check())
                <div class="modal fade" id="edit-profile-modal" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content category-popup">
                            <div class="modal-header">
                                <h5 class="modal-title">Profile</h5>
                                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-0 custom-input">
                                <div class="text-start">
                                    <div class="p-20">
                                        <form id="edit-profile-form" class="row g-3 needs-validation" action="{{ route('profile.update', ['id' => Auth::user()->id]) }}" method="POST">
                                            @csrf

                                                <div class="col-md-12">
                                                    <label class="form-label fw-bold">Full Name</label>
                                                    <input class="form-control" type="text" value="{{ Auth::user()->name }}" disabled>
                                                </div>

                                                <div class="col-md-12">
                                                    <label class="form-label fw-bold">Email Address</label>
                                                    <input class="form-control" type="text" value="{{ Auth::user()->email }}" disabled>
                                                </div>

                                                <div class="mt-4 mb-4 row">
                                                    <div class="col-md-6">
                                                        <label class="form-label fw-bold">Old Password<span class="txt-danger">*</span></label>
                                                        <input class="form-control" type="password" name="password" placeholder="*********" required>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label fw-bold">New Password<span class="txt-danger">*</span></label>
                                                        <input class="form-control" type="password" name="password_new" placeholder="*********" required>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 d-flex justify-content-end">
                                                    <button class="btn btn-danger" id="edit-profile-submit" type="submit">Submit</button>
                                                </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @stack('modals-and-toasts')
            <!-- footer start-->
            <footer class="footer">
                @include('layouts.footer')
            </footer>
        </div>
    </div>
    <!-- latest jquery-->
    <script src="{{ url('') }}/assets/js/jquery.min.js"></script>
    <!-- Bootstrap js-->
    <script src="{{ url('') }}/assets/js/bootstrap/bootstrap.bundle.min.js"></script>
    <!-- feather icon js-->
    <script src="{{ url('') }}/assets/js/icons/feather-icon/feather.min.js"></script>
    <script src="{{ url('') }}/assets/js/icons/feather-icon/feather-icon.js"></script>
    <!-- scrollbar js-->
    <script src="{{ url('') }}/assets/js/scrollbar/simplebar.min.js"></script>
    <script src="{{ url('') }}/assets/js/scrollbar/custom.js"></script>
    <!-- Sidebar jquery-->
    <script src="{{ url('') }}/assets/js/config.js"></script>
    <!-- Plugins JS start-->
    <script src="{{ url('') }}/assets/js/swiper/swiper-bundle.min.js"></script>
    <script src="{{ url('') }}/assets/js/sidebar-pin.js"></script>
    <script src="{{ url('') }}/assets/js/slick/slick.min.js"></script>
    <script src="{{ url('') }}/assets/js/slick/slick.js"></script>
    <script src="{{ url('') }}/assets/js/header-slick.js"></script>
    <script src="{{ url('') }}/assets/js/counter/counter-custom.js"></script>
    <script src="{{ url('') }}/assets/js/notify/bootstrap-notify.min.js"></script>
    <script src="{{ url('') }}/assets/js/notify/index.js"></script>
    <script src="{{ url('') }}/assets/js/typeahead/handlebars.js"></script>
    <script src="{{ url('') }}/assets/js/typeahead/typeahead.bundle.js"></script>
    <script src="{{ url('') }}/assets/js/typeahead/typeahead.custom.js"></script>
    <script src="{{ url('') }}/assets/js/typeahead-search/handlebars.js"></script>
    <script src="{{ url('') }}/assets/js/typeahead-search/typeahead-custom.js"></script>
    <script src="{{ url('') }}/assets/js/flat-pickr/flatpickr.js"></script>
    <script src="{{ url('') }}/assets/js/flat-pickr/custom-flatpickr.js"></script>
    <script src="{{ url('') }}/assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ url('') }}/assets/js/datatable/datatables/dataTables1.js"></script>
    <script src="{{ url('') }}/assets/js/datatable/datatables/dataTables.bootstrap5.js"></script>
    <script src="{{ url('') }}/assets/js/datatable/datatables/datatable.custom2.js"></script>
    <script src="{{ url('') }}/assets/js/counter/custom-counter1.js"></script>
    <script src="{{ url('') }}/assets/js/tooltip-init.js"></script>
    <script src="{{ url('') }}/assets/js/select2/select2.full.min.js"></script>
    <!-- maps JS start-->
    <script src="{{ url('') }}/assets/js/gmap.js"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="{{ url('') }}/assets/js/script.js"></script>
    <script src="{{ url('') }}/assets/js/script1.js"></script>
    <!-- Sweetalert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function submitForm(form, button) {
            button.prop('disabled', true);
            const url = form.attr('action');
            const data = new FormData(form[0]);
            $.ajax({
                url: url,
                method: "POST",
                data: data,
                contentType: false,
                processData: false,
                timeout: 3000,
                error: function(xmlhttprequest, textstatus, message) {
                    var res = (textstatus === "timeout") ? "Request timeout!" : textstatus;
                    Swal.fire({
                        title: "Error",
                        html: res,
                        icon: "warning"
                    }).then(function() {
                        button.prop('disabled', false);
                    });
                },
                success: function(response) {
                    let alert_text = "";
                    if ($.isArray(response.message)) {
                        $.each(response.message, function(i, message) {
                            alert_text += message + "<br>";
                        });
                    } else if (typeof response.message === 'object') {
                        $.each(response.message, function(key, messages) {
                            alert_text += messages[0] + "<br>";
                        });
                    } else {
                        alert_text = response.message;
                    }

                    if (response.status == true) {
                        Swal.fire({
                            title: "Success",
                            text: response.message,
                            icon: "success",
                            timer: 1500
                        }).then(function() {
                            if (response.url) {
                                window.location.href = response.url;
                            }
                        });
                    } else {
                        Swal.fire({
                            title: "Error",
                            html: alert_text,
                            icon: "warning"
                        }).then(function() {
                            button.prop('disabled', false);
                        });
                    }
                }
            });
        }
    </script>\

    @if (Auth::check())
        <script>
            $(document).ready(function() {
            $('#edit-profile-form').on('submit', function(e) {
                e.preventDefault();
                submitForm($(this), $('#edit-profile-submit'));
            });
        });
        </script>
    @endif

    @yield('js-library')
    @yield('js-custom')
</body>

</html>
