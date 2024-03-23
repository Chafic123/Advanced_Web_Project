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
        $error=false;

        //  Get ItemNum
        $q = "SELECT ItemNum FROM menuitem where ItemName LIKE ?";
        $stmt=$conn->prepare($q);
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $res = $stmt->get_result();
        $menuID="";
        if ($res && ($res->num_rows > 0)) { 
            while ($row = $res->fetch_assoc()) {
                $menuID = $row['ItemNum'];
            }
        }
        $stmt->close();

        if(isset($name) && !empty($name)){
            //Check if item already found
            $query = "SELECT * FROM menuitem where ItemName LIKE ?";
            $stmt=$conn->prepare($query);
            $stmt->bind_param("s", $name);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();

            if ($result && ($result->num_rows > 0)) { 
                while ($row = $result->fetch_assoc()) {
                    $_SESSION["message"] = array(
                        "text" => "Item already found!",
                        "timestamp" => time() // Store the current timestamp
                    );
                }
                header("Location: cms-viewmenu.php");
            }else{
                $query1="UPDATE menuitem SET ItemName=? where  ItemNum=?;";
                $stmt=$conn->prepare($query1);
                $stmt->bind_param("si", $name, $id);
                if(!$stmt->execute()){
                    $error=true;
                }
                $stmt->close();
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
                $error=true;
            }
            $stmt->close();
        }

        if(isset($descr) && !empty($descr)){
            $query3="UPDATE menuitem SET Description=? where  ItemNum=?;";
            $stmt=$conn->prepare($query3);
            $stmt->bind_param("si", $descr, $id);
            if(!$stmt->execute()){
                $error=true;
            }
            $stmt->close();
        }

        if(isset($price) && !empty($price)){
            $query4="UPDATE menuitem SET Price=? where  ItemNum=?;";
            $stmt=$conn->prepare($query4);
            $stmt->bind_param("si", $price, $id);
            if(!$stmt->execute()){
                $error=true;
            }
            $stmt->close();
        }

        if(isset($photoTmpName) && !empty($photoTmpName)){
            $basePath=__DIR__;
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
            
            // Generate a unique filename based on the user's input
            $photoExtension = pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION);
            $photoName = '../Food/' . $name . '.' . $photoExtension;
            // Upload image to server
            $targetDir = $basePath . '/../Food/';
            $targetFile = $targetDir . $photoName;
            if (move_uploaded_file($photoTmpName, $targetFile)) {
                // Insert image data into database
                $query5 = "UPDATE menuitem SET Photo=? where  ItemNum=?;";
                $stmt=$conn->prepare($query5);
                $stmt->bind_param("si", $photoName, $id);
                if(!$stmt->execute()){
                    $error=true;
                }
                $stmt->close();
            } else {
                $error=true;              
            }
        }

        if(!$error){
            header("Location: cms-viewmenu.php");
            exit();
        }
        else{
            echo $conn->error;
        }
    }
}else{
    header("Location: ../Home/index.php");
}