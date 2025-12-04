<?php
session_start();
include("../../config/config.php");
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Edit Product — RetroCart</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  
  <style>
    :root {
      --bg: #070708;
      --card: #0f0f10;
      --accent: #ffd700;
      --gold: #ffd700;
      --mag: #ffd700;
      font-family: "Press Start 2P", cursive, Arial, sans-serif;
    }

    .edit {
      width: 100%;
      height: 120vh;
      background: linear-gradient(180deg, #020202, #0b0b0b);
      /* color: #eaf9f9; */
      /* margin: 0; */
      /* padding: 28px; */
      display: flex;
      background-color: red;
    }

    .container {
      background-color: black;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }

    .align {
      width: 80%;
      background-color: grey;
      display: flex;
      justify-content: space-between;
      border-radius: 10px;
      margin-top: 70px;
      align-items: center;
      padding: 0 15px;
    }

    .topbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      color: #ffd700;
      /* font-size: 24px; */
    }

    .button_back {
      text-decoration: none;
      color: #fff;
      font-size: 1rem;
      /* display: inline-block; */
      /* padding: 10px 20px; */
      width: 100px;
      height: 50px;
      border-radius: 5px;
      background-color: #ffd700;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .contain {
      width: 100%;
      /* margin: 0 auto; */
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }

    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 14px
    }

    .h1 {
      color: var(--gold);
      font-size: 18px
    }

    .card {
      width: 70%;
      background-color: #1A1A1A;
      border: 2px solid rgba(255, 255, 255, 0.03);
      border-radius: 12px;
      padding: 18px;
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.6);
    }

    form {
      display: grid;
      grid-template-columns: 1fr 360px;
      gap: 16px;
    }

    label {
      display: block;
      color: #ffd700;
      font-size: 16px;
      margin-bottom: 6px
    }

    input,
    textarea,
    select {
      width: 90%;
      padding: 10px;
      border-radius: 8px;
      border: 2px solid #222;
      background: transparent;
      color: #e6f9f9;
      outline: none
    }

    textarea {
      min-height: 120px;
      resize: vertical
    }

    .grid2 {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 8px
    }

    .controls {
      display: flex;
      gap: 8px;
      align-items: center;
      margin-top: 8px
    }

    .btn {
      display: inline-flex;
      gap: 8px;
      align-items: center;
      padding: 10px 14px;
      border-radius: 10px;
      border: none;
      background: linear-gradient(90deg, var(--accent), var(--mag));
      color: #000;
      cursor: pointer;
      font-weight: 700
    }

    .btn.ghost {
      background: transparent;
      border: 2px solid var(--gold);
      color: var(--gold)
    }

    .preview {
      height: 220px;
      border-radius: 10px;
      border: 4px solid var(--mag);
      background: #0b0b0b;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #9aa;
      overflow: hidden
    }

    .preview img {
      max-width: 100%;
      max-height: 100%;
      display: block
    }

    .helper {
      font-size: 12px;
      color: #9aa;
      margin-top: 6px
    }
  </style>

</head>

<?php
// edit product
if (isset($_POST['edit'])) {

  $product_id = (int) $_POST['product_id'];
  $name = $_POST['product_name'];
  $description = $_POST['product_description'];
  $category = $_POST['category'];
  $brand = $_POST['product_brand'];
  $price = $_POST['product_price'];
  // $discount_price = $_POST['product_discount_price'];
  $quantity = $_POST['quantity'];
  // $sku = $_POST['sku'];
  $color = $_POST['product_color'];
  // $material = $_POST['product_material'];
  $condition = $_POST['product_condition'];

  // Update product query
  $query = "UPDATE products SET name='$name', description='$description', price='$price', quantity='$quantity', category='$category', status='active', brand='$brand', `condition`='$condition', stock=0, color='$color' WHERE product_id=$product_id";

  echo $query;
  $result = mysqli_query($connect, $query);

  if ($result) {
    // $_SESSION["message"] = "Product updated successfully.";
    // header("Location: ../admin_dashboard.php");
    echo "
    <script>
      alert('Product updated successfully.'); 
      window.location='../admin_dashboard.php';
    </script>
    ";
    exit();
  } else {
    $_SESSION["message"] = "Product not updated: " . mysqli_error($connect);
    header("Location: ../admin_dashboard.php");
    exit();
  }
}
?>

<body>
  <div class="container">
    <div class="align">
      <a class="button_back ghost" href="../admin_dashboard.php"><i class="bi bi-arrow-left-circle"></i>
        Back</a>
      <div class="topbar">
        <h2>RetroCart </h2>
      </div>
    </div>
    <?php
    include("../../component/product_edit.php");
    ?>

  </div>


</body>

</html>

