<?php
// Account details
$apiKey = urlencode('5Di+OAGh9Uk-wJXMllSzyE1vP1Y60SvGklkoXqutJ1');

// Message details
$numbers = array(94717705526);
$sender = urlencode('eSports');
$message = rawurlencode('This is a api test');

$numbers = implode(',', $numbers);

// Prepare data for POST request
$data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);

// Send the POST request with cURL
$ch = curl_init('https://api.txtlocal.com/send/');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

// Process your response here
echo $response;
echo "hi";
?>