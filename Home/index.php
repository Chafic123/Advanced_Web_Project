<?php 

session_start();?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Malaz</title>
    <link rel="icon" href="../Malaz Design/Malaz---icon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="home-style.css">
    <link rel="stylesheet" href="../sign-style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/tw-cen-mt-std" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
</head>

<body>
    <?php
    require("../navbar.php");
    NavBar();
    require("../sign-forms.php");
    signForms();
    ?>
    <!-- Body -->
    <!-- main -->
    <main class="home-body transition-fade">
        <div class="home-wel">
            <img src="../Malaz Design/Main Logo (Picture Backgrounds) - Bold.png" alt="" class="main-logo" id="main-logo">
            <div class="logo-2">
                <img src="../Malaz Design/Malaz---icon cropped.png" class="text-logo">
                <img src="Asset 3.png" class="text-logo">
            </div>
            <h3 class="signing-options">
                <button>
                    <a href="#" class="login sign-links">Log In</a>
                    <span></span><span></span><span></span><span></span>
                </button>
                <button>
                    <a href="#" class="up sign-links">Sign Up</a>
                    <span></span><span></span><span></span><span></span><span></span>
                </button>
            </h3>
        </div>
    </main>
    <?php
    require('../footer.php');
    Footer();
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://unpkg.com/swup@4"></script>
    <script src="../main.js"></script>
    <script src="home.js"></script>
    <script src="../sign.js"></script>
</body>

</html>