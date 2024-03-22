<?php
if(session_status()!=2){
    session_start();
}
if(isset($_SESSION['admin']) && $_SESSION['admin']==true){
include '../config.php';

$sql = "SELECT Name FROM categories ORDER BY Name ASC";
$result = mysqli_query($conn, $sql);

$options = '<option value="" disabled selected>Select Category</option>';

while ($row = mysqli_fetch_assoc($result)) {
    $options .= '<option value="' . $row['Name'] . '">' . $row['Name'] . '</option>';
}

echo $options;

mysqli_close($conn);
}else{
    header("Location: ../Home/index.php");
}
?>
