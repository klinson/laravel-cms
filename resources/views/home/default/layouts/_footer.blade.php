<div class="container">
    <div class="row row-pb-md">
        <div class="col-md-6 colorlib-widget">
            <h4>最新发布</h4>
            @foreach($_recent_articles as $article)
                <div class="f-blog">
                    <a href="{{ route('articles.show', ['category' => $article->categories[0]->id, 'article' => $article->id]) }}" class="blog-img" style="background-image: url({{ get_admin_file_url($article->thumbnail) }});">
                    </a>
                    <div class="desc">
                        <h2><a href="{{ route('articles.show', ['category' => $article->categories[0]->id, 'article' => $article->id]) }}">{{ $article->title }}</a></h2>
                        <p class="admin"><span>{{ $article->publish_time }}</span></p>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="col-md-6 colorlib-widget">
            <h4>联系我</h4>
            <ul class="colorlib-footer-links">
                <li>291 South 21th Street, <br> Suite 721 New York NY 10016</li>
                <li><a href="tel://1234567920"><i class="icon-phone"></i> + 1235 2355 98</a></li>
                <li><a href="mailto:info@yoursite.com"><i class="icon-envelope"></i> info@yoursite.com</a></li>
                <li><a href="#"><i class="icon-location4"></i> yourwebsite.com</a></li>
            </ul>
        </div>
    </div>
</div>

<div class="copy">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <p>
                    Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | by <a href="{{ config('contact.site_link', '') }}" target="_blank" title="{{ config('contact.owner', 'klinson') }}">{{ config('contact.owner', 'klinson') }}</a>
                </p>
            </div>
        </div>
    </div>
</div>