<?php 
include 'config.php';
session_start(); 

if (!isset($_SESSION['username'])) {
 $_SESSION['msg'] = "You must log in first";
 header('location: login.php');
}
?>
<?php
include 'change_password_action.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Client-Change Password</title>

  
</head>

<body id="page-top">

 

  
        <!-- Icon Cards-->
        <div class="row">

         <div class="card-body card-block">
          <form action="" method="post">
            <?php include('errors.php'); ?>

            <div class="form-group">
              <label for="nf-password" class=" form-control-label">New Password</label>
              <input type="password" name="newpassword" placeholder="Enter New Password.." class="form-control">
            </div>
            <div class="form-group">
              <label for="nf-password" class=" form-control-label">Confirm New Password</label>
              <input type="password"  name="confirmpassword" placeholder="Enter New Password.." class="form-control">
            </div>
            <button type="submit" name="change_pass" class="btn btn-primary btn-sm">
              <i class="fa fa-dot-circle-o"></i> Submit
            </button>
          </div>
        </div>
      </form>
      <div class="section__content section__content--p30">
        <?php if (isset($_SESSION['success'])) : ?>
          <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
           <h4>
            <?php 
            echo $_SESSION['success']; 
            unset($_SESSION['success']);
            ?>
          </h4>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
      <?php endif ?>
    </div>

  </div>
  <!-- /.container-fluid -->



</body>

</html>
