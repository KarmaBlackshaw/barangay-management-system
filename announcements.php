<?php
include "bootstrap/index.php";

use Carbon\Carbon;

$query = "SELECT * FROM tblblotter";
$result = $conn->query($query);

$blotter = [];

while ($row = $result->fetch_assoc()) {
	$blotter[] = $row;
}

$announcementList = (function () use ($db) {
	return $db
		->from(["announcements" => "a"])
		->select([
			"id" => "a.id",
			"title" => "a.title",
			"content" => "a.content",
			"thumbnail" => "a.thumbnail",
			"created_at" => "a.created_at",
		])
		->exec();
})();
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
                      <div class="card-title">Announcement List</div>
                      <?php if (role(['administrator', 'staff'])): ?>
                      <div class="card-tools">
                        <a href="#add" data-toggle="modal" class="btn btn-info btn-border btn-round btn-sm">
                          <i class="fa fa-plus"></i>
                          Announcement
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
                            <th scope="col">Title</th>
                            <th scope="col">Content</th>
                            <th scope="col">Created</th>
                            <?php if (isAdmin()): ?>
                            <th scope="col">Action</th>
                            <?php endif; ?>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($announcementList as $announcement): ?>
                          <tr>
                            <td><?= ucwords($announcement["title"]) ?></td>
                            <td><?= ucwords($announcement["content"]) ?></td>
                            <td><?= Carbon::create($announcement["created_at"])->toDayDateTimeString() ?></td>
                            <td>
                              <?php if (role(['administrator', 'staff'])): ?>
                              <a href="javascript:void(0)" data-target="#edit-announcement"
                                data-value-id="<?= $announcement["id"] ?>"
                                data-value-title="<?= $announcement["title"] ?>"
                                data-value-content="<?= $announcement["content"] ?>"
                                data-value-old-thumbnail="<?= $announcement["thumbnail"] ?>"
                                data-value-preview="<?= imgSrc($announcement["thumbnail"]) ?>" onclick="showModal(this)"
                                class="btn btn-link btn-primary">
                                <i class="fa fa-edit"></i>
                              </a>
                              <?php endif; ?>

                              <?php if (isUser()): ?>
                              <a href="announcements-view.php?id=<?= $announcement["id"] ?>">
                                <i class="fa fa-eye"></i>
                              </a>
                              <?php endif; ?>

                              <?php if (role(['administrator', 'staff'])): ?>
                              <a type="button" data-toggle="tooltip" data-original-title="Remove"
                                href="model/announcement.php?id=<?= $announcement["id"] ?>&delete-announcement=1"
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
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Register Announcement</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form method="POST" action="model/announcement.php" enctype="multipart/form-data">
                  <input type="hidden" name="register-announcement" value="1">

                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" placeholder="Enter title" name="title" required>
                      </div>
                    </div>

                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Content</label>
                        <textarea type="text" class="form-control" placeholder="Enter content" name="content"
                          required></textarea>
                      </div>
                    </div>

                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Thumbnail</label>
                        <input type="file" class="form-control" placeholder="Thumbnail" name="thumbnail"
                          accept="image/png, image/jpeg">
                      </div>
                    </div>
                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
              </form>
            </div>
          </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="edit-announcement">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <form method="POST" action="model/announcement.php" enctype="multipart/form-data">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Edit Blotter</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <input type="hidden" name="edit-announcement" value="1">

                  <input type="hidden" id="edit-announcement-id" name="id" required>

                  <input type="hidden" id="edit-announcement-old-thumbnail" name="old-thumbnail" required>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Title</label>
                      <input type="text" class="form-control" placeholder="Enter Complainant Name"
                        id="edit-announcement-title" name="title" required <?= ifThen(!isAdmin(), "readonly") ?>>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Content</label>
                      <textarea type="text" class="form-control" placeholder="Enter Complainant Name"
                        id="edit-announcement-content" name="content" required
                        <?= ifThen(!isAdmin(), "readonly") ?>></textarea>
                    </div>
                  </div>

                  <?php if (isAdmin()): ?>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Thumbnail</label>
                      <input type="file" class="form-control" placeholder="Thumbnail" name="thumbnail"
                        accept="image/png, image/jpeg">
                    </div>
                  </div>
                  <?php endif; ?>

                  <div class="col-md-12">
                    <div class="form-group d-flex justify-content-center">
                      <img src="" alt="" id="edit-announcement-preview" class="w-100">
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                  <?php if (isAdmin()): ?>
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
