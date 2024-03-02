<?php
$server='localhost';
$un='root';
$p='';
$db='advwebproject';

$conn= new mysqli($server, $un, $p, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>