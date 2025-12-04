<?php
include("./config/config.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>RetroCart Registration</title>
  <link rel="stylesheet" href="./style/style.css">
  <link rel="stylesheet" href="./style/register.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.css">
</head>



<body>

  <?php

  $fullnameErr = $usernameErr = $emailErr = $mobErr = $passErr = $cPassErr = $doorErr = $streetErr = $cityErr = $stateErr = $pinErr = $landErr = $shopErr = $busstypeErr = "";

  $namePatt = '/^[A-Za-z]{3,30}$/';
  $userPatt = '/^[A-Za-z0-9_]{5,}$/';
  $emailPatt = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[A-Za-z]{2,}$/';
  $mobPatt = '/^[6-9][0-9]{9}$/';
  $passPatt = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';
  $doorPatt = '/^[A-Za-z0-9\s\/-]{1,10}$/';
  $streetPatt = '/^[A-Za-z0-9\s,.-]{10,50}$/';
  $cityPatt = '/^[A-Za-z\s]{2,30}$/';
  $statePatt = '/^[A-Za-z\s]{2,30}$/';
  $pinPatt = '/^[1-9][0-9]{5}$/';
  $landPatt = '/^[A-Za-z0-9\s,.-]{0,50}$/';

  $fullname = $username = $email = $mob = $door = $street = $city = $state = $pin = $landmark = "";

  if (isset($_POST['user_register'])) {
    $fullname = $_POST['fullname'];
    $username = strtolower($_POST['username']);
    $email = strtolower($_POST['email']);
    $mob = $_POST['phone'];
    $password = $_POST['password'];
    $cpassword = $_POST['confirm_password'];
    $door = $_POST['door'];
    $street = $_POST['street'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $pin = $_POST['pincode'];
    $landmark = $_POST['landmark'];

    if (empty($fullname)) {
      $fullnameErr = "Please enter your full name";
    } elseif (!preg_match($namePatt, $fullname)) {
      $fullnameErr = "Full name must be 3-30 letters only";
    }

    if (empty($username)) {
      $usernameErr = "Please enter your username";
    } elseif (!preg_match($userPatt, $username)) {
      $usernameErr = "Username must be minimum 5 letters/numbers/_ only";
    }

    if (empty($email)) {
      $emailErr = "Please enter your email";
    } elseif (!preg_match($emailPatt, $email)) {
      $emailErr = "Invalid email format";
    }

    if (empty($mob)) {
      $mobErr = "Please enter your mobile number";
    } elseif (!preg_match($mobPatt, $mob)) {
      $mobErr = "Invalid mobile number";
    }

    if (empty($password)) {
      $passErr = "Please enter your password";
    } 
    elseif (!preg_match($passPatt, $password)) {
      $passErr = "Password must be 8-15 chars, include upper, lower, number & special char";
    }

    if (empty($cpassword)) {
      $cPassErr = "Please enter confirm password";
    } elseif ($password !== $cpassword) {
      $cPassErr = "Passwords do not match";
    }

      if (empty($door)) {
        $doorErr = "Please enter your door no";
      } elseif (!preg_match($doorPatt, $door)) {
        $doorErr = "Invalid door no";
      }

      if (empty($street)) {
        $streetErr = "Please enter street name";
      } elseif (!preg_match($streetPatt, $street)) {
        $streetErr = "Invalid street name";
      }

      if (empty($city)) {
        $cityErr = "Please enter city name";
      } elseif (!preg_match($cityPatt, $city)) {
        $cityErr = "Invalid city name";
      }

      if (empty($state)) {
        $stateErr = "Please enter state name";
      } elseif (!preg_match($statePatt, $state)) {
        $stateErr = "Invalid state name";
      }

      if (empty($pin)) {
        $pinErr = "Please enter pincode";
      } elseif (!preg_match($pinPatt, $pin)) {
        $pinErr = "Invalid pincode";
      }

      if (!empty($landmark) && !preg_match($landPatt, $landmark)) {
        $landErr = "Invalid landmark";
      }

      // CHECK DUPLICATE
      $check = "SELECT * FROM customers_details WHERE email='$email' OR Mobile='$mob'";
      $checkResult = mysqli_query($connect, $check);
      if (mysqli_num_rows($checkResult) > 0) {
        $existing = mysqli_fetch_array($checkResult);
        if ($existing['email'] == $email) {
          $emailErr = "Email already registered";
        }
        if ($existing['Mobile'] == $mob) {
          $mobErr = "Mobile number already registered";
        }
      }

      // INSERT IF NO ERRORS
      if (empty($fullnameErr) && empty($usernameErr) && empty($emailErr) && empty($mobErr) && empty($passErr) && empty($cPassErr) && empty($doorErr) && empty($streetErr) && empty($cityErr) && empty($stateErr) && empty($pinErr) && empty($landErr)) {
        $query = "INSERT INTO customers_details (fullname, username, email, Mobile, Password, cPassword, Door, street, city, state, pincode, landmark) VALUES ('$fullname','$username','$email','$mob','$password','$cpassword','$door','$street','$city','$state','$pin','$landmark')";
        $result = mysqli_query($connect, $query);
        if ($result) {
          ?>
          <script>
            alert("Registration successful");
            window.location.href = "./login.php";
          </script>
          <?php

        } else {
          ?>
          <script>
            alert("Registration failed. Please try again.");
          </script>
          <?php
        }
      }
    }

  ?>

  <div class="container">
    <div class="register-box">
      <h2><span style="color:white;">Retro</span> Register</h2>

      <!-- Tabs -->
      <div class="tabs">
        <div class="tab active" data-target="userForm">User Register</div>
        <div class="tab" data-target="merchantForm">Merchant Register</div>
      </div>

      <!-- USER FORM -->

      <form id="userForm" class="active" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label>Full Name</label>
        <input type="text" name="fullname" value="<?php echo isset($fullname) ? $fullname : ''; ?>">
        <span><?php echo $fullnameErr; ?></span>

        <label>Username</label>
        <input type="text" name="username" value="<?php echo isset($username) ? $username : ''; ?>">
        <span><?php echo $usernameErr; ?></span>


        <label>Email</label>
        <input type="email" name="email" value="<?php echo isset($email) ? $email : ''; ?>">
        <span><?php echo $emailErr; ?></span>


        <label>Phone Number</label>
        <input type="text" name="phone" value="<?php echo isset($mob) ? $mob : ''; ?>">
        <span><?php echo $mobErr; ?></span>


        <label>Password</label>
        <div class="password-field">
          <input type="password" name="password" value="<?php echo isset($password) ? $password : ''; ?>">
          <i class="bi bi-eye-slash toggle-password"></i>

        </div>
        <span><?php echo $passErr; ?></span>


        <label>Confirm Password</label>
        <div class="password-field">
          <input type="password" name="confirm_password" value="<?php echo isset($cpassword) ? $cpassword : ''; ?>">
          <i class="bi bi-eye-slash toggle-password"></i>
        </div>
        <span><?php echo $cPassErr; ?></span>


        <div class="row">
          <div class="col">
            <label>Door / Flat No.</label>
            <input type="text" name="door" value="<?php echo isset($door) ? $door : ''; ?>">
            <span><?php echo $doorErr; ?></span>
          </div>

          <div class="col">
            <label>Street Name</label>
            <input type="text" name="street" value="<?php echo isset($street) ? $street : ''; ?>">
            <span><?php echo $streetErr; ?></span>
          </div>

        </div>

        <div class="row">
          <div class="col">
            <label>City</label>
            <input type="text" name="city" value="<?php echo isset($city) ? $city : ''; ?>">
            <span><?php echo $cityErr; ?></span>
          </div>

          <div class="col">
            <label>State</label>
            <input type="text" name="state" value="<?php echo isset($state) ? $state : ''; ?>">
            <span><?php echo $stateErr; ?></span>
          </div>

        </div>

        <div class="row">
          <div class="col">
            <label>Pincode</label>
            <input type="text" name="pincode" maxlength="6" value="<?php echo isset($pin) ? $pin : ''; ?>">
            <span><?php echo $pinErr; ?></span>
          </div>

          <div class="col">
            <label>Landmark (Optional)</label>
            <input type="text" name="landmark" placeholder="Near Bus Stand"
              value="<?php echo isset($landmark) ? $landmark : ''; ?>">
            <span><?php echo $landErr; ?></span>
          </div>

        </div>

        <button type="submit" name="user_register">Register as User</button>
      </form>

      <?php include("./merchant_reg.php"); ?>

    </div>
  </div>


  <script>
    const tabs = document.querySelectorAll('.tab');
    const forms = document.querySelectorAll('form');

    tabs.forEach(tab => {
      tab.addEventListener('click', () => {
        tabs.forEach(t => t.classList.remove('active'));
        tab.classList.add('active');

        forms.forEach(f => f.classList.remove('active'));
        document.getElementById(tab.dataset.target).classList.add('active');
      });
    });

    // Password toggle
    const toggleIcons = document.querySelectorAll('.toggle-password');
    toggleIcons.forEach(icon => {
      icon.addEventListener('click', () => {
        const input = icon.previousElementSibling;
        if (input.type === 'password') { input.type = 'text'; icon.classList.replace('bi-eye-slash', 'bi-eye'); }
        else { input.type = 'password'; icon.classList.replace('bi-eye', 'bi-eye-slash'); }
      });
    });
  </script>

</body>

</html>