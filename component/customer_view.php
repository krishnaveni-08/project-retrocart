<?php
if (isset($_GET['customer_id'])) {

  $customer_id = $_GET['customer_id'];
  $query = "SELECT * FROM customers_details WHERE id = $customer_id";
  $result = mysqli_query($connect, $query);
  $row = mysqli_fetch_assoc($result);

  $userId   = $row['id'];
  $name     = $row['fullname'];
  $username = $row['username'];
  $email    = $row['email'];
  $phone    = $row['Mobile'];
  $status   = $row['status'];
  $door     = $row['Door'];
  $street   = $row['street'];
  $city     = $row['city'];
  $state    = $row['state'];
  $pincode  = $row['pincode'];
  $landmark = $row['landmark'];
}
?>

<!-- ===================== CSS ======================== -->
<style>
  body {
width: 100%;
    background: #000;
    font-family: Arial, sans-serif;
    color: #fff;
  }

  /* Main container */
  .contain {
    width: 100%;
    padding: 40px 0;
    display: flex;
    justify-content: center;
  }

  .cont {
    background-color: #1a1a1a;
    border-radius: 20px;
    padding: 30px;
    width: 90%;
    max-width: 850px;
    color: #fff;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.6);
  }

  .top .title {
    font-size: 28px;
    font-weight: 700;
    color: #ffd700;
  }

  .grid {
    display: flex;
    flex-direction: column;
    gap: 20px;
  }

  .col {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
  }

  .row {
    width: 48%;
    display: flex;
    flex-direction: column;
    gap: 6px;
    padding: 12px 0;
    border-bottom: 1px solid rgba(255, 255, 255, 0.05);
  }

  .row:last-child {
    border-bottom: none;
  }

  .label {
    color: #aaa;
    font-size: 13px;
  }

  .input {
    width: 96%;
    background: #121212;
    border-radius: 8px;
    border: 2px solid #ffd700;
    padding: 10px 12px;
    color: #fff;
    font-weight: 600;
    font-size: 14px;
  }

  /* Responsive Fix */
  @media (max-width: 600px) {
    .row {
      width: 100%;
    }
  }

  /* Footer */
  footer {
    width: 100%;
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

<!-- ===================== HTML ======================== -->
<div class="contain">
  <div class="cont">

    <div class="top">
      <h1 class="title">Customer Details</h1>
      <div class="meta-id">ID #<span><?= $userId ?></span></div>
    </div>

    <div class="grid">

      <div class="col">
        <div class="row">
          <div class="label">Full Name</div>
          <div class="input"><?= htmlspecialchars($name) ?></div>
        </div>

        <div class="row">
          <div class="label">Username</div>
          <div class="input"><?= htmlspecialchars($username) ?></div>
        </div>
      </div>

      <div class="col">
        <div class="row">
          <div class="label">Phone</div>
          <div class="input"><?= htmlspecialchars($phone) ?></div>
        </div>

        <div class="row">
          <div class="label">Email</div>
          <div class="input"><?= htmlspecialchars($email) ?></div>
        </div>
      </div>

      <div class="col">
        <div class="row">
          <div class="label">Status</div>
          <div class="input"><?= htmlspecialchars($status) ?></div>
        </div>

        <div class="row">
          <div class="label">Door</div>
          <div class="input"><?= htmlspecialchars($door) ?></div>
        </div>
      </div>

      <div class="col">
        <div class="row">
          <div class="label">Street</div>
          <div class="input"><?= htmlspecialchars($street) ?></div>
        </div>

        <div class="row">
          <div class="label">City</div>
          <div class="input"><?= htmlspecialchars($city) ?></div>
        </div>
      </div>

      <div class="col">
        <div class="row">
          <div class="label">Pincode</div>
          <div class="input"><?= htmlspecialchars($pincode) ?></div>
        </div>

        <div class="row">
          <div class="label">Landmark</div>
          <div class="input"><?= htmlspecialchars($landmark) ?></div>
        </div>
      </div>

    </div>

  </div>
</div>

<!-- ===================== FOOTER ======================== -->
<footer>
  <p class="logo">RetroCart</p>
  <p class="copyright">© 2025 RetroCart. All rights reserved.</p>
</footer>
