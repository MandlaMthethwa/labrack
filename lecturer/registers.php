<?php

session_start();

if (!isset($_SESSION["signedin"]) || $_SESSION["signedin"] !== true) {
    header("location: index.php");
    exit();
}

if(isset($_GET["subject_id"]) && !empty(trim($_GET["subject_id"]))){

  $subject_id = trim($_GET["subject_id"]);

}

if(isset($_GET["subject_code"]) && !empty(trim($_GET["subject_code"]))){

  $subject_code = trim($_GET["subject_code"]);
}

$registeredLecturer_id = $_SESSION['lecturer_id'];

?>
<!DOCTYPE html>
<html>
<head>
	<title>Attendance registers</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="header">
<p><a class="button-add" href="create_register.php?subject_id=<?php echo $subject_id;?>&subject_code=<?php echo $subject_code;?>">create register</a></p>
</div><br>
<div class="main">
<h2>Attendance Register Details</h2>
<?php 

require_once("../config/connect.php");

$sql = "SELECT DISTINCT subject.subjectID, subject.subjectCode, attendancerecord.attendanceRecordDate FROM attendancerecord INNER JOIN subject ON (attendancerecord.subjectID = subject.subjectID) WHERE (attendancerecord.subjectID = ? AND attendancerecord.registeredLecturerID = ?)";
if($stmt = $conn->prepare($sql)){

  $stmt->bind_param("ii", $subject_id, $registeredLecturer_id);

  if($stmt->execute()){

      $result = $stmt->get_result();

      if($result->num_rows > 0){

      echo "<table>";
       echo "<thead>";
          echo "<tr>";
             echo "<th>Number</th>";
             echo "<th>Subject Code</th>";
             echo "<th>Date</th>";
             echo "<th>Action</th>";
          echo "<tr>";
       echo "</thead>";
       echo "<tbody>";
       $count = 0;
       while ( $row = $result->fetch_assoc()) {
          $count++;
          echo "<tr>";
            echo "<td>".$count."</td>";
            echo "<td>".$row['subjectCode']."</td>";
            echo "<td>".$row['attendanceRecordDate']."</td>";
            echo "<td>";
              echo "<a class='button-view' href='view_register.php?register_date=".$row['attendanceRecordDate']."&subject_id=".$row['subjectID']."&subject_code=".$row['subjectCode']."'>Print report</a>";
            echo "</td>";
          echo "</tr>";

       }
       echo "</tbody>";
       echo "<table>";
     
  }else{

    echo "<p>No records were found</p>";
  }
  
}else{
  echo "Failed to execute ";
}
$stmt->close();
$conn->close();

}

?>
<h4><a class="button-back" href="lecturer_dashboard.php">Back</a></h4> 
</div>
</body>
</html>

