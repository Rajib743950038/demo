<?php
// fetch_data.php

// Read SMS data from JSON file
$smsData = json_decode(file_get_contents('Site/data/received_sms.json'), true);

// Read Full Data from JSON file
$fullData = json_decode(file_get_contents('Site/data/newdata.json'), true);

// Set the timezone to India/Kolkata
date_default_timezone_set('Asia/Kolkata');
$currentDate = date('Y-m-d');

// Function to count today's entries
function countTodayEntries($data, $dateField) {
    global $currentDate;
    $count = 0;
    foreach ($data as $entry) {
        if (strpos($entry[$dateField], $currentDate) === 0) {
            $count++;
        }
    }
    return $count;
}

// Calculate statistics
$todaysDataEntries = countTodayEntries($fullData, 'completion_time');
$totalDataEntries = count($fullData);
$todaysSmsEntries = countTodayEntries($smsData, 'received_date');
$totalSmsEntries = count($smsData);

// Return the updated counts in JSON format
echo json_encode([
    'todaysDataEntries' => $todaysDataEntries,
    'totalDataEntries' => $totalDataEntries,
    'todaysSmsEntries' => $todaysSmsEntries,
    'totalSmsEntries' => $totalSmsEntries
]);
?>