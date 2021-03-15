@extends($_theme_info['view_root_path'].'.layouts.app')

@section('content')
    <!-- work -->
    <div class="work">
        <div class="container">
            <p class="wthree_para">HOT CATEGORY</p>
            <h3 class="w3ls_head">热门分类</h3>
            <div class="agile_work_grids">
                @foreach($topCategories as $key => $item)
                    <a href="{{$item->web_url}}">
                        <div class="col-md-3 agile_work_grid">
                            <div class="agile_work_grid1 w3_agileits_work @if($key == 1 || $key == 3) hidden-after @endif ">
                                <span>{{$key+1}}</span>
                            </div>
                            <div class="agile_work_grid2 hvr-rectangle-out">
                                <div class="agile_work_grid3">
                                    <span class="glyphicon glyphicon-{{$item->icon}}" aria-hidden="true"></span>
                                </div>
                            </div>
                            <h4>{{$item->title}}</h4>
                            <p>{{$item->description}}</p>
                        </div>
                    </a>
                @endforeach
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>
    <!-- //work -->

    <!-- work-bottom -->
    <div class="work-bottom">
        <div class="container">
            <h2>登录/注册可使用本站所有功能</h2>
            <div class="agileits_more">
                <a href="{{route('login')}}" class="button button--rayen button--border-thin button--text-thick button--text-upper button--size-s" data-text="Learn More"><span>登录/注册</span></a>
            </div>
        </div>
    </div>
    <!-- //work-bottom -->
    <div class="work">
        <div class="container">
            <p class="wthree_para">HOT NEWS</p>
            <h3 class="w3ls_head">热门新闻</h3>
        </div>
    <div class="row">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="w3l_categories">
                <ul>
                    @foreach($hotList as $key => $item)
                        <li><a href="{{ $item->web_url }}">
                                <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>
                                @if($key < 3)
                                    <span class="label label-primary" style="font-weight: bold !important;color: white;padding-right: 0.5em">{{$key+1}}</span>
                                    @else
                                    <span class="label label-default" style="font-weight: bold !important;color: white;padding-right: 0.5em">{{$key+1}}</span>
                                @endif
                                {{ $item->title }}
                                <span style="float: right">{{ $item->publish_time }}</span>
                            </a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    </div>


@endsection

@section('script')
@endsection

@section('styles')
    <style>

        .hidden-after:after{
            /*background: #0c0c0d;*/
            opacity: 0;
        }
    </style>
@endsection