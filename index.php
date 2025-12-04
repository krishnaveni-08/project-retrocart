<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="./style/style.css">
    <link rel="stylesheet" href="./style/home.css">
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

        <section class="hero-section">

            <!-- <section class="retro-categoriess">
                <ul class="retro-cat-menu">
                    <li class="retro-cat-item">
                        <a href="#">Retro Games</a>
                        <div class="retro-cat-dropdown">
                            <a href="#">Gameboy Classic</a>
                            <a href="#">Tetris Game</a>
                            <a href="#">Classic LEGO Set</a>
                            <a href="#">Barbie Doll</a>
                        </div>
                    </li>

                    <li class="retro-cat-item">
                        <a href="#">Music Tapes</a>
                        <div class="retro-cat-dropdown">
                            <a href="#">Walkman Cassette</a>
                            <a href="#">Portable Boombox</a>
                            <a href="#">Mini Keyboard</a>
                            <a href="#">Electric Guitar</a>
                        </div>
                    </li>

                    <li class="retro-cat-item">
                        <a href="#">Vintage Toys</a>
                        <div class="retro-cat-dropdown">
                            <a href="#">Rubik’s Cube</a>
                            <a href="#">Tamagotchi</a>
                            <a href="#">Hot Wheels & Barbie</a>
                            <a href="#">Beyblades & Pokémon Cards</a>
                        </div>
                    </li>

                    <li class="retro-cat-item">
                        <a href="#">Fashion</a>
                        <div class="retro-cat-dropdown">
                            <a href="#">Neon Jackets</a>
                            <a href="#">High-Waist Jeans</a>
                            <a href="#">Retro Sneakers</a>
                            <a href="#">Cartoon T-Shirts</a>
                        </div>
                    </li>

                    <li class="retro-cat-item">
                        <a href="#">Old Comics</a>
                       <div class="retro-cat-dropdown">
                            <a href="#">Vintage Superhero Comic</a>
                            <a href="#">Classic Manga</a>
                            <a href="#">Old Action Comics</a>
                            <a href="#">Retro Comic Book Set</a>
                        </div>
                    </li>

                    <li class="retro-cat-item">
                        <a href="#">Home Appliances</a>
                        <div class="retro-cat-dropdown">
                            <a href="#">Retro Toaster</a>
                            <a href="#">Retro Blender</a>
                            <a href="#">Vintage Table Fan</a>
                            <a href="#">Retro Radio</a>
                        </div>

                    </li>

                    <li class="retro-cat-item">
                        <a href="#">Jewelry</a>
                        <div class="retro-cat-dropdown">
                            <a href="#">Neon Hoop Earrings</a>
                            <a href="#">Retro Bracelet Set</a>
                            <a href="#">Vintage Table Fan</a>
                            <a href="#">Retro Radio</a>
                        </div>
                    </li>

                    <li class="retro-cat-item">
                        <a href="#">Watches</a>
                        <div class="retro-cat-dropdown">
                            <a href="#">Neon Watches</a>
                            <a href="#">Retro Sunglasses</a>
                            <a href="#">Bags & Wallets</a>
                            <a href="#">Jewelry</a>
                        </div>
                    </li>
                </ul>

            </section> -->

            <div class="hero-content">
                <h1>Relive Your Childhood</h1>
                <p>Bringing Back the 80s & 90s — One Product at a Time!</p>
                <a href="./categories.php" class="hero-btn"> Shop Now</a>
            </div>

        </section>

        <section class="retro-categories-dynamic">
            <h2 class="section-title">Explore 80s & 90s Vibes</h2>
            <div class="categories-wrapper">
                <div class="category-box">
                    <img src="./Asset/image/home/games.png" alt="Games">
                    <span>Retro Games</span>
                </div>
                <div class="category-box">
                    <img src="./Asset/image/home/music.png" alt="Music Tapes">
                    <span>Music Tapes</span>
                </div>
                <div class="category-box">
                    <img src="./Asset/image/home/games.png" alt="Toys">
                    <span>Vintage Toys</span>
                </div>
                <div class="category-box">
                    <img src="./Asset/image/home/fashion.png" alt="Fashion">
                    <span>Classic Fashion</span>
                </div>

                <!-- <div class="category-box">
                <img src="https://i.ibb.co/BqHSkTg/movies.png" alt="Movies">
                <span>Movie Items</span>
                </div> -->

                <div class="category-box">
                    <img src="./Asset/image/home/comic.png" alt="Comics">
                    <span>Old Comics</span>
                </div>
                <div class="category-box">
                    <img src="./Asset/image/home/comic.png" alt="Headphones">
                    <span> Headphones</span>
                </div>
                <div class="category-box">
                    <img src="./Asset/image/home/poster.png" alt="Posters">
                    <span>Retro Posters</span>
                </div>
                <div class="category-box">
                    <img src="./Asset/image/home/jel.png" alt="Jewelry">
                    <span>Jewelry</span>
                </div>
                <div class="category-box">
                    <img src="https://i.ibb.co/cN6fr6h/watches.png" alt="Watches">
                    <span>Watches</span>
                </div>
            </div>
        </section>

        <section class="recent-retro-products-dynamic" style="background: black; padding: 20px 0;">
            <h2 class="section-title">Recently Added Products</h2>
            <div class="retro-product-grid" >
                <?php
                include("./config/config.php");

                // 🔥 Get latest added active products (and active merchants)
                $query = "SELECT p.* 
                  FROM products p
                  JOIN merchant_details m ON p.merchant_id = m.id
                  WHERE p.status='active'
                    AND m.status='active'
                  ORDER BY p.created_at DESC
                  LIMIT 4"; // 4 latest products
                
                $result = mysqli_query($connect, $query);

                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $product_id = $row['product_id'];
                        $name = $row['name'];
                        $price = $row['price'];

                        // 🖼️ Get product image
                        $imgQuery = "SELECT * FROM product_image WHERE product_id = '$product_id' LIMIT 1";
                        $imgResult = mysqli_query($connect, $imgQuery);
                        $img = ($imgResult && mysqli_num_rows($imgResult) > 0)
                            ? mysqli_fetch_assoc($imgResult)['image_path']
                            : "Asset/image/no-image.jpg";
                        ?>
                        <div class="retro-product-card" data-aos="fade-up"  style="background: grey; margin-bottom: 20px;">
                            <div class="card-img">
                                <img src="./<?= htmlspecialchars($img); ?>" alt="<?= htmlspecialchars($name); ?>">
                            </div>
                            <div class="card-info">
                                <h3><?= htmlspecialchars($name); ?></h3>
                                <p>₹<?= htmlspecialchars($price); ?></p>
                                <div class="stars">⭐⭐⭐⭐⭐</div>

                                <?php
                                $loggedin = isset($_SESSION['customer_id']) || isset($_SESSION['merchant_id']);
                                ?>
                                <a href="<?= $loggedin ? "./product.php?product_id=$product_id" : "javascript:void(0)" ?>"
                                    onclick="<?php if (!$loggedin) {
                                        echo "alert('Login required!'); window.location.href='login.php';";
                                    } ?>">
                                    <button>Buy Now</button>
                                </a>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "<p style='color:white;text-align:center;'>No recent products available right now.</p>";
                }
                ?>
            </div>
        </section>



        <section class="timeline-section">
            <h2 class="timeline-title">Walk Down Memory Lane</h2>
            <div class="timeline">
                <div class="timeline-item left" data-aos="flip-down">
                    <div class="content">
                        <h3>idhanya</h3>
                        <p>Remember refilling it and leaking ink in school uniforms?</p>
                        <span class="year">1985</span>
                    </div>
                </div>
                <div class="timeline-item right" data-aos="flip-down">
                    <div class="content">
                        <h3>Doordarshan TV Shows</h3>
                        <p>Sunday morning Ramayan & Mahabharat with whole family together.</p>
                        <span class="year">1990</span>
                    </div>
                </div>
                <div class="timeline-item left" data-aos="flip-down">
                    <div class="content">
                        <h3>Video Game Cassette</h3>
                        <p>8-bit Mario & Contra on grey box. Pure fun!</p>
                        <span class="year">1995</span>
                    </div>
                </div>
                <div class="timeline-item right" data-aos="flip-down">
                    <div class="content">
                        <h3>Scooby Snacks</h3>
                        <p>That purple chewing gum everyone loved.</p>
                        <span class="year">1998</span>
                    </div>
                </div>
            </div>
        </section>

        <section class="why-retrocart">
            <h2 class="why-title">Why <span>RetroCart?</span></h2>
            <div class="why-cards-container">
                <div class="why-card" data-aos="zoom-in">
                    <div class="card-inner">
                        <div class="card-front">
                            <h3>Curated Classics</h3>
                        </div>
                        <div class="card-back">
                            <p>We handpick vintage items from the 80s and 90s — original, verified & full of memories!
                            </p>
                        </div>
                    </div>
                </div>

                <div class="why-card" data-aos="zoom-in">
                    <div class="card-inner">
                        <div class="card-front">
                            <h3>Nostalgia Packaging</h3>
                        </div>
                        <div class="card-back">
                            <p>Unboxing is a moment! Our packing gives you the old-school feel with a modern twist.</p>
                        </div>
                    </div>
                </div>

                <div class="why-card" data-aos="zoom-in">
                    <div class="card-inner">
                        <div class="card-front">
                            <h3>Community Vibes</h3>
                        </div>
                        <div class="card-back">
                            <p>Join other 90s kids! Share memories, post photos, and explore stories from the past.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="customer-memories">
            <h2>Customer Memories</h2>

            <div class="memory-card" data-aos="zoom-out">
                <img src="./Asset/image/home/avatar_one.jpg" alt="Customer" class="customer-img">
                <div class="memory-text">
                    <h3>Ravi Kumar</h3>
                    <p>“When I saw the vintage Walkman here, I was instantly taken back to my school days. Thank you
                        RetroCart!”
                    </p>
                </div>
            </div>

            <div class="memory-card" data-aos="zoom-out">
                <img src="./Asset/image/home/avatar_two.jpg" alt="Customer" class="customer-img">
                <div class="memory-text">
                    <h3>Swathi Raj</h3>
                    <p>“I gifted a retro handheld game to my son and told him how we played it nonstop back in the 90s.
                        So much
                        joy!”</p>
                </div>
            </div>

            <div class="memory-card" data-aos="zoom-out">
                <img src="./Asset/image/home/avatar_three.jpg" alt="Customer" class="customer-img">
                <div class="memory-text">
                    <h3>Arun D</h3>
                    <p>“That cassette player took me back to my college hostel days. The nostalgia is real!”</p>
                </div>
            </div>
        </section>

        <section class="newsletter-signup">
            <div class="newsletter-box">
                <h2>Stay in the Loop!</h2>
                <p>Join our RetroCart newsletter and relive the golden days with exclusive deals & stories.</p>
                <form action="./subscribe.php" method="POST">
                    <input type="email" name="email" placeholder="Enter your email" required />
                    <button type="submit" name="subscribe">Subscribe</button>
                </form>
            </div>
        </section>

    </main>

    <script>
        let slides = document.querySelectorAll('.slide');
        let index = 0;

        function showSlide(i) {
            slides.forEach((slide, idx) => {
                slide.classList.remove('active');
                if (idx === i) {
                    slide.classList.add('active');
                }
            });
        }

        function nextSlide() {
            index = (index + 1) % slides.length;
            showSlide(index);
        }

        setInterval(nextSlide, 4000); // every 4s

    </script>
    <script src="https://kit.fontawesome.com/yourkitid.js" crossorigin="anonymous"></script>
    <script src="./script/home.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

    <?php
    include("./component/footer.php");
    ?>


</body>


</html>