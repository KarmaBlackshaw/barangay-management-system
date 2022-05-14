<?php include 'server/server.php' ?>
<?php

	$query = "SELECT * FROM tblresident WHERE resident_type=1";
	$result = $conn->query($query);
	$total = $result->num_rows;

	$query1 = "SELECT * FROM tblresident WHERE gender='Male' AND resident_type=1";
	$result1 = $conn->query($query1);
	$male = $result1->num_rows;

	$query2 = "SELECT * FROM tblresident WHERE gender='Female' AND resident_type=1";
	$result2 = $conn->query($query2);
	$female = $result2->num_rows;

	$query3 = "SELECT * FROM tblresident WHERE voterstatus='Yes' AND resident_type=1";
	$result3 = $conn->query($query3);
	$totalvoters = $result3->num_rows;

	$query4 = "SELECT * FROM tblresident WHERE voterstatus='No' AND resident_type=1";
	$non = $conn->query($query4)->num_rows;

	$query5 = "SELECT * FROM tblpurok";
	$purok = $conn->query($query5)->num_rows;

	$query6 = "SELECT * FROM tblprecinct";
	$precinct = $conn->query($query6)->num_rows;

	$query7 = "SELECT * FROM tblblotter";
	$blotter = $conn->query($query7)->num_rows;

	$date = date('Y-m-d');
	$query8 = "SELECT SUM(amounts) as am FROM tblpayments WHERE `date`='$date'";
	$revenue = $conn->query($query8)->fetch_assoc();

	$query9 = "SELECT * FROM tbldocuments";
	$documents = $conn->query($query9)->num_rows;

	$query10 = "SELECT * FROM tbldocuments";
	$documents = $conn->query($query9)->num_rows;
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Dashboard -  Barangay Services Management System</title>
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
								<h2 class="text-white fw-bold">Dashboard</h2>
							</div>
						</div>
					</div>
				</div>
				<div class="page-inner mt--2">
					<?php if(isset($_SESSION['message'])): ?>
							<div class="alert alert-<?= $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? 'bg-danger text-light' : null ?>" role="alert">
								<?php echo $_SESSION['message']; ?>
							</div>
						<?php unset($_SESSION['message']); ?>
						<?php endif ?>
					<div class="row">
						<div class="col-md-4">
							<div class="card card-stats card-primary card-round">
								<div class="card-body">
									<div class="row">
										<div class="col-2">
											<div class="icon-big text-center">
												<i class="flaticon-users"></i>
											</div>
										</div>
										<div class="col-3 col-stats">
										</div>
										<div class="col-6 col-stats">
											<div class="numbers mt-4">
												<h7 class="fw-bold text-uppercase">Population</h7>
												<h3 class="fw-bold text-uppercase"><?= number_format($total) ?></h3>
											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
									<a href="resident_info.php?state=all" class="card-link text-light">Total Population </a>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card card-stats card-secondary card-round">
								<div class="card-body">
									<div class="row">
										<div class="col-2">
											<div class="icon-big text-center">
												<i class="flaticon-user"></i>
											</div>
										</div>
										<div class="col-3 col-stats">
										</div>
										<div class="col-6 col-stats">
											<div class="numbers mt-4">
												<h7 class="fw-bold text-uppercase">Male</h7>
												<h3 class="fw-bold"><?= number_format($male) ?></h3>
											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
									<a href="resident_info.php?state=male" class="card-link text-light">Total Male </a>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card card-stats card-warning card-round">
								<div class="card-body">
									<div class="row">
										<div class="col-2">
											<div class="icon-big text-center">
												<i class="icon-user-female"></i>
											</div>
										</div>
										<div class="col-3 col-stats">
										</div>
										<div class="col-6 col-stats">
											<div class="numbers mt-4">
												<h7 class="fw-bold text-uppercase">Female</h7>
												<h3 class="fw-bold text-uppercase"><?= number_format($female) ?></h3>
											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
									<a href="resident_info.php?state=female" class="card-link text-light">Total Female </a>
								</div>
							</div>
						</div>
					</div>
					<?php if(isset($_SESSION['username']) && $_SESSION['role']=='administrator'):?>
					<div class="row">
						<div class="col-md-4">
							<div class="card card-stats card-success card-round">
								<div class="card-body">
									<div class="row">
										<div class="col-2">
											<div class="icon-big text-center">
												<i class="fas fa-fingerprint"></i>
											</div>
										</div>
										<div class="col-3 col-stats">
										</div>
										<div class="col-6 col-stats">
											<div class="numbers mt-4">
												<h7 class="fw-bold text-uppercase">Voters</h7>
												<h3 class="fw-bold text-uppercase"><?= number_format($totalvoters) ?></h3>
											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
									<a href="resident_info.php?state=voters" class="card-link text-light">Total Voters </a>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card card-stats card-info card-round">
								<div class="card-body">
									<div class="row">
										<div class="col-2">
											<div class="icon-big text-center">
												<i class="flaticon-users"></i>
											</div>
										</div>
										<div class="col-3 col-stats">
										</div>
										<div class="col-6 col-stats">
											<div class="numbers mt-4">
												<h7 class="fw-bold text-uppercase">Non Voters</h7>
												<h3 class="fw-bold text-uppercase"><?= number_format($non) ?></h3>
											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
									<a href="resident_info.php?state=non_voters" class="card-link text-light">Total Non Voters </a>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card card-stats card-round" style="background-color:#a349a3; color:#fff">
								<div class="card-body">
									<div class="row">
										<div class="col-2">
											<div class="icon-big text-center">
												<i class="fas fa-phone"></i>
											</div>
										</div>
										<div class="col-3 col-stats">
										</div>
										<div class="col-6 col-stats">
											<div class="numbers mt-4">
												<h7 class="fw-bold text-uppercase">Contact Number</h7>
												<h7 class="fw-bold"><?= number_format($precinct) ?></h7>
											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
									<a href="purok_info.php?state=precinct" class="card-link text-light">Contact Number Information</a>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card card-stats card-round" style="background-color:#880a14; color:#fff">
								<div class="card-body">
									<div class="row">
										<div class="col-2">
											<div class="icon-big text-center">
												<i class="icon-direction"></i>
											</div>
										</div>
										<div class="col-3 col-stats">
										</div>
										<div class="col-6 col-stats">
											<div class="numbers mt-4">
												<h7 class="fw-bold text-uppercase">Purok Number</h7>
												<h3 class="fw-bold text-uppercase"><?= number_format($purok) ?></h3>
											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
									<a href="purok_info.php?state=purok" class="card-link text-light">Purok Information</a>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card card-stats card-round card-danger">
								<div class="card-body">
									<div class="row">
										<div class="col-2">
											<div class="icon-big text-center">
												<i class="icon-layers"></i>
											</div>
										</div>
										<div class="col-3 col-stats">
										</div>
										<div class="col-6 col-stats">
											<div class="numbers mt-4">
												<h7 class="fw-bold text-uppercase">Blotter</h7>
												<h3 class="fw-bold text-uppercase"><?= number_format($blotter) ?></h3>
											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
									<a href="blotter.php" class="card-link text-light">Blotter Information</a>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card card-stats card-round" style="background-color:#3E9C35; color:#fff">
								<div class="card-body">
									<div class="row">
										<div class="col-2">
											<div class="icon-big text-center">
												<i>₱</i>
											</div>
										</div>
										<div class="col-3 col-stats">
										</div>
										<div class="col-6 col-stats">
											<div class="numbers mt-4">
												<h7 class="fw-bold text-uppercase">Collection - by day</h7>
												<?= $revenue ?>asdf
												<h7 class="fw-bold text-uppercase">P <?= number_format($revenue['am'],2) ?></h7>
											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
									<a href="revenue.php" class="card-link text-light">All Collection Payment</a>
								</div>
							</div>
						</div>

						<div class="col-md-4">
							<div class="card card-stats card-round" style="background-color:#8E7f36; color:#fff">
								<div class="card-body">
									<div class="row">
										<div class="col-2">
											<div class="icon-big text-center">
												<i class="fas flaticon-user"></i>
											</div>
										</div>
										<div class="col-3 col-stats">
										</div>
										<div class="col-6 col-stats">
											<div class="numbers mt-4">
												<h7 class="fw-bold text-uppercase">4ps Member</h7>
												<h7 class="fw-bold text-uppercase"><?= number_format($revenue['am'],2) ?></h7>
											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
									<a href="revenue.php" class="card-link text-light">4ps Members</a>
								</div>
							</div>
						</div>

					<div class="col-md-4">
							<div class="card card-stats card-round card-danger">
								<div class="card-body">
									<div class="row">
										<div class="col-2">
											<div class="icon-big text-center">
												<i class="icon-layers"></i>
											</div>
										</div>
										<div class="col-3 col-stats">
										</div>
										<div class="col-6 col-stats">
											<div class="numbers mt-3">
												<h7 class="fw-bold text-uppercase">Requested Documents</h7>
												<h3 class="fw-bold text-uppercase"><?= number_format($documents) ?></h3>
											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
									<a href="requestdoc.php" class="card-link text-light">Requested Documents</a>
								</div>
							</div>
						</div>

					<?php endif ?>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="card-head-row">
										<div class="card-title fw-bold">LGU Mission Statement</div>
									</div>
								</div>
								<div class="card-body">
									<p><?= !empty($db_txt) ? $db_txt : 'Office of the President
Office of the Vice President
Senate of the Philippines
House of Representatives
Supreme Court
Court of Appeals' ?></p>
									<div class="text-center">
										<img class="img-fluid" src="<?= !empty($db_img) ? 'assets/uploads/'.$db_img : 'assets/img/bg-abstract.png' ?>" />
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
</body>
</html>