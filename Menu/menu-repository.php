<?php
    include('../config.php');
    function getMenuItems(){
        global $conn;
        $query='select * from menuitem';
        return $conn->query($query);
    }

    function getCategories(){
        global $conn;
        $query='select * from categories';
        return $conn->query($query);
    }

    function generateItems(){
        $items=getMenuItems();
        $categories=getCategories();
        while($cate=mysqli_fetch_array($categories)){
            echo "<div class='menu-sections'>";
            echo "<h2 class='section-title'>".$cate['Name']."</h2>";
            echo "<div class='menu-items'>";
            while($item=mysqli_fetch_array($items)){
                echo "
                <div class='card' style='width: 18rem;'>
                    <img src='".$item['Photo']."' class='card-img-top' alt='".$item['ItemName']."'>
                    <div class='card-body'>
                    <h5 class='card-title'>".$item['ItemName']."</h5>
                    <p class='card-text'>".$item['Description']."</p>
                    <p class='card-text'>".$item['Price']."</p>
                    <label for='quantity'>Quantity</label>
                    <input type='number' name='quantity' />
                    <a href='#' class='btn btn-primary'>+</a>
                    </div>
                </div>
                ";
            }
            echo "</div>";
            echo "</div>";
        }
    }
?>