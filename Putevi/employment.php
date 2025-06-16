<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Трудоустройство</title>
    <link rel="icon" href="/img/Logo.svg">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/servies.css">
</head>

<body>
    <div class="wrapper">
        <!-- Фоновое изображение -->
        <div class="hero-bg">
            <img src="/img/employee.jpg" alt="">
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
                <h2>Заявка на трудоустройство</h2>
                <form method="post" action="lib/employee.php">
                    <div class="form-group">
                        <label for="message">Расскажите о себе</label>
                        <textarea id="message" name="message"
                            placeholder="Опишите ваш опыт, навыки и почему вы хотите работать у нас"
                            required></textarea>
                    </div>

                    <button type="submit" class="submit-btn">ОТПРАВИТЬ ЗАЯВКУ</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Футер -->
    <?php require_once "blocks/footer.php"; ?>

    <script src="/js/header.js"></script>
</body>

</html>