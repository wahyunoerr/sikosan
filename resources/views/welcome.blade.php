@extends('layouts.landing.app')
@section('title', 'Boking Sekarang')
@section('content')
    <!-- banner-section -->
    <section class="banner-section style-two centred">
        <div class="banner-carousel owl-theme owl-carousel owl-nav-none">
            <div class="slide-item">
                <div class="image-layer" style="background-image:url(assets/assetsLanding/images/banner/banner-3.jpg)"></div>
                <div class="auto-container">
                    <div class="content-box">
                        <div class="icon-box"><i class="icon-warehouse"></i></div>
                        <h3>Mod Tempor Incididunt Dolore Magna Aliqua</h3>
                        <h1>Leading Company To Install, <br />Maintain & Repair Garage Doors</h1>
                        <div class="btn-box clearfix">
                            <a href="index-2.html" class="banner-btn"><span class="btn-shape"></span>learn
                                more</a>
                            <a href="index-2.html" class="theme-btn-one"><span class="btn-shape"></span>get
                                estimate</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="slide-item">
                <div class="image-layer" style="background-image:url(assets/assetsLanding/images/banner/banner-4.jpg)">
                </div>
                <div class="auto-container">
                    <div class="content-box">
                        <div class="icon-box"><i class="icon-warehouse"></i></div>
                        <h3>Mod Tempor Incididunt Dolore Magna Aliqua</h3>
                        <h1>Leading Company To Install, <br />Maintain & Repair Garage Doors</h1>
                        <div class="btn-box clearfix">
                            <a href="index-2.html" class="banner-btn"><span class="btn-shape"></span>learn
                                more</a>
                            <a href="index-2.html" class="theme-btn-one"><span class="btn-shape"></span>get
                                estimate</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="slide-item">
                <div class="image-layer" style="background-image:url(assets/assetsLanding/images/banner/banner-3.jpg)">
                </div>
                <div class="auto-container">
                    <div class="content-box">
                        <div class="icon-box"><i class="icon-warehouse"></i></div>
                        <h3>Mod Tempor Incididunt Dolore Magna Aliqua</h3>
                        <h1>Leading Company To Install, <br />Maintain & Repair Garage Doors</h1>
                        <div class="btn-box clearfix">
                            <a href="index-2.html" class="banner-btn"><span class="btn-shape"></span>learn
                                more</a>
                            <a href="index-2.html" class="theme-btn-one"><span class="btn-shape"></span>get
                                estimate</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- banner-section end -->


    <!-- project-style-two -->
    <section class="project-style-two">
        <div class="auto-container">
            <div class="sortable-masonry">
                <div class="upper-box">
                    <div class="sec-title">
                        <span>Kamar Pilihan</span>
                        <h2>Kamar Pilihan</h2>
                        <p>Pilih kamar sesuai kenyamanan anda.</p>
                    </div>
                    <div class="filters">
                        <ul class="filter-tabs filter-btns clearfix">
                            <li class="active filter" data-role="button" data-filter=".all">Semua Kamar</li>
                            @foreach ($kamar as $item)
                                <li class="filter" data-role="button" data-filter=".{{ $kamar->status }}">
                                    {{ $kamar->status }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="items-container row clearfix">
                    <div
                        class="col-lg-4 col-md-6 col-sm-12 masonry-item small-column all residential door_repair commercial">
                        <div class="project-block-two">
                            <div class="inner-box">
                                <figure class="image-box"><img src="assets/images/gallery/project-4.jpg" alt="">
                                </figure>
                                <div class="link">
                                    <a href="assets/images/gallery/project-4.jpg" class="lightbox-image"
                                        data-fancybox="gallery"><i class="icon-search"></i></a>
                                </div>
                                <div class="text">
                                    <a href="index-2.html">Residential Project</a>
                                    <h3>Garage Door Repair</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- project-style two end -->


    <!-- testimonial-style-two -->
    <section class="testimonial-style-two centred">
        <div class="pattern-layer" style="background-image: url(assets/images/shape/shape-6.png);"></div>
        <div class="thumb-box">
            <figure class="thumb thumb-1"><img src="assets/images/resource/testimonial-thumb-1.png" alt="">
            </figure>
            <figure class="thumb thumb-2"><img src="assets/images/resource/testimonial-thumb-2.png" alt="">
            </figure>
            <figure class="thumb thumb-3"><img src="assets/images/resource/testimonial-thumb-3.png" alt="">
            </figure>
            <figure class="thumb thumb-4"><img src="assets/images/resource/testimonial-thumb-4.png" alt="">
            </figure>
            <figure class="thumb thumb-5"><img src="assets/images/resource/testimonial-thumb-5.png" alt="">
            </figure>
            <figure class="thumb thumb-6"><img src="assets/images/resource/testimonial-thumb-6.png" alt="">
            </figure>
            <div class="anim-icon icon-1"></div>
            <div class="anim-icon icon-2"></div>
            <div class="anim-icon icon-3"></div>
            <div class="anim-icon icon-4"></div>
            <div class="anim-icon icon-5"></div>
            <div class="anim-icon icon-6"></div>
        </div>
        <div class="auto-container">
            <div class="single-item-carousel owl-carousel owl-theme owl-nav-none dots-style-one">
                <div class="testimonial-block-two">
                    <div class="inner-box">
                        <div class="icon-box">
                            <i class="icon-quotes"></i>
                            <figure class="quot-icon-1"><img
                                    src="{{ asset('assets/assetsLanding/images/icons/quote-2.png') }}" alt="">
                            </figure>
                            <figure class="quot-icon-2"><img
                                    src="{{ asset('assets/assetsLanding/images/icons/quote-3.png') }}" alt="">
                            </figure>
                        </div>
                        <h2>What Customers Are Saying ...</h2>
                        <div class="text">
                            <p>Excepteur sint occaecat cupidatat nony proidents sunt culpa qui officia deserunt
                                mollit anim laborum. Sed utm perspiciatis omnis iste natus eror sit voluptatem
                                accusantium doloremque laudantium.</p>
                        </div>
                        <div class="author-box">
                            <h4>Aaron J. Finch</h4>
                            <span class="designation">Newyork, USA</span>
                            <ul class="rating clearfix">
                                <li><i class="fas fa-star"></i></li>
                                <li><i class="fas fa-star"></i></li>
                                <li><i class="fas fa-star"></i></li>
                                <li><i class="fas fa-star"></i></li>
                                <li><i class="fas fa-star"></i></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="testimonial-block-two">
                    <div class="inner-box">
                        <div class="icon-box">
                            <i class="icon-quotes"></i>
                            <figure class="quot-icon-1"><img src="assets/images/icons/quote-2.png" alt="">
                            </figure>
                            <figure class="quot-icon-2"><img src="assets/images/icons/quote-3.png" alt="">
                            </figure>
                        </div>
                        <h2>What Customers Are Saying ...</h2>
                        <div class="text">
                            <p>Excepteur sint occaecat cupidatat nony proidents sunt culpa qui officia deserunt
                                mollit anim laborum. Sed utm perspiciatis omnis iste natus eror sit voluptatem
                                accusantium doloremque laudantium.</p>
                        </div>
                        <div class="author-box">
                            <h4>Aaron J. Finch</h4>
                            <span class="designation">Newyork, USA</span>
                            <ul class="rating clearfix">
                                <li><i class="fas fa-star"></i></li>
                                <li><i class="fas fa-star"></i></li>
                                <li><i class="fas fa-star"></i></li>
                                <li><i class="fas fa-star"></i></li>
                                <li><i class="fas fa-star"></i></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="testimonial-block-two">
                    <div class="inner-box">
                        <div class="icon-box">
                            <i class="icon-quotes"></i>
                            <figure class="quot-icon-1"><img src="assets/images/icons/quote-2.png" alt="">
                            </figure>
                            <figure class="quot-icon-2"><img src="assets/images/icons/quote-3.png" alt="">
                            </figure>
                        </div>
                        <h2>What Customers Are Saying ...</h2>
                        <div class="text">
                            <p>Excepteur sint occaecat cupidatat nony proidents sunt culpa qui officia deserunt
                                mollit anim laborum. Sed utm perspiciatis omnis iste natus eror sit voluptatem
                                accusantium doloremque laudantium.</p>
                        </div>
                        <div class="author-box">
                            <h4>Aaron J. Finch</h4>
                            <span class="designation">Newyork, USA</span>
                            <ul class="rating clearfix">
                                <li><i class="fas fa-star"></i></li>
                                <li><i class="fas fa-star"></i></li>
                                <li><i class="fas fa-star"></i></li>
                                <li><i class="fas fa-star"></i></li>
                                <li><i class="fas fa-star"></i></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- testimonial-style-two end -->
@endsection
