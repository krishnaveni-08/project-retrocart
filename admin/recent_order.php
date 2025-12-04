<?php
include("../config/config.php");
include("../config/security.php");

$result = $conn->query("SELECT o.id, p.name AS product, c.name AS customer, o.total, o.created_at 
                        FROM orders o 
                        JOIN products p ON o.product_id=p.id 
                        JOIN customers c ON o.customer_id=c.id 
                        ORDER BY o.created_at DESC LIMIT 10");
?>
<table>
  <tr><th>ID</th><th>Product</th><th>Customer</th><th>Total</th><th>Date</th></tr>
  <?php while($row = $result->fetch_assoc()): ?>
  <tr>
    <td><?= clean($row['id']) ?></td>
    <td><?= clean($row['product']) ?></td>
    <td><?= clean($row['customer']) ?></td>
    <td>₹<?= number_format($row['total']) ?></td>
    <td><?= clean($row['created_at']) ?></td>
  </tr>
  <?php endwhile; ?>
</table>
