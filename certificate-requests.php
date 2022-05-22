<?php
include "bootstrap/index.php";

use Carbon\Carbon;

$query = "SELECT * FROM tblblotter";
$result = $conn->query($query);

$blotter = [];

while ($row = $result->fetch_assoc()) {
	$blotter[] = $row;
}

$announcementList = [];

$certificates = $db
  ->from('certificates')
  ->select([
    "id" => "certificates.id",
    "name" => "certificates.name",
    "create_url" => "certificates.create_url",
  ])
  ->exec();

$residentDetails = $db
  ->from('residents')
  ->where('account_id', $_SESSION['id'])
  ->first()
  ->select([
    "id" => "residents.id"
  ])
  ->exec();

$requestList = $db
  ->from(["certificate_requests" => "cr"])
  ->join("certificates", "certificates.id", "cr.certificate_id")
  ->where("resident_id", $residentDetails['id'])
  ->select([
    "id" => "cr.id",
    "certificate_id" => "cr.certificate_id",
    "status" => "cr.status",
    "memo" => "cr.memo",
    "created_at" => "cr.created_at",
    "certificate_id" => "certificates.id",
    "certificate_name" => "certificates.name",
  ])
  ->exec();

?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <?php include "templates/header.php"; ?>
    <title>Announcements - Barangay Services Management System</title>
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
                <h2 class="text-white fw-bold">Certificate Requests</h2>
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
                      <div class="card-title">Requests List</div>
                      <?php if (isUser()): ?>
                      <div class="card-tools">
                        <a href="#add" data-toggle="modal" class="btn btn-info btn-border btn-round btn-sm">
                          <i class="fa fa-plus"></i>
                          Request
                        </a>
                      </div>
                      <?php endif; ?>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table id="announcement-table" class="display table table-striped">
                        <thead>
                          <tr>
                            <th scope="col">Certificate</th>
                            <th scope="col">Memo</th>
                            <th scope="col">Status</th>
                            <th scope="col">Request Date</th>
                            <th scope="col"></th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($requestList as $request): ?>
                          <tr>
                            <td><?= $request["certificate_name"] ?></td>
                            <td><?= $request["memo"] ?></td>
                            <td><?= ucwords($request["status"]) ?></td>
                            <td><?= Carbon::create($request["created_at"])->toDayDateTimeString() ?></td>
                            <td>
                              <?php if (isUser()): ?>
                              <a href="javascript:void(0)" data-target="#edit-request"
                                data-value-id="<?= $request["id"] ?>" data-value-memo="<?= $request["memo"] ?>"
                                data-value-certificate_id="<?= $request["certificate_id"] ?>" onclick="showModal(this)">
                                <i class="fa fa-edit"></i>
                              </a>
                              <?php endif; ?>

                              <?php if (isAdmin()): ?>
                              <a href="announcements-view.php?id=<?= $request["id"] ?>">
                                <i class="fa fa-eye"></i>
                              </a>
                              <?php endif; ?>

                              <?php if (role(["user", "administrator"])): ?>
                              <a type="button" data-toggle="tooltip" data-original-title="Remove"
                                href="model/certificate-request.php?id=<?= $request["id"] ?>&delete-request=1"
                                onclick="return confirm('Are you sure you want to delete this blotter?');"
                                class="btn btn-link btn-danger">
                                <i class="fa fa-times"></i>
                              </a>
                              <?php endif; ?>
                            </td>
                          </tr>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="add">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Request Certificate</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form method="POST" action="model/certificate-request.php" enctype="multipart/form-data">
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Certificate</label>
                        <select name="certificate_id" class="form-control">
                          <option selected disabled>Select Certificate</option>
                          <?php foreach ($certificates as $certificate): ?>
                          <option value="<?= $certificate['id'] ?>"><?= $certificate['name'] ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Memo</label>
                        <textarea type="text" class="form-control" placeholder="Enter content" name="memo"
                          required></textarea>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <input type="hidden" name="resident_id" value="<?= $residentDetails['id'] ?>">
                  <input type="hidden" name="request-certificate" value="1">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="edit-request">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <form method="POST" action="model/certificate-request.php" enctype="multipart/form-data">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Edit Blotter</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <input type="hidden" name="edit-request" value="1">

                  <input type="hidden" id="edit-request-id" name="id" required>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Certificate</label>
                      <select name="certificate_id" id="edit-request-certificate_id" class="form-control">
                        <option selected disabled>Select Certificate</option>
                        <?php foreach ($certificates as $certificate): ?>
                        <option value="<?= $certificate['id'] ?>"><?= $certificate['name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Memo</label>
                      <textarea type="text" class="form-control" placeholder="Enter Complainant Name"
                        id="edit-request-memo" name="memo" required <?= ifThen(!isUser(), "readonly") ?>></textarea>
                    </div>
                  </div>

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                  <?php if (isUser()): ?>
                  <button type="submit" class="btn btn-primary">Update</button>
                  <?php endif; ?>
                </div>
              </form>
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
