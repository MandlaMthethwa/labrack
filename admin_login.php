<?php

session_start();

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: dashboard.php ");
    exit();
}

require_once("config/connect.php");

function validate_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$username = $password = "";
$username_error = $password_error = $error = "";


if($_SERVER["REQUEST_METHOD"] == "POST"){ 

  if(empty($_POST['username'])) {
        $username_error = "<span class='error-message'>Please enter your username.</span><br>";
    }else{
        $username = validate_input($_POST["username"]);
    }

    if(empty($_POST['password'])) {
        $password_error = "<span class='error-message'>Please enter your password.</span><br>";
    }else{
        $password = validate_input($_POST["password"]);
    }

    if(empty($username_error) && empty($password_error)){

      $sql = "SELECT lecturerID, lecturerFirstName, lecturerLastName, lecturerUsername, lecturerPassword FROM lecturer WHERE  lecturerUsername = ?";

      if($stmt = $conn->prepare($sql)){

        $stmt->bind_param("s", $param_username);
        $param_username = $username;

        if($stmt->execute()){

          $stmt->store_result();
          if($stmt->num_rows == 1){

            $stmt->bind_result($lecturerid, $firstname, $lastname, $username, $hashed_password);
            if($stmt->fetch()){

              if(password_verify($password, $hashed_password)){

                  session_start();
                  $_SESSION['loggedin'] = true;
				  $_SESSION['lecturerid'] = $lecturerid;
                  $_SESSION['lecturerfirstname'] = $firstname;
                  $_SESSION['lecturerlastname'] = $lastname;
                  $_SESSION['lecturerusername'] = $username;

                  header("location: dashboard.php");

              }else{

                $error = "<span class='error-message'>The password or Username you entered is not valid.</span><br>";
              }
            }
          }else{

            $error = "<span class='error-message'>The password or Username you entered is not valid.</span><br>";
          }
        }else{

          $error = "<span class='error-message'>Failed to verify username or password, Please try again later.</span><br>";
        }
      }

      $stmt->close();
    }

    $conn->close();
}

?>
<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
 <div class="form-content">
 <h2  style="text-align:center;"><span>LOGIN TO YOUR</span><span class="heading"> ACCOUNT</span></h2>
  <div><?php echo $error;?></div>
 <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <label>USERNAME</label>
  <input type="text" placeholder="Username" name="username" value="<?php echo $username;?>"><br>
  <div><?php echo $username_error;?></div>
  <label>PASSWORD</label>
  <input type="password" placeholder="Password" name="password">
  <div><?php echo $password_error;?></div>
  <input  name="submit" type="submit" value="Login"><a class="button-back" href="index.html">Back</a>
</form>
</div>


</body>
</html>