<?php
function NavBar(){
echo"
<!-- Navigation Bar -->
    <nav class='nav-bar nav-1' id='nav-bar'>
        <a href='../Home/index.php' class='nav-options logo'><img src='../Malaz Design/Nav  Bar Logo - Not Bold.png' alt='Logo'
                class='logo-img'></a>
        <a href='../Home/index.php' class='nav-options'>Home</a>
        <a href='../About/about.php' class='nav-options'>About Us</a>
        <a href='../Menu/menu.php' class='nav-options'>Menu</a>
        <a href='../Contact/contact.php' class='nav-options'>Contact Us</a>
        <a href='../Review/review.php' class='nav-options'>Leave a review</a>
        <svg class='account-icon account-icons' id='account-icon' xmlns='http://www.w3.org/2000/svg' height='1em'
            viewBox='0 0 448 512'>
            <path
                d='M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z' />
        </svg>
        <div class='account' id='account'>
            <ul class='signed-out account-section'>
                <li><a href='#' class='login'>Log In</a></li>
                <li><a href='#' class='up'>Sign Up</a></li>
            </ul>
            <ul class='account-info account-section'>
                <li>
                    <div class='account-info_div'>
                        <h4 id='username-text'>Username</h4>
                        <a href='../Cart/cart.php' class='cart-btn'>
                            <svg class='account-icons' class='cart-icon' xmlns='http://www.w3.org/2000/svg' height='1em'
                                viewBox='0 0 576 512'>
                                <path
                                    d='M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z' />
                            </svg>
                        </a>
                    </div>
                </li>
                <li><button id='sign-out-btn'>Sign Out</button></li>
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
                <li><a href='../Home/index.php' class='nav-options-nav2'>Home</a></li>
                <li><a href='../About/about.php' class='nav-options-nav2'>About Us</a></li>
                <li><a href='../Menu/menu.php' class='nav-options-nav2'>Menu</a></li>
                <li><a href='../Contact/contact.php' class='nav-options-nav2'>Contact Us</a></li>
                <li><a href='../Review/review.php' class='nav-options-nav2'>Leave a review</a></li>
            </ul>
            <ul class='signed-out account-section'>
                <li><a href='#' class='login'>Log In</a></li>
                <li><a href='#' class='up'>Sign Up</a></li>
            </ul>
            <ul class='account-info account-section'>
                <li>
                    <div class='account-info_div'>
                        <h4 id='username-text2'>Username</h4>
                        <a href='../Cart/cart.php' class='cart-btn'>
                            <svg class='account-icons' class='cart-icon' xmlns='http://www.w3.org/2000/svg' height='1em'
                                viewBox='0 0 576 512'>
                                <path
                                    d='M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z' />
                            </svg>
                        </a>
                    </div>
                </li>
                <li><button id='sign-out-btn2'>Sign Out</button></li>
            </ul>
        </div>
    </nav>
";
}
?>