<?php
$database	= 'bsms';
$username	= 'root';
$host		= 'localhost';
$password	= 'admin1234';

ini_set('display_errors', 1);
error_reporting(E_ALL);
mysqli_report(MYSQLI_REPORT_ERROR | E_DEPRECATED | E_STRICT);

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
	die("Connection Failed: " . $conn->connect_error());
}

if (!isset($_SESSION)) {
	session_start();
}

// if (!isset($_SESSION['username'])) {
// 	header('Location: login.php');
// }
