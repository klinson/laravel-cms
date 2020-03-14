<div class="agileits_search">
    <form action="{{ route('articles') }}" method="get">
        <input class="email" type="text" name="q" placeholder="搜索关键词" value="{{request('q', '')}}" required>
        <input type="hidden" name="category_id" value="{{request('category_id', 0)}}" required>
        <input type="submit" value="Search">
    </form>
</div>
@if(isset($category) && !empty($category))
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
    <div class="">
    @foreach($recents as $item)
        <div class="agileits_recent_posts_gridr" style="width: 90%;float: left">
            <h4><a href="{{ $item->web_url }}">{{ $item->title }}</a></h4>
            <ul>
                <li><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span><a href="#">{{ $item->pv }}</a></li>
                <li><span class="glyphicon glyphicon-time" aria-hidden="true"></span>{{ $item->publish_time }}</li>
            </ul>
        </div>
        <div class="clearfix"> </div>
    @endforeach
    </div>
</div>
<div class="w3l_categories">
    <h3>热门栏目</h3>
    <ul>
        @foreach($categories as $item)
            <li><a href="{{ $item->web_url }}"><span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>{{ $item->title }}</a></li>
        @endforeach
    </ul>
</div>