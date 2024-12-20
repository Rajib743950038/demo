<?php

$correctPassword = base64_decode('MjU4MA==');

if (isset($_POST['password'])) {
    if ($_POST['password'] === $correctPassword) {
        echo 'success';
    } else {
        echo 'failure';
    }
    exit;
}
?>