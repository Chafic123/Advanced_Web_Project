<?php
if (session_status() != 2) {
    session_start();
}
if(isset($_SESSION['admin']) && $_SESSION['admin']==true){
echo '<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="cms.php">Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="cms-review.php">Reviews</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Menu
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="cms-addmenuform.php">Add to Menu</a></li>
                            <li><a class="dropdown-item" href="cms-viewmenu.php">View Menu</a></li>
                        </ul>
                    </li>
                </ul>
                <form action="../signout.php" method="post" class="d-flex">
                    <button id="sign-out-btn2" class="sign-out btn btn-outline-light" name="signout">Sign Out</button>
                </form>
            </div>
        </div>
    </nav>';
?>
<?php
}else{
    header("Location: ../Home/index.php");
}
?>