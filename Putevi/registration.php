<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <link rel="icon" href="/img/Logo.svg">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/registration.css">
    <style>
    /* Стили для блока ошибок */
    .error-box {
        background-color: #ffdddd;
        color: #c62828;
        padding: 15px;
        border-radius: 5px;
        margin-bottom: 20px;
    }

    .error-box ul {
        margin: 0;
        padding-left: 20px;
    }
    </style>
</head>

<body>
    <div class="wrapper">
        <!-- Шапка -->
        <?php require_once "blocks/header.php"; ?>

        <!-- Регистрация -->
        <div class="registration-form">
            <h2>Регистрация</h2>

            <?php
            session_start();
            $errors = $_SESSION['errors'] ?? [];
            $form_data = $_SESSION['form_data'] ?? [];
            unset($_SESSION['errors']);
            unset($_SESSION['form_data']);

            // Отображаем ошибки, если они есть
            if (!empty($errors)): ?>
            <div class="error-box">
                <strong>Произошли ошибки:</strong>
                <ul>
                    <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>

            <form id="registrationForm" method="post" action="/lib/reg.php">
                <!-- Поле ФИО -->
                <label for="fio">ФИО:</label>
                <input type="text" id="fio" name="fio" placeholder="Введите ФИО"
                    value="<?= htmlspecialchars($form_data['fio'] ?? '') ?>" required>

                <!-- Поле Телефон -->
                <label for="phone">Телефон:</label>
                <input type="tel" id="phone" name="phone" placeholder="Введите номер телефона"
                    value="<?= htmlspecialchars($form_data['phone'] ?? '') ?>" required>

                <!-- Поле Email -->
                <label for="email">E-Mail:</label>
                <input type="email" id="email" name="email" placeholder="Введите адрес электронной почты"
                    value="<?= htmlspecialchars($form_data['email'] ?? '') ?>" required>

                <!-- Поле Пароль -->
                <label for="password">Пароль:</label>
                <input type="password" id="password" name="password" placeholder="Введите пароль" required>

                <!-- Поле Подтверждение пароля -->
                <label for="confirmPassword">Подтвердите пароль:</label>
                <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Подтвердите пароль"
                    required>

                <!-- Выбор роли -->
                <label for="role">Роль:</label>
                <select id="role" name="role" required>
                    <option value="пользователь"
                        <?= isset($form_data['role']) && $form_data['role'] === 'пользователь' ? 'selected' : '' ?>>
                        Пользователь</option>
                    <option value="сотрудник"
                        <?= isset($form_data['role']) && $form_data['role'] === 'сотрудник' ? 'selected' : '' ?>>
                        Сотрудник</option>
                    <option value="администратор"
                        <?= isset($form_data['role']) && $form_data['role'] === 'администратор' ? 'selected' : '' ?>>
                        Администратор</option>
                </select>

                <!-- Кнопка отправки -->
                <button type="submit">Зарегистрироваться</button>
            </form>
        </div>

        <!-- Контейнер для фото с историей -->
        <?php require_once "blocks/history_with_image.php"; ?>
    </div>

    <!-- Футер -->
    <?php require_once "blocks/footer.php"; ?>

    <script src="/js/header.js"></script>
</body>

</html>