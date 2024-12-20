<?php

// Function to check if a user is logged in
function isUserLoggedIn()
{
    // Start the session
    session_start();

    // Check if the 'loggedIn' session variable is set and true
    return isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true;
}

// Function to redirect to login page if the user is not logged in
function redirectToLogin()
{
    // If the user is not logged in, redirect to the login page
    if (!isUserLoggedIn()) {
        header("Location: index.php");
        exit();
    }
}

// Function to log out a user
function logoutUser()
{
    // Start the session
    session_start();

    // Unset all session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Redirect to login page after logout
    header("Location: index.php");
    exit();
}
?>