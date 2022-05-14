<?php
include('../server/server.php');

if (!isset($_SESSION['username'])) {
    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
}

$name       = $conn->real_escape_string($_POST['name']);
$pcs        = $conn->real_escape_string($_POST['pcs']);
$type       = $conn->real_escape_string($_POST['type']);
$location   = $conn->real_escape_string($_POST['location']);
$applied    = $conn->real_escape_string($_POST['applied']);


if (!empty($name) && !empty($pcs) && !empty($type) && !empty($location)  && !empty($applied)) {

    $insert  = "INSERT INTO tblrequest (name, pcs, type, location, applied) VALUES ('$name', '$pcs','$type', '$location','$applied')";
    $result  = $conn->query($insert);

    if ($result === true) {
        $_SESSION['message'] = 'Cutting Permit added!';
        $_SESSION['status'] = 'success';
    } else {
        $_SESSION['message'] = 'Something went wrong!';
        $_SESSION['status'] = 'danger';
    }
} else {

    $_SESSION['message'] = 'Please fill up the form completely!';
    $_SESSION['status'] = 'danger';
}

header("Location: ../resident_cuttingpermit.php");

$conn->close();
