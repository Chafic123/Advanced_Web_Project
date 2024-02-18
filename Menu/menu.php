<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Malaz</title>
    <link rel="icon" href="../Malaz Design/Malaz---icon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="menu-style.css">
    <link rel="stylesheet" href="../sign-style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/tw-cen-mt-std" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <?php
    require("../navbar.php");
    NavBar();
    require("../sign-forms.php");
    signForms();
    ?>
    <!-- Body -->
    <main class="menu-body transition-fade">
        <div class="menu-title">
            <h1>Savor the Moments <br> Our Delicious Menu Awaits</h1>
        </div>
        <div class="menu-main">
            <!-- Menu Navigation -->
            <nav class="menu-nav">
                <!-- Menu section -->
                <div class="menu-section-nav">
                    <a href="#starters" class="menu-section-links">Starters</a>
                </div>
                <!-- Menu section -->
                <div class="menu-section-nav main-section-nav">
                    <a href="#main-dishes" class="menu-section-links">Main Dishes</a>
                    <ul class="main-items-list">
                        <!-- Menu subsection -->
                        <li class="main-items-options"><a href="#platters" class="main-items-links">
                            Platters
                        </a></li>
                        <!-- Menu subsection -->
                        <li class="main-items-options"><a href="#sandwiches" class="main-items-links">
                                Sandwiches
                            </a></li>
                        <!-- Menu subsection -->
                        <li class="main-items-options"><a href="#burgers" class="main-items-links">
                                Burgers
                            </a></li>
                        <!-- Menu subsection -->
                        <li class="main-items-options"><a href="#pasta" class="main-items-links">
                                Pasta
                            </a></li>
                        <!-- Menu subsection -->
                        <li class="main-items-options"><a href="#pizza" class="main-items-links">
                                Pizza
                            </a></li>
                        <!-- Menu subsection -->
                        <li class="main-items-options"><a href="#salads" class="main-items-links">
                                Salads
                            </a></li>
                    </ul>
                </div>
                <!-- Menu section -->
                <div class="menu-section-nav">
                    <a href="#kids-meals" class="menu-section-links">Kids Meals</a>
                </div>
                <!-- Menu section -->
                <div class="menu-section-nav">
                    <a href="#desserts" class="menu-section-links">Desserts</a>
                </div>
                <!-- Menu section -->
                <div class="menu-section-nav bev-section-nav">
                    <a href="#beverages" class="menu-section-links">Beverages</a>
                    <ul class="beverages-items-list">
                        <!-- Menu subsection -->
                        <li class="bev-items-options"><a href="#hot" class="bev-items-links">
                                Hot Beverages
                            </a></li>
                        <!-- Menu subsection -->
                        <li class="bev-items-options"><a href="#cold" class="bev-items-links">
                                Cold Beverages
                            </a></li>
                    </ul>
                </div>
                <!-- Cart button for bigger screens -->
                <a href="cart.html" id="cart-btn-menu">
                    <svg id="cart-icon-menu" xmlns="http://www.w3.org/2000/svg" height="1em"
                        viewBox="0 0 576 512">
                        <path
                            d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z" />
                    </svg>
                </a>
            </nav>
            <!-- Menu Navigation on Smaller screens -->
            <nav class="menu-nav-2">
                <ul>
                    <li><a href="#starters">Starters</a></li>
                    <li><a href="#platters">Platters</a></li>
                    <li><a href="#sandwiches">Sandwiches</a></li>
                    <li><a href="#burgers">Burgers</a></li>
                    <li><a href="#pasta">Pasta</a></li>
                    <li><a href="#pizza">Pizza</a></li>
                    <li><a href="#salads">Salads</a></li>
                    <li><a href="#kids-meals">Kids Meals</a></li>
                    <li><a href="#desserts">Desserts</a></li>
                    <li><a href="#hot">Hot Beverages</a></li>
                    <li><a href="#cold">Cold Beverages</a></li>
                </ul>
            </nav>
            <!-- Actual Menu -->
            <div class="menu" id="menu">
                <!-- Menu Items Will be Displayed Here -->
                <?php
                    require("menu-repository.php");
                    generateItems();
                ?>
            </div>
        </div>
        <!-- Up and Down Buttons -->
        <div class="up-down">
            <!-- Cart is only displayed here on smaller screens -->
            <a href="cart.html" class="small-cart">
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" style="fill: white;"
                    viewBox="0 0 576 512">
                    <path
                        d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z" />
                </svg>
            </a>
            <!-- Up btn -->
            <svg class="up-down-btns" id="up-btn" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                <style>
                    svg {
                        fill: #ffffff
                    }
                </style>
                <path
                    d="M201.4 137.4c12.5-12.5 32.8-12.5 45.3 0l160 160c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L224 205.3 86.6 342.6c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l160-160z" />
            </svg>
            <!-- Down Btn -->
            <svg class="up-down-btns" id="down-btn" xmlns="http://www.w3.org/2000/svg" height="1em"
                viewBox="0 0 448 512">
                <style>
                    svg {
                        fill: #ffffff
                    }
                </style>
                <path
                    d="M201.4 342.6c12.5 12.5 32.8 12.5 45.3 0l160-160c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L224 274.7 86.6 137.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l160 160z" />
            </svg>
        </div>
        <!-- Checkout -->
        <div class="checkout">
            <h2 class="total-title">Total:</h2>
            <p class="total-price">$ 0.00</p>
            <button class="checkout-btn">
                <svg id="checkout-icon" title="Checkout" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" style="fill:black;"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M64 0C46.3 0 32 14.3 32 32V96c0 17.7 14.3 32 32 32h80v32H87c-31.6 0-58.5 23.1-63.3 54.4L1.1 364.1C.4 368.8 0 373.6 0 378.4V448c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V378.4c0-4.8-.4-9.6-1.1-14.4L488.2 214.4C483.5 183.1 456.6 160 425 160H208V128h80c17.7 0 32-14.3 32-32V32c0-17.7-14.3-32-32-32H64zM96 48H256c8.8 0 16 7.2 16 16s-7.2 16-16 16H96c-8.8 0-16-7.2-16-16s7.2-16 16-16zM64 432c0-8.8 7.2-16 16-16H432c8.8 0 16 7.2 16 16s-7.2 16-16 16H80c-8.8 0-16-7.2-16-16zm48-168a24 24 0 1 1 0-48 24 24 0 1 1 0 48zm120-24a24 24 0 1 1 -48 0 24 24 0 1 1 48 0zM160 344a24 24 0 1 1 0-48 24 24 0 1 1 0 48zM328 240a24 24 0 1 1 -48 0 24 24 0 1 1 48 0zM256 344a24 24 0 1 1 0-48 24 24 0 1 1 0 48zM424 240a24 24 0 1 1 -48 0 24 24 0 1 1 48 0zM352 344a24 24 0 1 1 0-48 24 24 0 1 1 0 48z"/></svg>
                <h5>Checkout</h5>
            </button>
        </div>
    </main>
    <?php
    require('../footer.php');
    Footer();
    ?>
    <!-- Pop-up Msg -->
    <div class="pop-up-container">
        <div class="pop-up">
            <button class="close-btn" id="close-btn">
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/></svg>
            </button>
            <h2>Login</h2>
            <p>Please Login to Continue</p>
            <button id="login-btn" class="login">Login</button>
        </div>
    </div>
    <!--Script tags-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://unpkg.com/swup@4"></script>
    <script src="../main.js"></script>
    <script src="menu.js"></script>
    <script src="../sign.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>