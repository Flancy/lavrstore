<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="{{ setting('site.description') }}">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ setting('site.title') }}</title>

    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/png">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <header class="header" id="header">
            <nav class="container navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="{{ route('welcome') }}">
                    <img src="{{ asset('images/logo.svg') }}" alt="" class="img-svg img-fluid">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <form class="form-inline my-2 my-lg-0">
                        <input class="form-control" type="search" placeholder="Поиск товара…" aria-label="Поиск товара…">
                        <button class="btn-search" type="submit">
                            <img src="{{ asset('images/ico/btn-search.svg') }}" alt="Поиск" class="img-fluid">
                        </button>
                    </form>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link nav-link_red" href="{{ route('welcome') }}">Домой</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('catalog.index') }}">Все товары</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-link_blue" href="#">Сотрудничество</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Новости</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('contact.index') }}">Контакты</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('cart.index') }}" class="nav-link nav-link_cart">
                                <span>{{ Cart::getTotalQuantity() }}</span>
                                <i class="fa fa-shopping-cart"></i>
                            </a>
                        </li>

                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Вход') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Регистрация') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="dropdownSetting" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownSetting">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Выйти') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </nav>
        </header>

        <main class="py-4">
            @yield('content')
        </main>

        <footer class="footer" id="footer">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-sm footer__item">
                        <div class="row">
                            <div class="col-sm-6 col-md-4">
                                <p class="text-head">Контакты</p>

                                <a href="tel:+7(996)524-69-42" class="footer__link">+7(996)524-69-42</a>
                                <a href="mailto:lavrstore@mail.ru" class="footer__link">lavrstore@mail.ru</a>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <p class="text-head">Сотрудничество</p>

                                <p class="footer__link">Поставщикам</p>
                                <a href="mailto:coop.lavrstore@mail.ru" class="footer__link">coop.lavrstore@mail.ru</a>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <p class="text-head">Вопрос-ответ</p>

                                <a href="#" class="footer__link">Доставка</a>
                                <a href="#" class="footer__link">Возврат товара</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm footer__item-center">
                        <a class="footer__brand" href="{{ route('welcome') }}">
                            <img src="{{ asset('images/logo.svg') }}" alt="" class="img-fluid">
                        </a>
                    </div>
                    <div class="col-sm footer__item">
                        <div class="row">
                            <div class="col-sm-6 col-md-4">
                                <p class="text-head">Тех-поддержка</p>

                                <a href="{{ route('question.index') }}" class="footer__link footer__link_pink">Задать вопрос <img src="{{ asset('images/ico/click.svg') }}" alt="" class="footer__ico"></a>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <p class="text-head">Магазин</p>

                                <a href="#" class="footer__link">Все товары</a>
                                <a href="#" class="footer__link">Скидки и акции</a>
                            </div>
                            <div class="col-sm-6 col-md-4 col-sm-6-last">
                                <p class="text-head">Соц-сети</p>

                                <a href="#" class="footer__link-social">
                                    <img src="{{ asset('images/ico/instagram.svg') }}" alt="" class="footer__ico">
                                </a>
                                <a href="#" class="footer__link-social">
                                    <img src="{{ asset('images/ico/whatsapp.svg') }}" alt="" class="footer__ico">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <section class="developed" id="developed">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-sm-4 text-center">
                        <a href="#" class="developed__link">Разработано @mambetov.dsgn</a>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
