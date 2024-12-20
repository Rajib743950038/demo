<?php
include 'include/check.php';
redirectToLogin();
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['marquee_text'])) {
    // Get the new marquee text from the form
    $newMarqueeText = $_POST['marquee_text'];

    // Update the text file with the new marquee text
    file_put_contents('include/notice.txt', $newMarqueeText);
}

// Read the marquee text from the text file
$marqueeText = file_get_contents('include/notice.txt');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Notice</title>
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

    textarea {
        width: 100%;
        height: 100px;
        padding: 10px;
        border: none;
        border-radius: 8px;
        box-shadow: inset 5px 5px 10px rgba(200, 200, 200, 0.5),
            inset -5px -5px 10px rgba(255, 255, 255, 0.9);
        outline: none;
        transition: box-shadow 0.3s ease;
    }

    textarea:focus {
        box-shadow: inset 2px 2px 5px rgba(150, 150, 150, 0.5),
            inset -2px -2px 5px rgba(255, 255, 255, 0.9);
    }

    input[type="submit"] {
        padding: 10px 20px;
        background-color: #ff9c00;
        border: none;
        color: #fff;
        cursor: pointer;
        border-radius: 8px;
        box-shadow: 5px 5px 10px rgba(200, 200, 200, 0.5),
            -5px -5px 10px rgba(255, 255, 255, 0.9);
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
        display: block;
        margin: 0 auto;
        /* Center the button */
    }

    input[type="submit"]:hover {
        background-color: #e08c00;
        /* Darker shade on hover */
        box-shadow: 3px 3px 6px rgba(150, 150, 150, 0.5),
            -3px -3px 6px rgba(255, 255, 255, 0.9);
        transform: translateY(-2px);
        /* Slightly lift the button on hover */
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
        <div class="row tm-content-row">
            <div class="col-12 tm-block-col">
                <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
                    <div class="container">
                        <form method="post" action="">
                            <h4>Enter New Notice:</h4>
                            <textarea class="form-control" id="marquee_text" name="marquee_text"
                                rows="3"><?= $marqueeText ?></textarea>
                            <!--  <input type="submit" value="Update Notice" /> !--->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>