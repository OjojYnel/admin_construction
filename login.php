<!DOCTYPE html>
<html lang="en">
<head>
    <title>iConstruct</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="assets/images/icons/favicon.ico"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/fonts/iconic/css/material-design-iconic-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/css/util.css">
    <link rel="stylesheet" type="text/css" href="assets/css/main.css">
    <!--===============================================================================================-->
</head>
<body>

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100 p-t-85 p-b-20">
            <form class="login100-form validate-form" action="php/login.php" method="post">

                <div class="wrap-input100 validate-input m-t-85 m-b-35" data-validate="Enter username">
                    <input class="input100" type="text" name="username">
                    <span class="focus-input100" data-placeholder="Username"></span>
                </div>

                <div class="wrap-input100 validate-input m-b-50" data-validate="Enter password">
                    <input class="input100" type="password" name="password">
                    <span class="focus-input100" data-placeholder="Password"></span>
                </div>

                <div class="container-login100-form-btn">
                    <button class="login100-form-btn">
                        Login
                    </button>
                </div>

                <ul class="login-more p-t-50">

                    <li>
							<span class="txt1">
								Don’t have an account?
							</span>

                        <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" x>
                            Sign up
                        </button>
                    </li>
                </ul>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="php/register.php" method="post">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header card-header-primary">
                                            <h4 class="card-title text-center">Signup</h4>
                                        </div>
                                        <div class="card-body">

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="bmd-label-floating">First Name</label>
                                                        <input required type="text" name="fname" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="bmd-label-floating">Last Name</label>
                                                        <input required type="text" name="lname" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="bmd-label-floating">Email</label>
                                                        <input required type="email" name="eml" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="bmd-label-floating">Contact Number</label>
              <input type="number" onkeyup="checkNum(this.value)" name="num" id="inputcontactnum" class="form-control" maxlength="21" required="required">
              <span id="err"></span>

                                                       
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                    <div class="form-label-group">
              <input type="text" onkeyup="checkUsername(this.value)" onfocusout="checkMin(this.value)" name="username" id="inputUsername" class="form-control" placeholder="Username" maxlength="21" required="required">
                <span id="err"></span>
            </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="bmd-label-floating">User Type</label>
                                                        <select name="ty" class="form-control">
                                                            <option value="Client">Client</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                    <div class="form-label-group">
                  <input type="password" onkeyup="checkPass(this.value)" onfocusout="checkMin2(this.value)" name="pass" id="inputPassword" class="form-control" placeholder="Password" maxlength="33" required="required">
                </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                    <div class="form-label-group">
                  <input type="password" onkeyup="checkPass(this.value)" onfocusout="checkMin2(this.value)" name="pass2" id="confirmPassword" class="form-control" placeholder="Confirm password" maxlength="33" required="required">
                </div>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
        </form>
    </div>
</div>


<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
<script src="assets/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="assets/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="assets/vendor/bootstrap/js/popper.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="assets/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="assets/vendor/daterangepicker/moment.min.js"></script>
<script src="assets/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
<script src="assets/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
<script src="assets/js/main.js"></script>

</body>
<script>
    function checkUsername(x) {
        y = x.length;
        document.getElementById("err").value = x
        if (y === 21){
          alert("Username must not exceed 20 characters!");

        }
    }

    function checkNum(x) {
        y = x.length;
        document.getElementById("err").value = x
        if (y === 21){
          alert("Contact number must not exceed 20 characters!");

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


        if (y === 33){
            alert("Password must not exceed 32 characters!");
        }

    }



</script>
</html>