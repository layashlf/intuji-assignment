<?php
require_once __DIR__ . '/../include/header.php';
require_once __DIR__ . '/../include/navBar.php'; ?>



<div class="container mt-3">
  <h2>Create Google Calendar Event </h2>
  <?php if (isset($_SESSION['errormsg'])): ?>
    <div class="alert alert-danger" role="alert">
      <?php echo $_SESSION['errormsg'];
      unset($_SESSION['errormsg']);
      ?>
    </div>
  <?php endif ?>
  <?php if (isset($_SESSION['successMessage'])): ?>
    <div class="alert alert-success" role="alert">
      <?php echo $_SESSION['successMessage'];
      unset($_SESSION['successMessage']);
      ?>
    </div>
  <?php endif ?>
  <form id="eventForm" class="needs-validation" novalidate>
    <div class="mb-3">
      <label for="eventName" class="form-label">Event Title</label>
      <input type="text" class="form-control" id="eventName" name="eventName" required>
    </div>
    <div class="mb-3">
      <label for="location" class="form-label">Location </label>
      <input type="text" class="form-control" id="location" name="location" required>
    </div>
    <div class="mb-3">
      <label for="description" class="form-label">Description </label>
      <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
    </div>
    <div class="row">
      <div class="col-md-6 mb-3">
        <label for="startDate" class="form-label">Start Date</label>
        <input type="date" class="form-control" id="startDate" name="startDate" min="<?php echo date("Y-m-d"); ?>"
          required>
      </div>
      <div class="col-md-6 mb-3">
        <label for="startTime" class="form-label">Start Time (HH:MM)</label>
        <input type="time" class="form-control" id="startTime" name="startTime" required>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 mb-3">
        <label for="endDate" class="form-label">End Date </label>
        <input type="date" class="form-control" id="endDate" name="endDate" min="<?php echo date("Y-m-d"); ?>" required>
      </div>
      <div class="col-md-6 mb-3">
        <label for="endTime" class="form-label">End Time </label>
        <input type="time" class="form-control" id="endTime" name="endTime" required>
      </div>
    </div>
    <div class="mb-3">
      <label for="guests" class="form-label">Guests (Comma-Separated Email Addresses)</label>
      <input type="text" class="form-control" id="guests" name="guests"
        placeholder="Enter email addresses separated by commas" required>
    </div>
    <Button onclick="createEvents(this)" class="btn btn-primary"><i class="spinner"></i> Submit</Button>
  </form>
</div>

<script>
  (function () {
    'use strict';
    window.addEventListener('load', function () {
      var forms = document.getElementsByClassName('needs-validation');
      var validation = Array.prototype.filter.call(forms, function (form) {
        form.addEventListener('submit', function (event) {
          if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add('was-validated');

        }, false);
      });
    }, false);
  })();

  function createEvents(selector) {
    event.preventDefault();
    const formData = $('form').serialize()


    $(selector).find('.spinner').addClass('spinner-grow');
    $.ajax({
      url: "eventsHandler.php",
      context: document.body,
      type: "POST", data: formData

    }).done(() => {

      $(selector).find('.spinner').addClass('spinner-grow');
      window.location.reload();
    });

  }

</script>