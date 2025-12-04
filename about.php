<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us | RetroCart</title>
  <link rel="stylesheet" href="./style/style.css">
  <link rel="stylesheet" href="./style/about.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

</head>

<style>
  :root {
    --gold: #ffd700;

    --white: #f5f5f5;
  }

  .abt {
    font-family: "Pacifico", cursive;
    margin: 0;
    background: var(--black);
    color: var(--white);
    overflow-x: hidden;
  }

  /* Hero Section */
  .hero {
    position: relative;
    width: 100%;
    height: 80vh;
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    overflow: hidden;
    background-image: url(./Asset/image/product/ban_about.jpg);
    background-size: cover;
    background-position: center;
  }

  .hero::before {
    content: "";
    position: absolute;
    inset: 0;
    background: linear-gradient(to bottom right, rgba(0, 0, 0, 0.6), rgba(255, 215, 0, 0.2));
    backdrop-filter: blur(3px);
    z-index: 0;
  }

  .hero::after {
    content: "";
    position: absolute;
    inset: 0;
    background-image: linear-gradient(rgba(255, 255, 255, 0.1) 1px, transparent 1px),
      linear-gradient(90deg, rgba(255, 255, 255, 0.1) 1px, transparent 1px);
    background-size: 50px 50px;
    animation: gridMove 10s linear infinite;
    z-index: 0;
    opacity: 0.3;
  }

  .hero h1,
  .hero p {
    position: relative;
    z-index: 1;
  }

  .hero h1 {
    font-size: 3rem;
    color: black;
    margin: 0;
  }

  .hero p {
    font-size: 1.2rem;
    color: black;
    margin-top: 10px;
  }

  /* About Sections */
  .about-section {
    display: flex;
    align-items: center;
    justify-content: space-between;
    max-width: 1100px;
    margin: 80px auto;
    gap: 50px;
    padding: 0 20px;
  }

  .about-section.reverse {
    flex-direction: row-reverse;
  }

  .about-img img {
    width: 100%;
    height: 300px;
    border-radius: 15px;
    border: 2px solid var(--gold);
    box-shadow: 0 0 20px var(--gold);
  }

  .about-text {
    flex: 1;
  }

  .about-text h2 {
    color: var(--gold);
    font-size: 2rem;
    margin-bottom: 15px;
  }

  .about-text p {
    font-size: 1.1rem;
    line-height: 1.7;
  }

  /* Community */
  .community {
    text-align: center;
    margin: 80px auto;
    max-width: 800px;
    padding: 40px;
    border: 2px solid var(--gold);
    border-radius: 20px;
    background: var(--card);
    box-shadow: 0 0 20px var(--gold);
  }

  .community h2 {
    color: var(--gold);
    font-size: 2rem;
  }

  .community p {
    font-size: 1.1rem;
    line-height: 1.6;
  }

  /* Footer */
  footer {
    text-align: center;
    padding: 20px;
    background: var(--card);
    color: var(--gold);
    border-top: 2px solid var(--gold);
  }

  /* Animation */
  [data-animate] {
    opacity: 0;
    transform: translateY(60px);
    transition: all 0.8s ease;
  }

  [data-animate].visible {
    opacity: 1;
    transform: translateY(0);
  }

  @media (max-width: 900px) {
    .about-section {
      flex-direction: column;
      text-align: center;
    }

    .about-img img {
      width: 90%;
    }
  }
</style>

<header class="retro-header">
  <?php
  include("./component/nav.php");
  ?>

</header>

<body>
  <div class="abt">

    <section class="hero">
      <div class="overlay">
        <h1>About RetroCart</h1>
        <p>Your Gateway to the 80s & 90s</p>
      </div>
    </section>

    <section class="about-section">
      <div class="about-img" data-animate>
        <img src="./Asset/image/product/story.jpg" alt="RetroCart Store">
      </div>
      <div class="about-text" data-animate>
        <h2>Our Story</h2>
        <p>
          RetroCart was born from the love of everything vintage.
          We celebrate the golden era of the 80s and 90s — when music, movies, and gadgets had soul.
          Our mission is to bring those memories back to life through authentic retro products.
        </p>
      </div>
    </section>

    <section class="about-section ">
      <div class="about-text" data-animate>
        <h2>Our Mission</h2>
        <p>
          We aim to connect generations through nostalgia.
          Whether you’re rediscovering your childhood or exploring the magic of the past,
          RetroCart is your one-stop destination for all things vintage.
        </p>
      </div>
      <div class="about-img" data-animate>
        <img src="./Asset/image/product/mission._one.jpg" alt="Vintage Products">
      </div>
    </section>

    <section class="community" data-animate>
      <h2>Join Our Community</h2>
      <p>
        Share your favorite 90s moments, collectibles, and stories with the world.
        Tag us with <strong>#RetroCartMemories</strong> and keep the nostalgia alive!
      </p>
    </section>
  </div>

  <?php
  include("./component/footer.php");
  ?>

  <script>
    // Fade & Slide Animation on Scroll
    const elements = document.querySelectorAll("[data-animate]");

    function revealOnScroll() {
      elements.forEach(el => {
        const rect = el.getBoundingClientRect();
        if (rect.top < window.innerHeight - 100) {
          el.classList.add("visible");
        }
      });
    }

    window.addEventListener("scroll", revealOnScroll);
    window.addEventListener("load", revealOnScroll);

  </script>
</body>

</html>