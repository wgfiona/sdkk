<?php
require_once __DIR__."/config/db_connect.php";

// Check if admin exists
$adminUser = "Admin@1";
$adminPassPlain = "A!$M_In90";

$stmt = $mysqli->prepare("SELECT id FROM users WHERE USERNAME_P=? LIMIT 1");
$stmt->bind_param("s", $adminUser);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 0) {
    $stmt->close();
    $hash = password_hash($adminPassPlain, PASSWORD_BCRYPT);
    $name = "Admin";
    $kelas = "ADMIN";
    $ic = "ADMIN-IC-0000";

    $stmt = $mysqli->prepare("
      INSERT INTO users (NAMA_P, KELAS_P, KAD_PENGENALAN_P, USERNAME_P, KATA_KUNCI_P, PERANAN)
      VALUES (?,?,?,?,?, 'admin')
    ");
    $stmt->bind_param("sssss", $name, $kelas, $ic, $adminUser, $hash);
    if ($stmt->execute()) {
        echo "Admin seeded successfully.";
    } else {
        echo "Admin seeding failed: " . $stmt->error;
    }
    $stmt->close();
} else {
    $stmt->close();
    echo "Admin already exists.";
}
