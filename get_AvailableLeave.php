<?php 
/* 
	$link = mysqli_connect("140.114.55.208","newuser","Tt12345678","postui");
	$json = file_get_contents('php://input'); 	
	$obj = json_decode($json,true);

	$EmployeeID = $obj['EmployeeID'];	
	

	$link -> set_charset("UTF8");
	$result = mysqli_query($link,"SELECT AvailableLeave.DueDate,AvailableLeave.Avaliable, LeaveCode.Remark, FROM AvailableLeave INNER JOIN LeaveCode ON AvailableLeave.LeaveID = LeaveCode.LeaveID");
	
	//SELECT availableleave.EmployeeID, AvailableLeave.LeaveID, AvailableLeave.DueDate, AvailableLeave.Available, LeaveCode.Remark, 
	//FROM AvailableLeave INNER JOIN LeaveCode ON (AvailableLeave.LeaveID = LeaveCode.LeaveID)AND(AvailableLeave.EmployeeID = '$EmployeeID')
	
	
	while ($res = mysqli_fetch_assoc($result))
	{
		$output[] = $res;
	}
//	print(json_encode($output,JSON_UNESCAPED_UNICODE));
		if (isset($output)){
		print(json_encode($output,JSON_UNESCAPED_UNICODE));

	}
	else{
		print(json_encode('No AvailableLeave'));
		
	}
	$link -> close();	

	 */

	$link = mysqli_connect("140.114.55.208","newuser","Tt12345678","postui");
	$json = file_get_contents('php://input'); 	
	$obj = json_decode($json,true);

	$EmployeeID = $obj['EmployeeID'];	
	
	$link -> set_charset("UTF8");
	$result = mysqli_query($link,"SELECT task.TaskID, task.OfficeID, Office.OfficeName, task.EmployeeID, task.Date, 
	task.TaskCode, task.TaskName, task.Group, task.StartTime, task.EndTime, task.MidRestStart, task.MidRestEnd, task.Vehicle, task.Typhoon
	FROM task INNER JOIN Office ON (task.OfficeID = Office.OfficeID)AND(task.EmployeeID = '$EmployeeID')");
		
	
	while ($res = mysqli_fetch_assoc($result))
	{
		$output[] = $res;
	}
//	print(json_encode($output,JSON_UNESCAPED_UNICODE));
		if (isset($output)){
		print(json_encode($output,JSON_UNESCAPED_UNICODE));

	}
	$link -> close();	



?>