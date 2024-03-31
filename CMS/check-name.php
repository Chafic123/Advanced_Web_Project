<?php
if(session_status()!=2){
    session_start();
}
if(isset($_SESSION['admin']) && $_SESSION['admin']==true){
    include "../config.php";
    $name=$_POST["name"];

    if(isset($name)){
        //Check if item already found
        $query = "SELECT * FROM menuitem where ItemName LIKE ?";
        $stmt=$conn->prepare($query);
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        if ($result && ($result->num_rows > 0)) { 
            echo "Item already found!";           
        }
        else{
            echo "";
        }
    }
}else{
    header("Location: ../Home/index.php");
}