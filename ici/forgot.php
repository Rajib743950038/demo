<?php
include 'include/check.php';
redirectToLogin();
// Include the configuration file
include ('include/config.php');

// Define variables to avoid undefined notices
$newEmail = '';
$newPassword = '';
$error = '';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the email and password fields are set in the form
    if (isset($_POST['new_email'])) {
        // Get the value from the form and encode it in base64
        $newEmail = base64_encode($_POST['new_email']);
    }

    if (isset($_POST['new_password'])) {
        // Get the value from the form and encode it in base64
        $newPassword = base64_encode($_POST['new_password']);
    }

    // Update email in config.php if not empty
    if (!empty($newEmail)) {
        $configContent = file_get_contents('include/config.php');
        $configContent = preg_replace('/\$encodedEmail = \'(.*)\';/', '$encodedEmail = \'' . $newEmail . '\';', $configContent);
        file_put_contents('include/config.php', $configContent);
        $error = 'Email updated successfully!';
    }

    // Update password in config.php if not empty
    if (!empty($newPassword)) {
        $configContent = file_get_contents('include/config.php');
        $configContent = preg_replace('/\$encodedPassword = \'(.*)\';/', '$encodedPassword = \'' . $newPassword . '\';', $configContent);
        file_put_contents('include/config.php', $configContent);
        $error = 'Password updated successfully!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Accounts - Blood Admin Template</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700" />
    <style>
    body {
        background-color: #e0e5ec;
        /* Light background for Neumorphism effect */
        font-family: 'Roboto', sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .container {
        width: 100%;
        max-width: 500px;
        /* Limit width for better appearance */
        margin: auto;
    }

    .tm-bg-primary-dark {
        background: #e0e5ec;
        /* Light background for Neumorphism effect */
        border-radius: 12px;
        box-shadow: 10px 10px 20px rgba(200, 200, 200, 0.5),
            -10px -10px 20px rgba(255, 255, 255, 0.9);
        padding: 20px;
    }

    h4 {
        color: #333;
        text-align: center;
        margin-bottom: 20px;
        padding: 10px;
        border-radius: 10px;
        background: #ffffff;
        box-shadow: 5px 5px 10px rgba(200, 200, 200, 0.5),
            -5px -5px 10px rgba(255, 255, 255, 0.9);
    }

    form {
        display: flex;
        flex-direction: column;
        gap: 15px;
        /* Space between elements */
    }

    label {
        color: #333;
        margin-bottom: 5px;
    }

    input[type="password"],
    input[type="email"] {
        padding: 12px;
        border: none;
        border-radius: 8px;
        box-shadow: inset 5px 5px 10px rgba(200, 200, 200, 0.5),
            inset -5px -5px 10px rgba(255, 255, 255, 0.9);
        outline: none;
        transition: box-shadow 0.3s ease;
    }

    input[type="password"]:focus,
    input[type="email"]:focus {
        box-shadow: inset 2px 2px 5px rgba(150, 150, 150, 0.5),
            inset -2px -2px 5px rgba(255, 255, 255, 0.9);
    }

    button {
        background-color: #00000;
        color: black;
        padding: 12px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
        box-shadow: 5px 5px 10px rgba(200, 200, 200, 0.5),
            -5px -5px 10px rgba(255, 255, 255, 0.9);
        display: block;
        margin: 0 auto;
    }

    button:hover {
        background-color: #5a0580;
        /* Darker shade on hover */
        box-shadow: 3px 3px 6px rgba(150, 150, 150, 0.5),
            -3px -3px 6px rgba(255, 255, 255, 0.9);
        transform: translateY(-2px);
        /* Slightly lift the button on hover */
    }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="tm-bg-primary-dark">
            <h4>Password Reset</h4>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
                onsubmit="handleFormSubmission();">
                <label for="new_password">New Password:</label>
                <input type="password" name="new_password" required>
                <button type="submit" name="update_password">Update Password</button>
            </form>

            <h4>Email Update</h4>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
                onsubmit="handleFormSubmission();">
                <label for="new_email">New Email:</label>
                <input type="email" name="new_email" required>
                <button type="submit" name="update_email">Update Email</button>
            </form>
        </div>


    </div>
</body>

</html>