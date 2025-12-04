<?php
// session start
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

// CSRF Token
if (empty($_SESSION['csrf_token'])) {
  $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// check admin login
if (!isset($_SESSION['admin_id'])) {
  header("Location: ../login.php");
  exit();
}

// sanitize helper
function clean($data) {
  return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}
?>
