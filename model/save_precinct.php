<?php
include('../server/server.php');

if (!isset($_SESSION['username'])) {
    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
}

$precinct     = $conn->real_escape_string($_POST['precinct']);
$details     = $conn->real_escape_string($_POST['details']);

if (!empty($precinct) && !empty($details)) {

    $insert  = "INSERT INTO tblprecinct (`precinct`, `details`) VALUES ('$precinct', '$details')";
    $result  = $conn->query($insert);

    if ($result === true) {
        $_SESSION['message'] = 'Contact Number added!';
        $_SESSION['status'] = 'success';
    } else {
        $_SESSION['message'] = 'Something went wrong!';
        $_SESSION['status'] = 'danger';
    }
} else {

    $_SESSION['message'] = 'Please fill up the form completely!';
    $_SESSION['status'] = 'danger';
}

header("Location: ../precinct.php");

$conn->close();
