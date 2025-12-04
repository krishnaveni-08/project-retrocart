<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Cart</title>
  <link rel="stylesheet" href="order.css">
</head>

<style>
    body {
  background: #f7f7f7;
  font-family: "Poppins", sans-serif;
  margin: 0;
  padding: 0;
  color: #222;
}

.cart-container {
  width: 90%;
  max-width: 1100px;
  margin: 50px auto;
  background: #fff;
  border-radius: 15px;
  padding: 40px;
  box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
}

h1 {
  font-size: 2rem;
  margin-bottom: 30px;
  font-weight: 700;
}

.cart-table {
  width: 100%;
  display: flex;
  flex-direction: column;
  gap: 15px;
}

.table-header, .table-row {
  display: grid;
  grid-template-columns: 2fr 1fr 1fr 1fr 1fr;
  align-items: center;
  padding: 15px 20px;
}

.table-header {
  background: #f0f0f0;
  font-weight: 600;
  border-radius: 10px;
}

.table-row {
  background: #fff;
  border-bottom: 1px solid #eee;
  transition: all 0.2s ease;
}

.table-row:hover {
  background: #fafafa;
}

.product-cell {
  display: flex;
  align-items: center;
  gap: 15px;
}

.product-cell img {
  width: 70px;
  height: 70px;
  border-radius: 10px;
  object-fit: cover;
  background: #eee;
}

.p-name {
  font-weight: 600;
}

.price {
  font-weight: 600;
  color: #000;
}

</style>


<body>
  <div class="cart-container">
    <h1>My Cart</h1>

    <div class="cart-table">
      <div class="table-header">
        <div>Product</div>
        <div>Brand</div>
        <div>Color</div>
        <div>Quantity</div>
        <div>Price</div>
      </div>

      <!-- Product 1 -->
      <div class="table-row">
        <div class="product-cell">
          <img src="https://via.placeholder.com/100x100?text=Xiaomi" alt="Xiaomi 365">
          <span class="p-name">Xiaomi 365</span>
        </div>
        <div>Xiaomi</div>
        <div>White</div>
        <div>1</div>
        <div class="price">484.99€</div>
      </div>

      <!-- Product 2 -->
      <div class="table-row">
        <div class="product-cell">
          <img src="https://via.placeholder.com/100x100?text=Ninebot" alt="Ninebot ES2">
          <span class="p-name">Ninebot ES2</span>
        </div>
        <div>Ninebot</div>
        <div>Black</div>
        <div>3</div>
        <div class="price">489.99€</div>
      </div>

      <!-- Product 3 -->
      <div class="table-row">
        <div class="product-cell">
          <img src="https://via.placeholder.com/100x100?text=RetroWatch" alt="Retro Watch">
          <span class="p-name">Retro Watch</span>
        </div>
        <div>Casio</div>
        <div>Silver</div>
        <div>2</div>
        <div class="price">120.00€</div>
      </div>
    </div>
  </div>
</body>
</html>


<!--  -->










<!-- order -->


<?php
include_once('../config/config.php');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ---------------- INSERT ORDER IF FORM SUBMITTED ----------------
if (isset($_POST['order'])) {
    $buyer_id = $_POST['buyer_id'];
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $total_amount = $_POST['total_amount'];
    $payment_method = $_POST['payment_method'];
    $date = date('Y-m-d H:i:s');

    mysqli_query($connect, "INSERT INTO order_table (buyer_id, product_id, quantity, total_amount, payment_method, created_at) 
                            VALUES ('$buyer_id', '$product_id', '$quantity', '$total_amount', '$payment_method', '$date')")
        or die(mysqli_error($connect));

    header("Location: ../component/order.php");
    exit;
}

// ---------------- FETCH ORDERS ----------------
$buyer_id = $_SESSION['customer_id'] ?? $_SESSION['merchant_id'] ?? null;

if (!$buyer_id) {
    echo "<script>alert('Please login first!'); window.location.href='../login.php';</script>";
    exit;
}
$orderQuery = "
    SELECT o.*, 
           p.name AS product_name, 
           (SELECT pi.image_path FROM product_image pi WHERE pi.product_id = p.product_id LIMIT 1) AS image_path
    FROM order_table o
    LEFT JOIN products p ON o.product_id = p.product_id
    WHERE o.buyer_id = '$buyer_id'
    ORDER BY o.id DESC
";
$orderResult = mysqli_query($connect, $orderQuery) or die(mysqli_error($connect));

if ($orderResult && mysqli_num_rows($orderResult) > 0) {
    while ($row = mysqli_fetch_assoc($orderResult)) {
        // display order
    }
} else {
    echo '<p class="empty">No orders found yet! 🛒</p>';
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background-color: #000;
            color: #ffd700;
            font-family: 'Orbitron', sans-serif;
            padding: 40px 0;
            margin-bottom: 50px;
        }

        .orders-container {
            width: 90%;
            max-width: 900px;
            margin: auto;
            background: #111;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 0 15px rgba(255, 215, 0, 0.4);
        }

        .orders-container h1 {
            text-align: center;
            color: #ffd700;
            margin-bottom: 20px;
        }

        .order-card {
            display: flex;
            align-items: center;
            gap: 20px;
            background: #1a1a1a;
            border: 1px solid #ffd700;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            transition: 0.3s;
        }

        .order-card:hover {
            background: #222;
            transform: scale(1.02);
        }

        .order-card img {
            width: 120px;
            height: 120px;
            border-radius: 10px;
            object-fit: cover;
            border: 2px solid #ffd700;
        }

        .order-details {
            flex: 1;
            color: #fff;
            font-size: 15px;
            line-height: 1.8;
        }

        .order-details strong {
            color: #ffd700;
        }

        .empty {
            text-align: center;
            color: #fff;
            font-size: 18px;
            margin-top: 30px;
        }
    </style>
</head>

<body>
    <header class="retro-header">
        <?php include('../component/nav-copy.php'); ?><style>
    </header>

    <main>
        <div class="orders-container">
            <h1><i class="bi bi-bag-check-fill"></i> My Orders</h1>
            <hr style="border-color:#ffd700; margin:15px 0;">

            <?php if (mysqli_num_rows($orderResult) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($orderResult)): ?>
                    <div class="order-card">
                        <?php if (!empty($row['image_path'])): ?>
                            <img src="../<?php echo htmlspecialchars($row['image_path']); ?>" alt="Product Image">
                        <?php else: ?>
                            <img src="../assets/no-image.jpg" alt="No Image">
                        <?php endif; ?>

                        <div class="order-details">
                            <p><strong>Product Name:</strong> <?php echo htmlspecialchars($row['product_name']); ?></p>
                            <p><strong>Quantity:</strong> <?php echo htmlspecialchars($row['quantity']); ?></p>
                            <p><strong>Total:</strong> ₹<?php echo htmlspecialchars($row['total_amount']); ?></p>
                            <p><strong>Ordered By:</strong> <?php echo ucfirst($row['buyer_type']); ?></p>
                            <p><strong>Order Date:</strong>
                                <?php echo date('d M Y, h:i A', strtotime($row['created_at'] ?? 'now')); ?></p>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="empty">No orders found yet! 🛒</p>
            <?php endif; ?>
        </div>
    </main>

    <?php include('../component/footer.php'); ?>
</body>

</html>

