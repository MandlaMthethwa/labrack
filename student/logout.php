<?php
	session_start();
	unset($_SESSION['s_login']);
	
	if(session_destroy())
	{
		header("Location: student_login.php");
	}
?>