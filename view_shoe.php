<?php
session_start();

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

// Initialize the cart if it doesn't exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Handle Add to Cart
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['shoe_id'])) {
    $shoe_id = (int) $_POST['shoe_id'];
    $shoe_name = $_POST['shoe_name'];
    $shoe_price = (float) $_POST['shoe_price'];
    $shoe_image = $_POST['shoe_image'];

    // Check if the item is already in the cart
    $item_exists = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] === $shoe_id) {
            $item['quantity'] += 1; // Increment quantity if item already exists
            $item_exists = true;
            break;
        }
    }

    // If item doesn't exist, add it to the cart
    if (!$item_exists) {
        $_SESSION['cart'][] = [
            'id' => $shoe_id,
            'name' => $shoe_name,
            'price' => $shoe_price,
            'image' => $shoe_image,
            'quantity' => 1
        ];
    }

    // Redirect back to the same page to prevent resubmission
    header("Location: view_shoe.php?id=" . $shoe_id);
    exit();
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
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="view_shoe.css">
</head>

<body>
    <?php
    // Import navigation component.
    include 'components/navbar.php';
    ?>
    <div class="container">
        <?php if ($shoe): ?>
            <div class="shoe-card">
                <div class="shoe-card-left">
                    <img src="<?php echo htmlspecialchars($shoe['image_url']); ?>"
                        alt="<?php echo htmlspecialchars($shoe['name']); ?>">
                </div>
                <div class="shoe-card-right">
                    <h1><?php echo htmlspecialchars($shoe['name']); ?></h1>
                    <p><?php echo htmlspecialchars($shoe['category']); ?></p>
                    <p>$<?php echo htmlspecialchars(number_format($shoe['price'], 2)); ?></p>

                    <div class="action-buttons">
                        <!-- Add to Cart Form -->
                        <form method="POST" action="">
                            <input type="hidden" name="shoe_id" value="<?php echo $shoe['id']; ?>">
                            <input type="hidden" name="shoe_name" value="<?php echo $shoe['name']; ?>">
                            <input type="hidden" name="shoe_price" value="<?php echo $shoe['price']; ?>">
                            <input type="hidden" name="shoe_image" value="<?php echo $shoe['image_url']; ?>">
                            <button type="submit" class="cart-btn">Add to Cart</button>
                        </form>

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