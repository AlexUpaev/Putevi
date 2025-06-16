<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Авторизация</title>
    <link rel="icon" href="/img/Logo.svg">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/login.css">
</head>

<body>
    <div class="wrapper">
        <!-- Шапка -->
        <?php require_once "blocks/header.php"; ?>

        <!-- Сообщения об ошибках и успехе -->
        <?php require_once "lib/messages.php"; ?>

        <!-- Форма входа -->
        <div class="login-form">
            <h2>Вход в аккаунт</h2>

            <form id="loginForm" method="post" action="/lib/auth.php">
                <!-- Email -->
                <label for="email">E-Mail:</label>
                <input type="email" id="email" name="email" placeholder="Введите адрес электронной почты" required>

                <!-- Пароль -->
                <label for="password">Пароль:</label>
                <input type="password" id="password" name="password" placeholder="Введите пароль" required>

                <!-- Кнопка входа -->
                <button type="submit">Войти</button>
            </form>
        </div>

        <!-- Футер -->
        <?php require_once "blocks/footer.php"; ?>

        <script src="/js/header.js"></script>
    </div>
</body>

</html>