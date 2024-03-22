<?php
session_start();

// Define base path
$basePath = __DIR__;

// Check if form is submitted
if (isset($_POST["add"])) {
    // Include database configuration
    include 'config.php';

    //  Get values from the form
    $name = $_POST['name'];
    $cat = $_POST['category'];
    $descr = $_POST['descr'];
    $price = $_POST['price'];
    $photoTmpName = $_FILES["photo"]["tmp_name"];
    $photoType = $_FILES["photo"]["type"];

    //  Get CategoryID
    $query = "SELECT CategoryID FROM categories where Name LIKE ?";
    $stmt=$conn->prepare($query);
    $stmt->bind_param("i", $query);
    $stmt->execute();
    $email = $stmt->get_result();
    $stmt->close();

    $catID->fetch_assoc()["CategoryID"];

    // Generate a unique filename based on the user's input
    $photoExtension = pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION);
    $photoName = $name . '.' . $imageExtension;

    // Upload image to server
    $targetDir = $basePath . '/Food/';
    $targetFile = $targetDir . $photoName;
    if (move_uploaded_file($photoTmpName, $targetFile)) {
        // Insert image data into database
        $sql = "INSERT INTO menuitem (ItemName, Category, Description, Price, Photo, IsActive) VALUES ('$name', '$catID', '$descr', '$price', '$photoName', 1)";
        if ($conn->query($sql) === true) {
            $_SESSION["message"] = array(
                "text" => "Image uploaded successfully.",
                "timestamp" => time() // Store the current timestamp
            );
        } else {
            $_SESSION["message"] = array(
                "text" => "Error: " . $sql . "<br>" . $conn->error,
                "timestamp" => time() // Store the current timestamp
            );
        
        }
    } else {
        $_SESSION["message"] = array(
            "text" => "Error uploading image.",
            "timestamp" => time() // Store the current timestamp
        );
    
    }
    
    // Redirect to cms-viewmenu.php
    header("Location: cms-viewmenu.php");
    exit();
}