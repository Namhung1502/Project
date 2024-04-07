<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Home | E-Shopper</title>
    <link href="{{asset('frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/main.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/responsive.css')}}" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="{{asset('frontend/css/rate.css')}}">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="{{asset('frontend/images/ico/favicon.ico')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('frontend/images/ico/apple-touch-icon-144-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('frontendimages/ico/apple-touch-icon-114-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('frontendimages/ico/apple-touch-icon-72-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{asset('frontend/images/ico/apple-touch-icon-57-precomposed.png')}}">

    <script src="{{asset('frontend/js/jquery.js')}}"></script>
    <script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
</head><!--/head-->
<body>
    @php
        $routeName = request()->route()->getName();
        // dd($routeName);
    @endphp
    <!-- ============================================================== -->
    <!-- Topbar Header - style you can find in page.scss  -->
    <!-- ============================================================== -->
    @include('frontend.layouts.header')

    <!-- ============================================================== -->
    <!-- Topbar Slide - style you can find in page.scss  -->
    <!-- ============================================================== -->
    @if($routeName == 'cart')
                    {{-- Ẩn tất cả menu --}}
    @else
    @include('frontend.layouts.slide')
    @endif

    @if($routeName == 'cart')
        @yield('content')
    @else
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                <!-- ============================================================== -->
                <!-- Left Menu- style you can find in page.scss  -->
                @if($routeName == 'account')
                @include('frontend.layouts.menu-left-account')
                @else
                @include('frontend.layouts.menu-left')
                @endif
                </div>
                <!-- ============================================================== -->
                <!-- Page Wrapper  -->
                <div class="col-sm-9 padding-right">
                @yield('content')
                <!-- ============================================================== -->
                <!-- End Page wrapper  -->
                <!-- ============================================================== -->
                </div>
            </div>
        </div>
    </section>
    @endif
    <!-- ============================================================== -->
    <!-- Footer - style you can find in page.scss  -->
    <!-- ============================================================== -->
    @include('frontend.layouts.footer')



    <script src="{{asset('frontend/js/jquery.scrollUp.min.js')}}"></script>
    <script src="{{asset('frontend/js/price-range.js')}}"></script>
    <script src="{{asset('frontend/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('frontend/js/main.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.btn-search').click(function(){
                var word = $(this).closest('div.search_box').find('input').val();

            });
        });
    </script>
</body>
</html>
