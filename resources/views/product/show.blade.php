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
                        @if($product->gallery !== null)
                            @foreach(json_decode($product->gallery) as $image)
                                <div class="item">
                                    <img src="{{ Voyager::image($image) }}" class="product-slider-img img-fluid">
                                </div>
                            @endforeach
                        @endif
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

                        <!--<div class="product__stars">ЗВЕЗДЫ ПОЗЖЕ</div>-->

                        <div class="product__content">
                            @if($product->content !== null)
                                {{ Markdown::parse($product->content) }}
                            @endif
                        </div>
                    </div>
                    <div class="product__foot">
                        <p class="product__price">
                            @if($product->discount_price !== null)
                                <span class="price_strike">{{ $product->regular_price }} ₽</span>
                                <span class="price_regular">{{ $product->discount_price }} ₽</span>
                            @else
                                <span class="price_regular">{{ $product->regular_price }} ₽</span>
                            @endif
                        </p>

                        <form action="{{ route('cart.store') }}" method="POST" class="add-to-cart-wrap">
                            @csrf
                            
                            <input type="hidden" value="{{ $product->id }}" name="id">
                            <input type="hidden" value="{{ $product->title }}" name="title">
                            @if($product->discount_price !== '')
                                <input type="hidden" value="{{ $product->discount_price }}" name="price">
                            @else
                                <input type="hidden" value="{{ $product->regular_price }}" name="price">
                            @endif
                            <input type="hidden" value="{{ $product->image }}" name="image">

                            <div class="count">
                                <span class="count-minus">-</span>
                                <input name="quantity" type="number" class="count-number" value="1" min="1">
                                <span class="count-plus">+</span>
                            </div>

                            <button class="btn btn-red_outline">В корзину</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="products products_popular">
        <div class="container">
            <div class="row">
                @foreach($product_hot as $product)
                    <div class="col-md-4">
                        <div class="product__item">
                            <div class="item_left">
                                <img src="{{ Voyager::image($product->image) }}" alt="{{ $product->title }}" class="img-fluid">
                            </div>
                            <div class="item_right">
                                <p class="text-head">{{ $product->title }}</p>

                                <div class="products__item-foot">
                                    <div class="foot_left">
                                        @if($product->discount_price !== '')
                                            <p class="price_strike">{{ $product->regular_price }} ₽</p>
                                            <p class="price_regular">{{ $product->discount_price }} ₽</p>
                                        @else
                                            <p class="price_regular">{{ $product->discount_price }} ₽</p>
                                        @endif
                                    </div>
                                    <div class="foot_right">
                                        <a href="#" class="btn btn-red_outline">В корзину</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection