<?php
require 'config.php';
session_start();
$t = $_SESSION['ty'];

$first = $_POST['fname'];
$last = $_POST['lname'];
$eml = $_POST['eml'];
$num = $_POST['num'];
$username = $_POST['username'];
$pass = $_POST['pass'];
$pass2 = $_POST['pass2'];
$ty = $_POST['ty'];
$st = 'Pending';

if(!empty($t)){
    $st = 'Active';
}

if ($pass == $pass2) {
    $p = password_hash($pass, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users(username, fname, lname, contactnum, email, password, user_type, account_status) VALUE ('$username','$first','$last','$num','$eml','$p','$ty','$st')";


    if ($conn->query($sql)) {
        if (empty($t)) {
            $m = "Success! Waiting for approval.";
            echo "<script type='text/javascript'>
            alert('$m');
            window.location.replace('../login.php');
            </script>";
        }else{
            $m = "Success! .";
            echo "<script type='text/javascript'>
            alert('$m');
            window.location.replace('http://localhost:8080/admin/admin/users.jsp');
            </script>";
        }
    } else {
        var_dump($conn->error);
    }
} else {
    $m = "Error! Password dont match!";
    echo "<script type='text/javascript'>
            alert('$m');
            window.location.replace('../login.php#toregister');
        </script>";
}
