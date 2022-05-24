<?php

require "bootstrap/index.php";

$resident = $db
	->from("residents")
	->join("users", "users.id", "residents.account_id")
	->join("purok", "purok.id", "residents.purok_id")
	->where("residents.id", $_GET["id"])
	->select([
		"id" => "residents.id",
		"national_id" => "residents.national_id",
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
		"purok_id" => "residents.purok_id",
		"purok_name" => "purok.name",
		"voterstatus" => "residents.voterstatus",
		"identified_as" => "residents.identified_as",
		"phone" => "residents.phone",
		"email" => "residents.email",
		"occupation" => "residents.occupation",
		"address" => "residents.address",
		"resident_type" => "residents.resident_type",
		"remarks" => "residents.remarks",
		"avatar" => "users.avatar",
	])
	->first()
	->exec();
?>
<!DOCTYPE html>
<html lang="en">

  <head>
    <?php include "templates/header.php"; ?>
    <title>Generate Resident Profile - Barangay Services Management System</title>
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
                  <h2 class="text-white fw-bold">Generate Resident Profile</h2>
                </div>
              </div>
            </div>
          </div>

          <div class="page-inner">
            <div class="row mt--2">
              <div class="col-md-12">
                <?php include "templates/alert.php"; ?>

                <div class="card">
                  <div class="card-header">
                    <div class="card-head-row">
                      <div class="card-title">Resident Profile</div>
                      <div class="card-tools">
                        <button class="btn btn-info btn-border btn-round btn-sm" onclick="printDiv('printThis')">
                          <i class="fa fa-print"></i>
                          Print Report
                        </button>
                      </div>
                    </div>
                  </div>

                  <div class="card-body m-5" id="printThis">
                    <div class="d-flex flex-wrap justify-content-center" style="border-bottom:1px solid red">
                      <div class="text-center">
                        <h3 class="fw-bold mb-0"><i>Republic of the Philippines</i></h3>
                        <h3 class="fw-bold mb-0"><i>Province of <?= ucwords($province) ?></i></h3>
                        <h3 class="fw-bold mb-0"><i><?= ucwords($town) ?></i></h3>
                        <h1 class="fw-bold mb-0"><?= ucwords($brgy) ?></i></h1>
                        <p><i>Mobile No. <?= $number ?></i></p>
                        <h1 class="fw-bold mb-3">Resident Profile</h2>
                      </div>
                    </div>

                    <div class="row mt-2">
                      <div class="col-md-4 d-flex justify-content-center">
                        <img src="<?= imgSrc($resident["avatar"]) ?>" alt="Resident Profile" class="img-fluid"
                          style="width: 200px; height: 200px; object-fit: cover">
                      </div>
                      <div class="col-md-8">
                        <div class="row">
                          <div class="col">
                            <div class="form-group row">
                              <h7 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">National ID:</h7>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                              <input type="text" class="form-control fw-bold" style="font-size:15px" value="<?= $resident[
                              	"national_id"
                              ] ?>">
                            </div>

                            <div class="form-group row">
                              <h7 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Name:</h7>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                              <input type="text" class="form-control fw-bold" style="font-size:15px"
                                value="<?= fullname($resident) ?>">
                            </div>
                          </div>

                          <div class="col">
                            <div class="form-group row">
                              <h7 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Status:</h7>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                              <input type="text" class="form-control fw-bold" style="font-size:15px" value="<?= $resident[
                                "resident_type"
                              ] == 1
                              	? "Alive"
                              	: "Deceased" ?>">
                            </div>

                            <div class="form-group row">
                              <h7 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Alias:</h7>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                              <input type="text" class="form-control fw-bold" style="font-size:15px" value="<?= $resident[
                              	"alias"
                              ] ?>">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group row">
                          <h7 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Birthdate:</h7>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                          <input type="text" class="form-control fw-bold" style="font-size:15px"
                            value="<?= date("F d, Y", strtotime($resident["birthdate"])) ?>">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group row">
                          <h7 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Age:</h7>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                          <input type="text" class="form-control fw-bold" style="font-size:15px"
                            value="<?= $resident["age"] ?> yrs. old">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group row">
                          <h7 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Civil Status:</h7>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                          <input type="text" class="form-control fw-bold" style="font-size:15px"
                            value="<?= $resident["civilstatus"] ?>">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group row">
                          <h7 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Gender:</h7>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                          <input type="text" class="form-control fw-bold" style="font-size:15px"
                            value="<?= $resident["gender"] ?>">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group row">
                          <h7 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Purok:</h7>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                          <input type="text" class="form-control fw-bold" style="font-size:15px"
                            value="<?= $resident["purok_name"] ?>">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group row">
                          <h7 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Voters Status:</h7>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                          <input type="text" class="form-control fw-bold" style="font-size:15px"
                            value="<?= $resident["voterstatus"] ?>">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group row">
                          <h7 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Identified as:</h7>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                          <input type="text" class="form-control fw-bold" style="font-size:15px"
                            value="<?= $resident["identified_as"] ?>">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group row">
                          <h7 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Phone number:</h7>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                          <input type="text" class="form-control fw-bold" style="font-size:15px"
                            value="<?= $resident["phone"] ?>">
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group row">
                          <h7 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Email Address:</h7>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                          <input type="text" class="form-control fw-bold" style="font-size:15px"
                            value="<?= $resident["email"] ?>">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col">
                        <div class="form-group row">
                          <h7 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Occupation:</h7>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                          <textarea class="form-control fw-bold" style="font-size:15px" rows="3">
                          <?= ucwords(trim($resident["occupation"])) ?>
                        </textarea>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col">
                        <div class="form-group row">
                          <h7 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Address:</h7>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                          <textarea class="form-control fw-bold" style="font-size:15px" rows="3">
                          <?= ucwords(trim($resident["address"])) ?>
                        </textarea>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col">
                        <div class="form-group row">
                          <h7 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Remarks:</h7>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                          <textarea class="form-control fw-bold" style="font-size:15px" rows="3">
                          <?= ucwords(trim($resident["remarks"])) ?>
                        </textarea>
                        </div>
                      </div>
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
    <script>
    function printDiv(divName) {
      var printContents = document.getElementById(divName).innerHTML;
      var originalContents = document.body.innerHTML;

      document.body.innerHTML = printContents;

      window.print();

      document.body.innerHTML = originalContents;
    }
    </script>
  </body>

</html>
