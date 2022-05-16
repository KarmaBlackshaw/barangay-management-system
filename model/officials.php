<?php

require '../server/server.php';
require '../helpers/method-vars.php';

if ($_POST['register-official']) {
try {
    $name = getPost('name');
    $chair = getPost('chair');
    $position = getPost('position');
    $start = getPost('start');
    $end = getPost('end');
    $status = getPost('status');

    if (!isset($name, $chair, $position, $start, $end, $status)) {
      $_SESSION['message'] = 'All fields are required!';
      $_SESSION['status'] = 'danger';

      header('location: ../officials.php');
      return $conn->close();
    }

    if ($position == 4) {
      $query = "SELECT id FROM tblofficials WHERE position = 4 AND status = 'Active'";

      $hasCaptain = $conn
        ->query($query)
        ->fetch_assoc();

      if (isset($hasCaptain)) {
        $_SESSION['message'] = 'A captain is already registered!';
        $_SESSION['status'] = 'danger';

        header('location: ../officials.php');
        return $conn->close();
      }
    }

    $result = $conn->query("
      INSERT INTO tblofficials(name, chairmanship, position, termstart, termend, status)
      VALUES('$name', '$chair', '$pos', '$start', '$end', '$status')
    ");

    if ($result !== true) {
      $_SESSION['message'] = 'Internal Server Error';
      $_SESSION['status'] = 'danger';

      header('location: ../announcements.php');
      return $conn->close();
    }

    $_SESSION['message'] = 'Official registered';
    $_SESSION['status'] = 'success';

    header('location: ../officials.php');
    $conn->close();

    return;
} catch (Exception $e) {
    throw $e;
}
}