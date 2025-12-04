<?php
include(__DIR__ . "/../config/config.php");

// ----------------- TOTAL ORDERS -----------------
$result = mysqli_query($connect, "SELECT COUNT(*) as totOrders FROM order_table");
$row = mysqli_fetch_assoc($result);
$totOrders = $row['totOrders'] ?? 0;

// ----------------- TOTAL REVENUE -----------------
$result = mysqli_query($connect, "SELECT IFNULL(SUM(total_amount),0) as totalRevenue FROM order_table");
$row = mysqli_fetch_assoc($result);
$totalRevenue = $row['totalRevenue'] ?? 0;

// ----------------- TOTAL PRODUCTS -----------------
$result = mysqli_query($connect, "SELECT COUNT(*) as totProducts FROM products");
$row = mysqli_fetch_assoc($result);
$totProducts = $row['totProducts'] ?? 0;

// ----------------- TOTAL CUSTOMERS -----------------
$result = mysqli_query($connect, "SELECT COUNT(*) as totCustomers FROM customers_details");
$row = mysqli_fetch_assoc($result);
$totCustomers = $row['totCustomers'] ?? 0;

// ----------------- RECENT ORDERS (LAST 5) -----------------
$recentOrders = [];
$result = mysqli_query($connect, "
    SELECT id as order_id, buyer_type, buyer_name, product_name, quantity, total_amount, order_date
    FROM order_table
    ORDER BY id DESC
    LIMIT 5
");
while ($row = mysqli_fetch_assoc($result)) {
    $recentOrders[] = $row;
}

// Total Merchants
$merchantQuery = "SELECT COUNT(*) AS total_merchants FROM merchant_details WHERE status='active'";
$merchantResult = mysqli_query($connect, $merchantQuery);
$merchantRow = mysqli_fetch_assoc($merchantResult);
$totMerchants = $merchantRow['total_merchants'] ?? 0;


// ----------------- PRODUCTS FOR GRID (LAST 12) -----------------
$products = [];
$query = "
  SELECT p.*, 
  (SELECT image_path FROM product_image WHERE product_id = p.product_id LIMIT 1) AS image_path
  FROM products p
  JOIN merchant_details m ON p.merchant_id = m.id
  WHERE p.status='active' 
  AND m.status='active'
  ORDER BY p.product_id DESC
";
$result = mysqli_query($connect, $query);

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $products[] = $row;
    }
}


?>