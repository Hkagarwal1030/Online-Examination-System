<?php
require 'db.php';
if (isset($_SESSION['user_id'])) {
    header('Location: exam.php');
    exit;
}
$err = $_SESSION['error'] ?? null;
unset($_SESSION['error']);
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Online Exam - Login</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
  <h1>Online Exam</h1>
  <?php if($err): ?><div class="result bad"><?=htmlspecialchars($err)?></div><?php endif; ?>
  <form action="login.php" method="post">
    <label>Email</label>
    <input type="email" name="email" required>
    <label>Password</label>
    <input type="password" name="password" required>
    <div style="margin-top:12px">
      <button type="submit">Login</button>
      <a class="btn-plain" href="register.php" style="margin-left:8px;padding:9px 12px;display:inline-block">Register</a>
    </div>
  </form>
</div>
</body>
</html>
