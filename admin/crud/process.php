<?php
session_start();
include("../../config/config.php");





// Create sub-admin
if (isset($_POST['create'])) {
    // Sanitize and fetch inputs safely
    $managerName = mysqli_real_escape_string($connect, $_POST['name']);
    $managerId = mysqli_real_escape_string($connect, $_POST['manager_id']);
    $password = mysqli_real_escape_string($connect, $_POST['password']);
    $managerPhone = mysqli_real_escape_string($connect, $_POST['phone']);
    $managerEmail = mysqli_real_escape_string($connect, $_POST['email']);
    $userstatus = 'active';

    // Simple validation
    if (empty($managerName) || empty($managerId) || empty($password) || empty($managerPhone)) {
        $_SESSION['message'] = "⚠️ Please fill in all required fields.";
        header("Location: ../admin_dashboard.php");
        exit();
    }

    // Check duplicate Manager ID before inserting
    $checkQuery = "SELECT * FROM sub_admins WHERE manager_id = '$managerId'";
    $checkResult = mysqli_query($connect, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        $_SESSION['message'] = "❌ Manager ID already exists!";
        header("Location: ../admin_dashboard.php");
        exit();
    }

    // Insert new record
    $query = "INSERT INTO sub_admins (name, manager_id, password, phone, email, status) 
              VALUES ('$managerName', '$managerId', '$password', '$managerPhone', '$managerEmail', '$userstatus')";

    $result = mysqli_query($connect, $query);

    if ($result) {
        $_SESSION['message'] = "✅ Sub-Admin created successfully!";
        header("Location: ../admin_dashboard.php");
        exit();
    } else {
        $_SESSION['message'] = "❌ Error inserting data: " . mysqli_error($connect);
        header("Location: ../admin_dashboard.php");
        exit();
    }
}


// merchant delete
if (isset($_POST['merchant_delete'])) {
    $merchant_id = (int) $_POST['merchant_id'];
    $status = 'inactive';
    
    $query = "UPDATE merchant_details SET status='$status' WHERE id=$merchant_id";
    $result = mysqli_query($connect, $query);
    
    if ($result) {
        $_SESSION['message'] = "update successfully";
        header('Location: ../admin_dashboard.php');
        exit();
    } else {
        $_SESSION['message'] = "not update";
        header('Location: ../admin_dashboard.php');
        exit();
    }
}


// customer delete
if (isset($_POST['customer_delete'])) {
    $customer_id = (int) $_POST['customer_id'];
    $status = 'inactive';
    
    $query = "UPDATE customers_details SET status='$status' WHERE id=$customer_id";
    $result = mysqli_query($connect, $query);
    
    if ($result) {
        $_SESSION['message'] = "update successfully";
        header('Location: ../admin_dashboard.php');
        exit();
    } else {
        $_SESSION['message'] = "not update";
        header('Location: ../admin_dashboard.php');
        exit();
    }
}


// merchant revert
if (isset($_POST['merchant_revert'])) {
    $merchant_id = (int) $_POST['merchant_id'];
    $status = 'active';

    $query = "UPDATE merchant_details SET status='$status' WHERE id=$merchant_id";
    $result = mysqli_query($connect, $query);

    if ($result) {
        $_SESSION['message'] = "update successfully";
        header('Location: ../admin_dashboard.php');
        exit();
    } else {
        $_SESSION['message'] = "not update";
        header('Location: ../admin_dashboard.php');
        exit();
    }
}


// customer revert
if (isset($_POST['customer_revert'])) {
    $customer_id = (int) $_POST['customer_id'];
    $status = 'active';

    $query = "UPDATE customers_details SET status='$status' WHERE id=$customer_id";
    $result = mysqli_query($connect, $query);

    if ($result) {
        $_SESSION['message'] = "update successfully";
        header('Location: ../admin_dashboard.php');
        exit();
    } else {
        $_SESSION['message'] = "not update";
        header('Location: ../admin_dashboard.php');
        exit();
    }
}





// update sub-admin
if (isset($_POST['update'])) {
    $userid = (int) $_POST['id'];
    $managerName = trim($_POST['name']);
    $managerId = trim($_POST['manager_id']);
    $password = trim($_POST['password']);
    $managerPhone = trim($_POST['phone']);
    $userstatus = trim($_POST['status']);

    // Validation
    if (empty($managerName) || !preg_match("/^[A-Za-z\s]+$/", $managerName)) {
        $_SESSION['message'] = "Invalid name. Only letters and spaces allowed.";
        header('Location: ../admin_dashboard.php#sub-admins');
        exit();
    }

    if (!preg_match("/^(?=.*[0-9])(?=.*[!@#$%^&*]).{5,}$/", $password)) {
        $_SESSION['message'] = "Password must have at least 5 characters, including 1 number and 1 special character.";
        header('Location: ../admin_dashboard.php#sub-admins');
        exit();
    }

    if (!preg_match("/^[0-9]{9,10}$/", $managerPhone)) {
        $_SESSION['message'] = "Phone number must be 9 or 10 digits long.";
        header('Location: ../admin_dashboard.php#sub-admins');
        exit();
    }

    if (strlen($managerId) < 3) {
        $_SESSION['message'] = "Manager ID must be at least 3 characters long.";
        header('Location: ../admin_dashboard.php#sub-admins');
        exit();
    }

    if (!in_array($userstatus, ['active', 'inactive'])) {
        $_SESSION['message'] = "Invalid status value.";
        header('Location: ../admin_dashboard.php#sub-admins');
        exit();
    }

    // ✅ Check if manager_id already exists for another sub-admin
    $checkQuery = "SELECT id FROM sub_admins WHERE manager_id = ? AND id != ?";
    $stmtCheck = mysqli_prepare($connect, $checkQuery);
    mysqli_stmt_bind_param($stmtCheck, "si", $managerId, $userid);
    mysqli_stmt_execute($stmtCheck);
    mysqli_stmt_store_result($stmtCheck);

    if (mysqli_stmt_num_rows($stmtCheck) > 0) {
        $_SESSION['message'] = "Manager ID already exists! Please use a unique one.";
        mysqli_stmt_close($stmtCheck);
        header('Location: ../admin_dashboard.php#sub-admins');
        exit();
    }
    mysqli_stmt_close($stmtCheck);

    // ✅ Safe Update Query
    $stmt = mysqli_prepare($connect, "UPDATE sub_admins 
        SET name=?, manager_id=?, password=?, phone=?, status=? 
        WHERE id=?");

    mysqli_stmt_bind_param($stmt, "sssssi", $managerName, $managerId, $password, $managerPhone, $userstatus, $userid);

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['message'] = "Updated successfully!";
    } else {
        $_SESSION['message'] = "Update failed: " . mysqli_error($connect);
    }

    mysqli_stmt_close($stmt);
    header('Location: ../admin_dashboard.php#sub-admins');
    exit();
}




// merchant delete
// if (isset($_POST['delete'])) {
//     $merchant_id = $_POST['merchant_id'];
//     $status = 'inactive';

//     $query = "UPDATE merchant_details SET status='$status' WHERE id=$merchant_id";
//     $result = mysqli_query($connect, $query);

//     if($result){
//         $_SESSION["message"] = "Merchant deleted successfully.";
//         header("Location: ../admin_dashboard.php");
//         exit();

//     }
//     else{
//         $_SESSION["message"] = "Not deleted";
//         header("Location: ../admin_dashboard.php");
//     exit();
//     }
// }

// if (isset($_POST['delete'])) {
//     $merchant_id = (int) $_POST['merchant_id']; // force integer
//     $status = 'inactive';

//     // Debug check (optional)
//     // echo "Updating merchant id: $merchant_id"; exit;

//     $query = "UPDATE merchant_details SET status='$status' WHERE id=$merchant_id";
//     $result = mysqli_query($connect, $query);

//     if ($result) {
//         // Optional: check if a row was actually updated
//         if (mysqli_affected_rows($connect) > 0) {
//             $_SESSION["message"] = "Merchant deleted successfully.";
//         } else {
//             $_SESSION["message"] = "No merchant found with that ID.";
//         }

//         header("Location: ../admin_dashboard.php");
//         exit();
//     } else {
//         $_SESSION["message"] = "Error: " . mysqli_error($connect);
//         header("Location: ../admin_dashboard.php");
//         exit();
//     }
// }




// product delete
if (isset($_POST['product_delete'])) {
    $product_id = $_POST['product_id'];
    $status = 'inactive';

    $query = "UPDATE products SET status='$status' WHERE product_id=$product_id";
    $result = mysqli_query($connect, $query);

    if ($result) {
        $_SESSION["message"] = "Product deleted successfully.";
        header("Location: ../admin_dashboard.php");
        exit();

    } else {
        $_SESSION["message"] = "Not deleted";
        header("Location: ../admin_dashboard.php");
        exit();
    }
}

// sub admin delete
if (isset($_POST['subadmin_delete'])) {
    $subadmin_id = $_POST['subadmin_id'];
    $status = 'inactive';

    $query = "UPDATE sub_admins SET status='$status' WHERE id=$subadmin_id";
    $result = mysqli_query($connect, $query);

    if ($result) {
        $_SESSION["message"] = "Sub Admin deleted successfully.";
        header("Location: ../admin_dashboard.php");
        exit();

    } else {
        $_SESSION["message"] = "Not deleted";
        header("Location: ../admin_dashboard.php");
        exit();
    }
}
?>