<?php
include "../server/server.php";

if (!isset($_SESSION["username"])) {
	if (isset($_SERVER["HTTP_REFERER"])) {
		header("Location: " . $_SERVER["HTTP_REFERER"]);
	}
}

$purok = $conn->real_escape_string($_POST["purok"]);
$details = $conn->real_escape_string($_POST["details"]);

if (!empty($purok) && !empty($details)) {
	$insert = "INSERT INTO purok (`name`, `details`) VALUES ('$purok', '$details')";
	$result = $conn->query($insert);

	if ($result === true) {
		$_SESSION["message"] = "Purok added!";
		$_SESSION["status"] = "success";
	} else {
		$_SESSION["message"] = "Something went wrong!";
		$_SESSION["status"] = "danger";
	}
} else {
	$_SESSION["message"] = "Please fill up the form completely!";
	$_SESSION["status"] = "danger";
}

header("Location: ../purok.php");

$conn->close();
