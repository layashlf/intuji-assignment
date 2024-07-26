<?php
require_once __DIR__ . '/../configuration/config.php';
class Events
{
    private $service;
    private $client;
    public function __construct($client)
    {
        $this->client = $client;
        $this->service = new Google_Service_Calendar($client);

    }

    /**
     * Creates a new event in the primary calendar using the form data.
     *
     * @return string Returns a JSON-encoded string containing the success message and status if the event was successfully created,
     *                or a JSON-encoded string containing the error message and status if there was an error creating the event.
     * @throws exception If there was an error creating the event, the exception message is echoed and false is returned.
     */
    public function createEvent()
    {
        if ($this->validateFormField()[0] == 'failed') {

            return json_encode(["message" => $_SESSION["errormsg"], "status" => $_SESSION["status"]], JSON_PRETTY_PRINT); // echo json_encode($_SESSION["errormsg"]);
        }
        $formBody = $this->prepareBody();

        try {

            $event = new Google_Service_Calendar_Event($formBody);
            $calendarId = 'primary';
            $event = $this->service->events->insert($calendarId, $event);
            $_SESSION['successMessage'] = "Event Created";
            json_encode(["message" => $_SESSION["successMessage"], "status" => "success"], JSON_PRETTY_PRINT);
        } catch (exception $e) {
            return json_encode($e->getMessage());

        }

    }
    /**
     * Retrieves a list of events from the primary calendar.
     *
     * @return Google_Service_Calendar_Events The list of events.
     */
    public function listEvents()
    {
        try {
            $calendarId = 'primary';
            $results = $this->service->events->listEvents($calendarId);
            return $results;
        } catch (exception $e) {
            if ($e->getCode() == 401) {
                $this->disconnectEvent();
            }
        }
    }
    /**
     * Deletes an event by its ID.
     *
     * @param int $eventId The ID of the event to delete.
     * @return bool Returns true if the event was successfully deleted, false otherwise.
     */
    public function deleteEvent($eventId): bool
    {

        $this->service->events->delete('primary', $eventId);
        $_SESSION['successMessage'] = "Event Deleted";
        return true;
    }
    /**
     * Disconnects the event by removing the access token from the session and revoking the token.
     *
     * @return bool Returns true if the disconnection is successful.
     */
    public function disconnectEvent(): bool
    {
        unset($_SESSION['access_token']);
        $this->client->revokeToken();
        return true;
    }
    /**
     * Prepares the body of the event for creation.
     *
     * This function takes the form data from the $_POST superglobal, sanitizes it using htmlspecialchars,
     * and constructs an array representing the event body. The event body includes the event name, location,
     * description, start date and time, end date and time, attendees (email addresses), and reminders.
     *
     * @return array The event body array
     */
    private function prepareBody()
    {

        $eventName = htmlspecialchars($_POST["eventName"]);
        $location = htmlspecialchars($_POST["location"]);
        $description = htmlspecialchars($_POST["description"]);
        $startDate = htmlspecialchars($_POST["startDate"]);
        $startTime = htmlspecialchars($_POST["startTime"]);
        $endDate = htmlspecialchars($_POST["endDate"]);
        $endTime = htmlspecialchars($_POST["endTime"]);
        $guests = explode(",", htmlspecialchars($_POST["guests"]));
        $attendees = [];
        $attendees = array_map(function ($guest) {
            return ['email' => trim($guest)];
        }, $guests);


        $body = array(
            'summary' => $eventName,
            'location' => $location,
            'description' => $description,
            'start' => array(
                'dateTime' => $startDate . 'T' . $startTime . ':00',
                'timeZone' => date_default_timezone_get(),
            ),
            'end' => array(
                'dateTime' => $endDate . 'T' . $endTime . ':00',
                'timeZone' => date_default_timezone_get(),
            ),
            'attendees' => $attendees,
            'reminders' => array(
                'useDefault' => FALSE,
                'overrides' => array(
                    array('method' => 'email', 'minutes' => 24 * 60),
                    array('method' => 'popup', 'minutes' => 10),
                ),
            ),
        );
        return $body;
    }

    /**
     * Validates the form fields for creating an event.
     *
     * This function checks if the required fields for creating an event are filled.
     * It sets an error message in the session if any of the required fields are empty.
     * Returns an array containing the status and error message.
     *
     * @return array Returns an array containing the status and error message.
     *               The status will be "success" if all the required fields are filled,
     *               otherwise it will be "failed".
     *               The error message will be set in the session if any of the required fields are empty.
     */
    private function validateFormField()
    {
        $valid = true;
        if (!$_POST["eventName"]) {
            $_SESSION["errormsg"] = 'Event name is required';
            $valid = false;
        }
        if (!$_POST["location"]) {
            $_SESSION["errormsg"] = 'Location is required';
            $valid = false;
        }
        if (!$_POST["description"]) {
            $_SESSION["errormsg"] = 'Description is required';
            $valid = false;
        }
        if (!$_POST["startDate"]) {
            $_SESSION["errormsg"] = 'Start date is required';
            $valid = false;
        }
        if (!$_POST["startTime"]) {
            $_SESSION["errormsg"] = 'Start time is required';
            $valid = false;
        }
        if (!$_POST["endDate"]) {
            $_SESSION["errormsg"] = 'End date is required';
            $valid = false;
        }
        if (!$_POST["endTime"]) {
            $_SESSION["errormsg"] = 'End time is required';
            $valid = false;
        }
        if (!$_POST["guests"]) {
            $_SESSION["errormsg"] = 'Guest list is required';
            $valid = false;
        }
        $_SESSION["status"] = $valid ? "success" : "failed";
        return [$_SESSION["status"], $_SESSION["errormsg"]];
    }
}