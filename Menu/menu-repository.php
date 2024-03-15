<?php
include('../config.php');
if(session_status()!=2){
    session_start();
}
$account = isset($_SESSION['id'])?($_SESSION['id']):(3);
//gets all menu items from the db
function getMenuItems()
{
    global $conn;
    $query = 'SELECT * from menuitem WHERE isActive=1';
    $result = $conn->query($query);
    $items = array();
    while ($row = $result->fetch_assoc()) {
        $items[] = $row;
    }
    return $items;
}
//gets all categories
function getCategories()
{
    global $conn;
    $query = 'SELECT * from categories';
    $result = $conn->query($query);
    $categories = array();
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }
    return $categories;
}
//gets all the menu items within a certain category
function getSpecificMenuItems($displayCategory)
{
    global $conn;
    $query = "SELECT * from menuitem where Category='$displayCategory' and isActive=1";
    return $conn->query($query);
}
//gets the category after the user selects a certain one
function getSpecifcCategory($displayCategory)
{
    global $conn;
    $query = "select * from categories where CategoryID='$displayCategory'";
    $result = $conn->query($query);
    return $result;
}
//variable to store the category selected by the user
$displayCategory = isset($_POST['categoryDisplay']) ? (int)$_POST['categoryDisplay'] : 0;

//generates the menu items and the category title accroding to user selection
function generateItems($displayCategory)
{
    if ($displayCategory === 0) {
        $items = getMenuItems();
        $categories = getCategories();
        foreach ($categories as $cate) {
            echo "<div class='menu-sections'>";
            echo "<h2 class='section-title'>" . $cate['Name'] . "</h2>";
            echo "<div class='menu-items'>";
            foreach ($items as $item) {
                if ($item['Category'] === $cate['CategoryID']) {
                    echo "
                <form class='card' style='width: 18rem;' method='post'>
                    <img src='" . $item['Photo'] . "' class='card-img-top' alt='" . $item['ItemName'] . "'>
                    <div class='card-body'>
                    <h6 class='card-title'>" . $item['ItemName'] . "</h6>
                    <p class='card-text menu-item-description'>" . $item['Description'] . "</p>
                    <p class='card-text'>$" . strval(number_format($item['Price'], 2, '.', "")) . "</p>
                    <div class='quantity-div'>
                        <input type='hidden' name='item_id' value='".$item['ItemNum']."'>
                        <label for='quantity'>Quantity:</label>
                        <input type='number' name='quantity' placeholder='0' class='quantity-input' min='0' max='20'/>
                        <button type='submit' class='btn btn-secondary add-btn'>+</button>
                    </div>
                    <div class='success-msg'>Successfully Added!</div>
                    </div>
                </form>
                ";
                }
            }
            echo "</div>";
            echo "</div>";
        }
    } else {
        $items = getSpecificMenuItems($displayCategory);
        $categories = getSpecifcCategory($displayCategory);
        $category = $categories->fetch_assoc();
        echo "<div class='menu-sections'>";
        echo "<h2 class='section-title'>" . $category['Name'] . "</h2>";
        echo "<div class='menu-items'>";
        foreach ($items as $item) {
            echo "
            <form class='card' style='width: 18rem;' method='post'>
                <img src='" . $item['Photo'] . "' class='card-img-top' alt='" . $item['ItemName'] . "'>
                <div class='card-body'>
                    <h6 class='card-title'>" . $item['ItemName'] . "</h6>
                    <p class='card-text menu-item-description'>" . $item['Description'] . "</p>
                    <p class='card-text'>$" . strval(number_format($item['Price'], 2, '.', "")) . "</p>
                    <div class='quantity-div'>
                        <input type='hidden' name='item_id' value='".$item['ItemNum']."'>
                        <label for='quantity'>Quantity:</label>
                        <input type='number' name='quantity' placeholder='0' class='quantity-input' min='0' max='20'/>
                        <button type='submit' class='btn btn-secondary add-btn'>+</button>
                    </div>
                    <div class='success-msg'>Successfully Added!</div>
                </div>
            </form>
            ";
        }
        echo "</div>";
        echo "</div>";
    }
}
generateItems($displayCategory);
