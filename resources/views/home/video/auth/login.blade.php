@extends($_theme_info['view_root_path'].'.layouts.app')

@section('content')
    <div class="service-breadcrumb w3layouts">
        <div class="container">
            <h2>登录</h2>
        </div>
    </div>
    <div class="typo">
        <div class="container">
            @include($_theme_info['view_root_path'].'.layouts._form_tip')

            <form action="{{ route('login.store') }}" method="post">
                {{ csrf_field() }}
                <div class="input-group input-group-lg w3_w3layouts">
                    <span class="input-group-addon" id="sizing-addon1">用户名</span>
                    <input type="text" class="form-control" placeholder="请输入" aria-describedby="sizing-addon1" name="username" value="{{old('username')}}">
                </div>
                <div class="input-group input-group-lg w3_w3layouts">
                    <span class="input-group-addon" id="sizing-addon1">密码</span>
                    <input type="password" class="form-control" placeholder="请输入" aria-describedby="sizing-addon1" name="password" value="{{old('password')}}">
                </div>
                <div class="w3_w3layouts">
                    <input type="submit" value="登录" class="btn btn-success btn-lg btn-block">
                    <p>没有账号，<a href="{{ route('register') }}">点我注册</a></p>
                </div>
            </form>
        </div>
    </div>
@endsection


@section('header')
@endsection