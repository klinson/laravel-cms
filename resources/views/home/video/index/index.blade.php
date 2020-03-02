@extends($_theme_info['view_root_path'].'.layouts.app')

@section('content')
    <!-- work -->
    <div class="work">
        <div class="container">
            <p class="wthree_para">HOT</p>
            <h3 class="w3ls_head">热门分类</h3>
            <div class="agile_work_grids">
                @foreach($topCategories as $key => $item)
                    <a href="{{$item->web_url}}">
                        <div class="col-md-3 agile_work_grid">
                            <div class="agile_work_grid1 w3_agileits_work">
                                <span>{{$key+1}}</span>
                            </div>
                            <div class="agile_work_grid2 hvr-rectangle-out">
                                <div class="agile_work_grid3">
                                    <span class="glyphicon glyphicon-random" aria-hidden="true"></span>
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

@endsection

@section('script')
@endsection

@section('header')
@endsection