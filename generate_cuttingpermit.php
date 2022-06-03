<?php include 'bootstrap/index.php' ?>
<?php
$id = $_GET['id'];

$request = $db
  ->from(["tblrequest" => "requests"])
  ->where('id', $id)
  ->first()
  ->exec();

$captain = $db
  ->from(["tblofficials" => "officials"])
  ->join(["tblposition" => "positions"], "positions.id", "officials.position")
  ->where("positions.position", "Barangay Captain")
  ->first()
  ->select([
    "name" => "officials.name",
  ])
  ->exec();

if (isset($_GET['request_id'])) {
  $cr_request = $db
    ->from(["certificate_requests" => "cr"])
    ->join("residents", "residents.id", "cr.resident_id")
    ->where("cr.id", $_GET['request_id'])
    ->first()
    ->select([
      "data" => "cr.data",
      "firstname" => "residents.firstname",
      "middlename" => "residents.middlename",
      "lastname" => "residents.lastname",
      "created_at" => "residents.created_at",
    ])
    ->exec();

  if (!empty($cr_request)) {
    $cr_request['data'] = json_decode($cr_request['data'], true);

    $request['name'] = fullname($cr_request);
    $request['pcs'] = $cr_request['data']['quantity'];
    $request['type'] = $cr_request['data']['material'];
    $request['location'] = $cr_request['data']['location'];
    $request['applied'] = $cr_request['created_at'];
  }
}

?>
<!DOCTYPE html>
<html lang="en">

  <head>
    <?php include 'templates/header.php' ?>
    <title>Cutting Permit - Barangay Services Management System</title>
    <style>
    @page {
      size: auto;
      /* auto is the initial value */

      /* this affects the margin in the printer settings */
      margin: 20mm 20mm 20mm 20mm;
    }

    </style>
  </head>

  <body>
    <?php include 'templates/loading_screen.php' ?>
    <div class="wrapper">
      <!-- Main Header -->
      <?php include 'templates/main-header.php' ?>
      <!-- End Main Header -->

      <!-- Sidebar -->
      <?php include 'templates/sidebar.php' ?>
      <!-- End Sidebar -->

      <div class="main-panel">
        <div class="content">
          <div class="panel-header bg-primary-gradient">
            <div class="page-inner">
              <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                  <h2 class="text-white fw-bold">Generate Permit</h2>
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
                      <div class="card-title">Cutting Permit</div>
                      <div class="card-tools">
                        <button class="btn btn-info btn-border btn-round btn-sm" onclick="printDiv('printThis')">
                          <i class="fa fa-print"></i>
                          Print Certificate
                        </button>
                      </div>
                    </div>
                  </div>

                  <div class="card-body m-5" id="printThis">
                    <div class="d-flex flex-wrap justify-content-around" style="border-bottom:1px solid red">
                      <div class="text-center">
                        <img src="assets/uploads/<?= $city_logo ?>" class="img-fluid" width="100">
                      </div>
                      <div class="text-center">
                        <h3 class="fw-bold mb-0"><i>Republic of the Philippines</i></h3>
                        <h3 class="fw-bold mb-0"><i>Province of <?= ucwords($province) ?></i></h3>
                        <h3 class="fw-bold mb-0"><i><?= ucwords($town) ?></i></h3>
                        <h1 class="fw-bold mb-0"><i><?= ucwords($brgy) ?></i></h2>
                          <p><i>Mobile No. <?= $number ?></i></p>
                      </div>
                      <div class="text-center">
                        <img src="assets/uploads/<?= $brgy_logo ?>" class="img-fluid" width="100">
                      </div>
                    </div>
                    <div class="row mt-2">
                      <div class="col-md-12">
                        <div class="text-center mt-5">
                          <h1 class="mt-4 fw-bold"><u>CERTIFICATION</u></h1>
                        </div>
                        <div class="text-center">
                          <h1 class="mt-4 fw-bold mb-5" style="font-size:38px;color:darkblue">CUTTING PERMIT CLEARANCE
                          </h1>
                        </div>
                        <h2 class="mt-5 fw-bold">TO WHOM IT MAY CONCERN:</h2><br>
                        <h3 class="mt-3" style="text-indent: 40px;">This is to certify that
                          <b><u><?= ucfirst($request['name']) ?></u></b>, legal age, resident of <span class="fw-bold"
                            style="font-size:18px"><?= ucwords($brgy) ?>, <span class="fw-bold"
                              style="font-size:18px"><?= ucwords($town) ?>,. <span class="fw-bold"
                                style="font-size:18px"><?= ucwords($province) ?>.</span></span></span>
                        </h3><br>

                        <h3 class="mt-3" style="text-indent: 40px;">CERTIFIED FURTHER that
                          <?= ucfirst($request['name']) ?>, request permit to cut <?= ucfirst($request['pcs']) ?> pcs
                          unproductive <?= ucfirst($request['type']) ?>, located at <?= ucfirst($request['location']) ?>
                          within his/her land area. </h3><br>


                        <h3 class="mt-3" style="text-indent: 40px;">Issued this upon request of the interested party for
                          whatever legal purpose it may serve.</h3><br>

                        <h3 class="mt-3" style="text-indent: 40px;">Done this <?= ucfirst($request['applied']) ?> at
                          <span class="fw-bold" style="font-size:18px"><?= ucwords($brgy) ?>, <span class="fw-bold"
                              style="font-size:18px"><?= ucwords($town) ?>,. <span class="fw-bold"
                                style="font-size:18px"><?= ucwords($province) ?>.</span></span></span>
                        </h3>
                        <br><br><br><br><br><br>



                        <h3 style="text-indent: 400px;">Certified by:



                          <div class="col-md-12">
                            <div class="p-3 text-right mr-5">


                              <h1 class="fw-bold mb-0 text-uppercase"><u><?= ucwords($captain['name']) ?></u></h1>
                              <p class="mr-5">PUNONG BARANGAY</p>
                            </div>


                            </form>
                          </div>
                      </div>
                    </div>

                    <!-- Main Footer -->
                    <?php include 'templates/main-footer.php' ?>
                    <!-- End Main Footer -->
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
                  name="details">Cutting Permit Payment</textarea>
              </div>
          </div>
          <div class="modal-footer">
            <input type="hidden" name="resident_id" value="<?= $_GET['id'] ?>">
            <input type="hidden" name="create-payment" value="<?= $_GET['id'] ?>">
            <input type="hidden" name="request_id" value="<?= getBody('request_id', $_GET) ?>">
            <input type="hidden" name="certificate_id" value="6">
            <button type="button" class="btn btn-secondary" onclick="goBack()">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
          </form>
        </div>
      </div>
    </div>

    <?php include 'templates/footer.php' ?>

    <script>
    const urlSearchParams = new URLSearchParams(window.location.search);
    const params = Object.fromEntries(urlSearchParams.entries());

    if (!params['closeModal']) {
      setTimeout(() => {
        $('#pment').modal('show');
      }, 1000);
    }

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
