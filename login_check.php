<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // If not, redirect to the login page
    header("Location: signin.php");
    exit();
}
?>