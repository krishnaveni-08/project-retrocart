<?php
include("../config/config.php");
session_start();

// Fixed admin credentials
$userMail = "admin@gmail.com";
$userPwd = "admin123";

if (isset($_POST['login'])) {
    $umail = strtolower(trim($_POST['user_mail']));
    $upwd = $_POST['password'];

    // Check admin login
    if ($umail === $userMail && $upwd === $userPwd) {
        $_SESSION['admin_id'] = 1;
        header("Location: ../admin/admin_dashboard.php");
        exit;
    } else {
        echo "<script>alert('Invalid Admin Email or Password!');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | RetroCart</title>
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/login.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.css">
</head>

<body>
    <div class="container">
        <div class="login-box">
            <h2><span>Retro</span> Login</h2>
            <form action="admin_login.php" method="POST">
                <label>Email</label>
                <input type="text" name="user_mail" required>

                <label>Password</label>
                <div class="password-field">
                    <input type="password" name="password" required>
                    <i class="bi bi-eye-slash toggle-password"></i>
                </div>

                <button type="submit" name="login">Login</button>
            </form>
        </div>
    </div>

    <script>
        const toggleIcon = document.querySelector('.toggle-password');
        toggleIcon.addEventListener('click', () => {
            const input = toggleIcon.previousElementSibling;
            if (input.type === 'password') {
                input.type = 'text';
                toggleIcon.classList.remove('bi-eye-slash');
                toggleIcon.classList.add('bi-eye');
            } else {
                input.type = 'password';
                toggleIcon.classList.remove('bi-eye');
                toggleIcon.classList.add('bi-eye-slash');
            }
        });
    </script>
</body>
</html>
