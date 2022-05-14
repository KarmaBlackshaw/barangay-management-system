<?php
include 'bootstrap/index.php';

use Carbon\Carbon;

$query = "SELECT * FROM tblblotter";
$result = $conn->query($query);

$blotter = array();


while ($row = $result->fetch_assoc()) {
	$blotter[] = $row;
}

$announcementList = (function () use ($conn) {
	$query = "SELECT id, title, content, thumbnail, created_at FROM announcements";

	return  $conn
		->query($query);
})();

$query1 = "SELECT * FROM tblblotter WHERE `status`='Active'";
$result1 = $conn->query($query1);
$active = $result1->num_rows;

$query2 = "SELECT * FROM tblblotter WHERE `status`='Scheduled'";
$result2 = $conn->query($query2);
$scheduled = $result2->num_rows;

$query3 = "SELECT * FROM tblblotter WHERE `status`='Settled'";
$result3 = $conn->query($query3);
$settled = $result3->num_rows;

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php include 'templates/header.php' ?>
	<title>Announcements - Barangay Services Management System</title>
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
								<h2 class="text-white fw-bold">Announcements</h2>
							</div>
						</div>
					</div>
				</div>
				<div class="page-inner">

					<?php include 'templates/alert.php' ?>

					<div class="row mt--2">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="card-head-row">
										<div class="card-title">Announcement List</div>
										<?php if (isAuthenticated()) : ?>
											<div class="card-tools">
												<a href="#add" data-toggle="modal" class="btn btn-info btn-border btn-round btn-sm">
													<i class="fa fa-plus"></i>
													Announcement
												</a>
											</div>
										<?php endif ?>
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="blottertable" class="display table table-striped">
											<thead>
												<tr>
													<th scope="col">Title</th>
													<th scope="col">Content</th>
													<th scope="col">Created</th>
													<?php if (isAdmin()) : ?>
														<th scope="col">Action</th>
													<?php endif ?>
												</tr>
											</thead>
											<tbody>
												<?php foreach ($announcementList as $announcement) : ?>
													<tr>
														<td><?= ucwords($announcement['title']) ?></td>
														<td><?= ucwords($announcement['content']) ?></td>
														<td><?= Carbon::create($announcement['created_at'])->toDayDateTimeString() ?></td>
														<?php if (isAdmin()) : ?>
															<td>
																<a type="button" href="#edit" data-toggle="modal" class="btn btn-link btn-primary" title="Edit Blotter" onclick="editBlotter1(this)" data-id="<?= $row['id'] ?>" data-complainant="<?= $row['complainant'] ?>" data-respondent="<?= $row['respondent'] ?>" data-victim="<?= $row['victim'] ?>" data-type="<?= $row['type'] ?>" data-l="<?= $row['location'] ?>" data-date="<?= $row['date'] ?>" data-time="<?= $row['time'] ?>" data-details="<?= $row['details'] ?>" data-status="<?= $row['status'] ?>">
																	<?php if (isset($_SESSION['username'])) : ?>
																		<i class="fa fa-edit"></i>
																	<?php else : ?>
																		<i class="fa fa-eye"></i>
																	<?php endif ?>
																</a>

																<?php if (isset($_SESSION['username']) && $_SESSION['role'] == 'administrator') : ?>
																	<a type="button" data-toggle="tooltip" href="model/remove_blotter.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this blotter?');" class="btn btn-link btn-danger" data-original-title="Remove">
																		<i class="fa fa-times"></i>
																	</a>
																<?php endif ?>
															</td>
														<?php endif ?>
													</tr>
												<?php endforeach ?>
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
											<textarea type="text" class="form-control" placeholder="Enter content" name="content" required></textarea>
										</div>
									</div>

									<div class="col-md-12">
										<div class="form-group">
											<label>Thumbnail</label>
											<input type="file" class="form-control" placeholder="Thumbnail" name="thumbnail" accept="image/png, image/jpeg">
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
			<div class="modal fade" id="edit">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Edit Blotter</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form method="POST" action="model/edit_blotter.php">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Complainant</label>
											<input type="text" class="form-control" placeholder="Enter Complainant Name" id="complainant" name="complainant" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Respondent</label>
											<input type="text" class="form-control" placeholder="Enter Respondent Name" id="respondent" name="respondent" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Victim(s)</label>
											<input type="text" class="form-control" placeholder="Enter Victim(s) Name" id="victim" name="victim" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Type</label>
											<select class="form-control" name="type" id="type">
												<option disabled selected>Select Blotter Type</option>
												<option value="Amicable">Amicable</option>
												<option value="Incident">Incident</option>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Location</label>
											<input type="text" class="form-control" placeholder="Enter Location" id="location" name="location" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Date</label>
											<input type="date" class="form-control" name="date" id="date" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Time</label>
											<input type="time" class="form-control" name="time" id="time" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Status</label>
											<select class="form-control" name="status" id="status">
												<option disabled selected>Select Blotter Status</option>
												<option value="Active">Active</option>
												<option value="Settled">Settled</option>
												<option value="Scheduled">Scheduled</option>
											</select>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label>Details</label>
									<textarea class="form-control" placeholder="Enter Blotter or Incident here..." id="details" name="details" required></textarea>
								</div>

						</div>
						<div class="modal-footer">
							<input type="hidden" id="blotter_id" name="id">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<?php if (isAuthenticated()) : ?>
								<button type="submit" class="btn btn-primary">Update</button>
							<?php endif ?>
						</div>
						</form>
					</div>
				</div>
			</div>
			<!-- Main Footer -->
			<?php include 'templates/main-footer.php' ?>
			<!-- End Main Footer -->

		</div>

	</div>
	<?php include 'templates/footer.php' ?>
	<script src="assets/js/plugin/datatables/datatables.min.js"></script>
	<script>
		$(document).ready(function() {
			var oTable = $('#blottertable').DataTable({
				"order": [
					[1, "asc"]
				]
			});

			// $("#activeCase").click(function() {
			// 	var textSelected = 'Active';
			// 	oTable.columns(4).search(textSelected).draw();
			// });
			// $("#settledCase").click(function() {
			// 	var textSelected = 'Settled';
			// 	oTable.columns(4).search(textSelected).draw();
			// });
			// $("#scheduledCase").click(function() {
			// 	var textSelected = 'Scheduled';
			// 	oTable.columns(4).search(textSelected).draw();
			// });
		});
	</script>
</body>

</html>