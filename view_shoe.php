<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nike";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the shoe ID from the query string
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch shoe data
$sql = "SELECT * FROM shoes WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

$shoe = $result->fetch_assoc();

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nike - View Shoe</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@600&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="view_shoe.css">
</head>
<body>
<div class="container">
    <?php if ($shoe): ?>
        <div class="shoe-card">
            <div class="shoe-card-left">
            <img src="<?php echo htmlspecialchars($shoe['image_url']); ?>" alt="<?php echo htmlspecialchars($shoe['name']); ?>">
            </div>
            <div class="shoe-card-right">
            <h1><?php echo htmlspecialchars($shoe['name']); ?></h1>
            <p><?php echo htmlspecialchars($shoe['category']); ?></p>
            <p>$<?php echo htmlspecialchars(number_format($shoe['price'], 2)); ?></p>

            <!-- Action Buttons -->
            <div class="action-buttons">
                <a class="cart-btn" href="cart.php?add=<?php echo $shoe['id']; ?>">Add to Cart</a>
                <a class="back-btn" href="index.php">Go Back</a>
            </div>
            </div>
        </div>
    <?php else: ?>
        <p>Shoe not found.</p>
    <?php endif; ?>
</div>

</body>
</html>
