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
                        <h4 class="mb-sm-0">Edit Brand</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <?php


include "assets/includes/db.php";

// $edit = $_GET['id'];


// echo $edit;

if (isset($_POST['edit_brand'])) {
    $brandName = mysqli_real_escape_string($conect,$_POST['brandName']);
    $brandPrice = mysqli_real_escape_string($conect,$_POST['brandPrice']);

    $brandImage = mysqli_real_escape_string($conect,$_FILES['brandImage']['name']);
    $imageFileType = pathinfo($brandImage,PATHINFO_EXTENSION);
    $targetimg="assets/uploads/";
     $imgrename = date('Ymd').rand(1,1000000).'.'.$imageFileType;
     $image1=move_uploaded_file($_FILES['brandImage']['tmp_name'],$targetimg.$imgrename);

     $edit = $_GET['id'];
     $update = mysqli_query($conect,"update tbl_brands set brand_name ='".$brandName."',
     brand_price='".$brandPrice."', brand_image = '".$brandImage."' where id ='".$edit."' and status=1");
     if($update == true){
        echo '<script>alert("Inserted Successfully")</script>';
          echo "<script>window.location.href=`manage-brands.php`;</script>" ;
     }

    else{
        echo '<script>alert("Failed to Insert")</script>mysql_error();'; 
        echo "<script>window.location.href='manage-brands.php';</script>" ;
    }
    }
?>
            <div class="row">
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <form class="custom-validation" action="#" method = "post" enctype="multipart/form-data">
                            <?php
@$edit = $_GET['id'];
$query = mysqli_query($conect,"select * from tbl_brands where id = '".$edit."'");
$fetch = mysqli_fetch_array($query);
            ?>
                                <div class="mb-3">
                                    <label>Name</label>
                                    <input type="text" name="brandName" class="form-control" required
                                    value="<?php echo $fetch['brand_name']; ?>"/>
                                </div>
                                <div class="mb-3">
                                    <label>Price</label>
                                    <input type="number" name="brandPrice" class="form-control" required
                                    value="<?php echo $fetch['brand_price']; ?>" />
                                </div>
                                <div class="mb-3">
                                    <label>Brand image</label>
                                    <div class="input-group">
                                        <img src="assets/uploads/<?php echo $fetch['brand_image']; ?>" alt="" height="60px" width="60px">
                                        <input type="file" name="brandImage" class="form-control" 
                                            id="customFile" value="<?php echo $fetch['brand_image']; ?>">
                                    </div>
                                </div>
                                <div class="mb-0">
                                    <div>
                                        <button type="submit" name="edit_brand" class="btn btn-primary waves-effect waves-light me-1">
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

