<?php
require 'config.php';


if(!isset($_GET['ayd'])){
    $a = $_GET['s'];
    $sql = "SELECT equipId,equipName,equipPrice,fname,lname,color,equipDesc,equipStatus,TO_BASE64(equipimage) FROM equipments JOIN users on equipments.spid = users.userid  ORDER BY " .$a;
    $res = $conn->query($sql);

    $r = $res->fetch_all();
    echo json_encode($r);
}else{
    $a = $_GET['s'];
    $ab = $_GET['ayd'];
    $sql = "SELECT equipId,equipName,equipPrice,fname,lname,color,equipDesc,equipStatus,TO_BASE64(equipimage) FROM equipments JOIN users on equipments.spid = users.userid WHERE categoryId= '$ab' ORDER BY " .$a;
    $res = $conn->query($sql);

    $r = $res->fetch_all();
    echo json_encode($r);
}



