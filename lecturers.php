 <!DOCTYPE html>
<html>
<head>
  <title>Lecturers</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
 <h1>Lecturers</h1>
 <table>
  <tr>
    <th>Firstname</th>
    <th>Lastname</th>
    <th>Command</th>
  </tr>
  <?php
  
  require_once "config/connect.php";
  $sql = "SELECT * FROM lecturer";
  if($result = $conn->query($sql)){
	  if($result->num_rows > 0){
		  while($row = $result->fetch_array()){
			 echo "<tr>";
             echo "<td>".$row['lecturerFirstName']."</td>";
             echo "<td>".$row['lecturerLastName']."</td>";
             echo "<td><a href='register_lecturer.php?lecturer_id=".$row['lecturerID']."'>Assign Subject</a></td>";
             echo "</tr>"; 
		  }
	  }
  }
  ?>
</table>
<a href="dashboard.php">Back</a> <a href="create_account.php">Add New lecturer</a>
</body>
</html>