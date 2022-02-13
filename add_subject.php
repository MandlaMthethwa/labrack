<?php

  session_start();

  if (!isset($_SESSION["signedin"]) || $_SESSION["signedin"] !== true) {
    header("location: index.php");
    exit();
  }
    

  require_once("config/connect.php");

  $subject_code = $subject_name = $subject_id= 
  $subject_code_error = $subject_name_error = $error = "";

  function validate_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
  }

  if($_SERVER["REQUEST_METHOD"] == "POST"){

  if(empty($_POST['subject_code'])) {

    $subject_code_error = "<span class='error-message'>subject code is required.</span><br>";
  } else {
    
    $subject_code = validate_input($_POST["subject_code"]);

    $sql = "SELECT  subjectID FROM subject WHERE subjectCode = ?";

    if($stmt = $conn->prepare($sql)){

      $stmt->bind_param("s", $param_code);
      $param_code = $subject_code;
            
      if($stmt->execute()){

        $stmt->store_result();
        if($stmt->affected_rows >0){

          $subject_code_error = "<span class='error-message'>This subject already exist.</span><br>";

        }

      }else{
          
          $subject_code_error = "<span class='error-message'>Failed to check if subject exist.</span><br>";
      }

      $stmt->close();

    }
  }

  if(empty($_POST['subject_name'])) {

    $subject_name_error = "<span class='error-message'>subject name is required.</span><br>";
  } else {
    
    $subject_name = validate_input($_POST["subject_name"]);
   
  }



  if(empty($subject_code_error) && empty($subject_name_error)){

      $sql = "INSERT INTO subject (subjectCode, subjectName) VALUES (?, ?)";

      if($stmt = $conn->prepare($sql)){ 

          $stmt->bind_param("ss", $subject_code, $subject_name);
          if($stmt->execute()){

          $error = "<span class='success-message'>subject Added Successfully.</span><br>";

          $reload = $_SERVER['PHP_SELF'];
          
          header("Refresh: 5; $reload");
      
          
          }else{

          $error = "<span class='error-message'>Failed to Add subject.</span><br>";

          }

          $stmt->close();
        }

    }

  $conn->close ();

  }

?>
<!DOCTYPE html>
<html>
<head>
	<title>Add subject</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="nav-bar">
<ul>
  <li><a class="active logo" href="#home">SCLABTRACK</a></li>
  
</div>
<div class="header">
<div class="add-form">
<h2>Add New subject</h2>
<div><?php echo $error;?></div>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <label>subject Code<span style="color:red;">&nbsp*</span></label>
  <input type="text" name="subject_code" ><br>
  <div><?php echo $subject_code_error;?></div>
  <label>subject Name<span style="color:red;">&nbsp*</span></label>
  <input type="text" name="subject_name"><br>
  <div><?php echo $subject_name_error;?></div>
  <input type="submit" name="submit" value="Save">
  <a class="button-back" href="subjects.php">Back</a>
</form>
</div>
</div>
</body>
</html>