<?php

require "../server/server.php";
require "../helpers/method-vars.php";

if (getBody("register-official", $_POST)) {
	try {
		$name = getBody("name", $_POST);
		$chair = getBody("chair", $_POST);
		$position = getBody("position", $_POST);
		$start = getBody("start", $_POST);
		$end = getBody("end", $_POST);
		$status = getBody("status", $_POST);

		if (!isset($name, $chair, $position, $start, $end, $status)) {
			$_SESSION["message"] = "All fields are required!";
			$_SESSION["status"] = "danger";

			header("location: ../officials.php");
			return $conn->close();
		}

		if ($position == 4) {
			$hasCaptain = $db
				->from("tblofficials")
				->where("position", 4)
				->where("status", "Active")
				->select([
					"id" => "tblofficials.id",
				])
				->exec();

			if (isset($hasCaptain)) {
				$_SESSION["message"] = "A captain is already registered!";
				$_SESSION["status"] = "danger";

				header("location: ../officials.php");
				return $conn->close();
			}
		}

		$result = $db
			->insert("tblofficials")
			->values([
				"name" => $name,
				"chairmanship" => $chair,
				"position" => $position,
				"termstart" => $start,
				"termend" => $end,
				"status" => $status,
			])
			->exec();

		if ($result["status"] !== true) {
			$_SESSION["message"] = "Internal Server Error";
			$_SESSION["status"] = "danger";

			header("location: ../announcements.php");
			return $conn->close();
		}

		$_SESSION["message"] = "Official registered";
		$_SESSION["status"] = "success";

		header("location: ../officials.php");
		$conn->close();

		return;
	} catch (Exception $e) {
		throw $e;
	}
}
