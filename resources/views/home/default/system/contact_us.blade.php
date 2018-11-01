@extends($_theme_info['view_root_path'].'.layouts.app')

@section('header')
<section id="home" class="video-hero" style="height: 500px; background-image: url({{ $_theme_info['style_root_path'] }}/images/cover_img_1.jpg);  background-size:cover; background-position: center center;background-attachment:fixed;" data-section="home">
    <div class="overlay"></div>
    <div class="display-t display-t2 text-center">
        <div class="display-tc display-tc2">
            <div class="container">
                <div class="col-md-12 col-md-offset-0">
                    <div class="animate-box">
                        <h2>Contact Us</h2>
                        <p class="breadcrumbs">
                            <span><a href="{{ route('index') }}">首页</a></span>
                            <span>联系我们</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('content')
    <div id="colorlib-contact">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-push-8 animate-box">
                    <h2>联系方式</h2>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="contact-info-wrap-flex">
                                <div class="con-info">
                                    <p><span><i class="icon-location-2"></i></span>&nbsp;{{ config('contact.location', '未设置') }}</p>
                                </div>
                                <div class="con-info">
                                    <p><span><i class="icon-phone3"></i></span> <a href="tel:// {{ config('contact.mobile', '') }}">&nbsp;{{ config('contact.mobile', '未设置') }}</a></p>
                                </div>
                                <div class="con-info">
                                    <p><span><i class="icon-paperplane"></i></span> <a href="mailto:{{ config('contact.email', '') }}">&nbsp;{{ config('contact.email', '未设置') }}</a></p>
                                </div>
                                <div class="con-info">
                                    <p><span><i class="icon-globe"></i></span> <a href="{{ config('contact.site_link', '') }}" target="_blank">&nbsp;{{ config('contact.site_name', '未设置') }}</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-md-pull-4 animate-box">
                    <h2>留言</h2>
                    <form action="{{ route('system.contactUs.store') }}" method="post">
                        <div class="row form-group">
                            <div class="col-md-12">
                                {{--<label for="name">姓名</label>--}}
                                <input type="text" id="name" class="form-control" placeholder="请输入您的姓名" required>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                {{--<label for="email">邮箱</label>--}}
                                <input type="text" id="email" class="form-control" placeholder="请输入您常用的邮箱地址" required>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                {{--<label for="subject">主题</label>--}}
                                <input type="text" id="subject" class="form-control" placeholder="请输入概要主题" required>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                {{--<label for="message">内容</label>--}}
                                <textarea name="content" id="content" cols="30" rows="7" class="form-control" placeholder="请输入详细内容" required></textarea>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-6">
                                <input type="text" id="captcha" class="form-control {{$errors->has('captcha')?'parsley-error':''}}" name="captcha" placeholder="请输入验证码" required>
                            </div>
                            <div class="col-sm-3">
                                <img src="{{captcha_src()}}" style="cursor: pointer" onclick="this.src='{{captcha_src()}}'+Math.random()">
                            </div>
                            <div class="col-sm-3">
                                <div class="pull-right" >
                                    <input type="submit" value="&nbsp;&nbsp;&nbsp;&nbsp;提交留言&nbsp;&nbsp;&nbsp;&nbsp;" class="btn btn-primary">
                                </div>
                            </div>
                        </div>
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
