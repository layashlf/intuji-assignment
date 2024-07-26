<?php 
include (__DIR__."/../configuration/app.php");
?>
<nav class="navbar navbar-expand navbar-light bg-light mb-3">
    <a class="navbar-brand" href="#"></a>
    
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo BASE_URL?>">Home </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo BASE_URL?>views/create_eventForm.php">New</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo BASE_URL?>views/list_events.php">List</a>
            </li>
            
        </ul>
    </div>
</nav>