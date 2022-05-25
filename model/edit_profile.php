<?php
include "../bootstrap/index.php";

if (!isset($_SESSION["username"])) {
	if (isset($_SERVER["HTTP_REFERER"])) {
		header("Location: " . $_SERVER["HTTP_REFERER"]);
	}
}

/**
 * Handle profile image
 */
$id = getBody("id", $_POST); // base 64 image
$profileCamera = getBody("profileimg", $_POST); // base 64 image
$profileFile = $_FILES["img"];

$imgFilename = empty($profileCamera) ? null : $profileCamera;

if ($profileFile["name"]) {
	$uniqId = uniqid(date("YmdhisU"));
	$ext = pathinfo($profileFile["name"], PATHINFO_EXTENSION);
	$imgFilename = "$uniqId.$ext";
	$imgDir = "../assets/uploads/$imgFilename";

	move_uploaded_file($profileFile["tmp_name"], $imgDir);
}

echo "<pre>";
var_dump($imgFilename);
echo "</pre>";

$result = $db
	->update("users")
	->where("id", $id)
	->set([
		"avatar" => $imgFilename,
	])
	->exec();
$_SESSION["avatar"] = $imgFilename;
$_SESSION["message"] = "Profile has been updated! Please login again!";
$_SESSION["status"] = "success";

if (isset($_SERVER["HTTP_REFERER"])) {
	header("Location: " . $_SERVER["HTTP_REFERER"]);
}

$conn->close();
