<?php
include ("./configuration/config.php");
include ("./include/header.php");
include ("./include/navBar.php");

?>

<div class="container ">
    <?php if (!$client->getAccessToken()): ?>
        <?php $authUrl = $client->createAuthUrl(); ?>
        <div class="container">

            <div class="card  col-md-12">

                <div class="card-body">
                    <h5 class="card-title">Connect your Account</h5>
                    <p class="card-text"> Click this link to connect your Google Calendar account.</p>
                    <a href='<?php echo $authUrl ?>' class="btn btn-primary">Connect</a>
                </div>
            </div>
        </div>
    <?php else: ?>     
        <div class="row">
            <div class="col-sm-6 col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">List event</h5>
                        <p class="card-text">Click this link to list all upcoming events from your Google Calendar.</p>
                        <a href="./views/list_events.php" class="btn btn-primary">List</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Create Event</h5>
                        <p class="card-text">Click this link to create a new event in your Google Calendar.</p>
                        <a href="./views/create_eventForm.php" class="btn btn-primary">Create </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Disconnect</h5>
                        <p class="card-text"> Click this link to disconnect your Google Calendar account.</p>
                        <a href="./events/disconnect.php" class="btn btn-danger">Proceed</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>