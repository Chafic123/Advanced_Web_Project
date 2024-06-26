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
    ?>

    <?php
    // Check if a message is set in the session and if it's an array
    if (isset($_SESSION["message"]) && is_array($_SESSION["message"])) {
        // Display the message
        echo "<div id='message'>" . $_SESSION["message"]["text"] . "</div>";

        // Check if 5 seconds have passed since the message was set
        if (time() - $_SESSION["message"]["timestamp"] >= 5) {
            // Unset the message from the session
            unset($_SESSION["message"]);
        } else {
            // Add JavaScript to hide the message after 5 seconds
            echo "<script>
                    setTimeout(function() {
                        document.getElementById('message').style.display = 'none';
                    }, 5000); // 5000 milliseconds = 5 seconds
                  </script>";
        }
    }
    ?>

    <form action="filter-menu.php" method="post" id="filter-menu">
        <div class="form-group">
            <label for="search">Search:</label>
            <input class="form-control" type="text" placeholder="Search Name" name="search" id="search">
        </div>
        <div class="form-group">
            <label for="category">Category:</label>
            <select class="form-select category" name="category" id="cat">
                <!-- Categories will be populated dynamically using jQuery -->
            </select>
        </div>
    </form>

    <table class="table" border='1'>
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

    <!-- edit popup -->
    <div class="modal fade" id="edit" tabindex="-1" style="top:10%;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit-label">Edit Menu Item</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm">
                        <div class="form-group">
                            <label for="name">Number:</label>
                            <input type="text" class="form-control-plaintext" id="id" name="id" readonly>
                        </div>
                        <hr>
                        <h6>Please fill at least one of the following fields to edit data.</h6>
                        <hr>
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" id="name" name="name">
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
                            <textarea class="form-control" id="descr" name="descr"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="price">Price:</label>
                            <input type="number" step="0.01" class="form-control" id="price" name="price">
                        </div>
                        <div class="form-group">
                            <label for="photo">Photo:</label>
                            <input type="file" class="form-control" id="photo" name="photo" accept="image/png, image/jpeg, image/jpg">
                        </div>
                </div>
                <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="edit" id="editItem">Edit Item</button>
                        <button type="reset" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
    include "cms-footer.php";
    ?>

    <script src="https://unpkg.com/swup@4"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://unpkg.com/swup@4"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="../main.js"></script>
    <script src="cms-menu.js"></script>
</body>

</html>

<?php
}else{
    header("Location: ../Home/index.php");
}
?>