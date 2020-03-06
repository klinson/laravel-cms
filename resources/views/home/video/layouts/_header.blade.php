<!-- banner -->
<div class="@yield('header_class', 'banner1')">
    <div class="container">
        <nav class="navbar navbar-default">
            <div class="navbar-header navbar-left">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <h1><a class="navbar-brand" href="/">Mansion<span>Home for happy families</span></a></h1>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right" style="float: right !important;" id="bs-example-navbar-collapse-1">
                <nav class="link-effect-3" id="link-effect-3">
                    <ul class="nav navbar-nav">
                        @foreach($_navs as $item)
                            <li><a href="{{$item['url']}}" data-hover="Home" target="{{$item['target']}}">{{$item['title']}}</a></li>
                        @endforeach
                        @if (\Auth::check())
                            <li><a href="{{route('user')}}"><span style="border: 1px solid #ddd; padding: 0.5em">用户中心</span></a></li>
                        @else
                            <li><a href="{{route('login')}}"><span style="border: 1px solid #ddd; padding: 0.5em">登录</span></a></li>
                        @endif
                    </ul>
                </nav>
            </div>
        </nav>

{{--        <div class="w3l_banner_info">--}}
{{--            <section class="slider">--}}
{{--                <div class="flexslider">--}}
{{--                    <ul class="slides">--}}
{{--                        @foreach($_banners as $item)--}}
{{--                            <li>--}}
{{--                                <div class="wthree_banner_info_grid">--}}
{{--                                    <h3><a href="{{$item['url']}}"><span>{{$item['title']}}</span></a></h3>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                        @endforeach--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </section>--}}
{{--        </div>--}}
    </div>
</div>
<!-- //banner -->