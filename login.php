<?php
session_start();
include "./assets/includes/db.php";


if (isset($_POST['submit'])) {

    $username = mysqli_real_escape_string($conect, $_POST['Email']);
    $password = mysqli_real_escape_string($conect, $_POST['pass']);

    $query = 'SELECT * FROM  `login` WHERE email ="' . $username . '" && status=1';
    $count = mysqli_num_rows(mysqli_query($conect, $query));
    $fetch = mysqli_fetch_assoc(mysqli_query($conect, $query));

    if ($count == 1) {
        if (password_verify($password, $fetch['password'])) {
            $fetch = mysqli_fetch_assoc(mysqli_query($conect, $query));
            $_SESSION['loginId'] = $fetch['id'];
            echo "<script>alert('Login Successfully')</script>";
            echo "<script>window.location.href='index.php';</script>";
        } else {
            echo "<script>alert('Invalid Password')</script>";
            echo "<script>window.location.href='login.php';</script>";
        }
    } else {
        echo "<script>alert('Login failed')</script>";
        echo "<script>window.location.href='login.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./assets/css/styles1.css">
    <!-- favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/logo/l.png">

    <script src="https://kit.fontawesome.com/b6c3ee2003.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="user-sign-in">
        <div class="container">
            <div class="navbar-header">
                <img src="assets/images/logo-h.png" class="light-logo1" alt="homepage" /></a>
            </div>
            <form method="POST" enctype="multipart/form-data">
                <div class="log">
                    <div class="Login">
                        <input type="email" name="Email" id="userName" placeholder="Email" spellcheck="false" required>
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <div class="password">
                        <input id="pas" onchange="pass()" type="password" id="passWord" placeholder="Password"
                            spellcheck="false" required name="pass">
                        <i onclick="unlocker()" id="lock" class="fa-solid fa-lock"></i>
                        <i onclick="locker()" id="unlock" class="fa-solid fa-lock-open"></i>
                    </div>
                    <div class="user-log-in" id="login">
                        <button type="submit" name="submit">
                            <h3>Log In</h3>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="assets/api/login.js"></script>
    <script src="assets/js/login.js"></script>
    <script src="utilles/constants.js"></script>
    <script src="utilles/formValidations.js"></script>

</body>

</html>