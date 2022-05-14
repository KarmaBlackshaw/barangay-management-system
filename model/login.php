<?php
include '../server/server.php';

$username 	= $conn->real_escape_string($_POST['username']);
$password	= sha1($conn->real_escape_string($_POST['password']));


if ($username != '' and $password != '') {
	$query 		= "SELECT * FROM tbl_users WHERE username = '$username' AND password = '$password'";

	$result 	= $conn->query($query);

	if ($result->num_rows) {
		while ($row = $result->fetch_assoc()) {
			$_SESSION['id'] = $row['id'];
			$_SESSION['username'] = $row['username'];
			$_SESSION['role'] = $row['user_type'];
			$_SESSION['avatar'] = $row['avatar'];
		}

		$_SESSION['message'] = 'You have successfull logged in to Automated Barangay Services Management System!';
		$_SESSION['status'] = 'success';

		header('location: ../dashboard.php');
	} else {
		$_SESSION['message'] = 'Username or Password is incorrect!';
		$_SESSION['status'] = 'danger';
		header('location: ../login.php');
	}
} else {
	$_SESSION['message'] = 'Username or password is empty!';
	$_SESSION['status'] = 'danger';
	header('location: ../login.php');
}



$conn->close();
