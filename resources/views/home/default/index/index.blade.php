@extends($_theme_info['view_root_path'].'.layouts.app')

@section('content')
    <div class="colorlib-featured">
        <div class="row animate-box">
            <div class="featured-wrap">
                <div class="owl-carousel">
                    <div class="item">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="featured-entry">
                                <img class="img-responsive" src="{{ $_theme_info['style_root_path'] }}/images/dashboard_full_1.jpg" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="featured-entry">
                                <img class="img-responsive" src="{{ $_theme_info['style_root_path'] }}/images/dashboard_full_2.jpg" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="featured-entry">
                                <img class="img-responsive" src="{{ $_theme_info['style_root_path'] }}/images/dashboard_full_3.jpg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="colorlib-services colorlib-bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-4 text-center animate-box">
                    <div class="services">
							<span class="icon">
								<i class="icon-browser"></i>
							</span>
                        <div class="desc">
                            <h3>Create your own template</h3>
                            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-center animate-box">
                    <div class="services">
							<span class="icon">
								<i class="icon-download"></i>
							</span>
                        <div class="desc">
                            <h3>Automatic Backup Data</h3>
                            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-center animate-box">
                    <div class="services">
							<span class="icon">
								<i class="icon-layers"></i>
							</span>
                        <div class="desc">
                            <h3>Page Builder</h3>
                            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection