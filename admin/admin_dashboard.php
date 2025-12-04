<?php
session_start();
include("../config/config.php");
include("../includes/stats.php");
if (!isset($_SESSION['admin_id'])) {
  header('Location: ./admin_login.php');
  exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard - RetroCart</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }


    body {
      background: #000;
      color: #fff;
      display: flex;

      min-height: 100vh;
      overflow-x: hidden;
    }


    /* pop */

    .status-btn {
      padding: 5px 10px;
      border: none;
      border-radius: 20px;
      font-size: 13px;
      cursor: pointer;
      text-transform: capitalize;
      transition: 0.3s;
    }

    .status-btn.active {
      background: rgba(0, 200, 120, 0.12);
      color: #bfffbf;
      border: 1px solid rgba(0, 200, 120, 0.18);
    }

    .status-btn.inactive {
      background: rgba(200, 50, 50, 0.08);
      color: #ffbaba;
      border: 1px solid rgba(200, 50, 50, 0.12);
    }

    .status {
      display: inline-block;
      padding: 4px 8px;
      border-radius: 999px;
      font-size: 12px;
      text-transform: capitalize;
    }

    .status.active {
      background: rgba(0, 200, 120, 0.12);
      color: #bfffbf;
      border: 1px solid rgba(0, 200, 120, 0.18);
    }

    .status.inactive {
      background: rgba(200, 50, 50, 0.08);
      color: #ffbaba;
      border: 1px solid rgba(200, 50, 50, 0.12);
    }

    .head {
      display: flex;
      justify-content: space-between;
      margin-bottom: 15px;

    }

    .button_view {
      padding: 5px 5px;
      border: none;
      border-radius: 5px;
      text-decoration: none;
      color: #fff;
      cursor: pointer;
      background-color: #28a745;
      margin-top: 5px;
    }

    .button_edit {
      padding: 5px 5px;
      border: none;
      border-radius: 5px;
      text-decoration: none;
      color: #fff;
      cursor: pointer;
      background-color: #007bff;
      margin-top: 5px;
    }

    .button_delete {
      padding: 5px 5px;
      border: none;
      border-radius: 5px;
      text-decoration: none;
      color: #fff;
      cursor: pointer;
      background-color: #dc3545;
      margin-top: 5px;
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

    .logo h2 {
      color: #ffd700;
      text-align: center;
      margin-bottom: 30px;
    }

    .logo span {
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

    .nav-links a.active,
    .nav-links a:hover {
      background: #ffd700;
      color: #000;
      font-weight: 600;
    }

    /* Main content */
    .main-content {
      flex: 1;
      /* padding: 30px; */
      overflow-y: auto;
    }

    main section:not(footer) {
      padding: 30px;
    }

    main section {
      min-height: 100vh;
    }

    main footer {
      padding: 10px 0px;
    }

    /* main footer{
      width: 100%;
      position: fixed;
      bottom: 0px;
    } */

    .section {
      display: none;
      animation: fadeIn 0.4s ease;
    }

    .section.active {
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
    .stats-cards {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
      gap: 20px;
      margin-bottom: 30px;
    }

    .card {
      background: #111;
      border: 2px solid #ffd700;
      border-radius: 10px;
      padding: 20px;
      text-align: center;
      box-shadow: 0 0 10px rgba(255, 215, 0, 0.3);
    }

    .card h3 {
      color: #ffd700;
      margin-bottom: 10px;
      text-transform: uppercase;
    }

    .card p {
      font-size: 22px;
      font-weight: 700;
    }

    /* Recent orders */
    .recent-orders {
      margin-top: 20px;
    }

    .recent-orders h3 {
      color: #ffd700;
      margin-bottom: 10px;
    }

    .order-list {
      display: grid;
      gap: 15px;
    }

    .order-card {
      background: #111;
      border: 1px solid #ffd700;
      border-radius: 8px;
      padding: 15px;
    }

    .order-card h4 {
      color: #ffd700;
      margin-bottom: 5px;
    }

    .order-card span {
      display: block;
      font-size: 14px;
      color: #ccc;
    }

    /* Table */
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

    /* Product Cards */
    .product-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 20px;
      margin-top: 25px;
    }

    .product-card {
      background: #111;
      border: 2px solid #ffd700;
      border-radius: 10px;
      overflow: hidden;
      text-align: center;
      padding-bottom: 10px;
    }

    .product-card img {
      width: 100% !important;
      height: 150px;

      object-fit: contain;
    }

    .product-card h4 {
      margin: 10px 0;
      color: #ffd700;
    }

    .product-card p {
      color: #fff;
      font-weight: bold;
    }

    /* Merchant Cards */
    .merchant-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 20px;
      margin-top: 25px;
    }

    .merchant-card {
      background: #111;
      border: 2px solid #ffd700;
      border-radius: 10px;
      padding: 15px;
      text-align: center;
    }

    .merchant-card h4 {
      color: #ffd700;
      margin-bottom: 5px;
    }

    @media(max-width:768px) {
      body {
        flex-direction: column;
      }

      .sidebar {
        width: 100%;
        flex-direction: row;
        overflow-x: auto;
        justify-content: space-around;
      }

      .nav-links {
        flex-direction: row;
        gap: 5px;
      }

      .main-content {
        padding: 20px;
      }
    }

    .view-btn,
    .delete-btn {
      padding: 5px 10px;
      border: none;
      border-radius: 5px;
      text-decoration: none;
      color: #fff;
      cursor: pointer;
      background-color: red;
    }

    .view-btn {
      background-color: #28a745;
      margin-right: 5px;
    }
  </style>

</head>

<body>

  <!-- Sidebar -->
  <aside class="sidebar">
    <div class="logo">
      <h2>Retro<span>Cart</span></h2>
    </div>
    <div class="nav-links">
      <a href="#" class="active" data-section="dashboard"><i class="bi bi-house"></i>Dashboard</a>
      <a href="#" data-section="customer"><i class="bi bi-people"></i>Customers</a>
      <a href="#" data-section="merchant"><i class="bi bi-person-badge"></i>Merchants</a>
      <a href="#" data-section="product"><i class="bi bi-box"></i>Products</a>
      <a href="#" data-section="newsletter"><i class="bi bi-envelope"></i>Newsletter</a>
    </div>
  </aside>

  <!-- Main -->
  <main class="main-content">

    <!-- Dashboard -->
    <section id="dashboard" class="section active">
      <div class="head">
        <h2 style="color:#ffd700;">Dashboard Overview</h2>
        <a href="./admin_login.php" class="btn btn-sm btn-gold " style="color:black;">Logout</a>
      </div>

      <div class="stats-cards">
        <div class="card">
          <h3>Overall Orders</h3>
          <p><?= htmlspecialchars($totOrders) ?></p>
        </div>
        <div class="card">
          <h3>Overall Revenue</h3>
          <p>₹<?= number_format($totalRevenue, 2) ?></p>
        </div>
        <div class="card">
          <h3>Overall Products</h3>
          <p><?= htmlspecialchars($totProducts) ?></p>
        </div>
        <div class="card">
          <h3>Customers</h3>
          <p><?= htmlspecialchars($totCustomers) ?></p>
        </div>
        <div class="card">
          <h3>Merchants</h3>
          <p><?= htmlspecialchars($totMerchants) ?></p>
        </div>
      </div>

      <div class="recent-orders">
        <h3>Recent Orders</h3>
        <div class="order-list">
          <?php foreach ($recentOrders as $ord): ?>
            <div class="order-card">
              <h4>#<?= htmlspecialchars($ord['order_id']) ?> - ₹<?= number_format($ord['total_amount'], 2) ?></h4>
              <span>Customer: <?= htmlspecialchars($ord['buyer_name'] ?: 'Guest') ?></span>
              <span>Type: <?= htmlspecialchars($ord['buyer_type']) ?></span>
              <span>Date: <?= htmlspecialchars($ord['order_date']) ?></span>
            </div>
          <?php endforeach; ?>
        </div>
      </div>

    </section>

    <!-- Customers -->
    <section id="customer" class="section">
      <h2 style="color:#ffd700;">customer List</h2>
      <table>
        <thead>
          <tr>
            <th>S.No</th>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $query = "SELECT * FROM customers_details ORDER BY id DESC";
          $result = mysqli_query($connect, $query);

          if (mysqli_num_rows($result) > 0) {
            $rowId = 1;
            while ($row = mysqli_fetch_array($result)) {
              $userId = $row['id'];
              $name = $row['fullname'];
              $email = $row['email'];
              $phone = $row['Mobile'];
              $status = $row['status'];
              ?>
              <tr>
                <td><?= $rowId; ?></td>
                <td><?= $userId; ?></td>
                <td><?= htmlspecialchars($name); ?></td>
                <td><?= htmlspecialchars($email); ?></td>
                <td><?= htmlspecialchars($phone); ?></td>
                <td>
                  <button data-type="customer"
                    style="padding:10px 10px;width:100px;border:none;border-radius:5px;color:#fff; background-color:<?= ($status == 'active') ? '#28a745' : '#dc3545' ?>">
                    <?= ucfirst($status) ?>
                  </button>
                </td>
                <td>

                  <a href="./crud/view.php?customer_id=<?= $userId ?>" class="view-btn">View</a>

                  <?php
                  if ($status == "active") {
                    ?>
                    <form action="./crud/process.php" method="POST" style="display:inline-block;">
                      <input type="hidden" name="customer_id" value="<?= $userId ?>">
                      <button type="submit" name="customer_delete" class="delete-btn">Delete</button>
                    </form>
                    <?php
                  } else {
                    ?>
                    <form action="./crud/process.php" method="POST" style="display:inline-block;">
                      <input type="hidden" name="customer_id" value="<?= $userId ?>">
                      <button type="submit" name="customer_revert" class="revert-btn delete-btn">Revert</button>
                    </form>
                    <?php
                  }
                  ?>

                </td>
                <style>
                  .revert-btn {
                    background-color: blue !important;
                  }
                </style>
              </tr>
              <?php
              $rowId++;
            }
          } else {
            echo "<tr><td colspan='7'>No Merchants Found</td></tr>";
          }
          ?>
        </tbody>
      </table>
    </section>

    <!-- Merchants -->
    <section id="merchant" class="section">
      <h2 style="color:#ffd700;">Merchants List</h2>
      <table>
        <thead>
          <tr>
            <th>S.No</th>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $query = "SELECT * FROM merchant_details ORDER BY id DESC";
          $result = mysqli_query($connect, $query);

          if (mysqli_num_rows($result) > 0) {
            $rowId = 1;
            while ($row = mysqli_fetch_array($result)) {
              $userId = $row['id'];
              $name = $row['Fullname'];
              $email = $row['email'];
              $phone = $row['mobilenumber'];
              $status = $row['status'];
              ?>
              <tr>
                <td><?= $rowId; ?></td>
                <td><?= $userId; ?></td>
                <td><?= htmlspecialchars($name); ?></td>
                <td><?= htmlspecialchars($email); ?></td>
                <td><?= htmlspecialchars($phone); ?></td>
                <td>
                  <button data-type="merchant"
                    style="padding:10px 10px;width:100px;border:none;border-radius:5px;color:#fff; background-color:<?= ($status == 'active') ? '#28a745' : '#dc3545' ?>">
                    <?= ucfirst($status) ?>
                  </button>
                </td>
                <td>

                  <a href="./crud/view.php?merchant_id=<?= $userId ?>" class="view-btn">View</a>

                  <?php
                  if ($status == "active") {
                    ?>
                    <form action="./crud/process.php" method="POST" style="display:inline-block;">
                      <input type="hidden" name="merchant_id" value="<?= $userId ?>">
                      <button type="submit" name="merchant_delete" class="delete-btn">Delete</button>
                    </form>
                    <?php
                  } else {
                    ?>
                    <form action="./crud/process.php" method="POST" style="display:inline-block;">
                      <input type="hidden" name="merchant_id" value="<?= $userId ?>">
                      <button type="submit" name="merchant_revert" class="revert-btn delete-btn">Revert</button>
                    </form>
                    <?php
                  }
                  ?>

                </td>
                <style>
                  .revert-btn {
                    background-color: blue !important;
                  }
                </style>
              </tr>
              <?php
              $rowId++;
            }
          } else {
            echo "<tr><td colspan='7'>No Merchants Found</td></tr>";
          }
          ?>
        </tbody>
      </table>
    </section>

    <!-- Products -->
    <section id="product" class="section">
      <h2 style="color:#ffd700;">Products</h2>
      <div class="product-grid">
        <?php if (count($products) > 0): ?>
          <?php foreach ($products as $p): ?>
            <div class="product-card">

              <div class="image-container">
                <img src="../<?= htmlspecialchars($p['image_path'] ?: 'assets/no-image.jpg') ?>" alt="Product Image">
              </div>

              <div class="content-container">
                <div class="pd_head">
                  <h5><?= htmlspecialchars($p['name']) ?></h5>
                  <p>₹<?= htmlspecialchars($p['price']) ?></p>
                  <a href="./crud/view.php?product_id=<?= $p['product_id'] ?>" class="button_view btn-sm btn-gold">View</a>
                  <a href="./crud/edit.php?product_id=<?= $p['product_id'] ?>" class="button_edit btn-sm btn-gold">Edit</a>

                  <form action="./crud/process.php" method="POST" style="display:inline-block;">
                    <input type="hidden" name="product_id" value="<?= $p['product_id'] ?>">
                    <button type="submit" name="product_delete" class="button_delete btn-sm btn-danger">Delete</button>
                  </form>

                </div>
              </div>

            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <h3>No Products Found</h3>
        <?php endif; ?>
      </div>
    </section>


    <!-- Newsletter Subscribers -->
    <section id="newsletter" class="section">
      <h2 style="color:#ffd700;">Newsletter Subscribers</h2>
      <table>
        <thead>
          <tr>
            <th>S.No</th>
            <th>Email</th>
            <th>Subscribed At</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $query = "SELECT * FROM newsletter_subscribers ORDER BY subscribed_at DESC";
          $result = mysqli_query($connect, $query);
          if (mysqli_num_rows($result) > 0) {
            $i = 1;
            while ($row = mysqli_fetch_assoc($result)) {
              echo "<tr>
                    <td>{$i}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['subscribed_at']}</td>
                  </tr>";
              $i++;
            }
          } else {
            echo "<tr><td colspan='3'>No Subscribers Yet</td></tr>";
          }
          ?>
        </tbody>
      </table>
    </section>

    <!-- Popup Modal -->
    <div id="statusModal" style="
    display:none;
    position:fixed;
    inset:0;
    background:rgba(0,0,0,0.7);
    justify-content:center;
    align-items:center;
    z-index:1000;">
      <div
        style="background:#111;border:2px solid #ffd700;padding:20px;border-radius:10px;width:300px;text-align:center;">
        <h3 style="color:#ffd700;">Change Status</h3>
        <p id="modalMsg" style="margin:15px 0;color:#fff;"></p>
        <button id="confirmBtn"
          style="background:#28a745;color:#fff;padding:8px 15px;border:none;border-radius:5px;cursor:pointer;">Confirm</button>
        <button id="cancelBtn"
          style="background:#d9534f;color:#fff;padding:8px 15px;border:none;border-radius:5px;cursor:pointer;margin-left:10px;">Cancel</button>
      </div>
    </div>

    <footer>
      <p class="logo">RetroCart</p>
      <p class="copyright">© 2025 RetroCart. All rights reserved.</p>
    </footer>


    <style>
      .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 12px;
        gap: 12px;
      }

      .create-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #ffd700;
        color: #000;
        padding: 8px 12px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
      }

      .table-wrap {
        overflow-x: auto;
      }

      .subadmin-table {
        width: 100%;
        border-collapse: collapse;
        background: #0b0b0b;
        border: 2px solid #ffd700;
        border-radius: 8px;
        overflow: hidden;
      }

      .subadmin-table thead th {
        background: #111;
        color: #ffd700;
        padding: 10px 12px;
        text-align: left;
        font-weight: 700;
        font-size: 13px;
      }

      .subadmin-table tbody td {
        padding: 10px 12px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.03);
        color: #eaeaea;
        font-size: 14px;
      }

      .subadmin-table tbody tr:hover {
        background: rgba(255, 215, 0, 0.02);
      }

      .status {
        display: inline-block;
        padding: 4px 8px;
        border-radius: 999px;
        font-size: 12px;
        text-transform: capitalize;
      }

      .status.active {
        background: rgba(0, 200, 120, 0.12);
        color: #bfffbf;
        border: 1px solid rgba(0, 200, 120, 0.18);
      }

      .status.inactive {
        background: rgba(200, 50, 50, 0.08);
        color: #ffbaba;
        border: 1px solid rgba(200, 50, 50, 0.12);
      }

      .actions {
        display: flex;
        gap: 8px;
        align-items: center;
      }

      .btn {
        display: inline-block;
        padding: 6px 10px;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        text-decoration: none;
        color: #fff;
        font-size: 13px;
        background-color: #ffd700;
      }

      .btn.edit {
        background: #28a745;
      }

      .btn.delete {
        background: #d9534f;
      }

      @media (max-width: 880px) {

        .subadmin-table thead th:nth-child(7),
        .subadmin-table tbody td:nth-child(7) {
          display: none;
        }

        .subadmin-table thead th:nth-child(4),
        .subadmin-table tbody td:nth-child(4) {
          display: none;
        }

      }
    </style>

  </main>



</body>

<script>


// All menu links
const links = document.querySelectorAll(".nav-links a");

// All sections
const sections = document.querySelectorAll(".section");

// Add click event
links.forEach(link => {
    link.addEventListener("click", function (e) {
        e.preventDefault();

        // Remove active class from all nav links
        links.forEach(l => l.classList.remove("active"));

        // Add active class to clicked link
        this.classList.add("active");

        // Hide all sections
        sections.forEach(sec => sec.classList.remove("active"));

        // Show selected section
        let sectionId = this.getAttribute("data-section");
        document.getElementById(sectionId).classList.add("active");
    });
});





  document.querySelectorAll('.status-toggle-btn').forEach(btn => {
    btn.onclick = () => {
      const id = btn.dataset.id, type = btn.dataset.type, s = btn.dataset.status;
      const next = (s === 'inactive') ? 'active' : 'inactive';
      if (confirm(`Move this ${type} to ${next}?`)) {
        fetch('./crud/status_update.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
          body: `id=${id}&type=${type}&status=${s}`
        })
          .then(r => r.json())
          .then(d => {
            if (d.success) {
              btn.dataset.status = d.newStatus;
              btn.textContent = d.newStatus[0].toUpperCase() + d.newStatus.slice(1);
              btn.style.backgroundColor = (d.newStatus === 'active') ? '#28a745' : '#dc3545';
              alert(`${type} is now ${d.newStatus}!`);
            } else alert(d.message);
          })
          .catch(() => alert("Something went wrong!"));
      }
    }
  });


</script>





</body>



<style>
  footer {
    /* width: 117%; */
    background: #444444ff;
    color: #eee;
    text-align: center;
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


</html>