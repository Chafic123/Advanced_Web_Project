<?php
include 'config.php';

$sql = "SELECT Name FROM categories";
$result = mysqli_query($conn, $sql);

$options = '<option value="">All</option>';

while ($row = mysqli_fetch_assoc($result)) {
    $options .= '<option value="' . $row['Name'] . '">' . $row['Name'] . '</option>';
}

echo $options;

mysqli_close($conn);
?>
