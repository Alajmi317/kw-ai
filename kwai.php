<?php

$apiKey = "YOUR_API_KEY_HERE";

$input = json_decode(file_get_contents("php://input"), true);
$userMessage = $input["message"];

$curl = curl_init();
curl_setopt_array($curl, [
    CURLOPT_URL => "https://api.openai.com/v1/chat/completions",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_HTTPHEADER => [
        "Content-Type: application/json",
        "Authorization: Bearer $apiKey"
    ],
    CURLOPT_POSTFIELDS => json_encode([
        "model" => "gpt-4o-mini",
        "messages" => [
            ["role" => "system", "content" => "انت مساعد اسمه Kwai"],
            ["role" => "user", "content" => $userMessage]
        ]
    ])
]);

$response = curl_exec($curl);
curl_close($curl);

echo $response;
?>
