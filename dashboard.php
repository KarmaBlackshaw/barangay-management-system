<?php
require "bootstrap/index.php";

$residents_summary = $db
	->from("residents")
	->first()
	->select([
		"total" => "COUNT(residents.id)",
		"male" => "SUM(residents.gender = 'Male')",
		"female" => "SUM(residents.gender = 'Female')",
		"voters" => "SUM(residents.voterstatus = 'Yes')",
		"non_voters" => "SUM(residents.voterstatus = 'No')",
	])
	->exec();

$query5 = "SELECT * FROM purok";
$purok = $conn->query($query5)->num_rows;

$query6 = "SELECT * FROM tblprecinct";
$precinct = $conn->query($query6)->num_rows;

$query7 = "SELECT * FROM tblblotter";
$blotter = $conn->query($query7)->num_rows;

$revenue = (function ($conn) {
	$query = "SELECT IFNULL(SUM(amount), 0) as am FROM payments WHERE DATE(created_at) = CURDATE()";
	return $conn->query($query)->fetch_assoc();
})($conn);

$query9 = "SELECT * FROM tbldocuments";
$documents = $conn->query($query9)->num_rows;

$certificate_requests_summary = (function () use ($db) {
	return $db
		->from("certificate_requests")
		->whereRaw("DATE(created_at) = CURDATE()")
		->select([
			"total" => "COUNT(id)",
		])
		->first()
		->exec();
})();

$resident_details = (function () use ($db) {
	if (isUser()) {
		return $db
			->from("residents")
			->join("purok", "purok.id", "residents.purok_id")
			->join("users", "users.id", "residents.account_id")
			->where("users.id", $_SESSION["id"])
			->first()
			->select([
				"id" => "residents.id",
				"national_id" => "residents.national_id",
				"account_id" => "residents.account_id",
				"citizenship" => "residents.citizenship",
				"firstname" => "residents.firstname",
				"middlename" => "residents.middlename",
				"lastname" => "residents.lastname",
				"alias" => "residents.alias",
				"birthplace" => "residents.birthplace",
				"birthdate" => "residents.birthdate",
				"age" => "residents.age",
				"civilstatus" => "residents.civilstatus",
				"gender" => "residents.gender",
				"voterstatus" => "residents.voterstatus",
				"identified_as" => "residents.identified_as",
				"phone" => "residents.phone",
				"email" => "residents.email",
				"occupation" => "residents.occupation",
				"address" => "residents.address",
				"is_4ps" => "residents.is_4ps",
				"is_senior" => "residents.is_senior",
				"is_pwd" => "residents.is_pwd",
				"resident_type" => "residents.resident_type",
				"remarks" => "residents.remarks",
				"username" => "users.username",
				"user_type" => "users.user_type",
				"avatar" => "users.avatar",
				"purok_id" => "purok.id",
				"purok_name" => "purok.name",
				"purok_details" => "purok.details",
			])
			->exec();
	}

	return [];
})();

$resident_request_list = (function () use ($db) {
	if (isUser()) {
		$resident_details = $GLOBALS["resident_details"];

		return $db
			->from(["certificate_requests" => "cr"])
			->join("certificates", "certificates.id", "cr.certificate_id")
			->where("cr.resident_id", $resident_details["id"])
			->select([
				"id" => "cr.id",
				"certificate_id" => "cr.certificate_id",
				"status" => "cr.status",
				"memo" => "cr.memo",
				"created_at" => "cr.created_at",
				"certificate_id" => "certificates.id",
				"certificate_name" => "certificates.name",
			])
			->exec();
	}

	return [];
})();

$resident_certificate_requests_summary = (function () use ($db) {
	$resident_details = $GLOBALS["resident_details"];

	return $db
		->from("certificate_requests")
		->whereRaw("MONTH(created_at) = MONTH(CURDATE())")
		->whereRaw("YEAR(created_at) = YEAR(CURDATE())")
		->where("resident_id", $resident_details["id"])
		->select([
			"total" => "COUNT(id)",
		])
		->first()
		->exec();
})();
?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <?php include "templates/header.php"; ?>
    <title>Dashboard - Barangay Services
      Management System</title>


    <style>
    .hidden {
      display: none !important;
    }

    label.btn.active {
      color: white !important;
      background-color: #337BB6;
    }

    .form-check>.btn-group {
      width: 100%;
    }

    .badge.badge-resolved {
      background-color: #22c55e;
    }

    .badge.badge-pending {
      background-color: #525252;
    }

    .badge.badge-rejected {
      background-color: #ef4444;
    }

    .list-group .list-group-item {
      border-width: 1px;
    }

    .request-list > .request-list__item {
      justify-content: space-between;
      align-items:  center;
    }

    .request-list > .request-list__item > div > p {
      margin-bottom: 0;
    }

    .request-list > .request-list__item > div > .subtitle {
      font-size: 10px;
      opacity: 0.5;
    }

    .card-certificate-requests > .card-header > .card-title {
display: flex;
justify-content: space-between;
align-items: center;
    }

    .card-certificate-requests__summary{
      font-size: 10px;
    }

    </style>
  </head>

  <body>
    <?php include "templates/loading_screen.php"; ?>

    <div class="wrapper">
      <!-- Main Header -->
      <?php include "templates/main-header.php"; ?>
      <!-- End Main Header -->

      <!-- Sidebar -->
      <?php include "templates/sidebar.php"; ?>
      <!-- End Sidebar -->

      <div class="main-panel">
        <div class="content">
          <div class="panel-header bg-primary-gradient">
            <div class="page-inner">
              <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                  <h2 class="text-white fw-bold">
                    Dashboard</h2>
                </div>
              </div>
            </div>
          </div>
          <div class="page-inner mt--2">

            <?php include "templates/alert.php"; ?>

            <?php if (isUser()): ?>
              <div class="row">
                <div class="col-md-12">
                  <div class="card">
                    <div class="card-header">
                      <div class="card-title">
                        Personal Information
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="row g-5">
                        <div class="col-md-4">
                          <div style="height: 250;" class="text-center" id="my_camera">
                            <img src="<?= imgSrc($resident_details["avatar"]) ??
                            	"assets/img/person.png" ?>" alt="..." class="img "
                              width="250" height="250" style="max-height: 250; object-fit: cover;">
                          </div>

                          <div class="form-group">
                            <label>National ID No.</label>
                            <input type="text" class="form-control" name="national_id" readonly
                              value="<?= $resident_details[
                              	"national_id"
                              ] ?>" placeholder="Enter National ID No." required>
                          </div>

                          <div class="form-group">
                            <label>Citizenship</label>
                            <input type="text" class="form-control" readonly name="citizenship"
                              value="<?= $resident_details[
                              	"citizenship"
                              ] ?>" placeholder="Enter citizenship" required>
                          </div>

                          <div class="form-group">
                            <label>Address</label>
                            <textarea class="form-control" readonly name="address" required placeholder="Enter Address"><?= $resident_details[
                            	"address"
                            ] ?></textarea>
                          </div>
                        </div>

                        <div class="col-md-8">
                          <div class="row g-0">
                            <div class="col-sm-4">
                              <div class="form-group">
                                <label>First name</label>
                                <input readonly class="form-control" placeholder="Enter First name" name="fname"
                                  value="<?= $resident_details["firstname"] ?>" required>
                              </div>
                            </div>

                            <div class="col-sm-4">
                              <div class="form-group">
                                <label>Middle name</label>
                                <input readonly class="form-control" placeholder="Enter Middle name" name="mname"
                                  value="<?= $resident_details["middlename"] ?>" required>
                              </div>
                            </div>

                            <div class="col-sm-4">
                              <div class="form-group">
                                <label>Last name</label>
                                <input readonly class="form-control" placeholder="Enter Last name" name="lname" required
                                  value="<?= $resident_details["lastname"] ?>">
                              </div>
                            </div>
                          </div>

                          <div class="row g-0">
                            <div class="col-sm-4">
                              <div class="form-group">
                                <label>Alias</label>
                                <input readonly class="form-control" placeholder="Enter Alias" name="alias"
                                  value="<?= $resident_details["alias"] ?>">
                              </div>
                            </div>

                            <div class="col-sm-4">
                              <div class="form-group">
                                <label>Place of Birth</label>
                                <input readonly class="form-control" placeholder="Enter Birthplace" name="birthplace" required
                                  value="<?= $resident_details["birthplace"] ?>">
                              </div>
                            </div>

                            <div class="col-sm-4">
                              <div class="form-group">
                                <label>Birthdate</label>
                                <input readonly type="date" class="form-control" placeholder="Enter Birthdate" name="birthdate"
                                  required value="<?= $resident_details["birthdate"] ?>">
                              </div>
                            </div>
                          </div>

                          <div class="row g-0">
                            <div class="col-sm-4">
                              <div class="form-group">
                                <label>Age</label>
                                <input readonly type="number" class="form-control" placeholder="Enter Age" min="1" name="age"
                                  required value="<?= $resident_details["age"] ?>">
                              </div>
                            </div>

                            <div class="col-sm-4">
                              <div class="form-group">
                                <label>Civil Status</label>

                                <input readonly class="form-control" placeholder="Enter Age" min="1" name="age"
                                  required value="<?= $resident_details["civilstatus"] ?>">
                              </div>
                            </div>

                            <div class="col-sm-4">
                              <div class="form-group">
                                <label>Gender</label>
                                <input readonly class="form-control" placeholder="Enter Age" min="1" name="age"
                                  required value="<?= $resident_details["gender"] ?>">
                              </div>
                            </div>
                          </div>

                          <div class="row g-0">
                            <div class="col-sm-4">
                              <div class="form-group">
                                <label>Purok</label>
                                <input readonly class="form-control" placeholder="Enter Age" min="1" name="age"
                                  required value="<?= $resident_details["purok_name"] ?>">
                              </div>
                            </div>

                            <div class="col-sm-4">
                              <div class="form-group">
                                <label>Voters Status</label>
                                <input readonly class="form-control" placeholder="Enter Age" min="1" name="age"
                                  required value="<?= $resident_details["voterstatus"] ?>">
                              </div>
                            </div>

                            <div class="col-sm-4">
                              <div class="form-group">
                                <label>Identified As</label>
                                <input readonly class="form-control" placeholder="Enter Age" min="1" name="age"
                                  required value="<?= $resident_details["identified_as"] ?>">
                              </div>
                            </div>
                          </div>

                          <div class="row g-0">
                            <div class="col-sm-4">
                              <div class="form-group">
                                <label>Email Address</label>
                                <input readonly type="email" class="form-control" placeholder="Enter Email" name="email"
                                  value="<?= $resident_details["email"] ?>">
                              </div>
                            </div>

                            <div class="col-sm-4">
                              <div class="form-group">
                                <label>Contact Number</label>
                                <input readonly class="form-control" placeholder="Enter Contact Number" name="number"
                                  value="<?= $resident_details["phone"] ?>">
                              </div>
                            </div>
                            <div class="col-sm-4">
                              <div class="form-group">
                                <label>Occupation</label>
                                <input readonly class="form-control" placeholder="Enter Occupation" name="occupation"
                                  value="<?= $resident_details["occupation"] ?>">
                              </div>
                            </div>
                          </div>

                          <div class="row g-0">
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label>Are you a 4Ps Beneficiary?</label>

                                <div class="form-check">
                                  <div class="btn-group btn-group-justified" data-toggle="buttons">
                                    <label class="btn <?= $resident_details["is_4ps"] == 1
                                    	? "active"
                                    	: "" ?>">
                                      <input readonly type="radio" name="is_4ps" class="hidden"
                                        <?= $resident_details["is_4ps"] == 1
                                        	? "checked"
                                        	: null ?> value="1"> Yes
                                    </label>
                                    <label class="btn <?= $resident_details["is_4ps"] == 0
                                    	? "active"
                                    	: "" ?>">
                                      <input readonly type="radio" name="is_4ps" class="hidden" value="0"
                                        <?= $resident_details["is_4ps"] == 0
                                        	? "checked"
                                        	: null ?>> No
                                    </label>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="col-sm-6">
                              <div class="form-group">
                                <label>Are you a PWD?</label>

                                <div class="form-check">
                                  <div class="btn-group" data-toggle="buttons">
                                    <label class="btn <?= $resident_details["is_pwd"] == 1
                                    	? "active"
                                    	: "" ?>">
                                      <input disabled type="radio" name="is_pwd" class="hidden"
                                        <?= $resident_details["is_pwd"] == 1
                                        	? "checked"
                                        	: null ?> value="1"> Yes
                                    </label>
                                    <label class="btn <?= $resident_details["is_pwd"] == 0
                                    	? "active"
                                    	: "" ?>">
                                      <input disabled type="radio" name="is_pwd" class="hidden" value="0"
                                        <?= $resident_details["is_pwd"] == 0
                                        	? "checked"
                                        	: null ?>> No
                                    </label>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="card card-certificate-requests">
                    <div class="card-header">
                      <div class="card-title">
                        Requests

                        <div class="card-certificate-requests__summary">
                          THIS MONTH: <br>
                          <b><?= $resident_certificate_requests_summary["total"] ?></b>
                        </div>
                      </div>
                    </div>

                    <div class="card-body">
                      <ul class="list-group request-list">
                        <?php foreach ($resident_request_list as $curr_request): ?>
                        <li class="list-group-item request-list__item">
                          <div>
                            <p><?= $curr_request["certificate_name"] ?></p>
                            <small class="subtitle"><?= $curr_request["created_at"] ?></small>
                          </div>

                          <div>
                            <span class="badge badge-<?= $curr_request["status"] ?>">
                              <?= $curr_request["status"] ?>
                            </span>
                          </div>
                        </li>
                        <?php endforeach; ?>
                      </ul>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="card">
                    <div class="card-header">
                      <div class="card-title">
                        Personal Information
                      </div>
                    </div>

                    <div class="card-body">
                      asdasd
                    </div>
                  </div>
                </div>
              </div>
            <?php endif; ?>

            <?php if (isAdmin()): ?>
              <div class="row">
                <div class="col-md-4">
                  <div class="card card-stats card-primary card-round">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-2">
                          <div class="icon-big text-center">
                            <i class="flaticon-users"></i>
                          </div>
                        </div>
                        <div class="col-3 col-stats">
                        </div>
                        <div class="col-6 col-stats">
                          <div class="numbers mt-4">
                            <h7 class="fw-bold text-uppercase">
                              Population</h7>
                            <h3 class="fw-bold text-uppercase">
                              <?= number_format($residents_summary["total"]) ?>
                            </h3>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card-body">
                      <a href="resident_info.php?state=all" class="card-link text-light">Total
                        Population </a>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="card card-stats card-secondary card-round">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-2">
                          <div class="icon-big text-center">
                            <i class="flaticon-user"></i>
                          </div>
                        </div>
                        <div class="col-3 col-stats">
                        </div>
                        <div class="col-6 col-stats">
                          <div class="numbers mt-4">
                            <h7 class="fw-bold text-uppercase">
                              Male</h7>
                            <h3 class="fw-bold">
                              <?= number_format($residents_summary["male"]) ?>
                            </h3>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card-body">
                      <a href="resident_info.php?state=male" class="card-link text-light">Total
                        Male </a>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="card card-stats card-warning card-round">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-2">
                          <div class="icon-big text-center">
                            <i class="icon-user-female"></i>
                          </div>
                        </div>
                        <div class="col-3 col-stats">
                        </div>
                        <div class="col-6 col-stats">
                          <div class="numbers mt-4">
                            <h7 class="fw-bold text-uppercase">
                              Female</h7>
                            <h3 class="fw-bold text-uppercase">
                              <?= number_format($residents_summary["female"]) ?>
                            </h3>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card-body">
                      <a href="resident_info.php?state=female" class="card-link text-light">Total
                        Female </a>
                    </div>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="card card-stats card-success card-round">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-2">
                          <div class="icon-big text-center">
                            <i class="fas fa-fingerprint"></i>
                          </div>
                        </div>
                        <div class="col-3 col-stats">
                        </div>
                        <div class="col-6 col-stats">
                          <div class="numbers mt-4">
                            <h7 class="fw-bold text-uppercase">
                              Voters</h7>
                            <h3 class="fw-bold text-uppercase">
                              <?= number_format($residents_summary["voters"]) ?>
                            </h3>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card-body">
                      <a href="resident_info.php?state=voters" class="card-link text-light">Total
                        Voters </a>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="card card-stats card-info card-round">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-2">
                          <div class="icon-big text-center">
                            <i class="flaticon-users"></i>
                          </div>
                        </div>
                        <div class="col-3 col-stats">
                        </div>
                        <div class="col-6 col-stats">
                          <div class="numbers mt-4">
                            <h7 class="fw-bold text-uppercase">
                              Non Voters</h7>
                            <h3 class="fw-bold text-uppercase">
                              <?= number_format($residents_summary["non_voters"]) ?>
                            </h3>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card-body">
                      <a href="resident_info.php?state=non_voters" class="card-link text-light">Total
                        Non Voters </a>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="card card-stats card-round" style="background-color:#a349a3; color:#fff">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-2">
                          <div class="icon-big text-center">
                            <i class="fas fa-phone"></i>
                          </div>
                        </div>
                        <div class="col-3 col-stats">
                        </div>
                        <div class="col-6 col-stats">
                          <div class="numbers mt-4">
                            <h7 class="fw-bold text-uppercase">
                              Contact Number</h7>
                            <h7 class="fw-bold">
                              <?= number_format($precinct) ?>
                            </h7>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card-body">
                      <a href="purok_info.php?state=precinct" class="card-link text-light">Contact
                        Number Information</a>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="card card-stats card-round" style="background-color:#880a14; color:#fff">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-2">
                          <div class="icon-big text-center">
                            <i class="icon-direction"></i>
                          </div>
                        </div>
                        <div class="col-3 col-stats">
                        </div>
                        <div class="col-6 col-stats">
                          <div class="numbers mt-4">
                            <h7 class="fw-bold text-uppercase">
                              Purok Number</h7>
                            <h3 class="fw-bold text-uppercase">
                              <?= number_format($purok) ?>
                            </h3>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card-body">
                      <a href="purok_info.php?state=purok" class="card-link text-light">Purok
                        Information</a>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="card card-stats card-round card-danger">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-2">
                          <div class="icon-big text-center">
                            <i class="icon-layers"></i>
                          </div>
                        </div>
                        <div class="col-3 col-stats">
                        </div>
                        <div class="col-6 col-stats">
                          <div class="numbers mt-4">
                            <h7 class="fw-bold text-uppercase">
                              Blotter</h7>
                            <h3 class="fw-bold text-uppercase">
                              <?= number_format($blotter) ?>
                            </h3>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card-body">
                      <a href="blotter.php" class="card-link text-light">Blotter
                        Information</a>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="card card-stats card-round" style="background-color:#3E9C35; color:#fff">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-2">
                          <div class="icon-big text-center">
                            <i>₱</i>
                          </div>
                        </div>
                        <div class="col-3 col-stats">
                        </div>
                        <div class="col-6 col-stats">
                          <div class="numbers mt-4">
                            <h7 class="fw-bold text-uppercase">
                              Collection - by day
                            </h7>
                            <h7 class="fw-bold text-uppercase">
                              P <?= number_format($revenue["am"], 2) ?></h7>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card-body">
                      <a href="revenue.php" class="card-link text-light">All
                        Collection Payment</a>
                    </div>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="card card-stats card-round" style="background-color:#8E7f36; color:#fff">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-2">
                          <div class="icon-big text-center">
                            <i class="fas flaticon-user"></i>
                          </div>
                        </div>
                        <div class="col-3 col-stats">
                        </div>
                        <div class="col-6 col-stats">
                          <div class="numbers mt-4">
                            <h7 class="fw-bold text-uppercase">
                              4ps Member</h7>
                            <h7 class="fw-bold text-uppercase">
                              <?= number_format($revenue["am"], 2) ?>
                            </h7>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card-body">
                      <a href="revenue.php" class="card-link text-light">4ps
                        Members</a>
                    </div>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="card card-stats card-round card-danger">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-2">
                          <div class="icon-big text-center">
                            <i class="icon-layers"></i>
                          </div>
                        </div>
                        <div class="col-3 col-stats">
                        </div>
                        <div class="col-6 col-stats">
                          <div class="numbers mt-3">
                            <h7 class="fw-bold text-uppercase">
                              Requested Documents
                            </h7>
                            <h3 class="fw-bold text-uppercase">
                              <?= number_format($documents) ?>
                            </h3>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card-body">
                      <a href="requestdoc.php" class="card-link text-light">Requested
                        Documents</a>
                    </div>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="card card-stats card-round card-info">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-2">
                          <div class="icon-big text-center">
                            <i class="icon-layers"></i>
                          </div>
                        </div>
                        <div class="col-3 col-stats">
                        </div>
                        <div class="col-6 col-stats">
                          <div class="numbers mt-3">
                            <h7 class="fw-bold text-uppercase">
                              Requested Certificates
                            </h7>
                            <h3 class="fw-bold text-uppercase">
                              <?= number_format($certificate_requests_summary["total"]) ?>
                            </h3>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card-body">
                      <a href="requestdoc.php" class="card-link text-light">Requested Certificates</a>
                    </div>
                  </div>
                </div>
              </div>
            <?php endif; ?>

            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <div class="card-head-row">
                      <div class="card-title fw-bold">
                        LGU Mission Statement
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <p>
                      <?= !empty($db_txt)
                      	? $db_txt
                      	: 'Office of the President
                        Office of the Vice President
                        Senate of the Philippines
                        House of Representatives
                        Supreme Court
                        Court of Appeals' ?>
                    </p>

                    <div class="text-center">
                      <img class="img-fluid" src="<?= !empty($db_img)
                      	? "assets/uploads/" . $db_img
                      	: "assets/img/bg-abstract.png" ?>" />
                    </div>
                  </div>
                </div>
              </div>
            </div>
            </div>
          </div>
          <!-- Main Footer -->
          <?php include "templates/main-footer.php"; ?>
          <!-- End Main Footer -->

        </div>

      </div>
      <?php include "templates/footer.php"; ?>
  </body>

</html>
