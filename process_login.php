<?php

session_start();

include 'config.php';

$email= $_POST['email'];
$pass= $_POST['password'];

if (isset($email) && isset($pass)){
    $stmt = $conn->prepare("SELECT * FROM account WHERE Email=? AND Password=?");
    $stmt->bind_param("ss", $email, $pass);
    $stmt->execute();
    $result = $stmt->get_result();
    $response = array();
    $lres=false;

    if(isset($_POST['rem'])){
        setcookie("email", $email);
        setcookie("pass", $pass);
    }

    if ($result && ($result->num_rows > 0)) { 
        while ($row = $result->fetch_assoc()) {
            if($row['IsAdmin']==1){
                $response['message']= "is admin";
            }
            else{
                $response['message'] = "Login successful";
            }
            $lres=true;
            $_SESSION["id"] = $row['AccountNum'];
        }
    }  
    else{
        $response['message']= "error";
    }

    if ($lres){
        $response['success'] = true;
    }else{
        $response['success'] = false;
    }
    
    echo json_encode($response);

    $stmt->close();
    $conn->close();
    exit();
}