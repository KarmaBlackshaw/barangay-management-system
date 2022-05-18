<?php
include "../server/server.php";

$username = $conn->real_escape_string($_POST["username"]);
$password = sha1($conn->real_escape_string($_POST["password"]));
$passwordConfirmation = sha1($conn->real_escape_string($_POST["password_confirmation"]));
$avatar = $_FILES["avatar"]["name"];

/**
 * Check field requirements
 */
if (!$username || !$password || !$passwordConfirmation) {
	$_SESSION["message"] = "All fields are required!";
	$_SESSION["status"] = "danger";

	header("location: ../user-register.php");
	return $conn->close();
}

/**
 * Check password confirmation
 */
if ($password !== $passwordConfirmation) {
	$_SESSION["message"] = "Confirm password!";
	$_SESSION["status"] = "danger";

	header("location: ../user-register.php");
	return $conn->close();
}

/**
 * Find duplicate username
 */
$result = $conn->query("SELECT * FROM users WHERE username = '$username'");
if ($result->fetch_assoc()) {
	$_SESSION["message"] = "Username is taken! Use other username";
	$_SESSION["status"] = "danger";

	header("location: ../user-register.php");
	return $conn->close();
}

/**
 * Generate uniq filename for image
 */
$uniqId = uniqid(date("YmdhisU"));
$ext = pathinfo($avatar, PATHINFO_EXTENSION);
$avatarFilename = "$uniqId.$ext";
$avatarDir = "../assets/uploads/avatar/$avatarFilename";

$hash = sha1($password);

$result = $conn->query("
	INSERT INTO users(username, password, avatar, user_type)
	VALUES('$username', '$hash', '$avatarFilename', 'user')
");

if ($result !== true) {
	$_SESSION["message"] = "Internal Server Error";
	$_SESSION["status"] = "danger";

	header("location: ../user-register.php");
	return $conn->close();
}

move_uploaded_file($_FILES["avatar"]["tmp_name"], $avatarDir);

$_SESSION["message"] = "You are now registered";
$_SESSION["status"] = "success";
header("location: ../login.php");
$conn->close();
