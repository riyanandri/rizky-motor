@extends('layouts.front')

@section('content')
    <!-- Begin Uren's Breadcrumb Area -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <h2>Koleksi Produk Kami</h2>
                <ul>
                    <li><a href="{{ route('home') }}">Beranda</a></li>
                    <li class="active">Semua Produk</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Uren's Breadcrumb Area End Here -->

    <!-- Begin Uren's Shop Grid Fullwidth  Area -->
    <div class="shop-content_wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shop-toolbar">
                        <div class="product-view-mode">
                            <a class="grid-1" data-target="gridview-1" data-toggle="tooltip" data-placement="top" title="1">1</a>
                            <a class="grid-2" data-target="gridview-2" data-toggle="tooltip" data-placement="top" title="2">2</a>
                            <a class="active grid-3" data-target="gridview-3" data-toggle="tooltip" data-placement="top" title="3">3</a>
                            <a class="grid-4" data-target="gridview-4" data-toggle="tooltip" data-placement="top" title="4">4</a>
                            <a class="grid-5" data-target="gridview-5" data-toggle="tooltip" data-placement="top" title="5">5</a>
                            <a class="list" data-target="listview" data-toggle="tooltip" data-placement="top" title="List"><i class="fa fa-th-list"></i></a>
                        </div>
                        <div class="product-item-selection_area">
                            <div class="product-short">
                                <label class="select-label">Total {{ $products->count() }} produk</label>
                            </div>
                        </div>
                    </div>
                    <div class="shop-product-wrap grid gridview-3 listfullwidth img-hover-effect_area row">
                        @foreach($products as $item)
                            <div class="col-lg-4">
                                <div class="product-slide_item">
                                    <div class="inner-slide">
                                        <div class="single-product">
                                            <div class="product-img">
                                                <a href="{{ route('products.show', $item->id) }}">
                                                    @php
                                                        $firstImage = $item->images->first();
                                                        $secondImage = $item->images->skip(1)->first();
                                                    @endphp
                                                    <img class="primary-img" src="{{ asset('images/'. ($firstImage ? $firstImage->url : 'default.jpg')) }}">
                                                    <img class="secondary-img" src="{{ asset('images/'.($secondImage ? $secondImage->url : 'default.jpg')) }}">
                                                </a>
                                                @if (\Carbon\Carbon::parse($item->created_at)->isToday())
                                                    <div class="sticker">
                                                        <span class="sticker">New</span>
                                                    </div>
                                                @endif
                                                <div class="add-actions">
                                                    <ul>
                                                        <li class="quick-view-btn"><a href="{{ route('products.show', $item->id) }}" data-toggle="tooltip" data-placement="top" title="Detail Produk"><i
                                                                    class="ion-android-open"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <div class="product-desc_info">
                                                    <div class="rating-box">
                                                        <span><b>{{ $item->category->name }}</b></span>
                                                    </div>
                                                    <h6><a class="product-name" href="{{ route('products.show', $item->id) }}">{{ $item->product_name }}</a></h6>
                                                    <div class="price-box">
                                                        <span class="new-price">{{ rp_format($item->price) }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-slide_item">
                                    <div class="single-product">
                                        <div class="product-img">
                                            <a href="{{ route('products.show', $item->id) }}">
                                                @php
                                                    $firstImage = $item->images->first();
                                                    $secondImage = $item->images->skip(1)->first();
                                                @endphp
                                                <img class="primary-img" src="{{ asset('images/'. ($firstImage ? $firstImage->url : 'default.jpg')) }}">
                                                <img class="secondary-img" src="{{ asset('images/'.($secondImage ? $secondImage->url : 'default.jpg')) }}">
                                            </a>
                                        </div>
                                        <div class="product-content">
                                            <div class="product-desc_info">
                                                <div class="rating-box">
                                                    <span><b>{{ $item->category->name }}</b></span>
                                                </div>
                                                <h6><a class="product-name" href="{{ route('products.show', $item->id) }}">{{ $item->product_name }}</a></h6>
                                                <div class="price-box">
                                                    <span class="new-price">{{ rp_format($item->price) }}</span>
                                                </div>
                                                <div class="product-short_desc">
                                                    <p>{{ $item->description }}</p>
                                                </div>
                                            </div>
                                            <div class="add-actions">
                                                <ul>
                                                    <li class="quick-view-btn"><a href="{{ route('products.show', $item->id) }}" data-toggle="tooltip" data-placement="top" title="Detail Produk"><i
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
                                            {{ $products->links('components.pagination') }}
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
@endsection
