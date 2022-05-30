<?php // function to get the current page name
$currentPage = (function () {
	$fullFilename = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);

	return pathinfo($fullFilename)["filename"];
})();

$isSettingsPage = in_array($currentPage, [
	"purok",
	"position",
	"precinct",
	"chairmanship",
	"users",
	"support",
	"requestdoc",
	"backup",
]);

function appendActiveClass(array $pages)
{
	return in_array($GLOBALS["currentPage"], $pages) ? "active" : null;
}
?>
<div class="sidebar sidebar-style-2">
  <div class="sidebar-wrapper scrollbar scrollbar-inner">
    <div class="sidebar-content">
      <div class="user">
        <div class="avatar-sm float-left mr-2">
          <?php if (!empty($_SESSION["avatar"])): ?>
          <img src="<?= imgSrc($_SESSION["avatar"]) ?>" alt="..." class="avatar-img rounded-circle">
          <?php else: ?>
          <img src="assets/img/person.png" alt="..." class="avatar-img rounded-circle">
          <?php endif; ?>

        </div>
        <div class="info">
          <a data-toggle="collapse" href="<?= role(["user", "administrator"])
          	? "#collapseExample"
          	: "javascript:void(0)" ?>" aria-expanded="true">
            <span>
              <?= isAuthenticated() ? ucfirst($_SESSION["username"]) : "Guest User" ?>

              <span class="user-level">
                <?= isAuthenticated() ? ucfirst($_SESSION["role"]) : "Guest" ?>
              </span>

              <?= isAdmin() ? '<span class="caret"></span>' : null ?>
            </span>
          </a>
          <div class="clearfix"></div>
          <div class="collapse in" id="collapseExample">
            <ul class="nav">
              <li>
                <a href="#edit_profile" data-toggle="modal">
                  <span class="link-collapse">Edit Profile</span>
                </a>
                <a href="#changepass" data-toggle="modal">
                  <span class="link-collapse">Change Password</span>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <ul class="nav nav-primary">
        <li class="
            nav-item
            <?= appendActiveClass(["dashboard", "resident_info", "purok_info"]) ?>
          ">
          <a href="dashboard.php">
            <i class="fas fa-home"></i>
            <p>Dashboard</p>
          </a>
        </li>

        <li class="nav-section">
          <span class="sidebar-mini-icon">
            <i class="fa fa-ellipsis-h"></i>
          </span>
          <h4 class="text-section">Menu</h4>
        </li>

        <?php if (role(["administrator", "staff"])): ?>
        <li class="
              nav-item
              <?= appendActiveClass(["officials"]) ?>
            ">
          <a href="officials.php">
            <i class="fas fa-user-tie"></i>
            <p>Brgy Officials and Staff</p>
          </a>
        </li>
        <?php endif; ?>

        <li class="
              nav-item
              <?= appendActiveClass(["certificate-requests"]) ?>
            ">
          <a href="certificate-requests.php">
            <i class="fas fa-user-tie"></i>
            <p>Certificate Requests</p>
          </a>
        </li>

        <?php if (role(["administrator", "staff"])): ?>
        <li class="
              nav-item
              <?= appendActiveClass(["resident", "generate_resident"]) ?>
            ">
          <a href="resident.php">
            <i class="icon-people"></i>
            <p>Resident Information</p>
          </a>
        </li>
        <?php endif; ?>

        <?php if (role(["administrator", "staff"])): ?>
        <li class="
              nav-item
              <?= appendActiveClass(["resident_certification", "generate_brgy_cert"]) ?>
            ">
          <a href="resident_certification.php">
            <i class="icon-badge"></i>
            <p>Barangay Certificates</p>
          </a>
        </li>
        <?php endif; ?>

        <?php if (isAdmin()): ?>
        <li class="
            nav-item
            <?= appendActiveClass(["resident_cuttingpermit", "generate_cuttingpermit"]) ?>
          ">
          <a href="resident_cuttingpermit.php">
            <i class="icon-docs"></i>
            <p>Cutting permit</p>
          </a>
        </li>
        <?php endif; ?>

        <?php if (isAdmin()): ?>
        <li class="
            nav-item
            <?= appendActiveClass(["4ps-residents", "generate_fpscert"]) ?>
          ">
          <a href="4ps-residents.php">
            <i class="icon-doc"></i>
            <p>4ps Certification</p>
          </a>
        </li>
        <?php endif; ?>

        <?php if (isAdmin()): ?>
        <li class="
            nav-item
            <?= appendActiveClass(["resident_indigency", "generate_indi_cert"]) ?>
          ">
          <a href="resident_indigency.php">
            <i class="icon-docs"></i>
            <p>Certificate of Indigency</p>
          </a>
        </li>
        <?php endif; ?>

        <?php if (isAdmin()): ?>
        <li class="
            nav-item
            <?= appendActiveClass(["business_permit", "generate_business_permit"]) ?>
          ">
          <a href="business_permit.php">
            <i class="icon-doc"></i>
            <p>Brgy Business Clearance</p>
          </a>
        </li>
        <?php endif; ?>

        <?php if (isAdmin()): ?>
        <li class="
            nav-item
            <?= appendActiveClass(["blotter", "generate_blotter_report"]) ?>
          ">
          <a href="blotter.php">
            <i class="icon-layers"></i>
            <p>Blotter Records</p>
          </a>
        </li>
        <?php endif; ?>

        <li class="
            nav-item
            <?= appendActiveClass(["announcements", "announcements-view"]) ?>
          ">
          <a href="announcements.php">
            <i class="icon-pin"></i>
            <p>Announcements</p>
          </a>
        </li>

        <?php if (role(["staff", "user"])): ?>
        <li class="nav-section">
          <span class="sidebar-mini-icon">
            <i class="fa fa-ellipsis-h"></i>
          </span>
          <h4 class="text-section">System</h4>
        </li>
        <li class="nav-item">
          <a href="#support" data-toggle="modal">
            <i class="fas fa-flag"></i>
            <p>Support</p>
          </a>
        </li>
        <?php if (isStaff()): ?>
          <li class="nav-item">
            <a href="#requestdoc" data-toggle="modal">
              <i class="fas fa-flag"></i>
              <p>Requested Documents</p>
            </a>
          </li>
        <?php endif; ?>
        <?php endif; ?>

        <?php if (isAdmin()): ?>
        <li class="
              nav-item
              <?= appendActiveClass(["revenue"]) ?>
            ">
          <a href="revenue.php">
            <i>₱</i>
            <p>Collection Payment</p>
          </a>
        </li>

        <li class="nav-section">
          <span class="sidebar-mini-icon">
            <i class="fa fa-ellipsis-h"></i>
          </span>
          <h4 class="text-section">System</h4>
        </li>

        <li class="nav-item <?= $isSettingsPage ? "active" : null ?>">
          <a href="#settings" data-toggle="collapse" class="collapsed" aria-expanded="false">
            <i class="icon-wrench"></i>
            <p>Settings</p>
            <span class="caret"></span>
          </a>

          <div class="collapse <?= $isSettingsPage ? "show" : null ?>" id="settings">
            <ul class="nav nav-collapse">
              <li>
                <a href="#barangay" data-toggle="modal">
                  <span class="sub-item">Barangay Info</span>
                </a>
              </li>
              <li class="<?= $currentPage == "purok" ? "active" : null ?>">
                <a href="purok.php">
                  <span class="sub-item">Purok</span>
                </a>
              </li>
              <li class="<?= $currentPage == "precinct" ? "active" : null ?>">
                <a href="precinct.php">
                  <span class="sub-item">Contact Number</span>
                </a>
              </li>
              <li class="<?= $currentPage == "position" ? "active" : null ?>">
                <a href="position.php">
                  <span class="sub-item">Positions</span>
                </a>
              </li>
              <li class="<?= $currentPage == "chairmanship" ? "active" : null ?>">
                <a href="chairmanship.php">
                  <span class="sub-item">Chairmanship</span>
                </a>
              </li>

              <?php if ($_SESSION["role"] == "staff"): ?>
              <li>
                <a href="#support" data-toggle="modal">
                  <span class="sub-item">Support</span>
                </a>
              </li>
              <li>
                <a href="#requestdoc" data-toggle="modal">
                  <span class="sub-item">Requested Documents</span>
                </a>
              </li>

              <?php else: ?>
              <li class="<?= $currentPage == "users" ? "active" : null ?>">
                <a href="users.php">
                  <span class="sub-item">Users</span>
                </a>
              </li>
              <li class="<?= $currentPage == "support" ? "active" : null ?>">
                <a href="support.php">
                  <span class="sub-item">Support</span>
                </a>
              </li>


              <li>
                <a href="backup/backup.php">
                  <span class="sub-item">Backup</span>
                </a>
              </li>
              <li>
                <a href="#restore" data-toggle="modal">
                  <span class="sub-item">Restore</span>
                </a>
              </li>

              <?php endif; ?>
            </ul>
          </div>
        </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="edit_profile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create System User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="model/edit_profile.php" enctype="multipart/form-data">
        <div class="modal-body">
          <input type="hidden" name="size" value="1000000">
          <div class="text-center">
            <div id="my_camera" style="height: 250;" class="text-center">
              <?php if (empty($_SESSION["avatar"])): ?>
              <img src="assets/img/person.png" alt="..." class="img img-fluid" width="250">
              <?php else: ?>
              <img src="<?= imgSrc(
              	$_SESSION["avatar"]
              ) ?>" alt="..." class="img img-fluid" width="250">
              <?php endif; ?>
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
          </div>
        </div>
        <div class="modal-footer">
          <input type="hidden" value="<?= $_SESSION["id"] ?>" name="id">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>
