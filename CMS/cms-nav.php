<?php
echo '<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg" id="nav">
  <a class="navbar-brand" href="cms.php"><img src="../Malaz Design/Nav  Bar Logo - Not Bold.png" alt="Logo" id="logo"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0" id="navbarItem">
      <li class="nav-item active">
        <a class="nav-link" href="cms.php">Dashboard</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="cms-menu.php">Menu</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="cms-review.php">Reviews</a>
      </li>
    </ul>
    <span class="navbar-text">
        <button class="sign-out">Sign Out</button>
    </span>
  </div>
</nav>';
?>