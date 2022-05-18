<?php

include "../bootstrap/index.php";

use function _\camelCase as _camelCase;

if (isset($_POST["register-resident"])) {
	try {
		$nationalId = getBody("national_id", $_POST);
		$citizenship = getBody("citizenship", $_POST);
		$address = getBody("address", $_POST);
		$fname = getBody("fname", $_POST);
		$mname = getBody("mname", $_POST);
		$lname = getBody("lname", $_POST);
		$alias = getBody("alias", $_POST);
		$birthplace = getBody("birthplace", $_POST);
		$birthdate = getBody("birthdate", $_POST);
		$age = getBody("age", $_POST);
		$civilStatus = getBody("civil_status", $_POST);
		$gender = getBody("gender", $_POST);
		$purokId = getBody("purok_id", $_POST);
		$voterStatus = getBody("voter_status", $_POST);
		$identifiedAs = getBody("identified_as", $_POST);
		$email = getBody("email", $_POST);
		$number = getBody("number", $_POST);
		$occupation = getBody("occupation", $_POST);
		$username = getBody("username", $_POST);
		$password = getBody("password", $_POST);
		$passwordConfirm = getBody("password_confirm", $_POST);

		$profileimg = getBody("profileimg", $_POST);

		$requiredFields = [
			"National ID" => $nationalId,
			"Citizenship" => $citizenship,
			"Address" => $address,
			"First Name" => $fname,
			"Middle Name" => $mname,
			"Last Name" => $lname,
			"Alias" => $alias,
			"Birth Place" => $birthplace,
			"Birth Date" => $birthdate,
			"Age" => $age,
			"Civil Status" => $civilStatus,
			"Gender" => $gender,
			"Purok" => $purokId,
			"Voter Status" => $voterStatus,
			"Email" => $email,
			"Contact Number" => $number,
			"Cccupation" => $occupation,
			"Username" => $username,
			"Password" => $password,
			"Password Confirmation" => $passwordConfirm,
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
		$accountId = (function () use ($db, $imgFilename) {
			$username = uniqid();
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
				"national_id" => $nationalId,
				"citizenship" => $citizenship,
				"firstname" => $fname,
				"middlename" => $mname,
				"lastname" => $lname,
				"alias" => $alias,
				"birthplace" => $birthplace,
				"birthdate" => $birthdate,
				"age" => $age,
				"civilstatus" => $civilStatus,
				"gender" => $gender,
				"purok_id" => $purokId,
				"voterstatus" => $voterStatus,
				"identified_as" => $identifiedAs,
				"phone" => $number,
				"email" => $email,
				"occupation" => $occupation,
				"address" => $address,
				"picture" => $imgFilename,
				"account_id" => $accountId,
			])
			->exec();

		echo "<pre>";
		var_dump($result);
		echo "</pre>";

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
