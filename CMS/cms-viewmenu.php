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
</head>

<body>
    <?php
        include "cms-nav.php";
    ?>

    <table border='1'>
        <thead>
            <tr>
                <th>Name</th>
                <th>Category</th>
                <th>Description</th>
                <th>Price</th>
                <th>Photo</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include '../config.php';

            $query = "SELECT * FROM menuitem inner join categories on menuitem.Category=categories.CategoryID ORDER BY ItemNum DESC;";
            $result = $conn->query($query);

            if ($result && ($result->num_rows > 0)) { 
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row["ItemName"] . '</td>';
                    echo '<td>' . $row["Name"] . '</td>';
                    echo '<td>' . $row["Description"] . '</td>';
                    echo '<td>' . $row["Price"] . '</td>';
                    echo '<td>' . $row["Photo"] . '</td>';
                    echo '<td><input type="checkbox" name="active"></td>';
                    echo '<td>
                    <a href="edit-menu.php?id=' . $row["ItemNum"] . '">Edit</a>
                    <a href="delete-menu.php?id=' . $row["ItemNum"] . '">Delete</a>
                    </td>';
                    echo '</tr>';
                }
                echo '</tbody>';
                echo '</table>';
            } else {
                echo "0 results";
            }
            ?>
        </tbody>
    </table>



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