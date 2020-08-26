@extends('layouts.app')

@section('content')
    <nav aria-label="breadcrumb">
        <div class="container">
            <div class="row">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Домой <i class="fa fa-chevron-right"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Корзина</li>
                </ol>
            </div>
        </div>
    </nav>

    <section class="cart">
	    <div class="container">
	        @if(session()->has('success_msg'))
	            <div class="alert alert-success alert-dismissible fade show" role="alert">
	                {{ session()->get('success_msg') }}
	                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	                    <span aria-hidden="true">×</span>
	                </button>
	            </div>
	        @endif
	        @if(session()->has('alert_msg'))
	            <div class="alert alert-warning alert-dismissible fade show" role="alert">
	                {{ session()->get('alert_msg') }}
	                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	                    <span aria-hidden="true">×</span>
	                </button>
	            </div>
	        @endif
	        @if(count($errors) > 0)
	            @foreach($errors0>all() as $error)
	                <div class="alert alert-success alert-dismissible fade show" role="alert">
	                    {{ $error }}
	                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	                        <span aria-hidden="true">×</span>
	                    </button>
	                </div>
	            @endforeach
	        @endif
	        <div class="row justify-content-center">
	            <div class="col-lg-12">
	                <br>
	                @if(\Cart::getTotalQuantity()>0)
	                    <h4>{{ \Cart::getTotalQuantity()}} Продукт(а) в Вашей корзине</h4><br>
	                @else
	                    <h4>No Product(s) In Your Cart</h4><br>
	                    <a href="{{ route('catalog.index') }}" class="btn btn-dark">Продолжить покупки</a>
	                @endif

	                @foreach($cartCollection as $item)
	                    <div class="row">
	                        <div class="col-lg-3">
	                            <img src="{{ Voyager::image($item->attributes->image) }}" class="img-thumbnail" width="200" height="200">
	                        </div>
	                        <div class="col-lg-5">
	                            <p>
	                                <b><a href="/shop/{{ $item->attributes->slug }}">{{ $item->name }}</a></b><br>
	                                <b>Цена товара: </b>{{ $item->price }} ₽<br>
	                                <b>Сумма: </b>{{ \Cart::get($item->id)->getPriceSum() }} ₽<br>
	                            </p>
	                        </div>
	                        <div class="col-lg-4">
	                            <div class="row">
	                                <form action="{{ route('cart.update') }}" method="POST">
	                                    {{ csrf_field() }}
	                                    <div class="form-group row">
	                                        <input type="hidden" value="{{ $item->id}}" id="id" name="id">
	                                        <input type="number" class="form-control form-control-sm" value="{{ $item->quantity }}"
	                                               id="quantity" name="quantity" style="width: 70px; margin-right: 10px;">
	                                        <button class="btn btn-primary btn-sm" style="margin-right: 25px;"><i class="fa fa-edit"></i></button>
	                                    </div>
	                                </form>
	                                <form action="{{ route('cart.remove') }}" method="POST">
	                                    {{ csrf_field() }}
	                                    <input type="hidden" value="{{ $item->id }}" id="id" name="id">
	                                    <button class="btn btn-dark btn-sm" style="margin-right: 10px;"><i class="fa fa-trash"></i></button>
	                                </form>
	                            </div>
	                        </div>
	                    </div>
	                    <hr>
	                @endforeach
	                @if(count($cartCollection)>0)
	                    <form action="{{ route('cart.clear') }}" method="POST">
	                        {{ csrf_field() }}
	                        <button class="btn btn-warning btn-md">Очистить корзину</button>
	                    </form>
	                @endif
	            </div>
	            @if(count($cartCollection)>0)
	                <div class="col-lg-12 mt-5">
	                    <div class="card">
	                        <ul class="list-group list-group-flush">
	                            <li class="list-group-item"><b>Итого: </b>${{ \Cart::getTotal() }}</li>
	                        </ul>
	                    </div>
	                    <br><a href="{{ route('welcome') }}" class="btn btn-primary">Продолжить покупки</a>
	                    <a href="/checkout" class="btn btn-success">Оформить заказ</a>
	                </div>
	            @endif
	        </div>
	        <br><br>
	    </div>
	</section>
@endsection
