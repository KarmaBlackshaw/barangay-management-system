<?php
require 'bootstrap/index.php';

$revenue = (function () use ($db) {
	return $db
	->from('payments')
  ->join("users", "users.id", "payments.user_id")
  ->join("residents", "residents.id", "payments.resident_id")
	->orderBy('created_at', 'desc')
  ->select([
    "details" => "payments.details",
    "amount" => "payments.amount",
    "mode" => "payments.mode",
    "created_at" => "payments.created_at",
    "firstname" => "residents.firstname",
    "middlename" => "residents.middlename",
    "lastname" => "residents.lastname",
    "admin_username" => "users.username",
  ])
	->exec();
})();

?>
<!DOCTYPE html>
<html lang="en">

  <head>
    <?php include 'templates/header.php' ?>
    <link rel="stylesheet" href="assets/js/plugin/dataTables.dateTime.min.css">
    <link rel="stylesheet" href="assets/js/plugin/datatables/Buttons-1.6.1/css/buttons.dataTables.min.css">
    <title>Barangay Collection Payment - Barangay
      Services Management System</title>
  </head>

  <body>
    <?php include 'templates/loading_screen.php' ?>
    <div class="wrapper">
      <!-- Main Header -->
      <?php include 'templates/main-header.php' ?>
      <!-- End Main Header -->

      <!-- Sidebar -->
      <?php include 'templates/sidebar.php' ?>
      <!-- End Sidebar -->

      <div class="main-panel">
        <div class="content">
          <div class="panel-header bg-primary-gradient">
            <div class="page-inner">
              <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                  <h2 class="text-white fw-bold">
                    Barangay Collection Payment
                  </h2>
                </div>
              </div>
            </div>
          </div>
          <div class="page-inner">
            <div class="row mt--2">
              <div class="col-md-12">

                <?php include "templates/alert.php"; ?>

                <div class="card">
                  <div class="card-header">
                    <div class="card-head-row">
                      <div class="card-title">
                        Collection Payment
                        Informations</div>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="row mb-3 w-50">
                      <div class="col">
                        <label>Minimum
                          Date</label>
                        <input type="text" class="form-control" placeholder="Enter date" id="min">
                      </div>
                      <div class="col">
                        <label>Maximum
                          Date</label>
                        <input type="text" class="form-control" placeholder="Enter date" id="max">
                      </div>
                    </div>
                    <div class="table-responsive">
                      <table id="revenuetable" class="display table table-striped">
                        <thead>
                          <tr>
                            <th scope="col">Date
                            </th>
                            <th scope="col">
                              Recipient</th>
                            <th scope="col">
                              Details</th>
                            <th scope="col">Amount
                            </th>
                            <th scope="col">
                              Username</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php if (!empty($revenue)) : ?>
                          <?php foreach ($revenue as $row) : ?>
                          <tr>
                            <td>
                              <?= $row['created_at'] ?>
                            </td>
                            <td>
                              <?= fullname($row) ?>
                            </td>
                            <td>
                              <?= $row['details'] ?>
                            </td>
                            <td>₱
                              <?= number_format($row['amount'], 2) ?>
                            </td>
                            <td>
                              <?= $row['admin_username'] ?>
                            </td>
                          </tr>
                          <?php endforeach ?>
                          <?php endif ?>
                        </tbody>
                        <tfoot>
                          <tr>
                            <th scope="col">Date
                            </th>
                            <th scope="col">
                              Recipient</th>
                            <th scope="col">
                              Details</th>
                            <th scope="col">Amount
                            </th>
                            <th scope="col">
                              Username</th>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Main Footer -->
        <?php include 'templates/main-footer.php' ?>
        <!-- End Main Footer -->

      </div>

    </div>
    <?php include 'templates/footer.php' ?>
    <script src="assets/js/plugin/datatables/datatables.min.js">
    </script>
    <script src="assets/js/plugin/moment/moment.min.js">
    </script>
    <script src="assets/js/plugin/dataTables.dateTime.min.js">
    </script>
    <script src="assets/js/plugin/datatables/Buttons-1.6.1/js/dataTables.buttons.min.js">
    </script>
    <script src="assets/js/plugin/datatables/Buttons-1.6.1/js/buttons.print.min.js">
    </script>
    <script>
    var minDate, maxDate;

    // Custom filtering function which will search data in column four between two values
    $.fn.dataTable.ext.search.push(
      function(settings, data, dataIndex) {
        var min = minDate.val();
        var max = maxDate.val();
        var date = new Date(data[0]);

        if (
          (min === null && max === null) ||
          (min === null && date <= max) ||
          (min <= date && max === null) ||
          (min <= date && date <= max)
        ) {
          return true;
        }
        return false;
      }
    );
    $(document).ready(function() {
      // Create date inputs
      minDate = new DateTime($('#min'), {
        format: 'MMMM Do YYYY'
      });
      maxDate = new DateTime($('#max'), {
        format: 'MMMM Do YYYY'
      });

      var table = $('#revenuetable')
        .DataTable({
          "order": [
            [0, "desc"]
          ],
          dom: 'Bfrtip',
          buttons: [
            'print'
          ]
        });

      // Refilter the table
      $('#min, #max').on('change',
        function() {
          table.draw();
        });
    });
    </script>
  </body>

</html>
