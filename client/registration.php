<?php
include 'config.php';
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

  <title>Registration Page</title>

  <!-- Bootstrap core CSS-->
  <link href="stylez1/bootstrap/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template-->
  <link href="stylez1/bootstrap/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="stylez1/bootstrap/css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Register an Account</div>
      <div class="card-body">
        <form action="" method="POST">
          <?php include('errors.php'); ?>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" name="fname" id="firstName" class="form-control" placeholder="First name" required="required" autofocus="autofocus">
                  <label for="firstName">First name</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" name="lname" id="lastName" class="form-control" placeholder="Last name" required="required">
                  <label for="lastName">Last name</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="text" name="email" id="inputEmail" class="form-control" placeholder="Email" required="required">
              <label for="inputEmail">Email</label>
            </div>
            </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="text" onkeyup="checkUsername(this.value)" onfocusout="checkMin(this.value)" name="username" id="inputUsername" class="form-control" placeholder="Username" required="required">
                <span id="err"></span>
              <label for="inputUsername">Username</label>
            </div>
          </div>  <div class="form-group">
            <div class="form-label-group">
              <input type="number" name="contactnum" id="inputcontactnum" class="form-control" placeholder="Contact" required="required" minlength="10">
              <label for="inputcontactnum">Contact Number</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="password" onkeyup="checkPass(this.value)" onfocusout="checkMin2(this.value)" name="password_1" id="inputPassword" class="form-control" placeholder="Password" required="required">
                  <label for="inputPassword">Password</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="password" name="password_2" id="confirmPassword" class="form-control" placeholder="Confirm password" required="required">
                  <label for="confirmPassword">Confirm password</label>
                </div>
              </div>
            </div>
          </div>
          <button class="btn btn-primary btn-block" name="reg_user" type="submit">Register</button>
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="../login.php">Already have an Account?</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="stylez1/bootstrap/vendor/jquery/jquery.min.js"></script>
  <script src="stylez1/bootstrap/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="stylez1/bootstrap/vendor/jquery-easing/jquery.easing.min.js"></script>

</body>
<script>
    function checkUsername(x) {
        y = x.length;
        document.getElementById("err").value = x
        if (y === 21){
          alert("Username must not exceed 20 characters!");

        }
    }

    // function checkMin(x) {
    //     y = x.length;
    //     console.log(y)
    //     if (y < 8){
    //         alert("Username must exceed 8 characters!");
    //     }

    // }

    // function checkMin2(x) {
    //     y = x.length;
    //     console.log(y)
    //     if (y < 8){
    //         alert("Password must exceed 8 characters!");
    //     }

    // }

    function checkPass(x) {
        y = x.length;
        console.log(y)


        if (y === 32){
            alert("Password must not exceed 32 characters!");
        }

    }



</script>
</html>
