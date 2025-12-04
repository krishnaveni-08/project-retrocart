<?php
include("./config/config.php"); // adjust path if needed


if (isset($_POST['subscribe'])) {
    $email = mysqli_real_escape_string($connect, $_POST['email']);

    if (!empty($email)) {

        // Check if already subscribed
        $checkQuery = "SELECT * FROM newsletter_subscribers WHERE email='$email'";
        // echo $checkQuery;

        $checkResult = mysqli_query($connect, $checkQuery);

        if (mysqli_num_rows($checkResult) > 0) {
            echo "<script>
                alert('You are already subscribed!');
                window.location.href='./index.php';
            </script>";
        } 
        else {
            $query = "INSERT INTO newsletter_subscribers (email) VALUES ('$email')";
        

            if (mysqli_query($connect, $query)) {
                echo "<script>alert('Thank you for subscribing!'); 
                window.location.href='./index.php';
                </script>";
            } else {
                echo "<script>alert('Error subscribing. Please try again.'); 
                window.location.href='./index.php';
                </script>";
            }

        }
    } else {
        echo "<script>alert('Please enter a valid email.'); 
        window.location.href='./index.php';
        </script>";
    }
}



// if (isset($_POST['subscribe'])) {
//     $email = mysqli_real_escape_string($connect, $_POST['email']);

//     if (!empty($email)) {
//         // Check if already subscribed
//         $checkQuery = "SELECT * FROM newsletter_subscribers WHERE email='$email'";
//         $checkResult = mysqli_query($connect, $checkQuery);

//         if (mysqli_num_rows($checkResult) > 0) {
//             echo "<script>alert('You are already subscribed!'); window.history.back();</script>";
//         } else {
//             $query = "INSERT INTO newsletter_subscribers (email) VALUES ('$email')";
//             if (mysqli_query($connect, $query)) {
//                 echo "<script>alert('Thank you for subscribing!'); window.history.back();</script>";
//             } else {
//                 echo "<script>alert('Error subscribing. Please try again.'); window.history.back();</script>";
//             }
//         }
//     } else {
//         echo "<script>alert('Please enter a valid email.'); window.history.back();</script>";
//     }
// }
?>
