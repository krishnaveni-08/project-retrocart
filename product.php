<?php
session_start();
include("./config/config.php");
$isloggedin = isset($_SESSION["customer_id"]) || isset($_SESSION["merchant_id"]);
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>product</title>
  <link rel="stylesheet" href="./style/style.css">
  <link rel="stylesheet" href="./style/product.css">
  <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

</head>

<header class="retro-header">
  <?php
  include("./component/nav.php");
  ?>

</header>

<body>
  <main>

    <div class="container">
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

      <div class="grid">
        <div>
          <div class="media-card" data-aos="fade-right">
            <div class="main-image" id="mainImageWrap">
              <?php if (!empty($img) && !empty($img['image_path'])) { ?>
                <img src="./<?= htmlspecialchars($img['image_path']); ?>" alt="Product Image">
              <?php } else { ?>
                <img src="../assets/no-image.jpg" alt="No Image Available">
              <?php } ?>
            </div>

          </div>

        </div>


        <aside class="meta" data-aos="fade-left">
          <div class="tag">Music • Retro • 80s</div>
          <h1><?= htmlspecialchars($name); ?></h1>
          <div class="desc">
            <strong>About this boombox:</strong>
            <p><?= htmlspecialchars($description); ?></p>
          </div>

          <div style="margin-top:8px; font-size:13px; color:black"> Color</div>
          <div class="color">
            <p><?= htmlspecialchars($color); ?></p>
          </div>
          <div class="price">₹ <?= htmlspecialchars($price); ?></div>
          <div style="margin-top:8px; font-size:13px; color:black"> Brand:</div>
          <div class="brand"><?= htmlspecialchars($brand); ?></div>

          <div style="margin-top:8px; font-size:13px; color:black"> Condition:</div>
          <div class="condition"><?= htmlspecialchars($condition); ?></div>
          <div class="add">
            <a href="./cart.php?product_id=<?= $product_id ?>"><button class="btnn" id="addCartBtn">Buy Now</button></a>
          </div>
        </aside>
      </div>




    </div>

    <!-- Rating & Reviews -->

    <div class="review-section" data-aos="zoom-in-down">
      <div class="con">

        <div class="rating-summary">
          <div class="rating-number">4.5</div>
          <div class="rating-text">(50 Reviews)</div>
        </div>

        <div class="rating-details">
          <h3>Customer Reviews</h3>
          <div class="rating-bar">
            <span>5 ★</span>
            <div class="bar"><span style="width: 72%"></span></div>
            <span>72%</span>
          </div>
          <div class="rating-bar">
            <span>4 ★</span>
            <div class="bar"><span style="width: 14%"></span></div>
            <span>14%</span>
          </div>
          <div class="rating-bar">
            <span>3 ★</span>
            <div class="bar"><span style="width: 8%"></span></div>
            <span>8%</span>
          </div>
          <div class="rating-bar">
            <span>2 ★</span>
            <div class="bar"><span style="width: 4%"></span></div>
            <span>4%</span>
          </div>
          <div class="rating-bar">
            <span>1 ★</span>
            <div class="bar"><span style="width: 2%"></span></div>
            <span>2%</span>
          </div>
        </div>
      </div>
    </div>

    </div>


    <?php
    $recentQuery = "SELECT * FROM products 
                WHERE status='active' AND product_id != $product_id
                ORDER BY product_id DESC 
                LIMIT 4";
    $recentResult = mysqli_query($connect, $recentQuery);
    ?>

    <div class="related-title">New Arrivals</div>
    <div class="related-grid">
      <?php
      if ($recentResult && mysqli_num_rows($recentResult) > 0) {
        while ($row = mysqli_fetch_assoc($recentResult)) {
          $relProdId = $row['product_id'];
          $relName = $row['name'];
          $relPrice = $row['price'];

          // image fetch
          $imgQuery = "SELECT image_path FROM product_image WHERE product_id='$relProdId' LIMIT 1";
          $imgResult = mysqli_query($connect, $imgQuery);
          $img = ($imgResult && mysqli_num_rows($imgResult) > 0)
            ? mysqli_fetch_assoc($imgResult)['image_path']
            : "Asset/image/no-image.jpg";
          ?>
          <div class="related-card" data-aos="flip-down">
            <a href="./product.php?product_id=<?= $relProdId ?>">
              <img src="./<?= htmlspecialchars($img) ?>" alt="<?= htmlspecialchars($relName) ?>">
            </a>
            <div style="margin-top:20px;font-weight:600"><?= htmlspecialchars($relName) ?></div>
            <div style="color:var(--muted);font-size:13px;margin-top:10px">₹<?= htmlspecialchars($relPrice) ?></div>

            <!-- Buy Now Button -->
            <div style="margin-top:10px;">
              <a href="./cart.php?product_id=<?= $relProdId ?>">
                <button class="btnn">Buy Now</button>
              </a>
            </div>
          </div>
          <?php
        }
      } else {
        echo "<p style='text-align:center;'>No recent products available.</p>";
      }
      ?>
    </div>

    </div>


  </main>

  <?php
  include("./component/footer.php");
  ?>
  <script>
    (function () {
      const thumbs = document.querySelectorAll('.thumb');
      const mainImage = document.getElementById('mainImage');
      thumbs.forEach(t => {
        t.addEventListener('click', () => {
          thumbs.forEach(x => x.classList.remove('active'));
          t.classList.add('active');
          const src = t.getAttribute('data-src');
          mainImage.src = src;
        });
      });

      function hookupOption(containerId) {
        const wrap = document.getElementById(containerId);
        if (!wrap) return;
        wrap.addEventListener('click', e => {
          const btn = e.target.closest('.option-btn');
          if (!btn) return;
          // deactivate siblings
          Array.from(wrap.querySelectorAll('.option-btn')).forEach(b => b.classList.remove('active'));
          btn.classList.add('active');
        });
      }
      hookupOption('colorOptions');
      hookupOption('editionOptions');
      hookupOption('sizeOptions');

      // quantity
      const qtyElem = document.getElementById('qty');
      let qty = 1;
      document.getElementById('qtyPlus').addEventListener('click', () => {
        qty = Math.min(9, qty + 1);
        qtyElem.textContent = qty;
      });
      document.getElementById('qtyMinus').addEventListener('click', () => {
        qty = Math.max(1, qty - 1);
        qtyElem.textContent = qty;
      });

      // add to cart
      document.getElementById('addCartBtn').addEventListener('click', () => {
        const color = document.querySelector('#colorOptions .option-btn.active').dataset.val;
        const edition = document.querySelector('#editionOptions .option-btn.active').dataset.val;
        const size = document.querySelector('#sizeOptions .option-btn.active').dataset.val;
        alert(`Added to cart:\\nVintage Boombox — ${edition} (${color})\\nSize: ${size}\\nQuantity: ${qty}`);
      });

      // small countdown example (static seconds)
      (function countdown() {
        const el = document.getElementById('countdown');
        let seconds = 2 * 60 * 60 + 30 * 60 + 5; // 2:30:05
        setInterval(() => {
          if (seconds > 0) seconds--;
          const h = String(Math.floor(seconds / 3600)).padStart(2, '0');
          const m = String(Math.floor((seconds % 3600) / 60)).padStart(2, '0');
          const s = String(seconds % 60).padStart(2, '0');
          el.textContent = `${h}:${m}:${s}`;
        }, 1000);
      })();
    })();
  </script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
</body>

</html>