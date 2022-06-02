<?php
include "../bootstrap/index.php";

$user_id = getBody("id", $_GET);

if ($user_id) {
	try {
		$conn->query("SET FOREIGN_KEY_CHECKS=0;");

		$db
			->delete("residents")
			->where("account_id", $user_id)
			->exec();

		$db
			->delete("users")
			->where("id", $user_id)
			->exec();

		$conn->query("SET FOREIGN_KEY_CHECKS=1;");
	} catch (\Throwable $th) {
		echo "<pre>";
		var_dump($th);
		echo "</pre>";
	}

	header("Location: ../users.php");
	$conn->close();
}
