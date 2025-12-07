<?php
require 'db.php';
if (isset($_SESSION['user_id'])) header('Location: exam.php');

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm'] ?? '';

    if (!$name || !$email || !$password) $errors[] = 'All fields are required.';
    if ($password !== $confirm) $errors[] = 'Passwords do not match.';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Invalid email.';

    if (empty($errors)) {
        // check existing
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $errors[] = 'Email already registered.';
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $ins = $pdo->prepare("INSERT INTO users (name,email,password) VALUES (?,?,?)");
            $ins->execute([$name, $email, $hash]);
            $_SESSION['success'] = 'Registration successful. Please login.';
            header('Location: index.php');
            exit;
        }
    }
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Register</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
  <h1>Register</h1>
  <?php if(!empty($errors)): foreach($errors as $e): ?>
    <div class="result bad"><?=htmlspecialchars($e)?></div>
  <?php endforeach; endif; ?>
  <form method="post">
    <label>Name</label>
    <input type="text" name="name" required>
    <label>Email</label>
    <input type="email" name="email" required>
    <label>Password</label>
    <input type="password" name="password" required>
    <label>Confirm Password</label>
    <input type="password" name="confirm" required>
    <div style="margin-top:12px">
      <button type="submit">Register</button>
      <a href="index.php" class="btn-plain" style="margin-left:8px;padding:9px 12px;display:inline-block">Back to login</a>
    </div>
  </form>
</div>
</body>
</html>
