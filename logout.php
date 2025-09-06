<?php
// 1. Start the session to access it
session_start();

// 2. Unset all session variables
session_unset();

// 3. Destroy the session completely
session_destroy();

// 4. Redirect the user to the homepage
header("location: index.php");

// 5. Stop the script from running further
exit();
?>