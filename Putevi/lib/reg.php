<?php
session_start(); // ВСЕГДА В НАЧАЛЕ

// Проверка метода запроса
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получение данных из формы
    $fio = trim(filter_var($_POST['fio'], FILTER_SANITIZE_SPECIAL_CHARS));
    $phone = trim(filter_var($_POST['phone'], FILTER_SANITIZE_SPECIAL_CHARS));
    $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $role = trim(filter_var($_POST['role'], FILTER_SANITIZE_SPECIAL_CHARS));
    $interaction_with_database = 0;
    $interaction_with_projects = 0;

    // Массив для хранения ошибок
    $errors = [];

    // Проверка совпадения паролей
    if ($password !== $confirmPassword) {
        $errors[] = "Пароли не совпадают.";
    }

    // Валидация email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Неверный формат email.";
    }

    // Валидация телефона
    if (!preg_match('/^\+?[0-9\s\-()]{7,20}$/', $phone)) {
        $errors[] = "Неверный формат телефона.";
    }

    // Валидация роли
    $allowedRoles = ['пользователь', 'сотрудник', 'администратор'];
    if (!in_array($role, $allowedRoles, true)) {
        $errors[] = "Недопустимая роль.";
    }

    // Если есть ошибки, сохраняем их в сессию и перенаправляем на форму
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['form_data'] = $_POST; // Сохраняем данные формы
        header('Location: /registration.php'); // Перенаправление на форму
        exit;
    }

    // Подключение к БД
    try {
        require "db_connect.php";
        
        // Проверка существования пользователя по email
        $stmt = $pdo->prepare("SELECT COUNT(*) as count FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $result = $stmt->fetch();

        if ($result['count'] > 0) {
            $_SESSION['errors'][] = "Пользователь с таким email уже существует.";
            header('Location: /registration.php');
            exit;
        }

        // Хэширование пароля
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Вставка данных в таблицу
        $sql = 'INSERT INTO users(full_name, phone, email, password_hash, role, interaction_with_database, interaction_with_projects) VALUES (?, ?, ?, ?, ?, ?, ?)';
        $query = $pdo->prepare($sql);
        $query->execute([$fio, $phone, $email, $hashedPassword, $role, $interaction_with_database, $interaction_with_projects]);

        // Перенаправление после успешной регистрации
        $_SESSION['success'] = "Вы успешно зарегистрировались! Теперь Вы можете войти.";
        header('Location: /login.php'); 
        exit;

    } catch (PDOException $e) {
        error_log("Ошибка базы данных: " . $e->getMessage());
        $_SESSION['errors'][] = "Внутренняя ошибка сервера.";
        header('Location: /registration.php');
        exit;
    }
} else {
    die("Доступ запрещён.");
}