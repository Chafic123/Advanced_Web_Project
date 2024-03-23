<?php
if(session_status()!=2){
    session_start();
}
if(isset($_SESSION['admin']) && $_SESSION['admin']==true){ 
    function menuItemTable($result){
        global $conn;
        if ($result && ($result->num_rows > 0)) { 
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row["ItemName"] . '</td>';
                echo '<td>' . $row["Name"] . '</td>';
                echo '<td>' . $row["Description"] . '</td>';
                echo '<td>' . $row["Price"] . '</td>';
                echo '<td>' . $row["Photo"] . '</td>';
                if($row["IsActive"]==1){
                    echo '<td><input type="checkbox" name="active" class="active"  data-id="' .$row["ItemNum"]. '" checked></td>';
                }
                else{
                    echo '<td><input type="checkbox" name="active" class="active" data-id="' .$row["ItemNum"]. '"></td>';
                }
                echo '<td>
                <button type="button" class="btn btn-primary editm" data-bs-toggle="modal" data-bs-target="#edit" data-id="' .$row["ItemNum"]. '">Edit</button>
                <button type="button" class="btn btn-primary"><a href="delete-menu.php?id=' . $row["ItemNum"] . '" style="color:white; text-decoration:none;">Delete</a></button>
                </td>';
                echo '</tr>';
            }
            $conn->close();
        } else {
            echo "0 results";
        }
    }

    include '../config.php';
    $query = "SELECT * FROM menuitem inner join categories on menuitem.Category=categories.CategoryID where 1=1 ";

    $search=false;
    $category=false;
    $catID=null;
    $seachin=null;

    if(isset($_POST['search']) && !empty($_POST['search'])) {
        $search=true;
        $seachin=$_POST['search'].'%';
    }
    if(isset($_POST['category']) && $_POST['category']!='All') {
        //  Get CategoryID
        $q = "SELECT CategoryID FROM categories where Name LIKE ?";
        $stmt=$conn->prepare($q);
        $stmt->bind_param("s", $_POST['category']);
        $stmt->execute();
        $res = $stmt->get_result();
        if ($res && ($res->num_rows > 0)) { 
            while ($row = $res->fetch_assoc()) {
                $catID = $row['CategoryID'];
            }
        }
        $stmt->close();

        $category=true;
    }

    if($search && $category) {
        $query.="and ItemName like ? and Category=? ORDER BY ItemNum DESC;";
        if ($stmt=$conn->prepare($query)){
            $stmt->bind_param("si", $seachin, $catID);
            $stmt->execute();
            $result = $stmt->get_result();
            menuItemTable($result);
        }
    }
    else if ($search) {
        $query.="and ItemName like ? ORDER BY ItemNum DESC;";
        if ($stmt=$conn->prepare($query)){
            $stmt->bind_param("s", $seachin);
            $stmt->execute();
            $result = $stmt->get_result();
            menuItemTable($result);
        }
    }
    else if ($category) {
        $query.="and Category=? ORDER BY ItemNum DESC;";
        $stmt=$conn->prepare($query);
        $stmt->bind_param("i", $catID);
        $stmt->execute();
        $result = $stmt->get_result();
        menuItemTable($result);
    }
    else{
        $query = "SELECT * FROM menuitem inner join categories on menuitem.Category=categories.CategoryID where 1=1 ORDER BY ItemNum DESC;";
        $result = $conn->query($query);
        menuItemTable($result);
    }
        
}else{
    header("Location: ../Home/index.php");
}