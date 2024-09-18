<?php
include "assets/includes/header.php";
include "assets/includes/sidebar.php";
include "assets/includes/db.php";

date_default_timezone_set('asia/kolkata');
$date = date("Y-m-d H:i:s");
if (isset($_POST['submit'])) {

    $referralCode = mysqli_real_escape_string($connect, $_POST['seniorCode']);
    $fullName = mysqli_real_escape_string($connect, $_POST['fullName']);
    $mobile = mysqli_real_escape_string($connect, $_POST['mobile']);
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $state = mysqli_real_escape_string($connect, $_POST['state']);
    $district = mysqli_real_escape_string($connect, $_POST['district']);
    $city = mysqli_real_escape_string($connect, $_POST['city']);
    $agentCode = mysqli_real_escape_string($connect, $_POST['agentCode']);
    $pswd = mysqli_real_escape_string($connect, $_POST['pswd']);
    $cnf_pswd = mysqli_real_escape_string($connect, $_POST['cnf_pswd']);
    $profileImg = mysqli_real_escape_string($connect, $_FILES['image']['name']);

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
    $checkEmail = mysqli_query($connect, "SELECT * FROM users WHERE email='" . $email . "' AND status=1");

    if (mysqli_num_rows($checkEmail) > 0) {
        echo "<script>alert('Email Already Exists')</script>";
        echo "<script>window.location.href='register.php';</script>";
        exit();
    }

    if ($pswd != $cnf_pswd) {
        echo '<script>alert("Passwords Did not Match ")</script>';
        echo '<script>window.location.href="register.php"</script>';
        exit();
    }

    $getRefferalId = mysqli_fetch_assoc(mysqli_query($connect, 'SELECT * FROM users WHERE userAutoId="' . $referralCode . '"'));

    if ($getRefferalId != null) {
        $q = "INSERT INTO users SET userAutoId='" . $agentCode . "',userName='" . $fullName . "',password='" . $cnf_pswd . "',email='" . $email . "',mobile='" . $mobile . "',referred_by='" . $getRefferalId['id'] . "',profile='" . $imgrename . "',created_date='" . $date . "',status=1";

        $registerUser = mysqli_query($connect, $q);

        if ($registerUser) {
            echo '<script>alert("Registered successfully")</script>';
            echo '<script>window.location.href="index.php"</script>';
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
                                <div class="mb-3">
                                    <!-- <label>Senoir Code</label> -->
                                    <input type="text" name="seniorCode" class="form-control" required
                                        placeholder="Senior Code" onchange="getSeniorName(this.value)" required />
                                </div>
                                <div class="mb-3">
                                    <!-- <label>Senoir Name</label> -->
                                    <input type="text" name="senior_name" class="form-control" required
                                        placeholder="Senior Name" />
                                </div>
                                <div class=S_1>
                                    <div class="mb-3">
                                        <!-- <label>Full Name</label> -->
                                        <input type="text" name="fullName" onchange="generateAgentCode(this.value)" required class="form-control" required
                                            placeholder="Full Name" />
                                    </div>
                                    <div class="mb-3">
                                        <!-- <label>Mobile Number</label> -->
                                        <input type="number" name="mobile" class="form-control" required
                                            placeholder="Mobile" />
                                    </div>
                                </div>
                                <div class=s_2>
                                <div class="mb-3">
                                    <!-- <label>Email</label> -->
                                    <input type="text" name="email" class="form-control" required
                                        placeholder="Email Id" />
                                </div>
                                <div class="mb-3">
                                    <!-- <label>Password</label> -->
                                    <input type="text" name="state" class="form-control" required
                                        placeholder="State" />
                                </div>
                                </div>
                                <div class="s_3">
                                    <div class="mb-3">
                                        <!-- <label>Profile</label> -->
                                        <input type="text" name="district" class="form-control" required
                                            placeholder="District" />
                                    </div>
                                    <div class="mb-3">
                                        <!-- <label>Referred By</label> -->
                                        <input type="number" name="city" class="form-control" required
                                            placeholder="City" />
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <input type="text" name="agentCode" class="form-control" required
                                    placeholder="Agent Code" />
                                </div>
                                <div class="s_4">
                                    <div class="mb-3">
                                        <input type="text" name="pswd" class="form-control" required
                                            placeholder="Password" />
                                    </div>
                                    <div class="mb-3">
                                       
                                        <input type="number" name="cnf_pswd" class="form-control" required
                                            placeholder="Confirm Password" />
                                    </div>
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
                                      <input type="checkbox"> I Agree With the terms and conditions <br>
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