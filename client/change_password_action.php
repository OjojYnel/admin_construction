<?php
include 'config.php';
$user = $_SESSION['username'];
if ($user)
{
// initializing variables
  $newpassword = "";
  $confirmpassword = "";
  $errors = array(); 
  if (isset($_POST['change_pass'])) {

//register new password
    $newpassword = mysqli_real_escape_string($con,$_POST['newpassword']); 
    $confirmpassword = mysqli_real_escape_string($con, $_POST['confirmpassword']); 

//validation
    if (strlen($newpassword) <='8') { 
      array_push($errors, "Your Password Must Contain At Least 8 Characters!"); 
    }

    elseif(!preg_match("#[0-9]+#",$newpassword)) {
      array_push($errors, "Your Password Must Contain At Least 1 Number!");
    }

    if (empty($newpassword)) { 
      array_push($errors, "New Password is required"); 
    }

    if (empty($confirmpassword)) { 
      array_push($errors, "Confirm Password is required"); 
    }

    if ($newpassword != $confirmpassword) {
      array_push($errors, "The two passwords do not match");
    }

    if (count($errors) == 0) {
      $newpassword = md5($newpassword);
      $query = "UPDATE users SET password = '$newpassword' where username='$user'";
      $result = mysqli_query($con, $query);

      if($result) {
        array_push($errors, "Password Changed");
      }else{
        echo 'Password, Not Changed';
      } 
      
      header('location: index.jsp');
      
    }
  }
}
?>