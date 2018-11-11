@extends($_theme_info['view_root_path'].'.layouts.app')

@section('title'){{ $article->title }}@endsection

@section('header-bg')
    background-image:url({{ get_admin_file_url($article->thumbnail) }}); background-size:cover; background-position: center center;background-attachment:fixed;@endsection

@section('header')
    <div class="container">
        <div class="row height align-items-center justify-content-center">
            <div class="col-lg-10" style="background: rgba(0, 0, 0, 0.5);padding: 10em 1em;">
                <div class="generic-banner-content">
                    <h2 class="text-white">{{ $article->title }}</h2>
                    <p class="text-white">{{ $article->description }}</p>
                    <p class="text-white">
                        <span>{{ $article->author }}</span>
                        <span>发布于</span>
                        <span>{{ $article->publish_time }}</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="main-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ucapcontent>
                        {!! $article->content !!}
                    </ucapcontent>
                </div>
            </div>
        </div>
    </div>
@endsection