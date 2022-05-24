<?php

$policies = [
  "announcements-view" => role(["administrator", "user", "staff"]),
  "announcements" => role(["administrator", "user", "staff"]),
  "blotter" => role(["administrator", "staff"]),
  "business_permit" => role(["administrator", "staff"]),
  "certificate-requests" => role(["administrator", "user", "staff"]),
  "chairmanship" => role(["administrator", "staff"]),
  "dashboard" => role(["administrator", "user", "staff"]),
  "delete_notif" => role(["administrator", "staff"]),
  "deleteModal" => role(["administrator", "staff"]),
  "generate_blotter_report" => role(["administrator", "staff"]),
  "generate_brgy_cert" => role(["administrator", "staff"]),
  "generate_business_permit" => role(["administrator", "staff"]),
  "generate_cuttingpermit" => role(["administrator", "staff"]),
  "generate_elect_cert" => role(["administrator", "staff"]),
  "generate_fpscert" => role(["administrator", "staff"]),
  "generate_indi_cert" => role(["administrator", "staff"]),
  "generate_resident" => role(["administrator", "staff"]),
  "home" => role(["administrator", "user", "staff"]),
  "officials" => role(["administrator", "staff"]),
  "position" => role(["administrator", "staff"]),
  "precinct" => role(["administrator", "staff"]),
  "purok" => role(["administrator", "staff"]),
  "purok_info" => role(["administrator", "staff"]),
  "requestdoc" => role(["administrator", "user", "staff"]),
  "resident" => role(["administrator", "staff"]),
  "resident_certification" => role(["administrator", "staff"]),
  "resident_cuttingpermit" => role(["administrator", "staff"]),
  "resident_fpscert" => role(["administrator", "staff"]),
  "resident_indigency" => role(["administrator", "staff"]),
  "resident_info" => role(["administrator", "staff"]),
  "resident-view" => role(["administrator", "staff"]),
  "revenue" => role(["administrator", "staff"]),
  "support" => role(["administrator", "staff"]),
  "users" => role(["administrator", "staff"]),
];

$request_uri = preg_replace('/\/|\.php/', '', $_SERVER['REQUEST_URI']);

$is_allowed_for_current_uri = $policies[$request_uri];

if (!$is_allowed_for_current_uri) {
  if (isset($_SERVER["HTTP_REFERER"])) {
    return header("Location: " . $_SERVER["HTTP_REFERER"]);
  }

  header("Location: ../login.php");
}
