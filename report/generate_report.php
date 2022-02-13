<?php

session_start(); 

require '../config/connect.php';

	if (!isset($_SESSION["signedin"]) || $_SESSION["signedin"] !== true) 
	{
		header("location: index.php");
		exit();
	}


	$startDate =  date_create(date('y-m-d h:i:s'));
	$startDate = date_add($startDate,date_interval_create_from_date_string("+1 days"));

	$month = date_format($startDate,"m");
	$year = date_format($startDate,"y");

	$startDate = date_create($year."-".$month."-01");

	$endDate =  date_create(date('y-m-d h:i:s'));
	$month = date_format($endDate,"m");  
	$year = date_format($endDate,"y");


	$endDate = date_create($year."-".$month."-01");  //first day of current month
	$endDate = date_add($endDate,date_interval_create_from_date_string("+1 days"));  // second of current month

	$sDate = (FILTER_INPUT (INPUT_GET, 'fstartdate')?FILTER_INPUT (INPUT_GET, 'fstartdate'): date_format($startDate,"Y-m-d h:i:s"));
	$eDate = (FILTER_INPUT (INPUT_GET, 'fenddate')?FILTER_INPUT (INPUT_GET, 'fenddate'): date_format($endDate,"Y-m-d h:i:s"));
	
	

?>


<!DOCTYPE html>
<html>
<head>
  <title>Generate register</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<h1>Report</h1>
	
	<form action = "pdf.php" method = "POST">
	
	<div class ='hero'>
	<select name = "module">
	
	<option> --Select Module--</option>
	
	<?php
		
		$lecturer_id = $_SESSION["lecturer_id"];

		require_once "../config/connect.php";


		
		$sql = "SELECT subjectCode
				FROM subject S
				INNER JOIN registeredlecturer RS ON S.subjectID = RS.subjectID
				WHERE RS.lecturerID  = ?";
				

  if($stmt = $conn->prepare($sql)){

    $stmt->bind_param("i", $lecturer_id);

    if($stmt->execute()){

    	$result = $stmt->get_result();

        if($result->num_rows > 0){   

          while ( $row = $result->fetch_assoc()) {
		 
			$module = $row['subjectCode'];
			
			echo "<option value = '$module'>$module</option>";
         
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

	</select><br>
	
	Start Date <input type = date name = fstartdate value=<?php echo $sDate; ?> ><br>
	End date <input type = date name = fenddate value=<?php echo $eDate; ?> ><br><br>

	<input type = "submit" name ="btnsubmit" value = "generate">
	<ul style="float:right"><a class="button-back" href="../lecturer/lecturer_dashboard.php">Back</a></ul>
	</div>
	</form>

</body>
</html>