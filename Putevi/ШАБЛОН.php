<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Контакты</title>
    <link rel="icon" href="/img/Logo.svg">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/about.css">
</head>

<body>
    <div class="wrapper">
        <!-- Фоновое изображение -->
        <div class="hero-bg">
            <img src="/img/contacts.jpg" alt="">
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

    <script src="/js/header.js"></script>
</body>

</html>