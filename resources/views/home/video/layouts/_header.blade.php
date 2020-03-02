<!-- banner -->
<div class="banner">
    <div class="container">
        <nav class="navbar navbar-default">
            <div class="navbar-header navbar-left">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <h1><a class="navbar-brand" href="index.html">Mansion<span>Home for happy families</span></a></h1>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
                <nav class="link-effect-3" id="link-effect-3">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="index.html" data-hover="Home">Home</a></li>
                        <li><a href="services.html" data-hover="Services">Services</a></li>
                        <li><a href="about.html" data-hover="About Us">About Us</a></li>
                        <li><a href="gallery.html" data-hover="Gallery">Gallery</a></li>
                        <li><a href="short-codes.html" data-hover="Short Codes">Short Codes</a></li>
                        <li><a href="blog.html" data-hover="Blog">Blog</a></li>
                        <li><a href="mail.html" data-hover="Mail Us">Mail Us</a></li>
                    </ul>
                </nav>
            </div>
        </nav>
        <div class="w3l_banner_info">
            <section class="slider">
                <div class="flexslider">
                    <ul class="slides">
                        @foreach($_banners as $item)
                            <li>
                                <div class="wthree_banner_info_grid">
                                    <h3><a href="{{$item['url']}}"><span>{{$item['title']}}</span></a></h3>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </section>
        </div>
    </div>
</div>
<!-- //banner -->