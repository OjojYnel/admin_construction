<?php

require 'config.php';
session_start();
$user = $_SESSION['ayd'];
$id = $_POST['ayd'];

$ratings = $_POST['rating'];
$feed = htmlspecialchars($_POST['feed']);


$sql = "INSERT INTO ratings(userId, equipId, ratingDesc,stars) VALUES ('$user','$id','$feed','$ratings')";
if($con->query($sql)){
    $m = "Success!";
    echo "<script type='text/javascript'>

            alert('$m');
            window.location.replace('ratings.php?catid=1');
        </script>";
}else{
    var_dump($con->error);
    die();

}