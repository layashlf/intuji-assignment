<?php

require_once __DIR__ . '/../controllers/Events.php';
$event = new Events($client);

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'DELETE') {
    $result = $event->deleteEvent($_GET['id']);
    echo $result;
}

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET') {

    $result = $event->listEvents();
    echo json_encode($result->getItems());

}
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    echo $event->createEvent();
}
