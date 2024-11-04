@extends('layouts.front')

@section('content')
    <!-- Begin Uren's Tab Style Left Area -->
    <div class="sp-area sp-tab-style_left">
        <div class="container-fluid">
            <div class="sp-nav">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="sp-img_area">
                            <div class="sp-img_slider slick-img-slider uren-slick-slider" data-slick-options='{
                                                                "slidesToShow": 1,
                                                                "arrows": false,
                                                                "fade": true,
                                                                "draggable": false,
                                                                "swipe": false,
                                                                "asNavFor": ".sp-img_slider-nav"
                                                                }'>
                                @foreach($product->images as $image)
                                    <div class="single-slide zoom">
                                        <img src="{{ asset('images/'.$image->url) }}" alt="{{ $product->product_name }}">
                                    </div>
                                @endforeach
                            </div>
                            <div class="sp-img_slider-nav slick-slider-nav uren-slick-slider slider-navigation_style-4" data-slick-options='{
                                                                "slidesToShow": 3,
                                                                "asNavFor": ".sp-img_slider",
                                                                "focusOnSelect": true,
                                                                "arrows" : true,
                                                                "vertical" : true
                                                                }'>
                                @foreach($product->images as $image)
                                    <div class="single-slide">
                                        <img src="{{ asset('images/'.$image->url) }}" alt="{{ $product->product_name }} Thumnail">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="sp-content">
                            <div class="sp-heading">
                                <h5>{{ $product->product_name }}</h5>
                            </div>
                            <div class="sp-essential_stuff">
                                <ul>
                                    <li>Kode Produk <a href="javascript:void(0)">{{ $product->product_code }}</a></li>
                                    <li>Kategori <a href="javascript:void(0)">{{ $product->category->name }}</a></li>
                                    <li>Merek <a href="javascript:void(0)">{{ $product->merk->name }}</a></li>
                                    <li>Harga <a href="javascript:void(0)">{{ rp_format($product->price) }}</a></li>
                                    <li>Stok <a href="javascript:void(0)">{{ $product->qty }} {{ $product->unit }}</a></li>
                                    <li>Kondisi <a href="javascript:void(0)">{{ $product->condition }}</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Uren's Tab Style Left Area End Here -->

    <!-- Begin Uren's Single Product Tab Area -->
    <div class="sp-product-tab_area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="sp-product-tab_nav">
                        <div class="product-tab">
                            <ul class="nav product-menu">
                                <li><a class="active" data-toggle="tab" href="#description"><span>Deskripsi</span></a>
                                </li>
                                <li><a data-toggle="tab" href="#specification"><span>Spesifikasi</span></a></li>
                            </ul>
                        </div>
                        <div class="tab-content uren-tab_content">
                            <div id="description" class="tab-pane active show" role="tabpanel">
                                <div class="product-description">
                                    <p>{{ $product->description }}</p>
                                </div>
                            </div>
                            <div id="specification" class="tab-pane" role="tabpanel">
                                <table class="table table-bordered specification-inner_stuff">
                                    @foreach($product->specification as $item)
{{--                                        @dd($item)--}}
                                        <tbody>
                                            <tr>
                                                <td>{{ $item->spec_name }}</td>
                                                <td>{{ $item->spec_info }}</td>
                                            </tr>
                                        </tbody>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Uren's Single Product Tab Area End Here -->
@endsection
