<?php include 'server/server.php' ?>
<?php
$query = "SELECT * FROM tblresident";
$result = $conn->query($query);

$resident = array();
while ($row = $result->fetch_assoc()) {
	$resident[] = $row;
}

$query1 = "SELECT * FROM tblpurok ORDER BY `name`";
$result1 = $conn->query($query1);

$purok = array();
while ($row = $result1->fetch_assoc()) {
	$purok[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php include 'templates/header.php' ?>
	<title>Certificate of Indigency - Barangay Services Management System</title>
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
								<h2 class="text-white fw-bold">Certificate of Indigency</h2>
							</div>
						</div>
					</div>
				</div>
				<div class="page-inner">
					<div class="row mt--2">
						<div class="col-md-12">

							<?php if (isset($_SESSION['message'])) : ?>
								<div class="alert alert-<?php echo $_SESSION['status']; ?> <?= $_SESSION['status'] == 'danger' ? 'bg-danger text-light' : null ?>" role="alert">
									<?php echo $_SESSION['message']; ?>
								</div>
								<?php unset($_SESSION['message']); ?>
							<?php endif ?>

							<div class="card">
								<div class="card-header">
									<div class="card-head-row">
										<div class="card-title">Resident Certificate of Indigency</div>
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="residenttable" class="display table table-striped">
											<thead>
												<tr>
													<th scope="col">Fullname</th>
													<th scope="col">National ID</th>
													<th scope="col">Alias</th>
													<th scope="col">Birthdate</th>
													<th scope="col">Age</th>
													<th scope="col">Civil Status</th>
													<th scope="col">Gender</th>
													<th scope="col">Purok</th>
													<?php if (isset($_SESSION['username'])) : ?>
														<?php if ($_SESSION['role'] == 'administrator') : ?>
															<th scope="col">Voter Status</th>
														<?php endif ?>
														<th scope="col">Action</th>
													<?php endif ?>
												</tr>
											</thead>
											<tbody>
												<?php if (!empty($resident)) : ?>
													<?php $no = 1;
													foreach ($resident as $row) : ?>
														<tr>
															<td>
																<div class="avatar avatar-xs">
																	<img src="<?= preg_match('/data:image/i', $row['picture']) ? $row['picture'] : 'assets/uploads/resident_profile/' . $row['picture'] ?>" alt="Resident Profile" class="avatar-img rounded-circle">
																</div>
																<?= ucwords($row['lastname'] . ', ' . $row['firstname'] . ' ' . $row['middlename']) ?>
															</td>
															<td><?= $row['national_id'] ?></td>
															<td><?= $row['alias'] ?></td>
															<td><?= $row['birthdate'] ?></td>
															<td><?= $row['age'] ?></td>
															<td><?= $row['civilstatus'] ?></td>
															<td><?= $row['gender'] ?></td>
															<td><?= $row['purok'] ?></td>
															<?php if (isset($_SESSION['username'])) : ?>
																<?php if ($_SESSION['role'] == 'administrator') : ?>
																	<td><?= $row['voterstatus'] ?></td>
																<?php endif ?>
																<td>
																	<div class="form-button-action">
																		<a type="button" data-toggle="tooltip" href="generate_indi_cert.php?id=<?= $row['id'] ?>" class="btn btn-link btn-primary" data-original-title="Generate Certificate">
																			<i class="fas fa-file-alt"></i>
																		</a>
																	</div>
																</td>
															<?php endif ?>

														</tr>
													<?php $no++;
													endforeach ?>
												<?php endif ?>
											</tbody>
											<tfoot>
												<tr>
													<th scope="col">Fullname</th>
													<th scope="col">National ID</th>
													<th scope="col">Alias</th>
													<th scope="col">Birthdate</th>
													<th scope="col">Age</th>
													<th scope="col">Civil Status</th>
													<th scope="col">Gender</th>
													<th scope="col">Purok</th>
													<?php if (isset($_SESSION['username'])) : ?>
														<?php if ($_SESSION['role'] == 'administrator') : ?>
															<th scope="col">Voter Status</th>
														<?php endif ?>
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