<!DOCTYPE html>
<?php
 
require_once "config/connect.php";

$subject_choice_error = $subject_choice = $success = $checklecturer_error = "";
$firstname_error = $lastname_error = $lecturer_id_error = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
	
	if(empty($_POST['firstname'])){
    
    $firstname_error = "<span class='error-message'>Enter student firstname.</span><br>";

    }else{

    $firstname = $_POST['firstname'];
   
    }
	
	if(empty($_POST['lastname'])){
    
    $lastname_error = "<span class='error-message'>Enter student lastname.</span><br>";

    }else{

    $lastname = $_POST['lastname'];
   
    }
	
	if(empty($_POST['subject_choice'])){
    
    $subject_choice_error = "<span class='error-message'>Add atleast one course.</span><br>";

    }else{

    $subject_choice = $_POST['subject_choice'];
   
    }
	
	if(empty($_POST['lecturer_id'])){
    
    echo "<span class='error-message'>Enter student #.</span><br>";

    }else{

    $lecturer_id = $_POST['lecturer_id'];
	
	if($subject_choice){
	
	foreach ($subject_choice as $subjects => $registered_subject) {
	
	  $sql = "SELECT * FROM registeredlecturer WHERE lecturerID = ? AND subjectID = ?";

      if($stmt = $conn->prepare($sql)){

      $stmt->bind_param("ii", $lecturer_id, $registered_subject);

      if($stmt->execute()){

        $result = $stmt->get_result();

        if($result->num_rows >= 1){

          $row = $result->fetch_array(MYSQLI_ASSOC);

		  $checklecturer_error = "<span class='error-message'>Lecturer already registered for selected subject</span><br>";
     
            
        }
      }else{
        echo "<span class='error-message'>Failed to execute.</span><br>";
      }
      $stmt->close();
    }
	
	}
   
    }
   
    }
	
	
   if((!$checklecturer_error) && empty($subject_choice_error)){
	   
      foreach ($subject_choice as $subjects => $registered_subject) {

       $sql = "INSERT INTO registeredlecturer (lecturerID, subjectID) VALUES (?, ?)";

       if($stmt = $conn->prepare($sql)){ 

          $stmt->bind_param("ii", $lecturer_id, $registered_subject);
          if($stmt->execute()){

            $success = "<span class='success-message'>Lecturer has been registered.</span><br>";
           
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
  <title>Lecturer Details</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php

  require_once "config/connect.php";
  
  if(isset($_GET["lecturer_id"]) && !empty(trim($_GET["lecturer_id"]))){

     $lecturer_id = $_GET["lecturer_id"];
  }

    
    $sql = "SELECT * FROM lecturer WHERE lecturerID = ?";
    if($stmt = $conn->prepare($sql)){

       $stmt->bind_param("i", $lecturer_id);
       if($stmt->execute()){

          $result = $stmt->get_result();
          if($result->num_rows == 1){

             $row = $result->fetch_array(MYSQLI_ASSOC);
             $firstname = $row["lecturerFirstName"];
             $lastname = $row["lecturerLastName"];
			 $lecturer_id = $row["lecturerID"];
			
          
          }else{
             
             echo "Failed. Try again later.";
          }
       }

       $stmt->close();
       

    }

?>
<div class="register-lecturer-form">
<h1>Register Lecturer</h1>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <div><?php echo $success;?></div>
  <div><?php echo $checklecturer_error;?></div>
  <div><?php echo $subject_choice_error;?></div>
  <label>First Name<span style="color:red;">&nbsp*</span></label>
  <input type="text" name="firstname" value="<?php echo $firstname;?>" readonly><br>
  <div><?php echo $firstname_error;?></div>
  <label>Last Name<span style="color:red;">&nbsp*</span></label>
  <input type="text" name="lastname" value="<?php echo $lastname;?>" readonly><br>
  <div><?php echo $lastname_error;?></div>
  <input type="hidden" name="lecturer_id" value="<?php echo $lecturer_id;?>">
  <div><?php echo $lecturer_id_error;?></div>
  <label class="bold-text">Assign Subject to lecturer<span style="color:red;">&nbsp*</span></label><br>
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
 <a class="button-back" href="lecturers.php">Cancel</a><input  name="submit" type="submit" value="Save">
 </form>
 </div>
</body>
</html>
