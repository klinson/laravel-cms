@extends($_theme_info['view_root_path'].'.layouts.app')

@section('content')
    <div class="service-breadcrumb w3layouts">
        <div class="container">
            <h2>用户中心</h2>
        </div>
    </div>

    <div class="typo">
        <div class="container">
            @include($_theme_info['view_root_path'].'.layouts._form_tip')

            <form action="{{ route('user.update') }}" method="post">
                {{ csrf_field() }}
                {{ method_field('put') }}
                <div class="input-group input-group-lg w3_w3layouts">
                    <span class="input-group-addon" id="sizing-addon1">用户名</span>
                    <input type="text" class="form-control" placeholder="请输入" aria-describedby="sizing-addon1" value="{{ \Auth::user()->username }}" readonly disabled>
                </div>
                <div class="input-group input-group-lg w3_w3layouts">
                    <span class="input-group-addon" id="sizing-addon1">姓名</span>
                    <input type="text" class="form-control" placeholder="请输入" aria-describedby="sizing-addon1" name="name" value="{{old('name', \Auth::user()->name)}}">
                </div>
                <div class="input-group input-group-lg w3_w3layouts">
                    <span class="input-group-addon" id="sizing-addon1">昵称</span>
                    <input type="text" class="form-control" placeholder="请输入" aria-describedby="sizing-addon1" name="nickname" value="{{old('nickname', \Auth::user()->nickname)}}">
                </div>
                <div class="input-group input-group-lg w3_w3layouts">
                    <span class="input-group-addon" id="sizing-addon1">性别</span>
                    <select class="form-control" name="sex">
                        <option value="1" @if(old('sex', \Auth::user()->sex) == 1) selected @endif >男</option>
                        <option value="2" @if(old('sex', \Auth::user()->sex) == 2) selected @endif >女</option>
                    </select>
                </div>

                <div class="input-group input-group-lg w3_w3layouts">
                    <span class="input-group-addon" id="sizing-addon1">修改密码</span>
                    <input type="password" class="form-control" placeholder="请输入" aria-describedby="sizing-addon1" name="password" value="">
                </div>
                <div class="w3_w3layouts">
                    <input type="submit" value="登录" class="btn btn-success btn-lg btn-block">
                </div>
            </form>
        </div>
    </div>

@endsection

@section('script')
@endsection

@section('header')
@endsection