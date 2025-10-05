<?php require_once __DIR__."/../includes/header.php"; ?>
<h2>Login</h2>
<form method="post" action="/your_app/process/login_process.php">
  <label>USERNAME</label><br>
  <input type="text" name="USERNAME_P" required><br><br>
  <label>PASSWORD</label><br>
  <input type="password" name="KATA_KUNCI_P" required><br><br>
  <button type="submit">Login</button>
</form>
<p>New user? <a href="/your_app/auth/register.php">Register</a></p>
<?php require_once __DIR__."/../includes/footer.php"; ?>
