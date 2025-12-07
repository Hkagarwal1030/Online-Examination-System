<?php
require 'db.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

$stmt = $pdo->prepare("SELECT id, password, name FROM users WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch();
if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_name'] = $user['name'];
    header('Location: exam.php');
    exit;
} else {
    $_SESSION['error'] = 'Invalid credentials.';
    header('Location: index.php');
    exit;
}
