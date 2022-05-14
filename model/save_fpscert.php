<?php
include('../server/server.php');

if (!isset($_SESSION['username'])) {
    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
}

$name                = $conn->real_escape_string($_POST['name']);
$current_location    = $conn->real_escape_string($_POST['current_location']);
$applied             = $conn->real_escape_string($_POST['applied']);


if (!empty($name)  && !empty($current_location)  && !empty($applied)) {

    $insert  = "INSERT INTO tblfpscert (`name`, current_location, applied) VALUES ('$name', '$current_location','$applied')";
    $fourps  = $conn->query($insert);

    if ($fourps === true) {
        $_SESSION['message'] = '4ps Certification added!';
        $_SESSION['status'] = 'success';
    } else {
        $_SESSION['message'] = 'Something went wrong!';
        $_SESSION['status'] = 'danger';
    }
} else {

    $_SESSION['message'] = 'Please fill up the form completely!';
    $_SESSION['status'] = 'danger';
}

header("Location: ../resident_fpscert.php");

$conn->close();
