<?php
include('../config.php');

function getMenuItems()
{
    global $conn;
    $query = 'select * from menuitem';
    $result = $conn->query($query);
    $items = array();
    while ($row = $result->fetch_assoc()) {
        $items[] = $row;
    }
    return $items;
}

function getCategories()
{
    global $conn;
    $query = 'select * from categories';
    $result = $conn->query($query);
    $categories = array();
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }
    return $categories;
}

function getSpecificMenuItems($displayCategory)
{
    global $conn;
    $query = "select * from menuitem where Category='$displayCategory'";
    return $conn->query($query);
}

function getSpecifcCategory($displayCategory)
{
    global $conn;
    $query = "select * from categories where CategoryID='$displayCategory'";
    $result = $conn->query($query);
    return $result;
}

$displayCategory = isset($_POST['categoryDisplay']) ? (int)$_POST['categoryDisplay'] : 0;


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
                        <label for='quantity'>Quantity:</label>
                        <input type='number' name='quantity' placeholder='0' class='quantity-input'/>
                        <button type='submit' class='btn btn-secondary add-btn'>+</button>
                    </div>
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
        $category= $categories->fetch_assoc();
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
                        <label for='quantity'>Quantity:</label>
                        <input type='number' name='quantity' placeholder='0' class='quantity-input'/>
                        <button type='submit' class='btn btn-secondary add-btn'>+</button>
                    </div>
                    </div>
                </form>
                ";
                
            }
            echo "</div>";
            echo "</div>";
        }
}
echo generateItems($displayCategory);
// session_start();
$account=$_SESSION['account'];

function calcTotal(){
    global $conn;
    global $account;
    $query="select menuitem.Price, cart.Quantity from menuitem inner join cart on menuitem.ItemNum = cart.ItemNum where cart.AccountNum ='$account'";
    $result=$conn->query($query);
    $sum=0;
    if(mysqli_num_rows($result)!=0){
        while($row= mysqli_fetch_array($result)){
            $sum=$sum+($row['Price']*$row['Quantity']);
        }
    
    }
    echo "$".strval(number_format($sum, 2, '.', ""));
}

function addToCart($item, $quantity){
    global $account;
    global $conn;
    if(isset($_POST['quantity']) && $_POST['quantity']!==0 && $account!=null){
        $query="insert into cart values ('$item', '$account','$quantity') ";
        if($conn->query($query)){
            calcTotal();
        }
    }
    
}

