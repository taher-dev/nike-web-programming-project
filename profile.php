<?php
session_start();
include("connect.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Card</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Inter", sans-serif;
            background-color: #f5f5f5;
            color: #111;
        }

        .container {
            background: #fff;
            width: 450px;
            padding: 1.5rem;
            margin: 50px auto;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .profile-card {
            text-align: center;
        }

        .profile-img img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
        }

        .profile-card h1 {
            font-size: 1.5rem;
            font-weight: bold;
            margin-top: 1rem;
            margin-bottom: 1rem;
        }

        .profile-card p {
            font-size: 1rem;
            color: #757575;
            margin-bottom: 1.5rem;
        }

        .action-btns {
            margin-top: 4rem;
        }

        .btn {
            font-size: 1.1rem;
            padding: 8px 16px;
            border-radius: 5px;
            outline: none;
            border: none;
            width: 100%;
            background: #111;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-bottom: 1rem;
            text-decoration: none;
        }

        .btn:hover {
            background: #11111190;
        }

        .footer {
            text-align: center;
            font-size: 0.9em;
            color: #757575;
            margin-top: 1.5rem;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="profile-card">
            <div class="profile-img">
                <img src="img/profile-icon.png" alt="Profile Image">
            </div>
            <?php if (isset($_SESSION['email']) && !empty($_SESSION['email'])): ?>
                <?php
                $email = $_SESSION['email'];
                $query = mysqli_query($conn, "SELECT firstName, lastName FROM `users` WHERE email='$email'");
                ?>
                <?php if ($query && mysqli_num_rows($query) > 0): ?>
                    <?php $row = mysqli_fetch_assoc($query); ?>
                    <h1><?php echo htmlspecialchars($row['firstName']) . ' ' . htmlspecialchars($row['lastName']); ?></h1>
                    <p>Email: <?php echo htmlspecialchars($email); ?></p>
                <?php else: ?>
                    <h1>Guest</h1>
                    <p>You are not logged in.</p>
                <?php endif; ?>
            <?php else: ?>
                <h1>Guest</h1>
                <p>You are not logged in.</p>
            <?php endif; ?>

            <div class="action-btns">
                <a href="index.php" class="btn">Home</a>
                <a href="logout.php" class="btn">Logout</a>
            </div>
        </div>
        <div class="footer">
            <p>&copy; 2024 Abdullah, Taher & Mihad. All rights reserved.</p>
        </div>
    </div>
</body>

</html>