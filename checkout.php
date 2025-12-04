<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include("./config/config.php");
$isloggedin = isset($_SESSION["customer_id"]) || isset($_SESSION["merchant_id"]);

// Get data from URL
$product_id = $_GET['product_id'];
$total = $_GET['total'];
$quantity = $_GET['quantity'];
?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Checkout | RetroCart</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="./style/style.css">
  <link rel="stylesheet" href="style/checkout.css">
</head>

<header class="retro-header">
  <?php include("./component/nav.php"); ?>
</header>

<body>
  <div class="checkout-container">
    <?php
    if (isset($_GET['product_id'])) {
      $product_id = $_GET['product_id'];
      $query = "SELECT * FROM products WHERE product_id = $product_id";
      $result = mysqli_query($connect, $query);

      if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $product_id = $row["product_id"];
        $name = $row["name"];
        $price = $row["price"];
        $description = $row["description"];
        $merchant_id = $row["merchant_id"];
      } else {
        die("Product not found.");
      }
    } else {
      die("No product ID provided.");
    }
    ?>

    <!-- Order Summary -->
    <div class="section">
      <h2><i class="bi bi-bag-check-fill"></i> Order Summary</h2>
      <div class="order-summary">
        <div class="order-item">
          <span><?= htmlspecialchars($name); ?></span>
          <span>₹<?= htmlspecialchars($total); ?></span>
        </div>
        <div class="order-item">
          <span>Shipping</span>
          <span>₹50</span>
        </div>
        <div class="total">
          Total: ₹<?= $total ?>
        </div>
      </div>
    </div>

    <!-- Payment Section -->
    <div class="section">
      <h2><i class="bi bi-credit-card-2-front accordion-fill"></i> Payment Method</h2>
      <div class="payment-options">
        <label class="payment-option"><input type="radio" name="payment" value="cod" checked> Cash on Delivery</label>
        <label class="payment-option"><input type="radio" name="payment" value="upi"> UPI Payment (Google Pay / PhonePe)</label>
        <label class="payment-option"><input type="radio" name="payment" value="card"> Credit / Debit Card</label>
      </div>

      <div class="payment-box" style="margin-top:20px;">
        <input type="text" id="upiInput" placeholder="Enter UPI ID (e.g. krish@okaxis)" style="display:none;">
        <input type="text" id="cardInput" placeholder="Enter Card Number (12-16 digits)" style="display:none;">
      </div>
    </div>

    <form method="POST" action="./component/order.php" id="orderForm">
      <input type="hidden" name="product_id" value="<?= $product_id; ?>">
      <input type="hidden" name="merchant_id" value="<?= $merchant_id; ?>">
      <input type="hidden" name="product_name" value="<?= $name; ?>">
      <input type="hidden" name="total_amount" id="formTotal" value="<?= $total; ?>">
      <input type="hidden" name="payment_method" id="formPayment" value="">

      <button type="submit" name="order" class="place-order" id="Confirm">Check Out</button>
    </form>
  </div>
  <?php include("./component/footer.php"); ?>
</body>

<script>
  const paymentRadios = document.querySelectorAll('input[name="payment"]');
  const upiInput = document.getElementById('upiInput');
  const cardInput = document.getElementById('cardInput');
  const form = document.getElementById('orderForm');
  const formPayment = document.getElementById('formPayment');

  // Show/Hide input fields based on selected payment method
  paymentRadios.forEach(radio => {
    radio.addEventListener('change', () => {
      if (radio.value === 'upi') {
        upiInput.style.display = 'block';
        cardInput.style.display = 'none';
      } else if (radio.value === 'card') {
        cardInput.style.display = 'block';
        upiInput.style.display = 'none';
      } else {
        upiInput.style.display = 'none';
        cardInput.style.display = 'none';
      }
    });
  });

  // Validation before submit
  form.addEventListener('submit', function (event) {
    const selected = document.querySelector('input[name="payment"]:checked').value;
    formPayment.value = selected; // Save selected method

    if (selected === 'upi') {
      const upiVal = upiInput.value.trim();
      const upiPattern = /^[a-zA-Z0-9.\-_]{2,}@[a-zA-Z]{3,}$/;
      if (!upiVal || !upiPattern.test(upiVal)) {
        alert('Please enter a valid UPI ID (e.g. krish@okaxis)');
        upiInput.focus();
        event.preventDefault();
        return;
      }
    }

    if (selected === 'card') {
      const cardVal = cardInput.value.trim();
      if (!/^\d{12,16}$/.test(cardVal)) {
        alert('Please enter a valid card number (12-16 digits).');
        cardInput.focus();
        event.preventDefault();
        return;
      }
    }

    // ✅ COD or valid UPI/Card → continue to order.php
  });
</script>

</html>