<?php include "bootstrap/index.php"; ?>
<?php
$query = "SELECT * FROM tblblotter";
$result = $conn->query($query);
$blotter = [];
while ($row = $result->fetch_assoc()) {
	$blotter[] = $row;
}
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
	<?php include "templates/header.php"; ?>
	<title>Blotter/Incident Complaint - Barangay Services Management System</title>
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
							<div>
								<h2 class="text-white fw-bold">Blotter/Incident Complaint</h2>
							</div>
						</div>
					</div>
				</div>
				<div class="page-inner">
					<?php include "templates/alert.php"; ?>

					<div class="row mt--2">
						<div class="col-md-9">
							<div class="card">
								<div class="card-header">
									<div class="card-head-row">
										<div class="card-title">All Resident</div>
										<?php if (isset($_SESSION["username"])): ?>
											<div class="card-tools">
												<a href="#add" data-toggle="modal" class="btn btn-info btn-border btn-round btn-sm">
													<i class="fa fa-plus"></i>
													Blotter/Incident
												</a>
											</div>
										<?php endif; ?>
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="blottertable" class="display table table-striped">
											<thead>
												<tr>
													<th scope="col">Complainant</th>
													<th scope="col">Respondent</th>
													<th scope="col">Victim(s)</th>
													<th scope="col">Blotter/Incident</th>
													<th scope="col">Status</th>
													<?php if (isset($_SESSION["username"])): ?>
														<th scope="col">Action</th>
													<?php endif; ?>
												</tr>
											</thead>
											<tbody>
												<?php if (!empty($blotter)): ?>
													<?php foreach ($blotter as $row): ?>
														<tr>
															<td><?= ucwords($row["complainant"]) ?></td>
															<td><?= ucwords($row["respondent"]) ?></td>
															<td><?= ucwords($row["victim"]) ?></td>
															<td><?= ucwords($row["type"]) ?></td>
															<td>
																<?php if ($row["status"] == "Scheduled"): ?>
																	<span class="badge badge-warning">Scheduled</span>
																<?php elseif ($row["status"] == "Active"): ?>
																	<span class="badge badge-danger">Active</span>
																<?php else: ?>
																	<span class="badge badge-success">Settled</span>
																<?php endif; ?>
															</td>
															<?php if (isset($_SESSION["username"])): ?>
																<td>
																	<a
																		type="button"
																		href="#edit"
																		data-toggle="modal"
																		class="btn btn-link btn-primary"
																		title="Edit Blotter"
																		onclick="editBlotter1(this)"
																		data-id="<?= $row["id"] ?>"
																		data-complainant="<?= $row["complainant"] ?>"
																		data-respondent="<?= $row["respondent"] ?>"
																		data-victim="<?= $row["victim"] ?>"
																		data-type="<?= $row["type"] ?>"
																		data-l="<?= $row["location"] ?>"
																		data-date="<?= $row["date"] ?>"
																		data-time="<?= $row["time"] ?>"
																		data-details="<?= $row["details"] ?>"
																		data-status="<?= $row["status"] ?>"
																	>
																		<?php if (isset($_SESSION["username"])): ?>
																			<i class="fa fa-edit"></i>
																		<?php else: ?>
																			<i class="fa fa-eye"></i>
																		<?php endif; ?>
																	</a>
																	<a
																		type="button"
																		data-toggle="tooltip"
																		href="generate_blotter_report.php?id=<?= $row["id"] ?>"
																		class="btn btn-link btn-primary"
																		data-original-title="Generate Report"
																	>
																		<i class="fas fa-file-alt"></i>
																	</a>
																	<?php if (isAdmin()): ?>
																		<a
																			type="button"
																			data-toggle="tooltip"
																			href="model/remove_blotter.php?id=<?= $row["id"] ?>"
																			onclick="confirm('Are you sure you want to delete this blotter?');"
																			class="btn btn-link btn-danger"
																			data-original-title="Remove"
																		>
																			<i class="fa fa-times"></i>
																		</a>
																	<?php endif; ?>
																</td>
															<?php endif; ?>
														</tr>
													<?php endforeach; ?>
												<?php endif; ?>
											</tbody>
											<tfoot>
												<tr>
													<th scope="col">Complainant</th>
													<th scope="col">Respondent</th>
													<th scope="col">Victim(s)</th>
													<th scope="col">Blotter/Incident</th>
													<th scope="col">Status</th>
													<?php if (isset($_SESSION["username"])): ?>
														<th scope="col">Action</th>
													<?php endif; ?>
												</tr>
											</tfoot>
										</table>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="card card-stats card-danger card-round">
								<div class="card-body">
									<div class="row">
										<div class="col-3">
											<div class="icon-big text-center">
												<i class="flaticon-users"></i>
											</div>
										</div>
										<div class="col-6 col-stats">
										</div>
										<div class="col-3 col-stats">
											<div class="numbers">
												<p class="card-category">Active</p>
												<h4 class="card-title"><?= number_format($active) ?></h4>
											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
									<a href="javascript:void(0)" id="activeCase" class="card-link text-light">Active Case </a>
								</div>
							</div>
							<div class="card card-stats card-success card-round">
								<div class="card-body">
									<div class="row">
										<div class="col-3">
											<div class="icon-big text-center">
												<i class="flaticon-users"></i>
											</div>
										</div>
										<div class="col-6 col-stats">
										</div>
										<div class="col-3 col-stats">
											<div class="numbers">
												<p class="card-category">Settled</p>
												<h4 class="card-title"><?= number_format($settled) ?></h4>
											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
									<a href="javascript:void(0)" id="settledCase" class="card-link text-light">Settled Case </a>
								</div>
							</div>
							<div class="card card-stats card-warning card-round">
								<div class="card-body">
									<div class="row">
										<div class="col-3">
											<div class="icon-big text-center">
												<i class="flaticon-users"></i>
											</div>
										</div>
										<div class="col-6 col-stats">
										</div>
										<div class="col-3 col-stats">
											<div class="numbers">
												<p class="card-category">Scheduled</p>
												<h4 class="card-title"><?= number_format($scheduled) ?></h4>
											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
									<a href="javascript:void(0)" id="scheduledCase" class="card-link text-light">Scheduled Case </a>
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
							<h5 class="modal-title" id="exampleModalLabel">Manage Blotter</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form method="POST" action="model/save_blotter.php">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Complainant</label>
											<input type="text" class="form-control" placeholder="Enter Complainant Name" name="complainant" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Respondent</label>
											<input type="text" class="form-control" placeholder="Enter Respondent Name" name="respondent" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Victim(s)</label>
											<input type="text" class="form-control" placeholder="Enter Victim(s) Name" name="victim" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Type</label>
											<select class="form-control" name="type">
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
											<input type="text" class="form-control" placeholder="Enter Location" name="location" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Date</label>
											<input type="date" class="form-control" name="date" value="<?= date("Y-m-d") ?>" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Time</label>
											<input type="time" class="form-control" name="time" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Status</label>
											<select class="form-control" name="status">
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
									<textarea class="form-control" placeholder="Enter Blotter or Incident here..." name="details" required></textarea>
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
			<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
							<?php if (isset($_SESSION["username"])): ?>
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
			var oTable = $('#blottertable').DataTable({
				"order": [
					[4, "asc"]
				]
			});

			$("#activeCase").click(function() {
				var textSelected = 'Active';
				oTable.columns(4).search(textSelected).draw();
			});
			$("#settledCase").click(function() {
				var textSelected = 'Settled';
				oTable.columns(4).search(textSelected).draw();
			});
			$("#scheduledCase").click(function() {
				var textSelected = 'Scheduled';
				oTable.columns(4).search(textSelected).draw();
			});
		});
	</script>
</body>

</html>