<?php
session_start();

if (isset($_SESSION["username"])) {
	header("Location: dashboard.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<?php include "templates/header.php"; ?>

	<title>Login - Barangay Services Management System</title>

	<style>
		label.placeholder {
			background: transparent;
			cursor: auto;
		}
	</style>
</head>

<body class="login">
	<?php include "templates/loading_screen.php"; ?>
	<div class="wrapper wrapper-login">

		<div class="container container-login animated fadeIn">

			<?php include "templates/alert.php"; ?>

			<h3 class="text-center">Sign In Here</h3>
			<div class="login-form">
				<form method="POST" action="model/login.php" autocomplete="off">
					<div class="form-group form-floating-label">
						<input id="username" name="username" type="text" class="form-control input-border-bottom" required>
						<label for="username" class="placeholder">Username</label>
					</div>
					<div class="form-group form-floating-label">
						<input id="password" name="password" type="password" class="form-control input-border-bottom" required>
						<label for="password" class="placeholder">Password</label>
						<span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
					</div>
					<div class="form-action mb-3 d-flex flex-column gap-2">
						<button type="submit" class="btn btn-primary btn-block fw-bold">Sign In</button>

						<a href="resident-register.php" class="btn btn-success btn-block text-white fw-bold">Create New Account</a>
					</div>
				</form>
			</div>
		</div>
	</div>

	<?php include "templates/footer.php"; ?>
</body>

</html>