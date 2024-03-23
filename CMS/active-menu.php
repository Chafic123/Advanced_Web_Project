<?php
if(session_status()!=2){
    session_start();
}
if(isset($_SESSION['admin']) && $_SESSION['admin']==true){
    $id=$_POST["id"];
    include "../config.php";
    $sql="SELECT IsActive FROM menuitem where ItemNum =?";
    $stmt=mysqli_prepare($conn,$sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $res = $stmt->get_result();
    $active= null;
    if ($res && ($res->num_rows > 0)) { 
        while ($row = $res->fetch_assoc()) {
            $active = $row['IsActive'];
        }
    }
    $stmt->close();

    if($active==1){
        $query="UPDATE menuitem SET IsActive = 0  WHERE ItemNum=?";
    }
    else{
        $query="UPDATE menuitem SET IsActive = 1  WHERE ItemNum=?";
    }
    $stmt=mysqli_prepare($conn,$query);
    $stmt->bind_param("i", $id);
    if($stmt->execute()){
        echo "SUCCESS";
    }
    else{
        echo $conn -> error;
    }
    $stmt->close();
    $conn->close();

}else{
    header("Location: ../Home/index.php");
}