<?php
if ($_POST["question"]) {
    $subject = $_POST["subject"];
    $qt = $_POST["question"];
    $email = $_POST['email'];
    $headers = "From: $email \r\n";
    $headers .= "Return-Path: $email \r\n";
    $headers.='X-Mailer: PHP/' . phpversion();
    ini_set("smtp_server", "smtp.gmail.com");
    ini_set("smtp_port", "587");
    if (mail(
        "danadabdoub@gmail.com",
        $subject,
        $qt . "\nFrom: " . $email,
        $headers
    )) {
        echo "sent!";
    } else {
        echo "not!";
    }
}
