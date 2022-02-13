<?php

session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: index.php");
    exit();
}

function validate_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if(isset($_GET["registered_course"]) && !empty(trim($_GET["registered_course"]))){
     $param_course = validate_input($_GET["registered_course"]);
  }

  if(isset($_GET["registered_student"]) && !empty(trim($_GET["registered_student"]))){
     $param_student = validate_input($_GET["registered_student"]);
  }

  require_once("../config/connect.php");

?>
<!DOCTYPE html>
<html>
<head>
  <title>view register</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="nav-bar">
<ul>
  <li><a class="active logo" href="#home">SCLABTRACK</a></li>
  <li style="float:right"><a class="button-signout" href="logout.php">Logout</a></li>
  <li style="float:right"><a href="student_portal.php">Portal</a></li>
</ul>
</div>
<div class="main">
<h4>Course&nbsp<span class="heading"><?php echo $param_course;?></span></h4>

<?php if(isset($_GET["success_state"]) && !empty(trim($_GET["success_state"]))){
     echo $_GET["success_state"];
}?>

<h2>Attendance Register</h2>

  <?php

  $sql = "SELECT * FROM attendance_register WHERE register_code = ? AND register_student_no = ?";

    if($stmt = $conn->prepare($sql)){

      $stmt->bind_param("ss", $param_course, $param_student);

      if($stmt->execute()){

        $result = $stmt->get_result();

        if($result->num_rows > 0){

          echo "<table>";
           echo "<thead>";
             echo "<tr>";
                echo "<th>#</td>";
                echo "<th>Student No</th>";    
                echo "<th>First Name</th>";
                echo "<th>Last Name</th>";
                echo "<th>Date</th>";
                echo "<th>Attendance</th>";
              echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            $count = 0;
            $status = 0;
            while ( $row = $result->fetch_assoc()) {
            $count++;
            echo "<tr>";
               echo "<td>".$count."</td>";
               echo "<td>".$row['register_student_no']."</td>";
               echo "<td>".$row['register_firstname']."</td>";
               echo "<td>".$row['register_lastname']."</td>";
               echo "<td>".$row['register_date']."</td>";
               echo "<td>"; 
               echo "</td>";
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

<h4><a class="button-back" href="student_portal.php">Back</a></h4>
</div>
</body>
</html>