<?php
include_once('../config/config.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$customer_id = $_SESSION['customer_id'] ?? null;
$merchant_id = $_SESSION['merchant_id'] ?? null;

if (!$merchant_id && !$customer_id) {
    echo "<script>alert('Please login first!'); window.location.href='../login.php';</script>";
    exit;
}
if (isset($_POST['order'])) {

    $product_id = $_POST['product_id'];   // ⭐ IMPORTANT FIX
    $buyer_id = $_POST['buyer_id'];
    $buyer_type = $_POST['buyer_type'];

    $product_name = mysqli_real_escape_string($connect, $_POST['product_name']);
    $quantity = intval($_POST['quantity']);
    $total_amount = floatval($_POST['total_amount']);
    $payment_method = mysqli_real_escape_string($connect, $_POST['payment_method']);


    // Get customer details
    if ($customer_id) {
        $queryCustomer = "SELECT username FROM customers_details WHERE id = $customer_id";
        $resCustomer = mysqli_query($connect, $queryCustomer);
        $customerRow = mysqli_fetch_assoc($resCustomer);
        $customer_name = $customerRow['username'] ?? '';
    } else {
        $customer_name = null;
    }

    //  Get merchant details
    if ($merchant_id) {
        $queryMerchant = "SELECT username FROM merchant_details WHERE id = $merchant_id";
        $resMerchant = mysqli_query($connect, $queryMerchant);
        $merchantRow = mysqli_fetch_assoc($resMerchant);
        $merchant_name = $merchantRow['username'] ?? '';
    } else {
        $merchant_name = null;
    }

    // Buyer details
    if ($customer_id) {
        $buyer_id = $customer_id;
        $buyer_name = $_SESSION['user_name'] ?? $customer_name;
        $buyer_type = 'customer';
    } else {
        $buyer_id = $merchant_id;
        $buyer_name = $_SESSION['merchant_name'];
        $buyer_type = 'merchant';
    }

    //  Insert into orders table
    $query = "INSERT INTO order_table 
        (buyer_id, buyer_name, buyer_type, merchant_id, merchant_name, product_id, product_name, quantity, total_amount, payment_method)
        VALUES ('$buyer_id', '$buyer_name', '$buyer_type', '$merchant_id', '$merchant_name', '$product_id', '$product_name', '$quantity', '$total_amount', '$payment_method')";

    if (mysqli_query($connect, $query)) {
        echo "<script>alert('Order placed successfully!'); window.location.href='./order.php';</script>";
        exit;
    } else {
        echo "<script>alert('Error placing order: " . mysqli_error($connect) . "');</script>";
    }
}

/* ---------------- FETCH ORDERS ---------------- */
if ($customer_id) {
    $buyer_id = $customer_id;
    $buyer_name = $_SESSION['user_name'];
    $buyer_type = 'customer';
} elseif ($merchant_id) {
    $buyer_id = $merchant_id;
    $buyer_name = $_SESSION['merchant_name'];
    $buyer_type = 'merchant';
}


$orderQuery = " SELECT o.*, p.name AS product_name, 
         (SELECT pi.image_path FROM product_image pi WHERE pi.product_id = p.product_id LIMIT 1) AS image_path FROM order_table o LEFT JOIN products p ON o.product_id = p.product_id WHERE o.buyer_id = '$buyer_id' ORDER BY o.id DESC";

// echo $orderQuery;

// $orderQuery = "
// SELECT o.*, p.name AS product_name,(SELECT pi.image_path FROM product_image pi WHERE pi.product_id = p.product_id ORDER BY pi.image_id ASC LIMIT 1) AS image_path FROM order_table o LEFT JOIN products p ON o.product_id = p.product_id WHERE o.buyer_id='$buyer_id' ORDER BY o.id DESC";

// echo $orderQuery;


$orderResult = mysqli_query($connect, $orderQuery);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background-color: #000;
            color: #ffd700;
            font-family: 'Orbitron', sans-serif;
        }

        .orders-container {
            width: 90%;
            max-width: 900px;
            margin: auto;
            background: #111;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 0 15px rgba(255, 215, 0, 0.4);
        }

        .orders-container h1 {
            text-align: center;
            color: #ffd700;
            margin-bottom: 20px;
        }

        .order-card {
            display: flex;
            align-items: center;
            gap: 20px;
            background: #1a1a1a;
            border: 1px solid #ffd700;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            transition: 0.3s;
        }

        .order-card:hover {
            background: #222;
            transform: scale(1.02);
        }

        .order-card img {
            width: 120px;
            height: 120px;
            border-radius: 10px;
            object-fit: cover;
            border: 2px solid #ffd700;
        }

        .order-details {
            flex: 1;
            color: #fff;
            font-size: 15px;
            line-height: 1.8;
        }

        .order-details strong {
            color: #ffd700;
        }

        .empty {
            text-align: center;
            color: #fff;
            font-size: 18px;
            margin-top: 30px;
        }

        /* ============================
      📌 RESPONSIVE CSS
   (1200px → 320px screens)
===============================*/

        /* ----- 1200px ↓ ----- */
        @media (max-width: 1200px) {
            .orders-container {
                width: 95%;
                padding: 25px;
            }

            .order-card {
                gap: 15px;
                padding: 18px;
            }

            .order-card img {
                width: 110px;
                height: 110px;
            }
        }

        /* ----- 992px ↓ ----- */
        @media (max-width: 992px) {
            .order-card {
                padding: 15px;
                gap: 15px;
            }

            .order-card img {
                width: 100px;
                height: 100px;
            }

            .order-details {
                font-size: 14px;
            }

            .orders-container h1 {
                font-size: 24px;
            }
        }

        /* ----- 768px ↓ (Tablets) ----- */
        @media (max-width: 768px) {
            .order-card {
                flex-direction: column;
                text-align: center;
            }

            .order-card img {
                width: 150px;
                height: 150px;
            }

            .order-details {
                font-size: 14px;
                line-height: 1.6;
            }
        }

        /* ----- 576px ↓ (Mobile) ----- */
        @media (max-width: 576px) {
            body {
                padding: 20px 0;
            }

            .orders-container {
                width: 90%;
                padding: 20px;
            }

            .orders-container h1 {
                font-size: 20px;
            }

            .order-card {
                padding: 15px;
                gap: 10px;
            }

            .order-card img {
                width: 130px;
                height: 130px;
            }

            .order-details h3 {
                font-size: 18px;
            }

            .order-details p {
                font-size: 13px;
            }
        }

        /* ----- 320px ↓ (Small Mobile) ----- */
        @media (max-width: 320px) {
            .orders-container {
                width: 95%;
                padding: 15px;
            }

            .order-card img {
                width: 120px;
                height: 120px;
            }

            .order-details h3 {
                font-size: 16px;
            }

            .order-details p {
                font-size: 12px;
            }
        }
    </style>

</head>

<body>
    <header class="retro-header">
        <?php include_once('./nav-copy.php'); ?>
    </header>

    <main>
        <div class="orders-container">
            <h1><i class="bi bi-bag-check-fill"></i> My Orders</h1>
            <hr style="border-color:#ffd700; margin:15px 0;">

            <?php if (mysqli_num_rows($orderResult) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($orderResult)): ?>
                    <div class="order-card" data-aos="fade-up">
                        <?php if (!empty($row['image_path'])): ?>
                            <img src="../<?php echo htmlspecialchars(string: $row['image_path']); ?>" alt="Product Image">
                        <?php else: ?>
                            <img src="../assets/no-image.jpg" alt="No Image">
                        <?php endif; ?>


                        <div class="order-details">
                            <h3><?php echo htmlspecialchars($row['product_name']); ?></h3>
                            <p><strong>Product name:</strong> <?php echo htmlspecialchars($row['product_name']); ?></p>
                            <p><strong>Payment Method:</strong> <?php echo htmlspecialchars($row['payment_method']); ?></p>
                            <p><strong>Total Amount:</strong> ₹<?php echo htmlspecialchars($row['total_amount']); ?></p>
                            <p><strong>Ordered By:</strong> <?php echo ucfirst($row['buyer_type']); ?></p>
                        </div>

                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="empty">No orders found yet! 🛒</p>
            <?php endif; ?>
        </div>
    </main>

    <?php include('../component/footer.php'); ?>
</body>

</html>