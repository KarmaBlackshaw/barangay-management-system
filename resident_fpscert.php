<?php include 'bootstrap/index.php' ?>
<?php
$query = "SELECT * FROM tblfpscert";
$result = $conn->query($query);

$request = array();
while ($row = $result->fetch_assoc()) {
	$request[] = $row;
}

?>
<!DOCTYPE html>
<html lang="en">

  <head>
    <?php include 'templates/header.php' ?>
    <title>4ps Certification - Barangay Services Management System</title>
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
                  <h2 class="text-white fw-bold">4ps Cetification</h2>
                </div>
              </div>
            </div>
          </div>
          <div class="page-inner">
            <div class="row mt--3">
              <div class="col-md-12">

                <?php include "templates/alert.php"; ?>

                <div class="card">
                  <div class="card-header">
                    <div class="card-head-row">
                      <div class="card-title">4ps Certificate Issuance</div>
                      <?php if (isset($_SESSION['username'])) : ?>
                      <div class="card-tools">
                        <a href="#add" data-toggle="modal" class="btn btn-info btn-border btn-round btn-sm">
                          <i class="fa fa-plus"></i>
                          4ps certificate
                        </a>
                      </div>
                      <?php endif ?>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table id="residenttable" class="display table table-striped">
                        <thead>
                          <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Current Location</th>
                            <th scope="col">Date</th>
                            <?php if (isset($_SESSION['username'])) : ?>
                            <th scope="col">Action</th>
                            <?php endif ?>
                          </tr>
                        </thead>
                        <tbody>
                          <?php if (!empty($request)) : ?>
                          <?php foreach ($request as $row) : ?>
                          <tr>
                            <td><?= ucwords($row['name']) ?></td>
                            <td><?= ucwords($row['current_location']) ?></td>
                            <td><?= $row['applied'] ?></td>
                            <?php if (isset($_SESSION['username'])) : ?>
                            <td>

                              <div class="form-button-action">
                                <a type="button" data-toggle="tooltip" href="generate_fpscert.php?id=<?= $row['id'] ?>"
                                  class="btn btn-link btn-primary" data-original-title="Generate Permit">
                                  <i class="fas fa-file-alt"></i>
                                </a>
                                <?php if (isset($_SESSION['username']) && $_SESSION['role'] == 'administrator') : ?>
                                <a type="button" data-toggle="tooltip"
                                  href="model/remove_fourps.php?id=<?= $row['id'] ?>"
                                  onclick="return confirm('Are you sure you want to delete this 4ps Certification?');"
                                  class="btn btn-link btn-danger" data-original-title="Remove">
                                  <i class="fa fa-times"></i>
                                </a>
                                <?php endif ?>
                              </div>
                            </td>
                            <?php endif ?>

                          </tr>
                          <?php endforeach ?>
                          <?php endif ?>
                        </tbody>
                        <tfoot>
                          <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Current Location</th>
                            <th scope="col">Date</th>
                            <?php if (isset($_SESSION['username'])) : ?>
                            <th scope="col">Action</th>
                            <?php endif ?>
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

        <!-- Modal -->
        <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Cutting Permit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form method="POST" action="model/save_fpscert.php">
                  <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" placeholder="Enter Name" name="name" required>
                  </div>



                  <div class="form-group">
                    <label>Current Location</label>
                    <input type="text" class="form-control" placeholder="current_location" name="current_location"
                      required>
                  </div>


                  <div class="form-group">
                    <label>Date</label>
                    <input type="date" class="form-control" name="applied" value="<?= date('Y-m-d'); ?>" required>
                  </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Create</button>
              </div>
              </form>
            </div>
          </div>
        </div>

      </div>
    </div>
    <?php include 'templates/footer.php' ?>
    <script src="assets/js/plugin/datatables/datatables.min.js"></script>
    <script>
    $(document).ready(function() {
      $('#residenttable').DataTable();
    });
    </script>
  </body>

</html>
