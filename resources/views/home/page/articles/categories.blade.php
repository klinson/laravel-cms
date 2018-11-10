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

@endsection