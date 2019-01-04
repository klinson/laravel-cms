<!-- Start Header Area -->
<header class="default-header">
    <nav class="navbar navbar-expand-lg  navbar-light">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="{{ asset($_theme_info['style_root_path'].'/img/logo.png') }}" alt="" style="width: 50%;">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="text-white lnr lnr-menu"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end align-items-center" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    @foreach ($_navs as $_nav)
                        @empty($_nav['children'])
                            <li>
                                <a href="{{ $_nav['url'] }}" target="{{ $_nav['target'] }}">{{ $_nav['title'] }}</a>
                            </li>
                        @else
                            <li class="dropdown">
                                <a class="dropdown-toggle"
                                   href="{{ $_nav['url'] }}"
                                   target="{{ $_nav['target'] }}"
                                   data-toggle="dropdown">
                                    {{ $_nav['title'] }}
                                </a>
                                <div class="dropdown-menu">
                                    @foreach ($_nav['children'] as $_nav)
                                        <a style="display: block;" target="{{ $_nav['target'] }}" href="{{ $_nav['url'] }}">{{ $_nav['title'] }}</a>
                                    @endforeach
                                </div>
                            </li>
                        @endempty
                    @endforeach
                </ul>
            </div>
        </div>
    </nav>
</header>