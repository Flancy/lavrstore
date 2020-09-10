@extends('layouts.app')

@section('content')
    <section class="question">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="question__wrap">
                        <div class="row">
                            <div class="col-sm-5">
                                <h1 class="h1">Напишите нам</h1>

                                <p class="text-sub">Задавайте вопросы по поводу сервиса, а так же жалобы и предложения. Наша тех-поддержка постарается ответить на все интересующие вас вопросы в ближайшее время</p>

                                <img src="{{ asset('images/content/contacts/general.svg') }}" alt="" class="contacts__img">
                            </div>
                            <div class="col-sm-1"></div>
                            <div class="col-sm-6">
                                <form action="" method="POST" class="question__form">
                                    <div class="form-group">
                                        <input type="text" name="name" class="form-control" placeholder="Ваше имя">
                                    </div>
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control" placeholder="Ваш E-mail">
                                    </div>
                                    <div class="form-group">
                                        <textarea name="comment" class="form-control form-control_textarea" placeholder="Ваш комментарий..."></textarea>
                                    </div>

                                    <div class="form-group">
                                        <button class="btn btn-red">
                                            <span>Отправить</span>
                                            <img src="{{ asset('images/content/contacts/arrow_right.svg') }}" alt="" class="btn__ico img-svg">
                                        </button>
                                    </div>

                                    <span class="text-footer">Или</span>

                                    <div class="form-footer">
                                        <a href="#" class="btn-link">
                                            <img src="{{ asset('images/content/contacts/instagram.svg') }}" alt="" class="img-fluid">
                                        </a>
                                        <a href="#" class="btn-link">
                                            <img src="{{ asset('images/content/contacts/whatsapp.svg') }}" alt="" class="img-fluid">
                                        </a>
                                        <a href="#" class="btn-link">
                                            <img src="{{ asset('images/content/contacts/mail.svg') }}" alt="" class="img-fluid">
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
