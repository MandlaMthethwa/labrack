<?php
session_start();
	
	if (!isset($_SESSION["signedin"]) || $_SESSION["signedin"] !== true) 
	{
		header("location: index.php");
		exit();
	}
	
	require('fpdf/fpdf.php');	
class PDF extends FPDF
{
	function FancyTable($header, $data)
	{	
		$this->SetFillColor(221, 221, 221);
		$this->SetTextColor(119, 119, 119);
		$this->SetDrawColor(255, 255, 255);
		$this->SetLineWidth(.3);
		$this->SetFont('Arial','B',9);
		
			$w = array(10, 45, 45, 45, 45);
			for($i = 0; $i < count($header); $i++)
				$this->Cell($w[$i], 7, $header[$i], 1, 0, 'L', true);
			$this->Ln();
				
				
				$this->SetFillColor(221, 221, 221);
				$this->SetTextColor(119, 119, 119);
				$this->SetFont('Arial','',10);
				
				$fill = false;
			
		
				foreach($data as $row)
				{
					$this->Cell($w[0],6,$row[0],'LR',0,'L',$fill);
					$this->Cell($w[1],6,$row[1],'LR',0,'L',$fill);
					$this->Cell($w[2],6,$row[2],'LR',0,'L',$fill);
					$this->Cell($w[3],6,$row[3],'LR',0,'L',$fill);
					$this->Cell($w[4],6,$row[4],'LR',0,'L',$fill);
					$this->Ln();
					$fill = !$fill;
				}
		
		
			$this->Cell(array_sum($w),0,'','T');
		

			
	}
}
	
	$data = array();
	
	require_once "../config/connect.php";
	
	
	$sDate = $_POST['fstartdate'];
	$eDate = $_POST['fenddate'];
	$subject = $_POST["module"];
	//$days;
	
		
		
		$sql = "SELECT ST.studentNumber, ST.studentLastName, ST.studentFirstName, COUNT(attendancerecordDate) AS attendance 
		FROM student ST 
		INNER JOIN registeredstudent RS ON RS.registeredStudentID = ST.studentID 
		LEFT JOIN attendancerecord AR ON AR.registeredstudentID = RS.registeredStudentID 
		INNER JOIN registeredlecturer L ON L.registeredlecturerID = AR.registeredlecturerID 
		INNER JOIN subject S ON S.subjectID = L.subjectID 
		WHERE S.subjectID = RS.subjectID AND S.subjectCode = ?
		AND AR.attendanceRecordDate >= ? 
		AND AR.attendanceRecordDate <= ? 
		GROUP BY ST.studentNo, ST.studentFirstName, ST.studentLastName";
				


		$num = 0;	

		
		if($stmt = $conn->prepare($sql)){

			$stmt->bind_param("sss", $subject, $sDate, $eDate);
			
		 if($stmt->execute())
		 {
			
			$result = $stmt->get_result();
  
			if($result->num_rows >= 0)
			{
				while($row = $result->fetch_assoc()) 
				{
					
					$num = $num +1;
					$data[] = array($num, $row['studentNumber'], $row['studentLastName'], $row['studentFirstName'], $row['Attendance']);
				}
			}
		 }
		 
		}
		else
		{
			echo "sql failed";
		}
	
	
	$pdf = new PDF();
	$pdf -> addPage();
		
		
	$pdf->SetFont('Arial','B',16);
	$pdf->SetTextColor(119, 119, 119);
	$pdf->Cell(130 ,5,'',0,0);
	$pdf->Cell(100 ,5,'Attendance Report',0,0,'');
		
		
	$pdf->Cell(59 ,5,'',0,1);
	$pdf->Cell(130 ,5,'',0,0);
	$pdf->SetFont('Arial','B',9);
	$pdf->Cell(130 ,5,'',0,1);
	$header = array('#', 'student Number', 'First Name', 'Last Name', 'Days Attended');
		
		$pdf->FancyTable($header, $data);
		$pdf->Cell(130 ,5,'',0,1);
		$pdf->SetFont('Arial','B',10);
		$pdf->SetTextColor(119, 119, 119);
		
		//ob_end_clean();
		
		$pdf->output();
?>