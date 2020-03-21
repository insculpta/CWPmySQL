<?php 

/*
	$link = mysqli_connect("140.114.55.208","newuser","Tt12345678","postui");
	//$link = mysqli_connect("140.114.54.22","newuser","123","data");
	//$link = mysqli_connect("192.168.1.170","newuser","123","data");
	$json = file_get_contents('php://input'); 	
	$obj = json_decode($json,true);

	$EmployeeID = $obj['EmployeeID'];	
	
	if (mysqli_connect_errno($link)) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  print(json_encode('Failed to connect'));
	  
	  }


	$link -> set_charset("UTF8");
	$result = mysqli_query($link,"SELECT * FROM absentNote where absentNote.EmployeeID='$EmployeeID'");
		
	//absentnote.AbsentNoteID,absentnote.EmployeeID,absentnote.LeaveID,absentnote.StartDate,absentnote.EndDate,absentnote.ApplicationDate,absentnote.Remark,absentnote.Audited,absentnote.Approve,leavecode.Remark FROM absentnote INNER JOIN leavecode ON (absentnote.LeaveID = leavecode.LeaveID)");
	//$result = mysqli_query($link,'absentnote.AbsentNoteID, absentnote.EmployeeID, absentnote.LeaveID, absentnote.StartDate, absentnote.EndDate, absentnote.ApplicationDate, absentnote.Remark, absentnote.Audited, absentnote.Approve, employee.EmployeeName FROM absentnote INNER JOIN employee ON (absentnote.EmployeeID = Employee.EmployeeID)AND(absentNote.EmployeeID='$EmployeeID')');
	
	if($result){
	print(json_encode('Get successfully'));
	
	while ($res = mysqli_fetch_assoc($result))
	{
		$output[] = $res;
		
		
	};

	if (isset($output)){
		print(json_encode($output,JSON_UNESCAPED_UNICODE));
		
	};
	
	}
	else{
	print(json_encode('try again'));
	}
	
	
	$link -> close();	
*/

	//$link = mysqli_connect("140.114.55.208","newuser","Tt12345678","postui");
	$link = mysqli_connect("140.114.54.22","newuser","123","data");
	//$link = mysqli_connect("192.168.1.170","newuser","123","data");
	$json = file_get_contents('php://input'); 	
	$obj = json_decode($json,true);

	$EmployeeID = $obj['EmployeeID'];	
	
	if (mysqli_connect_errno($link)) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  print(json_encode('Failed to connect'));
	  
	  }


	$link -> set_charset("UTF8");
	$result = mysqli_query($link,"SELECT * FROM absentNote ");
	//$result = mysqli_query($link,"SELECT absentnote.AbsentNoteID, absentnote.EmployeeID, absentnote.LeaveID, absentnote.StartDate, absentnote.EndDate, absentnote.ApplicationDate, absentnote.Remark, absentnote.Audited, absentnote.Approve, employee.EmployeeName FROM absentnote INNER JOIN employee ON (absentnote.EmployeeID = employee.EmployeeID)");
	
	
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