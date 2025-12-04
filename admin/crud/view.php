<?php
session_start();
include_once('../../config/config.php');


$product_id = $_GET['product_id'] ?? null;
$customer_id = $_GET['customer_id'] ?? null;
$merchant_id = $_GET['merchant_id'] ?? null;
?>


<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Admin — View</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">


  <style>
    :root {
      --bg: #070708;
      --card: #0f0f10;
      --gold: #ffd700;
      --muted: #9aa;
      --accent: #00f0e0;
      --danger: #d9534f;
    }


body{
      width: 100%;
      background: linear-gradient(180deg, #020202, #0b0b0b);
      color: #eaf9f9;
      font-family: Inter, Arial, sans-serif;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
}
    .container {
      width: 100%;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      /* background-color: green; */

    }

    .align {
      background-color: grey;

      /* margin-top: 40px; */
      width: 85%;
      padding: 0 20px;
      border-radius: 10px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .align .topbar h1 {
      color: #ffd700;
    }

    .button_back {
      text-decoration: none;
      color: #fff;
      font-size: 1rem;
      display: inline-block;
      padding: 10px 20px;
      border-radius: 5px;
      background-color: #ffd700;
    }

    
  </style>


</head>

<body>
  <div class="container">
    <div class="align">
      <a class="button_back ghost" href="../admin_dashboard.php"><i class="bi bi-arrow-left-circle"></i>
        Back</a>
      <div class="topbar">
        <h2 style="color:#ffd700;">RetroCart </h2>
      </div>
    </div>

    <?php
  if ($product_id) {
      include("../../component/product_view.php");
    } elseif ($customer_id) {
      include("../../component/customer_view.php");
    } elseif ($merchant_id) {
      include("../../component/merchant_view.php");
    }

    ?>

  </div>


</body>




