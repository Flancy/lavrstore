@extends('layouts.app')

@section('content')
    <section class="slider">
        <div class="container">
            <div class="row">
                <div class="
                    @guest
                        col-md-12
                    @else
                        col-md-8
                    @endguest
                    ">
                        <div class="slider-wrap">
                            <div class="owl-carousel owl-theme general-slider">
                                @foreach($slides as $slide)
                                    <div class="item">
                                        <div class="row">
                                            <div class="col-sm-7">
                                                <h2 class="h2">
                                                    @if($slide->title !== null)
                                                        {{ Markdown::parse($slide->title) }}
                                                    @endif
                                                </h2>

                                                <div class="text">
                                                    @if($slide->content !== null)
                                                        {{ Markdown::parse($slide->content) }}
                                                    @endif
                                                </div>

                                                <a href="{{ $slide->link }}" class="btn btn-red">Быстрый заказ</a>
                                                <a href="#" class="btn btn-red_outline">Смотреть каталог</a>
                                            </div>
                                            <div class="col-sm-5 text-right">
                                                <img src="{{ Voyager::image($slide->image) }}" alt="" class="img-fluid img-slider">
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                </div>
                @auth
                    <div class="col-md-4">
                        <div class="info-wrap">
                            <div class="info__image">
                                <img src="{{ Voyager::image(Auth::user()->avatar) }}" alt="" class="img-fluid">
                            </div>
                            <div class="info__content">
                                <p class="text-head">{{ Auth::user()->name }}</p>

                                <p class="text">Количество заказов: <span>3</span></p>
                                <p class="text">Подарок через: <span>7</span> заказов</p>
                                <p class="text">В корзине: <span>3</span> товара</p>
                            </div>
                            
                            <div class="btn-wrap">
                                <a href="#" class="btn btn-red_outline">Открыть профиль</a>
                            </div>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </section>

    <section class="categories">
        <div class="container">
            <div class="row align-items-center">
                @foreach($categories as $category)
                    <div class="
                        @if($category->width_column === '1')
                            col-md-12
                        @elseif($category->width_column === '1/2')
                            col-md-6
                        @elseif($category->width_column === '1/3')
                            col-md-4
                        @elseif($category->width_column === '1/4')
                            col-md-3
                        @elseif($category->width_column === '1/5')
                            col-md-2
                        @endif
                        ">
                        <a href="{{ route('catalog.category', $category->slug) }}" class="categories__item" style="
                            background: {{ $category->bg_color }} url({{ Voyager::image($category->image) }}) center no-repeat;
                            background-size: auto;
                        ">
                            <div class="item__footer">
                                <img src="{{ Voyager::image($category->icon) }}" alt="" class="item__ico">

                                <p class="text-head" style="{{ $category->color }}">{{ $category->title }}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="products">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="h2"><span>Популярные</span> товары</h2>
                </div>
            </div>
            <div class="row">
                @foreach($products_hot as $product)
                    <div class="col-sm-4 col-md-3">
                        <div class="products__item">
                            <div class="products__item-head">
                                <img src="{{ Voyager::image($product->image) }}" alt="{{ $product->title }}" class="products__img img-fluid">
                                <img src="{{ asset('images/ico/hot.svg') }}" alt="" class="hot-ico">
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
            </div>
        </div>
    </section>

    <section class="products">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="h2"><span>Горячие</span> новинки</h2>
                </div>
            </div>
            <div class="row">
                @foreach($products_new as $product)
                    <div class="col-sm-4 col-md-3">
                        <div class="products__item">
                            <div class="products__item-head">
                                <img src="{{ Voyager::image($product->image) }}" alt="{{ $product->categories->title }}" class="products__img img-fluid">
                                <span class="news-ico">NEW</span>
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
                                    <a href="#" class="btn btn-red_outline">В корзину</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="banner">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="row banner__wrap">
                        <div class="col-sm-6">
                            <h2 class="h2">Розыгрыш ps 4</h2>
                            <img src="{{ asset('images/content/bnr/plastaytion4.png') }}" alt="" class="img-fluid banner__img">
                        </div>
                        <div class="col-sm-6">
                            <h3 class="h3">15 сентября</h3>

                            <div class="banner__promo">
                                <span>среди наших клиентов,сделавших покупку в нашем интернет-магазине,разыграем <b>ps4</b></span><br>
                                <a href="#">условия участия</a>
                            </div>

                            <div class="btn-wrap">
                                <a href="#" class="btn btn-white">Открыть каталог</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="news">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="h2"><span>Последние</span> новости</h2>
                </div>
            </div>

            <div class="row">
                @foreach($news as $news_item)
                    <div class="col-sm-4 col-md-3">
                        <div class="news__item">
                            <div class="news__item-head" style="background-image: url({{ Voyager::image($news_item->image) }});">&nbsp;</div>
                            <div class="news__item-body">
                                <div class="date">12 сентября, 2020</div>

                                <p class="text-head">{{ $news_item->title }}</p>

                                <div class="text">
                                    @if($news_item->short_content !== null)
                                        {{ Markdown::parse($news_item->short_content) }}
                                    @endif
                                </div>

                                <a href="#" class="link">Перейти к новости <i class="fa fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
