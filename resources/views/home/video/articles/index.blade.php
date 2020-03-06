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
                        <div class="w3agile_blog_left_grid_sub">
                            <a href="{{$item->web_url}}"><img src="{{$item->thumbnail_url}}" alt=" " class="img-responsive"></a>
                        </div>

                        <div class="w3agile_blog_left_grid_sub1">
                            <div class="w3agile_blog_left_grid_sub1_pos">
                                <p>{{ $item->description }}</p>
                            </div>
                        </div>
                        <div class="agileits_more agileits_more1">
                            <a href="{{$item->web_url}}" class="button button--rayen button--border-thin button--text-thick button--text-upper button--size-s" data-text="Learn More"><span>点击进入</span></a>
                        </div>
                    </div>
                @endforeach
                <nav aria-label="Page navigation">
                    {{$articles->appends(request()->except(['page', 's']))->links()}}
                </nav>
            </div>
            <div class="col-md-5 w3agile_blog_left">
                <div class="agileits_search">
                    <form action="{{ route('articles') }}" method="get">
                        <input class="email" type="text" name="q" placeholder="搜索关键词" value="{{request('q', '')}}" required>
                        <input type="hidden" name="category_id" value="{{request('category_id', 0)}}" required>
                        <input type="submit" value="Search">
                    </form>
                </div>
                @if($category)
                    <div class="agile_author">
                        <h3>关于 {{ $category->title }}</h3>
                        <div class="agile_author_grid">
                            <p>{{ $category->description }}</p>
                            <div class="agile_author_grid_pos">
                                <img src="{{ $category->thumbnail_url }}" alt=" " class="img-responsive img-circle">
                            </div>
                        </div>
                    </div>
                @endif

                <div class="w3ls_recent_posts">
                    <h3>最新发布</h3>
                    @foreach($recents as $item)
                        <div class="agileits_recent_posts_grid">
                            <div class="agileits_recent_posts_gridl">
                                <a href="{{ $item->web_url }}"><img src="{{ $item->thumbnail_url }}" alt=" " class="img-responsive"></a>
                            </div>
                            <div class="agileits_recent_posts_gridr">
                                <h4><a href="{{ $item->web_url }}">{{ $item->title }}</a></h4>
                                <ul>
{{--                                    <li><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span><a href="#">2</a></li>--}}
                                    <li><span class="glyphicon glyphicon-time" aria-hidden="true"></span>{{ $item->publish_time }}</li>
                                </ul>
                            </div>
                            <div class="clearfix"> </div>
                        </div>
                    @endforeach
                </div>
                <div class="w3l_categories">
                    <h3>热门栏目</h3>
                    <ul>
                        @foreach($categories as $item)
                            <li><a href="{{ $item->web_url }}"><span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>{{ $item->title }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
@endsection

@section('script')
@endsection

@section('header')
@endsection