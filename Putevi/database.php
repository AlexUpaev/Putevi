<?php
session_start();
require "lib/db_connect.php";

// Обработка действий
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $table = $_POST['table'] ?? 'users';
        
        try {
            switch ($_POST['action']) {
                case 'save':
                    $id = $_POST['id'];
                    $data = [];
                    
                    // Подготовка данных для разных таблиц
                    switch ($table) {
                        case 'users':
                            $data = [
                                'full_name' => $_POST['full_name'],
                                'phone' => $_POST['phone'],
                                'email' => $_POST['email'],
                                'role' => $_POST['role'],
                                'interaction_with_database' => isset($_POST['interaction_with_database']) ? 1 : 0,
                                'interaction_with_projects' => isset($_POST['interaction_with_projects']) ? 1 : 0
                            ];
                            
                            if (!empty($_POST['password'])) {
                                $data['password_hash'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
                            }
                            break;
                            
                        case 'projects':
                            $data = [
                                'title' => $_POST['title'],
                                'start_date' => $_POST['start_date'],
                                'end_date' => $_POST['end_date'],
                                'status' => $_POST['status'],
                                'address' => $_POST['address'],
                                'description' => $_POST['description'],
                                'budget' => $_POST['budget'],
                                'client_id' => $_POST['client_id']
                            ];
                            break;
                            
                        case 'requests':
                            $data = [
                                'date_of_submission' => $_POST['date_of_submission'],
                                'request_type' => $_POST['request_type'],
                                'message' => $_POST['message'],
                                'application_status' => $_POST['application_status'],
                                'user_id' => $_POST['user_id']
                            ];
                            break;
                            
                        case 'images':
                            $data['project_id'] = $_POST['project_id'];
                            break;
                            
                        case 'reviews':
                            $data = [
                                'title' => $_POST['title'],
                                'content' => $_POST['content'],
                                'rating' => $_POST['rating'],
                                'user_id' => $_POST['user_id']
                            ];
                            break;
                    }
                    
                    saveRow($table, $id, $data);
                    $_SESSION['success'] = 'Данные успешно сохранены';
                    break;
                    
                case 'delete':
                    $id = $_POST['id'];
                    deleteRow($table, $id);
                    $_SESSION['success'] = 'Запись успешно удалена';
                    break;
            }
        } catch (PDOException $e) {
            $_SESSION['errors'] = ['Ошибка базы данных: ' . $e->getMessage()];
        }
        
        header("Location: ".$_SERVER['PHP_SELF']."?table=".$table);
        exit;
    }
}

// Функции работы с БД
function getTableData($tableName) {
    global $pdo;
    
    try {
        $stmt = $pdo->query("SELECT * FROM $tableName");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $_SESSION['errors'] = ['Ошибка при получении данных: ' . $e->getMessage()];
        return [];
    }
}

function saveRow($tableName, $id, $data) {
    global $pdo;
    
    $setParts = [];
    $params = [];
    
    foreach ($data as $key => $value) {
        $setParts[] = "$key = :$key";
        $params[":$key"] = $value;
    }
    
    // Определяем имя ID поля в зависимости от таблицы
    $idField = match($tableName) {
        'users' => 'id_user',
        'projects' => 'id_project',
        'requests' => 'id_request',
        'reviews' => 'id_review',
        'images' => 'id_image',
        default => 'id'
    };
    
    $params[":id"] = $id;
    
    $sql = "UPDATE $tableName SET " . implode(', ', $setParts) . " WHERE $idField = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
}

function deleteRow($tableName, $id) {
    global $pdo;
    
    // Определяем имя ID поля в зависимости от таблицы
    $idField = match($tableName) {
        'users' => 'id_user',
        'projects' => 'id_project',
        'requests' => 'id_request',
        'reviews' => 'id_review',
        'images' => 'id_image',
        default => 'id'
    };
    
    $stmt = $pdo->prepare("DELETE FROM $tableName WHERE $idField = :id");
    $stmt->execute([':id' => $id]);
}

// Получаем выбранную таблицу
$selectedTable = $_GET['table'] ?? 'users';
$tables = [
    'users' => 'Пользователи', 
    'projects' => 'Проекты', 
    'requests' => 'Заявки', 
    'reviews' => 'Отзывы',
    'images' => 'Изображения'
];
$tableData = getTableData($selectedTable);
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Панель администратора</title>
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/database.css">
</head>

<body>
    <!-- Шапка -->
    <?php require_once "blocks/header.php"; ?>

    <!-- Сообщения об ошибках и успехе -->
    <?php require_once "lib/messages.php"; ?>
    <div class="wrapper">
        <div class="admin-panel">
            <div class="admin-header">
                <h1>Панель управления базой данных</h1>
                <div class="header-info">
                    <div class="company">АО Путеви Ужице</div>
                </div>
            </div>

            <div class="controls-container">
                <div class="search-container">
                    <input type="text" name="search" placeholder="Поиск..."
                        value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
                </div>

                <div class="table-selector">
                    <select name="table" onchange="location = '?table=' + this.value">
                        <?php foreach ($tables as $key => $name): ?>
                        <option value="<?= $key ?>" <?= $selectedTable === $key ? 'selected' : '' ?>>
                            <?= $name ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <table class="data-table">
                <thead>
                    <tr>
                        <?php if ($selectedTable === 'users'): ?>
                        <th>ID</th>
                        <th>ФИО</th>
                        <th>Телефон</th>
                        <th>Email</th>
                        <th>Роль</th>
                        <th>Доступ к БД</th>
                        <th>Доступ к проектам</th>
                        <?php elseif ($selectedTable === 'projects'): ?>
                        <th>ID</th>
                        <th>Название</th>
                        <th>Дата начала</th>
                        <th>Дата окончания</th>
                        <th>Статус</th>
                        <th>Адрес</th>
                        <th>Описание</th>
                        <th>Бюджет</th>
                        <th>ID клиента</th>
                        <?php elseif ($selectedTable === 'requests'): ?>
                        <th>ID</th>
                        <th>Дата подачи</th>
                        <th>Тип заявки</th>
                        <th>Сообщение</th>
                        <th>Статус заявки</th>
                        <th>ID пользователя</th>
                        <?php elseif ($selectedTable === 'images'): ?>
                        <th>ID</th>
                        <th>Тип</th>
                        <th>Имя файла</th>
                        <th>ID проекта</th>
                        <?php elseif ($selectedTable === 'reviews'): ?>
                        <th>ID</th>
                        <th>Заголовок</th>
                        <th>Содержание</th>
                        <th>Рейтинг</th>
                        <th>ID пользователя</th>
                        <?php endif; ?>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tableData as $row): ?>
                    <tr>
                        <form method="POST" class="table-form">
                            <input type="hidden" name="table" value="<?= $selectedTable ?>">
                            <input type="hidden" name="id"
                                value="<?= $row['id_'.rtrim($selectedTable, 's')] ?? $row['id'] ?>">

                            <?php if ($selectedTable === 'users'): ?>
                            <td><?= $row['id_user'] ?></td>
                            <td><input type="text" class="editable-cell" name="full_name"
                                    value="<?= htmlspecialchars($row['full_name'] ?? '') ?>" required></td>
                            <td><input type="text" class="editable-cell" name="phone"
                                    value="<?= htmlspecialchars($row['phone'] ?? '') ?>" required></td>
                            <td><input type="email" class="editable-cell" name="email"
                                    value="<?= htmlspecialchars($row['email'] ?? '') ?>" required></td>
                            <td>
                                <select class="editable-cell" name="role" required>
                                    <option value="администратор"
                                        <?= ($row['role'] ?? '') === 'администратор' ? 'selected' : '' ?>>Администратор
                                    </option>
                                    <option value="пользователь"
                                        <?= ($row['role'] ?? '') === 'пользователь' ? 'selected' : '' ?>>Пользователь
                                    </option>
                                    <option value="сотрудник"
                                        <?= ($row['role'] ?? '') === 'сотрудник' ? 'selected' : '' ?>>Сотрудник</option>
                                </select>
                            </td>
                            <td class="checkbox-cell">
                                <input type="checkbox" name="interaction_with_database"
                                    <?= ($row['interaction_with_database'] ?? 0) ? 'checked' : '' ?>>
                            </td>
                            <td class="checkbox-cell">
                                <input type="checkbox" name="interaction_with_projects"
                                    <?= ($row['interaction_with_projects'] ?? 0) ? 'checked' : '' ?>>
                            </td>

                            <?php elseif ($selectedTable === 'projects'): ?>
                            <td><?= $row['id_project'] ?></td>
                            <td><input type="text" class="editable-cell" name="title"
                                    value="<?= htmlspecialchars($row['title'] ?? '') ?>" required></td>
                            <td><input type="date" class="editable-cell" name="start_date"
                                    value="<?= $row['start_date'] ?? '' ?>" required></td>
                            <td><input type="date" class="editable-cell" name="end_date"
                                    value="<?= $row['end_date'] ?? '' ?>"></td>
                            <td><input type="text" class="editable-cell" name="status"
                                    value="<?= htmlspecialchars($row['status'] ?? '') ?>" required></td>
                            <td><input type="text" class="editable-cell" name="address"
                                    value="<?= htmlspecialchars($row['address'] ?? '') ?>"></td>
                            <td><textarea class="editable-cell"
                                    name="description"><?= htmlspecialchars($row['description'] ?? '') ?></textarea>
                            </td>
                            <td><input type="number" step="0.01" class="editable-cell" name="budget"
                                    value="<?= $row['budget'] ?? '' ?>"></td>
                            <td><input type="number" class="editable-cell" name="client_id"
                                    value="<?= $row['client_id'] ?? '' ?>"></td>

                            <?php elseif ($selectedTable === 'requests'): ?>
                            <td><?= $row['id_request'] ?></td>
                            <td><input type="datetime-local" class="editable-cell" name="date_of_submission"
                                    value="<?= str_replace(' ', 'T', $row['date_of_submission'] ?? '') ?>" required>
                            </td>
                            <td><input type="text" class="editable-cell" name="request_type"
                                    value="<?= htmlspecialchars($row['request_type'] ?? '') ?>" required></td>
                            <td><textarea class="editable-cell"
                                    name="message"><?= htmlspecialchars($row['message'] ?? '') ?></textarea></td>
                            <td><input type="text" class="editable-cell" name="application_status"
                                    value="<?= htmlspecialchars($row['application_status'] ?? '') ?>" required></td>
                            <td><input type="number" class="editable-cell" name="user_id"
                                    value="<?= $row['user_id'] ?? '' ?>" required></td>

                            <?php elseif ($selectedTable === 'images'): ?>
                            <td><?= $row['id_image'] ?></td>
                            <td><?= htmlspecialchars($row['mime_type'] ?? '') ?></td>
                            <td><input type="text" class="editable-cell" name="file_name"
                                    value="<?= htmlspecialchars($row['file_name'] ?? '') ?>"></td>
                            <td><input type="number" class="editable-cell" name="project_id"
                                    value="<?= $row['project_id'] ?? '' ?>" required></td>

                            <?php elseif ($selectedTable === 'reviews'): ?>
                            <td><?= $row['id_review'] ?></td>
                            <td><input type="text" class="editable-cell" name="title"
                                    value="<?= htmlspecialchars($row['title'] ?? '') ?>" required></td>
                            <td><textarea class="editable-cell"
                                    name="content"><?= htmlspecialchars($row['content'] ?? '') ?></textarea></td>
                            <td><input type="number" min="1" max="5" class="editable-cell" name="rating"
                                    value="<?= $row['rating'] ?? '' ?>" required></td>
                            <td><input type="number" class="editable-cell" name="user_id"
                                    value="<?= $row['user_id'] ?? '' ?>" required></td>
                            <?php endif; ?>
                            <td class="actions">
                                <?php if ($selectedTable !== 'images'): ?>
                                <button type="submit" name="action" value="save"
                                    class="action-btn save-btn">Сохранить</button>
                                <?php endif; ?>
                                <button type="submit" name="action" value="delete" class="action-btn delete-btn"
                                    onclick="return confirm('Вы уверены, что хотите удалить эту запись? Это действие нельзя отменить.')">Удалить</button>
                            </td>
                        </form>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Футер -->
        <?php require_once "blocks/footer.php"; ?>

        <script src="/js/header.js"></script>
        <script src="/js/search.js"></script>
    </div>
</body>

</html>