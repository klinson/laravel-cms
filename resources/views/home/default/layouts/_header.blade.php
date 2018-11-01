<nav class="colorlib-nav" role="navigation">
    <div class="top-menu">
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    <div id="colorlib-logo"><a href="/">{{ $_theme_info['system_name'] ?? 'klinson' }}</a></div>
                </div>
                <div class="col-md-10 text-right menu-1">
                    <ul>
                        <li class="active"><a href="/">首页</a></li>
                        @foreach ($_categories as $category)
                            @empty($category['children'])
                                <li><a href="{{ route('articles.categories', ['category' => $category['id']])}}">{{ $category['title'] }}</a></li>
                            @else
                                <li class="has-dropdown">
                                    <a href="{{ route('articles.categories', ['category' => $category['id']]) }}">{{ $category['title'] }}</a>
                                    <ul class="dropdown">
                                        @foreach ($category['children'] as $children)
                                            <a href="{{ route('articles.categories', ['id' => $children['id']]) }}">{{ $children['title'] }}</a>
                                        @endforeach
                                    </ul>
                                </li>
                            @endempty
                        @endforeach

                        <li><a href="contact.html">联系我们</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
