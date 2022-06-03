<?php

include "../bootstrap/index.php";

if (isset($_POST["request-certificate"])) {
	$certificate_id = getBody("certificate_id", $_POST);
	$memo = getBody("memo", $_POST);
	$resident_id = getBody("resident_id", $_POST);
	$request_data = (object) [];

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

	$certificateDetails = $db
		->from("certificates")
		->where("id", $certificate_id)
		->first()
		->select([
			"url" => "url",
		])
		->exec();

	$has_empty_cert_field = false;

	/**
	 * Is business clearance
	 */
	if ($certificate_id == 5) {
		$request_data = [
			"name" => getBody("business_name", $_POST),
			"owner_1" => getBody("business_owner_1", $_POST),
			"owner_2" => getBody("business_owner_2", $_POST),
			"nature" => getBody("business_nature", $_POST),
		];

		$requiredFields = [
			"Business Name" => $request_data["name"],
			"Business Owner" => $request_data["owner_1"],
			"Business Nature" => $request_data["nature"],
		];

		$has_empty_cert_field = array_find_key($requiredFields, fn($item) => empty($item));
	}

	/**
	 * Is cutting permit
	 */
	if ($certificate_id == 6) {
		$request_data = [
			"material" => getBody("cutting_material", $_POST),
			"quantity" => getBody("cutting_quantity", $_POST),
			"location" => getBody("cutting_location", $_POST),
		];

		$requiredFields = [
			"Material" => $request_data["material"],
			"Quantity" => $request_data["quantity"],
			"Location" => $request_data["location"],
		];

		$has_empty_cert_field = array_find_key($requiredFields, fn($item) => empty($item));
	}

	/**
	 * Check required fields
	 */

	if ($has_empty_cert_field) {
		$_SESSION["message"] = "<b>$has_empty_cert_field</b> is required!";
		$_SESSION["status"] = "danger";

		header("Location: ../certificate-requests.php");
		return $conn->close();
	}

	$result = $db
		->insert("certificate_requests")
		->values([
			"resident_id" => $resident_id,
			"certificate_id" => $certificate_id,
			"memo" => $memo,
			"status" => "pending",
			"data" => json_encode($request_data),
		])
		->exec();

	if ($result["status"] !== true) {
		$_SESSION["message"] = "Internal server error";
		$_SESSION["status"] = "danger";

		header("Location: ../certificate-requests.php");
		return $conn->close();
	}

	$db
		->update("certificate_requests")
		->where("id", $result["id"])
		->set([
			"url" => $certificateDetails["url"] . "?id=$resident_id&request_id={$result["id"]}",
		])
		->exec();

	$_SESSION["message"] = "Certificate request sent!";
	$_SESSION["status"] = "success";

	header("Location: ../certificate-requests.php");
	return $conn->close();
}

if (isset($_POST["edit-request"])) {
	$certificate_id = getBody("certificate_id", $_POST);
	$memo = getBody("memo", $_POST);
	$request_id = getBody("id", $_POST);

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
		->where("certificate_requests.id", $request_id)
		->set([
			"certificate_id" => $certificate_id,
			"memo" => $memo,
		])
		->exec();

	if ($result["status"] !== true) {
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
	$request_id = getBody("id", $_GET);

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

	if ($result["status"] !== true) {
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
