<?php
if(session_status()!=2){
    session_start();
}
if(isset($_SESSION['admin']) && $_SESSION['admin']==true){    

    // Define base path
    $basePath = __DIR__ ;

    // Check if form is submitted
    if (isset($_POST["add"])) {
        // Include database configuration
        include '../config.php';

        //  Get values from the form
        $name = $_POST['name'];
        $cat = $_POST['category'];
        $descr = $_POST['descr'];
        $price = $_POST['price'];
        $photoTmpName = $_FILES["photo"]["tmp_name"];
        $photoType = $_FILES["photo"]["type"];


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

        // Generate a unique filename based on the user's input
        $photoExtension = pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION);
        $photoName = '../Food/' . $name . '.' . $photoExtension;
        // Upload image to server
        $targetDir = $basePath . '/../Food/';
        $targetFile = $targetDir . $photoName;
        if (move_uploaded_file($photoTmpName, $targetFile)) {
            // Insert image data into database
            $sql = "INSERT INTO menuitem (ItemName, Category, Description, Price, Photo, IsActive) VALUES ('$name', '$catID', '$descr', '$price', '$photoName', 1)";
            if (!$conn->query($sql) === true) {
                $_SESSION["message"] = "Error: " . $sql . "<br>" . $conn->error;
                header("Location: cms-addmenuform.php");           
            }
            else{
                $_SESSION["success"]="Item added successfully!";
                header("Location: cms-viewmenu.php");
            }
        } else {
            $_SESSION["message"] = "Error uploading image.";     
            header("Location: cms-addmenuform.php");           
        }            
    }   

    $conn->close();

    exit();
    
}else{
    header("Location: ../Home/index.php");
}