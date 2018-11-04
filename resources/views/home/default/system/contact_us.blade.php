@extends($_theme_info['view_root_path'].'.layouts.app')

@section('title')联系我们@endsection

@section('header')
<section id="home" class="video-hero" style="height: 500px; background-image: url({{ $_theme_info['style_root_path'] }}/images/cover_img_1.jpg);  background-size:cover; background-position: center center;background-attachment:fixed;" data-section="home">
    <div class="overlay"></div>
    <div class="display-t display-t2 text-center">
        <div class="display-tc display-tc2">
            <div class="container">
                <div class="col-md-12 col-md-offset-0">
                    <div class="animate-box">
                        <h2>联系我们</h2>
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
                                    <p><span><i class="fa fa-qq"></i></span>&nbsp;<a href="tencent://message/?uin={{ config('contact.qq') }}&Site=klinson.com&Menu=yes"></a>{{ config('contact.qq', '未设置') }}</p>
                                </div>
                                <div class="con-info">
                                    <p><span><i class="fa fa-weixin"></i></span> <a href="javacript:void(0);">&nbsp;{{ config('contact.weixin', '未设置') }}</a></p>
                                </div>
                                <div class="con-info">
                                    <p><span><i class="fa fa-envelope"></i></span> <a href="mailto:{{ config('contact.email', '') }}">&nbsp;{{ config('contact.email', '未设置') }}</a></p>
                                </div>
                                <div class="con-info">
                                    <p><span><i class="fa fa-globe"></i></span> <a href="{{ config('contact.site_link', 'javascript:void(0)') }}" target="_blank">&nbsp;{{ config('contact.site_name', '未设置') }}</a></p>
                                </div>
                                <div>
                                    <img src="{{ asset(config('contact.weixin_qrcode')) }}" alt="" class="img-responsive" style="max-width: 100%;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-md-pull-4 animate-box">
                    <h2>留言</h2>
                    <form action="{{ route('system.contactUs.store') }}" method="post">
                        <div class="row form-group">
                            <div class="col-md-12 {{$errors->has('name')?'has-error':''}}">
                                {{--<label for="name">姓名</label>--}}
                                <input type="text" id="name" name="name" class="form-control" placeholder="请输入您的姓名" value="{{ old('name') }}" required>
                            </div>
                            @if($errors->has('name'))
                                <div class="col-md-12">
                                    <p class="text-danger text-left"><strong>{{$errors->first('name')}}</strong></p>
                                </div>
                            @endif
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12 {{$errors->has('email')?'has-error':''}}">
                                {{--<label for="email">邮箱</label>--}}
                                <input type="text" id="email" name="email" class="form-control" placeholder="请输入您常用的邮箱地址" value="{{ old('email') }}" required>
                            </div>
                            @if($errors->has('email'))
                                <div class="col-md-12">
                                    <p class="text-danger text-left"><strong>{{$errors->first('email')}}</strong></p>
                                </div>
                            @endif
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12 {{$errors->has('subject')?'has-error':''}}">
                                {{--<label for="subject">主题</label>--}}
                                <input type="text" id="subject" name="subject" class="form-control" placeholder="请输入概要主题" required value="{{ old('subject') }}">
                            </div>
                            @if($errors->has('subject'))
                                <div class="col-md-12">
                                    <p class="text-danger text-left"><strong>{{$errors->first('subject')}}</strong></p>
                                </div>
                            @endif
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12 {{$errors->has('content')?'has-error':''}}">
                                {{--<label for="message">内容</label>--}}
                                <textarea name="content" id="content" cols="30" rows="10" class="form-control" placeholder="请输入详细内容" required>{{ old('content') }}</textarea>
                            </div>
                            @if($errors->has('content'))
                                <div class="col-md-12">
                                    <p class="text-danger text-left"><strong>{{$errors->first('content')}}</strong></p>
                                </div>
                            @endif
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-6 col-sm-9 col-md-9 {{$errors->has('captcha')?'has-error':''}}">
                                <input type="text" id="captcha" class="form-control" name="captcha" placeholder="请输入验证码" required value="{{ old('captcha') }}">
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
                        <div class="row form-group">
                            <div class="col-md-12 text-center">
                                <input type="submit" value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;提交留言&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" class="btn btn-primary">
                            </div>
                        </div>
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
