# Intuji-assignment
This project is a simple PHP application that connects to Google Calendar and provides the following features:
1. List events
2. Create events
3. Delete events
4. Disconnect the account

## Requirements

- PHP  8.0.30 or higher
- Composer
- Google API Client Library for PHP

## Setup

### Step 1: Clone the Repository
Clone the repository inside htdocs folder inside php server.

```sh
git clone git@github.com:layashlf/intuji-assignment.git
cd intuji-assignment
```

### Step 1: Install Dependencies
```sh
composer install
```

### Step 3: Set Up Google API Credentials

1. Go to the Google Cloud Console.
2. Create a new project or select an existing one.
3. Enable the Google Calendar API for your project.
4. Create OAuth 2.0 credentials:
5. Go to the Credentials page.
6. Click on "Create credentials" and select "OAuth 2.0 Client IDs".
7. Configure the OAuth consent screen.
8. Set the application type to "Web application".
9. Add your authorized redirect URIs (e.g., http://localhost/intuji-assignment).
10. Download the credentials.json file and place it inside secrets directory in the root directory of your project.


### Step 4: Set Up Local Server
To test the application locally, you can use the built-in PHP server.


### File Structure
- **index.php:** The main entry point of the application.
- **configuration/config.php:** Configuration file for Google Client.
- **configuration/app.php:** Configuration file for app.
- **controllers/Events.php:** Events class to with methods to create, list and delte event.
- **events/disconnect.php:** Disconnects the user's Google Calendar by revoking the access token.
- **events/eventsHandler.php:** File use to process api calls and provide response to those calls.
- **views/create_eventForm.php:** Html form with js validation to create new event.
- **views/list_events.php:** Html table to display events summary, start date and delete action button.



## Usage
### Listing Events
#### Authenticate with Google.
Go to http://localhost/intuji-assignment/views/list_events.php to list all upcoming events.
#### Creating Events
Go to http://localhost/intuji-assignment/views/create_eventForm.php Fill in the event details and submit the form to create a new event.
#### Deleting Events
Go to http://localhost/intuji-assignment/views/list_events.php to list events.
Click the "Red Trash icon" next to the event you want to delete.
#### Disconnecting the Account
Go to http://localhost/intuji-assignment and click on "Proceed" button in disconnect card to disconnect your Google Calendar account.