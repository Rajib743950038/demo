<?php
$encodedEmail = 'YWRtaW5AZ21haWwuY29t';
$encodedPassword = 'YWRtaW4xMjM=';
$encodedUsername = ''; // Add a placeholder or remove this line if not needed

$email = base64_decode($encodedEmail);
$password = base64_decode($encodedPassword);
$username = base64_decode($encodedUsername);
?>