<?php
require_once __DIR__."/../config/db_connect.php";
session_start();

// Collect & basic validate
$ic   = trim($_POST['KAD_PENGENALAN_P'] ?? '');
$user = trim($_POST['USERNAME_P'] ?? '');
$pass = $_POST['KATA_KUNCI_P'] ?? '';
$name = trim($_POST['NAMA_P'] ?? '');
$kelas= trim($_POST['KELAS_P'] ?? '');

if ($ic==='' || $user==='' || $pass==='' || $name==='' || $kelas==='') {
    die("All fields are required.");
}

// Enforce uniqueness
$stmt = $mysqli->prepare("SELECT id FROM users WHERE KAD_PENGENALAN_P=? OR USERNAME_P=? LIMIT 1");
$stmt->bind_param("ss", $ic, $user);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows > 0) {
    $stmt->close();
    die("IC or Username already exists.");
}
$stmt->close();

$hash = password_hash($pass, PASSWORD_BCRYPT);

$stmt = $mysqli->prepare("
  INSERT INTO users (NAMA_P, KELAS_P, KAD_PENGENALAN_P, USERNAME_P, KATA_KUNCI_P, PERANAN)
  VALUES (?,?,?,?,?, 'voter')
");
$stmt->bind_param("sssss", $name, $kelas, $ic, $user, $hash);
if (!$stmt->execute()) {
    die("Registration failed: ".$stmt->error);
}
$stmt->close();

// Auto-login
$_SESSION['user'] = [
  'id' => $mysqli->insert_id,
  'NAMA_P' => $name,
  'KELAS_P' => $kelas,
  'KAD_PENGENALAN_P' => $ic,
  'USERNAME_P' => $user,
  'PERANAN' => 'voter'
];

header("Location: /your_app/voter/dashboard.php");
exit;
