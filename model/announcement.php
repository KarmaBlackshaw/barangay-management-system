<?php

include '../bootstrap/index.php';

if (isset($_POST['register-announcement'])) {
  try {
    $title = $conn->real_escape_string($_POST['title']);
    $content = $conn->real_escape_string($_POST['content']);
    $thumbnail  = $_FILES['thumbnail']['name'];

    if (!$title || !$content) {
      $_SESSION['message'] = 'All fields are required!';
      $_SESSION['status'] = 'danger';

      header('location: ../announcements.php');
      return $conn->close();
    }


    $imgDir = '';
    $imgFilename = '';

    if ($thumbnail) {
      $uniqId = uniqid(date("YmdhisU"));
      $ext = pathinfo($thumbnail, PATHINFO_EXTENSION);
      $imgFilename = "$uniqId.$ext";
      $imgDir = "../assets/uploads/$imgFilename";
    }


    $result = $conn->query("
      INSERT INTO announcements(title, content, thumbnail)
      VALUES('$title', '$content', '$imgFilename')
    ");

    if ($result !== TRUE) {
      $_SESSION['message'] = 'Internal Server Error';
      $_SESSION['status'] = 'danger';

      header('location: ../announcements.php');
      return $conn->close();
    }


    move_uploaded_file($_FILES['thumbnail']['tmp_name'], $imgDir);

    $_SESSION['message'] = 'Announcement published';
    $_SESSION['status'] = 'success';
    header('location: ../announcements.php');
    $conn->close();

    return;
  } catch (Exception $e) {
    throw $e;
  }
}
