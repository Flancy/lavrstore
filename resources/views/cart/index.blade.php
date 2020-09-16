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

    <div class="container messages">
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
	</div>

    <section class="cart">
    	<div class="container">
    		<div class="row cart-row">
    			<div class="col-md-8 cart-steps-wrap">
    				<div class="row cart-steps">
		    			<div class="col-sm-4">
		    				<h3 class="h3-step-1 active">Корзина</h3>
		    			</div>
		    			<div class="col-sm-4">
		    				<h3 class="h3-step-2">Оплата и доставка</h3>
		    			</div>
		    			<div class="col-sm-4">
		    				<h3 class="h3-step-3">Завершение заказа</h3>
		    			</div>
		    			<div class="step-line">
		    				<span class="line-round active"></span>
		    				<span class="line-round"></span>
		    				<span class="line-round"></span>
		    			</div>
				    </div>

				    <div class="row cart-wrap">
				    	<div class="col-md-12">
				    		<div class="table-responsive">
				    			<table class="table borderless">
				    				<thead>
				    					<tr>
				    						<th>Продукт</th>
				    						<th>&nbsp;</th>
				    						<th>Кол-во</th>
				    						<th>Итого</th>
				    					</tr>
				    				</thead>
				    				<tbody>
				    					@forelse($cartCollection as $item)
				    						<tr>
				    							<td>
				    								<img src="{{ Voyager::image($item->attributes->image) }}" class="img-thumbnail">
				    							</td>
				    							<td>
				    								<p class="cart__category"></p>
				    								<a href="{{ route('product.show', $item->id) }}" class="cart__title">{{ $item->name }}</a>
				    								<p class="cart__price">{{ $item->price }} ₽</p>

				    								<form action="{{ route('cart.remove') }}" method="POST">
					                                    {{ csrf_field() }}
					                                    <input type="hidden" value="{{ $item->id }}" id="id" name="id">
					                                    <button class="btn btn-link btn-remove">Удалить</button>
					                                </form>
				    							</td>
				    							<td>
				    								<form action="{{ route('cart.update') }}" method="POST" class="add-to-cart-wrap">
					                                    {{ csrf_field() }}
							                            <div class="count">
							                                <span class="count-minus">-</span>
							                                <input type="number" class="count-number" value="{{ $item->quantity }}" min="1">
							                                <input type="hidden" value="{{ $item->id}}" id="id" name="id">
							                                <span class="count-plus">+</span>
							                            </div>
							                        </form>
				    							</td>
				    							<td>
				    								<span class="product-price-total">{{ \Cart::get($item->id)->getPriceSum() }} ₽</span>
				    							</td>
				    						</tr>
				    					@empty
				    						<p class="no-products">Нет товаров в корзине</p>
				    					@endforelse
				    				</tbody>
				    			</table>
				    		</div>

				    		<div class="table-cart-footer">
				    			<a href="{{ route('catalog.index') }}" class="btn btn-link">
				    				<img src="{{ asset('images/ico/left-black_arrow.svg') }}" alt="" class="btn__ico">
				    				Продолжить покупки
				    			</a>
				    			<a href="{{ route('cart.order') }}" class="btn btn-primary">
				    				Перейти к оформлению
				    				<img src="{{ asset('images/ico/left-white_arrow.svg') }}" alt="" class="btn__ico">
				    			</a>
				    		</div>
				    	</div>
				    </div>
    			</div>
    			<div class="col-md-4 cart-info-wrap">
    				<div class="cart-info">
    					<div class="cart-promocode">
    						<h4 class="h4">Введите промокод:</h4>

    						<div class="promocode">
    							<input type="text" class="promocode-input">
    							<input type="text" class="promocode-input">
    							<input type="text" class="promocode-input">
    							<input type="text" class="promocode-input">
    							<input type="text" class="promocode-input">
    							<input type="text" class="promocode-input">

    							<div class="promocode-click">
	    							<img src="{{ asset('images/ico/click-white.svg') }}" alt="" class="img-svg">
	    						</div>
    						</div>
    						
    						<div class="promocode-text">
    							Как получить промокод? <a href="#" class="promocode-link">Жми сюда!</a>
    						</div>
    					</div>
    					<div class="cart-item flex justify-content-between">
    						<div class="info-text">Доставка:</div>
    						<div class="info-text">Бесплатно</div>
    					</div>
    					<div class="cart-item flex justify-content-between">
    						<div class="info-text">Итого:</div>
    						<div class="info-text">{{ \Cart::getTotal() }} ₽</div>
    					</div>
    					<div class="cart-conf">
    						<label class="form-switch">
								<input type="checkbox">
								<i></i>
							</label>
							<div class="conf-link">
								<span>Я принимаю условия</span>
								<a href="#">Пользовательского соглашения</a>
							</div>
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>
    </section>
@endsection
