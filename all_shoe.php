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

// Get selected category from the dropdown (default is 'All')
$selectedCategory = isset($_GET['category']) ? $_GET['category'] : 'All';

// Modify SQL query based on selected category
if ($selectedCategory === 'All') {
    $sql = "SELECT id, name, image_url, price, section FROM shoes";
} else {
    $sql = "SELECT id, name, image_url, price FROM shoes WHERE category = '" . $conn->real_escape_string($selectedCategory) . "'";
}

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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Products</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@600&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="all_shoe.css">
</head>
<body>

    <main>
        <h1>Our Products</h1>

        <!-- Dropdown filter -->
        <div class="filter">
            <form method="GET" action="">
                <label for="category">Filter by Category:</label>
                <select id="category" name="category" onchange="this.form.submit()">
                    <option value="All" <?php echo $selectedCategory === 'All' ? 'selected' : ''; ?>>All</option>
                    <option value="Men" <?php echo $selectedCategory === 'Men' ? 'selected' : ''; ?>>Men</option>
                    <option value="Women" <?php echo $selectedCategory === 'Women' ? 'selected' : ''; ?>>Women</option>
                    <option value="Kids" <?php echo $selectedCategory === 'Kids' ? 'selected' : ''; ?>>Kids</option>
                </select>
            </form>
        </div>

        <div class="product-grid">
            <?php if (!empty($shoes)): ?>
                <?php foreach ($shoes as $shoe): ?>
                    <div class="product">
                        <a href="view_shoe.php?id=<?php echo $shoe['id']; ?>">
                            <img src="<?php echo $shoe['image_url']; ?>" alt="<?php echo $shoe['name']; ?>">
                            <h2><?php echo $shoe['name']; ?></h2>
                            <p>$<?php echo $shoe['price']; ?></p>
                        </a>
                        <button>Add to Cart</button>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No products available in this category.</p>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>
