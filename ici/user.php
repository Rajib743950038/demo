<?php
include 'include/check.php';
redirectToLogin();

// Path to the JSON file
$jsonFile = 'Site/data/newdata.json';

// Read JSON file contents
$jsonData = file_get_contents($jsonFile);

// Decode JSON data to an associative array
$data = json_decode($jsonData, true);

// Check if decoding was successful
if ($data === null) {
    die("Error decoding JSON data.");
}

// Sort the data by 'completion_time' in descending order (latest first)
usort($data, function ($a, $b) {
    $dateA = strtotime($a['completion_time']);
    $dateB = strtotime($b['completion_time']);
    return $dateB - $dateA; // For descending order (latest data first)
});

// Handle delete all request
if (isset($_POST['action']) && $_POST['action'] === 'delete_all') {
    // Clear all data
    $smsData = [];
    file_put_contents($jsonFile, json_encode($smsData, JSON_PRETTY_PRINT));
    echo "Deleted successfully.";
    exit;
}

// Include password verification
include 'include/pass.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>User Data</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700" />
    <link rel="stylesheet" href="css/fontawesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

</head>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<style>
body {
    font-family: 'Roboto', sans-serif;
    background-color: #e0e0e0;
}

.tm-bg-primary-dark {
    background-color: #f0f0f3;
    border-radius: 12px;
    box-shadow: 8px 8px 15px #bebebe, -8px -8px 15px #ffffff;
    padding: 20px;
}

.search-form input[type="search"] {
    width: 200px;
    padding: 8px;
    border-radius: 20px;
    border: none;
    background: #e0e0e0;
    box-shadow: inset 5px 5px 10px #bebebe, inset -5px -5px 10px #ffffff;
    outline: none;
}

.button-group {
    display: grid;
    grid-template-columns: repeat(3, auto);
    grid-gap: 20px;
    justify-content: center;
    margin-bottom: 20px;
}

.button-group .btn {
    padding: 12px 20px;
    border-radius: 12px;
    box-shadow: 5px 5px 10px #b5b5b5, -5px -5px 10px #ffffff;
    background-color: #e0e0e0;
    color: #333;
    transition: all 0.3s ease;
}

.button-group .btn:hover {
    box-shadow: 3px 3px 6px #b5b5b5, -3px -3px 6px #ffffff;
}

/* Second row: Spanning only two buttons */
.button-group .btn:nth-child(4),
.button-group .btn:nth-child(5) {
    grid-column: span 1;
}

/* Responsive adjustment for smaller screens */
@media (max-width: 576px) {
    .button-group {
        grid-template-columns: repeat(2, auto);
        grid-gap: 10px;
    }

    .button-group .btn {
        padding: 8px 14px;
    }
}

.search-form input[type="search"] {
    width: 200px;
    padding: 10px;
    border: none;
    outline: none;
    border-radius: 12px;
    box-shadow: inset 5px 5px 10px #bebebe, inset -5px -5px 10px #ffffff;
    background-color: #e0e0e0;
    color: #333;
    transition: box-shadow 0.3s ease;
}

.search-form input[type="search"]:focus {
    box-shadow: 5px 5px 10px #bebebe, -5px -5px 10px #ffffff;
}

table {
    width: 100%;
    margin: 0 auto;
    border-collapse: collapse;
    background-color: #e0e0e0;
    border-radius: 10px;
    border: none;
    color: #333;
}

th,
td {
    padding: 10px;
    text-align: left;
    border-bottom: 2px solid #ccc;
}

th {
    background-color: #dcdcdc;
}

input[type="checkbox"] {
    width: 20px;
    height: 20px;
    appearance: none;
    background: #f0f0f3;
    border-radius: 6px;
    box-shadow: 5px 5px 10px #bebebe, -5px -5px 10px #ffffff;
}

input[type="checkbox"]:checked {
    background: #4caf50;
    box-shadow: 5px 5px 10px #bebebe, -5px -5px 10px #ffffff;
}

.view-details {
    color: #007bff;
    text-decoration: none;
    box-shadow: none;
}

.view-details:hover {
    color: #0056b3;
    text-decoration: underline;
}

h4 {
    background-color: #f0f0f3;
    box-shadow: inset 5px 5px 10px #bebebe, inset -5px -5px 10px #ffffff;
    padding: 10px;
    border-radius: 12px;
}

@media (max-width: 576px) {
    .btn {
        padding: 6px 10px;
        font-size: 14px;
    }
}


/* Additional styles for modal */
.modal {
    display: none;
    /* Hidden by default */
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.4);
    /* Black w/ opacity */
    padding-top: 60px;
}

.modal-content {
    background-color: #e0e0e0;
    /* Background color matching Neumorphism theme */
    margin: 10% auto;
    padding: 20px;
    border-radius: 15px;
    /* Rounded corners */
    box-shadow: 9px 9px 20px rgba(200, 200, 200, 0.5),
        -9px -9px 20px rgba(255, 255, 255, 0.8);
    /* Neumorphism shadows */
    width: 80%;
    /* Adjusted width */
    max-width: 350px;
    /* Maximum width of the modal */
    transition: box-shadow 0.3s ease;
    /* Transition for hover effect */
}

.modal-content:hover {
    box-shadow: 12px 12px 30px rgba(200, 200, 200, 0.6),
        -12px -12px 30px rgba(255, 255, 255, 0.9);
    /* Shadow effect on hover */
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

input[type="password"] {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border: none;
    /* Remove border */
    border-radius: 10px;
    /* Rounded corners */
    box-shadow: inset 5px 5px 10px rgba(200, 200, 200, 0.5),
        inset -5px -5px 10px rgba(255, 255, 255, 0.8);
    /* Inset shadow for Neumorphism */
    background-color: #e0e0e0;
    /* Match background */
    transition: box-shadow 0.2s ease;
    /* Transition for focus effect */
}

input[type="password"]:focus {
    outline: none;
    /* Remove outline */
    box-shadow: inset 3px 3px 6px rgba(200, 200, 200, 0.5),
        inset -3px -3px 6px rgba(255, 255, 255, 0.8);
    /* Focus shadow */
}

.btn-delete-all {
    background-color: #e0e5ec;
    padding: 12px 24px;
    cursor: pointer;
    border-radius: 8px;
    box-shadow: 5px 5px 10px #bcbcbc,
        -5px -5px 10px #ffffff;
    font-size: 16px;
    color: #4b4b4b;
    transition: all 0.3s ease;
    display: block;
    margin: 0 auto;
    text-align: center;
}

/* Neumorphic Search Form Styles */
.neumorphic-search-form {
    display: flex;
    justify-content: center;
    margin-bottom: 20px;
}

.neumorphic-input-container {
    display: flex;
    align-items: center;
    background-color: #e0e5ec;
    border-radius: 12px;
    box-shadow: 5px 5px 10px #bcbcbc,
        -5px -5px 10px #ffffff;
    transition: all 0.3s ease;
    overflow: hidden;
}

.neumorphic-input {
    flex: 1;
    border: none;
    padding: 12px 16px;
    background: none;
    font-size: 16px;
    color: #4b4b4b;
    outline: none;
}

.neumorphic-button {
    border: none;
    background-color: #e0e5ec;
    padding: 12px;
    border-radius: 0 12px 12px 0;
    box-shadow: none;
    cursor: pointer;
    transition: all 0.3s ease;
}

.neumorphic-button:hover {
    background-color: #d0d5dc;
}

.neumorphic-button:focus {
    outline: none;
}

/* Icon Style */
.fa-search {
    color: #4b4b4b;
    font-size: 18px;
}
</style>

<body>
    <div class="container mt-5">
        <div class="row tm-content-row">
            <div class="col-12 tm-block-col">
                <div class="tm-bg-primary-dark tm-block tm-block-h-auto">

                    <!-- Search Form -->
                    <form class="d-flex justify-content-center align-items-center" style="margin-bottom: 20px;">
                        <input class="form-control me-2 neumorphic-input" type="search" placeholder="Search"
                            aria-label="Search" id="search-input">
                        <button class="btn neumorphic-button" type="button" id="search-button">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>


                    <div class="button-group">
                        <!-- Delete Selected -->
                        <button class="btn btn-delete-all" id="delete-all"><i class="fas fa-trash-alt"></i> Delete
                        </button>
                        <!-- Download Data -->
                        <button class="btn btn-success mb-3" id="download-data"><i class="fas fa-download"></i> Download
                            Data</button>
                        <!-- Select All -->
                        <button class="btn btn-primary mb-3 select-btn" id="select-all"><i
                                class="fas fa-check-square"></i> Select All</button>
                        <!-- Unselect All -->
                        <button class="btn btn-secondary mb-3 select-btn" id="unselect-all"><i
                                class="fas fa-square"></i> Unselect All</button>
                    </div>

                    <table id="complaint">
                        <h4>User Data</h4>
                        <thead>
                            <tr>
                                <th>Select</th>
                                <th>Token</th>
                                <th>Name</th>
                                <th>Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data as $item): ?>
                            <tr>
                                <td><input type="checkbox" class="user-checkbox"
                                        data-token="<?php echo htmlspecialchars($item['token'], ENT_QUOTES); ?>"></td>
                                <td><?php echo htmlspecialchars($item['token'] ?? 'null', ENT_QUOTES); ?></td>
                                <td><?php echo htmlspecialchars($item['name'] ?? 'null', ENT_QUOTES); ?></td>
                                <td><a href="details.php?token=<?php echo htmlspecialchars($item['token'] ?? '', ENT_QUOTES); ?>"
                                        class="view-details">User Details</a></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>

                    </table>

                </div>
            </div>
        </div>
    </div>
    <!-- Modal for Password Confirmation -->
    <div id="passwordModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Confirm Password</h2>
            <p>Enter your password to confirm deletion:</p>
            <input type="password" id="confirm-password" placeholder="Password">
            <button id="confirm-delete" class="btn btn-delete-all">Confirm</button>
        </div>
    </div>
    <script>
    $(document).ready(function() {
        $("#search-button").click(function() {
            var searchText = $("#search-input").val().toLowerCase();
            $("#complaint tbody tr").each(function() {
                var name = $(this).find("td:nth-child(2)").text().toLowerCase();
                var mobile = $(this).find("td:nth-child(3)").text().toLowerCase();
                if (name.includes(searchText) || mobile.includes(searchText)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });

        // Select All Users
        $("#select-all").click(function() {
            $(".user-checkbox").prop("checked", true);
        });

        // Unselect All Users
        $("#unselect-all").click(function() {
            $(".user-checkbox").prop("checked", false);
        });

        // Delete All Button Click
        $('#delete-all').click(function() {
            $('#passwordModal').css('display', 'block'); // Show password modal
        });

        // Close modal when the user clicks on <span> (x)
        $('.close').click(function() {
            $('#passwordModal').css('display', 'none'); // Hide modal
        });

        // Confirm Delete Button Click
        $('#confirm-delete').click(function() {
            var enteredPassword = $('#confirm-password').val();
            // Send an AJAX request to validate the password
            $.ajax({
                url: 'include/pass.php', // URL to verify password
                method: 'POST',
                data: {
                    password: enteredPassword
                },
                success: function(response) {
                    if (response === 'success') {
                        // If password is correct, delete all messages
                        $.ajax({
                            url: 'user.php', // URL of the same PHP page
                            method: 'POST',
                            data: {
                                action: 'delete_all'
                            },
                            success: function(response) {
                                alert(response); // Alert success message
                                location.reload(); // Reload the page
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr
                                    .responseText); // Log any error
                            }
                        });
                    } else {
                        alert('Incorrect password!'); // Alert incorrect password
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText); // Log any error
                }
            });
        });


        // Download Data
        $("#download-data").click(function() {
            var dataStr = "data:text/json;charset=utf-8," + encodeURIComponent(JSON.stringify(
                <?php echo json_encode($data); ?>));
            var downloadAnchorNode = document.createElement('a');
            downloadAnchorNode.setAttribute("href", dataStr);
            downloadAnchorNode.setAttribute("download", "data.json");
            document.body.appendChild(downloadAnchorNode); // Required for Firefox
            downloadAnchorNode.click();
            downloadAnchorNode.remove();
        });
    });
    </script>
</body>

</html>