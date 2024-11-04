@extends('layouts.front')

@section('content')
    <!-- Begin Popular Search Area -->
    <div class="popular-search_area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="popular-search">
{{--                        <label>Paling Sering Dicari :</label>--}}
{{--                        <a href="javascript:void(0)">Brakes & Rotors,</a>--}}
{{--                        <a href="javascript:void(0)">Lighting,</a>--}}
{{--                        <a href="javascript:void(0)">Perfomance,</a>--}}
{{--                        <a href="javascript:void(0)">Wheels & Tires</a>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Popular Search Area End Here -->

    <div class="uren-slider_area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-slider slider-navigation_style-2">
                        <!-- Begin Single Slide Area -->
                        <div class="single-slide animation-style-01 bg-1">
                            <div class="slider-content">
                                <span>New thinking new possibilities</span>
                                <h3>Car interior</h3>
                                <h4>Starting at <span>$99.00</span></h4>
                                <div class="uren-btn-ps_left slide-btn">
                                    <a class="uren-btn" href="shop-left-sidebar.html">Read More</a>
                                </div>
                            </div>
                        </div>
                        <!-- Single Slide Area End Here -->
                        <!-- Begin Single Slide Area -->
                        <div class="single-slide animation-style-02 bg-2">
                            <div class="slider-content slider-content-2">
                                <span class="primary-text_color">Car, Truck, CUV &amp; SUV Tires</span>
                                <h3>Wheels &amp; Tires</h3>
                                <h4>Sale up to 20% off</h4>
                                <div class="uren-btn-ps_left slide-btn">
                                    <a class="uren-btn" href="shop-left-sidebar.html">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Begin Featured Categories Area -->
    <div class="featured-categories_area">
        <div class="container-fluid">
            <div class="section-title_area">
                <span>Koleksi Produk Kami</span>
                <h3>Merek Unggulan</h3>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="featured-categories_slider uren-slick-slider slider-navigation_style-1" data-slick-options='{
                        "slidesToShow": 4,
                        "spaceBetween": 30,
                        "arrows" : true
                       }' data-slick-responsive='[
                                             {"breakpoint":1599, "settings": {"slidesToShow": 3}},
                                             {"breakpoint":1200, "settings": {"slidesToShow": 2}},
                                             {"breakpoint":768, "settings": {"slidesToShow": 1}}
                                         ]'>
                        @foreach($merks as $item)
                            <div class="slide-item">
                                <div class="slide-inner">
                                    <div class="slide-image_area">
                                        <a href="{{ route('merk.products', $item->id) }}">
                                            <img src="{{ asset('images/'. $item->images->first()->url) }}" style="max-height: 175px;">
                                        </a>
                                    </div>
                                    <div class="slide-content_area">
                                        <h3><a href="{{ route('merk.products', $item->id) }}">{{ $item->name }}</a></h3>
                                        <span>({{ $item->product->count() }} Produk)</span>
                                        <div class="uren-btn-ps_left">
                                            <a class="uren-btn" href="{{ route('merk.products', $item->id) }}">Lihat Produk</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Featured Categories Area End Here -->

    <!-- Begin Uren's Product Area -->
    <div class="uren-product_area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title_area">
                        <span>Produk Terbaru Minggu Ini</span>
                        <h3>Produk Teratas</h3>
                    </div>
                    <div class="product-slider uren-slick-slider slider-navigation_style-1 img-hover-effect_area" data-slick-options='{
                        "slidesToShow": 6,
                        "arrows" : true
                        }' data-slick-responsive='[
                                                {"breakpoint":1501, "settings": {"slidesToShow": 4}},
                                                {"breakpoint":1200, "settings": {"slidesToShow": 3}},
                                                {"breakpoint":992, "settings": {"slidesToShow": 2}},
                                                {"breakpoint":767, "settings": {"slidesToShow": 1}},
                                                {"breakpoint":480, "settings": {"slidesToShow": 1}}
                                            ]'>
                        @foreach($products as $item)
                            <div class="product-slide_item">
                                <div class="inner-slide">
                                    <div class="single-product">
                                        <div class="product-img">
                                            <a href="{{ route('products.show', $item->id) }}">
                                                @php
                                                    $firstImage = $item->images->first();
                                                    $secondImage = $item->images->skip(1)->first();
                                                @endphp
                                                <img class="primary-img" src="{{ asset('images/'. ($firstImage ? $firstImage->url : 'default.jpg')) }}" style="height: 200px;">
                                                <img class="secondary-img" src="{{ asset('images/'.($secondImage ? $secondImage->url : 'default.jpg')) }}">
                                            </a>
                                            <div class="sticker">
                                                <span class="sticker">Baru</span>
                                            </div>
                                            <div class="add-actions">
                                                <ul class="mt-3">
                                                    <li class="quick-view-btn"><a href="{{ route('products.show', $item->id) }}" data-toggle="tooltip" data-placement="top" title="Detail Produk"><i
                                                                class="ion-android-open"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="product-content">
                                            <div class="product-desc_info mt-3">
                                                <h6><a class="product-name" href="{{ route('products.show', $item->id) }}">{{ $item->product_name }}</a></h6>
                                                <div class="price-box">
                                                    <span class="new-price">{{ rp_format($item->price) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Uren's Product Area End Here -->

    <!-- Begin Uren's Brand Area -->
    <div class="uren-brand_area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title_area">
                        <span>Top Quality Partner</span>
                        <h3>Shop By Brands</h3>
                    </div>
                    <div class="brand-slider uren-slick-slider img-hover-effect_area" data-slick-options='{
                        "slidesToShow": 6
                        }' data-slick-responsive='[
                                                {"breakpoint":1200, "settings": {"slidesToShow": 5}},
                                                {"breakpoint":992, "settings": {"slidesToShow": 3}},
                                                {"breakpoint":767, "settings": {"slidesToShow": 3}},
                                                {"breakpoint":577, "settings": {"slidesToShow": 2}},
                                                {"breakpoint":321, "settings": {"slidesToShow": 1}}
                                            ]'>
                        @foreach($merks as $item)
                            <div class="slide-item">
                                <div class="inner-slide">
                                    <div class="single-product">
                                        <a href="javascript:void(0)">
                                            <img src="{{ asset('images/'.$item->images->first()->url) }}" alt="{{ $item->name }}" style="max-height: 150px;">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Uren's Brand Area End Here -->
@endsection
