<?php
header('Content-Type: application/json');

// Replace with the path to your JSON file
$jsonFile = 'Site/data/newdata.json'; 

if (file_exists($jsonFile)) {
    $lastModified = filemtime($jsonFile);
    echo json_encode(['last_modified' => $lastModified]);
} else {
    echo json_encode(['error' => 'File not found']);
}
?>