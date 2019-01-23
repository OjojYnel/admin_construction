<?php

require 'config.php';
$x = $_GET['se'];



$sql = "SELECT equipName,equipPrice,equipDesc,equipEngineNumber,equipStatus,equipId FROM equipments WHERE equipName LIKE '%". $x . "%'";
$res = $con->query($sql);

$r = $res->fetch_all();
echo json_encode($r);

