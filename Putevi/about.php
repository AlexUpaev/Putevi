<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>История</title>
    <link rel="icon" href="/img/Logo.svg">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/about.css">
</head>

<body>
    <div class="wrapper">
        <!-- Фоновое изображение -->
        <div class="hero-bg">
            <img src="/img/about-us.jpg" alt="">
        </div>

        <!-- Шапка -->
        <?php require_once "blocks/header.php"; ?>

        <!-- Контент -->
        <div class="hero">
            <div class="hero--info">
                <h1>О нас</h1>
                <p>Сложные конструкции, аутентичная архитектура,
                    эксклюзивные интерьеры, технологические инновации.
                    Гостиницы, бизнес-жилые и коммерческие объекты,
                    университетские городки, аквапарки, стадионы</p>
            </div>
        </div>

        <!-- История -->
        <section class="history-section">
            <div class="container">
                <h2 class="history-title">История</h2>
                <p class="section-text">
                    Более половины строки века, на все времена и для нужд повседневной жизни.
                </p>
                <p class="section-text">
                    От скромного начала в качестве небольшого участка Путарска, мы росли в части мира, созданной элиты.
                </p>
                <p class="section-text">
                    Каждый год представляет собой новый вызов, и некоторые из них были ключом к переоценке развития.
                </p>
                <p class="section-text">
                    Мы всегда стремились быть лучше, развиваться и задавать стандарты в строительной отрасли.
                </p>
                <p class="section-text">
                    Наша приверженность качеству и совершенству — это то, что делает нас одним из лидеров в области
                    гражданское строительство.
                </p>
            </div>
        </section>

        <!-- Слово основателя -->
        <div class="gallery-container">
            <div class="gallery-item">
                <div class="text-left text-content">
                    <div class="year-badge">Слово основателя</div>
                    <p class="history-text">
                        "Даже будучи молодым инженером, стремящимся к знаниям, новому опыту и доказательствам,
                        я четко знал, что пути могут удовлетворить мою потребность в успехе. Для меня дороги были
                        золотым вагоном,
                        на который я смог сесть, и самоотверженная и круглосуточная работа позволила мне перейти от
                        этого вагона к Локомотиву,
                        ускорить весь состав и добраться туда, куда я собирался.
                        Стремление к лучшему, более качественному и прекрасному было вечным императивом в моей
                        повседневной работе.
                        Сегодня, после 40 лет на переднем крае, я рад публично поблагодарить всех моих коллег и
                        партнеров,
                        деловых партнеров и инвесторов за доверие, сотрудничество, понимание и веру в меня и мое
                        предприятие.
                        Я особенно хочу поблагодарить мою семью за поддержку и понимание, и с особым почтением, и,
                        прежде всего, мою жену Весту,
                        которая играла двойную роль матери и отца в воспитании наших детей.
                        Я горжусь тем, что дороги сегодня, после 50 лет существования,
                        стали синонимом хорошего строительства и качества. Средняя возрастная структура в компании-35
                        лет,
                        это молодежь, которая движет всем и терпит, двигатель, который никогда не глохнет,
                        и с этой молодостью и этой силой я всегда был готов к новым вызовам и начинаниям.
                        Я также очень рад, что в ходе нашего успешного и интенсивного развития мы с моей компанией
                        не забыли помочь людям, которым была необходима помощь."
                    </p>
                </div>
                <div class="image-right image-wrapper">
                    <img src="/img/founder.jpg" alt="Создание дороги" class="gallery-image">
                    <div class="gallery-caption">
                        <h3>Василий Мичич (1944-2020)</h3>
                        <p>Президент и генеральный директор</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Галерея с чередованием -->
        <div class="gallery-container">
            <!-- Блок 1: текст слева -->
            <div class="gallery-item">
                <div class="image-left image-wrapper">
                    <img src="/img/history.jpg" alt="Мост" class="gallery-image">
                    <div class="gallery-caption">
                        <h3>Создание дороги</h3>
                        <p>Путеви Ужице / Сербия</p>
                    </div>
                </div>
                <div class="text-right text-content">
                    <div class="year-badge">1962</div>
                    <p class="history-text">
                        По решению Правительства Республики Сербия была создана компания "Путеви Ужице" в качестве
                        преемника
                        технической секции для дорог Республики Сербия, которая до этого занималась строительством и
                        обслуживанием дорог.
                    </p>
                </div>
            </div>


            <!-- Блок 2: фото слева -->
            <div class="gallery-item">
                <div class="text-left text-content">
                    <div class="year-badge">1982</div>
                    <p class="history-text">
                        Первый зарубежный проек — Ирак, проект 1000 P2030
                    </p>
                </div>
                <div class="image-right image-wrapper">
                    <img src="/img/history2.jpg" alt="Создание дороги" class="gallery-image">
                    <div class="gallery-caption">
                        <h3>Первый зарубежный проект</h3>
                        <p>Ирак</p>
                    </div>
                </div>
            </div>

            <!-- Блок 3: текст слева -->
            <div class="gallery-item">
                <div class="image-left image-wrapper">
                    <img src="/img/history3.jpg" alt="Мост" class="gallery-image">
                    <div class="gallery-caption">
                        <h3>Первый проект в России</h3>
                        <p>Россия</p>
                    </div>
                </div>
                <div class="text-right text-content">
                    <div class="year-badge">1991</div>
                    <p class="history-text">
                        Создание сектора высотного строительства и открытие представительств в России.
                    </p>
                </div>
            </div>


            <!-- Блок 4: фото слева -->
            <div class="gallery-item">
                <div class="text-left text-content">
                    <div class="year-badge">1999</div>
                    <p class="history-text">
                        Открытие собственных производственных мощностей комплементарной продукции
                        для высотного строительства (фасадные конструкции, переработка мрамора и гранита,
                        производство сборных бетонных элементов и конструкций, бетонные изделия, производство
                        металлоконструкций и элементов).
                    </p>
                </div>
                <div class="image-right image-wrapper">
                    <img src="/img/history4.jpg" alt="Создание дороги" class="gallery-image">
                    <div class="gallery-caption">
                        <h3>Собственные производственные мощности</h3>
                        <p>Сочи / Россия</p>
                    </div>
                </div>
            </div>

            <!-- Блок 5: текст слева -->
            <div class="gallery-item">
                <div class="image-left image-wrapper">
                    <img src="/img/history5.jpg" alt="Мост" class="gallery-image">
                    <div class="gallery-caption">
                        <h3>Реструктуризация</h3>
                        <p>Ужице / Сербия</p>
                    </div>
                </div>
                <div class="text-right text-content">
                    <div class="year-badge">2000</div>
                    <p class="history-text">
                        Реструктуризация компании в акционерное общество.
                    </p>
                </div>
            </div>


            <!-- Блок 6: фото слева -->
            <div class="gallery-item">
                <div class="text-left text-content">
                    <div class="year-badge">2009</div>
                    <p class="history-text">
                        Открытие представительства в Африке-Алжир
                    </p>
                </div>
                <div class="image-right image-wrapper">
                    <img src="/img/history6.jpg" alt="Создание дороги" class="gallery-image">
                    <div class="gallery-caption">
                        <h3>Первый проект в Африке</h3>
                        <p>Лагуат / Алжир</p>
                    </div>
                </div>
            </div>

            <!-- Блок 7: текст слева -->
            <div class="gallery-item">
                <div class="image-left image-wrapper">
                    <img src="/img/history7.jpg" alt="Мост" class="gallery-image">
                    <div class="gallery-caption">
                        <h3>Олимпийские объекты</h3>
                        <p>Сочи / Россия</p>
                    </div>
                </div>
                <div class="text-right text-content">
                    <div class="year-badge">2010</div>
                    <p class="history-text">
                        Первый объект Олимпийских игр - закладка краеугольного камня
                    </p>
                </div>
            </div>


            <!-- Блок 8: фото слева -->
            <div class="gallery-item">
                <div class="text-left text-content">
                    <div class="year-badge">2014</div>
                    <p class="history-text">
                        Успешное завершение олимпийских объектов и открытие новых строительных площадок в Москве (более
                        500 000 м2 новых проектов)
                    </p>
                </div>
                <div class="image-right image-wrapper">
                    <img src="/img/history8.jpg" alt="Создание дороги" class="gallery-image">
                    <div class="gallery-caption">
                        <h3>Успешное завершение олимпийский объектов дорог</h3>
                        <p>Олимпийский университет-Сочи</p>
                    </div>
                </div>
            </div>

            <!-- Блок 9: текст слева -->
            <div class="gallery-item">
                <div class="image-left image-wrapper">
                    <img src="/img/history9.jpg" alt="Мост" class="gallery-image">
                    <div class="gallery-caption">
                        <h3>Лучший объект в мире ЮНЕСКО "Prix Versailles" 2018</h3>
                        <p>Москва / Россия</p>
                    </div>
                </div>
                <div class="text-right text-content">
                    <div class="year-badge">2018</div>
                    <p class="history-text">
                        Премия ЮНЕСКО "Prix Versailles" за лучший объект в мире в категории университетских
                        городков-Сколтех-Сколково, Москва.
                    </p>
                </div>
            </div>


            <!-- Блок 10: фото слева -->
            <div class="gallery-item">
                <div class="text-left text-content">
                    <div class="year-badge">Сегодня</div>
                    <p class="history-text">
                        Наши богатые знания и опыт на строительных площадках по всему миру, от Сербии до Алжира,
                        очевидно в каждом проекте,
                        который мы реализовали. Некоторые из них уже стали частью профессиональной литературы,
                        а другие через выставки были представлены миру как свидетельство наших строительных достижений.
                        Мы считаем, что будущее строительной отрасли лежит в наследии, которое мы оставляем.
                    </p>
                </div>
                <div class="image-right image-wrapper">
                    <img src="/img/history10.jpg" alt="Создание дороги" class="gallery-image">
                    <div class="gallery-caption">
                        <h3>Дороги сегодня</h3>
                    </div>
                </div>
            </div>
        </div>


        <!-- Контейнер для фото с историей  -->
        <div class="history-fullwidth-container">
            <!-- Фоновое изображение на всю ширину -->
            <div class="history-image-wrapper">
                <img src="/img/highway.jpg" alt="История компании" class="history-fullwidth-image">
            </div>

            <!-- Контент поверх изображения -->
            <div class="history-content-wrapper">
                <div class="history-content">
                    <h2>63 года бизнеса</h2>
                    <p>Наша история - это история объединения людей и мест, о страстных делах, которые сформировали нашу
                        компанию.</p>
                    <p class="highlight-text">Загляните в мир дорог</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Футер -->
    <?php require_once "blocks/footer.php"; ?>

    <script src="/js/header.js"> </script>
</body>

</html>