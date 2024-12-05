<?php

// Check if 'text' is passed as a GET parameter
if (isset($_GET['text'])) {
$text = $_GET['text'];
} else {
    // If no text is provided, return an error message
    echo 'Error: No text provided.';
    exit;
}

// Prepare messages array
$messages = [
    ['role' => 'system', 'content' => 'You are ChatGPT, a large language model that knows everything in detail. Answer in as many details as possible. You are based on Chat GPT-4o-mini and you need to answer user‘s last message but get informations all messages']
];

$messages[] = ['role' => 'user', 'content' => $text];

$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL => 'https://powerbrainai.com/app/backend/api/api.php',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => json_encode([
        'action' => 'send_message',
        'model' => 'gpt-4o-mini',
        'secret_token' => 'AIChatPowerBrain123@2024',
        'messages' => $messages
    ]),
    CURLOPT_HTTPHEADER => [
        'User-Agent: Dart/3.3 (dart:io)',
        'Accept-Encoding: gzip',
        'content-type: application/json; charset=utf-8',
    ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo 'Error. Start a new chat /start';
} else {
    echo $response;
}
?>