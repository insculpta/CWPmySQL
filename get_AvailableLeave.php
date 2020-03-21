<?php 

	$link = mysqli_connect("140.114.55.208","newuser","Tt12345678","postui");
	$json = file_get_contents('php://input'); 	
	$obj = json_decode($json,true);

	$EmployeeID = $obj['EmployeeID'];	
	
	$link -> set_charset("UTF8");
	//$result = mysqli_query($link,"SELECT * FROM availableleave where availableleave.EmployeeID='$EmployeeID'");
	$result = mysqli_query($link,"SELECT availableleave.EmployeeID, availableleave.LeaveID, availableleave.DueDate, 
	availableleave.Available, leavecode.Remark FROM availableleave INNER JOIN leavecode ON 
	(availableleave.LeaveID = leavecode.LeaveID)AND(availableleave.EmployeeID = '$EmployeeID')");

	
	while ($res = mysqli_fetch_assoc($result))
	{
		$output[] = $res;
	}
//	print(json_encode($output,JSON_UNESCAPED_UNICODE));
		if (isset($output)){
		print(json_encode($output,JSON_UNESCAPED_UNICODE));
		

	}
	else{
	print(json_encode('Nothing'));
	}
	$link -> close();	



?>