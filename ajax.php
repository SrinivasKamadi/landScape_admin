<?php

include './assets/includes/db.php';
if (isset($_POST['referralCode'])) {
    $code = $_POST['referralCode'];

    $getUser = "SELECT userName FROM users WHERE userAutoId='" . $code . "'";

    $data = mysqli_fetch_assoc(mysqli_query($connect, $getUser));

    if ($data != null) {
        echo $data['userName'];
    }
}

if (isset($_POST['name'])) {
    $getMax = mysqli_fetch_assoc(mysqli_query($connect, "SELECT MAX(id) as max FROM users"));

    echo $getMax['max'];
}


