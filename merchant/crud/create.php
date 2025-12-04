<?php
session_start();
include("../../config/config.php");


?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Create Product — Retro</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <style>
    :root {
      --bg: #070708;
      --card: #0f0f10;
      --accent: #ffd700;
      --gold: #ffd700;
      --mag: #ffd700;
      font-family: "Press Start 2P", cursive, Arial, sans-serif;
    }

    body {
      width: 95%;
      height: 150vh;
      background: linear-gradient(180deg, #020202, #0b0b0b);
      color: #eaf9f9;
      margin: 0;
      /* padding: 28px 0; */
      display: flex;
    }

    .container {
      margin-top: 20px;
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
      width: 95%;
      padding: 0 20px;
      border-radius: 10px;
      margin-left: 60px;
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

    .container_two {
      height: 75%;
      width: 100%;
      margin: 0 auto;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      margin-top: 15px;
    }

    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-top: 40px;
      margin-bottom: 14px;
    }
    
    .h1 {
      color: var(--gold);
      font-size: 18px
    }
    
    .card {
      width: 80%;
      background: #303030;
      border: 2px solid rgba(53, 52, 52, 0.03);
      border-radius: 12px;
      padding: 18px;
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.6)
      margin-bottom: 20px;
      
    }

    form {
      display: grid;
      grid-template-columns: 1fr 360px;
      gap: 16px;
    }

    label {
      display: block;
      color: #ffd700;
      font-size: 16px;
      margin-bottom: 6px
    }

    input,
    textarea,
    select {
      width: 90%;
      padding: 10px;
      border-radius: 8px;
      border: 2px solid #222;
      background: transparent;
      color: #e6f9f9;
      outline: none
    }

    textarea {
      min-height: 120px;
      resize: vertical
    }

    .grid2 {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 8px
    }

    .controls {
      display: flex;
      gap: 8px;
      align-items: center;
      margin-top: 8px
    }

    .btn {
      display: inline-flex;
      gap: 8px;
      align-items: center;
      padding: 10px 14px;
      border-radius: 10px;
      border: none;
      background: linear-gradient(90deg, var(--accent), var(--mag));
      color: #000;
      cursor: pointer;
      font-weight: 700
    }

    .btn.ghost {
      background: transparent;
      border: 2px solid var(--gold);
      color: var(--gold)
    }

    .preview {
      height: 220px;
      border-radius: 10px;
      border: 4px solid var(--mag);
      background: #0b0b0b;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #9aa;
      overflow: hidden
    }

    .preview img {
      max-width: 100%;
      max-height: 100%;
      display: block
    }

    @media(max-width:900px) {
      form {
        grid-template-columns: 1fr
      }

      .preview {
        height: 180px
      }
    }

    .helper {
      font-size: 12px;
      color: #9aa;
      margin-top: 6px
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="align">
      <a class="button_back ghost" href="../merchant_dashboard.php"><i class="bi bi-arrow-left-circle"></i>
        Back</a>
      <div class="topbar">
        <h2 style="color:#ffd700;">RetroCart </h2>
      </div>
    </div>

    <div class="container_two">
      <div class="header">
        <div class="h1">Create Product</div>
      </div>

      <div class="card">
        <form id="createProductForm" enctype="multipart/form-data" action="./process.php" method="POST">
          <div>
            <label for="name">Product Name</label>
            <input id="name" name="product_name" placeholder="Enter product name" required>

            <div style="margin-top:10px">
              <label for="description">Description</label>
              <textarea id="description" name="product_description" placeholder="Enter product description"></textarea>
            </div>

            <div class="grid2" style="margin-top:10px">
              <div>
                <label for="category">Category</label>
                <select id="category" name="category" required>
                  <option value="">-- select --</option>
                  <option value="RetroGames">Retro Games</option>
                  <option value="MusicTapes">Music Tapes</option>
                  <option value="VintageToys">Vintage Toys</option>
                  <option value="ClassicFashion">Classic Fashion</option>
                  <option value="OldComics">Old Comics</option>
                  <option value="HomeAppliances">Home Appliances</option>
                  <option value="Jewelry">Jewelry</option>
                  <option value="Watches">Watches</option>
                </select>
              </div>
            </div>

            <div class="grid2" style="margin-top:10px">
              <div>
                <label for="price">Price (₹)</label>
                <input id="price" name="product_price" placeholder="Enter price" required>
              </div>

              <div>
                <label for="brand">Brand</label>
                <input id="brand" name="product_brand" placeholder="Brand / Manufacturer">
              </div>
            </div>

            <div style="display:flex;gap:8px;margin-top:10px">
              <div style="flex:1">
                <label for="quantity">Quantity</label>
                <input id="quantity" name="quantity" type="number" min="0" placeholder="Quantity" value="1">
              </div>
            </div>

            <div class="grid2" style="margin-top:10px">
              <div>
                <label for="color">Color</label>
                <input id="color" name="product_color" placeholder="Product color(s) e.g. Neon Cyan">
              </div>
            </div>

            <div style="margin-top:10px">
              <label for="condition">Condition</label>
              <select id="condition" name="product_condition">
                <option value="New">New</option>
                <option value="Used">Used</option>
                <option value="Refurbished">Refurbished</option>
              </select>
            </div>

            <div class="controls">
              <button class="btn" type="submit" name="create"> Create</button>
              <!-- <a class="btn ghost" href="./admin_dashboard.php"><i class="bi bi-arrow-left-circle"></i> Back</a> -->
            </div>
          </div>

          <aside>
            <label for="image">Product Image</label>
            <input id="image" name="product_image" type="file" accept="image/*" onchange="previewImage(event)">
            <div class="helper">Accepted: jpg, png, webp, gif</div>

            <div class="preview" id="preview" style="margin-top:12px">
              <div style="text-align:center;color:#9aa">No image selected</div>
            </div>
          </aside>
        </form>
      </div>
    </div>

   <style>
  /* Footer */
  footer {
    width: 110%;
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


    <script>
      function previewImage(e) {
        const p = document.getElementById('preview');
        p.innerHTML = '';
        const file = e.target.files[0];
        if (!file) {
          p.innerHTML = '<div style="color:#9aa">No image selected</div>';
          return;
        }
        const img = document.createElement('img');
        img.src = URL.createObjectURL(file);
        img.onload = () => URL.revokeObjectURL(img.src);
        p.appendChild(img);
      }

      // Validation Function
      document.getElementById("createProductForm").addEventListener("submit", function (e) {
        const name = document.getElementById("name").value.trim();
        const description = document.getElementById("description").value.trim();
        const price = document.getElementById("price").value.trim();
        const brand = document.getElementById("brand").value.trim();
        const color = document.getElementById("color").value.trim();

        const nameRegex = /^[A-Za-z\s]{1,30}$/;
        const brandRegex = /^[A-Za-z\s]{1,30}$/;
        const colorRegex = /^[A-Za-z\s]{1,30}$/;
        const priceRegex = /^[0-9]+(\.[0-9]{1,2})?$/;

        if (!nameRegex.test(name)) {
          alert("Product name must contain only letters (max 30 characters).");
          e.preventDefault();
          return false;
        }

        if (description.length > 60) {
          alert("Description must be within 60 characters.");
          e.preventDefault();
          return false;
        }

        if (!priceRegex.test(price)) {
          alert("Price must contain only numbers (and optional decimal).");
          e.preventDefault();
          return false;
        }

        if (brand && !brandRegex.test(brand)) {
          alert("Brand must contain only letters (no numbers allowed).");
          e.preventDefault();
          return false;
        }

        if (color && !colorRegex.test(color)) {
          alert("Color must contain only letters (no numbers allowed).");
          e.preventDefault();
          return false;
        }
      });

      // price formatting allow only digits and decimal
      function allowPriceInput(el) {
        el.addEventListener('input', function () {
          this.value = this.value.replace(/[^\d.]/g, '');
        });
      }
      allowPriceInput(document.getElementById('price'));
    </script>


</body>

</html>