<?php
if ($_POST["message"]) {
    $subject = $_POST["subject"];
    $msg = $_POST["message"];
    $email = $_POST['email'];
    $headers = "From: $email \r\n";
    $headers .= "Return-Path: $email \r\n";
    ini_set("smtp_server", "smtp.gmail.com");
    ini_set("smtp_port", "587");
    if (mail(
        "danadabdoub@gmail.com",
        $subject,
        $msg . "\nFrom: " . $email,
        $headers
    )) {
        echo "sent!";
    } else {
        echo "not!";
    }
}
