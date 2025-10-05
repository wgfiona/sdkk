<?php require_once __DIR__."/../includes/header.php"; ?>
<h2>Register</h2>
<form method="post" action="/your_app/process/register_process.php">
  <label>IDENTIFICATION CARD NUMBER</label><br>
  <input type="text" name="KAD_PENGENALAN_P" required><br><br>

  <label>USERNAME</label><br>
  <input type="text" name="USERNAME_P" required><br><br>

  <label>PASSWORD</label><br>
  <input type="password" name="KATA_KUNCI_P" required><br><br>

  <label>NAME</label><br>
  <input type="text" name="NAMA_P" required><br><br>

  <label>CLASS</label><br>
  <input type="text" name="KELAS_P" required><br><br>

  <button type="submit">Create Account</button>
</form>
<?php require_once __DIR__."/../includes/footer.php"; ?>
