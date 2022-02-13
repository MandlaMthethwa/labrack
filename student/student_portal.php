<?php 
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: index.php");
    exit();
}
 require_once("../config/connect.php");
 
	
	
		
$studentNumber = $_SESSION["student_username"];
		
		$query = "SELECT  registeredStudentID ,subjectCode  FROM registeredStudent R , subject S , student ST
					WHERE R.subjectID = S.subjectID
					AND R.studentID  = ST.studentID
					AND studentNumber  = $studentNumber";
$result = mysqli_query($conn ,$query);

 if($_SERVER["REQUEST_METHOD"]=="POST")
 {
	 
		$registeredStudent = $_POST['registeredStudentID'];

	
	 $sql="INSERT INTO attendancerecord(attendanceRecordDate,registeredStudentID)
	 VALUES(CurDate(),'$registeredStudent')";
	 $sql_run=mysqli_query($conn,$sql);
	 if ($sql_run)
	 {
		echo "<span class='success-message'>Attandace successfully captured.</span><br>";
		 
	 }
	 else
	 {
		echo "<span class='error-message'>Error : Failed to capture attandance. Please try again.</span><br>";
	 }
	
 }

     
       

?>

<!DOCTYPE html>
<html>
<head>
	<title>Portal</title>
	<link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="nav-bar">
<ul>
  <li><a class="active logo" href="#home">SCLABTRACK</a></li>
  <li style="float:right"><a class="button-signout" href="logout.php">Logout</a></li>
  <li style="float:right"><a href="student_portal.php">Portal</a></li>
    <li style="float:right"><a href="student_profile.php">Change Password</a></li>
</ul>
</div>

<h4>Personal Infomation</h4>
<img src="../images/profile.png" alt="profile" width="50">
<table>
  <thead>
  <tr>
    <th>First name</th>
    <th>Last name</th>
    <th>Student Number</th>
  </tr>
  </thead>
  <tbody>
  <tr>
    <td><?php echo htmlspecialchars($_SESSION["student_firstname"]);?></td>
    <td><?php echo htmlspecialchars($_SESSION["student_lastname"]);?></td>
    <td><?php echo htmlspecialchars($_SESSION["student_username"]);?></td>
  </tr>
  </tbody>
  </table>

	<form  method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
	
	<h4>Registered Subjects </h4> <br>
	<select name = "registeredStudentID" value= " ">
				<?php while ($row = mysqli_fetch_array($result)):; ?>
				<option value= "<?php echo $row['registeredStudentID'];?>"> <?php echo $row['subjectCode'];?> </option>
				<?php endwhile; ?> 
				</select> 
				<br><br>
	<input type="submit" name="submit" value="Mark Present">
	
	</form>	
	
</body>

</html>