<?php
require 'config.php';
$a = $_GET['ayd'];
$sql = "SELECT * FROM ratings WHERE equipId = '$a'";
$res = $con->query($sql);
$r = $res->fetch_all();
echo json_encode($r);