<?php
if(isset($_POST['signout'])){
    if (session_status() != 2) {
        session_start();
    }
    // Unset all session variables
    session_unset();
    // Destroy the session
    session_destroy();
    header("location:Home/index.php");
    exit();
}
?>
