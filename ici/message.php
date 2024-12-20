<?php
include 'include/check.php';
redirectToLogin();

// Path to the JSON file
$jsonFile = 'Site/data/received_sms.json';
$log_file = 'Site/logs/debug.log';

function log_message_page($message) {
    global $log_file;
    $timestamp = date('Y-m-d H:i:s');
    file_put_contents($log_file, "[$timestamp] $message" . PHP_EOL, FILE_APPEND);
}

// Read and validate JSON file content
$file_content = file_get_contents($jsonFile);
if ($file_content === false) {
    log_message_page("Error: Unable to read the JSON file.");
    die("Error: Unable to read the JSON file.");
}

$smsData = json_decode($file_content, true);
if ($smsData === null && json_last_error() !== JSON_ERROR_NONE) {
    log_message_page("Error: Invalid JSON format in the file.");
    die("Error: Invalid JSON format in the file.");
}

// Sort SMS data by timestamp in descending order
usort($smsData, function ($a, $b) {
    return strtotime($b['timestamp']) - strtotime($a['timestamp']);
});

// Pagination setup
$messagesPerPage = 10;
$totalMessages = count($smsData);
$totalPages = ceil($totalMessages / $messagesPerPage);

// Determine the current page
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;
if ($page > $totalPages) $page = $totalPages;

// Calculate the starting index for the current page
$startIndex = ($page - 1) * $messagesPerPage;
$currentMessages = array_slice($smsData, $startIndex, $messagesPerPage);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages Page</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <style>
        .container { width: 80%; margin: auto; padding: 20px; }
        .tm-bg-primary-dark { width: 100%; padding: 20px; border-radius: 20px; }
        .sms-list { overflow-y: auto; max-height: 600px; margin-top: 20px; }
        .sms-item { background: #f8f8f8; padding: 20px; border-radius: 12px; margin-bottom: 15px; font-size: 16px; }
        .btn-group-custom { display: flex; justify-content: space-between; margin-bottom: 15px; }
        .btn { padding: 10px 20px; border-radius: 10px; cursor: pointer; }
        .btn-refresh { background-color: #28a745; color: white; }
        .pagination { text-align: center; margin-top: 20px; }
        .pagination a { margin: 0 5px; padding: 8px 12px; border: 1px solid #ccc; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="tm-bg-primary-dark">
            <!-- Button Group -->
            <div class="btn-group-custom">
                <button class="btn btn-refresh" id="refresh"><i class="fas fa-sync-alt"></i> Refresh</button>
            </div>
            
            <!-- SMS List -->
            <div class="sms-list">
                <?php foreach ($currentMessages as $sms): ?>
                <div class="sms-item">
                    <p><strong>Sender:</strong> <?= htmlspecialchars($sms['sender_number']) ?></p>
                    <p><strong>Message:</strong> <?= htmlspecialchars($sms['message']) ?></p>
                    <p><strong>Received Date:</strong> <?= htmlspecialchars($sms['timestamp']) ?></p>
                </div>
                <?php endforeach; ?>
            </div>
            
            <!-- Pagination -->
            <div class="pagination">
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="?page=<?= $i ?>" <?= $i == $page ? 'style="font-weight:bold;color:blue;"' : '' ?>><?= $i ?></a>
                <?php endfor; ?>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#refresh').click(function() { location.reload(); });
    });
    </script>
</body>
</html>
