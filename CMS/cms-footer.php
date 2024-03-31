<!-- Footer -->
<?php
if(session_status()!=2){
    session_start();
}
if(isset($_SESSION['admin']) && $_SESSION['admin']==true){
?>
<footer class='footer'>
    <div class='footer-p1'>
        <img src='../Malaz Design/Footer Logo.png' alt='Logo' class='footer-logo'>
    </div>
    <div class='footer-p2'>
        <p class='copyright'>&copy; 2023 Malaz Copyright</p>
    </div>
</footer>
<?php
}else{
    header("Location: ../Home/index.php");
}
?>