<?php

  session_start();

  if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: index.php");
    exit();
  }

  require_once("../config/connect.php");

  function validate_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
  }

  $old_password = $new_password = $upd_id = $confirm_password = $student_no = $success = "";
  $old_password_error = $new_password_error = $confirm_password_error =   $student_no_error = $error = "";

  

  $upd_id = $_SESSION["student_username"];
  


  if($_SERVER["REQUEST_METHOD"] == "POST"){


  if(empty($_POST['student_no'])) {

    $student_no_error = "<span class='error-message'>Student no is required.</span><br>";
  } else {
    
    $student_no = validate_input($_POST["student_no"]);
  } 

  if(empty($_POST['old_password'])) {

    $old_password_error = "<span class='error-message'>Old password is required.</span><br>";

  } else {
    
    $old_password = validate_input($_POST["old_password"]);

    $sql = "SELECT studentID, studentFirstName, studentLastName, studentNumber, studentPassword FROM student WHERE  studentNumber = ?";

      if($stmt = $conn->prepare($sql)){

        $stmt->bind_param("s", $param_username);
        $param_username = $student_no;

        if($stmt->execute()){

          $stmt->store_result();
          if($stmt->num_rows == 1){

            $stmt->bind_result($account_id, $account_firstname, $account_lastname, $account_username, $hashed_password);
            if($stmt->fetch()){

              if(password_verify($old_password, $hashed_password)){

              }else{

                $old_password_error = "<span class='error-message'>Password entered is incorrect.</span><br>";
              }
            }else{

              $error = "<span class='error-message'>The password or Username you entered is not valid.</span><br>";
            }

          }
        }else{

          $error = "<span class='error-message'>Failed to verify username or password, Please try again later.</span><br>";
        }
      }

      $stmt->close();

  }

  if(empty($_POST['new_password'])) {

    $new_password_error = "<span class='error-message'>New password is required.</span><br>";
  } else {
    
    $new_password = validate_input($_POST["new_password"]);
    if(strlen($new_password) >= 8) {  
    }else{
      $new_password_error = "<span class='error-message'>Password must be atleast 8 characters long.</span><br>";
    }
  } 

  if(empty($_POST['confirm_password'])) {

    $confirm_password_error = "<span class='error-message'>Please confirm your password.</span><br>";
  } else {
    
    $confirm_password = validate_input($_POST["confirm_password"]);
    if(strlen($confirm_password) >= 8) {  
    }else{
      $confirm_password_error = "<span class='error-message'>Password must be atleast 8 characters long.</span><br>";
    }
  }

  if($confirm_password != $new_password){

    $confirm_password_error = "<span class='error-message'>Passwords do not match.</span><br>";

  }else{
    $hash_password = password_hash($new_password, PASSWORD_DEFAULT);
  }

 if(empty($old_password_error) && empty($new_password_error) && empty($confirm_password_error)){

  $sql = "UPDATE student SET studentPassword =? WHERE studentNumber = ?";

        if($stmt = $conn->prepare($sql)){

            $stmt->bind_param("ss", $param_password, $param_student_no);
            $param_password = $hash_password;
            $param_student_no = $student_no;

            if($stmt->execute()){
               
              $error = "<span class='success-message'>Your login password has been update.</span><br>";

              $reload = $_SERVER['PHP_SELF'];
          
              header("Refresh: 5; $reload");

            }else{
              $error = "<span class='error-message'>Failed to delete. Please try again later.</span><br>";
            }
        }

        $stmt->close();
      }

}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Change Password</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="nav-bar">
<ul>
  <li><a class="active logo" href="#home">SCLABTRACK</a></li>
  <li style="float:right"><a class="button-signout" href="logout.php">Logout</a></li>
  <li style="float:right"><a href="student_portal.php">Portal</a></li>
</ul>
</div>
<div class="header">
<div class="add-form">
<h2>Change Login Password</h2>
<p>You can change your password using this form</p>
<div><?php echo $error;?></div>
 <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <label>OLD Password<span style="color:red;">&nbsp*</span></label>
  <input type="text" name="old_password" value="<?php echo $old_password;?>"><br>
  <span class="error"><?php echo $old_password_error;?></span><br>
  <label>New Password<span style="color:red;">&nbsp*</span></label>
  <input type="text" name="new_password" value="<?php echo $new_password;?>"><br>
  <span class="error"><?php echo $new_password_error;?></span><br>
  <label>Confirm Password<span style="color:red;">&nbsp*</span></label>
  <input type="text" name="confirm_password" value="<?php echo $confirm_password;?>"><br>
  <span class="error"><?php echo $confirm_password_error;?></span><br>
  <input type="hidden" name="student_no" value="<?php echo $upd_id;?>">
  <input type="submit" value="Reset Password">
  <a class="button-back" href="student_portal.php">Back</a>
</form> 
</div>
</div>
</body>
</html>