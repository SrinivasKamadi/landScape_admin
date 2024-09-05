<?php
include "assets/includes/header.php";
include "assets/includes/sidebar.php";
include "assets/includes/db.php";
?>

<div class="main-content">
    <div class="page-content">
        <div class="container">
            <!-- start page title -->
            <div class="row">
                <div class="col- 12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Data</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body astro-scroll">

                            <h4 class="card-title">Manage Brands</h4>

                            <table id="myTable" class="table display table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr class="">
                                        <th>S.NO</th>
                                        <th>User Id</th>
                                        <th>User Number</th>
                                        <th>Email</th>
                                        <th>Mobile Number</th>
                                        <th>Referred By</th>
                                        <th>Status</th>
                                        <!-- <th>Action</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $getDetails = mysqli_query($conect, "SELECT * FROM users ");
                                    $i = 1;
                                    while ($fetch = mysqli_fetch_array($getDetails)) {
                                        $getReferral = mysqli_fetch_assoc(mysqli_query($conect, "SELECT userName as refferalName FROM users WHERE id='" . $fetch['referred_by'] . "'"))
                                    ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $fetch['userAutoId']; ?></td>
                                            <td><?php echo $fetch['userName']; ?></td>
                                            <td><?php echo $fetch['email']; ?></td>
                                            <td><?php echo $fetch['mobile']; ?></td>
                                            <?php
                                            if ($getReferral != null) {
                                            ?>
                                                <td><?php echo $getReferral['refferalName']; ?></td>
                                            <?php
                                            } else {
                                            ?>
                                                <td>No Refferal</td>
                                            <?php
                                            }
                                            if ($fetch['status'] == 1) {
                                            ?>
                                                <td><button class="btn btn-danger">Deactivate</button></td>
                                            <?php
                                            }
                                            if ($fetch['status'] == 0) {
                                            ?>
                                                <td><button class="btn btn-success">Activate</button></td>
                                            <?php
                                            }
                                            ?>
                                            <!-- <td><a href="edit-user.php? id=<?php echo $fetch['id'] ?>"><button><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                <a href="delete-user.php? id=<?php echo $fetch['id'] ?>"><button><i class="fa fa-trash" aria-hidden="true"></i></a>
                                            </td> -->
                                        </tr>
                                    <?php
                                        $i++;
                                    }
                                    ?>
                                </tbody>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>