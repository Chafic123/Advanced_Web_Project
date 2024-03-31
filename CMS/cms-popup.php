<?php
if (session_status() != 2) {
    session_start();
}
if(isset($_SESSION['admin']) && $_SESSION['admin']==true){
?>

<div class="pop-up-container">
    <div class="pop-up">
        <button class="close-btn" id="close-btn">
            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512">
                <path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
            </svg>
        </button>
        <?php
        if(isset($_SESSION["success"])){
            echo "<h2>Success!</h2>
            <p>".$_SESSION["success"]."</p>";
            unset($_SESSION["success"]);    
        }else if (isset($_SESSION["message"])||(isset($_SESSION["message"])) && isset($_SESSION["success"])){
            echo "<h2>Error!</h2>
            <p>".$_SESSION["message"]."</p>";
            unset($_SESSION["message"]);
            unset($_SESSION["success"]);    
        }
        ?>
        </div>
</div>

<?php
}else{
    header("Location: ../Home/index.php");
}
?>