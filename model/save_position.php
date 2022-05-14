<?php
include('../server/server.php');

if (!isset($_SESSION['username'])) {
    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
}

$pos     = $conn->real_escape_string($_POST['position']);
$order     = $conn->real_escape_string($_POST['order']);

if (!empty($pos) && !empty($order)) {

    $insert  = "INSERT INTO tblposition (`position`, `order`) VALUES ('$pos', $order)";
    $result  = $conn->query($insert);

    if ($result === true) {
        $_SESSION['message'] = 'Position added!';
        $_SESSION['status'] = 'success';
    } else {
        $_SESSION['message'] = 'Something went wrong!';
        $_SESSION['status'] = 'danger';
    }
} else {

    $_SESSION['message'] = 'Please fill up the form completely!';
    $_SESSION['status'] = 'danger';
}

header("Location: ../position.php");

$conn->close();
