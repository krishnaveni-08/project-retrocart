<?php
include_once(__DIR__ . '/../config/config.php');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");


$pagename = basename($_SERVER['PHP_SELF']);
?>


<style>
    .profile-menu {
        position: relative;
        display: inline-block;
    }

    .icon-btn {
        font-size: 24px;
        text-decoration: none;
        cursor: pointer;
        transition: 0.3s ease;
        color: #ffd700;
    }

    .icon-btn:hover {
        color: #ffffffff;
        /* retro gold theme */
    }

    .dropdown {
        display: none;
        position: absolute;
        right: 0;
        top: 120%;
        background-color: #fff;
        min-width: 160px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        padding: 10px 0;
        z-index: 999;
    }

    .dropdown::before {
        content: "";
        position: absolute;
        top: -8px;
        right: 15px;
        border-width: 8px;
        border-style: solid;
        border-color: transparent transparent #fff transparent;
    }

    .dropdown a {
        display: block;
        padding: 10px 15px;
        color: #333;
        text-decoration: none;
        font-size: 15px;
        transition: background-color 0.3s ease;
    }

    .dropdown a:hover {
        background-color: #ffd700;
        color: #000;
    }

    .username {
        font-weight: 600;
        color: #000;
        text-align: center;
        padding: 5px 10px;
        border-bottom: 1px solid #eee;
        margin-bottom: 5px;
    }

    /* Show dropdown when parent has class 'active' */
    .profile-menu.active .dropdown {
        display: block;
    }

    .btn {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .button-nav {
        background-color: #ffd700;
        /* gold */
        color: #000;
        /* black text */
        padding: 8px 18px;
        border-radius: 25px;
        font-weight: 600;
        font-size: 15px;
        text-decoration: none;
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }

    .button-nav:hover {
        background-color: #000;
        /* black on hover */
        color: #ffd700;
        /* gold text */
        border: 2px solid #ffd700;
        box-shadow: 0 0 8px rgba(255, 215, 0, 0.6);
    }

    @media (max-width: 768px) {
        .btn {
            flex-direction: column;
            gap: 8px;
            width: 100%;
        }

        .button-nav {
            width: 100%;
            text-align: center;
        }
    }
</style>


<header class="retro-header">
    <nav>
        <div class="logo">
            <a href="index.php">Retro<span>Cart</span></a>
        </div>
        <ul>
            <li><a href="./index.php" class="<?php echo ($pagename == "index.php" ? "active" : "") ?>">Home</a></li>
            <li><a href="./categories.php"
                    class="<?php echo ($pagename == "categories.php" ? "active" : "") ?>">Categories</a>
            </li>
            <li><a href="./about.php" class="<?php echo ($pagename == "about.php" ? "active" : "") ?>">About
                </a></li>

            <!-- <li><a href="product.php" class="<?php echo ($pagename == "product.php" ? "active" : "") ?>">Product
                    details</a></li> -->

            <!-- <li><a href="./cart.php" class="<?php echo ($pagename == "cart.php" ? "active" : "") ?>">Cart</a></li>
            <li><a href="./checkout.php"
                    class="<?php echo ($pagename == "checkout.php" ? "active" : "") ?>">Checkout</a>
            </li> -->
        </ul>

        <?php if (isset($_SESSION['customer_id'])): ?>
            <div class="tog">
                <div class="header-icons">
                    <!-- After Login -->
                    <a href="./component/order.php" class="icon-btn">
                        <i class="bi bi-cart3"></i>
                    </a>



                    <div class="profile-menu">
                        <a href="profile.php" class="icon-btn">
                            <i class="bi bi-person-circle"></i>
                        </a>
                        <div class="dropdown">
                            <?php if (isset($_SESSION['user_name'])): ?>
                                <p class="username">Hi, <?= htmlspecialchars($_SESSION['user_name']); ?></p>
                            <?php endif; ?>
                            <!-- <a href="./profile-edit.php">Edit Profile</a> -->
                            <a href="./logout.php">Logout</a>
                        </div>
                    </div>

                </div>
            </div>
        <?php elseif (isset($_SESSION['merchant_id'])): ?>
            <div class="tog">
                <div class="header-icons">
                    <a href="./component/order.php" class="icon-btn">
                        <i class="bi bi-bag-check-fill"></i>
                    </a>


                    <div class="profile-menu">
                        <a href="../order.php" class="icon-btn">
                            <i class="bi bi-person-circle"></i>
                        </a>

                        <div class="dropdown">
                            <?php if (isset($_SESSION['merchant_name'])): ?>
                                <p class="username">Hi, <?= htmlspecialchars($_SESSION['merchant_name']); ?></p>
                            <?php endif; ?>
                            <a href="./merchant/merchant_dashboard.php">View Dashboard</a>
                            <!-- <a href="./profile-edit.php">Edit Profile</a> -->
                            <a href="./logout.php">Logout</a>
                        </div>
                    </div>

                </div>
            </div>
        <?php else: ?>
            <div class="btn">
                <!-- Before Login -->
                <a href="./login.php" class="button-nav">Login</a>
                <a href="./register.php" class="button-nav">Register</a>
            </div>
        <?php endif; ?>


        <div class="menu-toggle" id="menuToggle">☰</div>
        </div>
    </nav>

</header>
<script>
    const menuToggle = document.getElementById("menuToggle");
    const navLinks = document.querySelector("nav ul");

    menuToggle.addEventListener("click", () => {
        navLinks.classList.toggle("show");
    });

    // Close menu when clicking a link
    document.querySelectorAll("nav ul li a").forEach(link => {
        link.addEventListener("click", () => {
            navLinks.classList.remove("show");
        });
    });
</script>

<script>
    const profileMenu = document.querySelector(".profile-menu");
    const profileIcon = document.querySelector(".profile-menu .icon-btn");

    profileIcon.addEventListener("click", (e) => {
        e.preventDefault();
        profileMenu.classList.toggle("active");
    });

    // Optional: close dropdown when clicking outside
    document.addEventListener("click", (e) => {
        if (!profileMenu.contains(e.target)) {
            profileMenu.classList.remove("active");
        }
    });
</script>