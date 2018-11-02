@extends($_theme_info['view_root_path'].'.layouts.app')

@section('header')
    <section id="home" class="video-hero" style="height: 700px; background-image: url({{ $_theme_info['style_root_path'] }}/images/cover_img_1.jpg);  background-size:cover; background-position: center center;background-attachment:fixed;" data-section="home">
        <div class="overlay"></div>
        <a class="player" data-property="{videoURL:'https://www.youtube.com/watch?v=vqqt5p0q-eU',containment:'#home', showControls:false, autoPlay:true, loop:true, mute:true, startAt:0, opacity:1, quality:'default'}"></a>
        <div class="display-t text-center">
            <div class="display-tc">
                <div class="container">
                    <div class="col-md-12 col-md-offset-0">
                        <div class="animate-box">
                            <h2>关于Klinson</h2>
                            <p>后端开发工程师，专注WEB、PHP、微信相关开发</p>
                            <p>承接一切web、公众号、小程序相关开发，请联系我吧</p>
                            <p><a href="{{ route('system.contactUs') }}" class="btn btn-primary btn-lg btn-custom">联系我吧</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection()

@section('content')
    <div class="colorlib-featured">
        <div class="row animate-box">
            <div class="featured-wrap">
                <div class="owl-carousel">
                    <div class="item">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="featured-entry">
                                <img class="img-responsive" src="{{ $_theme_info['style_root_path'] }}/images/dashboard_full_1.jpg" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="featured-entry">
                                <img class="img-responsive" src="{{ $_theme_info['style_root_path'] }}/images/dashboard_full_2.jpg" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="featured-entry">
                                <img class="img-responsive" src="{{ $_theme_info['style_root_path'] }}/images/dashboard_full_3.jpg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="colorlib-services colorlib-bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-4 text-center animate-box">
                    <div class="services">
                        <span class="icon">
                            <i class="icon-browser"></i>
                        </span>
                        <div class="desc">
                            <h3>网站建设</h3>
                            <p>企业官网、CMS、业务系统、商城等网站建设</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-center animate-box">
                    <div class="services">
                        <span class="icon">
                            <i class="fa fa-5x fa-weixin"></i>
                        </span>
                        <div class="desc">
                            <h3>微信开发</h3>
                            <p>小程序开发、公众号开发、微信支付开发</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-center animate-box">
                    <div class="services">
                        <span class="icon">
                            <i class="icon-layers"></i>
                        </span>
                        <div class="desc">
                            <h3>二次开发</h3>
                            <p>Ecshop、Discuz等</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="colorlib-blog">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center colorlib-heading animate-box">
                    <h2>作品展示</h2><a href="">查看更多</a>
                    {{--<p></p>--}}
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 animate-box">
                    <article>
                        <h2>Building the Mention Sales Application on Unapp</h2>
                        <p class="admin"><span>May 12, 2018</span></p>
                        <p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life</p>
                        <p class="author-wrap"><a href="#" class="author-img" style="background-image: url({{ $_theme_info['style_root_path'] }}/images/person1.jpg);"></a> <a href="#" class="author">by Dave Miller</a></p>
                    </article>
                </div>
                <div class="col-md-4 animate-box">
                    <article>
                        <h2>Building the Mention Sales Application on Unapp</h2>
                        <p class="admin"><span>May 12, 2018</span></p>
                        <p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life</p>
                        <p class="author-wrap"><a href="#" class="author-img" style="background-image: url({{ $_theme_info['style_root_path'] }}/images/person2.jpg);"></a> <a href="#" class="author">by Dave Miller</a></p>
                    </article>
                </div>
                <div class="col-md-4 animate-box">
                    <article>
                        <h2>Building the Mention Sales Application on Unapp</h2>
                        <p class="admin"><span>May 12, 2018</span></p>
                        <p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life</p>
                        <p class="author-wrap"><a href="#" class="author-img" style="background-image: url({{ $_theme_info['style_root_path'] }}/images/person3.jpg);"></a> <a href="#" class="author">by Dave Miller</a></p>
                    </article>
                </div>
            </div>
        </div>
    </div>
@endsection