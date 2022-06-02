<?php

require_once "bootstrap/index.php";

$residents_summary = $db
	->from("residents")
	->first()
	->select([
		"total" => "COUNT(residents.id)",
		"male" => "SUM(residents.gender = 'Male')",
		"female" => "SUM(residents.gender = 'Female')",
		"voters" => "SUM(residents.voterstatus = 'Yes')",
		"non_voters" => "SUM(residents.voterstatus = 'No')",
		"total_pwds" => "SUM(residents.is_pwd)",
		"total_4ps" => "SUM(residents.is_4ps)",
		"total_seniors" => "SUM(residents.is_senior)",
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
	if (isUser()) {
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
	}

	return [];
})();

$announcements = (function () use ($db) {
	return $db
		->from(["announcements" => "a"])
		->select([
			"id" => "a.id",
			"title" => "a.title",
			"content" => "a.content",
			"thumbnail" => "a.thumbnail",
			"created_at" => "a.created_at",
		])
		->orderBy("a.created_at", "desc")
		->exec();
})();

function getRandomColor()
{
	$colors = [
		"#f97316",
		"#ef4444",
		"#f59e0b",
		"#eab308",
		"#84cc16",
		"#22c55e",
		"#10b981",
		"#14b8a6",
		"#06b6d4",
		"#0ea5e9",
		"#3b82f6",
		"#6366f1",
		"#8b5cf6",
		"#a855f7",
		"#d946ef",
		"#ec4899",
		"#f43f5e",
	];

	$key = array_rand($colors, 1);

	return $colors[$key];
}

$admin_dashboard_cards = [
	[
		"icon" => "flaticon-users",
		"title" => "Population",
		"subtitle" => "Total Population",
		"value" => $residents_summary["total"] ? number_format($residents_summary["total"]) : 0,
		"href" => "resident.php",
	],
	[
		"icon" => "flaticon-user",
		"title" => "Male",
		"subtitle" => "Total Male",
		"value" => $residents_summary["male"] ? number_format($residents_summary["male"]) : 0,
		"href" => "resident.php?gender=male",
	],
	[
		"icon" => "icon-user-female",
		"title" => "Female",
		"subtitle" => "Total Female",
		"value" => $residents_summary["female"] ? number_format($residents_summary["female"]) : 0,
		"href" => "resident.php?gender=female",
	],
	[
		"icon" => "fas fa-fingerprint",
		"title" => "Voters",
		"subtitle" => "Total Voters",
		"value" => $residents_summary["voters"] ? number_format($residents_summary["voters"]) : 0,
		"href" => "resident.php?voter=yes",
	],
	[
		"icon" => "fas fa-fingerprint",
		"title" => "Non voters",
		"subtitle" => "Total Non voters",
		"value" => $residents_summary["non_voters"] ? number_format($residents_summary["non_voters"]) : 0,
		"href" => "resident.php?voter=no",
	],
	[
		"icon" => "fas fa-phone",
		"title" => "Contact Number",
		"subtitle" => "Contact Number Information",
		"value" => number_format($precinct),
		"href" => "precinct.php",
	],
	[
		"icon" => "icon-direction",
		"title" => "Purok Number",
		"subtitle" => "Purok Information",
		"value" => number_format($purok),
		"href" => "purok.php",
	],
	[
		"icon" => "icon-layers",
		"title" => "Blotter",
		"subtitle" => "Blotter Information",
		"value" => number_format($blotter),
		"href" => "blotter.php",
	],
	[
		"icon-text" => "₱",
		"title" => "Collection - by day",
		"subtitle" => "Collection Payment",
		"value" => number_format($revenue["am"], 2),
		"href" => "revenue.php",
	],
	[
		"icon" => "fas flaticon-user",
		"title" => "4ps Members",
		"subtitle" => "4ps Members",
		"value" => $residents_summary["total_4ps"],
		"href" => "4ps-residents.php",
	],
	[
		"icon" => "fas flaticon-user",
		"title" => "PWD Members",
		"subtitle" => "PWD Members",
		"value" => $residents_summary["total_pwds"],
		"href" => "resident.php?is_pwd=1",
	],
	[
		"icon" => "fas flaticon-user",
		"title" => "Senior Members",
		"subtitle" => "Senior Members",
		"value" => $residents_summary["total_seniors"],
		"href" => "resident.php?is_senior=1",
	],
	[
		"icon" => "icon-layers",
		"title" => "Requested Certificates",
		"subtitle" => "Requested Certificates",
		"value" => $certificate_requests_summary["total"],
		"href" => "certificate-requests.php",
	],
];
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

    .request-list>.request-list__item {
      justify-content: space-between;
      align-items: center;
    }

    .request-list>.request-list__item>div>p {
      margin-bottom: 0;
    }

    .request-list>.request-list__item>div>.subtitle {
      font-size: 10px;
      opacity: 0.5;
    }

    .card-certificate-requests>.card-header>.card-title {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .card-certificate-requests__summary {
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
                <?php include "templates/resident-review-card.php"; ?>
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

                  <div class="card-body" style="max-height: 500px; overflow-y: auto">
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
                      Announcements
                    </div>
                  </div>

                  <div class="card-body" style="max-height: 500px; overflow-y: auto">
                    <ul class="list-group request-list">
                      <?php foreach ($announcements as $curr_announcement): ?>
                      <li class="list-group-item request-list__item">
                        <div class="text-truncate">
                          <p><?= $curr_announcement["title"] ?></p>
                          <small class="subtitle"><?= $curr_announcement["content"] ?></small>
                        </div>
                      </li>
                      <?php endforeach; ?>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <?php endif; ?>

            <?php if (role(["administrator", "staff"])): ?>
            <div class="row">
              <?php foreach ($admin_dashboard_cards as $row): ?>
              <div class="col-md-4">
                <div class="card card-stats card-round"
                style="background-color: <?= getRandomColor() ?>; color: #fff"
                >
                  <div class="card-body">
                    <div class="row">
                      <div class="col-2">
                        <div class="icon-big text-center">
                          <?php if (isset($row["icon"])): ?>
                            <i class="<?= $row["icon"] ?>"></i>
                          <?php elseif (isset($row["icon-text"])): ?>
                            <i><?= $row["icon-text"] ?></i>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="col-3 col-stats">
                      </div>
                      <div class="col-6 col-stats">
                        <div class="numbers mt-4">
                          <h7 class="fw-bold text-uppercase">
                            <?= $row["title"] ?>
                            </h7>
                          <h3 class="fw-bold text-uppercase">
                            <?= $row["value"] ?>
                          </h3>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <a href="<?= $row["href"] ?>" class="card-link text-light">
                      <?= $row["subtitle"] ?>
                    </a>
                  </div>
                </div>
              </div>
              <?php endforeach; ?>
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
