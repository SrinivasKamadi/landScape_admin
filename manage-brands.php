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
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Manage Brands</h4>

                    <!-- <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                            <li class="breadcrumb-item active">Registration For Astrovedika</li>
                        </ol>
                    </div> -->

                </div>
            </div>
        </div>
        <!-- end page title -->

                          <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body astro-scroll">
        
                                        <h4 class="card-title">Manage Brands</h4>
        
                                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                               <tr class="">
                                                    <th>S.NO</th>
                                                    <th>Brand Image</th>
                                                    <th>Brand Name</th>
                                                    <th>Brand Price</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                   $fetch=mysqli_query($conect,"select * from users where status=1");
                                                   $row=1;
    while ($result=mysqli_fetch_array($fetch)) {
    ?>
                                                <tr class="manage_table">
                                                <td><?php echo $row?></td>
                                                <td><img width="100" height="100" src='assets/uploads/<?php echo $result['brand_image']; ?>' /></td>
                                                <td><?php echo $result['brand_name'];?></td>
                                                <td><?php echo $result['brand_price'];?></td>
                                                <td>
                                                <a href="edit-brand.php?id=<?php echo $result['id'];?>">
                                                <button class="astro-delete astro-edit">Edit</button>
                                                </a>
                                                <a href="delete-brand.php?id=<?php echo $result['id'];?>">
                                                <button class="astro-delete">Delete</button>
                                                </a>
                                                </td>
                                                </tr>

                                                <?php
                                                    $row++;
    }
                                                    ?>
                                            </tbody>
                                        </table>
        
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->
        
<?php
include "assets/includes/footer.php";
?>