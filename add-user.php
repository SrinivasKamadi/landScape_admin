<?php
include "assets/includes/header.php";
include "assets/includes/sidebar.php";
include "assets/includes/db.php";
?>

<div class="main-content">

    <div class="page-content brand_page">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-center">
                        <h4 class="mb-sm-0">Add Details</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <?php

if (isset($_POST['submitBtn'])) {

    $user = mysqli_real_escape_string($conect,$_POST['User Id']);
    $Uname = mysqli_real_escape_string($conect,$_POST['User Name']);
    $pswd = mysqli_real_escape_string($conect, $_POST['Password']);
    $mail = mysqli_real_escape_string($conect, $_POST['Email']);
    $number = mysqli_real_escape_string($conect, $_POST['Mobile Number']);
    $profile = mysqli_real_escape_string($conect, $_POST['Profile']);
    $refer = mysqli_real_escape_string($conect, $_POST['Reffered By']);





    // ------------------- image insertion ----------------------------

// $img = $_FILES['brandImage']['name'];

// $upload_path = 'assets/uploads/';

// $moveFile = move_uploaded_file($_FILES['brandImage']['tmp_name'],$upload_path.$img);



  $insert = mysqli_query($conect,"insert into users set userAutoId='".$user."',userName='".$Uname."',password='".$pswd."',email='".$mail."',mobile='".$number."',profile='".$profile."',referred_by='".$refer."'");

if ($insert == true) {
  echo'<script>alert("submited succesfully")</script>';
}
else{
  echo'<script>alert("submit failed")</script>';
}
}
?>

            <div class="row">
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <form class="custom-validation" action="#" method = "post" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label>User Id</label>
                                    <input type="text" name="User Id" class="form-control" required
                                        placeholder="User Id" />
                                </div>
                                <div class="mb-3">
                                    <label>User Name</label>
                                    <input type="text" name="User Name" class="form-control" required
                                        placeholder="User Name" />
                                </div>
                                <div class="mb-3">
                                    <label>Password</label>
                                    <input type="password" name="Password" class="form-control" required
                                        placeholder="***" />
                                </div>
                                <div class="mb-3">
                                    <label>Email</label>
                                    <input type="text" name="Email" class="form-control" required
                                        placeholder="Enter Your Mail Here" />
                                </div>
                                <div class="mb-3">
                                    <label>Mobile Number</label>
                                    <input type="number" name="Mobile Number" class="form-control" required
                                        placeholder="Enter Your Valid Mobile Number" />
                                </div>
                                <div class="mb-3">
                                    <label>Profile</label>
                                    <input type="text" name="Profile" class="form-control" required
                                        placeholder="Your Profile" />
                                </div>
                                <div class="mb-3">
                                    <label>Referred By</label>
                                    <input type="number" name="Reffered By" class="form-control" required
                                        placeholder="Referred" />
                                </div>
                                <!-- <div class="mb-3">
                                    <label>Brand image</label>
                                    <div class="input-group">
                                        <input type="file" name="brandImage" class="form-control" required
                                            id="customFile">
                                    </div>
                                </div> -->
                                <div class="mb-0">
                                    <div>
                                        <button  name="submitBtn" class="btn btn-primary waves-effect waves-light me-1">
                                            Submit
                                        </button>
                                        <button type="reset" class="btn btn-secondary waves-effect">
                                            Cancel
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                       
                        </div>
                </div> <!-- end col -->
                <!-- end col -->
            </div> <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
</div>
<!-- end main content-->
</div>
<!-- END layout-wrapper -->


<?php
include "assets/includes/footer.php";
?>

