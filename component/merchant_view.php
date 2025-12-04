<?php
include("../../config/config.php"); // DB connection

if (!isset($_GET['merchant_id'])) {
    die("No merchant ID provided.");
}

$merchant_id = (int) $_GET['merchant_id'];

// Fetch merchant details
$query = "SELECT * FROM merchant_details WHERE id = $merchant_id";
$result = mysqli_query($connect, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    die("Merchant not found.");
}

$row = mysqli_fetch_assoc($result);

$fullname = $row['Fullname'];
$username = $row['username'];
$email = $row['email'];
$phone = $row['mobilenumber'];
$shop = $row['shopname'];
$busstype = $row['bussinesstype'];
$door = $row['door'];
$street = $row['street'];
$city = $row['city'];
$state = $row['state'];
$pin = $row['pincode'];
$landmark = $row['landmark'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>View Merchant</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<style>




.card-containn {
    background-color: #1a1a1a;
    border-radius: 20px;
    padding: 30px;
    width: 100%;
    max-width: 850px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.6);
    color: #fff;
}

    .align {
      background-color: grey;

      margin-top: 40px;
      width: 95%;
      padding: 10px 20px;
      border-radius: 10px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 30px;
    }
/* ===== CARD HEADER ===== */
.card-containn h2 {
    color: #ffd700;
    text-align: center;
    margin-bottom: 30px;
    font-weight: 700;
}

/* ===== FORM GROUP ===== */
.form-group {
    display: flex;
    flex-direction: column;
    margin-bottom: 15px;
}

.form-group label {
    font-weight: 600;
    margin-bottom: 5px;
    color: #ffd700;
}

.form-group input {
    padding: 10px 12px;
    border-radius: 10px;
    border: 1px solid #ffd700;
    background-color: #222;
    color: #fff;
}

.form-group input[readonly] {
    background-color: #111;
    border: 1px solid #555;
    color: #ccc;
}

/* ===== ROW LAYOUT ===== */
.row-custom {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
}

.col-50 {
    flex: 1 1 48%;
}

.col-25 {
    flex: 1 1 23%;
}

.col-75 {
    flex: 1 1 73%;
}

.col-100 {
    flex: 1 1 100%;
}

/* ===== BUTTON ===== */
.btn-back {
    background-color: #ffd700;
    color: #000;
    font-weight: 600;
    border: none;
    padding: 10px 20px;
    border-radius: 12px;
    text-decoration: none;
    display: inline-block;
    transition: 0.3s;
}

.btn-back:hover {
    background-color: #e6c200;
    color: #000;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 768px) {
    .col-50, .col-25, .col-75 {
        flex: 1 1 100%;
    }
}
</style>
</head>


<div class="card-containn">
    <h2>Merchant Details</h2>

    <div class="row-custom">
        <div class="form-group col-50">
            <label>Full Name</label>
            <input type="text" value="<?= htmlspecialchars($fullname) ?>" readonly>
        </div>

        <div class="form-group col-50">
            <label>Username</label>
            <input type="text" value="<?= htmlspecialchars($username) ?>" readonly>
        </div>

        <div class="form-group col-50">
            <label>Email</label>
            <input type="text" value="<?= htmlspecialchars($email) ?>" readonly>
        </div>

        <div class="form-group col-50">
            <label>Phone</label>
            <input type="text" value="<?= htmlspecialchars($phone) ?>" readonly>
        </div>

        <div class="form-group col-50">
            <label>Shop / Store Name</label>
            <input type="text" value="<?= htmlspecialchars($shop) ?>" readonly>
        </div>

        <div class="form-group col-50">
            <label>Business Type</label>
            <input type="text" value="<?= htmlspecialchars($busstype) ?>" readonly>
        </div>

        <div class="form-group col-25">
            <label>Door / Flat No.</label>
            <input type="text" value="<?= htmlspecialchars($door) ?>" readonly>
        </div>

        <div class="form-group col-25">
            <label>Street</label>
            <input type="text" value="<?= htmlspecialchars($street) ?>" readonly>
        </div>

        <div class="form-group col-25">
            <label>City</label>
            <input type="text" value="<?= htmlspecialchars($city) ?>" readonly>
        </div>

        <div class="form-group col-25">
            <label>State</label>
            <input type="text" value="<?= htmlspecialchars($state) ?>" readonly>
        </div>

        <div class="form-group col-25">
            <label>Pincode</label>
            <input type="text" value="<?= htmlspecialchars($pin) ?>" readonly>
        </div>

        <div class="form-group col-75">
            <label>Landmark</label>
            <input type="text" value="<?= htmlspecialchars($landmark) ?>" readonly>
        </div>

        <div class="form-group col-100" style="text-align:center; margin-top:20px;">
            <a href="../admin_dashboard.php" class="btn-back">Back to Dashboard</a>
        </div>
    </div>
</div>


</html>

<style>
  /* Footer */
  footer {
    width: 117%;
    background: #444444ff;
    color: #eee;
    text-align: center;
    /* padding: 35px 20px; */
    border-top: 2px solid #ffd700;
    margin-top: 40px;
  }

  footer .logo {
    font-size: 1.8rem;
    color: #ffd700;
    font-weight: 700;
  }

  footer .copyright {
    font-size: 0.9rem;
    color: #ccc;
    margin-top: 10px;
  }
</style>
<!-- ===================== FOOTER ======================== -->
<footer>
  <p class="logo">RetroCart</p>
  <p class="copyright">© 2025 RetroCart. All rights reserved.</p>
</footer>
