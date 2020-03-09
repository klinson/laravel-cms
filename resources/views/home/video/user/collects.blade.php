@extends($_theme_info['view_root_path'].'.layouts.app')

@section('content')
    <div class="service-breadcrumb w3layouts">
        <div class="container">
            <h2>我的收藏</h2>
        </div>
    </div>

    <div class="typo">
        <div class="container">
            <div class="col-md-3 col-sm-12">
                @include($_theme_info['view_root_path'].'.user._menu')
            </div>
            <div class="col-md-9 col-sm-12">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>标题</th>
                        <th>分类</th>
                        <th>收藏时间</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($list as $item)
                    <tr>
                        <td><a href="{{ $item->link }}" target="_blank">{{ $item->title }}</a></td>
                        <td>{{ $item->categories->implode('title', '、') }}</td>
                        <td>{{ $item->pivot->created_at }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="text-center">
                    <nav aria-label="Page navigation ">
                        {{$list->appends(request()->except(['page', 's']))->links()}}
                    </nav>
                </div>

            </div>

        </div>
    </div>

@endsection

@section('script')
@endsection

@section('header')
@endsection