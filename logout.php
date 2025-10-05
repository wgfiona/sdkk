<?php
session_start();
session_unset();
session_destroy();
header("Location: /your_app/auth/login.php");
exit;
