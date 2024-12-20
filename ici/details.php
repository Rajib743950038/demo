<?php
include 'include/check.php';
redirectToLogin();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Details</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700" />
    <link rel="stylesheet" href="css/fontawesome.min.css" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <style>
    body {
        background-color: #e0e0e0;
        font-family: 'Roboto', sans-serif;
    }

    .container {
        margin-top: 50px;
        border-radius: 15px;
        padding: 10px;
        background-color: #ffffff;
        box-shadow: 20px 20px 60px #c6c6c6, -20px -20px 60px #ffffff;
    }

    table {
        width: 100%;
        margin-top: 20px;
        border-collapse: collapse;
        border-radius: 8px;
        overflow: hidden;
    }

    th,
    td {
        padding: 15px;
        background-color: #f4fbff;
        text-align: left;
        border-bottom: 1px solid #ddd;
        box-shadow: inset 8px 8px 16px #c6c6c6, inset -8px -8px 16px #ffffff;
    }

    th {
        background-color: inset 8px 8px 16px #c6c6c6, inset -8px -8px 16px #ffffff;
        color: #000000;
    }

    nav {
        background-color: #ffffff;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    .tm-site-title {
        color: #333;
    }

    .navbar-nav .nav-link {
        color: #333;
    }

    .tm-footer {
        background-color: #000000;
        color: #ffffff;
        padding: 10px;
        text-align: center;
    }
    </style>
</head>

<body>

    <div class="container mt-5">
        <div class="row tm-content-row">
            <div class="col-12 tm-block-col">
                <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
                    <?php
                    if (isset($_GET['token'])) {
                        $token = $_GET['token'];
                        $json_data = file_get_contents("Site/data/newdata.json");
                        $data = json_decode($json_data, true);
                        
                        // Flag to check if user is found
                        $userFound = false;

                        // Loop through each entry to find the matching token
                        foreach ($data as $entry) {
                            if (isset($entry['token']) && $entry['token'] === $token) {
                                $userFound = true;
                              echo "<h2 style='text-align: center;'>User Details</h2>";
                                echo "<table>";
                                foreach ($entry as $key => $value) {
                                    if ($value !== "" && $value !== null) {
                                        echo "<tr><th>$key</th><td>$value</td></tr>";
                                    }
                                }
                                echo "</table>";
                                break; // Exit the loop once the user is found
                            }
                        }

                        // If no user found, display an error message
                        if (!$userFound) {
                            echo "<p>User not found for token: $token</p>";
                        }
                    } else {
                        echo "<p>Token parameter is missing</p>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>