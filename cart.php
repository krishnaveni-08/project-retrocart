<?php
include("./config/config.php");

$product_id = $_GET['product_id'];
// Current product details
$product_query = "SELECT * FROM products WHERE product_id = $product_id";
$product_result = mysqli_query($connect, $product_query);
$product = mysqli_fetch_assoc($product_result);

// Get category name
$category = $product['category'];

// $suggest_query = "SELECT * FROM products 
//                   WHERE category='$category' 
//                   AND product_id != $product_id 
//                   AND status='active' 
//                   LIMIT 4";

$suggest_query = "SELECT p.* FROM products p 
INNER JOIN merchant_details m ON p.merchant_id = m.id 
WHERE p.category = '$category' 
AND p.product_id != $product_id 
AND p.status = 'active' 
AND m.status = 'active' 
ORDER BY p.product_id ASC 
LIMIT 4;";




$suggest_result = mysqli_query($connect, $suggest_query);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="./style/style.css">
    <link rel="stylesheet" href="./style/cart.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">


</head>

<header class="retro-header">
    <?php
    include("./component/nav.php");
    ?>

</header>

<body>
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
        <!-- Header -->
        <div class="cart-header">
            <h1>Your Shopping Cart</h1>
        </div>

        <div class="cart-container">
            <!-- Cart items section -->
            <div class="cart-items" data-aos="zoom-in-right">
                <!-- Repeat this block for each product using PHP -->
                <div class="cart-item">
                    <div class="main-image" id="mainImageWrap">
                        <?php if (!empty($img) && !empty($img['image_path'])) { ?>
                            <img src="./<?= htmlspecialchars($img['image_path']); ?>" alt="Product Image">
                        <?php } else { ?>
                            <img src="../assets/no-image.jpg" alt="No Image Available">
                        <?php } ?>
                    </div>
                    <div class="item-details">
                        <h3 class="item-name"><?= htmlspecialchars($name); ?></h3>
                        <p class="item-price">₹ <?= htmlspecialchars($price); ?></p>

                        <div class="item-quantity">
                            <button class="quantity-btn decrease">-</button>
                            <input type="number" class="quantity-input" value="1" min="1">
                            <button class="quantity-btn increase">+</button>
                        </div>
                    </div>
                </div>
                <!-- Repeat ends -->
            </div>

            <!-- Order summary -->
            <div class="cart-summary" data-aos="zoom-in-left">
                <h2 class="summary-title">Order Summary</h2>

                <div class="summary-item">
                    <span>Subtotal</span>
                    <span>₹0.00</span>
                </div>

                <div class="summary-item">
                    <span>Shipping</span>
                    <span>₹50.00</span>
                </div>

                <div class="summary-total">
                    <span>Total</span>
                    <span>₹0.00</span>
                </div>
                <input type="hidden" id="totalAmountInput" name="total_amount" value="0">
                <button class="checkout-btn">Proceed to Checkout</button>
            </div>
        </div>
    </div>



    <div class="featured-section">
        <h2 class="featured-title">Suggested Products</h2>
        <div class="feature-con">
            <?php while ($row = mysqli_fetch_assoc($suggest_result)) { ?>
                <div class="featured-products">
                    <div class="featured-product" data-aos="flip-left" data-aos-easing="ease-out-cubic"
                        data-aos-duration="2000">
                        <img src="<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>"
                            class="featured-product-image">
                        <h3 class="featured-product-name"><?php echo $row['name']; ?></h3>
                        <p class="featured-product-price">₹<?php echo $row['price']; ?></p>
                        <p class="featured-product-description"><?php echo $row['description']; ?></p>
                        <a href="cart.php?product_id=<?php echo $row['product_id']; ?>">
                            <button class="add-to-cart-btn">Buy Now</button>
                        </a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>


    <?php
    include("./component/footer.php");
    ?>


    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const cartItems = document.querySelectorAll(".cart-item");
            const subtotalEl = document.querySelector(".summary-item span:last-child");
            const totalEl = document.querySelector(".summary-total span:last-child");
            const shipping = 50; // fixed shipping cost
            const totalInput = document.getElementById("totalAmountInput");
            const checkoutBtn = document.querySelector(".checkout-btn");

            function updateTotals() {
                let subtotal = 0;

                cartItems.forEach(item => {
                    const price = parseFloat(item.querySelector(".item-price").textContent.replace("₹", "").replace(",", ""));
                    const quantity = parseInt(item.querySelector(".quantity-input").value);
                    subtotal += price * quantity;
                });

                const total = subtotal + shipping;

                subtotalEl.textContent = "₹" + subtotal.toLocaleString("en-IN", { minimumFractionDigits: 2 });
                totalEl.textContent = "₹" + total.toLocaleString("en-IN", { minimumFractionDigits: 2 });
                totalInput.value = total; // store the latest total
            }

            // Increase/decrease logic
            document.querySelectorAll(".quantity-btn.increase").forEach(button => {
                button.addEventListener("click", () => {
                    const input = button.parentElement.querySelector(".quantity-input");
                    input.value = parseInt(input.value) + 1;
                    updateTotals();
                });
            });

            document.querySelectorAll(".quantity-btn.decrease").forEach(button => {
                button.addEventListener("click", () => {
                    const input = button.parentElement.querySelector(".quantity-input");
                    if (parseInt(input.value) > 1) {
                        input.value = parseInt(input.value) - 1;
                        updateTotals();
                    }
                });
            });

            document.querySelectorAll(".quantity-input").forEach(input => {
                input.addEventListener("change", () => {
                    if (parseInt(input.value) < 1 || isNaN(input.value)) {
                        input.value = 1;
                    }
                    updateTotals();
                });
            });

            // 🔥 Checkout button click — redirect with dynamic total & quantity
            checkoutBtn.addEventListener("click", (e) => {
                e.preventDefault();

                const total = totalInput.value;
                const quantity = document.querySelector(".quantity-input").value;
                const productId = <?= $product_id ?>;

                // Redirect
                window.location.href = `./checkout.php?product_id=${productId}&total=${total}&quantity=${quantity}`;
            });

            // Initial total calculation
            updateTotals();
        });
    </script>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>