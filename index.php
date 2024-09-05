<?php
include "assets/includes/header.php";
include "assets/includes/sidebar.php";
include "assets/includes/db.php";


$totalR_Users = mysqli_fetch_assoc(mysqli_query($conect, "SELECT COUNT(*) as registeredUsers FROM users"));

$Active_users = mysqli_fetch_assoc(mysqli_query($conect, "SELECT COUNT(*) as activeUsers FROM users WHERE status=1"));

$inactive_users = mysqli_fetch_assoc(mysqli_query($conect, "SELECT COUNT(*) as inactiveUsers FROM users WHERE status=0"));

?>

<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Dashboard</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">landScape</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-sm-6 col-lg-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <h4 class="card-title text-muted">Total Register Users</h4>
                            <h2 class="mt-3 mb-2"><b><?php echo $totalR_Users['registeredUsers'] ?></b>
                            </h2>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-4">
                    <div class="card text-center">
                        <div class="card-body p-t-10">
                            <h4 class="card-title text-muted mb-0">Total Active Users</h4>
                            <h2 class="mt-3 mb-2"><b><?php echo $Active_users['activeUsers'] ?></b></h2>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-4">
                    <div class="card text-center">
                        <div class="card-body p-t-10">
                            <h4 class="card-title text-muted mb-0">Total Inactive Users</h4>
                            <h2 class="mt-3 mb-2"><b><?php echo $inactive_users['inactiveUsers'] ?></b></h2>
                        </div>
                    </div>
                </div>

            </div>
            <!-- end row -->
        </div>

    </div>
    <!-- End Page-content -->

    <?php
    include "assets/includes/footer.php";
    ?>