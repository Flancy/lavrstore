@extends('layouts.app')

@section('content')
    <section class="products">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="h2"><span>Каталог товаров</h2>
                </div>
            </div>
            <div class="row categories-navbar">
                @foreach($categories as $category)
                    <div class="col-sm-3">
                        <a href="{{ route('catalog.category', $category->slug) }}" class="categories__item" style="background-color: {{ $category->bg_color }};
                        color: {{ $category->text_color }};
                        {{ (request()->segment(2) == $category->slug) ? 'text-decoration: underline' : '' }}
                        ">
                            {{ $category->title }}
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="row">
                @foreach($products as $product)
                    @foreach($product->products as $product)
                        <div class="col-sm-4 col-md-3">
                            <div class="products__item">
                                <div class="products__item-head">
                                    <img src="{{ Voyager::image($product->image) }}" alt="{{ $product->title }}" class="products__img img-fluid">
                                    @if($product->hot)
                                        <img src="{{ asset('img/ico/hot.svg') }}" alt="" class="hot-ico">
                                    @endif
                                </div>
                                <div class="products__item-body">
                                    <a href="{{ route('catalog.category', $product->categories->slug) }}" class="text-category">{{ $product->categories->title }}</a>
                                    <a href="{{ route('product.show', $product->id) }}" class="text-head">{{ $product->title }}</a>
                                    <div class="text">
                                        @if($product->short_content !== null)
                                            {{ Markdown::parse($product->short_content) }}
                                        @endif
                                    </div>
                                </div>
                                <div class="products__item-foot">
                                    <div class="foot_left">
                                        @if($product->discount_price !== null)
                                            <p class="price_strike">{{ $product->regular_price }} ₽</p>
                                            <p class="price_regular">{{ $product->discount_price }} ₽</p>
                                        @else
                                            <p class="price_regular">{{ $product->regular_price }} ₽</p>
                                        @endif
                                    </div>
                                    <div class="foot_right">
                                        <form action="{{ route('cart.store') }}" method="POST">
                                            @csrf
                                            
                                            <input type="hidden" value="{{ $product->id }}" name="id">
                                            <input type="hidden" value="{{ $product->title }}" name="title">
                                            @if($product->discount_price !== '')
                                                <input type="hidden" value="{{ $product->discount_price }}" name="price">
                                            @else
                                                <input type="hidden" value="{{ $product->regular_price }}" name="price">
                                            @endif
                                            <input type="hidden" value="{{ $product->image }}" name="image">
                                            <input type="hidden" value="1" id="quantity" name="quantity">

                                            <button class="btn btn-red_outline">В корзину</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
    </section>
@endsection
