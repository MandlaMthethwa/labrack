<?php

session_start();

if(isset($_GET["subject_id"]) && !empty(trim($_GET["subject_id"]))){

  $subject_id = trim($_GET["subject_id"]);
  $_SESSION['subject_id'] = $subject_id; 

}

if(isset($_GET["subject_code"]) && !empty(trim($_GET["subject_code"]))){

  $subject_code = trim($_GET["subject_code"]);
  $_SESSION['subject_code'] = $subject_code; 
}

  $registeredLecturer_id = $_SESSION['lecturer_id'];
    
  require_once("../config/connect.php");

  function validate_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
  }
  $register_date = $msg = $info = "";
  $studentID = array();
  $register_date_error = "";
  $error = array();
  $checkdate_error = "";
  $subject_id = "";

  if($_SERVER["REQUEST_METHOD"] == "POST"){  
  
  if(empty($_POST['subject_id'])){
    
    echo "<span class='error-message'>Enter student #.</span><br>";

    }else{

       $subject_id = $_POST['subject_id'];
	   
	   $sql = "SELECT * FROM registeredstudent WHERE subjectID = ? ";

       if($stmt = $conn->prepare($sql)){

          $stmt->bind_param("i", $subject_id);

          if($stmt->execute()){

            $result = $stmt->get_result();

            if($result->num_rows > 0){

               while ( $row = $result->fetch_assoc()) {

               $studentID[] = $row['studentID'];
     
               }  
            }else{
              $info = "<span class='error-message'>No registered students where found on selected subject.</span><br>";
            }
          }else{
            $info = "<span class='error-message'>Failed to execute.</span><br>";
          }
          $stmt->close();
        }
	
	
   
    }
	
  if(empty($_POST['register_date'])) {
        $register_date_error = "<span class='error-message'>Please enter your register date.</span><br>";
  }else{
        $register_date = validate_input($_POST["register_date"]);
		$new_date = date_format(date_create($register_date), 'Y-m-d');
		
		$sql = "SELECT * FROM attendancerecord WHERE attendanceRecordDate = ? AND subjectID = ?";

        if($stmt = $conn->prepare($sql)){
			
           $stmt->bind_param("si", $new_date, $subject_id);
		   
           if($stmt->execute()){

              $result = $stmt->get_result();

              if($result->num_rows >= 1){

                 $row = $result->fetch_array(MYSQLI_ASSOC);

		         $checkdate_error = "<span class='error-message'>Register already exit for selected date!</span><br>";
     
              }
            }else{
        echo "<span class='error-message'>Failed to execute.</span><br>";
      }
      $stmt->close();
        }
  }

  

 if(!$checkdate_error && !$register_date_error){

  foreach($studentID as $x => $x_value) {

    $sql = "INSERT INTO attendancerecord (subjectID, registeredStudentID, attendanceRecordDate ) VALUES (?, ?, ?, ?)";
     
    if($stmt = $conn->prepare($sql)){ 

      $stmt->bind_param("iis", $subject_id, $x_value, $registeredLecturer_id, $register_date);
      if($stmt->execute()){

        $info = "<span class='success-message'>Attendence register created.</span><br>";

        $reload = $_SERVER['PHP_SELF'];
          
        header("Refresh: 5; $reload");
           
      }else{

        $info = "<span class='error-message'>Failed to add student into register.</span><br>";

      }
      
      $stmt->close();

    }
      
  } 
  }    
  }

?>
<!DOCTYPE html>
<html>
<head>
	<title>Register | Information</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
 <div class="create-register-form">
 <h2 style="text-align:center">Create Attendace Register</h2>
 <div><?php echo $checkdate_error;?></div>
 <div><?php echo $info;?></div>
 <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <label class='bold-text'>Date</label><br>
  <input type="date" name="register_date">
  <div><?php echo $register_date_error;?></div>
  <label class='bold-text'>Subject Code</label><br>
  <input type="text" name="subject_code" value="<?php echo $_SESSION['subject_code'];?>" readonly>
  <input type="hidden" name="subject_id" value="<?php echo $_SESSION['subject_id'];?>" readonly> 
  <input type="submit" name="submit" value="Save">
  <a class="button-back" href="registers.php?subject_id=<?php echo $_SESSION['subject_id'];?> & subject_code=<?php echo $_SESSION['subject_code'];?>">Back</a>
</form> 
</div>
</body>
</html>