@extends($_theme_info['view_root_path'].'.layouts.app')

@section('header')
    <section id="home" class="video-hero" style="height: 500px; background-image: url({{ get_admin_file_url($article->thumbnail) }});  background-size:cover; background-position: center center;background-attachment:fixed;" data-section="home">
        <div class="overlay"></div>
        <div class="display-t display-t2 text-center">
            <div class="display-tc display-tc2">
                <div class="container">
                    <div class="col-md-12 col-md-offset-0">
                        <div class="animate-box">
                            <h2>{{ $article->title }}</h2>
                            <p class="breadcrumbs">
                                <span><a href="{{ route('index') }}">首页</a></span>
                                @if (! empty($category->parent))
                                    <span><a href="{{ route('articles.categories', ['category' => $category->parent->id]) }}">{{ $category->parent->title }}</a></span>
                                @endif
                                <span><a href="{{ route('articles.categories', ['category' => $category->id]) }}">{{ $category->title }}</a></span>
                                <span>{{ $article->title }}</span>
                            </p>
                            <h4 style="color: rgba(255, 255, 255, 0.9);">
                                <span>{{ $article->author }}</span>
                                <span>发布于</span>
                                <span>{{ $article->publish_time }}</span>
                            </h4>
                            <h5 style="color: rgba(255, 255, 255, 0.9);">{{ $article->description }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <div class="colorlib-about">
        <div class="container col-md-12">
            <div class="row">
                <ucapcontent>
                    {!! $article->content !!}
                </ucapcontent>
            </div>

        </div>
    </div>
@endsection