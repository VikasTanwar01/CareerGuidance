<?php
// career/chatbot.php

// ===============================
//  OPENROUTER API CONFIGURATION
// ===============================

// 🔥 PUT YOUR REAL API KEY HERE
$OPENROUTER_API_KEY = "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";

// Choose any model you want
$MODEL = "gpt-4o-mini";

// ===============================

// Read user message
$input = json_decode(file_get_contents("php://input"), true);
if (!$input || !isset($input["message"])) {
    echo json_encode(["error" => "No message received"]);
    exit;
}

$userMessage = $input["message"];

// Create payload for OpenRouter
$payload = [
    "model" => $MODEL,
    "messages" => [
        ["role" => "system", "content" => "You are a helpful AI career assistant."],
        ["role" => "user", "content" => $userMessage]
    ],
    "max_tokens" => 300,
    "temperature" => 0.7
];

$ch = curl_init("https://openrouter.ai/api/v1/chat/completions");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "Authorization: " . "Bearer $OPENROUTER_API_KEY"
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute API call
$response = curl_exec($ch);
curl_close($ch);

// Decode response
$data = json_decode($response, true);

// Return bot reply
$reply = $data["choices"][0]["message"]["content"] ?? "⚠️ API did not return a valid response.";

echo json_encode(["reply" => $reply]);

?>
