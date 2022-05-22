<?php

require "bootstrap/index.php";

use Carbon\Carbon;

$announcement = (function () use ($db) {
	return $db
		->from(["announcements" => "a"])
		->select([
			"id" => "a.id",
			"title" => "a.title",
			"content" => "a.content",
			"thumbnail" => "a.thumbnail",
			"created_at" => "a.created_at",
		])
		->where('id', $_GET['id'])
		->first()
		->exec();
})();
?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <?php include "templates/header.php"; ?>
    <title>Announcements - Barangay Services Management System</title>

    <style>
    .announcement__img {
      max-height: 500px;
      display: block;
      margin-left: auto;
      margin-right: auto;
      margin-bottom: 20px;
    }

    .announcement__body {
      line-height: 2rem;
    }

    </style>
  </head>

  <body>
    <?php include "templates/loading_screen.php"; ?>
    <div class="wrapper">
      <!-- Main Header -->
      <?php include "templates/main-header.php"; ?>
      <!-- End Main Header -->

      <!-- Sidebar -->
      <?php include "templates/sidebar.php"; ?>
      <!-- End Sidebar -->

      <div class="main-panel">
        <div class="content">
          <div class="panel-header bg-primary-gradient">
            <div class="page-inner">
              <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <h2 class="text-white fw-bold">Announcements</h2>
              </div>
            </div>
          </div>
          <div class="page-inner">

            <?php include "templates/alert.php"; ?>

            <div class="row mt--2">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <div class="card-head-row">
                      <div class="card-title"><?= $announcement['title'] ?></div>
                    </div>
                  </div>
                  <div class="card-body">
                    <img class="announcement__img" src="<?= imgSrc($announcement["thumbnail"]) ?>" alt="">

                    <div class="announcement__body">
                      <?= $announcement['content'] ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Main Footer -->
        <?php include "templates/main-footer.php"; ?>
        <!-- End Main Footer -->

      </div>

    </div>
    <?php include "templates/footer.php"; ?>
    <script src="assets/js/plugin/datatables/datatables.min.js"></script>
    <script>
    $(document).ready(function() {
      var oTable = $('#announcement-table').DataTable({
        "order": [
          [1, "asc"]
        ]
      });
    });
    </script>
  </body>

</html>
