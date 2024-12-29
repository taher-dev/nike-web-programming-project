<?php

// Establish connection to MySQL
$conn = mysqli_connect("localhost", "root", "");

if (!$conn) {
    die("Connection Error: " . mysqli_connect_error());
}

// Create database if not exists
$sql1 = "CREATE DATABASE IF NOT EXISTS login";
if (!mysqli_query($conn, $sql1)) {
    die("Database creation error: " . mysqli_error($conn));
}

// Select database
if (!mysqli_select_db($conn, "login")) {
    die("Database selection error: " . mysqli_error($conn));
}

// Create table if not exists
$sql2 = "CREATE TABLE IF NOT EXISTS `users` (
    `Id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `firstName` VARCHAR(50) NOT NULL,
    `lastName` VARCHAR(50) NOT NULL,
    `email` VARCHAR(50) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`Id`)
)";
if (!mysqli_query($conn, $sql2)) {
    die("Table creation error: " . mysqli_error($conn));
}

?>