<?php

require_once __DIR__ . '/../controllers/Events.php';
require_once __DIR__ . '/../include/header.php';
require_once __DIR__ . '/../include/navBar.php';


$list = new Events($client);
$results = $list->listEvents();

$sn = 1;
?>
<?php if (isset($_SESSION['successMessage'])): ?>
    <div class="container">
        <div class="alert alert-success" role="alert">
            <?php echo $_SESSION['successMessage'];
            unset($_SESSION['successMessage']);
            ?>
        </div>
    </div>
<?php endif ?>

<?php
if (count($results->getItems()) == 0): ?>
    <div class="alert alert-secondary" role="alert">
        No events found
    </div>
<?php else: ?>
    <div class="container">
        <table class="table">
            <?php foreach ($results->getItems() as $event): ?>
                <tr>
                    <td><?php echo $sn . ' ' ?> </td>
                    <td><?php echo $event->getSummary() ?> </td>
                    <td><?php
                    $start = $event->start->dateTime;
                    if (empty($start)) {
                        $start = $event->start->date;
                    }
                    echo explode('T', $start)[0];
                    ?>
                    </td>
                    <td>
                        <a class="bi bi-trash btn btn-outline-danger"
                            onclick="deleteItem('<?php echo $event->getId() ?>',this)">
                            <i class="spinner"></i>
                        </a>
                    </td>
                </tr>
                <?php $sn++; endforeach; ?>
        </table>
    </div>

<?php endif; ?>




<script>
    function deleteItem(id, selector) {
        $(selector).removeClass(' bi-trash btn btn-outline-danger');
        $(selector).find('.spinner').addClass('spinner-grow');
        $.ajax({
            url: "eventsHandler.php?id=" + id,
            context: document.body,
            type: "DELETE"

        }).done(() => {
            $(selector).removeClass(' bi-trash btn btn-outline-danger');
            $(selector).find('.spinner').addClass('spinner-grow');
            window.location.reload();
        });

    }
</script>