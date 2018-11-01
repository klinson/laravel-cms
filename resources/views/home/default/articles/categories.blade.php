@extends($_theme_info['view_root_path'].'.layouts.app')

@section('header')
    <section id="home" class="video-hero" style="height: 500px; background-image: url({{ $_theme_info['style_root_path'] }}/images/cover_img_1.jpg);  background-size:cover; background-position: center center;background-attachment:fixed;" data-section="home">
        <div class="overlay"></div>
        <div class="display-t display-t2 text-center">
            <div class="display-tc display-tc2">
                <div class="container">
                    <div class="col-md-12 col-md-offset-0">
                        <div class="animate-box">
                            <h2>Portfolio</h2>
                            <p class="breadcrumbs"><span><a href="index.html">Home</a></span> <span>Work</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <div class="colorlib-work">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="work-flex">
                        <div class="half animate-box">
                            <div class="row no-gutters">
                                <div class="col-md-12 col-md-push-12 no-gutters">
                                    <a href="#" class="work-img" style="background-image: url({{ $_theme_info['style_root_path'] }}/images/work-1.jpg);"></a>
                                </div>
                            </div>
                        </div>
                        <div class="half animate-box">
                            <div class="row no-gutters">
                                <div class="col-md-12 col-md-pull-12 no-gutters">
                                    <div class="display-t desc">
                                        <div class="display-tc">
                                            <h2><a href="#">A beige chair at a basket</a></h2>
                                            <p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="work-flex">
                        <div class="half animate-box">
                            <div class="row no-gutters">
                                <div class="col-md-12 no-gutters">
                                    <a href="#" class="work-img" style="background-image: url({{ $_theme_info['style_root_path'] }}/images/work-2.jpg);"></a>
                                </div>
                            </div>
                        </div>
                        <div class="half animate-box">
                            <div class="row no-gutters">
                                <div class="col-md-12 no-gutters">
                                    <div class="display-t desc">
                                        <div class="display-tc">
                                            <h2><a href="#">A beige chair at a small white desk</a></h2>
                                            <p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="work-flex">
                        <div class="half animate-box">
                            <div class="row no-gutters">
                                <div class="col-md-12 col-md-push-12 no-gutters">
                                    <a href="#" class="work-img" style="background-image: url({{ $_theme_info['style_root_path'] }}/images/work-3.jpg);"></a>
                                </div>
                            </div>
                        </div>
                        <div class="half animate-box">
                            <div class="row no-gutters">
                                <div class="col-md-12 col-md-pull-12 no-gutters">
                                    <div class="display-t desc">
                                        <div class="display-tc">
                                            <h2><a href="#">A beige chair at a basket</a></h2>
                                            <p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="work-flex">
                        <div class="half animate-box">
                            <div class="row no-gutters">
                                <div class="col-md-12 no-gutters">
                                    <a href="#" class="work-img" style="background-image: url({{ $_theme_info['style_root_path'] }}/images/work-4.jpg);"></a>
                                </div>
                            </div>
                        </div>
                        <div class="half animate-box">
                            <div class="row no-gutters">
                                <div class="col-md-12 no-gutters">
                                    <div class="display-t desc">
                                        <div class="display-tc">
                                            <h2><a href="#">A beige chair at a small white desk</a></h2>
                                            <p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <ul class="pagination">
                        <li class="disabled"><a href="#">&laquo;</a></li>
                        <li class="active"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">&raquo;</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection