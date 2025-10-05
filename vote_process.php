<?php
require_once __DIR__."/../config/db_connect.php";
require_once __DIR__."/../includes/auth_guard.php";
require_login();

$userId = intval($_SESSION['user']['id'] ?? 0);
$kod = $_POST['KOD_SUBJEK'] ?? '';

if ($userId <= 0 || $kod === '') die("Invalid vote.");

// Ensure subject exists & active
$stmt = $mysqli->prepare("SELECT KOD_SUBJEK FROM subjects WHERE KOD_SUBJEK=? AND is_active=1 LIMIT 1");
$stmt->bind_param("s", $kod);
$stmt->execute();
$res = $stmt->get_result();
$exists = $res->fetch_assoc();
$stmt->close();
if (!$exists) die("Subject not available.");

// Insert or fail due to unique constraint
$stmt = $mysqli->prepare("INSERT INTO votes (user_id, KOD_SUBJEK) VALUES (?, ?)");
$stmt->bind_param("is", $userId, $kod);
if (!$stmt->execute()) {
    // If already voted, just continue to result
}
$stmt->close();

header("Location: /your_app/voter/result.php");
exit;
