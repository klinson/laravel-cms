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
                        @foreach ($_navs as $_nav)
                            @empty($_nav['children'])
                                <li class="{{ check_nav_active($_nav) ? 'active' : ''}}"><a href="{{ $_nav['url'] }}" target="{{ $_nav['target'] }}">{{ $_nav['title'] }}</a></li>
                            @else
                                <li class="has-dropdown {{ check_nav_active($_nav) ? 'active' : ''}}">
                                    <a href="{{ $_nav['url'] }}" target="{{ $_nav['target'] }}">{{ $_nav['title'] }}</a>
                                    <ul class="dropdown">
                                        @foreach ($_nav['children'] as $_children)
                                            <a href="{{ $_nav['url'] }}" target="{{ $_nav['target'] }}">{{ $_nav['title'] }}</a>
                                        @endforeach
                                    </ul>
                                </li>
                            @endempty
                        @endforeach

                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
