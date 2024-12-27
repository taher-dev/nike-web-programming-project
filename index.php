<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nike";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Fetch shoe data from database
$sql = "SELECT id, name, image_url, section FROM shoes";
$result = $conn->query($sql);
$shoes = [];
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $shoes[] = $row;
  }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Nike - Just Do It</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@600&display=swap" rel="stylesheet" />

  <link rel="stylesheet" href="style.css">
</head>

<body>
  <!-- Main Navigation Bar -->
  <nav>
    <!-- Nike Logo -->
    <img src="https://upload.wikimedia.org/wikipedia/commons/a/a6/Logo_NIKE.svg" alt="Nike Logo" class="logo"
      onclick="window.location.reload()" />

    <!-- Centered Links (Hidden on mobile) -->
    <div class="nav-links">
      <a href="all_shoe.php?category=Men">Men</a>
      <a href="all_shoe.php?category=Women">Women</a>
      <a href="all_shoe.php?category=Kids">Kids</a>
      <a href="#">Sign in</a>
    </div>

    <!-- Right Icons (Hidden on mobile) -->
    <div class="nav-icons">

      <div class="search-bar-wrapper">
        <div class="search-bar">
          <img src="img/search1.svg" alt="Search Icon" />
          <input type="text" id="search-input" placeholder="Search" oninput="searchShoes()"
            onfocus="toggleSuggestions(true)" onblur="hideSuggestions()" />
        </div>
        <div id="suggestions" class="suggestions"></div>
      </div>



      <a href="#"><img src="img/heart-svgrepo-com (1).svg" alt="Favorite Icon" /></a>
      <a href="#"><img src="img/shopping-bag-svgrepo-com.svg" alt="Cart Icon" /></a>
    </div>

    <!-- Hamburger Icon (Visible on mobile) -->
    <div class="hamburger" id="hamburger">☰</div>
  </nav>

  <!-- Sliding Mobile Navigation Menu with Close Button -->
  <div class="mobile-nav" id="mobileNav">
    <!-- Close Button -->
    <div class="close-btn" id="closeBtn">&times;</div>

    <!-- Icons at the top -->
    <div class="mobile-nav-icons">
      <a href="#"><img src="img/search-alt-1-svgrepo-com (1).svg" alt="Search Icon" /></a>
      <a href="#"><img src="img/heart-svgrepo-com (1).svg" alt="Favorite Icon" /></a>
      <a href="#"><img src="img/shopping-bag-svgrepo-com.svg" alt="Cart Icon" /></a>
    </div>

    <!-- Vertical Links -->
    <div class="mobile-nav-links">
      <a href="#">Men</a>
      <a href="#">Women</a>
      <a href="#">Kids</a>
      <a href="#">Sign in</a>
    </div>
  </div>

  <!-- Tinted and Blurred Overlay -->
  <div class="overlay" id="overlay"></div>

  <main class="hero">
    <h1 class="hero-title bebas-neue-regular">NIKE AIR</h1>
    <div class="hero-blob-container">
      <div class="hero-blob blob-1"></div>
      <div class="hero-blob blob-2"></div>
    </div>
    <img class="hero-img" src="img/nike-hero (1).svg" alt="Nike Air" />
    <div class="hero-bottom">
      <div class="hero-bottom-left">
        <button class="hero-btn"><a href="view_shoe.php?id=7">Buy Now</a></button>
      </div>
      <div class="hero-bottom-right">
        <p>
          The Nike Air Force 1 Mid LE brings back the ‘82 hardwood icon into
          an everyday style in all-white or all-black.
        </p>
      </div>
    </div>
  </main>

  <section id="new-arrivals">
    <div id="sec-1-title">
      <div class="title-circle"></div>
      <h5>NEW & FEATURED</h5>
    </div>
    <div class="slider-container">
      <button class="slider-button prev" onclick="prevSlide()">
        <img src="img/prev.svg" alt="Previous" />
      </button>
      <div class="slider">
        <?php
        $new_shoes = array_filter($shoes, function ($shoe) {
          return isset($shoe['section']) && $shoe['section'] === 'new';
        });
        ?>
        <?php if (!empty($new_shoes)): ?>
          <?php foreach ($new_shoes as $shoe): ?>
            <div class="slide">
              <a href="view_shoe.php?id=<?php echo htmlspecialchars($shoe['id']); ?>">
                <img src="<?php echo htmlspecialchars($shoe['image_url']); ?>"
                  alt="<?php echo htmlspecialchars($shoe['name']); ?>" />
                <h3><?php echo htmlspecialchars($shoe['name']); ?></h3>
              </a>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <p>No new shoes available at the moment.</p>
        <?php endif; ?>
      </div>
      <button class="slider-button next" onclick="nextSlide()">
        <img src="img/next.svg" alt="Next" />
      </button>
    </div>
  </section>

  <div id="moving-text">
    <div class="moving-text-container">
      <h1>JUST DO IT</h1>
      <div class="moving-circle"></div>
      <h1>NIKE</h1>
      <div class="moving-circle"></div>
      <h1>CLASSIC</h1>
      <div class="moving-circle"></div>
    </div>
    <div class="moving-text-container">
      <h1>JUST DO IT</h1>
      <div class="moving-circle"></div>
      <h1>NIKE</h1>
      <div class="moving-circle"></div>
      <h1>CLASSIC</h1>
      <div class="moving-circle"></div>
    </div>
  </div>

  <!-- Footer Section -->
  <footer class="footer">
    <div class="footer-container">
      <!-- Footer Logo -->
      <div class="footer-logo">
        <img src="img/nike-hero (1).svg" alt="Nike Logo" class="logo" />
        <!-- <p>Just Do It. Innovating for the future.</p> -->
      </div>

      <!-- About Us -->
      <div class="footer-about">
        <h3>About Nike</h3>
        <p>
          Nike brings inspiration and innovation to every athlete in the
          world.
        </p>
      </div>

      <!-- Quick Links -->
      <div class="footer-links">
        <h3>Explore</h3>
        <ul>
          <li><a href="all_shoe.php?category=Men">Men</a></li>
          <li><a href="all_shoe.php?category=Women">Women</a></li>
          <li><a href="all_shoe.php?category=Kids">Kids</a></li>
          <li><a href="#new-arrivals">New Arrivals</a></li>
        </ul>
      </div>

      <!-- Contact Info -->
      <div class="footer-contact">
        <h3>Contact Us</h3>
        <p>Email: support@nike.com</p>
        <p>Phone: +1-800-555-1234</p>
        <p>Address: 1 Bowerman Drive, Beaverton, OR 97005, USA</p>
      </div>

      <!-- Social Media Links -->
      <div class="footer-social">
        <h3>Connect with Us</h3>
        <div class="social-icons">
          <a href="#"><img src="img/facebook.svg" alt="Facebook" /></a>
          <a href="#"><img src="img/twitter.svg" alt="Twitter" /></a>
          <a href="#"><img src="img/instagram.svg" alt="Instagram" /></a>
          <a href="#"><img src="img/youtube.svg" alt="YouTube" /></a>
        </div>
      </div>
    </div>

    <!-- Footer Bottom -->
    <div class="footer-bottom">
      <p>&copy; 2024 Nike. All Rights Reserved.</p>
      <p>Designed by Mihad, Monmoy, Abdullah.</p>
    </div>
  </footer>

  <script>
    // Search Bar Start

    function searchShoes() {
      const query = document.getElementById("search-input").value;
      const suggestions = document.getElementById("suggestions");

      if (query.length === 0) {
        suggestions.style.display = "none"; // Hide when input is empty
        return;
      }

      const xhr = new XMLHttpRequest();
      xhr.open("GET", `search_shoes.php?query=${encodeURIComponent(query)}`, true);
      xhr.onload = function () {
        if (xhr.status === 200) {
          suggestions.innerHTML = xhr.responseText;
          suggestions.style.display = "block"; // Show suggestions
        }
      };
      xhr.send();
    }

    function toggleSuggestions(show) {
      const suggestions = document.getElementById("suggestions");
      if (show) {
        suggestions.style.display = "block";
      }
    }

    function hideSuggestions() {
      setTimeout(() => {
        const suggestions = document.getElementById("suggestions");
        suggestions.style.display = "none"; // Hide after a brief delay
      }, 200); // Delay to allow click events to register
    }

    // Search Bar End
  </script>

  <script src="script.js"></script>
</body>

</html>