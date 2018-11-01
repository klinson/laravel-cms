@extends($_theme_info['view_root_path'].'.layouts.app')

@section('header')
    <section id="home" class="video-hero" style="height: 500px; background-image: url({{ $_theme_info['style_root_path'] }}/images/cover_img_1.jpg);  background-size:cover; background-position: center center;background-attachment:fixed;" data-section="home">
        <div class="overlay"></div>
        <div class="display-t display-t2 text-center">
            <div class="display-tc display-tc2">
                <div class="container">
                    <div class="col-md-12 col-md-offset-0">
                        <div class="animate-box">
                            <h2>Services</h2>
                            <p class="breadcrumbs"><span><a href="index.html">Home</a></span> <span>Services</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <div class="colorlib-about">
        <div class="container">
            <div class="row row-pb-lg">
                <div class="col-md-6 animate-box">
                    <div class="video colorlib-video" style="background-image: url({{ $_theme_info['style_root_path'] }}images/about.jpg);">
                        <a href="https://vimeo.com/channels/staffpicks/93951774" class="popup-vimeo"><i class="icon-play3"></i></a>
                        <div class="overlay"></div>
                    </div>
                </div>
                <div class="col-md-6 animate-box">
                    <h2>About unapp</h2>
                    <p>The Big Oxmox advised her not to do so, because there were thousands of bad Commas, wild Question Marks and devious Semikoli, but the Little Blind Text didn’t listen. She packed her seven versalia, put her initial into the belt and made herself on the way.</p>
                    <p>When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road, the Line Lane. Pityful a rethoric question ran over her cheek, then she continued her way.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center colorlib-heading animate-box">
                    <h2>Collaborate with your design team in a new way</h2>
                    <p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 text-center animate-box">
                    <div class="staff-entry">
                        <a href="#" class="staff-img" style="background-image: url({{ $_theme_info['style_root_path'] }}images/person1.jpg);"></a>
                        <div class="desc">
                            <h3>Emily Turner</h3>
                            <span>Developer</span>
                            <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
                            <p>
                            <ul class="colorlib-social-icons">
                                <li><a href="#"><i class="icon-twitter"></i></a></li>
                                <li><a href="#"><i class="icon-facebook"></i></a></li>
                                <li><a href="#"><i class="icon-linkedin"></i></a></li>
                                <li><a href="#"><i class="icon-dribbble"></i></a></li>
                            </ul>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 text-center animate-box">
                    <div class="staff-entry">
                        <a href="#" class="staff-img" style="background-image: url({{ $_theme_info['style_root_path'] }}images/person2.jpg);"></a>
                        <div class="desc">
                            <h3>Adam Morris</h3>
                            <span>Developer</span>
                            <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
                            <p>
                            <ul class="colorlib-social-icons">
                                <li><a href="#"><i class="icon-twitter"></i></a></li>
                                <li><a href="#"><i class="icon-facebook"></i></a></li>
                                <li><a href="#"><i class="icon-linkedin"></i></a></li>
                                <li><a href="#"><i class="icon-dribbble"></i></a></li>
                            </ul>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 text-center animate-box">
                    <div class="staff-entry">
                        <a href="#" class="staff-img" style="background-image: url({{ $_theme_info['style_root_path'] }}images/person3.jpg);"></a>
                        <div class="desc">
                            <h3>Noah Nelson</h3>
                            <span>Designer</span>
                            <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
                            <p>
                            <ul class="colorlib-social-icons">
                                <li><a href="#"><i class="icon-twitter"></i></a></li>
                                <li><a href="#"><i class="icon-facebook"></i></a></li>
                                <li><a href="#"><i class="icon-linkedin"></i></a></li>
                                <li><a href="#"><i class="icon-dribbble"></i></a></li>
                            </ul>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 text-center animate-box">
                    <div class="staff-entry">
                        <a href="#" class="staff-img" style="background-image: url({{ $_theme_info['style_root_path'] }}images/person4.jpg);"></a>
                        <div class="desc">
                            <h3>Dorothy Murphy</h3>
                            <span>Designer</span>
                            <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
                            <p>
                            <ul class="colorlib-social-icons">
                                <li><a href="#"><i class="icon-twitter"></i></a></li>
                                <li><a href="#"><i class="icon-facebook"></i></a></li>
                                <li><a href="#"><i class="icon-linkedin"></i></a></li>
                                <li><a href="#"><i class="icon-dribbble"></i></a></li>
                            </ul>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection