<?php
if(session_status()!=2){
    session_start();
}
if(isset($_SESSION['admin']) && $_SESSION['admin']==true){ 

    // Check if form is submitted
    if (isset($_POST["edit"])) {
        // Include database configuration
        include '../config.php';

        //  Get values from the form
        $id = $_POST["id"];
        $name = $_POST['name'];
        $cat = $_POST['category'];
        $descr = $_POST['descr'];
        $price = $_POST['price'];
        $photoTmpName = $_FILES["photo"]["tmp_name"];
        $photoType = $_FILES["photo"]["type"];
        $basePath=__DIR__;

        if(isset($name) && !empty($name)){
            $qq="Select Photo From menuitem where ItemNum= ?";
            $stmt=$conn->prepare($qq);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();

            $pTmpName="";
            $pname="";
            if($result && $result->num_rows > 0) {
                while($row=$result->fetch_assoc()){
                    $pTmpName= $basePath . '/' . $row['Photo'];
                    $pname=$row['Photo'];
                }
                $iname=explode("/", $pname, 3)[2];
                $photoExtension=explode(".", $iname, 2)[1];
                $photoName='../Food/' . $name . '.' . $photoExtension;
                if (file_exists($pTmpName)) {
                    if(rename($pTmpName, $photoName)){
                        $qqq = "UPDATE menuitem SET Photo=? where  ItemNum=?;";
                        $stmt=$conn->prepare($qqq);
                        $stmt->bind_param("si", $photoName, $id);
                        if(!$stmt->execute()){
                            $_SESSION["message"] = "Error: " . $sql . "<br>" . $conn->error;
                        }
                        $stmt->close();

                        $query1="UPDATE menuitem SET ItemName=? where  ItemNum=?;";
                        $stmt=$conn->prepare($query1);
                        $stmt->bind_param("si", $name, $id);
                        if(!$stmt->execute()){
                            $_SESSION["message"] = "Error: " . $sql . "<br>" . $conn->error;
                        }
                        $stmt->close();
                        $_SESSION["success"] = "Item edited successfully!";
                    }
                    else{
                        $_SESSION["message"] = "Error uploading image.";
                    }
                }
                else{
                    $_SESSION["message"] = "Image not found.";
                }
            }
        } 
        
        if(isset($cat) && !empty($cat)){
            //  Get CategoryID
            $q = "SELECT CategoryID FROM categories where Name LIKE ?";
            $stmt=$conn->prepare($q);
            $stmt->bind_param("s", $cat);
            $stmt->execute();
            $res = $stmt->get_result();
            $catID="";
            if ($res && ($res->num_rows > 0)) { 
                while ($row = $res->fetch_assoc()) {
                    $catID = $row['CategoryID'];
                }
            }
            $stmt->close();

            $query2="UPDATE menuitem SET Category=? where  ItemNum=?;";
            $stmt=$conn->prepare($query2);
            $stmt->bind_param("si", $catID, $id);
            if(!$stmt->execute()){
                $_SESSION["message"] = "Error: " . $sql . "<br>" . $conn->error;
            }
            $stmt->close();
            $_SESSION["success"] = "Item edited successfully!";
        }

        if(isset($descr) && !empty($descr)){
            $query3="UPDATE menuitem SET Description=? where  ItemNum=?;";
            $stmt=$conn->prepare($query3);
            $stmt->bind_param("si", $descr, $id);
            if(!$stmt->execute()){
                $_SESSION["message"] = "Error: " . $sql . "<br>" . $conn->error;
            }
            $stmt->close();
            $_SESSION["success"] = "Item edited successfully!";
        }

        if(isset($price) && !empty($price)){
            $query4="UPDATE menuitem SET Price=? where  ItemNum=?;";
            $stmt=$conn->prepare($query4);
            $stmt->bind_param("si", $price, $id);
            if(!$stmt->execute()){
                $_SESSION["message"] = "Error: " . $sql . "<br>" . $conn->error;
            }
            $stmt->close();
            $_SESSION["success"] = "Item edited successfully!";
        }

        if(isset($photoTmpName) && !empty($photoTmpName)){
            $sqll="Select Photo From menuitem where ItemNum= ?";
            $stmt=$conn->prepare($sqll);
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
                    unlink($imagename);
                }
            }

            $photoExtension = pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION);
            if(isset($name) && empty($name)){
                $q1 = "SELECT ItemName FROM menuitem where ItemNum =?";
                $stmt=$conn->prepare($q1);
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $result = $stmt->get_result();
                $Mname=null;
                if ($result && ($result->num_rows > 0)) { 
                    while ($row = $result->fetch_assoc()) {
                        $Mname = $row['ItemName'];
                    }
                }
                $stmt->close();
                $photoName = '../Food/' . $Mname . '.' . $photoExtension;
            }
            else{
                $photoName = '../Food/' . $name . '.' . $photoExtension;
            }
            
            // Generate a unique filename based on the user's input
            // Upload image to server
            $targetDir = $basePath . '/../Food/';
            $targetFile = $targetDir . $photoName;
            if (move_uploaded_file($photoTmpName, $targetFile)) {
                $query5 = "UPDATE menuitem SET Photo=? where  ItemNum=?;";
                $stmt=$conn->prepare($query5);
                $stmt->bind_param("si", $photoName, $id);
                if(!$stmt->execute()){
                    $_SESSION["message"] = "Error: " . $sql . "<br>" . $conn->error;
                }
                $stmt->close();
                $_SESSION["success"] = "Item edited successfully!";
            } else {
                $_SESSION["message"] = "Error uploading image.";
            }
        }
        header("Location: cms-viewmenu.php");
    }
}else{
    header("Location: ../Home/index.php");
}