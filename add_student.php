<?php

require_once("config/connect.php");

 function validate_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

 $error = $first_name = $last_name = $student_number = "";
 $first_name_error = $last_name_error = $student_number_error = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){

       
       if(empty($_POST['first_name'])) {
            $first_name_error = "<span class='error-message'>First Name is required.</span><br>";
       } else {
         $first_name = validate_input($_POST["first_name"]);
         // check if first_name only contains letters and whitespace
         if (!preg_match("/^[a-zA-Z ]*$/", $first_name)) {
            $first_name_error = "<span class='error-message'>Only letters and white space allowed.</span><br>";
         }
       }

       if(empty($_POST['last_name'])) {
           $last_name_error = "<span class='error-message'>Last Name is required.</span><br>";
       } else {
         $last_name = validate_input($_POST["last_name"]);
         // check if lastname only contains letters and whitespace
         if(!preg_match("/^[a-zA-Z ]*$/", $last_name)) {
            $last_name_error = "<span class='error-message'>Only letters and white space allowed.</span><br>";
         }
       }


       if(empty($_POST['student_number'])) {
           $student_number_error = "<span class='error-message'>Student number is required.</span><br>";
       } else {
          $student_number= validate_input($_POST["student_number"]);
           if(strlen($student_number) <> 8) {  
         }else{
           $student_number_error = "<span class='error-message'>Student has 9 characters long.</span><br>";
         }
       }

       if(empty($first_name_error) && empty($last_name_error) && empty($student_number_error)){

        $sql = "INSERT INTO student (studentFirstName, studentLastName, studentNumber) VALUES (?, ?, ?)"; 
  
        if($stmt = $conn->prepare($sql)){ 
          $stmt->bind_param("sss", $first_name, $last_name, $student_number);
          if($stmt->execute()){
       
          $error = "<span class='success-message'>Student created successfully.</span><br>";

          $reload = $_SERVER['PHP_SELF'];
          
          header("Refresh: 5; $reload");

          
          
          }else{
          $error = "<span class='success-message'>Failed to create new student.</span><br>";
          }
          $stmt->close();
        }
       }

       
       $conn->close();
    }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Add Student</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="signup-form">
<h2>Add Student</h2>
<span class="error"><?php echo $error;?></span><br>
 <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <label>First Name<span style="color:red;">&nbsp*</span></label>
  <input type="text" name="first_name" value="<?php echo $first_name;?>"><br>
  <div><?php echo $first_name_error;?></div>
  <label>Last Name<span style="color:red;">&nbsp*</span></label>
  <input type="text" name="last_name" value="<?php echo $last_name;?>"><br>
  <div><?php echo $last_name_error;?></div>
  <label>Student number<span style="color:red;">&nbsp*</span></label>
  <input type="text" name="student_number" value="<?php echo $student_number;?>"><br>
  <div><?php echo $student_number_error;?></div>
  <input type="submit" name="add" value="Add">
  <a class="button-back" href="students.php">Back</a>
</form> 

</div>
</body>
</html>