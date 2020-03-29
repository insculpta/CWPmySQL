<?php 


	$serverName = "140.114.55.208"; //serverName
    $connectionInfo = array( "Database"=>"DLGQAI01", "UID"=>"postui", "PWD"=>"post123456","CharacterSet" => "UTF-8");
    $link = sqlsrv_connect( $serverName, $connectionInfo);
	
	$json = file_get_contents('php://input'); 	
	$obj = json_decode($json,true);

	$EmployeeID = $obj['EmployeeID'];	
	
	if ($link === false) {
      echo "Failed to connect to MySQL: " . sqlsrv_errors();
	  print(json_encode('Failed to connect')); 
	}
	
	
	$sql = 'SELECT EmployeeID, EmployeeName, Title, convert(varchar, StartWorkDate, 120) as StartWorkDate,
	convert(varchar, LeaveDate, 120) as LeaveDate, OfficeID, Department, LeaveDay, AlreadyLeaveDay
	FROM dbo.employee where EmployeeID=(?)';
	
	$param = array($EmployeeID);
	$result = sqlsrv_query($link,$sql,$param);	
	
	while ($res = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC))
	{
		$output[] = $res;
	}

	if (isset($output)){
		print(json_encode($output,JSON_UNESCAPED_UNICODE));

	}
	else{		
	print(json_encode('Nothing'));	
	}
	
	sqlsrv_free_stmt($result);
	sqlsrv_close($link);



?>