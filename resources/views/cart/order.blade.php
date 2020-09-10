@extends('layouts.app')

@section('content')
    <nav aria-label="breadcrumb">
        <div class="container">
            <div class="row">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Домой <i class="fa fa-chevron-right"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ route('cart.index') }}">Корзина <i class="fa fa-chevron-right"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Оплата и доставка</li>
                </ol>
            </div>
        </div>
    </nav>

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

    <section class="cart">
    	<div class="container">
    		<div class="row">
    			<div class="col-md-8">
    				<div class="row cart-steps">
		    			<div class="col-sm-4">
		    				<h3 class="h3-step-1">Корзина</h3>
		    			</div>
		    			<div class="col-sm-4">
		    				<h3 class="h3-step-2 active">Оплата и доставка</h3>
		    			</div>
		    			<div class="col-sm-4">
		    				<h3 class="h3-step-3">Завершение заказа</h3>
		    			</div>
		    			<div class="step-line step-line_order">
		    				<span class="line-round active"></span>
		    				<span class="line-round active"></span>
		    				<span class="line-round"></span>
		    			</div>
				    </div>

				    <div class="row order-wrap">
				    	<div class="col-md-12">
				    		<p class="text-head">Адрес:</p>

				    		<form class="form-order" method="POST">
				    			@csrf

				    			<div class="row form-group">
				    				<div class="col">
				    					<input type="text" name="oblast" class="form-control" placeholder="Область/Регион*">
				    				</div>
				    				<div class="col">
				    					<input type="text" name="city" class="form-control" placeholder="Город*">
				    				</div>
				    				<div class="col">
				    					<input type="text" name="postcode" class="form-control" placeholder="Почтовый индекс*">
				    				</div>
				    			</div>
				    			<div class="row form-group">
				    				<div class="col">
				    					<input type="text" name="address" class="form-control" placeholder="Улица, № квартиры*">
				    				</div>
				    				<div class="col">
				    					<input type="tel" name="phone" class="form-control" placeholder="Номер телефона*">
				    				</div>
				    				<div class="col">
				    					<input type="email" name="email" class="form-control" placeholder="E-mail">
				    				</div>
				    			</div>
				    			<div class="row form-group">
				    				<div class="col">
				    					<textarea class="form-control" name="comment" placeholder="Оставьте свой комментарий…"></textarea>
				    				</div>
				    			</div>
				    			<div class="row form-group">
				    				<div class="col">
				    					<p class="text-head">Способ оплаты:</p>

				    					<div class="custom-control custom-radio">
											<input type="radio" id="pay-1" name="pay" class="custom-control-input">
											<label class="custom-control-label" for="pay-1">Оплата при получении</label>
										</div>
										<div class="custom-control custom-radio">
											<input type="radio" id="pay-2" name="pay" class="custom-control-input">
											<label class="custom-control-label" for="pay-2">Онлайн-оплата картой</label>
										</div>
				    				</div>
				    			</div>

					    		<div class="table-cart-footer">
					    			<a href="{{ route('cart.index') }}" class="btn btn-link">
					    				<img src="{{ asset('images/ico/left-black_arrow.svg') }}" alt="" class="btn__ico">
					    				Вернуться назад
					    			</a>
					    			<a href="{{ route('catalog.index') }}" class="btn btn-primary" data-toggle="modal" data-target="#modal-order">
					    				Оформить заказ
					    				<img src="{{ asset('images/ico/left-white_arrow.svg') }}" alt="" class="btn__ico">
					    			</a>
					    		</div>
				    		</form>
				    	</div>
				    </div>
    			</div>
    			<div class="col-md-4">
    				<div class="order-info">
    					<p class="text-head">Мой заказ</p>

    					<div class="table-responsive">
    						<table class="table borderless">
    							<tbody>
    								@forelse($cartCollection as $item)
			    						<tr>
			    							<td>
			    								<img src="{{ Voyager::image($item->attributes->image) }}" class="img-thumbnail">
			    							</td>
			    							<td>
			    								<p class="order-info__title">
			    									<span class="grey">{{ $item->quantity }}X</span>
			    									<span>{{ $item->name }}</span>
			    								</p>
			    							</td>
			    							<td>
			    								<span class="order-info__total">{{ \Cart::get($item->id)->getPriceSum() }}₽</span>
			    							</td>
			    						</tr>
			    					@empty
			    						<p class="no-products">Нет товаров в корзине</p>
			    					@endforelse
    							</tbody>
    						</table>
    					</div>
    				</div>

    				<div class="cart-info" style="border-top: none">
    					<div class="cart-item flex justify-content-between">
    						<div class="info-text">Итого:</div>
    						<div class="info-text">{{ \Cart::getTotal() }} ₽</div>
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>
    </section>

    <div class="modal fade" id="modal-order" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-body">
					<p class="text-head">Спасибо за заказ!</p>

					<p class="text">В ближайшее время наши менеджеры обработают ваш заказ и вы получите <b>Трек номер</b> на почту и в личном кабинете во вкладке «Мои заказы»</p>
				</div>
			</div>
		</div>
	</div>
@endsection
