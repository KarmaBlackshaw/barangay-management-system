<?php

include "../bootstrap/index.php";

if (isset($_POST['create-payment'])) {

  if (!isset($_SERVER["HTTP_REFERER"])) {
    header("Location: ../dashboard.php");
    return $conn->close();
  }

  $amount = getBody('amount', $_POST);
  $details = getBody('details', $_POST);
  $date = getBody('date', $_POST);
  $mode = getBody('mode', $_POST);
  $resident_id = getBody('resident_id', $_POST);

  $requiredFields = [
    "Amount" => $amount,
    "Resident ID" => $resident_id,
    "Payment Mode" => $mode,
  ];

  /**
   * Check required fields
   */
  $emptyRequiredField = array_find_key($requiredFields, fn($item) => empty($item));

  if ($emptyRequiredField) {
    $_SESSION["message"] = "<b>$emptyRequiredField</b> is required!";
    $_SESSION["status"] = "danger";

    header("Location: " . $_SERVER["HTTP_REFERER"]);
    return $conn->close();
  }

  $result = $db
  ->insert("payments")
  ->values([
    "user_id" => $_SESSION['id'],
    "details" => $details,
    "resident_id" => $resident_id,
    "amount" => $amount,
    "mode" => $mode,
  ])
  ->exec();

  if ($result['status'] !== true) {
    $_SESSION["message"] = "Internal server error";
    $_SESSION["status"] = "danger";

    header("Location: " . $_SERVER["HTTP_REFERER"]);
    return $conn->close();
  }

    $_SESSION["message"] = "Successfully stored payment";
    $_SESSION["status"] = "success";

    header("Location: " . $_SERVER["HTTP_REFERER"] . "&closeModal=1");
    return $conn->close();
}
