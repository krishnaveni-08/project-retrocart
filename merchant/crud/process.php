<?php
session_start();
include("../../config/config.php");

// create product
if (isset($_POST['create'])) {
    if (empty($_SESSION['merchant_id'])) {
        die('not logged in');
    }

    $merchant_id = $_SESSION['merchant_id']; // important for foreign key
    $product_name = mysqli_real_escape_string($connect, $_POST['product_name']);
    $product_description = mysqli_real_escape_string($connect, $_POST['product_description']);
    $product_brand = mysqli_real_escape_string($connect, $_POST['product_brand']);
    $color = mysqli_real_escape_string($connect, $_POST['product_color']);
    $condition = mysqli_real_escape_string($connect, $_POST['product_condition']);
    $category = mysqli_real_escape_string($connect, $_POST['category']);
    $product_price = mysqli_real_escape_string($connect, $_POST['product_price']);
    $quantity = mysqli_real_escape_string($connect, $_POST['quantity']);


    $product_status = 'active';

    $product_folder = "Asset/image/product/";
    if (!is_dir($product_folder))
        mkdir($product_folder, 0777, true);

    $main_path = "";
    if (!empty($_FILES['product_image']['name'])) {
        $main_image = $_FILES['product_image']['name'];
        $main_tmp = $_FILES['product_image']['tmp_name'];
        $main_path = $product_folder . $main_image;
        move_uploaded_file($main_tmp, $main_path);
    }

    $query = "INSERT INTO products (merchant_id, name, description, price, quantity, category, image, brand, color, `condition`, status) 
          VALUES ('$merchant_id', '$product_name', '$product_description', '$product_price', '$quantity', '$category', '$main_path', '$product_brand', '$color', '$condition', '$product_status')";

    echo $query;
    $result = mysqli_query($connect, $query);
    $product_id = mysqli_insert_id($connect);
    if ($result) {
        if (!empty($main_path)) {
            mysqli_query($connect, "INSERT INTO product_image (product_id, image_path) VALUES ('$product_id', '$main_path')");
        }
        $_SESSION["message"] = "Product created successfully.";
        header("Location: ../merchant_dashboard.php");
        exit();
    } else {
        $_SESSION["message"] = "Not created. Error: " . mysqli_error($connect);
        header("Location: ../merchant_dashboard.php");
        exit();
    }
}


// product delete
if (isset($_POST['product_delete'])) {
    $product_id = $_POST['product_id'];
    $status = 'inactive';

    $query = "UPDATE products SET status='$status' WHERE product_id=$product_id";
    $result = mysqli_query($connect, $query);

    if ($result) {
        $_SESSION["message"] = "Product deleted successfully.";
        header("Location: ../merchant_dashboard.php");
        exit();

    } else {
        $_SESSION["message"] = "Not deleted";
        header("Location: ../merchant_dashboard.php");
        exit();
    }
}


?>