<?php
include "config.php";
if(session_status()!=2){
    session_start();
}
function getFirstName()
{
    global $conn;
    if (isset($_SESSION['id'])) {
        $account = $_SESSION['id'];
        $query = "SELECT FirstName from account where AccountNum =?";
        $stmt = $conn->prepare($query);
        if (!$stmt) {
            return;
        }
        $stmt->bind_param("i", $account);
        $stmt->execute();
        $stmt->bind_result($name);
        $stmt->fetch();
        $stmt->close();
        echo $name;
    }
    echo "";
}

function NavBar()
{
    $account = isset($_SESSION['id'])?($_SESSION['id']):(3);
    echo "
<!-- Navigation Bar -->
    <nav class='nav-bar nav-1' id='nav-bar'>
        <a href='../Home/index.php' class='nav-options logo'><img src='../Malaz Design/Nav  Bar Logo - Not Bold.png' alt='Logo'
                class='logo-img'></a>
        <a href='../Home/index.php' class='nav-options'>Home</a>
        <a href='../About/about.php' class='nav-options'>About Us</a>
        <a href='../Menu/menu.php' class='nav-options'>Menu</a>
        <a href='../Contact/contact.php' class='nav-options'>Contact Us</a>
        <a href='../Review/review.php' class='nav-options'>Leave a review</a>
        <svg class='account-icon account-icons' id='account-icon' xmlns='http://www.w3.org/2000/svg' width='35px' height='35px' fill='currentColor' class='bi bi-list' viewBox='0 0 20 20'>
            <path fill-rule='evenodd' d='M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5'/>
        </svg>
        <div class='account' id='account'>
            <ul class='main-ul'>";
    if ($account===3) {
        echo "
                <li><a href='#' class='login signing-btns'>Log In</a></li>
                <li><a href='#' class='up signing-btns'>Sign Up</a></li>
                ";
    } else {
        echo "<li>
                <div class='account-info_div'>
                    <h4 id='username-text'>";
        getFirstName();
        echo "</h4>
                    <a href='../Cart/cart.php' class='cart-btn'>
                        <svg class='account-icons' class='cart-icon' xmlns='http://www.w3.org/2000/svg' height='1em' style='fill: black; font-size: 1.5em;'
                            viewBox='0 0 576 512'>
                            <path
                                d='M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z' />
                        </svg>
                    </a>
                </div>
            </li>
            <li style='text-align: center;'><button id='sign-out-btn' class='sign-out'>Sign Out</button></li>";
    }
    echo "
            </ul>
        </div>
    </nav>
    <!-- Smaller screen nav -->
    <nav class='nav-2'>
        <a href='../Home/index.php' class='nav-options logo'><img src='../Malaz Design/Nav  Bar Logo - Not Bold.png' alt='Logo'
                class='logo-img'></a>
        <button class='drop-nav-bar'>
            <svg id='dropdown-menu' xmlns='http://www.w3.org/2000/svg' height='2em' viewBox='0 0 448 512'><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#fafafa}</style><path d='M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z'/></svg>
        </button>
        <div class='nav-items'>
            <ul>
                <li class='nav-2-li'><a href='../Home/index.php' class='nav-options-nav2'>Home</a></li>
                <li class='nav-2-li'><a href='../About/about.php' class='nav-options-nav2'>About Us</a></li>
                <li class='nav-2-li'><a href='../Menu/menu.php' class='nav-options-nav2'>Menu</a></li>
                <li class='nav-2-li'><a href='../Contact/contact.php' class='nav-options-nav2'>Contact Us</a></li>
                <li id='last'><a href='../Review/review.php' class='nav-options-nav2'>Leave a review</a></li>";
    if ($account===3) {
        echo "
                    <li><a href='#' class='login signing-btns'>Log In</a></li>
                    <li><a href='#' class='up signing-btns'>Sign Up</a></li>
                    ";
    } else {
        echo "<li>
                    <div class='account-info_div'>
                        <h4 id='username-text2'>";
        getFirstName();
        echo "</h4>
                        <a href='../Cart/cart.php' class='cart-btn'>
                            <svg class='account-icons' class='cart-icon' xmlns='http://www.w3.org/2000/svg' height='1em' style='fill: black; font-size: 1.5em;'
                                viewBox='0 0 576 512'>
                                <path
                                    d='M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z' />
                            </svg>
                        </a>
                    </div>
                </li>
                <li style='text-align: center;' ><button id='sign-out-btn2' class='sign-out'>Sign Out</button></li>";
    }
    echo "
            </ul>
            
        </div>
    </nav>
";
}
