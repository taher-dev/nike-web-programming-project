<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nike";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = $_GET['query'] ?? '';
$query = $conn->real_escape_string($query);

$sql = "SELECT id, name FROM shoes WHERE name LIKE '%$query%' LIMIT 10";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<a href="view_shoe.php?id=' . htmlspecialchars($row['id']) . '">' . htmlspecialchars($row['name']) . '</a>';
    }
} else {
    echo '<p>No results found</p>';
}

$conn->close();
?>