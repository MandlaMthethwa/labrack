<?php

session_start();

if (!isset($_SESSION["signedin"]) || $_SESSION["signedin"] !== true) {
    header("location: index.php");
    exit();
}

function validate_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if(isset($_GET["subject_id"]) && !empty(trim($_GET["subject_id"]))){
     $param_id = validate_input($_GET["subject_id"]);
  }

  if(isset($_GET["register_date"]) && !empty(trim($_GET["register_date"]))){
     $param_date = validate_input($_GET["register_date"]);
  }
  
  if(isset($_GET["subject_code"]) && !empty(trim($_GET["subject_code"]))){
     $subject_code = validate_input($_GET["subject_code"]);
  }

  $mark = 1;

  require_once("../config/connect.php");
  
  $Lecturer_id = $_SESSION['lecturer_id'];

?>
<!DOCTYPE html>
<html>
<head>
  <title>view attendance register</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="main">
  <table>
  <thead>
  <tr>
    <th>Date</th>
    <th>Subject Code</th>
  </tr>
  </thead>
  <tbody>
  <tr>
    <td><?php echo date_format(date_create($param_date), 'M d, Y');?></td>
    <td><?php echo $subject_code;?></td>
  </tr>
  </tbody>
  </table>
<h2>Attendance Register</h2>
<br>
  <?php

  $sql = "SELECT student.studentFirstName, student.studentLastName, student.studentNumber,
  attendancerecord.attendanceRecordDate, attendancerecord.attendanceRecordCheckIn, attendancerecord.attendanceRecordCheckOut
  FROM attendancerecord INNER JOIN student ON (attendancerecord.registeredStudentID = student.studentID) WHERE attendancerecord.subjectID = ? AND attendancerecord.attendanceRecordDate = ? AND attendancerecord.registeredLecturerID = ? AND attendancerecord.attendanceRecordMark=?";

    if($stmt = $conn->prepare($sql)){

      $stmt->bind_param("isii", $param_id, $param_date, $Lecturer_id, $mark);

      if($stmt->execute()){

        $result = $stmt->get_result();

        if($result->num_rows > 0){
		  
          echo "<table>";
           echo "<thead>";
             echo "<tr>";
                echo "<th>Student</th>";    
                echo "<th>Date</th>";
                echo "<th>Time-In</th>";
                echo "<th>Time-Out</th>";
              echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            $count = 0;
            $status = 0;
            while ( $row = $result->fetch_assoc()) {
            
			$date = $row['attendanceRecordDate'];	
            $formatted_date = date_format(date_create($date), 'M d, Y');

            echo "<tr>";
               echo "<td>".$row['studentFirstName'].", ".$row['studentLastName'].", ".$row['studentNumber']."</td>";
               echo "<td>".$formatted_date ."</td>";
               echo "<td>".$row['attendanceRecordCheckIn']."</td>";
			   echo "<td>".$row['attendanceRecordCheckOut']."</td>";
            echo "</tr>";
          }
          echo "</tbody>";
          echo "</table>"; 

        }else{
          echo "<p>No records were found</p>";
        }
      }else{
        echo "Failed to execute ";
      }
      $stmt->close();
    }?>
<h4><a class="button-back" href="registers.php?reg_id=<?php echo $param_id;?>">Back</a><a class="button-add" href="pdf.php?gen_date=<?php echo $param_date;?>&gen_code=<?php echo $param_id;?>">Generate Pdf</a></h4> 
</div>
</body>
</html>

