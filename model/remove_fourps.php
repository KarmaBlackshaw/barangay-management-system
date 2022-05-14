<?php
include '../server/server.php';

if (!isset($_SESSION['username']) && $_SESSION['role'] != 'administrator') {
	if (isset($_SERVER["HTTP_REFERER"])) {
		header("Location: " . $_SERVER["HTTP_REFERER"]);
	}
}

$id 	= $conn->real_escape_string($_GET['id']);

if ($id != '') {
	$query 		= "DELETE FROM tblfpscert WHERE id = '$id'";

	$result 	= $conn->query($query);

	if ($result === true) {
		$_SESSION['message'] = 'Cutting  Permit has been removed!';
		$_SESSION['status'] = 'danger';
	} else {
		$_SESSION['message'] = 'Something went wrong!';
		$_SESSION['status'] = 'danger';
	}
} else {

	$_SESSION['message'] = 'Missing Cutting  Permit ID!';
	$_SESSION['status'] = 'danger';
}

header("Location: ../resident_fpscert.php");
$conn->close();
