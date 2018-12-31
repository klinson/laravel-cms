@extends($_theme_info['view_root_path'].'.layouts.app')

@section('title'){{ $category->title }}@endsection
@section('header-bg')
    background-image:url({{ get_admin_file_url($category->thumbnail) }}); background-size:cover; background-position: center center;background-attachment:fixed;@endsection

@section('header')
    <div class="container">
        <div class="row height align-items-center justify-content-center">
            <div class="col-lg-10" style="background: rgba(0, 0, 0, 0.5);padding: 10em 1em;">
                <div class="generic-banner-content">
                    <h2 class="text-white">{{ $category->title }}</h2>
                    <p class="text-white">{{ $category->description }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    @if($category->is_page)
        <div class="whole-wrap">
            <div class="container">
                <div class="row">
                    @if(isset($articles[0]))
                        <ucapcontent class="col-md-12">
                            {!! $articles[0]->content !!}
                        </ucapcontent>
                    @endif
                </div>
            </div>
        </div>
    @else
        <div class="whole-wrap">
            <div class="container">
                <div class="section-top-border">
                    <h2 class="mb-30">{{ $category->title }}</h2>
                    @forelse ($articles as $article)
                        <a href="{{ route('articles.show', ['category' => $category->id, 'article' => $article->id]) }}">
                            <div class="row" style="color: #777777">
                                <div class="single-feature mb-30 col-md-12">
                                    <div class="row">
                                        <div class="col-md-3" style="height: 175px;">
                                            <img src="{{ get_admin_file_url($article->thumbnail, '', asset($_theme_info['default_article_thumbnail'])) }}" alt="" class="img-fluid img-thumbnail" style="width: 100%;max-height: 160px">
                                        </div>
                                        <div class="col-md-9 mt-sm-20">
                                            <div class="title d-flex flex-row pb-20">
                                                <h3>{{ $article->title }}</h3>
                                            </div>
                                            <p>
                                                <span>{{ $article->author }}</span>
                                                <span>发布于</span>
                                                <span>{{ $article->publish_time }}</span>
                                            </p>
                                            <p>
                                                {{ $article->description }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="row" style="color: #777777">
                            <div class="mb-30 col-md-12">
                                <div class="text-center">
                                    <span>--- 暂无任何文章 ---</span>
                                </div>
                            </div>
                        </div>
                    @endforelse
                    <div class="row">
                        <div class="col-md-12 text-center pagination-lg" style="margin: 0 auto;display: -webkit-flex;-webkit-justify-content: center;-webkit-align-items: center;">
                            {{ $articles->links($_theme_info['view_root_path'].'.page.bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection