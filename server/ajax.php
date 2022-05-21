<?php
// Your MP3 Converter Pro v3 URL here
$baseUrl = 'https://example.com';
// Your YouTube Video Backend v3 URL and API KEY here
$backendUrl = 'http://backend.example.com';
// Generate an API Key in Backend Admin Panel and paste it here.
$backendApiKey = 'YOUR_API_KEY';

// API CORS restriction (Only required if you running ajax.php and Frontend on different domains).
// header("Access-Control-Allow-Origin: *"); // Allow all domains
// header("Access-Control-Allow-Origin: https://example.com"); // Allow only one domain.

// Additional Headers
header('Access-Control-Allow-Methods: POST');
header("Access-Control-Allow-Headers: Content-Type");

// CHANGES BELLOW at your own RISK

$json = json_decode(file_get_contents('php://input'), true);

if (json_last_error() == JSON_ERROR_NONE)
{
  $url = (isset($json['url'])) ? trim($json['url']) : '';
  $ftype = (isset($json['ftype'])) ? trim($json['ftype']) : '';
  $hash = (isset($json['hash'])) ? trim($json['hash']) : '';
  $taskId = (isset($json['taskId'])) ? trim($json['taskId']) : '';
  $term = (isset($json['term'])) ? trim($json['term']) : '';

  if (!empty($url) && !empty($ftype))
  {
    $apiEndpoint = $baseUrl . '/api/json';
    $postData = array(
      'url' => $url,
      'ftype' => $ftype
    );
  }
  else if (!empty($hash))
  {
    $apiEndpoint = $baseUrl . '/api/json';
    $postData = array(
      'hash' => $hash
    );
  }
  else if (!empty($taskId))
  {
    $apiEndpoint = $baseUrl . '/api/json/task';
    $postData = array(
      'taskId' => $taskId
    );
  }
  else if (!empty($term))
  {
    $apiEndpoint = $backendUrl . '/api/search';
    $postData = array(
      'term' => $term
    );
  }

  if (isset($postData))
  {
    // Create a new cURL resource
    $ch = curl_init($apiEndpoint);

    // Setup request to send json via POST
    $payload = json_encode($postData);

    // Attach encoded JSON string to the POST fields
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

    // Set the content type to application/json
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Accept: application/json', 'apiKey: ' . $backendApiKey));

    // Return response instead of outputting
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // ignore SSL certificate verify
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    // Force IPv4
    curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);

    // Execute the POST request
    $result = curl_exec($ch);

    // Close cURL resource
    curl_close($ch);

    echo $result;
  }
}
