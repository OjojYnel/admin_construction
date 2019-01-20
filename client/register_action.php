<?php
include 'config.php';



// initializing variables
$username = "";
$email = "";
$firstname = "";
$lastname = "";
$contactnumber = "";
$errors = array(); 



// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($con, $_POST['username']);
  $email = mysqli_real_escape_string($con, $_POST['email']);
  $firstname = mysqli_real_escape_string($con, $_POST['fname']);
  $lastname = mysqli_real_escape_string($con, $_POST['lname']);
  $contactnumber = mysqli_real_escape_string($con, $_POST['contactnum']);
  $password_1 = mysqli_real_escape_string($con, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($con, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { 
      array_push($errors, "Username is required"); 
} 
if (empty($email)) { 
  array_push($errors, "Email is required"); 
} 

  if (empty($firstname)) { 
      array_push($errors, "First Name is required"); 
}
  if (empty($lastname)) { 
      array_push($errors, "Last Name is required"); 
    }
  if (empty($password_1)) { 
      array_push($errors, "Password is required"); 
    }

    if (strlen($username) >='21') { 
      array_push($errors, "Your Username has exceeded 32 Characters!"); 
    }

    if (empty($contactnumber)) { 
      array_push($errors, "Contact Number is required"); 
    }

    if (strlen($contactnumber) <='9') { 
      array_push($errors, "Contact Number Must Contain At Least 10 Numbers!"); 

    } 
    
    elseif(!preg_match("/^[1-9][0-9]*$/",$contactnumber)) {
      array_push($errors, "Your Contact Number Must be a Number!");
  }

    if (strlen($password_1) >='33') { 
      array_push($errors, "Your Password has exceeded 32 Characters!"); 
    }
    if (strlen($password_1) <='8') { 
      array_push($errors, "Your Password Must Contain At Least 8 Characters!"); 
    }

  //   elseif(!preg_match("#[0-9]+#",$password_1)) {
  //     array_push($errors, "Your Password Must Contain At Least 1 Number!");
  // }


  if ($password_1 != $password_2) {
    array_push($errors, "The two passwords do not match");
  }
   

  // first check the database to make sure 
  // a user does not already exist with the same username 
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR fname='$firstname' LIMIT 1";
  $result = mysqli_query($con, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) { 
      array_push($errors, "Username already exists");
    }

  }

  if ($user) { // if firstname exists
    if ($user['fname'] === $firstname) {
    }
      array_push($errors, "First name already exists");
    
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO users (username, fname, lname, password, contactnum, email) 
  			  VALUES('$username','$firstname','$lastname','$password','$contactnumber','$email')";
  	mysqli_query($con, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: login.php');
  }
}