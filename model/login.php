<?php
include "../server/server.php";

$username = $conn->real_escape_string($_POST["username"]);
$password = $conn->real_escape_string($_POST["password"]);

if (!$username || !$password) {
	$_SESSION["message"] = "Username or password is empty!";
	$_SESSION["status"] = "danger";

	header("location: ../login.php");
	return $conn->close();
}

$hash = sha1($password);
$result = $conn->query("SELECT * FROM users WHERE username = '$username' AND password = '$hash'");
$fetchedData = $result->fetch_assoc();

if (!$fetchedData) {
	$_SESSION["message"] = "Username or Password is incorrect!";
	$_SESSION["status"] = "danger";

	header("location: ../login.php");
	return $conn->close();
}

$_SESSION["id"] = $fetchedData["id"];
$_SESSION["username"] = $fetchedData["username"];
$_SESSION["role"] = $fetchedData["user_type"];
$_SESSION["avatar"] = $fetchedData["avatar"];

$_SESSION["message"] =
	"You have successfully logged in to Automated Barangay Services Management System!";
$_SESSION["status"] = "success";

header("location: ../dashboard.php");
return $conn->close();
