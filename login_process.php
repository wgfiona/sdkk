<?php
require_once __DIR__."/../config/db_connect.php";
session_start();

$user = trim($_POST['USERNAME_P'] ?? '');
$pass = $_POST['KATA_KUNCI_P'] ?? '';

if ($user==='' || $pass==='') die("Missing credentials.");

$stmt = $mysqli->prepare("SELECT id, NAMA_P, KELAS_P, KAD_PENGENALAN_P, USERNAME_P, KATA_KUNCI_P, PERANAN FROM users WHERE USERNAME_P=? LIMIT 1");
$stmt->bind_param("s", $user);
$stmt->execute();
$res = $stmt->get_result();
$row = $res->fetch_assoc();
$stmt->close();

if (!$row || !password_verify($pass, $row['KATA_KUNCI_P'])) {
    die("Invalid username or password.");
}

$_SESSION['user'] = $row;

// Route by role
if ($row['PERANAN'] === 'admin') {
    header("Location: /your_app/admin/dashboard.php");
} else {
    header("Location: /your_app/voter/dashboard.php");
}
exit;
