<style>
  :root {
    --gold: #ffd700;
    --bg: #0a0a0a;
    --card: #141414;
    --text: #eee;
    --cyan: #00ffff;
  }

  /* .container {
      max-width: 1200px;
      margin: 40px auto;
      padding: 20px;
    } */

  .align {
    margin-top: 40px;
    width: 70%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    background: #5b5a5aff;
    padding: 0 20px;
    border-radius: 15px;
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

  .container {
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;

  }

  .topbar h1 {
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


  .cd {
    width: 80%;
      background-color: #303030ff;
    display: flex;
    flex-wrap: wrap;
    gap: 40px;
    padding: 30px;
    margin-top: 20px;
    border-radius: 20px;
    box-shadow: 0 0 20px rgba(255, 215, 0, 0.2);
  }

  .image-wrap {
    flex: 1;
    text-align: center;
  }

  .neon-frame img {
    width: 300px;
    height: 300px;

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

<?php
if (isset($_GET['product_id'])) {
  $product_id = (int) $_GET['product_id'];
  $query = "SELECT * FROM products WHERE product_id = $product_id";
  $result = mysqli_query($connect, $query);

  if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    $product_id = $row["product_id"];
    $name = $row["name"];
    $price = $row["price"];
    $description = $row["description"];
    $category = $row["category"];
    $merchant_id = $row["merchant_id"];
    $status = $row["status"];
    $quantity = $row["quantity"];
    $brand = $row["brand"];
    $color = $row["color"];
    $condition = $row["condition"];
    $imagequery = "SELECT * FROM product_image WHERE product_id = '$product_id' LIMIT 1";
    $imageResult = mysqli_query($connect, $imagequery);
    $img = ($imageResult && mysqli_num_rows($imageResult) > 0)
      ? mysqli_fetch_assoc($imageResult)
      : null;

    // echo $img['image_path'];  

  } else {
    die("Product not found.");
  }
} else {
  die("No product ID provided.");
}
?>

<h1>Product-View</h1>
<article class="cd" aria-labelledby="productTitle">
  <div class="image-wrap">
    <div class="neon-frame">
      <?php if (!empty($img) && !empty($img['image_path'])) { ?>
        <img src="../../<?= htmlspecialchars($img['image_path']); ?>" alt="Product Image">
      <?php } else { ?>
        <img src="../assets/no-image.jpg" alt="No Image Available">
      <?php } ?>
    </div>
  </div>

  <div class="info">
    <h1 id="productTitle" class="title"><?= htmlspecialchars($name); ?></h1>
    <div class="rating">★★★★☆</div>

    <div class="meta">
      <span>Category: <?= htmlspecialchars($category); ?></span>
    </div>

    <div class="price-row">
      <div class="price">₹<?= htmlspecialchars($price); ?></div>
      <?php if (!empty($discount_price)): ?>
        <div class="discount">₹<?= htmlspecialchars($discount_price) ?></div>
      <?php endif; ?>
    </div>

    <p class="desc"><?= htmlspecialchars($description); ?></p>

    <div class="specs">
      <div class="spec"><strong>Brand</strong><span><?= htmlspecialchars($brand) ?></span></div>
      <div class="spec"><strong>Color</strong><span><?= htmlspecialchars($color) ?></span></div>
      <div class="spec"><strong>Quantity</strong><span><?= htmlspecialchars($quantity) ?></span></div>
      <div class="spec"><strong>Condition</strong><span><?= htmlspecialchars($condition) ?></span></div>
      <div class="spec"><strong>Merchant ID</strong><span><?= htmlspecialchars($merchant_id) ?></span></div>
    </div>
  </div>


</article>

<style>
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
<footer>
  <p class="logo">RetroCart</p>
  <p class="copyright">© 2025 RetroCart. All rights reserved.</p>
</footer>

