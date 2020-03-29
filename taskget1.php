<?php

	$serverName = "140.114.55.208"; //serverName
    $connectionInfo = array( "Database"=>"DLGQAI01", "UID"=>"postui", "PWD"=>"post123456","CharacterSet" => "UTF-8");
    $link = sqlsrv_connect( $serverName, $connectionInfo);

	//$link = mysqli_connect("140.114.55.208","newuser","Tt12345678","postui");

	$json = file_get_contents('php://input'); 	
	$obj = json_decode($json,true);
	
	$EmployeeID = $obj['EmployeeID'];
	
	
	if ($link === false) {
      echo "Failed to connect to MySQL: " . sqlsrv_errors();
	  print(json_encode('Failed to connect'));  
	}
	//
	
	//$result = mysqli_query($link,"SELECT task.TaskID, task.OfficeID, Office.OfficeName, task.EmployeeID, task.Date, 
	//task.TaskCode, task.TaskName, task.Group, task.StartTime, task.EndTime, task.MidRestStart, task.MidRestEnd, task.Vehicle, task.Typhoon
	//FROM task INNER JOIN Office ON (task.OfficeID = Office.OfficeID)AND(task.EmployeeID = '$EmployeeID')");
	
	$sql = 'SELECT task.TaskID, task.OfficeID, Office.OfficeName, task.EmployeeID, convert(varchar, task.Date, 120) as Date,
	task.TaskCode, task.TaskName, [Group], convert(varchar, StartTime, 120) as StartTime, convert(varchar, EndTime, 120) as EndTime,
	convert(varchar, MidRestStart, 120)as MidRestStart, convert(varchar, MidRestEnd, 120)as MidRestEnd, task.Vehicle, task.Typhoon
	
	FROM dbo.task INNER JOIN dbo.Office ON task.OfficeID = Office.OfficeID  AND  task.EmployeeID = (?)';
	
	//$sql ='SELECT NewsID,OfficeID, [From], [Content], convert(varchar, Date, 120) as Date, convert(varchar, EndDate, 120) as EndDate FROM dbo.news where OfficeID= (?)';
	$param = array($EmployeeID);
	$result = sqlsrv_query($link,$sql,$param);	
	
	while ($res = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC))
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
	
	sqlsrv_free_stmt($result);
	sqlsrv_close($link);
	
?>

