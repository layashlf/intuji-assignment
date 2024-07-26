<?php
require_once '../configuration/config.php';
require_once '../configuration/app.php';


unset($_SESSION['access_token']);
$client->revokeToken();
header('Location:'.BASE_URL);
?>