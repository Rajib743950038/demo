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
    <meta http-equiv="refresh" content="59"> <!-- Automatic refresh every 59 seconds -->
    <title>Table</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700" />
    <link rel="stylesheet" href="css/fontawesome.min.css" />

    <style>
         body {
        background-color: #e9ecef;
        font-family: 'Roboto', sans-serif;
    }

    .container {
        margin-top: 50px;
        border-radius: 15px;
        padding: 5px;
        background-color: #ffffff;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    h4 {
        color: white;
        background-color: #343a40;
        padding: 15px;
        border-radius: 10px;
        text-align: center;
        margin-bottom: 30px;
    }

    h2 {
        color: #343a40;
        margin: 20px 0;
        text-align: center;
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
        background-color: #c6c6c6;
        color: #000000;
    }
    </style>
</head>

<body>

    <div class="container mt-5">
        <div class="row tm-content-row">
            <div class="col-12 tm-block-col">
                <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
                    <h4>Complete User Data</h4>
                    <?php
                    // Read JSON data from file
                    $jsonFilePath = 'Site/data/newdata.json';
                    $jsonData = file_get_contents($jsonFilePath);

                    // Decode JSON data
                    $data = json_decode($jsonData, true);

                    // Check if decoding was successful
                    if ($data !== null) {
                        // Reverse data to display the latest entry first without sorting by time
                        $data = array_reverse($data);

                        // Check if there is any data
                        if (count($data) > 0) {
                            foreach ($data as $tokenData) {
                                echo '<div class="container mt-4">';
                                echo '<h2>Token: ' . htmlspecialchars($tokenData['token']) . '</h2>';
                                echo '<div class="table-container">';
                                echo '<table class="vertical-table">';
                                foreach ($tokenData as $key => $value) {
                                    if (!empty($value)) {
                                        echo '<tr>';
                                        echo '<td class="key">' . htmlspecialchars($key) . '</td>';
                                        echo '<td class="value">' . htmlspecialchars($value) . '</td>';
                                        echo '</tr>';
                                    }
                                }
                                echo '</table>';
                                echo '</div>';
                                echo '</div>';
                            }
                        } else {
                            echo '<p class="text-center">No data available.</p>';
                        }
                    } else {
                        echo '<p class="text-center">Error decoding JSON data.</p>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
