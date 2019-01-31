<?php

require 'config.php';
session_start();

if(!isset($_SESSION['username'])){
    $m = "Login first!";
    echo "
            <script type = 'text/javascript'>
                alert('$m');
                window.location.replace('../login.php');
            </script>
         ";
}

$user = $_SESSION['ayd'];
$id = $_POST['ayd'];

$ratings = $_POST['rating'];
$feed = htmlspecialchars($_POST['feed']);


$sql = "INSERT INTO ratings(userId, equipId, ratingDesc,stars) VALUES ('$user','$id','$feed','$ratings')";
if($conn->query($sql)){
    $m = "Success!";
    echo "<script type='text/javascript'>

            alert('$m');
            window.location.replace('../index.php?catid=1');
        </script>";
}else{
    var_dump($conn->error);
    die();

}