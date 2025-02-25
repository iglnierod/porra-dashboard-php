<?php

function supabaseRequest($endpoint, $method = "GET", $data = null)
{
  $apiUrl = getenv("DB_URL");
  $apiKey = getenv("DB_APIKEY");

  $url = $apiUrl . $endpoint;
  $headers = [
    "apikey: $apiKey",
    "Authorization: Bearer " . $apiKey,
    "Content-Type: application/json"
  ];

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

  if ($method !== "GET") {
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
    if ($data) {
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    }
  }

  $response = curl_exec($ch);

  if (curl_errno($ch)) {
    echo "error en curl: " . curl_error($ch);
  }

  curl_close($ch);

  return json_decode($response, true);
}
?>
<h1></h1>