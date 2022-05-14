<?php
session_start();

if (isset($_SESSION['username'])) {
	header('Location: dashboard.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<?php include 'templates/header.php' ?>

	<title>Login - Barangay Services Management System</title>

<body class="login">
	<?php include 'templates/loading_screen.php' ?>
	<div class="wrapper wrapper-login">

		<div class="container container-login animated fadeIn">

			<?php include 'templates/alert.php' ?>

			<h3 class="text-center">Register</h3>
			<div class="login-form">
				<form method="POST" action="model/user-register.php" autocomplete="off" enctype="multipart/form-data">
					<div class="form-group form-floating-label">
						<input id="username" name="username" type="text" class="form-control input-border-bottom">
						<label for="username" class="placeholder">Username</label>
					</div>

					<div class="form-group form-floating-label">
						<input id="password" name="password" type="password" class="form-control input-border-bottom">
						<label for="password" class="placeholder">Password</label>
						<span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
					</div>

					<div class="form-group form-floating-label">
						<input id="password_confirmation" name="password_confirmation" type="password" class="form-control input-border-bottom">
						<label for="password_confirmation" class="placeholder">Confirm Password</label>
						<span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
					</div>

					<div class="form-group form-floating-label">
						<label for="formFile" class="form-label">Avatar</label>
						<input class="form-control" type="file" name="avatar" id="formFile" accept="image/png, image/jpeg">
					</div>

					<div class="mb-3">
					</div>

					<div class="form-action mb-3">
						<button type="submit" class="btn btn-success btn-block text-white fw-bold">Register</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<?php include 'templates/footer.php' ?>
</body>

</html>