<?php

require 'config.php';
session_start();
$user = $_SESSION['ayd'];

$duration = $_POST['dura'];
$id = $_POST['ayd'];
$sql = "SELECT equipPrice FROM equipments WHERE equipId = '$id'";
$res = $con->query($sql);
$r = $res->fetch_row();
$pr = $r[0];


$da = date("Y-m-d");
$nda = Date("y-m-d", strtotime("+" .$duration ." days"));


$sql = "INSERT INTO rentals (userId, equipId, rental_date, return_date, duration) VALUES ('$user','$id','$da','$nda','$duration')";
if($con->query($sql)){
    $sql = "UPDATE equipments SET equipStatus = 'Rented' WHERE equipId = '$id' ";
    $con->query($sql);
    $m = "Success!";
    echo "<script type='text/javascript'>

            alert('$m');
            window.location.replace('index.php?catid=1');
        </script>";
}else{
    var_dump($con->error);

}