<?php
        include "assets/includes/db.php";
        $delete = $_GET['id'];
        echo $delete;

        $delete = mysqli_query($conect, "update tbl_brands set status=0 where id='".$delete."'");
        if($delete == true){
            echo '<script>alert("Deleted Successfully")</script>';
            echo "<script>window.location.href='manage-brands.php';</script>";
        }
        else{
            echo '<script>alert("Failed")</script>';
            echo "<script>window.location.href='manage-brands.php';</script>";
        }
    
        ?>
