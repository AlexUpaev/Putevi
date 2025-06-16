<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Доступ запрещён.");
}

// Получение данных из формы
$title = trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];
$status = $_POST['status'];
$address = trim(filter_input(INPUT_POST, 'address', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
$description = trim(filter_input(INPUT_POST, 'description', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
$budget = filter_input(INPUT_POST, 'budget', FILTER_VALIDATE_FLOAT);
$client_id = filter_input(INPUT_POST, 'client_id', FILTER_VALIDATE_INT);

$errors = [];

// Валидация обязательных полей
if (empty($start_date) || !strtotime($start_date)) {
    $errors[] = "Дата начала указана неверно.";
}
if (!in_array($status, ['в работе', 'завершен', 'приостановлен'])) {
    $errors[] = "Выбран недопустимый статус проекта.";
}
if ($budget === false || $budget < 0) {
    $errors[] = "Бюджет должен быть положительным числом.";
}
if ($client_id === false || $client_id <= 0) {
    $errors[] = "ID клиента указан неверно.";
}
if (!empty($end_date) && !strtotime($end_date)) {
    $errors[] = "Дата завершения указана неверно.";
}

if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    $_SESSION['form_data'] = $_POST;
    header('Location: /createproject.php');
    exit;
}

try {
    require "db_connect.php";

    // Проверка, существует ли пользователь с таким client_id
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE id_user = ?");
    $stmt->execute([$client_id]);
    $exists = $stmt->fetchColumn();

    if (!$exists) {
        $_SESSION['errors'][] = "Пользователь с таким ID не найден.";
        $_SESSION['form_data'] = $_POST;
        header("Location: /createproject.php");
        exit;
    }

    // Все поля обязательные, кроме end_date
    $sql = "INSERT INTO projects 
            (title, start_date, end_date, status, address, description, budget, client_id)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $title,
        $start_date,
        $end_date,
        $status,
        $address,
        $description,
        $budget,
        $client_id
    ]);

    $_SESSION['success'] = "Проект успешно создан!";
    unset($_SESSION['form_data']);
    header("Location: /createproject.php");
    exit;

} catch (PDOException $e) {
    error_log("Ошибка базы данных: " . $e->getMessage());
    $_SESSION['errors'][] = "Не удалось создать проект. Попробуйте позже.";
    $_SESSION['form_data'] = $_POST;
    header("Location: /createproject.php");
    exit;
}