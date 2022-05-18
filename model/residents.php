<?php
include '../bootstrap/index.php';

use function _\camelCase as _camelCase;

if (isset($_POST['register-resident']) && isAdmin()) {
	try {
		$national = getBody('national', $_POST);
		$citizenship = getBody('citizenship', $_POST);
		$fname = getBody('fname', $_POST);
		$mname = getBody('mname', $_POST);
		$lname = getBody('lname', $_POST);
		$alias = getBody('alias', $_POST);
		$bplace = getBody('bplace', $_POST);
		$bdate = getBody('bdate', $_POST);
		$age = getBody('age', $_POST);
		$cstatus = getBody('cstatus', $_POST);
		$gender = getBody('gender', $_POST);
		$purok = getBody('purok', $_POST);
		$vstatus = getBody('vstatus', $_POST);
		$indetity = getBody('indetity', $_POST);
		$number = getBody('number', $_POST);
		$email = getBody('email', $_POST);
		$occupation = getBody('occupation', $_POST);
		$address = getBody('address', $_POST);

		if (!isset(
			$national,
			$citizenship,
			$fname,
			$mname,
			$lname,
			$alias,
			$bplace,
			$bdate,
			$age,
			$cstatus,
			$gender,
			$purok,
			$vstatus,
			$number,
			$email,
			$occupation,
			$address)) {
				$_SESSION['message'] = 'All fields are required!';
				$_SESSION['status'] = 'danger';

				header('location: ../resident.php');
				return $conn->close();
		}

		/**
		 * Handle profile image
		 */
		$profileCamera = getBody('profileimg', $_POST); // base 64 image
		$profileFile = $_FILES['img'];

		$imgFilename = empty($profileCamera) ? null : $profileCamera;

		if ($profileFile['name']) {
			$uniqId = uniqid(date("YmdhisU"));
			$ext = pathinfo($profileFile['name'], PATHINFO_EXTENSION);
			$imgFilename = "$uniqId.$ext";
			$imgDir = "../assets/uploads/$imgFilename";

			move_uploaded_file($profileFile['tmp_name'], $imgDir);
		}

		/**
		 * Create account
		 */
		$accountId = (function () use ($db, $imgFilename) {
			$username = uniqid();
			$password = sha1($username);

			$result = $db
				->insert('tbl_users')
				->values(array(
					"username" => $username,
					"password" => $password,
					"user_type" => "user",
					"avatar" => $imgFilename,
				))
				->exec();

			return $result['id'];
		})();

		$result = $db
			->insert('residents')
			->values(array(
				"national_id" => $national,
				"citizenship" => $citizenship,
				"firstname" => $fname,
				"middlename" => $mname,
				"lastname" => $lname,
				"alias" => $alias,
				"birthplace" => $bplace,
				"birthdate" => $bdate,
				"age" => $age,
				"civilstatus" => $cstatus,
				"gender" => $gender,
				"purok" => $purok,
				"voterstatus" => $vstatus,
				"identified_as" => $indetity,
				"phone" => $number,
				"email" => $email,
				"occupation" => $occupation,
				"address" => $address,
				"picture" => $imgFilename,
				"account_id" => $accountId
			))
			->exec();

		$_SESSION['message'] = 'Resident registered';
		$_SESSION['status'] = 'success';

		header('location: ../resident.php');
		$conn->close();
	} catch (\Throwable $th) {
		throw $th;
	}
}
