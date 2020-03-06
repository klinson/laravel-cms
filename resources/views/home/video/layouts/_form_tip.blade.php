<!--错误提示信息-->
@if (Session::has('_message'))
    <div class="alert alert-warning">{{ Session::get('_message') }}</div>
@endif
@if (count($errors) > 0)
    <div class="alert alert-error">
        @foreach ($errors->all() as $error)
            {{ $error }}<br>
        @endforeach
    </div>
@endif