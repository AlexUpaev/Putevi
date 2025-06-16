<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die(json_encode(['status' => 'error', 'message' => 'Доступ запрещён.']));
}

// Получаем ID пользователя из сессии
$user_id = $_SESSION['user']['id'] ?? null;

if (!$user_id) {
    $_SESSION['errors'] = ["Ошибка сессии. Пожалуйста, войдите снова."];
    header('Location: /login.php');
    exit;
}

// Получаем и очищаем данные из формы
$requestType = trim($_POST['service'] ?? '');
$messageText = trim($_POST['message'] ?? '');

// Валидация данных
$errors = [];
if (empty($requestType)) $errors[] = "Не выбран тип услуги.";
if (empty($messageText)) $errors[] = "Обязательно укажите сообщение.";

if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    header('Location: /services.php');
    exit;
}

try {
    require_once 'db_connect.php';

    // Проверяем существование пользователя
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE id_user = ?");
    $stmt->execute([$user_id]);
    
    if ($stmt->fetchColumn() == 0) {
        $_SESSION['errors'] = ["Пользователь не найден."];
        header('Location: /login.php');
        exit;
    }

    // Добавляем текущую дату и статус "В обработке"
    $sql = "INSERT INTO requests 
            (request_type, message, user_id, date_of_submission, application_status) 
            VALUES (?, ?, ?, CURRENT_TIMESTAMP, 'В обработке')";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$requestType, $messageText, $user_id]);

    $_SESSION['success'] = "Заявка успешно отправлена!";
    header('Location: /account.php');
    exit;

} catch (PDOException $e) {
    error_log("Ошибка базы данных: " . $e->getMessage());
    $_SESSION['errors'] = ["Не удалось отправить заявку. Ошибка: " . $e->getMessage()];
    header('Location: /services.php');
    exit;
}