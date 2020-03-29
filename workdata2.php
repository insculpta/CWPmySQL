<?php 
	
	$serverName = "140.114.55.208"; //serverName\instanceName
    $connectionInfo = array( "Database"=>"DLGQAI01", "UID"=>"postui", "PWD"=>"post123456","CharacterSet" => "UTF-8");
    $link = sqlsrv_connect( $serverName, $connectionInfo);
	
	//$link = mysqli_connect("140.114.55.208","postui","post123456","DLGQAI01");
	//$link = mssql_connect('140.114.55.208','postui','post123456',);
	
	$json = file_get_contents('php://input'); 	
	$obj = json_decode($json,true);
	
	if ($link === false) {
      echo "Failed to connect to MySQL: " . sqlsrv_errors();
	  print(json_encode('Failed to connect')); 
	}

	$EmployeeID = $obj['EmployeeID'];	
	
	//print(json_encode($obj["OfficeID"]));
	//$link -> set_charset("UTF8");
	//$link -> ini_set('mssql.charset','UTF-8');
	//$result = sqlsrv_query($link,"SELECT * FROM dbo.task where EmployeeID='$EmployeeID'");
	//$result = sqlsrv_query($link,"SELECT * FROM dbo.task");
	
	$sql ='SELECT TaskID, OfficeID, EmployeeID, convert(varchar, Date, 120)as Date, TaskCode, TaskName, [Group], WorkHour,
	convert(varchar, StartTime, 120)as StartTime, convert(varchar, EndTime, 120)as EndTime, convert(varchar, MidRestStart, 120)as MidRestStart,
	convert(varchar, MidRestEnd, 120)as MidRestEnd, Vehicle, OverTime, Typhoon, SecondTaskCode, SalaryOrLeave ,LockFlag,Remark	FROM dbo.task where EmployeeID= (?) ';
	
	$param = array($EmployeeID);
	$result = sqlsrv_query($link,$sql,$param);
	//phpinfo();	
	
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