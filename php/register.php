<?php
require 'config.php';
$first = $_POST['fname'];
$last = $_POST['lname'];
$eml = $_POST['eml'];
$num = $_POST['num'];
$username = $_POST['username'];
$pass = $_POST['pass'];
$pass2 = $_POST['pass2'];

if ($pass == $pass2) {
    $p = password_hash($pass, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users(username, fname, lname, contactnum, email, password, user_type, account_status) VALUE ('$username','$first','$last','$num','$eml','$p','Client','pending')";
    if ($conn->query($sql)) {
        $m = "Success! Waiting for approval.";
        echo "<script type='text/javascript'>
            alert('$m');
            window.location.replace('../index.php');
        </script>";
    } else {
        var_dump($conn->error);
    }
} else {
    $m = "Error! Password dont match!";
    echo "<script type='text/javascript'>
            alert('$m');
            window.location.replace('../index.php#toregister');
        </script>";
}
