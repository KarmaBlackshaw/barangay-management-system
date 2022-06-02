<?php
session_start();

require_once "bootstrap/index.php";

if (!isset($_GET["resident_id"])) {
	header("Location: resident.php");
}
?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <?php include "templates/header.php"; ?>

    <title>Login - Barangay Services Management System</title>


    <style>
    .hidden {
      display: none !important;
    }

    label.btn.active {
      color: white !important;
      background-color: #337BB6;
    }

    .form-check>.btn-group {
      width: 100%;
    }

    .form-check>.btn-group>label {
      border: 1px solid #3f3f46;
    }

    </style>
  </head>

  <body class="login">
    <?php include "templates/loading_screen.php"; ?>

    <div class="
			wrapper
			<?= isAuthenticated() ? "" : "d-flex flex-column justify-content-center" ?>
		">

      <?php isAdmin() and (include "templates/main-header.php"); ?>

      <?php isAdmin() and (include "templates/sidebar.php"); ?>


      <div class="
				<?= isAdmin() ? "main-panel" : "" ?>
				<?= isAuthenticated() ? "" : "container" ?>
				<?= isAuthenticated() ? "" : "d-flex flex-column justify-content-center" ?>
			">
        <div class="content">
          <?php if (isAdmin()): ?>
          <div class="panel-header bg-primary-gradient">
            <div class="page-inner">
              <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                  <h2 class="text-white fw-bold">Resident Details</h2>
                </div>
              </div>
            </div>
          </div>
          <?php endif; ?>

          <div class="page-inner">
            <?php include "templates/resident-review-card.php"; ?>
          </div>
        </div>

        <!-- Main Footer -->
        <?php isAdmin() and (include "templates/main-footer.php"); ?>
        <!-- End Main Footer -->
      </div>
    </div>


    <?php include "templates/footer.php"; ?>

    <script>
      $(document).ready(function () {
          const ageInput = document.querySelector('input[name="age"]')
          const isSeniorInput = document.querySelector('input[name="is_senior"]')

          if (ageInput) {
            ageInput.addEventListener('input', function (e) {
              const age = Number(e.target.value)

              isSeniorInput.value = age > 60 ? 'Yes' : 'No'

            })
          }
      })
    </script>
  </body>

</html>
