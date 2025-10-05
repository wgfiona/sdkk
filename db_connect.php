<?php
/*
  -------------------------------------------------------------
  File: db_connect.php
  Purpose: Central database connection file for the system.
  -------------------------------------------------------------
  You can adjust DB_NAME, DB_USER, and DB_PASS based on your XAMPP setup.
*/

$DB_HOST = "localhost";
$DB_USER = "root";     // Default XAMPP username
$DB_PASS = "";          // Default password is empty
$DB_NAME = "voting_app"; // Must match the database you imported

// Create a MySQLi connection
$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

// Check connection
if ($mysqli->connect_errno) {
    die("Database connection failed: " . $mysqli->connect_error);
}

// Set character set to UTF-8 for proper encoding
$mysqli->set_charset("utf8mb4");
?>
