 <!DOCTYPE html>
<html> 
<head>
  <title>Subjects</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
 <h1>Subjects</h1>
 <table>
  <tr>
    <th>Subject Code</th>
    <th>Subject Name</th>
	
  </tr>
  <?php
  
  require_once "config/connect.php";
  $sql = "SELECT * FROM subject";
  if($result = $conn->query($sql)){
	  if($result->num_rows > 0){
		  while($row = $result->fetch_array()){
			 echo "<tr>";
             echo "<td>".$row['subjectCode']."</td>";
             echo "<td>".$row['subjectName']."</td>";
             echo "</tr>"; 
		  }
	  }
  }
  ?>
</table>
</table>
<a href="dashboard.php">Back</a>
 <a href="add_subject.php">Add subject</a>
</body>
</html>