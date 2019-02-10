<?php

require 'config.php';
session_start();
$user = $_SESSION['ayd'];

$id = $_POST['rentID'];
$sql = "UPDATE equipments SET equipStatus = 'Available' WHERE equipId = '$id' ";
if($con->query($sql)){
    $sql = "UPDATE rentals SET status = 'Canceled' WHERE equipId = '$id' ";
    $con->query($sql);

    $m = "Canceled!";
    echo "<script type='text/javascript'>

            alert('$m');
            window.location.replace('transactions.php');
        </script>";
}else{
    var_dump($con->error);

}