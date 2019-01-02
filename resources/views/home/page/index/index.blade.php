@extends($_theme_info['view_root_path'].'.layouts.app')

@section('styles')
    <style>
        .has-error {
            outline: none;
            border: 1px solid #eb6b55;
        }
    </style>
@endsection

@section('header-class') banner-area @endsection

@section('content')
    <section class="default-banner active-blog-slider">
        @foreach ($carouselAdItems as $item)
            <div class="item-slider relative" style="background: url({{ $item['picture'] }});background-size: cover;">
                <div class="overlay" style="background: rgba(0,0,0,.3)"></div>
                <div class="container">
                    <div class="row fullscreen justify-content-center align-items-center">
                        <div class="col-md-10 col-12">
                            <div class="banner-content text-center">
                                <h1 class="text-uppercase text-white">{{ $item['title'] }}</h1>

                                <a href="{{ $item['url'] }}" class="text-uppercase header-btn">点我查看</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        @endforeach
    </section>

    <!-- Start about Area -->
    <section class="section-gap info-area" id="about">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="menu-content pb-40 col-lg-8">
                    <div class="title text-center">
                        <h1 class="mb-10">Why Choose Us Your Fitness Builder</h1>
                        <p>Who are in extremely love with eco friendly system.</p>
                    </div>
                </div>
            </div>
            <div class="single-info row mt-40">
                <div class="col-lg-6 col-md-12 mt-120 text-center no-padding info-left">
                    <div class="info-thumb">
                        <img src="{{$_theme_info['style_root_path'].'/img/about-img.jpg' }}" class="img-fluid" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 no-padding info-rigth">
                    <div class="info-content">
                        <h2 class="pb-30">We Realize that <br>
                            there are reduced <br>
                            Wastege Stand out</h2>
                        <p>
                            inappropriate behavior is often laughed off as “boys will be boys,” women face higher conduct standards – especially in the workplace. That’s why it’s crucial that, as women.
                        </p>
                        <br>
                        <p>
                            inappropriate behavior is often laughed off as “boys will be boys,” women face higher conduct standards – especially in the workplace. That’s why it’s crucial that, as women. inappropriate behavior is often laughed off as “boys will be boys,” women face higher conduct standards – especially in the workplace. That’s why it’s crucial that, as women.
                        </p>
                        <br>
                        <p>
                            inappropriate behavior is often laughed off as “boys will be boys,” women face higher conduct standards – especially in the workplace. That’s why it’s crucial that, as women.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End about Area -->


    <!-- Start project Area -->
    <section class="project-area section-gap" id="project">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="menu-content pb-30 col-lg-8">
                    <div class="title text-center">
                        <h1 class="mb-10">Latest Project on the go</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut <br> labore  et dolore magna aliqua.</p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center d-flex">
                <div class="active-works-carousel mt-40 col-lg-8">
                    <div class="item">
                        <img class="img-fluid" src="{{$_theme_info['style_root_path'].'/img/why.jpg' }}" alt="">
                        <div class="caption text-center mt-20">
                            <h6 class="text-uppercase">Vector Illustration</h6>
                            <p>LCD screens are uniquely modern in style, and the liquid crystals that make them work have <br> allowed humanity to create slimmer, more portable technology.</p>
                        </div>
                    </div>
                    <div class="item">
                        <img class="img-fluid" src="{{$_theme_info['style_root_path'].'/img/why.jpg' }}" alt="">
                        <div class="caption text-center mt-20">
                            <h6 class="text-uppercase">Vector Illustration</h6>
                            <p>LCD screens are uniquely modern in style, and the liquid crystals that make them work have <br> allowed humanity to create slimmer, more portable technology.</p>
                        </div>
                    </div>
                    <div class="item">
                        <img class="img-fluid" src="{{$_theme_info['style_root_path'].'/img/why.jpg' }}" alt="">
                        <div class="caption text-center mt-20">
                            <h6 class="text-uppercase">Vector Illustration</h6>
                            <p>LCD screens are uniquely modern in style, and the liquid crystals that make them work have <br> allowed humanity to create slimmer, more portable technology.</p>
                        </div>
                    </div>
                    <div class="item">
                        <img class="img-fluid" src="{{$_theme_info['style_root_path'].'/img/why.jpg' }}" alt="">
                        <div class="caption text-center mt-20">
                            <h6 class="text-uppercase">Vector Illustration</h6>
                            <p>LCD screens are uniquely modern in style, and the liquid crystals that make them work have <br> allowed humanity to create slimmer, more portable technology.</p>
                        </div>
                    </div>
                    <div class="item">
                        <img class="img-fluid" src="{{$_theme_info['style_root_path'].'/img/why.jpg' }}" alt="">
                        <div class="caption text-center mt-20">
                            <h6 class="text-uppercase">Vector Illustration</h6>
                            <p>LCD screens are uniquely modern in style, and the liquid crystals that make them work have <br> allowed humanity to create slimmer, more portable technology.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End project Area -->


    <!-- Start feature Area -->
    <section class="feature-area section-gap" id="secvice">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="menu-content pb-60 col-lg-8">
                    <div class="title text-center">
                        <h1 class="mb-10">Some Features that Made us Unique</h1>
                        <p>Who are in extremely love with eco friendly system.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 ">
                    <div class="single-feature mb-30">
                        <div class="title d-flex flex-row pb-20">
                            <span class="lnr lnr-user"></span>
                            <h4><a href="#">Expert Technicians</a></h4>
                        </div>
                        <p>
                            Usage of the Internet is becoming more common due to rapid advancement of technology and power.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 ">
                    <div class="single-feature mb-30">
                        <div class="title d-flex flex-row pb-20">
                            <span class="lnr lnr-license"></span>
                            <h4><a href="#">Professional Service</a></h4>
                        </div>
                        <p>
                            Usage of the Internet is becoming more common due to rapid advancement of technology and power.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 ">
                    <div class="single-feature mb-30">
                        <div class="title d-flex flex-row pb-20">
                            <span class="lnr lnr-phone"></span>
                            <h4><a href="#">Great Support</a></h4>
                        </div>
                        <p>
                            Usage of the Internet is becoming more common due to rapid advancement of technology and power.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 ">
                    <div class="single-feature">
                        <div class="title d-flex flex-row pb-20">
                            <span class="lnr lnr-rocket"></span>
                            <h4><a href="#">Technical Skills</a></h4>
                        </div>
                        <p>
                            Usage of the Internet is becoming more common due to rapid advancement of technology and power.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 ">
                    <div class="single-feature">
                        <div class="title d-flex flex-row pb-20">
                            <span class="lnr lnr-diamond"></span>
                            <h4><a href="#">Highly Recomended</a></h4>
                        </div>
                        <p>
                            Usage of the Internet is becoming more common due to rapid advancement of technology and power.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 ">
                    <div class="single-feature">
                        <div class="title d-flex flex-row pb-20">
                            <span class="lnr lnr-bubble"></span>
                            <h4><a href="#">Positive Reviews</a></h4>
                        </div>
                        <p>
                            Usage of the Internet is becoming more common due to rapid advancement of technology and power.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End feature Area -->
    <div class="tlinks">Collect from <a href="http://www.cssmoban.com/" >企业网站模板</a></div>

    <!-- Start gallery Area -->
    <section class="gallery-area" id="gallery">
        <div class="container-fluid">
            <div class="row no-padding">
                <div class="active-gallery">
                    <div class="item single-gallery">
                        <img src="{{$_theme_info['style_root_path'].'/img/g1.jpg' }}" alt="">
                    </div>
                    <div class="item single-gallery">
                        <img src="{{$_theme_info['style_root_path'].'/img/g2.jpg' }}" alt="">
                    </div>
                    <div class="item single-gallery">
                        <img src="{{$_theme_info['style_root_path'].'/img/g3.jpg' }}" alt="">
                    </div>
                    <div class="item single-gallery">
                        <img src="{{$_theme_info['style_root_path'].'/img/g4.jpg' }}" alt="">
                    </div>
                    <div class="item single-gallery">
                        <img src="{{$_theme_info['style_root_path'].'/img/g5.jpg' }}" alt="">
                    </div>
                    <div class="item single-gallery">
                        <img src="{{$_theme_info['style_root_path'].'/img/g6.jpg' }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End gallery Area -->


    <!-- Start faq Area -->
    <section class="faq-area section-gap" id="faq">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="menu-content pb-60 col-lg-8">
                    <div class="title text-center">
                        <h1 class="mb-10">Frequently Asked Questions</h1>
                        <p>Who are in extremely love with eco friendly system.</p>
                    </div>
                </div>
            </div>
            <div class="row d-flex align-items-center">
                <div class="counter-left col-lg-3 col-md-3">
                    <div class="single-facts">
                        <h2 class="counter">5962</h2>
                        <p>Projects Completed</p>
                    </div>
                    <div class="single-facts">
                        <h2 class="counter">2394</h2>
                        <p>New Projects</p>
                    </div>
                    <div class="single-facts">
                        <h2 class="counter">1439</h2>
                        <p>Tickets Submitted</p>
                    </div>
                    <div class="single-facts">
                        <h2 class="counter">933</h2>
                        <p>Cup of Coffee</p>
                    </div>
                </div>
                <div class="faq-content col-lg-9 col-md-9">
                    <div class="single-faq">
                        <h2 class="text-uppercase">
                            Are your Templates responsive?
                        </h2>
                        <p>
                            “Few would argue that, despite the advancements of feminism over the past three decades, women still face a double standard when it comes to their behavior. While men’s borderline-inappropriate behavior.
                        </p>
                    </div>
                    <div class="single-faq">
                        <h2 class="text-uppercase">
                            Does it have all the plugin as mentioned?
                        </h2>
                        <p>
                            “Few would argue that, despite the advancements of feminism over the past three decades, women still face a double standard when it comes to their behavior. While men’s borderline-inappropriate behavior.
                        </p>
                    </div>
                    <div class="single-faq">
                        <h2 class="text-uppercase">
                            Can i use the these theme for my client?
                        </h2>
                        <p>
                            “Few would argue that, despite the advancements of feminism over the past three decades, women still face a double standard when it comes to their behavior. While men’s borderline-inappropriate behavior.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End faq Area -->


    <!-- Start Video Area -->
    <section class="video-area pt-40 pb-40">
        <div class="overlay overlay-bg"></div>
        <div class="container">
            <div class="video-content">
                <a href="http://www.youtube.com/watch?v=0O2aH4XLbto" class="play-btn"><img src="{{$_theme_info['style_root_path'].'/img/play-btn.jpg' }}" alt=""></a>
                <div class="video-desc">
                    <h3 class="h2 text-white text-uppercase">Being unique is the preference</h3>
                    <h4 class="text-white">Youtube video will appear in popover</h4>
                </div>
            </div>
        </div>
    </section>
    <!-- Start Video Area -->


    <!-- Start logo Area -->
    <section class="logo-area">
        <div class="container">
            <div class="row">

            </div>
        </div>
    </section>
    <!-- End logo Area -->


    <!-- start contact Area -->
    <section class="contact-area section-gap" id="contact">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="menu-content pb-60 col-lg-8">
                    <div class="title text-center">
                        <h1 class="mb-10">联系我们</h1>
                        {{--<p>Who are in extremely love with eco friendly system.</p>--}}
                    </div>
                </div>
            </div>
            @if (Session::has('success'))
                <div class="col-mb-12">
                    <blockquote class="generic-blockquote" style="border-left: 2px solid #73fbaf;">
                        {{ Session::get('success') }}
                    </blockquote>
                </div>
            @endif
            @if (Session::has('error'))
                <div class="col-mb-12">
                    <blockquote class="generic-blockquote" style="border-left: 2px solid #f44a40;">
                        {{ Session::get('error') }}
                    </blockquote>
                </div>
            @endif
            <form class="form-area" id="myForm"  action="{{ route('system.contactUs.store') }}" method="post" class="contact-form text-right">
                <div class="row">
                    <div class="col-lg-6 form-group">
                        <input type="text" id="name" name="name" class="common-input mb-20 form-control {{$errors->has('name')?'has-error':''}}" placeholder="请输入您的姓名" value="{{ old('name') }}" required>
                        @if($errors->has('name'))
                            <div class="col-md-12">
                                <p class="text-danger text-left"><strong>{{$errors->first('name')}}</strong></p>
                            </div>
                        @endif

                        <input type="text" id="email" name="email" class="common-input mb-20 form-control {{$errors->has('email')?'has-error':''}}" placeholder="请输入您常用的邮箱地址" value="{{ old('email') }}" required>
                        @if($errors->has('email'))
                            <div class="col-md-12">
                                <p class="text-danger text-left"><strong>{{$errors->first('email')}}</strong></p>
                            </div>
                        @endif

                        <input type="text" id="subject" name="subject" class="common-input mb-20 form-control {{$errors->has('subject')?'has-error':''}}" placeholder="请输入概要主题" required value="{{ old('subject') }}">
                        @if($errors->has('subject'))
                            <div class="col-md-12">
                                <p class="text-danger text-left"><strong>{{$errors->first('subject')}}</strong></p>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-xs-6 col-sm-9 col-md-9">
                                <input type="text" id="captcha" class="common-input mb-20 form-control {{$errors->has('captcha')?'has-error':''}}" name="captcha" placeholder="请输入验证码" required value="{{ old('captcha') }}">
                                @if($errors->has('captcha'))
                                    <div class="col-md-12">
                                        <p class="text-danger text-left"><strong>{{$errors->first('captcha')}}</strong></p>
                                    </div>
                                @endif
                            </div>
                            <div class="col-xs-6 col-sm-3 col-md-3">
                                <img src="{{captcha_src()}}" style="cursor: pointer" onclick="this.src='{{captcha_src()}}'+Math.random()">
                            </div>
                        </div>


                    </div>
                    <div class="col-lg-6 form-group">
                        <textarea name="content" id="content" cols="30" rows="10" class="common-textarea mt-10 form-control {{$errors->has('content')?'has-error':''}}" placeholder="请输入详细内容" required>{{ old('content') }}</textarea>
                        @if($errors->has('content'))
                            <div class="col-md-12">
                                <p class="text-danger text-left"><strong>{{$errors->first('content')}}</strong></p>
                            </div>
                        @endif

                        <button class="primary-btn mt-20">提交<span class="lnr lnr-arrow-right"></span></button>
                        <div class="alert-msg">
                        </div>
                    </div>
                </div>
                {{ csrf_field() }}
                <input type="hidden" name="success_uri" value="/#contact">
                <input type="hidden" name="error_uri" value="/#contact">

            </form>

        </div>
    </section>
    <!-- end contact Area -->
@endsection