<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', $_theme_info['default_title'] ?? 'Cms') | {{ $_theme_info['system_name'] ?? 'klinson' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('description', $_theme_info['description'] ?? 'klinson个人站')" />
    <meta name="keyword" content="@yield('keyword', $_theme_info['keyword'] ?? 'klinson,cms')" />
    <meta name="author" content="@yield('keyword', $_theme_info['author'] ?? 'klinson')" />

    <link href="https://fonts.proxy.ustclug.org/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
    <!--
    CSS
    ============================================= -->
    <link rel="stylesheet" href="{{ asset($_theme_info['style_root_path'].'/css/linearicons.css') }}">
    <link rel="stylesheet" href="{{ asset($_theme_info['style_root_path'].'/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset($_theme_info['style_root_path'].'/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset($_theme_info['style_root_path'].'/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset($_theme_info['style_root_path'].'/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset($_theme_info['style_root_path'].'/css/main.css') }}">

    @yield('styles')
</head>

<body>
<!-- start banner Area -->
<section class="@yield('header-class', 'generic-banner relative')" id="home" style="@yield('header-bg', '')">
    @include($_theme_info['view_root_path'].'.layouts._header')

    @yield('header')
</section>

@yield('content')

@include($_theme_info['view_root_path'].'.layouts._footer')


<script src="{{ asset($_theme_info['style_root_path'].'/js/vendor/jquery-2.2.4.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="{{ asset($_theme_info['style_root_path'].'/js/vendor/bootstrap.min.js') }}"></script>
<script src="{{ asset($_theme_info['style_root_path'].'/js/jquery.ajaxchimp.min.js') }}"></script>
<script src="{{ asset($_theme_info['style_root_path'].'/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset($_theme_info['style_root_path'].'/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset($_theme_info['style_root_path'].'/js/jquery.sticky.js') }}"></script>
<script src="{{ asset($_theme_info['style_root_path'].'/js/slick.js') }}"></script>
<script src="{{ asset($_theme_info['style_root_path'].'/js/jquery.counterup.min.js') }}"></script>
<script src="{{ asset($_theme_info['style_root_path'].'/js/waypoints.min.js') }}"></script>
<script src="{{ asset($_theme_info['style_root_path'].'/js/main.js') }}"></script>

<!-- 百度统计 -->
<script src="{{ asset('/js/statistics.baidu.js') }}"></script>

<!-- Scripts -->
@yield('scripts')
</body>
</html>