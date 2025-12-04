<?php
session_start();
include("../config/config.php");

if (!isset($_SESSION['merchant_id'])) {
  header("Location: ../login.php");
}

$merchant_id = $_SESSION['merchant_id'];

// ✅ Add dynamic overview queries here
$totalProducts = mysqli_fetch_assoc(mysqli_query($connect, "SELECT COUNT(*) as total FROM products WHERE merchant_id = $merchant_id"))['total'];
$totalOrders = mysqli_fetch_assoc(mysqli_query($connect, "SELECT COUNT(*) as total FROM order_table WHERE merchant_id = $merchant_id"))['total'];
$totalRevenue = mysqli_fetch_assoc(mysqli_query($connect, "SELECT SUM(total_amount) as total FROM order_table WHERE merchant_id = $merchant_id"))['total'];
$totalRevenue = $totalRevenue ?? 0; // null check

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Merchant Dashboard | RetroCart</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <style>
    body {
      margin: 0;
      background-color: #000;
      color: #fff;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      display: flex;
      min-height: 100vh;
      overflow-x: hidden;
    }

    /* Sidebar */
    .sidebar {
      width: 230px;
      background: #111;
      border-right: 2px solid #ffd700;
      padding: 20px 10px;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .head {
      display: flex;
      justify-content: space-between;
      margin-bottom: 15px;

    }

    .sidebar h2 {
      color: #ffd700;
      text-align: center;
      margin-bottom: 30px;
    }

    .sidebar h2 span {
      color: #fff;
    }

    .nav-links {
      width: 100%;
      display: flex;
      flex-direction: column;
      gap: 10px;
    }

    .nav-links a {
      color: #fff;
      text-decoration: none;
      padding: 10px 15px;
      border-radius: 8px;
      display: flex;
      align-items: center;
      transition: 0.3s;
    }

    .nav-links a i {
      margin-right: 10px;
    }

    .nav-links a:hover,
    .nav-links a.active {
      background: #ffd700;
      color: #000;
      font-weight: 600;
    }

    /* Main Content */
    .main-content {
      flex: 1;
      /* padding: 30px; */
      overflow-y: auto;
    }

    .main-content {
      flex: 1;
      /* padding: 30px; */
      overflow-y: auto;
    }
    main .content-section:not(footer){
      padding: 30px;
    }
    main .content-section{
      min-height: 100vh;
    }
    main footer{
      padding: 10px 0px;
    }

    .content-section {
      display: none;
      animation: fadeIn 0.4s ease;
    }

    .content-section.active {
      display: block;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(10px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* Cards */
    .card {
      background: #111;
      border: 2px solid #ffd700;
      color: #fff;
      text-align: center;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(255, 215, 0, 0.3);
    }

    .card h3 {
      color: #ffd700;
    }

    /* Product Grid */
    .product-grid {
      display: flex;
      flex-wrap: wrap;
      /* grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); */
      gap: 20px;
    }

    .product-card {
      width: 300px;
      background: #111;
      border: 2px solid #ffd700;
      border-radius: 10px;
      padding: 10px;
      text-align: center;
    }

    .product-card img {
      width: 100%;
      height: 150px;
      margin-bottom: 30px;
      object-fit: contain;
      /* border: 2px solid #ffd700; */
    }

    .btn-gold {
      background-color: #ffd700;
      color: #000;
      border: none;
      border-radius: 5px;
      padding: 6px 12px;
    }

    .btn-gold:hover {
      background-color: #e5c100;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
      background: #111;
      border: 2px solid #ffd700;
      border-radius: 10px;
      overflow: hidden;
    }

    th,
    td {
      padding: 12px 15px;
      text-align: left;
      border-bottom: 1px solid #333;
    }

    th {
      background: #222;
      color: #ffd700;
    }

    tr:hover {
      background: #1a1a1a;
    }

    @media(max-width: 768px) {
      body {
        flex-direction: column;
      }

      .sidebar {
        width: 100%;
        flex-direction: row;
        justify-content: space-around;
        border-right: none;
        border-bottom: 2px solid #ffd700;
        padding: 10px;
      }

      .nav-links {
        flex-direction: row;
        gap: 5px;
      }

      .main-content {
        padding: 20px;
      }
    }
  </style>
</head>

<body>
  <!-- Sidebar -->
  <aside class="sidebar">
    <h2>Retro<span>Cart</span></h2>
    <div class="nav-links">
      <a href="#" class="active" data-section="overview"><i class="bi bi-house"></i>Dashboard</a>
      <a href="#" data-section="products"><i class="bi bi-box"></i>My Products</a>
      <a href="#" data-section="orders"><i class="bi bi-bag"></i>Orders</a>

      <a href="#" data-section="settings"><i class="bi bi-gear"></i>Settings</a>

    </div>
  </aside>

  <!-- Main Content -->
  <main class="main-content">

    <!-- Dashboard Overview -->
    <div id="overview" class="content-section active ">
      <div class="head">
        <h2 style="color:#ffd700;">Dashboard Overview</h2>
        <div class="chk">
          <a href="../index.php" class="btn btn-sm btn-gold" style="color:black;">View Website</a>
          <a href="../logout.php" class="btn btn-sm btn-gold" style="color:black;">Logout</a>
        </div>

      </div>
      <div class="row mt-4 g-4">

        <div class="col-md-3">
          <div class="card">
            <h3>Products</h3>
            <p><?= $totalProducts ?></p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card">
            <h3>Orders</h3>
            <p><?= $totalOrders ?></p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card">
            <h3>Total Revenue</h3>
            <p>₹<?= number_format($totalRevenue, 2) ?></p>
          </div>
        </div>





      </div>
    </div>

    <!-- My Products Section -->
    <div id="products" class="content-section">
      <h2 style="color:#ffd700;">My Products</h2>
      <a href="./crud/create.php"><button class="btn-gold my-3"><i class="bi bi-plus-circle"></i> Add
          Product</button></a>

      <div class="product-grid">
        <?php
        $query = "
  SELECT * FROM products 
  WHERE merchant_id = {$_SESSION['merchant_id']} 
  AND status = 'active'
  AND {$_SESSION['merchant_id']} IN (
      SELECT id FROM merchant_details WHERE status = 'active'
  )
";
        $result = mysqli_query($connect, $query);

        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_array($result)) {
            $product_id = $row["product_id"];
            $product_name = $row["name"];
            $product_price = $row["price"];

            $imagequery = "SELECT * FROM product_image WHERE product_id = '$product_id' LIMIT 1";
            $imageResult = mysqli_query($connect, $imagequery);
            $img = ($imageResult && mysqli_num_rows($imageResult) > 0)
              ? mysqli_fetch_assoc($imageResult)
              : null;
            ?>
            <div class="product-card">
              <?php if (!empty($img) && !empty($img['image_path'])) { ?>
                <img src="../<?= htmlspecialchars($img['image_path']); ?>" alt="Product Image">
              <?php } else { ?>
                <img src="../assets/no-image.jpg" alt="No Image Available">
              <?php } ?>
              <h5><?= htmlspecialchars($product_name) ?></h5>
              <p>₹<?= htmlspecialchars($product_price) ?></p>
              <a href="./crud/view.php?product_id=<?= $product_id ?>" class="btn btn-sm btn-gold">View</a>
              <a href="./crud/edit.php?product_id=<?= $product_id ?>" class="btn btn-sm btn-gold">Edit</a>

              <form action="./crud/process.php" method="POST" style="display:inline-block;">
                <input type="hidden" name="product_id" value="<?= $product_id ?>">
                <button type="submit" name="product_delete" class="btn btn-sm btn-danger">Delete</button>
              </form>

            </div>
            <?php
          }
        } else {
          echo "<h3>No Products Found</h3>";
        }
        ?>
      </div>
    </div>

    <!-- Orders -->
    <div id="orders" class="content-section">
      <h2 style="color:#ffd700;">Customer Orders</h2>

      <table>
        <thead>
          <tr>
            <th>Order ID</th>
            <th>Product</th>
            <th>Buyer</th>
            <th>Type</th>
            <!-- <th>Quantity</th> -->
            <th>Total</th>
            <th>Payment</th>
          </tr>
        </thead>
        <tbody>
          <?php
          // ✅ Fetch all orders related to this merchant
          $orderQuery = "
        SELECT 
          o.id AS order_id, 
          o.product_name, 
          o.buyer_name, 
          o.buyer_type, 
          o.quantity, 
          o.total_amount, 
          o.payment_method
        FROM order_table o
        WHERE o.merchant_id = '$merchant_id'
        ORDER BY o.id DESC
      ";

          $orderResult = mysqli_query($connect, $orderQuery);

          if (mysqli_num_rows($orderResult) > 0) {
            while ($row = mysqli_fetch_assoc($orderResult)) {
              ?>
              <tr>
                <td>#<?= htmlspecialchars($row['order_id']); ?></td>
                <td><?= htmlspecialchars($row['product_name']); ?></td>
                <td><?= htmlspecialchars($row['buyer_name']); ?></td>
                <td style="text-transform: capitalize;"><?= htmlspecialchars($row['buyer_type']); ?></td>
                <td>₹<?= htmlspecialchars($row['total_amount']); ?></td>
                <td><?= htmlspecialchars($row['payment_method']); ?></td>
              </tr>
              <?php
            }
          } else {
            echo "<tr><td colspan='7' style='text-align:center;'>No orders yet!</td></tr>";
          }
          ?>
        </tbody>
      </table>
    </div>

    <!-- Earnings -->
    <div id="earnings" class="content-section">
      <h2 style="color:#ffd700;">Earnings Summary</h2>
      <div class="card mt-3">
        <h3>Total Earnings</h3>
        <p>₹78,500</p>
      </div>
      <div class="card mt-3">
        <h3>Pending Payouts</h3>
        <p>₹12,000</p>
      </div>
    </div>

    <!-- Settings -->
    <div id="settings" class="content-section">
      <h2 style="color:#ffd700;">Profile Settings</h2>
      <form class="mt-3">
        <div class="mb-3">
          <label class="form-label">Full Name</label>
          <input type="text" class="form-control bg-dark text-white border-warning" value="Merchant Name">
        </div>
        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" class="form-control bg-dark text-white border-warning" value="merchant@retrocart.com">
        </div>
        <div class="mb-3">
          <label class="form-label">Change Password</label>
          <input type="password" class="form-control bg-dark text-white border-warning" placeholder="********">
        </div>
        <button class="btn-gold">Save Changes</button>
      </form>
    </div>

    <footer>
      <p class="logo">RetroCart</p>
      <p class="copyright">© 2025 RetroCart. All rights reserved.</p>
    </footer> 

  </main>

  <style>
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

  <script>
    const navLinks = document.querySelectorAll('.nav-links a');
    const sections = document.querySelectorAll('.content-section');

    navLinks.forEach(link => {
      link.addEventListener('click', e => {
        e.preventDefault();
        navLinks.forEach(l => l.classList.remove('active'));
        link.classList.add('active');
        sections.forEach(s => s.classList.remove('active'));
        document.getElementById(link.dataset.section).classList.add('active');
      });
    });
  </script>


</body>



</html>


<!-- <style>
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
  }b

  footer .copyright {
    font-size: 0.9rem;
    color: #ccc;
    margin-top: 10px;
  }
</style>
<footer>
  <p class="logo">RetroCart</p>
  <p class="copyright">© 2025 RetroCart. All rights reserved.</p>
</footer> -->