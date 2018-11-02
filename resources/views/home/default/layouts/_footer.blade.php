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
            <h4>关于Klinson</h4>
            <ul class="colorlib-footer-links">
                <li>后端开发工程师，专注WEB、PHP、微信相关开发 <br> 承接一切web、公众号、小程序相关开发，请联系我吧</li>
                <li><a href="tencent://message/?uin={{ config('contact.qq', '') }}&Site=&Menu=yes"><i class="fa fa-qq"></i>&nbsp;{{ config('contact.qq', '未设置') }}</a></li>
                <li><a href="javacript:void(0);"><i class="fa fa-weixin"></i>&nbsp;{{ config('contact.weixin') }}</a></li>
                <li><a href="mailto:{{ config('contact.email', '') }}"><i class="fa fa-envelope"></i>&nbsp;{{ config('contact.email', '未设置') }}</a></li>
                <li><a href="{{ config('contact.site_link', 'javacript:void(0);') }}"><i class="fa fa-globe"></i>&nbsp;{{ config('contact.site_name') }}</a></li>
            </ul>
        </div>
    </div>
</div>

<div class="copy">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <p>
                    Copyright &copy;2018 All rights reserved | by <a href="{{ config('contact.site_link', '') }}" target="_blank" title="{{ config('contact.owner', 'klinson') }}">{{ config('contact.owner', 'klinson') }}</a> | {{ config('contact.icp', '') }}
                </p>
            </div>
        </div>
    </div>
</div>