<?php
session_start();

include "bootstrap/index.php";

$purokList = (function () use ($db) {
	// prettier-ignore
	return $db
		->from("purok")
		->select([
			"id" => "purok.id",
			"name" => "purok.name",
			"details" => "purok.details",
		])
		->exec();
})();
?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <?php include "templates/header.php"; ?>

    <title>Login - Barangay Services Management System</title>

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

    .form-check>.btn-group>label {
      border: 1px solid #3f3f46;
    }

    .wrapper {
      height: 100% !important;
    }

    </style>
  </head>

  <body class="login">
    <?php include "templates/loading_screen.php"; ?>

    <div class="
			wrapper
			<?= isAuthenticated() ? "" : "d-flex flex-column justify-content-center" ?>
		">

      <?php isAdmin() and (include "templates/main-header.php"); ?>

      <?php isAdmin() and (include "templates/sidebar.php"); ?>

      <div class="

				<?= isAdmin() ? "main-panel" : "" ?>
				<?= isAuthenticated() ? "" : "container" ?>
				<?= isAuthenticated() ? "" : "d-flex flex-column justify-content-center" ?>
			">
        <div class="content">
          <?php if (isAdmin()): ?>
          <div class="panel-header bg-primary-gradient">
            <div class="page-inner">
              <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                  <h2 class="text-white fw-bold">Resident Registration</h2>
                </div>
              </div>
            </div>
          </div>
          <?php endif; ?>

          <div class="page-inner">
            <div class="fadeIn card">
              <div class="login-form card-body">
                <?php if (!isAuthenticated()): ?>
                <h3 class="card-title text-center fw-bold mb-3">Register</h3>
                <?php endif; ?>

                <?php include "templates/alert.php"; ?>

                <form method="POST" action="model/residents.php" autocomplete="off" enctype="multipart/form-data">
                  <div class="row g-5">
                    <div class="col-md-4">
                      <div style="height: 250;" class="text-center" id="my_camera">
                        <img src="assets/img/person.png" alt="..." class="img img-fluid" width="250">
                      </div>

                      <div class="form-group d-flex justify-content-center gap-2">
                        <button type="button" class="btn btn-danger btn-sm mr-2" id="open_cam">
                          Open Camera
                        </button>
                        <button type="button" class="btn btn-secondary btn-sm ml-2" onclick="save_photo()">
                          Capture
                        </button>
                      </div>

                      <div id="profileImage">
                        <input type="hidden" name="profileimg">
                      </div>

                      <div class="form-group">
                        <input type="file" class="form-control" name="img" accept="image/*">
                      </div>

                      <div class="form-group">
                        <label>National ID No.</label>
                        <input type="text" class="form-control" name="national_id" placeholder="Enter National ID No."
                          required>
                      </div>

                      <div class="form-group">
                        <label>Citizenship</label>
                        <input type="text" class="form-control" name="citizenship" placeholder="Enter citizenship"
                          required>
                      </div>

                      <div class="form-group">
                        <label>Address</label>
                        <textarea class="form-control" name="address" required placeholder="Enter Address"></textarea>
                      </div>
                    </div>

                    <div class="col-md-8">
                      <div class="row g-0">
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label>First name</label>
                            <input class="form-control" placeholder="Enter First name" name="fname" required>
                          </div>
                        </div>

                        <div class="col-sm-4">
                          <div class="form-group">
                            <label>Middle name</label>
                            <input class="form-control" placeholder="Enter Middle name" name="mname" required>
                          </div>
                        </div>

                        <div class="col-sm-4">
                          <div class="form-group">
                            <label>Last name</label>
                            <input class="form-control" placeholder="Enter Last name" name="lname" required>
                          </div>
                        </div>
                      </div>

                      <div class="row g-0">
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label>Alias</label>
                            <input class="form-control" placeholder="Enter Alias" name="alias">
                          </div>
                        </div>

                        <div class="col-sm-4">
                          <div class="form-group">
                            <label>Place of Birth</label>
                            <input class="form-control" placeholder="Enter Birthplace" name="birthplace" required>
                          </div>
                        </div>

                        <div class="col-sm-4">
                          <div class="form-group">
                            <label>Birthdate</label>
                            <input type="date" class="form-control" placeholder="Enter Birthdate" name="birthdate"
                              required>
                          </div>
                        </div>
                      </div>

                      <div class="row g-0">
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label>Age</label>
                            <input type="number" class="form-control" placeholder="Enter Age" min="1" name="age"
                              required>
                          </div>
                        </div>

                        <div class="col-sm-4">
                          <div class="form-group">
                            <label>Civil Status</label>
                            <select class="form-control" name="civil_status">
                              <option disabled selected>Select Civil Status</option>
                              <option value="Single">Single</option>
                              <option value="Married">Married</option>
                              <option value="Widow">Widow</option>
                            </select>
                          </div>
                        </div>

                        <div class="col-sm-4">
                          <div class="form-group">
                            <label>Gender</label>
                            <select class="form-control" required name="gender">
                              <option disabled selected value="">Select Gender</option>
                              <option value="Male">Male</option>
                              <option value="Female">Female</option>
                            </select>
                          </div>
                        </div>
                      </div>

                      <div class="row g-0">
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label>Purok</label>
                            <select class="form-control" required name="purok_id">
                              <option disabled selected>Select Purok Name</option>
                              <?php foreach ($purokList as $purok): ?>
                              <option value="<?= $purok["id"] ?>"><?= $purok["name"] ?></option>
                              <?php endforeach; ?>
                            </select>
                          </div>
                        </div>

                        <div class="col-sm-4">
                          <div class="form-group">
                            <label>Voters Status</label>
                            <select class="form-control vstatus" required name="voter_status">
                              <option disabled selected>Select Voters Status</option>
                              <option value="Yes">Yes</option>
                              <option value="No">No</option>
                            </select>
                          </div>
                        </div>

                        <div class="col-sm-4">
                          <div class="form-group">
                            <label>Identified As</label>
                            <select class="form-control indetity" name="identified_as">
                              <option value="Positive">Positive</option>
                              <option value="Negative">Negative</option>
                              <option value="Unidentified" selected>Unidentified</option>
                            </select>
                          </div>
                        </div>
                      </div>

                      <div class="row g-0">
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label>Email Address</label>
                            <input type="email" class="form-control" placeholder="Enter Email" name="email">
                          </div>
                        </div>

                        <div class="col-sm-4">
                          <div class="form-group">
                            <label>Contact Number</label>
                            <input class="form-control" placeholder="Enter Contact Number" name="number">
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label>Occupation</label>
                            <input class="form-control" placeholder="Enter Occupation" name="occupation">
                          </div>
                        </div>
                      </div>

                      <div class="row g-0">
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label>Are you a 4Ps Beneficiary?</label>

                            <div class="form-check">
                              <div class="btn-group btn-group-justified" data-toggle="buttons">
                                <label class="btn ">
                                  <input type="radio" name="is_4ps" class="hidden" value="1"> Yes
                                </label>
                                <label class="btn active">
                                  <input type="radio" name="is_4ps" class="hidden" value="0"> No
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
                                <label class="btn ">
                                  <input type="radio" name="is_pwd" class="hidden" value="1"> Yes
                                </label>
                                <label class="btn active">
                                  <input type="radio" name="is_pwd" class="hidden" value="0"> No
                                </label>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row g-0">
                        <div class="col-12">
                          <div class="form-group">
                            <label>Username</label>
                            <input class="form-control" placeholder="Enter Email" name="username">
                          </div>
                        </div>

                        <div class="col-6">
                          <div class="form-group">
                            <label>Password</label>

                            <input id="password" name="password" type="password" class="form-control"
                              placeholder="Password">
                            <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password">
                            </span>
                          </div>
                        </div>

                        <div class="col-6">
                          <div class="form-group">
                            <label>Password Confirmation</label>

                            <input id="password_confirm" name="password_confirm" type="password" class="form-control"
                              placeholder="Password Confirmation">
                            <span toggle="#password_confirm" class="fa fa-fw fa-eye field-icon toggle-password">
                            </span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="form-action mb-3 d-flex justify-content-end gap-3">
                    <input type="hidden" name="register-resident" value="1">

                    <?php if (isAdmin()): ?>
                    <a type="button" href="resident.php" class="btn btn-dark btn-block text-white fw-bold">
                      Back
                    </a>
                    <?php endif; ?>

                    <button type="submit" class="btn btn-success btn-block text-white fw-bold">
                      Register
                    </button>

                    <?php if (!isAuthenticated()): ?>
                    <a href="login.php" class="btn btn-dark btn-block text-white fw-bold">
                      Back to Login
                    </a>
                    <?php endif; ?>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- Main Footer -->
        <?php isAdmin() and (include "templates/main-footer.php"); ?>
        <!-- End Main Footer -->
      </div>
    </div>

    <?php include "templates/footer.php"; ?>
  </body>

</html>
