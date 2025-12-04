<?php
include("./config/config.php");
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


<header class="retro-header">
  <?php
  include("./component/nav.php");
  ?>

</header>

<body>


  <main>

    <section class="retro-hero-banner">
      <div class="retro-hero-bg"></div>
      <div class="retro-hero-content" data-aos="flip-right">
        <h1>Explore the Best of the 80s & 90s</h1>
        <p>Find your nostalgia. Relive your childhood. Shop iconic products!</p>
        <form class="retro-search">
          <button> Shop Now</button>
        </form>
      </div>
    </section>


    <!-- categories section -->


    <!-- Category Tabs -->
    <section class="category-selector">
      <div class="categories-buttons">
        <button data-category="retro-games">Retro Games</button>
        <button data-category="music-tapes">Music Tapes</button>
        <button data-category="vintage-toys">Vintage Toys</button>
        <button data-category="classic-fashion">Classic Fashion</button>
        <!-- <button data-category="movie-items">Movie Items</button> -->
        <button data-category="old-comics">Old Comics</button>
        <button data-category="home-appliances"> Home Appliances</button>
        <button data-category="neon-jewelry"> Jewelry</button>
        <button data-category="neon-watches"> Watches</button>
      </div>
    </section>

    <section class="category-products-container">


      <div class="category-products" id="retro-games" data-aos="zoom-out">
        <h2 class="category-title">Retro Games</h2>
        <div class="product-grid">
          <?php
          $query = "select * from products where status='active' ORDER BY product_id DESC";
          $result = mysqli_query($connect, $query);
          if (mysqli_num_rows($result) > 0) {
            $rowid = 1;
            while ($row = mysqli_fetch_array($result)) {
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


              if ($productCategory == 'RetroGames') {

                ?>

                <div class="product-card">
                  <?php if (!empty($img) && !empty($img['image_path'])) { ?>
                    <img src="../<?= htmlspecialchars($img['image_path']); ?>" alt="Product Image">
                  <?php } else { ?>
                    <img src="../assets/no-image.jpg" alt="No Image Available">
                  <?php } ?>
                  <h3><?= htmlspecialchars($product_name) ?></h3>
                  <p>₹3,499</p>
                  <button>Buy Now</button>
                  <i class="bi bi-cart3"></i>
                </div>
                <?php
              }
            }
          }

          ?>

        </div>


      </div>


      <!-- 3 -->

      </div>

      <div class="category-products" id="music-tapes" data-aos="zoom-out">
        <h2 class="category-title">Music Tapes</h2>
        <div class="product-grid">
          <div class="product-card">
            <img src="./Asset/image/home/music.png" alt="Walkman Cassette">
            <h3>Walkman Cassette</h3>
            <p>₹2,199</p>
            <button>Add to Cart</button>
          </div>

          <div class="product-card">
            <img src="./Asset/image/home/music.png" alt="Portable Boombox">
            <h3>Portable Boombox</h3>
            <p>₹3,499</p>
            <button>Add to Cart</button>
          </div>

          <div class="product-card">
            <img src="./Asset/image/home/music.png.png" alt="Mini Keyboard Synthesizer">
            <h3>Mini Keyboard Synthesizer</h3>
            <p>₹2,999</p>
            <button>Add to Cart</button>
          </div>
        </div>

        <div class="product-grid">

          <div class="product-card">
            <img src="./Asset/image/home/music.png.png" alt="Electric Guitar">
            <h3>Electric Guitar </h3>
            <p>₹6,499</p>
            <button>Add to Cart</button>
          </div>

          <div class="product-card">
            <img src="./Asset/image/home/music.png.png" alt="Analog Drum Machine">
            <h3>Analog Drum Machine</h3>
            <p>₹4,199</p>
            <button>Add to Cart</button>
          </div>

          <div class="product-card">
            <img src="./Asset/image/home/music.png.png" alt="Vinyl Record Player">
            <h3>Vinyl Record Player</h3>
            <p>₹5,799</p>
            <button>Add to Cart</button>
          </div>
        </div>

        <div class="product-grid">

          <div class="product-card">
            <img src="./Asset/image/home/music.png.png" alt="Cassette Tapes Collection">
            <h3>Cassette Tapes Collection</h3>
            <p>₹899</p>
            <button>Add to Cart</button>
          </div>

          <div class="product-card">
            <img src="./Asset/image/home/music.png" alt="Retro Headphones">
            <h3>Retro Headphones</h3>
            <p>₹1,999</p>
            <button>Add to Cart</button>
          </div>

          <div class="product-card">
            <img src="./Asset/image/home/music.png" alt="Portable Synth">
            <h3>Portable Synth</h3>
            <p>₹3,299</p>
            <button>Add to Cart</button>
          </div>
        </div>
      </div>


      <!-- 4 -->

      <div class="category-products" id="vintage-toys" data-aos="zoom-out">
        <h2 class="category-title">Vintage Toys</h2>

        <div class="product-grid">
          <div class="product-card">
            <img src="./Asset/image/home/music.png" alt="Tetris Game">
            <h3>Tetris Game</h3>
            <p>₹1,299</p>
            <button>Add to Cart</button>
          </div>

          <div class="product-card">
            <img src="./Asset/image/home/music.png.png" alt="Rubik's Cube">
            <h3>Rubik's Cube</h3>
            <p>₹899</p>
            <button>Add to Cart</button>
          </div>

          <div class="product-card">
            <img src="./Asset/image/home/music.png" alt="Tamagotchi">
            <h3>Tamagotchi</h3>
            <p>₹1,499</p>
            <button>Add to Cart</button>
          </div>
        </div>

        <div class="product-grid">
          <div class="product-card">
            <img src="./Asset/image/home/music.png" alt="Hot Wheels Car Set">
            <h3>Hot Wheels Car Set</h3>
            <p>₹1,099</p>
            <button>Add to Cart</button>
          </div>

          <div class="product-card">
            <img src="./Asset/image/home/music.png" alt="Barbie Doll Classic">
            <h3>Barbie Doll Classic</h3>
            <p>₹1,699</p>
            <button>Add to Cart</button>
          </div>

          <div class="product-card">
            <img src="./Asset/image/home/music.png" alt="Beyblade Top">
            <h3>Beyblade Top</h3>
            <p>₹799</p>
            <button>Add to Cart</button>
          </div>
        </div>

        <div class="product-grid">
          <div class="product-card">
            <img src="./Asset/image/home/music.png" alt="LEGO Classic Set">
            <h3>LEGO Classic Set</h3>
            <p>₹2,499</p>
            <button>Add to Cart</button>
          </div>

          <div class="product-card">
            <img src="./Asset/image/home/music.png" alt="Nintendo Game & Watch">
            <h3>Nintendo Game & Watch</h3>
            <p>₹3,299</p>
            <button>Add to Cart</button>
          </div>

          <div class="product-card">
            <img src="./Asset/image/home/music.png" alt="Brick Game Handheld">
            <h3>Brick Game Handheld</h3>
            <p>₹899</p>
            <button>Add to Cart</button>
          </div>
        </div>
      </div>


      <!-- 4 -->

      <div class="category-products" id="classic-fashion" data-aos="zoom-out">
        <h2 class="category-title">Classic Fashion</h2>

        <div class="product-grid">
          <div class="product-card">
            <img src="https://i.ibb.co/Snr4K1X/fashion.png" alt="Neon Jacket">
            <h3>Neon Jacket</h3>
            <p>₹2,499</p>
            <button>Add to Cart</button>
          </div>

          <div class="product-card">
            <img src="https://i.ibb.co/8x0L9Qz/jeans.png" alt="High-Waist Jeans">
            <h3>High-Waist Jeans</h3>
            <p>₹1,799</p>
            <button>Add to Cart</button>
          </div>

          <div class="product-card">
            <img src="https://i.ibb.co/5Rn2qF4/retro-sneakers.png" alt="Retro Sneakers">
            <h3>Retro Sneakers</h3>
            <p>₹3,299</p>
            <button>Add to Cart</button>
          </div>
        </div>

        <div class="product-grid">
          <div class="product-card">
            <img src="https://i.ibb.co/kGz0t0v/cartoon-tshirt.png" alt="Cartoon T-Shirt">
            <h3>Cartoon T-Shirt</h3>
            <p>₹899</p>
            <button>Add to Cart</button>
          </div>

          <div class="product-card">
            <img src="https://i.ibb.co/mh1bH5y/retro-sunglasses.png" alt="Retro Sunglasses">
            <h3>Retro Sunglasses</h3>
            <p>₹599</p>
            <button>Add to Cart</button>
          </div>

          <div class="product-card">
            <img src="https://i.ibb.co/7rN7qfS/vintage-hat.png" alt="Vintage Hat">
            <h3>Vintage Hat</h3>
            <p>₹499</p>
            <button>Add to Cart</button>
          </div>
        </div>

        <div class="product-grid">
          <div class="product-card">
            <img src="https://i.ibb.co/yP6SxXr/retro-belt.png" alt="Retro Belt">
            <h3>Retro Belt</h3>
            <p>₹399</p>
            <button>Add to Cart</button>
          </div>

          <div class="product-card">
            <img src="https://i.ibb.co/3f9vM1N/vintage-scarf.png" alt="Vintage Scarf">
            <h3>Vintage Scarf</h3>
            <p>₹299</p>
            <button>Add to Cart</button>
          </div>

          <div class="product-card">
            <img src="https://i.ibb.co/nRtMJGf/neon-socks.png" alt="Neon Socks">
            <h3>Neon Socks</h3>
            <p>₹199</p>
            <button>Add to Cart</button>
          </div>
        </div>
      </div>

      <div class="category-products" id="old-comics" data-aos="zoom-out">
        <h2 class="category-title">Old Comics</h2>

        <div class="product-grid">
          <div class="product-card">
            <img src="https://i.ibb.co/Dkz59kX/comics.png" alt="Vintage Superhero Comic">
            <h3>Vintage Superhero Comic</h3>
            <p>₹299</p>
            <button>Add to Cart</button>
          </div>

          <div class="product-card">
            <img src="https://i.ibb.co/2yNvRQC/classic-manga.png" alt="Classic Manga">
            <h3>Classic Manga</h3>
            <p>₹399</p>
            <button>Add to Cart</button>
          </div>

          <div class="product-card">
            <img src="https://i.ibb.co/Ks1wXY5/old-action-comics.png" alt="Old Action Comics">
            <h3>Old Action Comics</h3>
            <p>₹499</p>
            <button>Add to Cart</button>
          </div>
        </div>

        <div class="product-grid">
          <div class="product-card">
            <img src="https://i.ibb.co/YdCmxrJ/retro-comic-book.png" alt="Retro Comic Book Set">
            <h3>Retro Comic Book Set</h3>
            <p>₹699</p>
            <button>Add to Cart</button>
          </div>

          <div class="product-card">
            <img src="https://i.ibb.co/Z1w1H7s/super-villain-comics.png" alt="Super Villain Comics">
            <h3>Super Villain Comics</h3>
            <p>₹349</p>
            <button>Add to Cart</button>
          </div>

          <div class="product-card">
            <img src="https://i.ibb.co/0Gn9rmM/old-hero-comics.png" alt="Old Hero Comics">
            <h3>Old Hero Comics</h3>
            <p>₹399</p>
            <button>Add to Cart</button>
          </div>
        </div>

        <div class="product-grid">
          <div class="product-card">
            <img src="https://i.ibb.co/8m3q3zD/vintage-cartoon.png" alt="Vintage Cartoon Comics">
            <h3>Vintage Cartoon Comics</h3>
            <p>₹299</p>
            <button>Add to Cart</button>
          </div>

          <div class="product-card">
            <img src="https://i.ibb.co/Z2bW7sj/rare-comics.png" alt="Rare Comics Edition">
            <h3>Rare Comics Edition</h3>
            <p>₹899</p>
            <button>Add to Cart</button>
          </div>

          <div class="product-card">
            <img src="https://i.ibb.co/F4Z9vwr/classic-adventure-comics.png" alt="Classic Adventure Comics">
            <h3>Classic Adventure Comics</h3>
            <p>₹499</p>
            <button>Add to Cart</button>
          </div>
        </div>
      </div>

      <!-- 7 -->

      <div class="category-products" id="home-appliances" data-aos="zoom-out">
        <h2 class="category-title">Home Appliances</h2>

        <div class="product-grid">
          <div class="product-card">
            <img src="https://i.ibb.co/1X6fQY7/retro-toaster.png" alt="Retro Toaster">
            <h3>Retro Toaster</h3>
            <p>₹1,999</p>
            <button>Add to Cart</button>
          </div>

          <div class="product-card">
            <img src="https://i.ibb.co/2dK1xZk/retro-blender.png" alt="Retro Blender">
            <h3>Retro Blender</h3>
            <p>₹2,299</p>
            <button>Add to Cart</button>
          </div>

          <div class="product-card">
            <img src="https://i.ibb.co/3gVmj8R/retro-fan.png" alt="Vintage Table Fan">
            <h3>Vintage Table Fan</h3>
            <p>₹1,499</p>
            <button>Add to Cart</button>
          </div>
        </div>

        <div class="product-grid">
          <div class="product-card">
            <img src="https://i.ibb.co/4X9pL9k/retro-radio.png" alt="Retro Radio">
            <h3>Retro Radio</h3>
            <p>₹1,799</p>
            <button>Add to Cart</button>
          </div>

          <div class="product-card">
            <img src="https://i.ibb.co/5ZxYFhS/retro-coffee-maker.png" alt="Retro Coffee Maker">
            <h3>Retro Coffee Maker</h3>
            <p>₹3,199</p>
            <button>Add to Cart</button>
          </div>

          <div class="product-card">
            <img src="https://i.ibb.co/6cN5H9T/retro-ironing.png" alt="Retro Iron">
            <h3>Retro Iron</h3>
            <p>₹1,699</p>
            <button>Add to Cart</button>
          </div>
        </div>

        <div class="product-grid">
          <div class="product-card">
            <img src="https://i.ibb.co/7ZtJXcV/retro-mixer.png" alt="Retro Mixer">
            <h3>Retro Mixer</h3>
            <p>₹2,499</p>
            <button>Add to Cart</button>
          </div>

          <div class="product-card">
            <img src="https://i.ibb.co/8j9RvXH/retro-toaster-oven.png" alt="Retro Toaster Oven">
            <h3>Retro Toaster Oven</h3>
            <p>₹2,799</p>
            <button>Add to Cart</button>
          </div>

          <div class="product-card">
            <img src="https://i.ibb.co/9c7Hx5P/retro-electric-kettle.png" alt="Retro Electric Kettle">
            <h3>Retro Electric Kettle</h3>
            <p>₹1,899</p>
            <button>Add to Cart</button>
          </div>
        </div>
      </div>


      <div class="category-products" id="neon-jewelry" data-aos="zoom-out">
        <h2 class="category-title">Neon Jewelry</h2>

        <div class="product-grid">
          <div class="product-card">
            <img src="https://i.ibb.co/7S2gVpQ/jewelry.png" alt="Neon Hoop Earrings">
            <h3>Neon Hoop Earrings</h3>
            <p>₹599</p>
            <button>Add to Cart</button>
          </div>

          <div class="product-card">
            <img src="https://i.ibb.co/6tY4F16/headphones.png" alt="Glow-in-the-Dark Necklace">
            <h3>Glow-in-the-Dark Necklace</h3>
            <p>₹749</p>
            <button>Add to Cart</button>
          </div>

          <div class="product-card">
            <img src="https://i.ibb.co/XYjJHLW/toys.png" alt="Retro Bracelet Set">
            <h3>Retro Bracelet Set</h3>
            <p>₹499</p>
            <button>Add to Cart</button>
          </div>
        </div>

        <div class="product-grid">
          <div class="product-card">
            <img src="https://i.ibb.co/wCjymts/cassette.png" alt="Neon Ring Collection">
            <h3>Neon Ring Collection</h3>
            <p>₹699</p>
            <button>Add to Cart</button>
          </div>

          <div class="product-card">
            <img src="https://i.ibb.co/hyvmrZd/games.png" alt="Retro Charm Necklace">
            <h3>Retro Charm Necklace</h3>
            <p>₹649</p>
            <button>Add to Cart</button>
          </div>

          <div class="product-card">
            <img src="https://i.ibb.co/XYV5M4H/electric-guitar.png" alt="Glow Bangles Set">
            <h3>Glow Bangles Set</h3>
            <p>₹799</p>
            <button>Add to Cart</button>
          </div>
        </div>

        <div class="product-grid">
          <div class="product-card">
            <img src="https://i.ibb.co/pQdXwN8/posters.png" alt="Neon Pendant">
            <h3>Neon Pendant</h3>
            <p>₹599</p>
            <button>Add to Cart</button>
          </div>

          <div class="product-card">
            <img src="https://i.ibb.co/Dkz59kX/comics.png" alt="Retro Anklet">
            <h3>Retro Anklet</h3>
            <p>₹499</p>
            <button>Add to Cart</button>
          </div>

          <div class="product-card">
            <img src="https://i.ibb.co/BqHSkTg/movies.png" alt="Neon Statement Ring">
            <h3>Neon Statement Ring</h3>
            <p>₹849</p>
            <button>Add to Cart</button>
          </div>
        </div>
      </div>


      <div class="category-products" id="neon-watches" data-aos="zoom-out">
        <h2 class="category-title">Neon Watches</h2>

        <div class="product-grid">
          <div class="product-card">
            <img src="https://i.ibb.co/cN6fr6h/watches.png" alt="Neon Digital Watch">
            <h3>Neon Digital Watch</h3>
            <p>₹1,299</p>
            <button>Add to Cart</button>
          </div>

          <div class="product-card">
            <img src="https://i.ibb.co/XYjJHLW/toys.png" alt="Glow Analog Watch">
            <h3>Glow Analog Watch</h3>
            <p>₹1,499</p>
            <button>Add to Cart</button>
          </div>

          <div class="product-card">
            <img src="https://i.ibb.co/7k9gCW7/boombox.png" alt="Retro LED Watch">
            <h3>Retro LED Watch</h3>
            <p>₹1,599</p>
            <button>Add to Cart</button>
          </div>
        </div>

        <div class="product-grid">
          <div class="product-card">
            <img src="https://i.ibb.co/hyvmrZd/games.png" alt="Neon Sport Watch">
            <h3>Neon Sport Watch</h3>
            <p>₹1,699</p>
            <button>Add to Cart</button>
          </div>

          <div class="product-card">
            <img src="https://i.ibb.co/wCjymts/cassette.png" alt="Glow Chronograph Watch">
            <h3>Glow Chronograph Watch</h3>
            <p>₹1,899</p>
            <button>Add to Cart</button>
          </div>

          <div class="product-card">
            <img src="https://i.ibb.co/XYV5M4H/electric-guitar.png" alt="Retro Slim Watch">
            <h3>Retro Slim Watch</h3>
            <p>₹1,499</p>
            <button>Add to Cart</button>
          </div>
        </div>

        <div class="product-grid">
          <div class="product-card">
            <img src="https://i.ibb.co/Dkz59kX/comics.png" alt="Neon Square Watch">
            <h3>Neon Square Watch</h3>
            <p>₹1,599</p>
            <button>Add to Cart</button>
          </div>

          <div class="product-card">
            <img src="https://i.ibb.co/BqHSkTg/movies.png" alt="Retro LED Sport Watch">
            <h3>Retro LED Sport Watch</h3>
            <p>₹1,799</p>
            <button>Add to Cart</button>
          </div>

          <div class="product-card">
            <img src="https://i.ibb.co/6tY4F16/headphones.png" alt="Glow Round Watch">
            <h3>Glow Round Watch</h3>
            <p>₹1,699</p>
            <button>Add to Cart</button>
          </div>
        </div>
      </div>



      <section class="featured-category" data-aos="fade-down" data-aos-easing="linear" data-aos-duration="1500">

        <div class="banner-image">
          <img src="./Asset/image/home/games.png" alt="Retro Games Banner">
        </div>

        <div class="banner-content">
          <h2>Explore Retro Games</h2>
          <p>Discover classic gaming consoles and nostalgic games from the 80s & 90s.</p>
          <button onclick="location.href='./categories.php'">Shop Now</button>
        </div>

      </section>


  </main>
  <?php
  include("./component/footer.php");
  ?>



  <script>
    const buttons = document.querySelectorAll(".categories-buttons button");
    const categories = document.querySelectorAll(".category-products");

    buttons.forEach(btn => {
      btn.addEventListener("click", () => {
        buttons.forEach(b => b.classList.remove("active"));
        btn.classList.add("active");
        const target = btn.getAttribute("data-category");
        categories.forEach(cat => cat.style.display = "none");
        document.getElementById(target).style.display = "block";
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



</body>

</html>