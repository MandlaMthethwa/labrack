<!DOCTYPE html>
<?php
 
require_once "config/connect.php";

$error = array();
$subject_choice_error = $subject_choice = $success = $checkstudent_error = "";
$firstname_error = $lastname_error = $student_no_error = $student_id_error = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
	
	if(empty($_POST['firstname'])){
    
    echo "<span class='error-message'>Enter student firstname.</span><br>";

    }else{

    $firstname = $_POST['firstname'];
   
    }
	
	if(empty($_POST['lastname'])){
    
    $firstname_error = "<span class='error-message'>Enter student lastname.</span><br>";

    }else{

    $lastname = $_POST['lastname'];
   
    }
	
	if(empty($_POST['student_no'])){
    
    $lastname_error = "<span class='error-message'>Enter student #.</span><br>";

    }else{

    $student_no = $_POST['student_no'];
   
    }
	
	if(empty($_POST['subject_choice'])){
    
    $subject_choice_error = "<span class='error-message'>Select atleast one course.</span><br>";

    }else{

    $subject_choice = $_POST['subject_choice'];
   
    }
	
	if(empty($_POST['student_id'])){
    
    $student_id_error = "<span class='error-message'>Enter student #.</span><br>";

    }else{

    $student_id = $_POST['student_id'];
	
	if($subject_choice){
	
	foreach ($subject_choice as $subjects => $registered_subject) {
	
	  $sql = "SELECT * FROM registeredstudent WHERE studentID = ? AND subjectID = ?";

      if($stmt = $conn->prepare($sql)){

      $stmt->bind_param("ii", $student_id, $registered_subject);

      if($stmt->execute()){

        $result = $stmt->get_result();

        if($result->num_rows >= 1){

          $row = $result->fetch_array(MYSQLI_ASSOC);

		  $checkstudent_error = "<span class='error-message'>Student already registered for selected subject</span><br>";
     
            
        }
      }else{
        echo "<span class='error-message'>Failed to execute.</span><br>";
      }
      $stmt->close();
    }
	
	}
   
    }
	}
	
	
    if((!$checkstudent_error) && empty($subject_choice_error)){	

       foreach ($subject_choice as $subjects => $registered_subject) {

      $sql = "INSERT INTO registeredstudent (studentID, subjectID) VALUES (?, ?)";

      if($stmt = $conn->prepare($sql)){ 

        $stmt->bind_param("ii", $student_id, $registered_subject);
        if($stmt->execute()){

            $success = "<span class='success-message'>Student has been registered.</span><br>";
           
        }else{

            echo "<span class='error-message'>Failed to add student into register.</span><br>";

        }

        $stmt->close();
    }
}

}

}
?>
<html>
<head>
  <title>Register Student</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php

  require_once "config/connect.php";
  
  if(isset($_GET["student_id"]) && !empty(trim($_GET["student_id"]))){

     $student_id = $_GET["student_id"];
  }

    
    $sql = "SELECT * FROM student WHERE studentID = ?";
    if($stmt = $conn->prepare($sql)){

       $stmt->bind_param("i", $student_id);
       if($stmt->execute()){

          $result = $stmt->get_result();
          if($result->num_rows == 1){

             $row = $result->fetch_array(MYSQLI_ASSOC);
             $firstname = $row["studentFirstName"];
             $lastname = $row["studentLastName"];
			 $student_no = $row["studentNumber"];
			 $student_id = $row["studentID"];
          
          }else{
             
             echo "Failed. Try again later.";
          }
       }

       $stmt->close();
       

    }

?>
<div class="register-student-form">
<h1>Register Student</h1>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <div><?php echo $checkstudent_error;?></div>
  <div><?php echo $success;?></div>
  <div><?php echo $subject_choice_error;?></div>
  <label>First Name<span style="color:red;">&nbsp*</span></label>
  <input type="text" name="firstname" value="<?php echo $firstname;?>" readonly><br>
  <div><?php echo $firstname_error;?></div>
  <label>Last Name<span style="color:red;">&nbsp*</span></label>
  <input type="text" name="lastname" value="<?php echo $lastname;?>" readonly><br>
  <div><?php echo $lastname_error;?></div>
  <label>Student No<span style="color:red;">&nbsp*</span></label>
  <input type="text" name="student_no" value="<?php echo $student_no;?>" readonly><br>
  <div><?php echo $student_no_error;?></div>
  <input type="hidden" name="student_id" value="<?php echo $student_id;?>">
  <div><?php echo $student_id_error;?></div>
  <label class="bold-text">Choose Subjects<span style="color:red;">&nbsp*</span></label><br>
  <?php
  
  require_once "config/connect.php";
  $sql = "SELECT * FROM subject";
  if($result = $conn->query($sql)){
	  if($result->num_rows > 0){
		  while($row = $result->fetch_array()){
			 echo "<input type='checkbox' name='subject_choice[]' value=".$row['subjectID'].">".$row['subjectCode']."<br>"; 
		  }
	  }
  }
  
  $conn->close();
  ?>
  
 <a class="button-back" href="students.php">Cancel</a><input  name="submit" type="submit" value="Save">
 </form>
 </div>
</body>
</html>
