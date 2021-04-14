<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', $_theme_info['default_title'] ?? 'Cms') | {{ $_theme_info['system_name'] ?? 'klinson' }}</title>
    <meta name="description" content="@yield('description', $_theme_info['description'] ?? 'klinson个人站')" />
    <meta name="keyword" content="@yield('keyword', $_theme_info['keyword'] ?? 'klinson,cms')" />
    <meta name="author" content="@yield('keyword', $_theme_info['author'] ?? 'klinson')" />

    <link href="{{ asset($_theme_info['style_root_path'].'/css/bootstrap.css') }}" rel="stylesheet" type="text/css" media="all" />
    <link href="{{ asset($_theme_info['style_root_path'].'/css/style.css') }}" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" href="{{ asset($_theme_info['style_root_path'].'/css/flexslider.css') }}" type="text/css" media="screen" property="" />
    <!-- js -->
    <script type="text/javascript" src="{{ asset($_theme_info['style_root_path'].'/js/jquery-2.1.4.min.js') }}"></script>
    <!-- //js -->
    <!-- font-awesome icons -->
    <link href="{{ asset($_theme_info['style_root_path'].'/css/font-awesome.css') }}" rel="stylesheet" type="text/css" media="all" />
    <!-- //font-awesome icons -->
{{--    <link href='http://fonts.googleapis.com/css?family=Capriola' rel='stylesheet' type='text/css'>--}}
{{--    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>--}}

    <style>
        .left-float-ads {
            position: fixed;
            bottom: 20%;
            left: 20px;
            display: block;
            text-decoration: none;
            z-index: 9999;
        }
        .float-ads {
            position: fixed;
            bottom: 20%;
            right: 20px;
            display: block;
            text-decoration: none;
            z-index: 9999;
        }
        .float-ads-content {
            position: fixed;
            bottom: 70px;
            right: 70px;
            display: block;
            text-decoration: none;
            z-index: 9999;
        }
        .icon-btn {
            margin-top: 5px;
            border: 2px solid green;
            width: 100px;
        }
        .hidden-img {
            width: 240px;
        }
        .float-center-ads {
            position: fixed;
            top: 30%;
            right: 20px;
            display: block;
            text-decoration: none;
            z-index: 9999;
        }
        .ad-img {
            width: 300px;
        }
        .ad-info {
            margin-top: 0.5em;
        }
    </style>
    @yield('styles')
</head>

<body>
@include($_theme_info['view_root_path'].'.layouts._header')

@yield('header')

@include($_theme_info['view_root_path'].'.layouts._message')

@yield('content')

@include($_theme_info['view_root_path'].'.layouts._footer')

<!-- for bootstrap working -->
<script src="{{ asset($_theme_info['style_root_path'].'/js/bootstrap.js') }}"></script>
<!-- //for bootstrap working -->
<!-- start-smoth-scrolling -->
<script type="text/javascript" src="{{ asset($_theme_info['style_root_path'].'/js/move-top.js') }}"></script>
<script type="text/javascript" src="{{ asset($_theme_info['style_root_path'].'/js/easing.js') }}"></script>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $(".scroll").click(function(event){
            event.preventDefault();
            $('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
        });
    });
</script>
<!-- start-smoth-scrolling -->
<!-- here stars scrolling icon -->
<script type="text/javascript">
    $(document).ready(function() {
        /*
            var defaults = {
            containerID: 'toTop', // fading element id
            containerHoverID: 'toTopHover', // fading element hover id
            scrollSpeed: 1200,
            easingType: 'linear'
            };
        */

        $().UItoTop({ easingType: 'easeOutQuart' });

    });
</script>
<!-- //here ends scrolling icon -->

<!-- flexSlider -->
<script defer src="{{ asset($_theme_info['style_root_path'].'/js/jquery.flexslider.js') }}"></script>
<script type="text/javascript">
    $(window).load(function(){
        $('.flexslider').flexslider({
            animation: "slide",
            start: function(slider){
                $('body').removeClass('loading');
            }
        });
    });
</script>
<!-- //flexSlider -->
<!-- Scripts -->
@yield('scripts')
</body>
</html>