<?php
// Start the session to access login status.
// This makes the navbar a self-contained component.
session_start();
?>

<nav>
    <img src="https://upload.wikimedia.org/wikipedia/commons/a/a6/Logo_NIKE.svg" alt="Nike Logo" class="logo"
        onclick="window.location.href='index.php'" />

    <div class="nav-links">
        <a href="all_shoe.php?category=Men">Men</a>
        <a href="all_shoe.php?category=Women">Women</a>
        <a href="all_shoe.php?category=Kids">Kids</a>
        <?php
        // Check if the user is logged in
        if (isset($_SESSION['email'])) {
            // If logged in, show a link to the profile page
            echo '<a href="profile.php">Profile</a>';
        } else {
            // If not logged in, show the sign-in link
            echo '<a href="sign_in.php">Sign in</a>';
        }
        ?>
    </div>

    <div class="nav-icons">
        <div class="search-bar-wrapper">
            <div class="search-bar">
                <img src="img/search1.svg" alt="Search Icon" />
                <input type="text" id="search-input" placeholder="Search" oninput="searchShoes()"
                    onfocus="toggleSuggestions(true)" onblur="hideSuggestions()" />
            </div>
            <div id="suggestions" class="suggestions"></div>
        </div>
        <a href="#" class="favorite"><img src="img/heart-svgrepo-com (1).svg" alt="Favorite Icon" /></a>
        <a href="view_cart.php" class="cart"><img src="img/shopping-bag-svgrepo-com.svg" alt="Cart Icon" /></a>
    </div>

    <div class="hamburger" id="hamburger">☰</div>
</nav>

<div class="mobile-nav" id="mobileNav">
    <div class="close-btn" id="closeBtn">&times;</div>

    <div class="mobile-nav-icons">
        <a href="#"><img src="img/search-alt-1-svgrepo-com (1).svg" alt="Search Icon" /></a>
        <a href="#"><img src="img/heart-svgrepo-com (1).svg" alt="Favorite Icon" /></a>
        <a href="#"><img src="img/shopping-bag-svgrepo-com.svg" alt="Cart Icon" /></a>
    </div>

    <div class="mobile-nav-links">
        <a href="all_shoe.php?category=Men">Men</a>
        <a href="all_shoe.php?category=Women">Women</a>
        <a href="all_shoe.php?category=Kids">Kids</a>
        <?php
        // Use the same logic for the mobile menu
        if (isset($_SESSION['email'])) {
            echo '<a href="profile.php">Profile</a>';
        } else {
            echo '<a href="sign_in.php">Sign in</a>';
        }
        ?>
    </div>
</div>

<div class="overlay" id="overlay"></div>