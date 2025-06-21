<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Услуги</title>
    <link rel="icon" href="/img/Logo.svg">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/servies.css">
</head>

<body>
    <div class="wrapper">
        <!-- Фоновое изображение -->
        <div class="hero-bg">
            <img src="/img/services.jpg" alt="">
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

        <!-- Сообщения об ошибках и успехе -->
        <?php require_once "lib/messages.php"; ?>

        <div class="main-container">
            <!-- Центрированный блок формы -->
            <div class="form-block">
                <h2>Свяжитесь с нами</h2>
                <form method="post" action="lib/service.php">
                    <div class="form-group">
                        <label for="service">Тип услуги</label>
                        <select id="service" name="service">
                            <option value="">Выберите тип услуги</option>
                            <option value="Консультация">Консультация</option>
                            <option value="Техподдержка">Техподдержка</option>
                            <option value="Заказ услуг">Заказ услуг</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="message">Сообщение</label>
                        <textarea id="message" name="message"
                            placeholder="Опишите ваши пожелания или вопросы"></textarea>
                    </div>

                    <button type="submit" class="submit-btn">ОТПРАВИТЬ</button>
                </form>
            </div>
        </div>

        <!-- Контейнер для фото с историей  -->
        <?php require_once "blocks/history_with_image.php"; ?>
    </div>

    <!-- Футер -->
    <?php require_once "blocks/footer.php"; ?>

    <script src="/js/header.js"></script>
</body>

</html>