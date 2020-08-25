@extends('layouts.app')

@section('content')
    <nav aria-label="breadcrumb">
        <div class="container">
            <div class="row">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Домой <i class="fa fa-chevron-right"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ route('catalog.category', $product->categories->title) }}">{{ $product->categories->title }} <i class="fa fa-chevron-right"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $product->title }}</li>
                </ol>
            </div>
        </div>
    </nav>

    <section class="product">
        <div class="container">
            <div class="row">
                <div class="col-md-6 flex-row align-items-start">
                    <div class="product-slider_left">
                        @foreach(json_decode($product->gallery) as $image)
                            <div class="item">
                                <img src="{{ Voyager::image($image) }}" class="product-slider-img img-fluid">
                            </div>
                        @endforeach
                    </div>
                    <div class="product-slider_right">
                        <div class="img-wrap">
                            <img src="{{ Voyager::image($product->image) }}" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="product__head">
                        <div class="product__category">{{ $product->categories->title }}</div>

                        <h1 class="h1">{{ $product->title }}</h1>

                        <div class="product__articul">Артиткул: {{ $product->article }}</div>

                        <div class="product__stars">ЗВЕЗДЫ ПОЗЖЕ</div>

                        <div class="product__content">
                            {{ Markdown::parse($product->content) }}
                        </div>
                    </div>
                    <div class="product__foot">
                        <p class="product__price">
                            @if($product->discount_price !== '')
                                <span class="price_strike">{{ $product->regular_price }} ₽</span>
                                <span class="price_regular">{{ $product->discount_price }} ₽</span>
                            @else
                                <span class="price_regular">{{ $product->discount_price }} ₽</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection