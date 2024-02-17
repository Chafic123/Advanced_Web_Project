<?php
if ($_POST["message"]) {
    $subject=$_POST["subject"];
    $msg=$_POST["message"];
    if(mail(
        "danadabdoub@gmail.com",
        $subject,
         $msg. "From: ".$_POST['email']
    )){
        header("Location: index.html");
    }
}
