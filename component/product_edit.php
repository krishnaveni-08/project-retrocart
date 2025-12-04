<?php
include("../../config/config.php");

// Check product ID
if (!isset($_GET['product_id']) || empty($_GET['product_id'])) {
    die("No product ID provided.");
}

$product_id = intval($_GET['product_id']);

// Fetch product data
$query = "SELECT * FROM products WHERE product_id = $product_id";
$result = mysqli_query($connect, $query);

if (!$result || mysqli_num_rows($result) === 0) {
    die("Invalid product ID.");
}

$row = mysqli_fetch_assoc($result);

// Current Data
$name = $row["name"];
$description = $row["description"];
$price = $row["price"];
$quantity = $row["quantity"];
$category = $row["category"];
$brand = $row["brand"];
$condition = $row["condition"];
$color = $row["color"];

// Fetch image
$imagequery = "SELECT * FROM product_image WHERE product_id='$product_id' LIMIT 1";
$imageResult = mysqli_query($connect, $imagequery);

if ($imageResult && mysqli_num_rows($imageResult) > 0) {
    $imgRow = mysqli_fetch_assoc($imageResult);
    $image_path = "../../" . $imgRow['image_path'];
    $db_image_path = $imgRow['image_path'];
} else {
    $image_path = "../assets/no-image.jpg";
    $db_image_path = "";
}

// ======================= UPDATE LOGIC =======================

if (isset($_POST['edit'])) {
    $product_id = intval($_POST['product_id']);
    $name = mysqli_real_escape_string($connect, $_POST['product_name']);
    $description = mysqli_real_escape_string($connect, $_POST['product_description']);
    $category = mysqli_real_escape_string($connect, $_POST['category']);
    $price = $_POST['product_price'];
    $brand = mysqli_real_escape_string($connect, $_POST['product_brand']);
    $quantity = intval($_POST['quantity']);
    $color = mysqli_real_escape_string($connect, $_POST['product_color']);
    $condition = mysqli_real_escape_string($connect, $_POST['product_condition']);

    // Handle Image Upload
    $newImage = $db_image_path;  // default (old image stays)

    if (!empty($_FILES['product_image']['name'])) {

        $targetDir = "../../uploads/";
        $fileName = time() . "_" . basename($_FILES["product_image"]["name"]);
        $targetFilePath = $targetDir . $fileName;

        $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

        if (in_array($fileType, $allowed)) {
            if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $targetFilePath)) {

                // Save DB path
                $newImage = "uploads/" . $fileName;

                // Update product_image table
                $imgCheck = mysqli_query($connect, "SELECT * FROM product_image WHERE product_id='$product_id'");
                if (mysqli_num_rows($imgCheck) > 0) {
                    mysqli_query($connect, "UPDATE product_image SET image_path='$newImage' WHERE product_id='$product_id'");
                } else {
                    mysqli_query($connect, "INSERT INTO product_image(product_id,image_path) VALUES('$product_id','$newImage')");
                }
            }
        }
    }

    // Final Update Query (outside image block)
    $update = "UPDATE products SET 
                name='$name',
                description='$description',
                category='$category',
                price='$price',
                brand='$brand',
                quantity='$quantity',
                color='$color',
                `condition`='$condition',
                image_path='$newImage'
               WHERE product_id='$product_id'";

    if (mysqli_query($connect, $update)) {
        echo "<script>alert('Product Updated Successfully'); window.location='./merchant_dashboard.php';</script>";
    } else {
        echo "<script>alert('Update Failed');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="../../style/style.css">
    <style>
        .align {
            width: 70%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
        }

        .button_back {
            text-decoration: none;
            color: #fff;
            font-size: 1rem;
            display: inline-block;
            padding: 10px 20px;
            border-radius: 5px;
            background-color: #ffd700;
        }

        .container {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;

        }

        .topbar h1 {
            text-align: center;
            color: white;
            font-size: 1.6rem;
            /* margin-bottom: 30px; */
            font-weight: 600;
            margin-top: 30px;
        }

        .edit {
            height: 100%;
            color: #fff;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            font-family: 'Orbitron', sans-serif;
        }

        .crd {
            width: 80%;
            background: #303030;
            border: 1px solid #ffd700;
            border-radius: 12px;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 30px;
        }

        label {
            color: #ffd700;
            display: block;
            margin-bottom: 4px;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-family: inherit;
        }

        textarea {
            height: 80px;
            resize: none;
        }

        .btn {
            background: #ffd700;
            color: #000;
            padding: 10px 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
        }

        .btn:hover {
            background: #ffcc00;
        }

        .preview img {
            width: 200px;
            border-radius: 8px;
            border: 1px solid #555;
        }

        .header {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }

        @media(max-width:768px) {
            .card {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
    <div class="edit">
        <div class="header">
            <h1>Edit Product</h1>
        </div>

        <div class="crd">
            <form id="editProductForm" enctype="multipart/form-data" method="POST" novalidate>
                <input type="hidden" name="product_id" value="<?= $product_id ?>">

                <div>
                    <label for="name">Product Name</label>
                    <input id="name" name="product_name" placeholder="Enter product name"
                        value="<?= htmlspecialchars($name) ?>" required maxlength="50" pattern="^[A-Za-z\s]{1,50}$"
                        title="Only letters (max 50 chars) allowed.">

                    <div style="margin-top:10px">
                        <label for="description">Description</label>
                        <textarea id="description" name="product_description" placeholder="Enter product description"
                            required maxlength="300"
                            minlength="10"><?= htmlspecialchars(trim($description)) ?></textarea>
                    </div>

                    <div style="margin-top:10px">
                        <label for="category">Category</label>
                        <select id="category" name="category" required>
                            <option value="">-- Select Category --</option>
                            <?php
                            $categories = ["RetroGames", "MusicTapes", "VintageToys", "ClassicFashion", "OldComics", "HomeAppliances", "Jewelry", "Watches"];
                            foreach ($categories as $cat) {
                                $selected = ($cat == $category) ? 'selected' : '';
                                echo "<option value='$cat' $selected>$cat</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div style="margin-top:10px;display:flex;gap:10px;">
                        <div style="flex:1">
                            <label for="price">Price (₹)</label>
                            <input id="price" name="product_price" placeholder="Enter price"
                                value="<?= htmlspecialchars($price) ?>" required pattern="^[0-9]+(\.[0-9]{1,2})?$"
                                title="Only numbers allowed. Example: 499 or 499.99">
                        </div>

                        <div style="flex:1">
                            <label for="brand">Brand</label>
                            <input id="brand" name="product_brand" placeholder="Brand"
                                value="<?= htmlspecialchars($brand) ?>" maxlength="30" pattern="^[A-Za-z\s]{0,30}$"
                                title="Only letters (max 30 chars) allowed.">
                        </div>
                    </div>

                    <div style="margin-top:10px;display:flex;gap:10px;">
                        <div style="flex:1">
                            <label for="quantity">Quantity</label>
                            <input id="quantity" name="quantity" type="number" min="0" max="9999" placeholder="Quantity"
                                value="<?= htmlspecialchars($quantity) ?>" required>
                        </div>

                        <div style="flex:1">
                            <label for="color">Color</label>
                            <input id="color" name="product_color" placeholder="Color"
                                value="<?= htmlspecialchars($color) ?>" maxlength="30" pattern="^[A-Za-z\s]{0,30}$"
                                title="Only letters (max 30 chars) allowed.">
                        </div>
                    </div>

                    <div style="margin-top:10px">
                        <label for="condition">Condition</label>
                        <select id="condition" name="product_condition" required>
                            <option value="New" <?= $condition == "New" ? 'selected' : '' ?>>New</option>
                            <option value="Used" <?= $condition == "Used" ? 'selected' : '' ?>>Used</option>
                            <option value="Refurbished" <?= $condition == "Refurbished" ? 'selected' : '' ?>>Refurbished
                            </option>
                        </select>
                    </div>

                    <div style="margin-top:20px">
                        <button class="btn" type="submit" name="edit">Update</button>
                    </div>
                </div>

                <aside>
                    <label for="image">Product Image</label>
                    <input id="image" name="product_image" type="file" accept="image/*" onchange="previewImage(event)">
                    <div class="helper" style="font-size:12px;color:#aaa">Accepted: jpg, png, webp, gif</div>
                    <div class="preview" id="preview" style="margin-top:12px">
                        <img src="<?= htmlspecialchars($image_path) ?>" alt="Product Image">
                    </div>
                </aside>
            </form>
        </div>
    </div>



    <script>
        // ✅ Preview Image
        function previewImage(e) {
            const p = document.getElementById('preview');
            p.innerHTML = '';
            const file = e.target.files[0];
            if (!file) return;
            const img = document.createElement('img');
            img.src = URL.createObjectURL(file);
            img.onload = () => URL.revokeObjectURL(img.src);
            p.appendChild(img);
        }

        // ✅ Client-side Validation
        document.getElementById('editProductForm').addEventListener('submit', function (e) {
            const name = document.getElementById('name').value.trim();
            const desc = document.getElementById('description').value.trim();
            const price = document.getElementById('price').value.trim();
            const brand = document.getElementById('brand').value.trim();
            const color = document.getElementById('color').value.trim();

            const namePattern = /^[A-Za-z\s]{1,50}$/;
            const pricePattern = /^[0-9]+(\.[0-9]{1,2})?$/;
            const textPattern = /^[A-Za-z\s]{0,30}$/;

            if (!namePattern.test(name)) {
                alert("Product name must contain only letters and spaces (max 50).");
                e.preventDefault();
            } else if (desc.length < 10 || desc.length > 300) {
                alert("Description must be 10–300 characters.");
                e.preventDefault();
            } else if (!pricePattern.test(price)) {
                alert("Price must be numeric only.");
                e.preventDefault();
            } else if (brand && !textPattern.test(brand)) {
                alert("Brand must contain only letters (max 30).");
                e.preventDefault();
            } else if (color && !textPattern.test(color)) {
                alert("Color must contain only letters (max 30).");
                e.preventDefault();
            }
        });
    </script>
</body>

</html>

<style>
    /* Footer */
    footer {
        height: 20vh;
        width: 100%;
        background: #444444ff;
        color: #eee;
        text-align: center;
        /* padding: 35px 20px; */
        border-top: 2px solid #ffd700;
        margin-top: 40px;
    }

    footer .cpy {
        width: 100%;
        height: 100%;
        align-items: center;
        justify-content: center;
        margin-top: 30px;
    }

    footer .logo {
        font-size: 1.8rem;
        color: #ffd700;
        font-weight: 700;
    }

    footer .copyright {
        font-size: 0.9rem;
        color: #ccc;
        margin-top: 10px;
    }
</style>
<!-- ===================== FOOTER ======================== -->
<footer>
    <div class="cpy">
        <p class="logo">RetroCart</p>
        <p class="copyright">© 2025 RetroCart. All rights reserved.</p>
    </div>
</footer>