@extends($_theme_info['view_root_path'].'.layouts.app')

@section('title')首页@endsection

@section('header')
    <section id="home" class="video-hero" style="height: 700px; background-image: url({{ $_theme_info['style_root_path'] }}/images/cover_img_1.jpg);  background-size:cover; background-position: center center;background-attachment:fixed;" data-section="home">
        <div class="overlay"></div>
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
                        <span class="icon" style="margin-bottom: 34px;">
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

    @if (! empty($topCategory))
        <div class="colorlib-blog">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2 text-center colorlib-heading animate-box">
                        <h2>{{ $topCategory->title }}</h2><a href="{{ route('articles.categories', ['category' => $topCategory->id]) }}">查看更多</a>
                        {{--<p></p>--}}
                    </div>
                </div>
                <div class="row">
                    @foreach ($topArticles as $article)
                        <div class="col-md-4 text-center animate-box fadeInUp animated-fast">
                            <div class="staff-entry shadow-box">
                                <a href="{{ route('articles.show', ['category' => $topCategory->id, 'article' => $article->id]) }}" class="staff-img" style="background-image: url({{ get_admin_file_url($article->thumbnail, '', asset($_theme_info['default_article_thumbnail'])) }});width: 100%;border-radius: 1%;"></a>
                                <div class="desc">
                                    <h3>{{ $article->title }}</h3>
                                    <span>{{ $article->publish_time }}</span>
                                    <p>{{ $article->description }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

@endsection