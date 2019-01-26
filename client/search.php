<?php

require 'config.php';
$x = $_GET['se'];



$sql = "SELECT equipId,equipName,equipPrice,equipDesc FROM equipments WHERE equipName LIKE '%". $x . "%'";
$res = $con->query($sql);

$r = $res->fetch_all();
echo json_encode($r);

