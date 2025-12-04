<?php
session_start();
include("../../config/config.php");


?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Create Sub-Admin — Retro</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
        :root {
            --bg: #070708;
            --card: #0f0f10;
            --accent: #ffd700;
            --gold: #ffd700;
            --mag: #ffd700;
        }

        * {
            box-sizing: border-box
        }

        body {
            width: 90%;
            margin: 0;
            background: linear-gradient(180deg, #020202, #0b0b0b);
            color: #eaf9f9;
            font-family: Inter, Arial, sans-serif;
            padding: 28px
        }

        .wrap {
            max-width: 920px;
            margin: 0 auto
        }

        h1 {
            color: var(--gold);
            font-size: 18px;
            margin: 0 0 12px
        }

        .card {
            width: 100%;
            background: #363636ff;
            border: 2px solid #ffd700;
            border-radius: 12px;
            padding: 18px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.6)
        }

        form {
            width: 100%;
            display: grid;
            grid-template-columns: 1fr 320px;
            gap: 16px
        }

        label {
            display: block;
            color: #ffd700;
            font-size: 16px;
            margin-bottom: 6px
        }

        input,
        select {
            width: 120%;
            padding: 10px;
            border-radius: 8px;
            border: 2px solid #222;
            background: transparent;
            color: #e6f9f9;
            outline: none
        }

        textarea {
            min-height: 100px;
            padding: 10px;
            border-radius: 8px;
            border: 2px solid #222;
            background: transparent;
            color: #e6f9f9
        }

        .grid2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 80px;
        }

        .controls {
            display: flex;
            gap: 8px;
            margin-top: 10px
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 14px;
            border-radius: 10px;
            border: none;
            background: linear-gradient(90deg, var(--accent), var(--mag));
            color: #000;
            cursor: pointer;
            font-weight: 700
        }

        .btn.ghost {
            background: transparent;
            border: 2px solid var(--gold);
            color: var(--gold)
        }

        .notice {
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 10px
        }

        .small {
            font-size: 12px;
            color: #9aa;
            margin-top: 6px
        }

        @media(max-width:880px) {
            form {
                grid-template-columns: 1fr
            }
        }
    </style>
</head>

<body>
    <div class="wrap">
        <h1>Create Sub-Admin</h1>

        <div class="card">
            <form method="post" action="./process.php" onsubmit="return validateForm()">

                <div>
                    <!-- FULL NAME -->
                    <label for="name">Full Name</label>
                    <input id="name" name="name" placeholder="Enter full name" pattern="^[A-Za-z ]{3,50}$"
                        title="Name must contain only letters and spaces (min 3 characters)" required>

                    <!-- MANAGER ID + PHONE -->
                    <div class="grid2" style="margin-top:10px">
                        <input id="manager_id" name="manager_id" placeholder="e.g. mg-raj" pattern="^mg-[A-Za-z]{3,20}$"
                            title="Manager ID must start with 'mg-' followed by only letters (no numbers or special characters)"
                            required>

                        <div>
                            <label for="phone">Phone</label>
                            <input id="phone" name="phone" placeholder="+91xxxxxxxxxx" pattern="^(\+91)?[6-9]\d{9}$"
                                title="Enter a valid Indian mobile number (e.g. +919876543210)" required>
                        </div>
                    </div>

                    <!-- EMAIL + STATUS -->
                    <div class="grid2" style="margin-top:10px">
                        <div>
                            <label for="email">Email (optional)</label>
                            <input id="email" name="email" type="email" placeholder="email@example.com">
                        </div>

                    </div>

                    <!-- PASSWORD -->
                    <!-- PASSWORD -->
                    <div style="margin-top:10px; position: relative;">
                        <label for="password">Password</label>
                        <div style="position: relative;">
                            <input id="password" name="password" type="password" placeholder="e.g. krishnaveni@12345"
                                pattern="^(?=(?:.*\d){5,})(?=.*[!@#$%^&*]).{9,}$"
                                title="Must have ≥4 letters, ≥4 digits, ≥1 special character, and ≥9 total characters"
                                required style="width: 100%; padding-right: 40px;">
                            <i class="bi bi-eye-slash" id="togglePassword" style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%);
            color: #ffd700; cursor: pointer; font-size: 18px;"></i>
                        </div>
                    </div>

                    <!-- CONFIRM PASSWORD -->
                    <div style="margin-top:10px; position: relative;">
                        <label for="password_confirm">Confirm Password</label>
                        <div style="position: relative;">
                            <input id="password_confirm" name="password_confirm" type="password"
                                placeholder="Re-enter password" required style="width: 100%; padding-right: 40px;">
                            <i class="bi bi-eye-slash" id="toggleConfirmPassword" style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%);
            color: #ffd700; cursor: pointer; font-size: 18px;"></i>
                        </div>
                    </div>


                    <!-- BUTTONS -->
                    <div class="controls">
                        <button class="btn" type="submit" name="create"><i class="bi bi-person-plus-fill"></i> Create
                            Sub-Admin</button>
                        <a class="btn ghost" href="../admin_dashboard.php"><i class="bi bi-arrow-left-circle"></i>
                            Back to list</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Password match validation
        const pwd = document.getElementById('password');
        const pwdc = document.getElementById('password_confirm');

        function checkMatch() {
            if (pwdc.value && pwd.value !== pwdc.value) {
                pwdc.style.borderColor = '#b22222';
            } else {
                pwdc.style.borderColor = '';
            }
        }
        pwd.addEventListener('input', checkMatch);
        pwdc.addEventListener('input', checkMatch);

        // Final form validation before submit
        function validateForm() {
            if (pwd.value !== pwdc.value) {
                alert('❌ Password and Confirm Password do not match!');
                pwdc.focus();
                return false;
            }
            if (!pwd.checkValidity()) {
                alert('❌ ' + pwd.title);
                pwd.focus();
                return false;
            }
            if (!document.getElementById('phone').checkValidity()) {
                alert('❌ Enter a valid phone number.');
                return false;
            }
            return true;
        }



        // Toggle show/hide password
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');
        const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
        const confirmPassword = document.getElementById('password_confirm');

        togglePassword.addEventListener('click', () => {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            togglePassword.classList.toggle('bi-eye');
            togglePassword.classList.toggle('bi-eye-slash');
        });

        toggleConfirmPassword.addEventListener('click', () => {
            const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
            confirmPassword.setAttribute('type', type);
            toggleConfirmPassword.classList.toggle('bi-eye');
            toggleConfirmPassword.classList.toggle('bi-eye-slash');
        });

    </script>
</body>

</html>