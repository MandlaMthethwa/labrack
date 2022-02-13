<!DOCTYPE html>
<?php
 
require_once "config/connect.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
	
	if(empty($_POST['firstname'])){
    
    echo "<span class='error-message'>Enter student firstname.</span><br>";

    }else{

    $firstname = $_POST['firstname'];
   
    }
	
	if(empty($_POST['lastname'])){
    
    echo "<span class='error-message'>Enter student lastname.</span><br>";

    }else{

    $lastname = $_POST['lastname'];
   
    }
	
	if(empty($_POST['student_no'])){
    
    echo "<span class='error-message'>Enter student #.</span><br>";

    }else{

    $student_no = $_POST['student_no'];
   
    }
	
	if(empty($_POST['student_id'])){
    
    echo "<span class='error-message'>Enter student #.</span><br>";

    }else{

    $student_id = $_POST['student_id'];
   
    }
	
	if(empty($_POST['subject_choice'])){
    
    echo "<span class='error-message'>Add atleast one course.</span><br>";

    }else{

    $subject_choice = $_POST['subject_choice'];
   
    }
	
foreach ($subject_choice as $subjects => $registered_subject) {

   $sql = "INSERT INTO registeredstudent (studentID, subjectID) VALUES (?, ?)";

   if($stmt = $conn->prepare($sql)){ 

        $stmt->bind_param("ii", $student_id, $registered_subject);
        if($stmt->execute()){

            echo "<span class='success-message'>Student has been registered.</span><br>";
           
        }else{

            echo "<span class='error-message'>Failed to add student into register.</span><br>";

        }

        $stmt->close();
    }
}

}
?>
<html>
<head>
  <title>Student Details</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<h1>Student Details</h1>
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
<form method="post" action="">
  <label>First Name<span style="color:red;">&nbsp*</span></label>
  <input type="text" name="firstname" value="<?php echo $firstname;?>" readonly><br>
  <div></div>
  <label>Last Name<span style="color:red;">&nbsp*</span></label>
  <input type="text" name="lastname" value="<?php echo $lastname;?>" readonly><br>
  <div></div>
  <label>Student No<span style="color:red;">&nbsp*</span></label>
  <input type="text" name="student_no" value="<?php echo $student_no;?>" readonly><br>
  <div></div>
  <input type="hidden" name="student_id" value="<?php echo $student_id;?>">
  <label class="bold-text">Choose Courses<span style="color:red;">&nbsp*</span></label><br>
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
 <a class="button-back" href="index.html">Cancel</a> <a class="button-delete" href="index.html">Delete</a>  <input  name="submit" type="submit" value="Save">
 </form>
</body>
</html>
