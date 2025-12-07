<?php
require 'db.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php'); exit;
}

// fetch all questions
$stmt = $pdo->query("SELECT id, question, option_a, option_b, option_c, option_d FROM questions ORDER BY id ASC");
$questions = $stmt->fetchAll();
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Exam</title>
<link rel="stylesheet" href="style.css">
<script>
function confirmSubmit(e){
  if(!confirm('Submit your answers?')) e.preventDefault();
}
</script>
</head>
<body>
<div class="container">
  <div class="topbar">
    <div>Welcome, <?=htmlspecialchars($_SESSION['user_name'])?></div>
    <div><a href="logout.php">Logout</a></div>
  </div>

  <h1>Online Exam</h1>
  <form action="submit.php" method="post" onsubmit="confirmSubmit(event)">
    <?php foreach($questions as $i => $q): $qid = $q['id']; ?>
      <div class="question">
        <div><strong><?=($i+1)?>. <?=htmlspecialchars($q['question'])?></strong></div>
        <div class="options">
          <label><input type="radio" name="answer[<?=$qid?>]" value="a"> <?=htmlspecialchars($q['option_a'])?></label>
          <label><input type="radio" name="answer[<?=$qid?>]" value="b"> <?=htmlspecialchars($q['option_b'])?></label>
          <label><input type="radio" name="answer[<?=$qid?>]" value="c"> <?=htmlspecialchars($q['option_c'])?></label>
          <label><input type="radio" name="answer[<?=$qid?>]" value="d"> <?=htmlspecialchars($q['option_d'])?></label>
        </div>
      </div>
    <?php endforeach; ?>

    <div style="text-align:right;margin-top:8px">
      <button type="submit">Submit Answers</button>
    </div>
  </form>
</div>
</body>
</html>
