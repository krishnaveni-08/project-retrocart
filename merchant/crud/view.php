<?php
include("../../config/config.php");
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>View | RetroCart Product</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

  <style>
    :root {
      --gold: #ffd700;
      --bg: #0a0a0a;
      --card: #141414;
      --text: #eee;
      --cyan: #00ffff;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background: var(--bg);
      color: var(--text);
      margin: 0;
      padding: 0;
    }

    .align {
      margin-top: 40px;
      width: 70%;
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
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

   .container{
      width: 100%;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;

    }

    .topbar h1{
      text-align: center;
      color: white;
      font-size: 1.6rem;
      /* margin-bottom: 30px; */
      font-weight: 600;
      margin-top: 30px;
    }

    .card {
      background: var(--card);
      display: flex;
      flex-wrap: wrap;
      gap: 40px;
      padding: 30px;
      border-radius: 20px;
      box-shadow: 0 0 20px rgba(255, 215, 0, 0.2);
    }

    .image-wrap {
      flex: 1;
      text-align: center;
    }

    .neon-frame {
      padding: 10px;
      border: 2px solid var(--gold);
      border-radius: 16px;
      display: inline-block;
    }

    .product-image {
      width: 350px;
      height: 350px;
      object-fit: cover;
      border-radius: 12px;
    }

    .info {
      flex: 2;
    }

    .title {
      font-size: 2rem;
      color: var(--gold);
      margin-bottom: 8px;
    }

    .rating {
      color: var(--cyan);
      font-size: 1.2rem;
    }

    .meta {
      margin: 10px 0;
      font-size: 0.9rem;
      color: #aaa;
    }

    .price-row {
      display: flex;
      align-items: center;
      gap: 20px;
      margin: 20px 0;
    }

    .price {
      color: var(--cyan);
      font-size: 1.8rem;
      font-weight: 700;
    }

    .discount {
      color: #aaa;
      text-decoration: line-through;
      font-size: 1.2rem;
    }

    .stock {
      color: limegreen;
      font-weight: 600;
    }

    .desc {
      margin-top: 15px;
      line-height: 1.5;
      color: #ccc;
    }

    .specs {
      margin-top: 20px;
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 10px;
    }

    .spec strong {
      color: var(--gold);
      display: block;
      font-size: 0.9rem;
    }

    .spec span {
      color: var(--cyan);
      font-size: 0.95rem;
    }
  </style>

</head>

<body>
  <div class="container">
    <div class="align">
      <a class="button_back ghost" href="../merchant_dashboard.php"><i class="bi bi-arrow-left-circle"></i>
        Back</a>
      <div class="topbar"><h2>RetroCart </h2></div>
    </div>


    <?php
    include("../../component/product_view.php");


    ?>

  </div>
</body>


</html>