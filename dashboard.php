<?php
require_once __DIR__."/../includes/auth_guard.php";
require_role('voter');
require_once __DIR__."/../config/db_connect.php";
require_once __DIR__."/../includes/header.php";

// Fetch active subjects
$res = $mysqli->query("SELECT KOD_SUBJEK, NAMA_SUBJEK FROM subjects WHERE is_active=1 ORDER BY NAMA_SUBJEK");
$subjects = $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
?>
<h2>Pick the subject you find hardest</h2>
<div class="grid">
<?php foreach ($subjects as $s): ?>
  <form method="post" action="/your_app/process/vote_process.php" class="card">
    <h3 style="margin:0 0 8px 0;"><?= htmlspecialchars($s['NAMA_SUBJEK']) ?></h3>
    <input type="hidden" name="KOD_SUBJEK" value="<?= htmlspecialchars($s['KOD_SUBJEK']) ?>">
    <button type="submit">Vote for <?= htmlspecialchars($s['KOD_SUBJEK']) ?></button>
  </form>
<?php endforeach; ?>
</div>
<?php require_once __DIR__."/../includes/footer.php"; ?>
