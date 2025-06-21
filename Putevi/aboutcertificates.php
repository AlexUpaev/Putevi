<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Сертификаты</title>
    <link rel="icon" href="/img/Logo.svg">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/aboutCPO.css">
</head>

<body>
    <div class="wrapper">
        <!-- Фоновое изображение -->
        <div class="hero-bg">
            <img src="/img/aboutCPO.jpg" alt="">
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

        <!-- Основной контент -->
        <main>
            <section class="photo-section">
                <h2>Сертификаты</h2>
                <div class="photo-grid">
                    <div class="photo-item">
                        <img src="/img/certificate.jpg" alt="Свидетельство по строительству">
                        <p>Свидетельство по строительству</p>
                    </div>
                    <div class="photo-item">
                        <img src="/img/certificate2.jpg"
                            alt="Выписка из реестра членов СРО по строительству от 01-2022г">
                        <p>Выписка из реестра членов СРО по строительству от 01-2022г</p>
                    </div>
                    <div class="photo-item">
                        <img src="/img/certificate3.jpg" alt="Свидетельство на проектирование">
                        <p>Свидетельство на проектирование</p>
                    </div>
                </div>
            </section>
        </main>

        <!-- Контейнер для фото с историей  -->
        <?php require_once "blocks/history_with_image.php"; ?>
    </div>

    <!-- Футер -->
    <?php require_once "blocks/footer.php"; ?>

    <script src="/js/header.js"></script>
</body>

</html>