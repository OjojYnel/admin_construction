<?php

require 'config.php';
session_start();
$user = $_POST['username'];
$pass = $_POST['password'];

$sql = "SELECT fname,lname,password,user_type,account_status,userid FROM users WHERE username = ?";


$ayp = gethostbyname($_SERVER['SERVER_NAME']);


$st = $conn->prepare($sql);
$st->bind_param('s', $user);
$st->execute();
$res = $st->get_result();
$r = $res->fetch_row();

if (password_verify($pass, $r[2]) && $r[4] != 'pending') {


    if ($res->num_rows > 0 && $r[4] == 'Active') {

        if ($r[3] == "Super_Admin") {
            $_SESSION['full'] = strtoupper($r[0] . " " . $r[1]);
            $_SESSION['userType'] = $r[3];
            $_SESSION['ayd'] = $r[5];
            $_SESSION['ty'] = $r[3];
            header('Location://localhost:8080/admin/admin/dashboard.jsp?ayd=' . $_SESSION['ayd']);
        } elseif ($r[3] == "Client") {
            $_SESSION['username'] = $user;
            $_SESSION['ayd'] = $r[5];
            $_SESSION['ty'] = $r[3];
            header('Location:../index.php');
        } elseif ($r[3] == "Admin") {
            $_SESSION['full'] = strtoupper($r[0] . " " . $r[1]);
            $_SESSION['userType'] = $r[3];
            $_SESSION['ayd'] = $r[5];
            $_SESSION['ty'] = $r[3];
            header('Location://localhost:8080/admin/sp/index.jsp?ayd=' . $_SESSION['ayd']);
        } else {
            $m = "Error login, Unknown user type! Contact Administrator";
            echo "
            <script type = 'text/javascript'>
                alert('$m');
                window.location.replace(login.php);
            </script>
         ";
        }
    }elseif ($res->num_rows > 0 && $r[4] == 'Pending'){
        $m = "Account is Pending! Please contact administrator";
        echo "
            <script type = 'text/javascript'>
                alert('$m');
                window.location.replace('../login.php');
            </script>
         ";
    }else {
        $m = "Account is Disabled! Please contact administrator";
        echo "
            <script type = 'text/javascript'>
                alert('$m');
                window.location.replace('../login.php');
            </script>
         ";

    }
} elseif (password_verify($pass, $r[2]) && $r[4] == 'pending'){
    $m = "Account is Inactive, please contact Administrator";
    echo "
            <script type = 'text/javascript'>
                alert('$m');
                window.location.replace('../login.php');
            </script>
         ";
}else {
    $m = "Wrong Credentials!";
    echo "
            <script type = 'text/javascript'>
                alert('$m');
                window.location.replace('../login.php');
            </script>
         ";
}


// Function to get the client IP address
function get_client_ip()
{
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if (getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if (getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if (getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if (getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if (getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}


