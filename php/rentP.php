<?php
require 'config.php';
$a = $_GET['ayd'];
$sql = "SELECT equipPrice FROM equipments where equipId = '$a'";
$res = $con->query($sql);
$r = $res->fetch_all();
echo json_encode($r);