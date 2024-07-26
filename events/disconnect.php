<?php
require_once '../configuration/config.php';


unset($_SESSION['access_token']);
$client->revokeToken();
header('Location:/index.php');
?>