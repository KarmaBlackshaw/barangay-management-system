<?php
require "bootstrap/index.php";

$resident = (function () use ($db) {
  return $db
    ->from("residents")
    ->where("id", $_GET["id"])
    ->first()
    ->exec();
})();

$query1 = "SELECT * FROM tblofficials JOIN tblposition ON tblofficials.position=tblposition.id WHERE tblposition.position NOT IN ('SK Chairrman','Secretary','Treasurer')
                AND `status`='Active' ORDER BY `order` ASC";
$result1 = $conn->query($query1);
$officials = [];
while ($row = $result1->fetch_assoc()) {
  $officials[] = $row;
}

$captain = $db
  ->from(["tblofficials" => "officials"])
  ->join(["tblposition" => "positions"], "positions.id", "officials.position")
  ->where("positions.position", "Barangay Captain")
  ->first()
  ->select([
    "name" => "officials.name",
  ])
  ->exec();

$sec = $db
  ->from(["tblofficials" => "officials"])
  ->join(["tblposition" => "positions"], "positions.id", "officials.position")
  ->where("positions.position", "Secretary")
  ->first()
  ->select([
    "name" => "officials.name",
  ])
  ->exec();
?>
<!DOCTYPE html>
<html lang="en">

  <head>
    <?php include "templates/header.php"; ?>
    <title>Barangay Certificate - Barangay
      Services Management System</title>
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
                    Generate Certificate</h2>
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
                      <div class="card-title">
                        Barangay Certificate</div>
                      <div class="card-tools">
                        <button class="btn btn-info btn-border btn-round btn-sm" onclick="printDiv('printThis')">
                          <i class="fa fa-print"></i>
                          Print Certificate
                        </button>
                      </div>
                    </div>
                  </div>
                  <div class="card-body m-5" id="printThis">
                    <div class="d-flex flex-wrap justify-content-center" style="border-bottom:1px solid red">
                      <div class="text-center">
                        <img src="assets/uploads/<?= $city_logo ?>" class="img-fluid" width="100">
                      </div>
                      <div class="text-center">
                        <h3 class="fw-bold mb-0">
                          <i>Republic of the
                            Philippines</i>
                        </h3>
                        <h3 class="fw-bold mb-0">
                          <i>Province of
                            <?= ucwords($province) ?></i>
                        </h3>
                        <h3 class="fw-bold mb-0">
                          <i><?= ucwords($town) ?></i>
                        </h3>
                        <h1 class="fw-bold mb-0">
                          <i><?= ucwords($brgy) ?></i>
                        </h1>
                        <p><i>Mobile No.
                            <?= $number ?></i></p>
                      </div>
                      <div class="text-center">
                        <img src="assets/uploads/<?= $brgy_logo ?>" class="img-fluid" width="100">
                      </div>
                    </div>
                    <div class="row mt-2">
                      <div class="col-md-3">
                        <div class="text-center p-3">
                          <img src="assets/img/flag.png" class="img-fluid" width="200" />

                          <h5 class="mt-3 mb-0">
                            <b>VISION:</b>
                            <i>
                              The Eco-Tourism Hub
                              of Leyte with a
                              progressive,
                              God-loving and
                              empowered community,
                              governed by strong
                              and proactive
                              leaders working
                              collaboratively with
                              the stakeholders
                              towards inclusive
                              growth and
                              sustainable
                              development.
                            </i>
                          </h5>
                          <br>
                          <h5 class="mb-2 ">
                            <b>MISSION:</b>
                            <i>
                              To uplift the
                              quality of life of
                              the populace through
                              sustainable
                              economic, social,
                              infrastructure,
                              institutional and
                              environmental
                              development.
                            </i>
                          </h5>
                        </div>
                      </div>
                      <div class="col-md-9">
                        <div class="text-center">
                          <h2 class="mt-4 fw-bold">
                            OFFICE OF THE BARANGAY
                            CAPTAIN</h2>
                        </div>
                        <div class="text-center">
                          <h1 class="mt-4 fw-bold mb-5">
                            BARANGAY CLEARANCE
                          </h1>
                        </div>
                        <h2 class="mt-5">TO WHOM
                          IT MAY CONCERN:</h2>
                        <h2 class="mt-3" style="text-indent: 40px;">
                          This is to certify that
                          <span class="fw-bold" style="font-size:25px">
                            <?= fullname($resident) ?>
                          </span>, is a permanent
                          resident of
                          <span class="fw-bold" style="font-size:25px"><?= ucwords(
                                                                        $brgy
                                                                      ) ?></span>
                          and that he/she is known
                          to me to be
                          of good moral character.
                        </h2>
                        <h2 class="mt-3" style="text-indent: 40px;">
                          This
                          certification/clearance
                          is hereby issued to the
                          above-named person for
                          whatever legal purpose
                          it may serve him/her
                          best.</h2>
                        <h2 class="mt-3">Given
                          this <span class="fw-bold" style="font-size:25px"><?= date(
                                                                            "m/d/Y"
                                                                          ) ?></span>
                          at the
                          office of the Punong
                          Barangay,
                          <span class="fw-bold" style="font-size:25px">
                            <?= ucwords($brgy) ?>
                          </span>
                          this Municipality,
                          Philippines.
                        </h2></span></h2>
                        <h2 class="text-uppercase" style="margin-top:180px;">
                          NOT VALID WITHOUT SEAL:
                        </h2>
                      </div>
                      <div class="col-md-12">
                        <div class="p-3 text-right mr-3">
                          <h2 class="fw-bold mb-0 text-uppercase">
                            <?= ucwords(
                            $captain["name"]
                          ) ?></h2>
                          <p class="mr-3">PUNONG
                            BARANGAY</p>
                        </div>
                        <div class="p-3 text-left">
                          <h2 class="fw-bold mb-0 text-uppercase">
                            <?= empty($sec["name"])
                            ? "Please Create Official with Secretary Position"
                            : ucwords($sec["name"]) ?>
                          </h2>
                          <p class="ml-2">BARANGAY
                            SECRETARY</p>
                        </div>
                      </div>
                      <div class="col-md-12 d-flex flex-wrap justify-content-end">
                        <div class="p-3 text-center">
                          <div class="border mx-auto mb-3" style="height:150px;width:290px">
                            <p class="mt-5 mb-0 pt-5">
                              Right Thumb Mark</p>
                          </div>
                          <h2 class="fw-bold mb-0">
                            <?= fullname($resident) ?>
                          </h2>
                          <p>Tax Payer's Signature
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="pment" data-backdrop="static" data-keyboard="false">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create
                  Payment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form method="POST" action="model/save_pment.php">
                  <div class="form-group">
                    <label>Amount</label>
                    <input type="number" class="form-control" name="amount" placeholder="Enter amount to pay" required>
                  </div>

                  <div class="form-group">
                    <label>Date Issued</label>
                    <input type="date" class="form-control" name="date" value="<?= date("Y-m-d") ?>">
                  </div>

                  <div class="form-group">
                    <label>Mode</label>
                    <select class="form-control" name="mode" required>
                      <option selected disabled>Choose payment mode</option>
                      <option value="online">Online</option>
                      <option value="cash">Cash</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Payment Details(Optional)</label>
                    <textarea class="form-control" placeholder="Enter Payment Details"
                      name="details">Barangay Clearance Payment</textarea>
                  </div>
              </div>
              <div class="modal-footer">
                <input type="hidden" name="resident_id" value="<?= $_GET['id'] ?>">
                <input type="hidden" name="request_id" value="<?= getBody('request_id', $_GET) ?>">
                <input type="hidden" name="create-payment" value="<?= $_GET['id'] ?>">
                <input type="hidden" name="certificate_id" value="1">
                <button type="button" class="btn btn-secondary" onclick="goBack()">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
              </form>
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
    const urlSearchParams = new URLSearchParams(window.location.search);
    const params = Object.fromEntries(urlSearchParams.entries());

    if (!params['closeModal']) {
      setTimeout(() => {
        $('#pment').modal('show');
      }, 1000);
    }

    function printDiv(divName) {
      var printContents = document.getElementById(
        divName).innerHTML;
      var originalContents = document.body
        .innerHTML;

      document.body.innerHTML = printContents;

      window.print();

      document.body.innerHTML = originalContents;
    }
    </script>
  </body>

</html>
