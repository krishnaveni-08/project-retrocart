 <section class="categories-dynamic">
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

    .categories-dynamic {
  width: 100%;
  position: relative;
  background-image: url(../Asset/image/back.png);
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  padding: 60px ;
  color: #fff;
  overflow: hidden;
  z-index: 1;
}

.retro-categories-dynamic::before {
  content: "";
  position: absolute;
  inset: 0;
  background: rgba(0, 0, 0, 0.422);
}

/* make sure content stays above overlay */
.retro-categories-dynamic * {
  position: relative;
  z-index: 1;
}



.section-title {
  text-align: center;
  font-size: 2.8rem;
  color: #ffcc00;
  margin-bottom: 20px;
  /* text-shadow: 0 0 10px #ffdd57; */
}

.categories-wrapper {
  height: 90%;
  display: flex;
  gap: 20px;
  overflow-x: auto;
  scroll-behavior: smooth;
  /* padding-bottom: 30px;  */
  /* padding-bottom: 10px; */
}

.category-box {
  flex: 0 0 150px;
  background: rgba(0, 0, 0, 0.6);
  border-radius: 16px;
  padding: 20px;
  text-align: center;
  border: 2px solid transparent;
  box-shadow: 0 0 10px rgba(255, 255, 255, 0.05);
  cursor: pointer;
  transition: all 0.3s ease;
  border: 2px solid #ffd700;

}

.category-box img:hover {
  margin-top: -10px;
  /* same visual lift */
  transform: scale(1.05);
  /* smaller scale to reduce jump */
  border-color: #ffcc00;
  box-shadow: 0 0 20px #ffcc00;
}

.category-box img {
  width: 100px;
  height: 100px;
  object-fit: contain;
  margin-bottom: 10px;
}

.category-box span {
  display: block;
  font-size: 1.1rem;
  font-weight: 600;
  color: #f8f8f8;
}

.categories-wrapper::-webkit-scrollbar {
  display: none;
}

/* Responsive */
@media (max-width: 768px) {
  .category-box {
    flex: 0 0 120px;
    padding: 15px;
  }

  .section-title {
    font-size: 2rem;
  }
}
<nav>
  <div class="retroo">
    <div class="logo">
      <a href="#">
        <h2>Retro<span>Cart</span></h2>
      </a>
    </div>


    <ul class="nav-links" id="navLinks">
      <li><a href="index.php" class="<?php echo ($pagename == "index.php" ? "active" : "") ?>">Home</a></li>
      <li><a href="categories.php" class="<?php echo ($pagename == "categories.php" ? "active" : "") ?>">Categories</a>
      </li>
      <li><a href="categories.php" class="<?php echo ($pagename == "product.php" ? "active" : "") ?>">Product
          details</a></li>

      <li><a href="./cart.php" class="<?php echo ($pagename == "cart.php" ? "active" : "") ?>">Cart</a></li>
      <li><a href="./checkout.php" class="<?php echo ($pagename == "checkout.php" ? "active" : "") ?>">Checkout</a>
      </li>
    </ul>

    <div class="header-icons">
      <a href="cart.php" class="icon-btn">
        <i class="bi bi-cart3"></i>
      </a>
      <a href="profile.php" class="icon-btn">
        <i class="bi bi-person-circle"></i>
      </a>
    </div>
  </div>
</nav>