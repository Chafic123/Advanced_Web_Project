<?php
if(session_status()!=2){
    session_start();
}
if(isset($_SESSION['admin']) && $_SESSION['admin']==true){ 
}else{
    header("Location: ../Home/index.php");
}