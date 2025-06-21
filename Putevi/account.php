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
            <?php
            // Подключаем файл для получения заявок пользователя
            require_once "lib/get_user_requests.php";
            $requests = get_user_requests($user['id_user']);
            ?>

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
                    <?php if (!empty($requests)): ?>
                    <?php foreach ($requests as $request): ?>
                    <tr>
                        <td>#<?= str_pad($request['id_request'], 3, '0', STR_PAD_LEFT) ?></td>
                        <td><?= date('d.m.Y', strtotime($request['date_of_submission'])) ?></td>
                        <td><?= htmlspecialchars($request['request_type']) ?></td>
                        <td class="status status-<?= 
                                    $request['application_status'] == 'Выполнено' ? 'completed' : 'in-progress'
                                ?>">
                            <?= htmlspecialchars($request['application_status'] ?? 'В обработке') ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <tr>
                        <td colspan="4">У вас пока нет заявок</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Контейнер для фото с историей -->
        <?php require_once "blocks/history_with_image.php"; ?>
    </div>

    <!-- Футер -->
    <?php require_once "blocks/footer.php"; ?>

    <script src="/js/header.js"></script>
</body>

</html>