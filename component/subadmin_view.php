<?php
include("../../config/config.php");

// Check if subadmin_id is provided
if (!isset($_GET['subadmin_id'])) {
    die("No sub-admin ID provided.");
}

$subadmin_id = (int) $_GET['subadmin_id'];

// Fetch sub-admin data
$query = "SELECT * FROM sub_admins WHERE id = $subadmin_id";
$result = mysqli_query($connect, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    die("Sub-admin not found.");
}

$row = mysqli_fetch_assoc($result);
$subadmin_id = $row["id"];
$manager_id = $row["manager_id"];
$name = $row["name"];
$email = $row["email"];
$phone = $row["phone"];
$status = $row["status"];
$created_at = $row["created_at"];
$updated_at = $row["updated_at"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Sub-Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <!-- <link rel="stylesheet" href="../../assets/css/subadmin.css"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<style>
    .align {
        padding: 10px;
    }

    .crd {
        width: 100%;
    }

    .subadmin-grid {
        width: 80%;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
    }

    .subadmin-card {
        width: 200PX;
        background: #5b5b5bff;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        padding: 25px;
        width: 100%;
       
    }

    .subadmin-info {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .subadmin-row {
        display: flex;
        flex-direction: column;
    }

    .subadmin-label {
        font-weight: 600;
        color: white;
        margin-bottom: 6px;
    }

    .subadmin-input {
        width: 100%;
        background: #121212;
        /* border: 2px solid #ffd700; */
        border-radius: 8px;
        border: 2px solid #ffd700;
        padding: 10px 12px;
        color: #eaf9f9;
        font-weight: 600;
        font-size: 14px;
        /* outline: none; */
        transition: border 0.2s ease;
    }
    .col input{
        width: 470px;
    }

    .subadmin-input[readonly] {
        cursor: not-allowed;
        background-color: black;
    }

    @media (max-width: 600px) {
        .subadmin-card {
            padding: 20px;
        }

        .subadmin-label {
            font-size: 14px;
        }

        .subadmin-input {
            font-size: 13px;
        }
    }
</style>


<body>


    <form action="./process.php" method="POST" class="subadmin-grid">
        <div class="subadmin-card">

            <section class="subadmin-info">
                <div class="subadmin-row">
                    <label class="subadmin-label">Full Name</label>
                    <input type="text" class="subadmin-input" value="<?= htmlspecialchars($name) ?>" readonly>
                </div>

                <div class="subadmin-row">
                    <label class="subadmin-label">Manager ID</label>
                    <input type="text" class="subadmin-input" value="<?= htmlspecialchars($manager_id) ?>" readonly>
                </div>
                <div class="col">

                    <div class="subadmin-row">
                        <label class="subadmin-label">Phone</label>
                        <input type="text" class="subadmin-input" value="<?= htmlspecialchars($phone) ?>" readonly>
                    </div>
                    <div class="subadmin-row">
                        <label class="subadmin-label">Email</label>
                        <input type="email" class="subadmin-input" value="<?= htmlspecialchars($email) ?>" readonly>
                    </div>
                </div>


                <div class="subadmin-row">
                    <label class="subadmin-label">Status</label>
                    <input type="text" class="subadmin-input" value="<?= ucfirst($status) ?>" readonly>
                </div>

                <div class="subadmin-row">
                    <label class="subadmin-label">Created At</label>
                    <input type="text" class="subadmin-input" value="<?= htmlspecialchars($created_at) ?>" readonly>
                </div>

                <div class="subadmin-row">
                    <label class="subadmin-label">Last Updated</label>
                    <input type="text" class="subadmin-input" value="<?= htmlspecialchars($updated_at) ?>" readonly>
                </div>
            </section>

            <input type="hidden" name="subadmin_id" value="<?= $subadmin_id ?>">
        </div>
    </form>


</body>

</html>

<!-- footer -->
<style>
  main{
    width: 117%;
  }
  .retro-footer {
    width: 100%;

    background: #444444ff;
    color: #eee;
    text-align: center;
    padding: 40px 20px;
    border-top: 2px solid #ffd700;
    margin-top: 50px;
  }

  .retro-footer .logo {
    font-size: 1.8rem;
    color: #ffd700;
    font-weight: 700;
    margin-bottom: 5px;
    letter-spacing: 1px;
  }

  .retro-footer .tagline {
    font-size: 0.95rem;
    color: #ccc;
    margin-bottom: 20px;
  }

  .footer-links {
    list-style: none;
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 20px;
    padding: 0;
    margin-bottom: 20px;
  }

  .footer-links li a {
    text-decoration: none;
    color: #eee;
    font-size: 0.95rem;
    transition: color 0.3s;
  }

  .footer-links li a:hover {
    color: #ffd700;
  }

  .retro-footer .copyright {
    font-size: 0.85rem;
    color: #aaa;
    margin-top: 10px;
  }
</style>
<main>
  <!-- ====== FOOTER START ====== -->
  <footer class="retro-footer">
    <div class="footer-content">
      <h2 class="logo">RetroCart</h2>
      <p class="tagline">Reviving the golden era of the 80s & 90s.</p>

     

      <p class="copyright">
        © 2025 RetroCart. All rights reserved.
      </p>
    </div>
  </footer>
  <!-- ====== FOOTER END ====== -->

</main>