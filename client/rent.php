<?php

require 'config.php';
session_start();
if(!isset($_SESSION['username'])){
    $m = "Please login first!!";
    echo "<script type='text/javascript'>

            alert('$m');
            window.location.replace('../login.php');
        </script>";
}else{
    $rid = $_POST['ayd'];
    $dura = $_POST['dura'];
    $total = $_POST['ayd2'];

    echo $rid;
    echo $dura;
    echo $total;

    $sql = "UPDATE rentals SET duration='$dura',totalPrice='$total' WHERE rentalid = '$rid'";
    if($con->query($sql)){
        $m = "Success!";
        echo "<script type='text/javascript'>

            alert('$m');
            window.location.replace('../index.php?catid=1');
        </script>";
    }else{
        var_dump($con->error);

    }
}

