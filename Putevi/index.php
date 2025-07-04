<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная страница</title>
    <link rel="icon" href="/img/Logo.svg">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/index.css">
</head>

<body>
    <div class="wrapper">
        <!-- Фоновое изображение, растянутое на всю ширину -->
        <div class="hero-bg">
            <img src="/img/shapka.jpg" alt="">
        </div>

        <!-- Шапка -->
        <?php require_once "blocks/header.php"; ?>

        <!-- Сообщения об ошибках и успехе -->
        <?php require_once "lib/messages.php"; ?>

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

        <!-- Слайды -->
        <div class="container slides-container">
            <div class="projects-container">
                <h3>Готовые объекты</h3>
                <a href="Readyobjects.html" class="projects-link">смотреть все</a>
            </div>

            <div class="slider-wrapper">
                <button class="slider-arrow prev">❮</button>

                <div class="slides">
                    <div class="slide active">
                        <img src="/img/Slajd1.jpg" alt="Объект 1">
                    </div>
                    <div class="slide">
                        <img src="/img/Slajd2.jpg" alt="Объект 2">
                    </div>
                    <div class="slide">
                        <img src="/img/Slajd3.jpg" alt="Объект 3">
                    </div>
                </div>

                <button class="slider-arrow next">❯</button>
            </div>
        </div>

        <!-- Секция "Добро пожаловать" после слайдера -->
        <div class="welcome-section">
            <h1>Добро пожаловать в мир уникальной архитектуры!</h1>
            <h3>ПРОЕКТИРОВАНИЕ • СТРОИТЕЛЬСТВО • МЕБЕЛИРОВКА</h3>
            <h4>Мы строим объекты на все времена, чтобы наслаждаться, восхищаться и ценить.</h4>

            <div class="achievements">
                <div class="achievement-item">
                    <p>Мы построили более 1 миллиона м² MEGA Project для XXII зимней Олимпиады в Сочи 2014 года.</p>
                </div>
                <div class="achievement-item">
                    <p>В 2018 году наш объект "Скоттикс-Сколково", Москва/Россия, был удостоен премии ЮНЕСКО "Prix
                        Versailles" как лучший объект в мире в категории университетских кампусов.</p>
                </div>
                <div class="achievement-item">
                    <p>Мы воплощаем идеи лучших архитекторов — лауреатов Притцкеровской премии ("архитектурный Оскар"),
                        таких как Герцог и де Мёрон.</p>
                </div>
                <div class="achievement-item">
                    <p>От квартир до отелей, от кампусов до университетов, от бизнес-центров до стадионов, от
                        коммерческих объектов до медицинских учреждений.</p>
                </div>
            </div>

            <!-- Таблица с данными -->
            <table class="projects-table">
                <tr>
                    <th>Отели</th>
                    <th>Учебные заведения</th>
                    <th>Областные суды</th>
                    <th>Бизнес объекты</th>
                    <th>Жилые комплексы</th>
                    <th>Спортивные комплексы</th>
                    <th>Дельфинарии</th>
                    <th>Стадионы</th>
                    <th>Морские порты</th>
                    <th>Фабрики</th>
                </tr>
                <tr>
                    <td>17</td>
                    <td>4</td>
                    <td>1</td>
                    <td>2</td>
                    <td>9</td>
                    <td>4</td>
                    <td>1</td>
                    <td>1</td>
                    <td>1</td>
                    <td>2</td>
                </tr>
            </table>
        </div>

        <!-- Текст перед галереей -->
        <div class="projects-intro">
            <h2>Справочные проекты</h2>
            <p>За десятилетия работы мы успешно реализовали множество выдающихся проектов в области гражданского
                строительства и высотного строительства, как в России, так и за рубежом.</p>
            <p>Объекты, которые мы построили, представленные в профессиональной литературе и на выставках по всему миру,
                являются дополнительным показателем нашего участия и качества наших услуг, а также источником
                вдохновения для будущих проектов.</p>
        </div>

        <!-- Галерея проектов -->
        <div class="projects-gallery">
            <button class="gallery-nav gallery-prev">❮</button>

            <div class="gallery-container">
                <div class="gallery-item">
                    <img src="/img/Project1.jpg" alt="Реализованный проект 1">
                    <div class="project-info">
                        <h3>Международный аэропорт</h3>
                        <p>Заказчик: ОАО «Международный аэропорт Сочи»<br>
                            Дата окончания: 2007 г.</p>
                    </div>
                </div>
                <div class="gallery-item">
                    <img src="/img/Project2.jpg" alt="Реализованный проект 2">
                    <div class="project-info">
                        <h3>Пансионат «Изумруд»</h3>
                        <p>Заказчик: ГАУ «ФХУ Мэрии Москвы»<br>
                            Дата окончания: 2009 г.</p>
                    </div>
                </div>
                <div class="gallery-item">
                    <img src="/img/Project3.jpg" alt="Реализованный проект 3">
                    <div class="project-info">
                        <h3>Многофункциональный комплекс «ВТБ Арена Парк»</h3>
                        <p>Описание проекта 3 и его основные характеристики</p>
                    </div>
                </div>
                <div class="gallery-item">
                    <img src="/img/Project4.jpg" alt="Реализованный проект 4">
                    <div class="project-info">
                        <h3>Коттеджный посёлок «Полянка де Люкс»</h3>
                        <p>Заказчик: ФГУП «Строительное Объединение» Управления делами Президента РФ<br>
                            Дата окончания: 2014 г.</p>
                    </div>
                </div>
                <div class="gallery-item">
                    <img src="/img/Project5.jpg" alt="Реализованный проект 5">
                    <div class="project-info">
                        <h3>«Сколковский институт науки и технологий Восточное Кольцо»</h3>
                        <p>Заказчик: ООО «ОДПС Сколково»<br>
                            Дата окончания: 2019 г.</p>
                    </div>
                </div>
            </div>

            <button class="gallery-nav gallery-next">❯</button>

            <!-- Тень снизу -->
            <div class="gallery-shadow"></div>

            <!-- Кнопка после галереи -->
            <div class="gallery-button-container">
                <a href="Readyobjects.html" class="gallery-button">Все</a>
            </div>
        </div>

        <!-- Контейнер для фото с историей  -->
        <?php require_once "blocks/history_with_image.php"; ?>
    </div>

    <!-- Футер -->
    <?php require_once "blocks/footer.php"; ?>

    <script src="/js/slider.js"></script>
    <script src="/js/gallery.js"></script>
    <script src="/js/header.js"></script>
</body>

</html>