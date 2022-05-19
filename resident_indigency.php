<?php
include "bootstrap/index.php";
$query = "SELECT * FROM residents";

$result = $conn->query($query);
$resident = [];
while ($row = $result->fetch_assoc()) {
	$resident[] = $row;
}

$residentList = (function () use ($db) {
	// prettier-ignore
	return $db
    ->from("residents")
    ->join("purok", "purok.id", "residents.purok_id")
    ->join("users", "users.id", "residents.account_id")
    ->select([
      "id" => "residents.id",
      "national_id" => "residents.national_id",
      "account_id" => "residents.account_id",
      "citizenship" => "residents.citizenship",
      "avatar" => "users.avatar",
      "firstname" => "residents.firstname",
      "middlename" => "residents.middlename",
      "lastname" => "residents.lastname",
      "alias" => "residents.alias",
      "birthplace" => "residents.birthplace",
      "birthdate" => "residents.birthdate",
      "age" => "residents.age",
      "civilstatus" => "residents.civilstatus",
      "gender" => "residents.gender",
      "voterstatus" => "residents.voterstatus",
      "identified_as" => "residents.identified_as",
      "phone" => "residents.phone",
      "email" => "residents.email",
      "occupation" => "residents.occupation",
      "address" => "residents.address",
      "resident_type" => "residents.resident_type",
      "remarks" => "residents.remarks",
      "purok_id" => "purok.id",
      "purok_name" => "purok.name",
      "purok_details" => "purok.details",
    ])
    ->exec();
})();
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php include "templates/header.php"; ?>
	<title>Certificate of Indigency - Barangay Services Management System</title>
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
								<h2 class="text-white fw-bold">Certificate of Indigency</h2>
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
													<?php if (isAuthenticated()): ?>
														<?php if (isAdmin()): ?>
															<th scope="col">Voter Status</th>
														<?php endif; ?>
														<th scope="col">Action</th>
													<?php endif; ?>
												</tr>
											</thead>
											<tbody>
												<?php if (!empty($residentList)): ?>
													<?php foreach ($residentList as $row): ?>
														<tr>
                              <td>
                                <div class="row">
                                  <div class="col-2 d-flex justify-content-center align-items-center">
                                    <img
                                      src="<?= imgSrc($row["avatar"], "img/person.png") ?>"
                                      alt="..."
                                      class="avatar-img rounded-circle avatar avatar-xs"
                                    >
                                  </div>
                                  <div class="col text-truncate">
                                    <?= ucwords($row["lastname"] . ", " . $row["firstname"]) ?>
                                  </div>
                                </div>
                              </td>
															<td><?= $row["national_id"] ?></td>
															<td><?= $row["alias"] ?></td>
                              <td><?= empty($row["birthdate"]) ? "-" : $row["birthdate"] ?></td>
															<td><?= $row["age"] ?></td>
															<td><?= $row["civilstatus"] ?></td>
															<td><?= $row["gender"] ?></td>
															<td><?= $row["purok_name"] ?></td>
															<?php if (isAuthenticated()): ?>
																<?php if (isAdmin()): ?>
																	<td><?= $row["voterstatus"] ?></td>
																<?php endif; ?>
																<td>
																	<div class="form-button-action">
																		<a
																			type="button"
																			data-toggle="tooltip"
																			href="generate_indi_cert.php?id=<?= $row["id"] ?>"
																			class="btn btn-link btn-primary"
																			data-original-title="Generate Certificate"
																		>
																			<i class="fas fa-file-alt"></i>
																		</a>
																	</div>
																</td>
															<?php endif; ?>

														</tr>
													<?php endforeach; ?>
												<?php endif; ?>
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
													<?php if (isAuthenticated()): ?>
														<?php if (isAdmin()): ?>
															<th scope="col">Voter Status</th>
														<?php endif; ?>
														<th scope="col">Action</th>
													<?php endif; ?>
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
			<?php include "templates/main-footer.php"; ?>
			<!-- End Main Footer -->

		</div>

	</div>
	<?php include "templates/footer.php"; ?>
	<script src="assets/js/plugin/datatables/datatables.min.js"></script>
	<script>
		$(document).ready(function() {
			$('#residenttable').DataTable();
		});
	</script>
</body>

</html>