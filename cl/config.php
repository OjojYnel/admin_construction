<?php
$con=mysqli_connect ("localhost", "root", "","construction");
if($con === false){
	die("ERROR: Could not connect. " . mysqli_connect_error());
}if(!$con){
	echo 'Not Connected to Server';
}
?>