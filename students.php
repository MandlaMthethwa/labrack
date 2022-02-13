 <!DOCTYPE html>
<html>
<head> 
  <title>Students</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
 <h1>Students</h1>
 <table>
  <tr>
    <th>Firstname</th>
    <th>Lastname</th>
    <th>Student Number</th>
	<th>Command</th>
  </tr>
  <?php
  
  require_once "config/connect.php";
  $sql = "SELECT * FROM student";
  if($result = $conn->query($sql)){
	  if($result->num_rows > 0){
		  while($row = $result->fetch_array()){
			 echo "<tr>";
             echo "<td>".$row['studentFirstName']."</td>";
             echo "<td>".$row['studentLastName']."</td>";
			 echo "<td>".$row['studentNumber']."</td>";
             echo "<td><a href='register_student.php?student_id=".$row['studentID']."'>Assign Subject</a></td>";
             echo "</tr>"; 
		  }
	  }
  }
  ?>
</table>
<a href="dashboard.php">Back</a> <a href="student/add_student.php">Add New Student</a>
</body>
</html>