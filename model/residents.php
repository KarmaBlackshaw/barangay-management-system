<?php

include "../bootstrap/index.php";

use function _\camelCase as _camelCase;

if (isset($_POST["register-resident"])) {
	try {
		$national_id = getBody("national_id", $_POST);
		$citizenship = getBody("citizenship", $_POST);
		$address = getBody("address", $_POST);
		$fname = getBody("fname", $_POST);
		$mname = getBody("mname", $_POST);
		$lname = getBody("lname", $_POST);
		$alias = getBody("alias", $_POST);
		$birthplace = getBody("birthplace", $_POST);
		$birthdate = getBody("birthdate", $_POST);
		$age = getBody("age", $_POST);
		$civil_status = getBody("civil_status", $_POST);
		$gender = getBody("gender", $_POST);
		$purokId = getBody("purok_id", $_POST);
		$voter_status = getBody("voter_status", $_POST);
		$identified_as = getBody("identified_as", $_POST);
		$email = getBody("email", $_POST);
		$number = getBody("number", $_POST);
		$occupation = getBody("occupation", $_POST);
		$username = getBody("username", $_POST);
		$password = getBody("password", $_POST);
		$password_confirm = getBody("password_confirm", $_POST);

		$profileimg = getBody("profileimg", $_POST);

		$requiredFields = [
			"National ID" => $national_id,
			"Citizenship" => $citizenship,
			"Address" => $address,
			"First Name" => $fname,
			"Middle Name" => $mname,
			"Last Name" => $lname,
			"Alias" => $alias,
			"Birth Place" => $birthplace,
			"Birth Date" => $birthdate,
			"Age" => $age,
			"Civil Status" => $civil_status,
			"Gender" => $gender,
			"Purok" => $purokId,
			"Voter Status" => $voter_status,
			"Email" => $email,
			"Contact Number" => $number,
			"Occupation" => $occupation,
			"Username" => $username,
			"Password" => $password,
			"Password Confirmation" => $password_confirm,
		];

		/**
		 * Check required fields
		 */
		$emptyRequiredField = array_find_key($requiredFields, fn($item) => empty($item));

		if ($emptyRequiredField) {
			$_SESSION["message"] = "<b>$emptyRequiredField</b> is required!";
			$_SESSION["status"] = "danger";

			if ($_SERVER["HTTP_REFERER"]) {
				header("Location: " . $_SERVER["HTTP_REFERER"]);
				return $conn->close();
			}

			header("location: ../user-register.php");
			return $conn->close();
		}

		/**
		 * Check password
		 */
		if ($password != $password_confirm) {
			$_SESSION["message"] = "Please confirm your password!";
			$_SESSION["status"] = "danger";

			if ($_SERVER["HTTP_REFERER"]) {
				header("Location: " . $_SERVER["HTTP_REFERER"]);
				return $conn->close();
			}

			header("location: ../user-register.php");
			return $conn->close();
		}

		/**
		 * Handle profile image
		 */
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

		/**
		 * Create account
		 */
		$find_username = $db
			->from("users")
			->where("username", $username)
			->first()
			->exec();

		if ($find_username) {
			$_SESSION["message"] = "Username is already taken";
			$_SESSION["status"] = "danger";

			if ($_SERVER["HTTP_REFERER"]) {
				header("Location: " . $_SERVER["HTTP_REFERER"]);
				return $conn->close();
			}

			header("location: ../user-register.php");
			return $conn->close();
		}

		$account_id = (function () use ($db) {
			$imgFilename = $GLOBALS["imgFilename"];
			$username = $GLOBALS["username"];
			$password = sha1($username);

			$result = $db
				->insert("users")
				->values([
					"username" => $username,
					"password" => $password,
					"user_type" => "user",
					"avatar" => $imgFilename,
				])
				->exec();

			return $result["id"];
		})();

		$result = $db
			->insert("residents")
			->values([
				"national_id" => $national_id,
				"citizenship" => $citizenship,
				"firstname" => $fname,
				"middlename" => $mname,
				"lastname" => $lname,
				"alias" => $alias,
				"birthplace" => $birthplace,
				"birthdate" => $birthdate,
				"age" => $age,
				"civilstatus" => $civil_status,
				"gender" => $gender,
				"purok_id" => $purokId,
				"voterstatus" => $voter_status,
				"identified_as" => $identified_as,
				"phone" => $number,
				"email" => $email,
				"occupation" => $occupation,
				"address" => $address,
				"account_id" => $account_id,
			])
			->exec();

		$_SESSION["message"] = "Resident registered";
		$_SESSION["status"] = "success";

		if ($_SERVER["HTTP_REFERER"]) {
			header("Location: " . $_SERVER["HTTP_REFERER"]);
			return $conn->close();
		}

		header("location: ../user-register.php");
		return $conn->close();
	} catch (Exception $e) {
		echo "<pre>";
		var_dump($e);
		echo "</pre>";
		throw $e;
	}
}

if (isset($_POST["update-resident"])) {
	$resident_id = getBody("resident_id", $_POST);
	$national_id = getBody("national_id", $_POST);
	$citizenship = getBody("citizenship", $_POST);
	$address = getBody("address", $_POST);
	$fname = getBody("fname", $_POST);
	$mname = getBody("mname", $_POST);
	$lname = getBody("lname", $_POST);
	$alias = getBody("alias", $_POST);
	$birthplace = getBody("birthplace", $_POST);
	$birthdate = getBody("birthdate", $_POST);
	$age = getBody("age", $_POST);
	$civil_status = getBody("civil_status", $_POST);
	$gender = getBody("gender", $_POST);
	$purok_id = getBody("purok_id", $_POST);
	$voter_status = getBody("voter_status", $_POST);
	$identified_as = getBody("identified_as", $_POST);
	$email = getBody("email", $_POST);
	$number = getBody("number", $_POST);
	$occupation = getBody("occupation", $_POST);
	$username = getBody("username", $_POST);
	$password = getBody("password", $_POST);
	$password_confirm = getBody("password_confirm", $_POST);

	$requiredFields = [
		"National ID" => $national_id,
		"Citizenship" => $citizenship,
		"Address" => $address,
		"First Name" => $fname,
		"Middle Name" => $mname,
		"Last Name" => $lname,
		"Alias" => $alias,
		"Birth Place" => $birthplace,
		"Birth Date" => $birthdate,
		"Age" => $age,
		"Civil Status" => $civil_status,
		"Gender" => $gender,
		"Purok" => $purok_id,
		"Voter Status" => $voter_status,
		"Email" => $email,
		"Contact Number" => $number,
		"Occupation" => $occupation,
		"Username" => $username,
	];

	/**
	 * Check required fields
	 */
	$emptyRequiredField = array_find_key($requiredFields, fn($item) => empty($item));

	if ($emptyRequiredField) {
		$_SESSION["message"] = "<b>$emptyRequiredField</b> is required!";
		$_SESSION["status"] = "danger";

		header("location: ../resident-view.php?resident_id=$resident_id");
		return $conn->close();
	}

	/**
	 * Check password
	 */
	if ($password || $password_confirm) {
		if ($password != $password_confirm) {
			$_SESSION["message"] = "Please confirm your password!";
			$_SESSION["status"] = "danger";

			header("location: ../resident-view.php?resident_id=$resident_id");
			return $conn->close();
		}
	}

	$resident_details = $db
		->from("residents")
		->join("users", "users.id", "residents.account_id")
		->where("residents.id", $resident_id)
		->first()
		->select([
			"avatar" => "users.avatar",
			"user_id" => "users.id",
		])
		->exec();

	if (!$resident_details) {
		$_SESSION["message"] = "Resident not found!";
		$_SESSION["status"] = "danger";

		header("location: ../resident-view.php?resident_id=$resident_id");
		return $conn->close();
	}

	/**
	 * Handle profile image
	 */
	$profile_camera = getBody("profileimg", $_POST); // base 64 image
	$profile_file = $_FILES["img"];

	$img_filename = empty($profile_camera) ? $resident_details["avatar"] : $profile_camera;

	if ($profile_file["name"]) {
		$uniqId = uniqid(date("YmdhisU"));
		$ext = pathinfo($profile_file["name"], PATHINFO_EXTENSION);
		$img_filename = "$uniqId.$ext";
		$imgDir = "../assets/uploads/$img_filename";

		move_uploaded_file($profile_file["tmp_name"], $imgDir);
	}

	/**
	 * Update account
	 */
	$find_username = $db
		->from("users")
		->where("username", $username)
		->whereNot("users.id", $resident_details["user_id"])
		->first()
		->exec();

	if ($find_username) {
		$_SESSION["message"] = "Username is already taken";
		$_SESSION["status"] = "danger";

		header("location: ../resident-view.php?resident_id=$resident_id");
		return $conn->close();
	}

	(function () use ($db, $username, $password, $img_filename, $resident_details) {
		$user_updates = [
			"username" => $username,
			"avatar" => $img_filename,
		];

		if ($password) {
			$user_updates["password"] = sha1($password);
		}

		$db
			->update("users")
			->where("id", $resident_details["user_id"])
			->set($user_updates)
			->exec();
	})();

	$result = $db
		->update("residents")
		->where("id", $resident_id)
		->set([
			"national_id" => $national_id,
			"citizenship" => $citizenship,
			"firstname" => $fname,
			"middlename" => $mname,
			"lastname" => $lname,
			"alias" => $alias,
			"birthplace" => $birthplace,
			"birthdate" => $birthdate,
			"age" => $age,
			"address" => $address,
			"civilstatus" => $civil_status,
			"gender" => $gender,
			"purok_id" => $purok_id,
			"voterstatus" => $voter_status,
			"identified_as" => $identified_as,
			"phone" => $number,
			"email" => $email,
			"occupation" => $occupation,
			"address" => $address,
		])
		->exec();

	$_SESSION["message"] = "Resident details updatede";
	$_SESSION["status"] = "success";

	header("location: ../resident-view.php?resident_id=$resident_id");
	return $conn->close();
}
