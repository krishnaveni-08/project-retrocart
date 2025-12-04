<?php
include("../../config/config.php");

header('Content-Type: application/json');

if(isset($_POST['email'])){
    $email = mysqli_real_escape_string($connect, $_POST['email']);

    if(!empty($email)){
        $check = mysqli_query($connect, "SELECT * FROM newsletter_subscribers WHERE email='$email'");
        if(mysqli_num_rows($check) > 0){
            echo json_encode(['status'=>'error','message'=>'You are already subscribed!']);
        } else {
            $insert = mysqli_query($connect, "INSERT INTO newsletter_subscribers (email) VALUES ('$email')");
            if($insert){
                echo json_encode(['status'=>'success','message'=>'Thank you for subscribing!']);
            } else {
                echo json_encode(['status'=>'error','message'=>'Error subscribing. Try again.']);
            }
        }
    } else {
        echo json_encode(['status'=>'error','message'=>'Please enter a valid email.']);
    }
}
?>
