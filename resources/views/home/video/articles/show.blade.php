@extends($_theme_info['view_root_path'].'.layouts.app')

@section('content')
    <div class="service-breadcrumb">
        <div class="container">
            <h2>{{ $article->title }}</h2>
        </div>
    </div>

    <div class="blog">
        <div class="container">
            <div class="col-md-7 w3agile_blog_left">
                <div class="w3agile_blog_left_grid">
                    <div class="w3agile_blog_left_grid_l">
                        <p>{{date('M', strtotime($article->publish_time))}}</p>
                        <h4>{{date('d', strtotime($article->publish_time))}}</h4>
                        <p>{{date('Y', strtotime($article->publish_time))}}</p>
                    </div>
                    <div class="w3agile_blog_left_grid_r">
                        <h3><a href="{{$article->web_url}}">{{$article->title}}<span style="margin-left: 1em">{{$article->categories->pluck('title')->implode(' / ')}}</span></a></h3>
                        <ul>
                            <li><span class="glyphicon glyphicon-user" aria-hidden="true"></span><a href="#">{{ $article->author }}</a><i>|</i></li>
                            <li><span class="glyphicon glyphicon-heart" aria-hidden="true"></span><a href="#">{{$article->collects_count}}</a><i>|</i></li>
                            <li><span class="glyphicon glyphicon-tag" aria-hidden="true"></span><a href="#">{{ $article->comments_count }}</a><i>|</i></li>
                            <li><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span><a href="#">{{ $article->pv }}</a><i>|</i></li>
                        </ul>
                    </div>
                    <div class="clearfix"> </div>
                </div>
                <hr>
                <div>
                    <ucapcontent>
                        {!! $article->content !!}
                    </ucapcontent>
                </div>
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