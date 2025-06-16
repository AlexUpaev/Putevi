<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Создание проекта</title>
    <link rel="icon" href="/img/Logo.svg">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/createproject.css">
</head>

<body>
    <div class="wrapper">
        <!-- Шапка -->
        <?php require_once "blocks/header.php"; ?>

        <!-- Сообщения об ошибках и успехе -->
        <?php require_once "lib/messages.php"; ?>

        <!-- Создание проекта -->
        <div class="main-container">
            <div class="form-block">
                <h2>Создание нового проекта</h2>
                <form method="POST" action="lib/create-project.php">
                    <!-- Поле title -->
                    <div class="form-group">
                        <label for="title">Название проекта</label>
                        <input type="text" id="title" name="title"
                            value="<?= isset($_SESSION['form_data']['title']) ? htmlspecialchars($_SESSION['form_data']['title']) : '' ?>"
                            placeholder="Введите название проекта" required>
                    </div>

                    <!-- Поле start_date -->
                    <div class="form-group">
                        <label for="start_date">Планируемая/фактическая дата начала</label>
                        <input type="date" id="start_date" name="start_date"
                            value="<?= isset($_SESSION['form_data']['start_date']) ? $_SESSION['form_data']['start_date'] : '' ?>"
                            required>
                    </div>

                    <!-- Поле end_date -->
                    <div class="form-group">
                        <label for="end_date">Планируемая/фактическая дата завершения</label>
                        <input type="date" id="end_date" name="end_date"
                            value="<?= isset($_SESSION['form_data']['end_date']) ? $_SESSION['form_data']['end_date'] : '' ?>">
                    </div>

                    <!-- Поле status -->
                    <div class="form-group">
                        <label for="status">Статус</label>
                        <select id="status" name="status" required>
                            <option value="в работе"
                                <?= (isset($_SESSION['form_data']['status']) && $_SESSION['form_data']['status'] === 'в работе') ? 'selected' : '' ?>>
                                В работе</option>
                            <option value="завершен"
                                <?= (isset($_SESSION['form_data']['status']) && $_SESSION['form_data']['status'] === 'завершен') ? 'selected' : '' ?>>
                                Завершен</option>
                            <option value="приостановлен"
                                <?= (isset($_SESSION['form_data']['status']) && $_SESSION['form_data']['status'] === 'приостановлен') ? 'selected' : '' ?>>
                                Приостановлен</option>
                        </select>
                    </div>

                    <!-- Поле address -->
                    <div class="form-group">
                        <label for="address">Адрес</label>
                        <input type="text" id="address" name="address"
                            value="<?= isset($_SESSION['form_data']['address']) ? htmlspecialchars($_SESSION['form_data']['address']) : '' ?>"
                            placeholder="Введите адрес" required>
                    </div>

                    <!-- Поле description -->
                    <div class="form-group">
                        <label for="description">Описание</label>
                        <textarea id="description" name="description" rows="4" placeholder="Введите описание проекта"
                            required><?= isset($_SESSION['form_data']['description']) ? htmlspecialchars($_SESSION['form_data']['description']) : '' ?></textarea>
                    </div>

                    <!-- Поле budget -->
                    <div class="form-group">
                        <label for="budget">Бюджет</label>
                        <input type="number" id="budget" name="budget" step="0.01"
                            value="<?= isset($_SESSION['form_data']['budget']) ? htmlspecialchars($_SESSION['form_data']['budget']) : '' ?>"
                            placeholder="Введите бюджет" required>
                    </div>

                    <!-- Поле client_id -->
                    <div class="form-group">
                        <label for="client_id">ID клиента</label>
                        <input type="number" id="client_id" name="client_id"
                            value="<?= isset($_SESSION['form_data']['client_id']) ? htmlspecialchars($_SESSION['form_data']['client_id']) : '' ?>"
                            placeholder="Введите ID клиента" required>
                    </div>

                    <!-- Кнопка отправки -->
                    <button type="submit" class="submit-btn">Создать проект</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Футер -->
    <?php require_once "blocks/footer.php"; ?>

    <script src="/js/header.js"></script>
</body>

</html>