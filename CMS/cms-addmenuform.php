<?php 
if(session_status()!=2){
    session_start();
}
if(isset($_SESSION['admin']) && $_SESSION['admin']==true){
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Malaz</title>
    <link rel="icon" href="../Malaz Design/Malaz---icon.ico" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/tw-cen-mt-std" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="cms.css">
    <link rel="stylesheet" href="cms-menu.css">
</head>

<body>
    <?php
        include "cms-nav.php";
        include "cms-popup.php";
    ?>

    <?php
   // Check if a message is set in the session and if it's an array
   if(isset($_SESSION["message"])){
    echo '<script>
            let popContainer = document.getElementsByClassName("pop-up-container")[0];
            let popUpMsg = document.getElementsByClassName("pop-up")[0];
            let closePopUp = document.getElementById("close-btn");

            popContainer.style.display = "flex";
            popContainer.style.alignItems = "center";
            popContainer.style.justifyContent = "center";
            popUpMsg.style.display = "flex";
            popUpMsg.style.flexDirection = "column";

            closePopUp.addEventListener("click", () => {
                popContainer.style.display = "none";
                popUpMsg.style.display = "none";
            });            
          </script>';
        unset($_SESSION["message"]);
    }
    ?>
    
    <div class="container pt-5">
    <h2 class="my-4">Add Menu Item</h2>
        <form id="addForm" action="cms-addmenu.php" method="post"  enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Name</label>
                <span class='required'>*</span>
                <input type="text" class="form-control" id="name" name="name">
                <small></small>
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <span class='required'>*</span>
                <select class="form-select category" name="category" id="category">
                    <option value="" disabled selected>Select Category</option>
                    <!-- Categories will be populated dynamically using jQuery -->
                </select>
                <small></small>
            </div>
            <div class="form-group">
                <label for="descr">Description</label>
                <span class='required'>*</span>
                <textarea class="form-control" id="descr" name="descr"></textarea>
                <small></small>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <span class='required'>*</span>
                <input type="number" step="0.01" class="form-control" id="price" name="price" >
                <small></small>
            </div>
            <div class="form-group">
                <label for="photo">Photo</label>
                <span class='required'>*</span>
                <input type="file" class="form-control" id="photo" name="photo" accept="image/png, image/jpeg, image/jpg" >
                <small></small>
            </div>

            <button type="submit" class="btn btn-primary" name="add" id="add">Add Item</button>
        </form>
    </div>

    <?php
    include "cms-footer.php";
    ?>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="cms-menu.js"></script>
</body>

</html>
<?php
}else{
    header("Location: ../Home/index.php");
}
?>