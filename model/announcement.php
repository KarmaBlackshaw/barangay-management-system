<?php

include "../bootstrap/index.php";

if (isset($_POST["register-announcement"])) {
  try {
    $title = $conn->real_escape_string($_POST["title"]);
    $content = $conn->real_escape_string($_POST["content"]);
    $thumbnail = $_FILES["thumbnail"];

    if (!$title || !$content) {
      $_SESSION["message"] = "All fields are required!";
      $_SESSION["status"] = "danger";

      header("location: ../announcements.php");
      return $conn->close();
    }

    $imgFilename = "";

    if ($thumbnail) {
      $uniqId = uniqid(date("YmdhisU"));
      $ext = pathinfo($thumbnail["name"], PATHINFO_EXTENSION);
      $imgFilename = "$uniqId.$ext";

      $imgDir = "../assets/uploads/$imgFilename";
      move_uploaded_file($thumbnail["tmp_name"], $imgDir);
    }

    $result = $db
      ->insert("announcements")
      ->values([
        "title" => $title,
        "content" => $content,
        "thumbnail" => $imgFilename,
      ])
      ->exec();

    if ($result["status"] !== true) {
      $_SESSION["message"] = "Internal Server Error";
      $_SESSION["status"] = "danger";

      header("location: ../announcements.php");
      return $conn->close();
    }

    $_SESSION["message"] = "Announcement published";
    $_SESSION["status"] = "success";

    header("location: ../announcements.php");
    $conn->close();

    return;
  } catch (Exception $e) {
    throw $e;
  }
}

if (isset($_POST["edit-announcement"])) {
  try {
    $id = $conn->real_escape_string($_POST["id"]);
    $title = $conn->real_escape_string($_POST["title"]);
    $content = $conn->real_escape_string($_POST["content"]);
    $oldThumbnail = $conn->real_escape_string($_POST["old-thumbnail"]);
    $thumbnail = $_FILES["thumbnail"];

    if (!$id) {
      $_SESSION["message"] = "ID is required!";
      $_SESSION["status"] = "danger";

      header("location: ../announcements.php");
      return $conn->close();
    }

    if (!$title || !$content) {
      $_SESSION["message"] = "All fields are required!";
      $_SESSION["status"] = "danger";

      header("location: ../announcements.php");
      return $conn->close();
    }

    $imgDir = "";
    $imgFilename = $oldThumbnail ?? $oldThumbnail;

    if ($thumbnail) {
      $uniqId = uniqid(date("YmdhisU"));
      $ext = pathinfo($thumbnail["name"], PATHINFO_EXTENSION);
      $imgFilename = "$uniqId.$ext";
      $imgDir = "../assets/uploads/$imgFilename";
    }

    $result = $db
      ->update("announcements")
      ->where("id", $id)
      ->set([
        "title" => $title,
        "content" => $content,
        "thumbnail" => $imgFilename,
      ])
      ->exec();

    if ($result["status"] !== true) {
      $_SESSION["message"] = "Internal Server Error";
      $_SESSION["status"] = "danger";

      header("location: ../announcements.php");
      return $conn->close();
    }

    if ($thumbnail) {
      move_uploaded_file($thumbnail["tmp_name"], $imgDir);
    }

    $_SESSION["message"] = "Announcement updated";
    $_SESSION["status"] = "success";
    header("location: ../announcements.php");
    $conn->close();

    return;
  } catch (Exception $e) {
    throw $e;
  }
}

if (isset($_GET["delete-announcement"])) {
  try {
    $id = $conn->real_escape_string($_GET["id"]);

    $result = $db
      ->delete("announcements")
      ->where("id", $id)
      ->exec();

    if ($result["status"] !== true) {
      $_SESSION["message"] = "Internal Server Error";
      $_SESSION["status"] = "danger";

      header("location: ../announcements.php");
      return $conn->close();
    }

    $_SESSION["message"] = "Announcement deleted";
    $_SESSION["status"] = "success";
    header("location: ../announcements.php");
    $conn->close();

    return;
  } catch (Exception $e) {
    throw $e;
  }
}
