<?php

include("dbconnect.php");

	$sql = "SELECT * FROM students_register WHERE id = 1";
	$result_get = mysqli_query($conn,$sql);
	
while($rows=mysqli_fetch_array($result_get)) {extract($rows);	
	$json = array('user' => array('name' => $stud_name, 'level' => $stud_level, 'matric' => $stud_matric, 'course' => $stud_course));
	echo json_encode($json);
	}

?>