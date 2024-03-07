<?php

session_start();

include 'config.php';

$email = $_POST['ContactInput'];
$bd = $_POST['bday'];
$fn = $_POST['frst-name-Input'];
$ln = $_POST['lst-name-Input']; 
$pass = $_POST['password'];
$response = array();
$lres=false;

function getAccountbyEmail($email){
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM account WHERE Email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result= $stmt->get_result();
    $stmt->close();
    return $result;
}

if (isset($email) && isset($bd) && isset($fn) && isset($ln) && isset($pass)){
    $result =getAccountbyEmail($email);
    if($result && ($result->num_rows > 0)){
        $response['message']= "email error";
    }
    else{
        $query = $conn->prepare("INSERT INTO account (Email, Birthday, FirstName, LastName, Password, IsAdmin) VALUES (?, ?, ?, ?, ?, 0)");
        $query->bind_param("sssss", $email, $bd, $fn, $ln, $pass);
        
        // $res = $query->get_result();
    
        if ($query->execute()) {
            $response['success'] = true;
            $response['message'] = "Signup successful";
            $result=getAccountbyEmail($email);
            if ($result && ($result->num_rows > 0)) { 
                while ($row = $result->fetch_assoc()) {
                    $_SESSION["id"] = $row['AccountNum'];
                }
            }  
            else{
                $response['message']= "error";
                $response['success'] = false;
            }
        }else {
            $response['message']= "error";
            $response['success'] = false;
        }
    
        $query->close();
    }
    
    echo json_encode($response);

    // $stmt->close();
    $conn->close();

    exit();
}