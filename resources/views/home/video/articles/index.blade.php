@extends($_theme_info['view_root_path'].'.layouts.app')

@section('content')
    <div class="service-breadcrumb">
        <div class="container">
            <h2>{{ ($category ? $category->title.': ': '') . (request('q', '') ? '搜索"'.request('q', '') .'"的结果' : '所有') }}</h2>
        </div>
    </div>

    <div class="blog">
        <div class="container">
            <div class="col-md-7 w3agile_blog_left">
                @foreach($articles as $item)
                    <div class="w3agile_blog_left_grid">
                        <div class="w3agile_blog_left_grid_l">
                            <p>{{date('M', strtotime($item->publish_time))}}</p>
                            <h4>{{date('d', strtotime($item->publish_time))}}</h4>
                            <p>{{date('Y', strtotime($item->publish_time))}}</p>
                        </div>
                        <div class="w3agile_blog_left_grid_r">
                            <h3><a href="{{$item->web_url}}">{{$item->title}}<span style="margin-left: 1em">{{$item->categories->pluck('title')->implode(' / ')}}</span></a></h3>
                            <ul>
                                <li><span class="glyphicon glyphicon-user" aria-hidden="true"></span><a href="#">{{ $item->author }}</a><i>|</i></li>
                                <li><span class="glyphicon glyphicon-heart" aria-hidden="true"></span><a href="#">{{$item->collects_count}}</a><i>|</i></li>
                                <li><span class="glyphicon glyphicon-tag" aria-hidden="true"></span><a href="#">{{ $item->comments_count }}</a><i>|</i></li>
                                <li><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span><a href="#">{{ $item->pv }}</a><i>|</i></li>
                            </ul>
                        </div>
                        <div class="clearfix"> </div>
{{--                        <div class="w3agile_blog_left_grid_sub">--}}
{{--                            <a href="{{$item->web_url}}"><img src="{{$item->thumbnail_url}}" alt=" " class="img-responsive"></a>--}}
{{--                        </div>--}}

{{--                        <div class="w3agile_blog_left_grid_sub1">--}}
{{--                            <div class="w3agile_blog_left_grid_sub1_pos">--}}
{{--                                <p>{{ $item->description }}</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="agileits_more agileits_more1">--}}
{{--                            <a href="{{$item->web_url}}" class="button button--rayen button--border-thin button--text-thick button--text-upper button--size-s" data-text="Learn More"><span>点击进入</span></a>--}}
{{--                        </div>--}}
                    </div>
                @endforeach
                <nav aria-label="Page navigation">
                    {{$articles->appends(request()->except(['page', 's']))->links()}}
                </nav>
            </div>
            <div class="col-md-5 w3agile_blog_left">
                @include($_theme_info['view_root_path'].'.articles.right')
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
@endsection

@section('script')
@endsection

@section('header')
@endsection