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
    $user = $_SESSION['ayd'];
    $ti = $_POST['ti'];
    $id = $_POST['ayd'];
    $d = $_POST['dura'];

    $sql = "SELECT equipPrice FROM equipments WHERE equipId = '$id'";
    $res = $con->query($sql);
    $r = $res->fetch_row();
    $pr = $r[0];


    $dr = $_POST['dr'];
    $da = date("Y-m-d");
//    $nda = Date("y-m-d", strtotime($dr ." +" .$duration ." days"));
//
//    $da2 = date("h:i:a",strtotime($ti));
//
//    $h = Date("h-i-a", strtotime($ti ." +" .$eti ." hours"));
//
//    $new = $nda . " : " .$h;

    $sql = "SELECT equipPrice FROM equipments WHERE equipId = $id";
    $aw = $con->query($sql);
    $aw2 = $aw->fetch_row();
    $az = $aw2[0];

    $tp = $d * $az;

    $sql = "INSERT INTO rentals (userId, equipId, rental_date,rental_date_time,duration,totalPrice) VALUES ('$user','$id','$dr','$ti','$d','$tp')";
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

