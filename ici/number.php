<?php
include 'include/check.php';
redirectToLogin();

$jsonFile = 'Site/data/num.json';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if 'newNumber' is set in $_POST
    $newNumber = isset($_POST['newNumber']) ? $_POST['newNumber'] : '';

    // Save the updated mobile number to data.json
    file_put_contents($jsonFile, $newNumber);
}

// Read data.json again to display the current mobile number
$currentNumber = file_get_contents($jsonFile);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Number</title>
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
        width: 90%;
        max-width: 400px;
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

    input[type="text"] {
        padding: 12px;
        border: none;
        border-radius: 8px;
        box-shadow: inset 5px 5px 10px rgba(200, 200, 200, 0.5),
            inset -5px -5px 10px rgba(255, 255, 255, 0.9);
        outline: none;
        transition: box-shadow 0.3s ease;
    }

    input[type="text"]:focus {
        box-shadow: inset 2px 2px 5px rgba(150, 150, 150, 0.5),
            inset -2px -2px 5px rgba(255, 255, 255, 0.9);
    }

    button {
        background-color: #00000;
        color: black;
        font-weight: 600;
        padding: 12px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
        box-shadow: 5px 5px 10px rgba(200, 200, 200, 0.5),
            -5px -5px 10px rgba(255, 255, 255, 0.9);
    }

    button:hover {
        background-color: #5a0580;
        /* Darker shade on hover */
        box-shadow: 3px 3px 6px rgba(150, 150, 150, 0.5),
            -3px -3px 6px rgba(255, 255, 255, 0.9);
        transform: translateY(-2px);
        /* Slightly lift the button on hover */
    }

    p {
        color: red;
        margin-top: 10px;
    }

    .logo {
        height: 30px;
        width: 30px;
        margin-right: 10px;
    }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="tm-bg-primary-dark">
            <h4>Mobile Number Editor</h4>
            <form action="" method="post" class="space-y-4">
                <label for="currentNumber">Current Mobile Number:</label>
                <input type="text" value="<?php echo htmlspecialchars($currentNumber); ?>" readonly>
                <label for="newNumber">Update Mobile Number (10 digits):</label>
                <input type="text" name="newNumber" id="newNumber" minlength="1" maxlength="10"><br>
                <button type="submit">Save</button>
            </form>
        </div>
    </div>
</body>

</html>