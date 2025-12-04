<?php
session_start();
include("./config/config.php");

$loggedin = isset($_SESSION['customer_id']) || isset($_SESSION['merchant_id']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <link rel="stylesheet" href="./style/style.css">
  <link rel="stylesheet" href="./style/categories.css">
  <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body>
  <header class="retro-header">
    <?php include("./component/nav.php"); ?>
  </header>

  <main>
    <!-- HERO SECTION -->
    <section class="retro-hero-banner">
      <div class="retro-hero-bg"></div>
      <div class="retro-hero-content" data-aos="flip-right">
        <h1>Explore the Best of the 80s & 90s</h1>
        <p>Find your nostalgia. Relive your childhood. Shop iconic products!</p>
        <form class="retro-search">
          <button>Shop Now</button>
        </form>
      </div>
    </section>

    <!-- CATEGORY BUTTONS -->
    <section class="category-selector">
      <div class="categories-buttons">
        <?php
        $categories = [
          "RetroGames" => "Retro Games",
          "MusicTapes" => "Music Tapes",
          "VintageToys" => "Vintage Toys",
          "ClassicFashion" => "Classic Fashion",
          "OldComics" => "Old Comics",
          "HomeAppliances" => "Home Appliances",
          "Jewelry" => "Jewelry",
          "Watches" => "Watches"
        ];

        foreach ($categories as $key => $name) {
          echo "<button data-category='{$key}'>{$name}</button>";
        }
        ?>
      </div>
    </section>

    <!-- CATEGORY PRODUCTS -->
    <section class="category-products-container">
      <?php
      foreach ($categories as $catKey => $catName) {
        echo "<div class='category-products' id='{$catKey}' data-aos='zoom-out'>";
        echo "<h2 class='category-title'>{$catName}</h2>";
        echo "<div class='product-grid'>";

        $query = "SELECT p.*, m.status AS merchant_status 
                  FROM products p 
                  JOIN merchant_details m ON p.merchant_id = m.id 
                  WHERE p.category='$catKey' AND p.status='active' AND m.status='active' 
                  ORDER BY p.product_id DESC";

        $result = mysqli_query($connect, $query);

        if ($result && mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            $product_id = $row['product_id'];
            $name = htmlspecialchars($row['name']);
            $price = htmlspecialchars($row['price']);

            // Get product image
            $imagequery = "SELECT image_path FROM product_image WHERE product_id='$product_id' LIMIT 1";
            $imageResult = mysqli_query($connect, $imagequery);
            $imgPath = "./assets/no-image.jpg";
            if ($imageResult && mysqli_num_rows($imageResult) > 0) {
              $img = mysqli_fetch_assoc($imageResult);
              if (!empty($img['image_path'])) {
                $imgPath = './' . htmlspecialchars($img['image_path']);
              }
            }
            ?>

            <div class="product-card">
              <img src="<?= $imgPath ?>" alt="Product Image">
              <div class="name">
                <h3><?= $name ?></h3>
                <p>₹<?= $price ?></p>
                <a href="<?= $loggedin ? "./product.php?product_id=$product_id" : "javascript:void(0)" ?>" 
                   onclick="<?php if (!$loggedin) { echo "alert('Login required!'); window.location.href='login.php';"; } ?>">
                  <button>Buy Now</button>
                </a>
              </div>
            </div>

            <?php
          }
        } else {
          echo "<div class='no-products'> Products Coming Soon!</div>";
        }

        echo "</div></div>";
      }
      ?>
    </section>


  </main>

  <?php include("./component/footer.php"); ?>

  <script>
    const buttons = document.querySelectorAll(".categories-buttons button");
    const categories = document.querySelectorAll(".category-products");

    buttons.forEach(btn => {
      btn.addEventListener("click", () => {
        buttons.forEach(b => b.classList.remove("active"));
        btn.classList.add("active");
        const target = btn.getAttribute("data-category");
        categories.forEach(cat => cat.style.display = "none");
        document.getElementById(target).style.display = "grid";
      });
    });

    buttons[0].click();
  </script>

  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
</body>
</html>
