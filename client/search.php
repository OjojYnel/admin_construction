<?php

require 'config.php';
$x = $_GET['se'];

$sql = "SELECT equipName,equipDesc,manufacturers.manufacCompany,equipEngineNumber,equipInStock,equipPrice,categories.categoryName,equipStatus FROM equipments JOIN categories on equipments.categoryId = categories.categoryId JOIN manufacturers on equipments.manufacId = manufacturers.manufacId WHERE equipName LIKE '%" ."%'";
$res = $con->query($sql);

$r = $res->fetch_all();
echo json_encode($r);


