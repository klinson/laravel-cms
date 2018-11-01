<nav class="colorlib-nav" role="navigation">
    <div class="top-menu">
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    <div id="colorlib-logo"><a href="/">{{ $_theme_info['system_name'] ?? 'klinson' }}</a></div>
                </div>
                <div class="col-md-10 text-right menu-1">
                    <ul>
                        <li class="{{ request()->route()->getName() === 'index' ? 'active' : ''}}"><a href="{{ route('index') }}">首页</a></li>
                        @foreach ($_categories as $_category)
                            @empty($_category['children'])
                                <li class="{{ (in_array(request()->route()->getName(),['articles.categories', 'articles.show']) && $_category['id'] == ($category->id ?? 0)) ? 'active' : ''}}"><a href="{{ route('articles.categories', ['category' => $_category['id']])}}">{{ $_category['title'] }}</a></li>
                            @else
                                <li class="has-dropdown {{ (in_array(request()->route()->getName(),['articles.categories', 'articles.show']) && ($_category['id'] == ($category->id ?? 0)) || $_category['id'] == ($category->parent_id ?? 0)) ? 'active' : ''}}">
                                    <a href="{{ route('articles.categories', ['category' => $_category['id']]) }}">{{ $_category['title'] }}</a>
                                    <ul class="dropdown">
                                        @foreach ($_category['children'] as $_children)
                                            <a href="{{ route('articles.categories', ['id' => $_children['id']]) }}">{{ $_children['title'] }}</a>
                                        @endforeach
                                    </ul>
                                </li>
                            @endempty
                        @endforeach

                        <li class="{{ request()->route()->getName() === 'system.aboutUs' ? 'active' : ''}}"><a href="{{ route('system.aboutUs') }}">联系我们</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
