<?php
session_start();

// Проверка метода запроса
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('HTTP/1.1 403 Forbidden');
    die(json_encode(['status' => 'error', 'message' => 'Неверный метод запроса']));
}

// Проверка авторизации
if (!isset($_SESSION['user']['id_user'])) {
    $_SESSION['errors'] = ["Для добавления отзыва необходимо авторизоваться"];
    header('Location: /login.php');
    exit;
}

// Обработка данных с учетом структуры таблицы
$form_data = [
    'title' => trim(substr($_POST['title'] ?? '', 0, 100)), // Ограничение 100 символов
    'content' => trim(substr($_POST['content'] ?? '', 0, 255)), // Ограничение 255 символов
    'rating' => min(max((int)($_POST['rating'] ?? 0), 1), 5) // Ограничение 1-5
];

// Валидация
$errors = [];
if (empty($form_data['title'])) $errors[] = "Заголовок отзыва обязателен (макс. 100 символов)";
if (empty($form_data['content'])) $errors[] = "Текст отзыва обязателен (макс. 255 символов)";

if (!empty($errors)) {
    $_SESSION['review_errors'] = $errors;
    $_SESSION['review_form'] = $form_data;
    header('Location: /contacts.php');
    exit;
}

try {
    require_once 'db_connect.php';
    
    // Проверка пользователя
    $stmt = $pdo->prepare("SELECT id_user FROM users WHERE id_user = ?");
    $stmt->execute([$_SESSION['user']['id_user']]);
    
    if (!$stmt->fetch()) {
        $_SESSION['errors'] = ["Пользователь не найден"];
        header('Location: /login.php');
        exit;
    }

    // Добавление отзыва с правильными именами полей
    $stmt = $pdo->prepare("INSERT INTO reviews 
                         (title, content, rating, user_id) 
                         VALUES (?, ?, ?, ?)");
    
    $success = $stmt->execute([
        $form_data['title'],
        $form_data['content'],
        $form_data['rating'],
        $_SESSION['user']['id_user']
    ]);
    
    if (!$success) {
        throw new PDOException("Ошибка выполнения запроса");
    }

    // Успешное сохранение
    $_SESSION['success'] = "Ваш отзыв успешно добавлен!";
    unset($_SESSION['review_form']);
    header('Location: /contacts.php');
    exit;

} catch (PDOException $e) {
    error_log("Ошибка БД при сохранении отзыва: " . $e->getMessage());
    $_SESSION['errors'] = ["Ошибка при сохранении отзыва. Пожалуйста, попробуйте позже."];
    $_SESSION['review_form'] = $form_data;
    header('Location: /contacts.php');
    exit;
}