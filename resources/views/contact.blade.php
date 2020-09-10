@extends('layouts.app')

@section('content')
    <section class="contact">
        <div class="container">
            <div class="row align-items-start">
                <div class="col-sm-6">
                    <h1 class="h1">Контакты</h1>

                    <p class="text-head">Пишите:</p>

                    <div class="text">Менеджер Вконтакте: <a href="#" class="text__link"><b>Евгений Рудской</b></a></div>
                    <div class="text">Форма обратной связи на сайте: <a href="#" class="text__link text__link_red"><b>Тык</b></a></div>
                    <div class="text">Менеджер WhatsApp: <a href="#" class="text__link">+7(996)524-69-42</a></div>
                    <div class="text">E-mail: <a href="mailto:lavrstore@mail.ru" class="text__link"><b>lavrstore@mail.ru</b></a></div>

                    <br>

                    <p class="text-head">Звоните:</p>

                    <div class="text"><a href="tel:+7(996)524-69-42" class="text__link text__link_no-decoration">+7(996)524-69-42</a></div>

                    <br>

                    <p class="text-head">Информация о компании:</p>

                    <p class="text">Адрес: г. Черкесск, ул. Магазинная 26, офис 79</p>
                    <p class="text">369000</p>
                    <p class="text">ИНН: 0917023062 | КПП: 091701001 | ОГРН: 1130917001490</p>
                    <p class="text">ООО «Лавр-Гроуп»</p>
                    <p class="text">Р/С: 40702810300080003026</p>
                    <p class="text">К/С: 30101810000000000840</p>
                </div>
                <div class="col-sm-6">
                    <div class="contact__map">
                        <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3Ad46f7d53f55467a47aad1fee9449151ab5cc302f26990d85336c76411dc18235&amp;width=100%25&amp;height=425&amp;lang=ru_RU&amp;scroll=true"></script>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
