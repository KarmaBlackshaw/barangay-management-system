<?php include 'model/fetch_brgy_info.php' ?>

<div class="main-header">
    <!-- Logo Header -->
    <div class="logo-header" data-background-color="orange">
        
        <a href="dashboard.php" class="logo">
            <span class="text-light ml-2 fw-bold" style="font-size:20px">BSM SYSTEM</span>
        </a>
        <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
                <i class="icon-menu"></i>
            </span>
        </button>
        <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
        <div class="nav-toggle">
            <button class="btn btn-toggle toggle-sidebar">
                <i class="icon-menu"></i>
            </button>
        </div>
    </div>
    <!-- End Logo Header -->

    <!-- Navbar Header -->
    <nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">
        
        <div class="container-fluid">
            <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                <li class="nav-item dropdown hidden-caret">
                    <a class="nav-link dropdown-toggle" href="#" id="messageDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="icon-settings"></i>
                    </a>
                    <ul class="dropdown-menu messages-notif-box animated fadeIn" aria-labelledby="messageDropdown">
                        <li>
                            <?php if(isset($_SESSION['role'])):?>
                                <a class="see-all" href="model/logout.php">Sign Out<i class="icon-logout"></i> </a>
                            <?php else: ?>
                                <a class="see-all" href="login.php">Sign In<i class="icon-login"></i> </a>
                            <?php endif ?>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <!-- End Navbar -->
</div>