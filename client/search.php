<?php

require 'config.php';
$x = $_GET['se'];



$sql = "SELECT equipId,equipName,equipPrice,equipDesc,equipStatus FROM equipments WHERE equipName LIKE '%". $x . "%' AND equipStatus = 'Available'";
$res = $con->query($sql);

$r = $res->fetch_all();
echo json_encode($r);

