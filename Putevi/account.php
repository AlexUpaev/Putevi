<?php session_start(); $user = $_SESSION['user'];?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет</title>
    <link rel="icon" href="/img/Logo.svg">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/account.css">
</head>

<body>
    <div class="wrapper">
        <!-- Шапка -->
        <?php require_once "blocks/header.php"; ?>

        <!-- Сообщения об ошибках и успехе -->
        <?php require_once "lib/messages.php"; ?>

        <!-- Личный кабинет -->
        <div class="account-container">
            <h1>Личный кабинет</h1>
            <div class="user-info">
                <p><strong>ФИО:</strong> <?= htmlspecialchars($user['full_name']) ?></p>
                <p><strong>Телефон:</strong> <?= htmlspecialchars($user['phone']) ?></p>
                <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
                <p><strong>Роль:</strong>
                    <span class="role role-<?=
                        strtolower($user['role']) == 'администратор' ? 'admin' : 
                        (strtolower($user['role']) == 'сотрудник' ? 'staff' : 'user')
                    ?>">
                        <?= htmlspecialchars($user['role']) ?>
                    </span>
                </p>
            </div>

            <h2>Мои заявки</h2>
            <!-- Заявки пока не трогаем -->
            <table class="requests-table">
                <thead>
                    <tr>
                        <th>Номер заявки</th>
                        <th>Дата подачи</th>
                        <th>Тип услуги</th>
                        <th>Статус</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>#001</td>
                        <td>10.04.2025</td>
                        <td>Заявка на проектирование дороги</td>
                        <td class="status status-in-progress">В обработке</td>
                    </tr>
                    <tr>
                        <td>#002</td>
                        <td>15.04.2025</td>
                        <td>Консультация по допуску СРО</td>
                        <td class="status status-completed">Выполнено</td>
                    </tr>
                </tbody>
            </table>
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