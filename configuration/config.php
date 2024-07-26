<?php
session_start();
require_once __DIR__ . '/../vendor/autoload.php';



$client = new Google\Client();
$client->setAuthConfig(__DIR__ . '/../secrets/client_secret_json.json');
$client->addScope(['https://www.googleapis.com/auth/calendar']);
$client->setRedirectUri('http://localhost:8000');

$service = new Google_Service_Calendar($client);

if (isset($_GET['code'])) {

    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $_SESSION['access_token'] = $token;
    header('Location: ' . filter_var($client->getRedirectUri(), FILTER_SANITIZE_URL));
    exit;
}

if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {

    $client->setAccessToken($_SESSION['access_token']);
} else {
      
    $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . '/';
    $_SERVER['REQUEST_URI'] != '/' ? header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL)) : '';
}
?>
