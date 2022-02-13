<?php

session_start();

if (!isset($_SESSION["signedin"]) || $_SESSION["signedin"] !== true) {
    header("location: index.php");
    exit();
}


?>
<!DOCTYPE html>
<html>
<head>
  <title>Dashboard</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="nav-bar">
<ul>
  <li><a class="active logo" href="#home">SCLABTRACK</a></li>
  <li style="float:right"><a class="button-signout" href="index.php">Log out</a></li>
</ul>
<h1>Dashboard</h1>
<a class="button-add" href="../report/generate_report.php">Report</a></p>

<?php
  $lecturer_id = $_SESSION["lecturer_id"];
  
  require_once "../config/connect.php";
  
  $sql = "SELECT subject.subjectCode, subject.subjectName, registeredlecturer.subjectID FROM subject INNER JOIN registeredlecturer ON subject.subjectID = registeredlecturer.subjectID WHERE registeredlecturer.lecturerID = ?";

  if($stmt = $conn->prepare($sql)){

    $stmt->bind_param("i", $lecturer_id);

    if($stmt->execute()){

    	$result = $stmt->get_result();

        if($result->num_rows > 0){   

          while ( $row = $result->fetch_assoc()) {
		     echo "<div class='students'>";
             echo "<a href='?subject_id=".$row['subjectID']."&subject_code=".$row['subjectCode']."'>".$row['subjectCode']."</a>";
			 echo "<p>".$row['subjectName']."</p>";
             echo "</div>";
          
          }  
        }else{
          echo "<p>No records were found</p>";
        }
      }else{
        echo "Failed to execute ";
      }
      $stmt->close();
    }

?>
<br><br><br><br>

</body>
</html>