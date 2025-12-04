<?php
session_start();
include_once('./config/config.php');


if (isset($_POST['login'])) {
    $umail = strtolower(trim($_POST['user_mail']));
    $upwd = trim($_POST['password']);

    // 1️⃣ Check in customers_details
    $queryCustomer = "SELECT * FROM customers_details WHERE email='$umail' AND password='$upwd'";
    $resultCustomer = mysqli_query($connect, $queryCustomer);

    if (mysqli_num_rows($resultCustomer) > 0) {
        $row = mysqli_fetch_assoc($resultCustomer);
        $_SESSION['customer_id'] = $row['id'];
        $_SESSION['user_name'] = $row['username'];

        // echo "Session set successfully!<br>";
        // echo "Customer ID: " . $_SESSION['customer_id'] . "<br>";
        // echo "User Name: " . $_SESSION['user_name'] . "<br>";
        header('Location: ./index.php');
        exit();
    }

    // 2️⃣ Check in merchant_details
    $queryMerchant = "SELECT * FROM merchant_details WHERE email='$umail' AND password='$upwd'";
    $resultMerchant = mysqli_query($connect, $queryMerchant);

    if (mysqli_num_rows($resultMerchant) > 0) {
        $row = mysqli_fetch_assoc($resultMerchant);
        $_SESSION['merchant_id'] = $row['id'];
        $_SESSION['merchant_name'] = $row['username'];

        header('Location: ./merchant/merchant_dashboard.php');
        exit();
    }

    // 3️⃣ If not found
    $_SESSION['message'] = "Invalid credentials!";
    header('Location: ./login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | RetroCart</title>
    <link rel="stylesheet" href="./style/style.css">
    <link rel="stylesheet" href="./style/login.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.css">
</head>

<body>
    <div class="container">
        <div class="login-box">
            <h2><span>Retro</span> Login</h2>

            <form action="login.php" method="POST">
                <label>Email</label>
                <input type="text" name="user_mail" required>

                <label>Password</label>
                <div class="password-field">
                    <input type="password" name="password" required>
                    <i class="bi bi-eye-slash toggle-password"></i>
                </div>

                <!-- <div class="remember-forgot">
                    <a href="#">Forgot Password?</a>
                </div> -->

                <button type="submit" name="login">Login</button>
            </form>

            <p class="register-link">Don't have an account? <a href="register.php">Register Here</a></p>
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