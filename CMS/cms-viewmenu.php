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
    if(isset($_SESSION["success"])|| isset($_SESSION["message"])){
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
        unset($_SESSION["success"]);
    }
    ?>

    <div class="container">
        <main class="ViewMain">
            <div class="Title">
                <section class="title-text">
                    <h1 class="first-part">View Menu Item</h1>
                </section>
                <section class="title-img">
                    <img src="../Malaz Design\Malaz---icon cropped.png">
                </section>
            </div>
            <form action="filter-menu.php" method="post" id="filter-menu">
                <div class="form-group d-flex felx-row">
                    <label for="search" class="inLabel">Search</label>
                    <input class="form-control" type="text" placeholder="Search Name" name="search" id="search">
                </div>
                <div class="form-group d-flex felx-row">
                    <label for="category" class="inLabel">Category</label>
                    <select class="form-select category" name="category" id="cat">
                        <!-- Categories will be populated dynamically using jQuery -->
                    </select>
                </div>
            </form>
        </main>
    </div>
    <div class="tcontainer p-2 overflow-scroll">
        <table class="table table-striped table-bordered table-sm" border='1'>
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Category</th>
                    <th scope="col">Description</th>
                    <th scope="col">Price</th>
                    <th scope="col">Photo</th>
                    <th scope="col">Active</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody id="menuitems">
                <?php
                require("filter-menu.php");
                include '../config.php';
                $query = "SELECT * FROM menuitem inner join categories on menuitem.Category=categories.CategoryID where 1=1 ORDER BY ItemNum DESC;";
                $result = $conn->query($query);
                menuItemTable($result);
                ?>
            </tbody>
        </table>
    </div>
    

    <!-- edit popup -->
    <div class="modal fade" id="edit" tabindex="-1" style="top:5%;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit-label">Edit Menu Item</h5>
                    <button class="btn-close closee" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm" action="edit-menu.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="name">Number:</label>
                            <input type="text" class="form-control-plaintext" id="id" name="id" readonly>
                        </div>
                        <hr>
                        <h6>Please fill at least one of the following fields to edit data.</h6>
                        <hr>
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Menu Name">
                            <small id="nameE"></small>
                        </div>
                        <div class="form-group">
                            <label for="category">Category:</label>
                            <select class="form-select category" name="category" id="category">
                                <option value="" disabled selected>Select Category</option>
                                <!-- Categories will be populated dynamically using jQuery -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="descr">Description:</label>
                            <textarea class="form-control" id="descr" name="descr" placeholder="Enter item description here"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="price">Price:</label>
                            <input type="number" step="0.01" class="form-control" id="price" name="price" placeholder="Item Price">
                        </div>
                        <div class="form-group">
                            <label for="photo">Photo:</label>
                            <input type="file" class="form-control" id="photo" name="photo" accept="image/png, image/jpeg, image/jpg">
                            <small></small>
                        </div>
                </div>
                <div class="modal-footer">
                        <button type="submit" class="btn btn-light" name="edit" id="editItem">Edit Item</button>
                        <button type="reset" class="btn btn-light close" id="cancel" data-bs-dismiss="modal">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
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