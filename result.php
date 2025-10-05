<?php
require_once __DIR__."/../includes/auth_guard.php";
require_role('voter');
require_once __DIR__."/../config/db_connect.php";
require_once __DIR__."/../includes/header.php";

$userId = intval($_SESSION['user']['id']);
$stmt = $mysqli->prepare("
  SELECT s.KOD_SUBJEK, s.NAMA_SUBJEK, v.voted_at
  FROM votes v
  JOIN subjects s ON s.KOD_SUBJEK = v.KOD_SUBJEK
  WHERE v.user_id = ?
  LIMIT 1
");
$stmt->bind_param("i", $userId);
$stmt->execute();
$res = $stmt->get_result();
$vote = $res->fetch_assoc();
$stmt->close();
?>
<h2>Your Vote</h2>
<?php if ($vote): ?>
  <p>You voted: <strong><?= htmlspecialchars($vote['NAMA_SUBJEK']) ?> (<?= htmlspecialchars($vote['KOD_SUBJEK']) ?>)</strong></p>
  <p>Time: <?= htmlspecialchars($vote['voted_at']) ?></p>
<?php else: ?>
  <p>You haven’t voted yet. Go back and choose a subject.</p>
<?php endif; ?>
<p><a href="/your_app/voter/dashboard.php">Back to subjects</a></p>
<?php require_once __DIR__."/../includes/footer.php"; ?>
