<?php
include("../config/config.php");
include("../config/security.php");

$search = isset($_GET['q']) ? "%".$_GET['q']."%" : "%";
$page = max(1, (int)($_GET['page'] ?? 1));
$limit = 5;
$offset = ($page - 1) * $limit;

$stmt = $conn->prepare("SELECT * FROM customers WHERE name LIKE ? OR email LIKE ? LIMIT ?,?");
$stmt->bind_param("ssii", $search, $search, $offset, $limit);
$stmt->execute();
$res = $stmt->get_result();
?>
<form method="get">
  <input type="text" name="q" placeholder="Search..." value="<?= clean($_GET['q'] ?? '') ?>">
  <button>Search</button>
</form>

<table>
<tr><th>ID</th><th>Name</th><th>Email</th><th>Action</th></tr>
<?php while($r = $res->fetch_assoc()): ?>
<tr>
  <td><?= $r['id'] ?></td>
  <td><?= clean($r['name']) ?></td>
  <td><?= clean($r['email']) ?></td>
  <td>
    <a href="view.php?customer_id=<?= $r['id'] ?>">View</a>
  </td>
</tr>
<?php endwhile; ?>
</table>
