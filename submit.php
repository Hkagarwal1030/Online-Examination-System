<?php
require 'db.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php'); exit;
}

$answers = $_POST['answer'] ?? []; // array keyed by question id
// fetch correct answers for all question ids sent
if (empty($answers)) {
    $score = 0;
    $total = $pdo->query("SELECT COUNT(*) FROM questions")->fetchColumn();
} else {
    $ids = array_map('intval', array_keys($answers));
    // build placeholder list
    $placeholders = implode(',', array_fill(0, count($ids), '?'));
    $stmt = $pdo->prepare("SELECT id, correct FROM questions WHERE id IN ($placeholders)");
    $stmt->execute($ids);
    $rows = $stmt->fetchAll();
    $correctMap = [];
    foreach ($rows as $r) $correctMap[$r['id']] = $r['correct'];

    $score = 0;
    foreach ($answers as $qid => $ans) {
        $qid = (int)$qid;
        $ans = substr($ans,0,1); // a|b|c|d
        if (isset($correctMap[$qid]) && $correctMap[$qid] === $ans) {
            $score++;
        }
    }
    $total = $pdo->query("SELECT COUNT(*) FROM questions")->fetchColumn();
}

// simple percentage
$percent = $total ? round(($score / $total) * 100) : 0;
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Result</title>
<link rel="stylesheet" href="style.css"></head>
<body>
<div class="container">
  <div class="topbar">
    <div>Result for <?=htmlspecialchars($_SESSION['user_name'])?></div>
    <div><a href="exam.php">Retake</a> | <a href="logout.php">Logout</a></div>
  </div>

  <h1>Your Result</h1>

  <div class="result <?= $percent >= 50 ? 'good' : 'bad' ?>">
    Score: <?= $score ?> / <?= $total ?> &nbsp; (<?= $percent ?>%)
  </div>

  <p style="margin-top:12px">Simple explanation: Each correct answer = 1 point. No negative marking.</p>
</div>
</body>
</html>
