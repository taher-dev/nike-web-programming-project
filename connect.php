<?php

// Establish connection to MySQL
$conn = mysqli_connect("localhost", "root", "");

// Check connection
if (!$conn) {
    die("Connection Error: " . mysqli_connect_error());
}

// ==================================================================
// SETUP FOR 'login' DATABASE
// ==================================================================

// Create 'login' database if it does not exist
$sql_create_db_login = "CREATE DATABASE IF NOT EXISTS login";
if (!mysqli_query($conn, $sql_create_db_login)) {
    die("Error creating database 'login': " . mysqli_error($conn));
}

// Select the 'login' database
if (!mysqli_select_db($conn, "login")) {
    die("Error selecting database 'login': " . mysqli_error($conn));
}

// SQL to create 'users' table if it does not exist
$sql_create_users_table = "CREATE TABLE IF NOT EXISTS `users` (
    `Id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `firstName` VARCHAR(50) NOT NULL,
    `lastName` VARCHAR(50) NOT NULL,
    `email` VARCHAR(50) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`Id`)
)";
if (!mysqli_query($conn, $sql_create_users_table)) {
    die("Error creating table 'users': " . mysqli_error($conn));
}


// ==================================================================
// SETUP FOR 'nike' DATABASE
// ==================================================================

// Create 'nike' database if it does not exist
$sql_create_db_nike = "CREATE DATABASE IF NOT EXISTS nike";
if (!mysqli_query($conn, $sql_create_db_nike)) {
    die("Error creating database 'nike': " . mysqli_error($conn));
}

// Select the 'nike' database
if (!mysqli_select_db($conn, "nike")) {
    die("Error selecting database 'nike': " . mysqli_error($conn));
}

// SQL to create 'shoes' table if it does not exist
$sql_create_shoes_table = "CREATE TABLE IF NOT EXISTS shoes (
     id INT AUTO_INCREMENT PRIMARY KEY,
     name VARCHAR(255) NOT NULL,
     image_url VARCHAR(255) NOT NULL,
     category VARCHAR(255) NOT NULL,
     price DECIMAL(10, 2) NOT NULL,
     section VARCHAR(255)
 )";
if (!mysqli_query($conn, $sql_create_shoes_table)) {
    die("Error creating table 'shoes': " . mysqli_error($conn));
}

?>