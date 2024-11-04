@extends('layouts.front')

@section('content')
    <!-- Begin Uren's Breadcrumb Area -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <h2>Hasil Pencarian</h2>
                <ul>
                    <li class="active">dari kategori produk {{ $categoryName }} dengan kata kunci "<b>{{ $query }}</b>"</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Uren's Breadcrumb Area End Here -->

    @if(count($results) > 0)
        <!-- Begin Uren's Shop Grid Fullwidth  Area -->
        <div class="shop-content_wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shop-toolbar">
                            <div class="product-view-mode">
                                <a class="grid-3" data-target="gridview-3" data-toggle="tooltip" data-placement="top" title="Grid"><i class="fa fa-th-large"></i></a>
                                <a class="list" data-target="listview" data-toggle="tooltip" data-placement="top" title="List"><i class="fa fa-th-list"></i></a>
                            </div>
                            <div class="product-item-selection_area">
                                <div class="product-short">
                                    <label class="select-label">Ditemukan {{ $totalResults }} produk serupa</label>
                                </div>
                            </div>
                        </div>
                        <div class="shop-product-wrap grid gridview-3 listfullwidth img-hover-effect_area row">
                            @foreach($results as $item)
                                <div class="col-lg-4">
                                    <div class="product-slide_item">
                                        <div class="inner-slide">
                                            <div class="single-product">
                                                <div class="product-img">
                                                    <a href="{{ route('products.show', $item['product']->id) }}">
                                                        @php
                                                            $firstImage = $item['product']->images->first();
                                                            $secondImage = $item['product']->images->skip(1)->first();
                                                        @endphp
                                                        <img class="primary-img" src="{{ asset('images/'. ($firstImage ? $firstImage->url : 'default.jpg')) }}" style="height: 400px;">
                                                        <img class="secondary-img" src="{{ asset('images/'.($secondImage ? $secondImage->url : 'default.jpg')) }}">
                                                    </a>
                                                    @if (\Carbon\Carbon::parse($item['product']->created_at)->isToday())
                                                        <div class="sticker">
                                                            <span class="sticker">New</span>
                                                        </div>
                                                    @endif
                                                    <div class="add-actions">
                                                        <ul>
                                                            <li class="quick-view-btn"><a href="{{ route('products.show', $item['product']->id) }}" data-toggle="tooltip" data-placement="top" title="Detail Produk"><i
                                                                        class="ion-android-open"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="product-content">
                                                    <div class="product-desc_info">
                                                        <div class="rating-box">
                                                            <span><b>{{ $item['product']->category->name }}</b></span>
                                                        </div>
                                                        <h6><a class="product-name" href="{{ route('products.show', $item['product']->id) }}">{{ $item['product']->product_name }}</a></h6>
                                                        <div class="price-box">
                                                            <span class="new-price">{{ rp_format($item['product']->price) }}</span>
                                                        </div>
                                                        <div class="rating-box">
                                                            <ul>
                                                                <li>nilai similarity adalah {{ $item['similarity'] }}</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-slide_item">
                                        <div class="single-product">
                                            <div class="product-img">
                                                <a href="{{ route('products.show', $item['product']->id) }}">
                                                    @php
                                                        $firstImage = $item['product']->images->first();
                                                        $secondImage = $item['product']->images->skip(1)->first();
                                                    @endphp
                                                    <img class="primary-img" src="{{ asset('images/'. ($firstImage ? $firstImage->url : 'default.jpg')) }}" style="height: 400px;">
                                                    <img class="secondary-img" src="{{ asset('images/'.($secondImage ? $secondImage->url : 'default.jpg')) }}">
                                                </a>
                                                @if (\Carbon\Carbon::parse($item['product']->created_at)->isToday())
                                                    <div class="sticker-area-2">
                                                        <span class="sticker">New</span>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="product-content">
                                                <div class="product-desc_info">
                                                    <div class="rating-box">
                                                        <span><b>{{ $item['product']->category->name }}</b></span>
                                                    </div>
                                                    <h6><a class="product-name" href="{{ route('products.show', $item['product']->id) }}l">{{ $item['product']->product_name }}</a></h6>
                                                    <div class="price-box">
                                                        <span class="new-price new-price-2">{{ rp_format($item['product']->price) }}</span>
                                                    </div>
                                                    <div class="product-short_desc">
                                                        <p>{{ $item['product']->description }}</p>
                                                    </div>
                                                </div>
                                                <div class="add-actions">
                                                    <ul>
                                                        <li class="quick-view-btn"><a href="{{ route('products.show', $item['product']->id) }}" data-toggle="tooltip" data-placement="top" title="Detail Produk"><i
                                                                    class="ion-android-open"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="uren-paginatoin-area">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            {{ $results->links('components.pagination') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Uren's Shop Grid Fullwidth  Area End Here -->
    @else
        <div class="error404-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 ml-auto mr-auto text-center">
                        <div class="search-error-wrapper">
                            <h1>404</h1>
                            <h2>Produk Tidak Ditemukan</h2>
                            <p class="short_desc">Produk yang anda cari tidak ditemukan. Mungkin anda salah menginputkan kata kunci, silahkan coba kata kunci lain.</p>
                            <div class="uren-btn-ps_center mt-3"><a href="{{ route('home') }}" class="uren-error_btn">Kembali Ke Beranda</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
