<?php

$baseUrl = 'https://example.com';

// API restriction
header("Access-Control-Allow-Origin: *");

// Additional Headers
header('Access-Control-Allow-Methods: POST');
header("Access-Control-Allow-Headers: Access-Control-Allow-Origin, Access-Control-Allow-Headers, Origin, Accept, X-Requested-With, Content-Type, Access-Control-Request-Method, Access-Control-Request-Headers");

// CHANGES BELLOW at your own RISK

$json = json_decode(file_get_contents('php://input'), true);

if (json_last_error() == JSON_ERROR_NONE)
{
  $url = (isset($json['url'])) ? trim($json['url']) : '';
  $ftype = (isset($json['ftype'])) ? trim($json['ftype']) : '';
  $hash = (isset($json['hash'])) ? trim($json['hash']) : '';
  $taskId = (isset($json['taskId'])) ? trim($json['taskId']) : '';

  if (!empty($url) && !empty($ftype))
  {
    $apiEndpoint = '/api/json';
    $postData = array(
      'url' => $url,
      'ftype' => $ftype
    );
  }
  else if (!empty($hash))
  {
    $apiEndpoint = '/api/json';
    $postData = array(
      'hash' => $hash
    );
  }
  else if (!empty($taskId))
  {
    $apiEndpoint = '/api/json/task';
    $postData = array(
      'taskId' => $taskId
    );
  }

  if (isset($postData))
  {
    // API URL
    $url = $baseUrl . $apiEndpoint;

    // Create a new cURL resource
    $ch = curl_init($url);

    // Setup request to send json via POST
    $payload = json_encode($postData);

    // Attach encoded JSON string to the POST fields
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

    // Set the content type to application/json
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Accept: application/json'));

    // Return response instead of outputting
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute the POST request
    $result = curl_exec($ch);

    // Close cURL resource
    curl_close($ch);

    echo $result;
  }
}
