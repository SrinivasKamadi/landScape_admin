<?php
include "assets/includes/header.php";
include "assets/includes/sidebar.php";
include "assets/includes/db.php";

date_default_timezone_set('asia/kolkata');
$date = date("Y-m-d H:i:s");
if (isset($_POST['submit'])) {

    $referralCode = mysqli_real_escape_string($conect, $_POST['seniorCode']);
    $fullName = mysqli_real_escape_string($conect, $_POST['fullName']);
    $mobile = mysqli_real_escape_string($conect, $_POST['mobile']);
    $email = mysqli_real_escape_string($conect, $_POST['email']);
    $state = mysqli_real_escape_string($conect, $_POST['state']);
    $district = mysqli_real_escape_string($conect, $_POST['district']);
    $city = mysqli_real_escape_string($conect, $_POST['city']);
    $agentCode = mysqli_real_escape_string($conect, $_POST['agentCode']);
    $pswd = mysqli_real_escape_string($conect, $_POST['pswd']);
    $cnf_pswd = mysqli_real_escape_string($conect, $_POST['cnf_pswd']);
    $profileImg = mysqli_real_escape_string($conect, $_FILES['image']['name']);

    $imageFileType = pathinfo($profileImg, PATHINFO_EXTENSION);

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "JPG" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "<script>alert('only JPG, JPEG, PNG & GIF files are allowed.')</script>";
        echo "<script>window.location.href='register.php';</script>";
        exit();
    } else {
        $folderPath = 'assets/img/userImages/';
        $imgrename = date('Ymd') . rand(1, 1000000) . '.' . 'jpg';
        $image1 = move_uploaded_file($_FILES['image']['tmp_name'], $folderPath . $imgrename);
    }

    // ? to check email 
    $checkEmail = mysqli_query($conect, "SELECT * FROM users WHERE email='" . $email . "' AND status=1");

    if (mysqli_num_rows($checkEmail) > 0) {
        echo "<script>alert('Email Already Exists')</script>";
        echo "<script>window.location.href='add-user.php';</script>";
        exit();
    }

    if ($pswd != $cnf_pswd) {
        echo '<script>alert("Passwords Did not Match ")</script>';
        echo '<script>window.location.href="add-user.php"</script>';
        exit();
    }

    $getRefferalId = mysqli_fetch_assoc(mysqli_query($conect, 'SELECT * FROM users WHERE userAutoId="' . $referralCode . '"'));

    if ($getRefferalId != null) {
        $q = "INSERT INTO users SET userAutoId='" . $agentCode . "',userName='" . $fullName . "',password='" . $cnf_pswd . "',email='" . $email . "',mobile='" . $mobile . "',referred_by='" . $getRefferalId['id'] . "',profile='" . $imgrename . "',created_date='" . $date . "',status=1";

        $registerUser = mysqli_query($conect, $q);

        if ($registerUser) {
            echo '<script>alert("Registered successfully")</script>';
            echo '<script>window.location.href="add-user.php"</script>';
        } else {
            echo '<script>alert("Falied Please! Try Again")</script>';
        }
    } else {
        echo '<script>alert("Invalid Referral Code")</script>';
    }
}


?>

<div class="main-content">

    <div class="page-content brand_page">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-center">
                        <h4 class="mb-sm-0">Add User</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->


            <div class="row">
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <form class="custom-validation" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <input type="text" name="seniorCode" class="form-control" required
                                            placeholder="Senior Code" onchange="getSeniorName(this.value)" required />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <input type="text" name="senior_name" class="form-control" required
                                            placeholder="Senior Name" id="Scode" readonly />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <input type="text" name="fullName" onchange="generateAgentCode(this.value)" required class="form-control" required placeholder="Full Name" />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <input type="number" name="mobile" class="form-control" required placeholder="Mobile" />
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <input type="file" placeholder="Profile" name="image"
                                        class="form-control" required>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <input type="text" name="email" class="form-control" required placeholder="Email Id" />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <input type="text" name="state" class="form-control" required placeholder="State" />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <input type="text" name="district" class="form-control" required placeholder="District" />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <input type="text" name="city" class="form-control" required placeholder="City" />
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <input type="text" name="agentCode" id="Acode" class="form-control" required
                                        placeholder="Agent Code" readonly />
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <input type="text" name="pswd" class="form-control" required
                                            placeholder="Password" />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <input type="text" name="cnf_pswd" class="form-control" required placeholder="Confirm Password" />
                                    </div>
                                </div>
                                <div class="mb-0">
                                    <div>
                                        <input type="checkbox"> I Agree With the terms and conditions <br>
                                        <button name="submit" class="btn btn-primary waves-effect mt-3">
                                            Add
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
</div>
<!-- end main content-->
</div>
<!-- END layout-wrapper -->

<script>
    // ? to get referral name 
    function getSeniorName(id) {
        $.ajax({
            type: 'POST',
            url: 'ajax.php',
            data: {
                referralCode: id
            },
            success: function(data) {
                document.getElementById('Scode').value = data;
            }
        })
    }

    // ? to generate agentcode for user
    function generateAgentCode(name) {
        $.ajax({
            type: 'POST',
            url: 'ajax.php',
            data: {
                name: name
            },
            success: function(data) {
                let namesplit = name.split(' ');
                let agentCode = 'LS' + namesplit[0].toUpperCase() + data;
                document.getElementById('Acode').value = agentCode;
            }
        })
    }

    // ? password view and hide 
    document.addEventListener('DOMContentLoaded', function() {
        const eyeIcon = document.querySelector('.eye-icon');
        const passwordInput = document.querySelector('#password-input');
        eyeIcon.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.classList.toggle('hide-password');
        });
    });
</script>

<?php
include "assets/includes/footer.php";
?>