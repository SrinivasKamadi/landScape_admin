<?php
include "includes/header.php";
include "includes/sidebar.php";
include "includes/navbar.php";
include "includes/footer.php";
include "includes/db.php";
if (isset($_POST['blog_btn'])) {
      $blo_name = mysqli_real_escape_string($con,$_POST['blog_name']);
      $blo_img = mysqli_real_escape_string($con,$_FILES['blog_img']['name']);
      $blo_des = mysqli_real_escape_string($con,$_POST['blog_des']);
      $imageFileType = pathinfo($blo_img,PATHINFO_EXTENSION);
      $targetimg="uploads/blog";
       $imgrename = date('Ymd').rand(1,1000000).'.'.$imageFileType;
       $image1=move_uploaded_file($_FILES['blog_img']['tmp_name'],$targetimg.$imgrename);
       $update = mysqli_query($con,"update blog_tbl set blog_name ='".$blo_name."',
       blog_img='".$imgrename."',blog_des='".$blo_des."' where blog_id ='". $_GET['id']."' and status=1");
       if($update){
          echo '<script>alert("Inserted Successfully")</script>';
            echo "<script>window.location.href='blog.php';</script>" ;
       }
      else{
          echo '<script>alert("Failed to Insert")</script>';
          echo "<script>window.location.href='blog.php';</script>" ;
      }
      }
   ?>
<body data-col="2-columns" class="2-columns">
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <div class="wrapper">
        <?php include "includes/sidebar.php"; ?>
        <?php include "includes/navbar.php"; ?>
        <div class="main-panel">
            <div class="main-content">
                <div class="content-wrapper">
                    <div class="container-fluid">
                        <!--Statistics cards Starts-->
                        <div class="row">
                        </div>
                        <section id="icon-tabs">
                            <div class="row justify-content-center">
                                <div class="col-6">
                                    <div class="card">
                                        <div class="card-header test-det">
                                            <div class="card-title-wrap bar-danger">
                                                <h4 class="card-title create" id="basic-layout-form">
                                                   Edit Blog
                                                </h4>
                                            </div>
                                        </div>
                                        <?php
$blog = mysqli_query($con, "select * from blog_tbl where blog_id ='".$_GET['id']."'");
$fetch_blog_details= mysqli_fetch_array($blog);
                        ?>
                                        <div class="card-body">
                                            <div class="card-block">
                                                <div class="icons-tab-steps wizard-circle">
                                                    <!-- Step 1 -->
                                                    <fieldset>
                                                        <form id="step-1-data" method="POST"
                                                            enctype="multipart/form-data">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="firstName2">Blog Name</label>
                                                                        <input type="text" class="form-control"
                                                                            id="firstName2" name="blog_name" value="<?php echo $fetch_blog_details['blog_name']; ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="lastName2">Blog Image</label>
                                                                        <input type="file" class="form-control"
                                                                            id="firstName2" name="blog_img" value="value=<?php echo $fetch_blog_details['blog_img']; ?>">
                                                                        <!-- <input type="file" class="form-control"
                                                                            id="lastName2" name="file"> -->
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="lastName2">Blog Description</label>
                                                                            <textarea id="" rows="4"
                                                                            class="form-control"
                                                                            placeholder="Description"
                                                                            name="blog_des" value="<?php echo $fetch_blog_details['blog_des']; ?>"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                </div>
                                                            </div>
                                                            <div class="row justify-content-center">
                                                                <button class="btn btn-makersmind text-white"
                                                                    id="personal-submit" type="submit"
                                                                    name="blog_btn">Submit
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                  </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php
include "includes/footer.php";
?>