<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Subject Voting</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="/your_app/assets/style.css" rel="stylesheet">
</head>
<body>
<nav class="topbar">
  <strong>Subject Voting</strong>
  <span style="float:right;">
    <?php if (!empty($_SESSION['user'])): ?>
      Hello, <?= htmlspecialchars($_SESSION['user']['USERNAME_P']) ?> |
      <a href="/your_app/auth/logout.php">Logout</a>
    <?php else: ?>
      <a href="/your_app/auth/login.php">Login</a>
    <?php endif; ?>
  </span>
</nav>
<main class="container">
