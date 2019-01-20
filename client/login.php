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

</head>
<?php

if (isset($_POST['login_user'])) {
  @$username = mysqli_real_escape_string($con, $_POST['username']);
  @$password = mysqli_real_escape_string($con, $_POST['password']);
  
  if (empty($username)) {
    array_push($errors, "Username is required");
  }
  if (empty($password)) {
    array_push($errors, "Password is required");
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

  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Login</div>
      <div class="card-body">
        <?php include('errors.php'); ?>
        <form action="" method="POST">
          <div class="form-group">
            <div class="form-label-group">
              <input type="text" id="inputUsername" class="form-control" placeholder="Username" required="required" autofocus="autofocus" name="username">
              <label for="inputUsername">Username</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" id="inputPassword" class="form-control" placeholder="Password" required="required" name="password">
              <label for="inputPassword">Password</label>
            </div>
          </div>
          <button class="btn btn-primary btn-block" name="login_user" value="Login">Login</button>
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="registration.php">Register an Account</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="bootstrap/vendor/jquery/jquery.min.js"></script>
  <script src="bootstrap/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="bootstrap/vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>
