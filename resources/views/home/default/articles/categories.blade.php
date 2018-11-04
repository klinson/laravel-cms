@extends($_theme_info['view_root_path'].'.layouts.app')

@section('title'){{ $category->title }}@endsection

@section('header')
    <section id="home" class="video-hero" style="height: 500px; background-image: url({{ get_admin_file_url($category->thumbnail) }});  background-size:cover; background-position: center center;background-attachment:fixed;" data-section="home">
        <div class="overlay"></div>
        <div class="display-t display-t2 text-center">
            <div class="display-tc display-tc2">
                <div class="container">
                    <div class="col-md-12 col-md-offset-0">
                        <div class="animate-box">
                            <h2>{{ $category->title }}</h2>
                            <p class="breadcrumbs">
                                <span><a href="{{ route('index') }}">首页</a></span>
                                @if (! empty($category->parent))
                                    <span><a href="{{ route('articles.categories', ['category' => $category->parent->id]) }}">{{ $category->parent->title }}</a></span>
                                @endif
                                <span>{{ $category->title }}</span>
                            </p>
                            <p class="breadcrumbs">{{ $category->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    @if($category->is_page)
        <div class="colorlib-work">
            <div class="container">
                <div class="row  col-md-12">
                    @if(isset($articles[0]))
                        <ucapcontent>
                            {!! $articles[0]->content !!}
                        </ucapcontent>
                    @endif
                </div>

            </div>
        </div>
    @else
        <div class="colorlib-work">
            <div class="container">
                <div class="row">
                    @forelse ($articles as $article)
                        <div class="col-md-12">
                            <div class="work-flex">
                                <div class="half animate-box">
                                    <div class="row no-gutters">
                                        <div class="col-md-12 no-gutters">
                                            <a href="{{ route('articles.show', ['category' => $category->id, 'article' => $article->id]) }}" class="work-img" style="background-image: url({{ get_admin_file_url($article->thumbnail, '', asset($_theme_info['default_article_thumbnail'])) }})"></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="half animate-box">
                                    <div class="row no-gutters">
                                        <div class="col-md-12 no-gutters">
                                            <div class="display-t desc col-md-12" style="width: 100%">
                                                <div class="display-tc">
                                                    <h2><a href="{{ route('articles.show', ['category' => $category->id, 'article' => $article->id]) }}">{{ $article->title }}</a></h2>
                                                    <h5>
                                                        <span>{{ $article->author }}</span>
                                                        <span>发布于</span>
                                                        <span>{{ $article->publish_time }}</span>
                                                    </h5>
                                                    <p>{{ $article->description }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @empty
                        <div class="col-md-8 col-md-offset-2 text-center colorlib-heading animate-box fadeInUp animated-fast">
                            <p>--- 暂无任何文章 ---</p>
                        </div>
                    @endforelse

                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        {{ $articles->links() }}
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection