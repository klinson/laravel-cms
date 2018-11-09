<!-- start banner Area -->
<section class="banner-area" id="home">
    <!-- Start Header Area -->
    <header class="default-header">
        <nav class="navbar navbar-expand-lg  navbar-light">
            <div class="container">
                <a class="navbar-brand" href="index.html">
                    <img src="{{ asset($_theme_info['style_root_path'].'/img/logo.png') }}" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="text-white lnr lnr-menu"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-end align-items-center" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <li><a href="/#home">Home</a></li>
                        <li><a href="/#about">About</a></li>
                        <li><a href="/#secvice">Service</a></li>
                        <li><a href="/#gallery">Gallery</a></li>
                        <li><a href="#faq">Faq</a></li>
                        <li><a href="/#contact">Contact</a></li>
                        @foreach ($_categories as $_category)
                            @empty($_category['children'])
                                <li><a href="{{ route('articles.categories', ['category' => $_category['id']])}}">{{ $_category['title'] }}</a></li>
                            @else
                                <li class="dropdown">
                                    <a class="dropdown-toggle" href="{{ route('articles.categories', ['category' => $_category['id']]) }}" data-toggle="dropdown">
                                        {{ $_category['title'] }}
                                    </a>
                                    <div class="dropdown-menu">
                                        @foreach ($_category['children'] as $_children)
                                            <a style="display: block;" href="{{ route('articles.categories', ['id' => $_children['id']]) }}">{{ $_children['title'] }}</a>
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
    <!-- End Header Area -->
</section>