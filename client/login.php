<?php
session_start();
require_once('config.php');
?>
<?php
include 'register_action.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Client Login Page</title>

  <!-- Bootstrap core CSS-->
  <link href="bootstrap/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template-->
  <link href="bootstrap/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="bootstrap/css/sb-admin.css" rel="stylesheet">



 <!-- Fontfaces CSS-->
 <link href="stylez/css/font-face.css" rel="stylesheet" media="all">
    <link href="stylez/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="stylez/vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="stylez/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="stylez/vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="stylez/vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="stylez/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="stylez/vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="stylez/vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="stylez/vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="stylez/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="stylez/vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="stylez/css/theme.css" rel="stylesheet" media="all">



</head>
<?php

if (isset($_POST['login_user'])) {
  @$username = mysqli_real_escape_string($con, $_POST['username']);
  @$email = mysqli_real_escape_string($con, $_POST['username']);
  @$password = mysqli_real_escape_string($con, $_POST['password']);
  
  if (empty($username)) {
    array_push($errors, "Username is required");
  }
  if (empty($password)) {
    array_push($errors, "Password is required");
  }

  if (empty($email)) {
    array_push($errors, "Email is required");
  }
  
  if (count($errors) == 0) {
    $password = md5($password);
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password' AND user_type='Client'";
    $results = mysqli_query($con, $query);
    $row = mysqli_fetch_array($results);
    if (mysqli_num_rows($results) == 1) {
      if($row['account_status'] == 'Active'){
          $_SESSION['username'] = $username;
          $_SESSION['ayd'] = $row['userid'];
          $_SESSION['success'] = "You are now logged in";
          header('location: index.php?catid=1');
      }else{
          $m = "Please Contact Admin for activation!";
          echo "<script type='text/javascript'>

            alert('$m');
            window.location.replace('login.php');
        </script>";
      }

    }else {
      array_push($errors, "Wrong username/password combination");
    }
  }
}


?>


<body class="bg-dark">
<div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                          <a href="#">
                                <img src="images/icon/logo.png" alt="CoolAdmin">
                            </a>
                            
        <?php include('errors.php'); ?>
        <form action="" method="POST">
         
         <br>
            <div class="form-group">
              <input type="text" id="inputUsername" class="form-control" placeholder="Username" required="required" autofocus="autofocus" name="username">
             
            </div>


            <div class="form-group">
              <input type="text" id="inputEmail" class="form-control" placeholder="Email" required="required" autofocus="autofocus" name="email">
             
            </div>
          
          <div class="form-group">
   
              <input type="password" id="inputPassword" class="form-control" placeholder="Password" required="required" name="password">
 
            </div>
        
          <button class="btn btn-primary btn-block" name="login_user" value="Login">Login</button>
      

        <div class="register-link">
                                <p>
                                    Don't have an account?
                                    <a href="registration.php">Register Here</a>
                                </p>
                                </form>
      </div>
    </div>


  <!-- Bootstrap core JavaScript-->
  <script src="bootstrap/vendor/jquery/jquery.min.js"></script>
  <script src="bootstrap/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="bootstrap/vendor/jquery-easing/jquery.easing.min.js"></script>

  
    <!-- Jquery JS-->
    <script src="stylez/vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="stylez/vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="stylez/vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="stylez/vendor/slick/slick.min.js">
    </script>
    <script src="stylez/vendor/wow/wow.min.js"></script>
    <script src="stylez/vendor/animsition/animsition.min.js"></script>
    <script src="stylez/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="stylez/vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="stylez/vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="stylez/vendor/circle-progress/circle-progress.min.js"></script>
    <script src="stylez/vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="stylez/vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="stylez/vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="stylez/js/main.js"></script>

</body>

</html>
