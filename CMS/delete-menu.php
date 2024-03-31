<?php
if(session_status()!=2){
    session_start();
}
if(isset($_SESSION['admin']) && $_SESSION['admin']==true){
    $basePath = __DIR__ ;

    include '../config.php';
    $id=$_GET['id'];
    $query="Select Photo From menuitem where ItemNum= ?";
    $stmt=$conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    $imagename="";
    if($result && $result->num_rows > 0) {
        while($row=$result->fetch_assoc()){
            $imagename= $basePath . '/' . $row['Photo'];
        }
        if (file_exists($imagename)) {
            if(unlink($imagename)){
                $q= "Delete from cart Where ItemNum=?";
                $stmt = $conn->prepare($q);
                $stmt->bind_param("i", $id);
                if ($stmt->execute()){
                    $stmt->close();

                    $sql="Delete from menuitem where ItemNum=?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $id);
                    if ($stmt->execute()){
                        $_SESSION["success"] = "Item deleted successfully!";
                    }
                    
                    $stmt->close();
                }
                else{
                    $_SESSION["message"] = "Error: " . $sql . "<br>" . $conn->error;
                }
            }

        }
        else{
            $_SESSION["message"] = "Image not found.";
        }
    }
    else{
        $_SESSION["message"] = "Item not found.";
    }

    header("Location: cms-viewmenu.php");
}else{
    header("Location: ../Home/index.php");
}