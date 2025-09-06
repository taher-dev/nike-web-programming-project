<?php
session_start();

// Check if the cart is initialized
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Handle Remove Item functionality
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_id'])) {
    $remove_id = (int) $_POST['remove_id'];

    // Remove the item with the given ID from the cart
    $_SESSION['cart'] = array_filter($_SESSION['cart'], function ($item) use ($remove_id) {
        return $item['id'] !== $remove_id;
    });

    // Reindex the array
    $_SESSION['cart'] = array_values($_SESSION['cart']);
}

// Database connection for user validation
$conn = mysqli_connect("localhost", "root", "", "login");

if (!$conn) {
    die("Connection Error: " . mysqli_connect_error());
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Cart</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: "Inter", sans-serif;
            background-color: #f5f5f5;
            color: #111;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            padding: 15px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #111;
            color: white;
        }

        .remove-btn {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
        }

        .remove-btn:hover {
            background-color: #c82333;
        }

        .checkout-btn {
            display: inline-block;
            padding: 15px 30px;
            background-color: #111;
            color: white;
            text-decoration: none;
            border-radius: 10px;
            font-size: 1.1em;
            text-align: center;
        }

        .checkout-btn:hover {
            background-color: #11111190;
        }

        .empty-cart {
            text-align: center;
            font-size: 1.2em;
            color: #666;
        }
    </style>
</head>

<body>
    <?php
    // Import navigation component.
    include 'components/navbar.php';
    ?>
    <div class="container">
        <h1>Your Cart</h1>
        <?php if (!empty($_SESSION['cart'])): ?>
            <table>
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $grandTotal = 0;
                    foreach ($_SESSION['cart'] as $item):
                        $totalPrice = $item['price'] * $item['quantity'];
                        $grandTotal += $totalPrice;
                        ?>
                        <tr>
                            <td><img src="<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>"
                                    style="width: 80px; height: auto;"></td>
                            <td><?php echo htmlspecialchars($item['name']); ?></td>
                            <td>$<?php echo number_format($item['price'], 2); ?></td>
                            <td><?php echo $item['quantity']; ?></td>
                            <td>$<?php echo number_format($totalPrice, 2); ?></td>
                            <td>
                                <form method="POST" action="">
                                    <input type="hidden" name="remove_id" value="<?php echo $item['id']; ?>">
                                    <button type="submit" class="remove-btn">Remove</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <h3 style="text-align: right;">Grand Total: $<?php echo number_format($grandTotal, 2); ?></h3>
            <div style="text-align: center;">
                <a href="logout.php" class="checkout-btn">Proceed to Checkout</a>
            </div>
        <?php else: ?>
            <p class="empty-cart">Your cart is empty.</p>
        <?php endif; ?>
    </div>
</body>

</html>