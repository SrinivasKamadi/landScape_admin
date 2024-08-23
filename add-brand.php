<?php
include "assets/includes/header.php";
include "assets/includes/sidebar.php";
?>

<div class="main-content">

    <div class="page-content brand_page">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-center">
                        <h4 class="mb-sm-0">Add Brand</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <?php
include "assets/includes/db.php";


if (isset($_POST['submitBtn'])) {

    $brandName = mysqli_real_escape_string($conect,$_POST['brandName']);
    $brandPrice = mysqli_real_escape_string($conect,$_POST['brandPrice']);

    // ------------------- image insertion ----------------------------

$img = $_FILES['brandImage']['name'];

$upload_path = 'assets/uploads/';

$moveFile = move_uploaded_file($_FILES['brandImage']['tmp_name'],$upload_path.$img);

// ============================= php-insertion with avoid duplicate-insertion ===========================

//     $sel = mysqli_query($conect,"select * from mm_employes where emp_email='".$email."'");
//     $c = mysqli_num_rows($sel);
//     if($c >= 1)
//     {
//       echo '<script>alert("employee already exists")</script>';
//     }
//     else
//     {
//         $insert=mysqli_query($conect,"insert into mm_employes set emp_name='".$fullname."',emp_email='".$email."',emp_mobile='".$mobile."',emp_img='".$img."',emp_dob='".$dob."',emp_gender='".$gender."',status=1");

//    if ($insert == true) {
//   echo'<script>alert("submited succesfully")</script>';
// }
// else{
//   echo'<script>alert("submit failed")</script>';
// }
//     }


// =============================== insert query =========================

  $insert=mysqli_query($conect,"insert into tbl_brands set brand_name='".$brandName."',brand_price='".$brandPrice."',brand_image='".$img."',status=1");

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
                                    <label>Name</label>
                                    <input type="text" name="brandName" class="form-control" required
                                        placeholder="Type something" />
                                </div>
                                <div class="mb-3">
                                    <label>Price</label>
                                    <input type="number" name="brandPrice" class="form-control" required
                                        placeholder="Type something" />
                                </div>
                                <div class="mb-3">
                                    <label>Brand image</label>
                                    <div class="input-group">
                                        <input type="file" name="brandImage" class="form-control" required
                                            id="customFile">
                                    </div>
                                </div>
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

