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

  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" href="style.css">

  <style>
    .favorite,
    .cart {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 40px;
      height: 40px;
      border-radius: 50%;
    }

    a.favorite:hover,
    a.cart:hover {
      background-color: #11111120;
    }

    #page-4 {
      min-height: 100vh;
      width: 100%;
      position: relative;
      z-index: 8;
    }

    .page-4-wrapper {
      background-color: #111;
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin: 0 120px;
      border-radius: 30px;
    }

    .page-4-wrapper img {
      width: 50%;
      height: 60vh;
      object-fit: cover;
      object-position: center;
      border-radius: 30px;
    }

    .hide {
      display: none;
    }

    .page-4-left {
      display: flex;
      flex-direction: column;
      margin: 4vw auto auto auto;
      text-wrap: pretty;
      font-weight: 200;
      font-size: 2.2rem;
      line-height: 4.3rem;
    }

    .page-4-left-top h1 {
      font-size: 40px;
      cursor: pointer;
      padding-left: 1rem;
      color: #ffffff70;
      border-left: 3px solid #ffffff70;
    }

    .page-4-left h1:nth-child(3) {
      margin-bottom: 3rem;
    }

    .page-4-left-bottom p {
      color: #ffffff99;
      max-width: 30ch;
      font-size: 1.1rem;
      line-height: 1.5rem;
    }

    .select {
      color: #fff !important;
      border-left: 3px solid #fff !important;
    }
  </style>

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



      <a href="#" class="favorite"><img src="img/heart-svgrepo-com (1).svg" alt="Favorite Icon" /></a>
      <a href="#" class="cart"><img src="img/shopping-bag-svgrepo-com.svg" alt="Cart Icon" /></a>
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

  <div id="page-4">
    <div class="page-4-wrapper">
      <div class="page-4-left">
        <div class="page-4-left-top">
          <h1 id="design-h1" class="select">Nike X Dior</h1>
          <h1 id="project-h1" class="">Nike X One Piece</h1>
          <h1 id="execution-h1" class="">Nike X Tiffany & Co.</h1>
        </div>
        <div class="page-4-left-bottom">
          <p class="design-p">
            Handcrafted in Italy from calfskin leather and accented with Dior's signature Oblique monogram jacquard
            Swooshes. Dior and Air Jordan's iconic branding are mixed on the Wings logo, tongue labels and outsole
            graphics.
          </p>
          <p class="project-p hide">
            Gear up for adventure with Nike x ONE PIECE. This collab blends Nike's classic street style with One Piece’s
            island-hopping sense of adventure.
          </p>
          <p class="execution-p hide">
            The Nike/Tiffany Air Force 1 1837 is crafted in premium black suede with a Tiffany Blue® Swoosh and archival
            Tiffany logo on the tongue.
          </p>
        </div>
      </div>
      <img src="img/collab/nike_x_dior.jpg" alt="Nike X Dior" loading="lazy" class="" />
      <img src="img/collab/nike_x_onepiece.png" alt="Nike X One Piece" loading="lazy" class="hide" />
      <img src="img/collab/nike_x_tiffany_&_co.webp" alt="Nike X Tiffany & Co" loading="lazy" class="hide" />
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

  <script type="module" src="collab.js"></script>

  <script src="script.js"></script>
</body>

</html>