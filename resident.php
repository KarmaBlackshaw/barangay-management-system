<?php include 'server/server.php' ?>
<?php
$query = "SELECT * FROM tblresident";
$result = $conn->query($query);

$resident = array();
while ($row = $result->fetch_assoc()) {
    $resident[] = $row;
}

$query1 = "SELECT * FROM tblpurok ORDER BY `name`";
$result1 = $conn->query($query1);

$purok = array();
while ($row = $result1->fetch_assoc()) {
    $purok[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'templates/header.php' ?>
    <title>Resident Information - Barangay Services Management System</title>
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
                                <h2 class="text-white fw-bold">Residents</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-inner">
                    <div class="row mt--2">
                        <div class="col-md-12">

                            <?php if (isset($_SESSION['message'])) : ?>
                                <div class="alert alert-<?php echo $_SESSION['status']; ?> <?= $_SESSION['status'] == 'danger' ? 'bg-danger text-light' : null ?>" role="alert">
                                    <?php echo $_SESSION['message']; ?>
                                </div>
                                <?php unset($_SESSION['message']); ?>
                            <?php endif ?>

                            <div class="card">
                                <div class="card-header">
                                    <div class="card-head-row">
                                        <div class="card-title">Resident Information</div>
                                        <?php if (isset($_SESSION['username'])) : ?>
                                            <div class="card-tools">
                                                <a href="#add" data-toggle="modal" class="btn btn-info btn-border btn-round btn-sm">
                                                    <i class="fa fa-plus"></i>
                                                    Resident
                                                </a>
                                                <a href="model/export_resident_csv.php" class="btn btn-danger btn-border btn-round btn-sm">
                                                    <i class="fa fa-file"></i>
                                                    Export CSV
                                                </a>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="residenttable" class="display table table-striped">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Fullname</th>
                                                    <th scope="col">National ID</th>
                                                    <th scope="col">Alias</th>
                                                    <th scope="col">Birthdate</th>
                                                    <th scope="col">Age</th>
                                                    <th scope="col">Civil Status</th>
                                                    <th scope="col">Gender</th>
                                                    <th scope="col">Purok</th>
                                                    <?php if (isset($_SESSION['username'])) : ?>
                                                        <?php if ($_SESSION['role'] == 'administrator') : ?>
                                                            <th scope="col">Voter Status</th>
                                                        <?php endif ?>
                                                        <th scope="col">Action</th>
                                                    <?php endif ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (!empty($resident)) : ?>
                                                    <?php $no = 1;
                                                    foreach ($resident as $row) : ?>
                                                        <tr>
                                                            <td>
                                                                <div class="avatar avatar-xs">
                                                                    <img src="<?= preg_match('/data:image/i', $row['picture']) ? $row['picture'] : 'assets/uploads/resident_profile/' . $row['picture'] ?>" alt="Resident Profile" class="avatar-img rounded-circle">
                                                                </div>
                                                                <?= ucwords($row['lastname'] . ', ' . $row['firstname'] . ' ' . $row['middlename']) ?>
                                                            </td>
                                                            <td><?= $row['national_id'] ?></td>
                                                            <td><?= $row['alias'] ?></td>
                                                            <td><?= $row['birthdate'] ?></td>
                                                            <td><?= $row['age'] ?></td>
                                                            <td><?= $row['civilstatus'] ?></td>
                                                            <td><?= $row['gender'] ?></td>
                                                            <td><?= $row['purok'] ?></td>
                                                            <?php if (isset($_SESSION['username'])) : ?>
                                                                <?php if ($_SESSION['role'] == 'administrator') : ?>
                                                                    <td><?= $row['voterstatus'] ?></td>

                                                                <?php endif ?>
                                                                <td>
                                                                    <div class="form-button-action">
                                                                        <a type="button" href="#edit" data-toggle="modal" class="btn btn-link btn-primary" title="View Resident" onclick="editResident(this)" data-id="<?= $row['id'] ?>" data-national="<?= $row['national_id'] ?>" data-fname="<?= $row['firstname'] ?>" data-mname="<?= $row['middlename'] ?>" data-lname="<?= $row['lastname'] ?>" data-alias="<?= $row['alias'] ?>" data-bplace="<?= $row['birthplace'] ?>" data-bdate="<?= $row['birthdate'] ?>" data-age="<?= $row['age'] ?>" data-cstatus="<?= $row['civilstatus'] ?>" data-gender="<?= $row['gender'] ?>" data-purok="<?= $row['purok'] ?>" data-vstatus="<?= $row['voterstatus'] ?>" data-indetity="<?= $row['identified_as'] ?>" data-number="<?= $row['phone'] ?>" data-email="<?= $row['email'] ?>" data-address="<?= $row['address'] ?>" data-img="<?= $row['picture'] ?>" data-citi="<?= $row['citizenship']; ?>" data-occu="<?= $row['occupation'] ?>" data-dead="<?= $row['resident_type']; ?>" data-remarks="<?= $row['remarks'] ?>">
                                                                            <?php if (isset($_SESSION['username'])) : ?>
                                                                                <i class="fa fa-edit"></i>
                                                                            <?php else : ?>
                                                                                <i class="fa fa-eye"></i>
                                                                            <?php endif ?>
                                                                        </a>
                                                                        <?php if (isset($_SESSION['username']) && $_SESSION['role'] == 'administrator') : ?>
                                                                            <a type="button" data-toggle="tooltip" href="generate_resident.php?id=<?= $row['id'] ?>" class="btn btn-link btn-info" data-original-title="Generate">
                                                                                <i class="fa fa-file"></i>
                                                                            </a>
                                                                            <a type="button" data-toggle="tooltip" href="model/remove_resident.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this resident?');" class="btn btn-link btn-danger" data-original-title="Remove">
                                                                                <i class="fa fa-times"></i>
                                                                            </a>
                                                                        <?php endif ?>
                                                                    </div>
                                                                </td>
                                                            <?php endif ?>

                                                        </tr>
                                                    <?php $no++;
                                                    endforeach ?>
                                                <?php endif ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th scope="col">Fullname</th>
                                                    <th scope="col">National ID</th>
                                                    <th scope="col">Alias</th>
                                                    <th scope="col">Birthdate</th>
                                                    <th scope="col">Age</th>
                                                    <th scope="col">Civil Status</th>
                                                    <th scope="col">Gender</th>
                                                    <th scope="col">Purok</th>
                                                    <?php if (isset($_SESSION['username'])) : ?>
                                                        <?php if ($_SESSION['role'] == 'administrator') : ?>
                                                            <th scope="col">Voter Status</th>



                                                        <?php endif ?>
                                                        <th scope="col">Action</th>
                                                    <?php endif ?>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">New Resident Registration Form</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/save_resident.php" enctype="multipart/form-data">
                                <input type="hidden" name="size" value="1000000">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div style="width: 370px; height: 250;" class="text-center" id="my_camera">
                                            <img src="assets/img/person.png" alt="..." class="img img-fluid" width="250">
                                        </div>
                                        <div class="form-group d-flex justify-content-center">
                                            <button type="button" class="btn btn-danger btn-sm mr-2" id="open_cam">Open Camera</button>
                                            <button type="button" class="btn btn-secondary btn-sm ml-2" onclick="save_photo()">Capture</button>
                                        </div>
                                        <div id="profileImage">
                                            <input type="hidden" name="profileimg">
                                        </div>
                                        <div class="form-group">
                                            <input type="file" class="form-control" name="img" accept="image/*">
                                        </div>
                                        <div class="form-group">
                                            <label>National ID No.</label>
                                            <input type="text" class="form-control" name="national" placeholder="Enter National ID No." required>
                                        </div>
                                        <div class="form-group">
                                            <label>Citizenship</label>
                                            <input type="text" class="form-control" name="citizenship" placeholder="Enter citizenship" required>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Firstname</label>
                                                    <input type="text" class="form-control" placeholder="Enter Firstname" name="fname" required>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Middlename</label>
                                                    <input type="text" class="form-control" placeholder="Enter Middlename" name="mname" required>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Lastname</label>
                                                    <input type="text" class="form-control" placeholder="Enter Lastname" name="lname" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Alias</label>
                                                    <input type="text" class="form-control" placeholder="Enter Alias" name="alias">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Place of Birth</label>
                                                    <input type="text" class="form-control" placeholder="Enter Birthplace" name="bplace" required>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Birthdate</label>
                                                    <input type="date" class="form-control" placeholder="Enter Birthdate" name="bdate" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Age</label>
                                                    <input type="number" class="form-control" placeholder="Enter Age" min="1" name="age" required>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Civil Status</label>
                                                    <select class="form-control" name="cstatus">
                                                        <option disabled selected>Select Civil Status</option>
                                                        <option value="Single">Single</option>
                                                        <option value="Married">Married</option>
                                                        <option value="Widow">Widow</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
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
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Purok</label>
                                                    <select class="form-control" required name="purok">
                                                        <option disabled selected>Select Purok Name</option>
                                                        <?php foreach ($purok as $row) : ?>
                                                            <option value="<?= ucwords($row['name']) ?>"><?= $row['name'] ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Voters Status</label>
                                                    <select class="form-control vstatus" required name="vstatus">
                                                        <option disabled selected>Select Voters Status</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Identified As</label>
                                                    <select class="form-control indetity" name="indetity">
                                                        <option value="Positive">Positive</option>
                                                        <option value="Negative">Negative</option>
                                                        <option value="Unidentified">Unidentified</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Email Address</label>
                                                    <input type="email" class="form-control" placeholder="Enter Email" name="email">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Contact Number</label>
                                                    <input type="text" class="form-control" placeholder="Enter Contact Number" name="number">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Occupation</label>
                                                    <input type="text" class="form-control" placeholder="Enter Occupation" name="occupation">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Address</label>
                                            <textarea class="form-control" name="address" required placeholder="Enter Address"></textarea>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit/View Resident Information</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/edit_resident.php" enctype="multipart/form-data">
                                <input type="hidden" name="size" value="1000000">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div id="my_camera1" style="width: 370px; height: 250;" class="text-center">
                                            <img src="assets/img/person.png" alt="..." class="img img-fluid" width="250" id="image">
                                        </div>
                                        <?php if (isset($_SESSION['username'])) : ?>
                                            <div class="form-group d-flex justify-content-center">
                                                <button type="button" class="btn btn-danger btn-sm mr-2" id="open_cam1">Open Camera</button>
                                                <button type="button" class="btn btn-secondary btn-sm ml-2" onclick="save_photo1()">Capture</button>
                                            </div>
                                            <div id="profileImage1">
                                                <input type="hidden" name="profileimg">
                                            </div>
                                            <div class="form-group">
                                                <input type="file" class="form-control" name="img" accept="image/*">
                                            </div>
                                        <?php endif ?>
                                        <div class="form-group">
                                            <div class="selectgroup selectgroup-secondary selectgroup-pills">
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="deceased" value="1" class="selectgroup-input" checked="" id="alive">
                                                    <span class="selectgroup-button selectgroup-button-icon"><i class="fa fa-walking"></i></span>
                                                </label>
                                                <p class="mt-1 mr-3"><b>Alive</b></p>
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="deceased" value="0" class="selectgroup-input" id="dead">
                                                    <span class="selectgroup-button selectgroup-button-icon"><i class="fa fa-people-carry"></i></span>
                                                </label>
                                                <p class="mt-1 mr-3"><b>Deceased</b></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>National ID No.</label>
                                            <input type="text" class="form-control" name="national" id="nat_id" placeholder="Enter National ID No.">
                                        </div>
                                        <div class="form-group">
                                            <label>Citizenship</label>
                                            <input type="text" class="form-control" name="citizenship" id="citizenship" placeholder="Enter citizenship" required>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Firstname</label>
                                                    <input type="text" class="form-control" placeholder="Enter Firstname" name="fname" id="fname" required>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Middlename</label>
                                                    <input type="text" class="form-control" placeholder="Enter Middlename" name="mname" id="mname" required>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Lastname</label>
                                                    <input type="text" class="form-control" placeholder="Enter Lastname" name="lname" id="lname" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Alias</label>
                                                    <input type="text" class="form-control" placeholder="Enter Alias" id="alias" name="alias">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Place of Birth</label>
                                                    <input type="text" class="form-control" placeholder="Enter Birthplace" name="bplace" id="bplace" required>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Birthdate</label>
                                                    <input type="date" class="form-control" placeholder="Enter Birthdate" name="bdate" id="bdate" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Age</label>
                                                    <input type="number" class="form-control" placeholder="Enter Age" min="1" name="age" id="age" required>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Civil Status</label>
                                                    <select class="form-control" required name="cstatus" id="cstatus">
                                                        <option disabled selected>Select Civil Status</option>
                                                        <option value="Single">Single</option>
                                                        <option value="Married">Married</option>
                                                        <option value="Widow">Widow</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Gender</label>
                                                    <select class="form-control" required name="gender" id="gender">
                                                        <option disabled selected value="">Select Gender</option>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Purok</label>
                                                    <select class="form-control" required name="purok" id="purok">
                                                        <option disabled selected>Select Purok Name</option>
                                                        <?php foreach ($purok as $row) : ?>
                                                            <option value="<?= ucwords($row['name']) ?>"><?= $row['name'] ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Voters Status</label>
                                                    <select class="form-control vstatus" required name="vstatus" id="vstatus">
                                                        <option disabled selected>Select Voters Status</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Identified As</label>
                                                    <select class="form-control indetity" name="indetity" id="indetity">
                                                        <option disabled selected>Select Identity</option>
                                                        <option value="Positive">Positive</option>
                                                        <option value="Negative">Negative</option>
                                                        <option value="Unidentified">Unidentified</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Email Address</label>
                                                    <input type="email" class="form-control" placeholder="Enter Email" name="email" id="email">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Contact Number</label>
                                                    <input type="text" class="form-control" placeholder="Enter Contact Number" name="number" id="number">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Occupation</label>
                                                    <input type="text" class="form-control" placeholder="Enter Occupation" name="occupation" id="occupation">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Address</label>
                                            <textarea class="form-control" required name="address" placeholder="Enter Address" id="address"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Remarks</label>
                                            <textarea class="form-control" name="remarks" placeholder="Enter remarks" id="remarks"></textarea>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="id" id="res_id">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <?php if (isset($_SESSION['username'])) : ?>
                                <button type="submit" class="btn btn-primary">Update</button>
                            <?php endif ?>
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
    <?php include 'templates/footer.php' ?>
    <script src="assets/js/plugin/datatables/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#residenttable').DataTable();
        });
    </script>
</body>

</html>