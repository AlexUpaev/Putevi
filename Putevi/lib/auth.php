<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
    $password = $_POST['password'];

    $errors = [];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Неверный формат email.";
    }

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header("Location: /login.php");
        exit;
    }

    try {
        require "db_connect.php";

        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if (!$user) {
            $_SESSION['errors'][] = "Пользователь с таким email не найден.";
            header("Location: /login.php");
            exit;
        }

        if (!password_verify($password, $user['password_hash'])) {
            $_SESSION['errors'][] = "Неверный пароль.";
            header("Location: /login.php");
            exit;
        }

        $_SESSION['user'] = [
            'id_user' => $user['id_user'],  
            'id' => $user['id_user'],       
            'full_name' => $user['full_name'],
            'email' => $user['email'],
            'role' => $user['role'],
            'phone' => $user['phone']
        ];

        $_SESSION['success'] = "Вы успешно авторизовались!";
        header("Location: /account.php");
        exit;

    } catch (PDOException $e) {
        error_log("Ошибка авторизации: " . $e->getMessage());
        $_SESSION['errors'][] = "Внутренняя ошибка сервера.";
        header("Location: /login.php");
        exit;
    }
} else {
    die("Доступ запрещён.");
}