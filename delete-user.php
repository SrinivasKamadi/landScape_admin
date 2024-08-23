<?php
        include "assets/includes/db.php";
        $delete = $_GET['id'];
        echo $delete;

        $delete = mysqli_query($con, "update astrovedika_tbl set status=0 where astro_id='".$delete."'");
        if($delete == true){
            echo '<script>alert("Deleted Successfully")</script>';
            echo "<script>window.location.href='register-for-astrovedika.php';</script>";
        }
        else{
            echo '<script>alert("Failed")</script>';
            echo "<script>window.location.href='register-for-astrovedika.php';</script>";
        }
    
        ?>
