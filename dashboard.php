<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>RetroCart Dashboard</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <style>
    *{margin:0;padding:0;box-sizing:border-box;font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif;}
    body{background:#000;color:#fff;display:flex;min-height:100vh;overflow-x:hidden;}

    /* Sidebar */
    .sidebar{width:230px;background:#111;border-right:2px solid #ffd700;padding:20px 10px;display:flex;flex-direction:column;align-items:center;}
    .logo h2{color:#ffd700;text-align:center;margin-bottom:30px;}
    .logo span{color:#fff;}
    .nav-links{width:100%;display:flex;flex-direction:column;gap:10px;}
    .nav-links a{color:#fff;text-decoration:none;padding:10px 15px;border-radius:8px;display:flex;align-items:center;transition:0.3s;}
    .nav-links a i{margin-right:10px;}
    .nav-links a.active,.nav-links a:hover{background:#ffd700;color:#000;font-weight:600;}

    /* Main content */
    .main-content{flex:1;padding:30px;overflow-y:auto;}
    .section{display:none;animation:fadeIn 0.4s ease;}
    .section.active{display:block;}
    @keyframes fadeIn{from{opacity:0;transform:translateY(10px);}to{opacity:1;transform:translateY(0);}}

    /* Cards */
    .stats-cards{display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:20px;margin-bottom:30px;}
    .card{background:#111;border:2px solid #ffd700;border-radius:10px;padding:20px;text-align:center;box-shadow:0 0 10px rgba(255,215,0,0.3);}
    .card h3{color:#ffd700;margin-bottom:10px;text-transform:uppercase;}
    .card p{font-size:22px;font-weight:700;}

    /* Recent orders */
    .recent-orders{margin-top:20px;}
    .recent-orders h3{color:#ffd700;margin-bottom:10px;}
    .order-list{display:grid;gap:15px;}
    .order-card{background:#111;border:1px solid #ffd700;border-radius:8px;padding:15px;}
    .order-card h4{color:#ffd700;margin-bottom:5px;}
    .order-card span{display:block;font-size:14px;color:#ccc;}

    /* Table */
    table{width:100%;border-collapse:collapse;margin-top:20px;background:#111;border:2px solid #ffd700;border-radius:10px;overflow:hidden;}
    th,td{padding:12px 15px;text-align:left;border-bottom:1px solid #333;}
    th{background:#222;color:#ffd700;}
    tr:hover{background:#1a1a1a;}

    /* Product Cards */
    .product-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:20px;margin-top:25px;}
    .product-card{background:#111;border:2px solid #ffd700;border-radius:10px;overflow:hidden;text-align:center;padding-bottom:10px;}
    .product-card img{width:100%;height:150px;object-fit:cover;}
    .product-card h4{margin:10px 0;color:#ffd700;}
    .product-card p{color:#fff;font-weight:bold;}

    /* Merchant Cards */
    .merchant-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:20px;margin-top:25px;}
    .merchant-card{background:#111;border:2px solid #ffd700;border-radius:10px;padding:15px;text-align:center;}
    .merchant-card h4{color:#ffd700;margin-bottom:5px;}

    @media(max-width:768px){
      body{flex-direction:column;}
      .sidebar{width:100%;flex-direction:row;overflow-x:auto;justify-content:space-around;}
      .nav-links{flex-direction:row;gap:5px;}
      .main-content{padding:20px;}
    }
  </style>
</head>
<body>

  <!-- Sidebar -->
  <aside class="sidebar">
    <div class="logo"><h2>Retro<span>Cart</span></h2></div>
    <div class="nav-links">
      <a href="#" class="active" data-section="dashboard"><i class="bi bi-house"></i>Dashboard</a>
      <a href="#" data-section="customer"><i class="bi bi-people"></i>Customers</a>
      <a href="#" data-section="merchant"><i class="bi bi-person-badge"></i>Merchants</a>
      <a href="#" data-section="product"><i class="bi bi-box"></i>Products</a>
      <a href="#" data-section="subadmin"><i class="bi bi-person-gear"></i>Sub Admin</a>
      <a href="#" data-section="review"><i class="bi bi-chat-left-text"></i>Reviews</a>
    </div>
  </aside>

  <!-- Main -->
  <main class="main-content">

    <!-- Dashboard -->
    <section id="dashboard" class="section active">
      <h2 style="color:#ffd700;">Dashboard Overview</h2>
      <div class="stats-cards">
        <div class="card"><h3>Total Orders</h3><p>150</p></div>
        <div class="card"><h3>Total Revenue</h3><p>₹1,20,000</p></div>
        <div class="card"><h3>Products</h3><p>50</p></div>
        <div class="card"><h3>Customers</h3><p>120</p></div>
      </div>

      <div class="recent-orders">
        <h3>Recent Orders</h3>
        <div class="order-list">
          <div class="order-card">
            <h4>#101 - Vintage Walkman</h4>
            <span>Customer: Ravi Kumar</span>
            <span>Status: Delivered</span>
            <span>Total: ₹5,999</span>
          </div>
          <div class="order-card">
            <h4>#102 - Retro T-Shirt</h4>
            <span>Customer: Sara Patel</span>
            <span>Status: Processing</span>
            <span>Total: ₹1,200</span>
          </div>
          <div class="order-card">
            <h4>#103 - Vinyl Poster</h4>
            <span>Customer: Arun</span>
            <span>Status: Cancelled</span>
            <span>Total: ₹800</span>
          </div>
        </div>
      </div>
    </section>

    <!-- Customers -->
    <section id="customer" class="section">
      <h2 style="color:#ffd700;">Customer List</h2>
      <table>
        <thead><tr><th>ID</th><th>Name</th><th>Email</th><th>Phone</th></tr></thead>
        <tbody>
          <tr><td>1</td><td>Ravi Kumar</td><td>ravi@mail.com</td><td>9876543210</td></tr>
          <tr><td>2</td><td>Sara Patel</td><td>sara@mail.com</td><td>9123456780</td></tr>
          <tr><td>3</td><td>Arun Raj</td><td>arun@mail.com</td><td>9988776655</td></tr>
        </tbody>
      </table>
    </section>

    <!-- Merchants -->
    <section id="merchant" class="section">
      <h2 style="color:#ffd700;">Merchants</h2>
      <div class="merchant-grid">
        <div class="merchant-card">
          <h4>Vintage World</h4>
          <p>Products: 25</p>
          <p>Revenue: ₹85,000</p>
        </div>
        <div class="merchant-card">
          <h4>Retro Deals</h4>
          <p>Products: 15</p>
          <p>Revenue: ₹45,000</p>
        </div>
        <div class="merchant-card">
          <h4>Classic Hub</h4>
          <p>Products: 30</p>
          <p>Revenue: ₹95,000</p>
        </div>
      </div>
    </section>

    <!-- Products -->
    <section id="product" class="section">
      <h2 style="color:#ffd700;">Products</h2>
      <div class="product-grid">
        <div class="product-card">
          <img src="https://via.placeholder.com/200x150?text=Walkman" alt="">
          <h4>Vintage Walkman</h4>
          <p>₹5,999</p>
        </div>
        <div class="product-card">
          <img src="https://via.placeholder.com/200x150?text=T-Shirt" alt="">
          <h4>Retro T-Shirt</h4>
          <p>₹1,200</p>
        </div>
        <div class="product-card">
          <img src="https://via.placeholder.com/200x150?text=Poster" alt="">
          <h4>Vinyl Poster</h4>
          <p>₹800</p>
        </div>
      </div>
    </section>

    <!-- Sub Admin -->
    <section id="subadmin" class="section">
      <h2 style="color:#ffd700;">Sub Admins</h2>
      <table>
        <thead><tr><th>ID</th><th>Name</th><th>Role</th><th>Email</th></tr></thead>
        <tbody>
          <tr><td>1</td><td>Krishna</td><td>Manager</td><td>krishna@retrocart.com</td></tr>
          <tr><td>2</td><td>Meena</td><td>Support</td><td>meena@retrocart.com</td></tr>
        </tbody>
      </table>
    </section>

    <!-- Reviews -->
    <section id="review" class="section">
      <h2 style="color:#ffd700;">Customer Reviews</h2>
      <table>
        <thead><tr><th>User ID</th><th>Name</th><th>Product</th><th>Review</th><th>Rating</th></tr></thead>
        <tbody>
          <tr><td>1</td><td>Ravi Kumar</td><td>Walkman</td><td>Excellent quality!</td><td>⭐️⭐️⭐️⭐️⭐️</td></tr>
          <tr><td>2</td><td>Sara Patel</td><td>T-Shirt</td><td>Nice fabric, loved it!</td><td>⭐️⭐️⭐️⭐️</td></tr>
          <tr><td>3</td><td>Arun</td><td>Poster</td><td>Good but packaging late.</td><td>⭐️⭐️⭐️</td></tr>
        </tbody>
      </table>
    </section>

  </main>

  <script>
    const navLinks = document.querySelectorAll('.nav-links a');
    const sections = document.querySelectorAll('.section');

    navLinks.forEach(link=>{
      link.addEventListener('click',e=>{
        e.preventDefault();
        navLinks.forEach(l=>l.classList.remove('active'));
        link.classList.add('active');
        sections.forEach(s=>s.classList.remove('active'));
        const target=link.getAttribute('data-section');
        document.getElementById(target).classList.add('active');
      });
    });
  </script>
</body>
</html>
