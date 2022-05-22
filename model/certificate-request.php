<?php

include "../bootstrap/index.php";

if (isset($_POST["request-certificate"])) {
  $certificate_id = getBody('certificate_id', $_POST);
  $memo = getBody('memo', $_POST);
  $resident_id = getBody('resident_id', $_POST);

  $requiredFields = [
    "Certificate" => $certificate_id,
    "Resident" => $resident_id,
  ];

  /**
   * Check required fields
   */
  $emptyRequiredField = array_find_key($requiredFields, fn($item) => empty($item));

  if ($emptyRequiredField) {
    $_SESSION["message"] = "<b>$emptyRequiredField</b> is required!";
    $_SESSION["status"] = "danger";

    header("Location: ../certificate-requests.php");
    return $conn->close();
  }

  $paymentResult = $db
    ->insert("certificate_requests")
    ->values([
      "resident_id" => $resident_id,
      "certificate_id" => $certificate_id,
      "memo" => $memo,
      "status" => "pending",
    ])
    ->exec();

  if ($paymentResult['status'] !== true) {
    $_SESSION["message"] = "Internal server error";
    $_SESSION["status"] = "danger";

    header("Location: ../certificate-requests.php");
    return $conn->close();
  }

  $_SESSION["message"] = "Certificate request sent!";
  $_SESSION["status"] = "success";

  header("Location: ../certificate-requests.php");
  return $conn->close();
}

if (isset($_POST["edit-request"])) {
  $certificate_id = getBody('certificate_id', $_POST);
  $memo = getBody('memo', $_POST);
  $request_id = getBody('id', $_POST);

  $requiredFields = [
    "Certificate" => $certificate_id,
    "Request ID" => $request_id,
  ];

  /**
   * Check required fields
   */
  $emptyRequiredField = array_find_key($requiredFields, fn($item) => empty($item));

  if ($emptyRequiredField) {
    $_SESSION["message"] = "<b>$emptyRequiredField</b> is required!";
    $_SESSION["status"] = "danger";

    header("Location: ../certificate-requests.php");
    return $conn->close();
  }

  $result = $db
    ->update("certificate_requests")
    ->where('certificate_requests.id', $request_id)
    ->set([
      "certificate_id" => $certificate_id,
      "memo" => $memo,
    ])
    ->exec();

  if ($result['status'] !== true) {
    $_SESSION["message"] = "Internal server error";
    $_SESSION["status"] = "danger";

    header("Location: ../certificate-requests.php");
    return $conn->close();
  }

  $_SESSION["message"] = "Request updated!";
  $_SESSION["status"] = "success";

  header("Location: ../certificate-requests.php");
  return $conn->close();
}

if (isset($_GET["delete-request"])) {
  $request_id = getBody('id', $_GET);

  $requiredFields = [
    "Request ID" => $request_id,
  ];

  /**
   * Check required fields
   */
  $emptyRequiredField = array_find_key($requiredFields, fn($item) => empty($item));

  if ($emptyRequiredField) {
    $_SESSION["message"] = "<b>$emptyRequiredField</b> is required!";
    $_SESSION["status"] = "danger";

    header("Location: ../certificate-requests.php");
    return $conn->close();
  }

  $result = $db
    ->delete("certificate_requests")
    ->where("id", $request_id)
    ->exec();

  if ($result['status'] !== true) {
    $_SESSION["message"] = "Internal server error";
    $_SESSION["status"] = "danger";

    header("Location: ../certificate-requests.php");
    return $conn->close();
  }

  $_SESSION["message"] = "Request deleted!";
  $_SESSION["status"] = "success";

  header("Location: ../certificate-requests.php");
  return $conn->close();
}
