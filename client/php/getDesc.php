<?php
require '../config.php';
$a = $_GET['se'];
$sql = "SELECT equipDesc FROM equipments WHERE equipId = '$a'";
$res = $con->query($sql);
$r = $res->fetch_all();
echo json_encode($r);