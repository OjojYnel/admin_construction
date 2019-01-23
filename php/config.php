<?php
$conn=mysqli_connect ("localhost", "root", "","construction");
if($conn === false){
	die("ERROR: Could not connect. " . mysqli_connect_error());
}if(!$conn){
	echo 'Not Connected to Server';
}
?>