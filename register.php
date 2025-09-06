<?php
// Start the session at the very beginning of the file.
session_start();

// 1. Include the universal connection and setup script.
include 'connect.php';

// 2. IMPORTANT: Select the 'login' database to work with.
// Your connect.php might leave another database selected. This ensures all queries in this file go to the correct place.
mysqli_select_db($conn, "login");

// --- SIGN UP LOGIC ---
if (isset($_POST['signUp'])) {
    $firstName = $_POST['fName'];
    $lastName = $_POST['lName'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Use a prepared statement to prevent SQL injection.
    $checkEmailQuery = "SELECT email FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $checkEmailQuery);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        echo "Email Address Already Exists!";
    } else {
        // HASH the password for security before storing it.
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Use a prepared statement for the INSERT query.
        $insertQuery = "INSERT INTO users (firstName, lastName, email, password) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $insertQuery);
        // "ssss" means we are binding four string parameters.
        mysqli_stmt_bind_param($stmt, "ssss", $firstName, $lastName, $email, $hashed_password);

        if (mysqli_stmt_execute($stmt)) {
            // Redirect to the sign-in page after successful registration.
            header("location: sign_in.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}

// --- SIGN IN LOGIC ---
if (isset($_POST['signIn'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Use a prepared statement to safely fetch the user by email.
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Check if a user with that email exists.
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Verify the submitted password against the stored hash.
        if (password_verify($password, $row['password'])) {
            // Password is correct, start the session.
            $_SESSION['email'] = $row['email'];
            // You can also store other user info like name or ID.
            // $_SESSION['firstName'] = $row['firstName']; 
            header("Location: profile.php");
            exit();
        } else {
            // Password is not correct.
            echo "Incorrect Email or Password";
        }
    } else {
        // No user found with that email.
        echo "Incorrect Email or Password";
    }
}

?>