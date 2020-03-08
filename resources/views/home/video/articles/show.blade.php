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
                        <h3><a href="{{$article->web_url}}">
                                {{$article->title}}
                                <span style="margin-left: 1em">{{$article->categories->pluck('title')->implode(' / ')}}</span>
                            </a>
                            @if($article->icollect->isNotEmpty())
                                <i style="cursor:pointer; margin-left: 0.5em; color: red" class="glyphicon glyphicon-heart" aria-hidden="true" title="取消关注" onclick="collect(0)"></i>
                            @else
                                <i style="cursor:pointer; margin-left: 0.5em; color: #2E2D3C" onclick="collect(1)" class="glyphicon glyphicon-heart" aria-hidden="true" title="关注"></i>
                            @endif
                        </h3>
                        <ul>
                            <li><span class="glyphicon glyphicon-user" aria-hidden="true"></span><a href="#">{{ $article->author }}</a><i>|</i></li>
                            <li><span class="glyphicon glyphicon-heart" aria-hidden="true"></span><a href="#">{{$article->collects()->count()}}</a><i>|</i></li>
                            <li><span class="glyphicon glyphicon-tag" aria-hidden="true"></span><a href="#">{{ $article->comments()->count() }}</a><i>|</i></li>
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
                <div class="clearfix"> </div>
                <hr>
                <div class="col-md-12">
                    <p class="wthree_para">最新评论</p>
                    <div class="col-md-12 ">
                        <div class="agileinfo_team_grids" style="margin-top: 2em">
                        @foreach($comments as $item)
                            <div class="col-md-12 agileinfo_team_grid">
                                <div class="agileinfo_team_grid1">
                                    <div class="agileinfo_team_grid1_text">
                                        <div class="agileinfo_team_grid1_pos">
                                            <img src="{{ asset('/images/user.png') }}" alt=" " class="img-responsive">
                                        </div>
                                        <h4>{{ $item->user->nickname }}</h4>
                                        <h5>{{ $item->created_at }}</h5>
                                        <p>{{ $item->content }}</p>
                                    </div>
                                </div>
                                <hr>

                            </div>
                            <div class="clearfix"> </div>
                        @endforeach
                        </div>
                    </div>
                    <div class="text-center">
                        {{ $comments->links() }}
                    </div>

                    <p class="wthree_para" style="margin-top: 1em">发布评论</p>
                    <div class="clearfix"> </div>
                    <div class="col-md-12 w3_agileits_mail_bottom_right">
                        @include($_theme_info['view_root_path'].'.layouts._form_tip')

                        <form action="{{ route('articles.comment', ['article' => $article]) }}" method="post" id="comment-form">
                            {{ csrf_field() }}
                            <textarea name="content" placeholder="请输入评论内容" required>{{ old('content') }}</textarea>
                            <div class="w3_w3layouts" style="text-align:center;">
                                <span onclick="comment()" class="btn btn-success btn-lg">提交</span>
                            </div>
                        </form>
                    </div>
                    <div class="clearfix"> </div>
                </div>
            </div>
            <div class="col-md-5 w3agile_blog_left">
                @include($_theme_info['view_root_path'].'.articles.right')
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        var url = "/articles/{{$article->id}}/collect";
        function collect(type) {
            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    _method: type === 1 ? 'POST' : 'DELETE',
                    _token: "{{ csrf_token() }}"
                },
                success: function (res) {
                    console.log(res)
                    alert('提交成功');
                    location.reload()

                },
                error: function (res) {
                    console.log(res)
                    alert('服务器异常');
                }
            })
        }

        var comment_url = "/articles/{{$article->id}}/comments";
        function comment() {
            $.ajax({
                url: comment_url,
                method: 'POST',
                data: $('#comment-form').serialize(),
                success: function (res) {
                    console.log(res)
                    alert('提交成功');
                    location.reload()
                },
                error: function (res) {
                    console.log(res)
                    switch(res.status) {
                        case 422:
                            alert('评论内容不合法')
                            break;
                        case 500:
                        default:
                            alert('服务器异常');
                    }
                },
            })
        }
    </script>


@endsection

@section('header')
@endsection