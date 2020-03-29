<?php 

	$serverName = "140.114.55.208"; //serverName
    $connectionInfo = array( "Database"=>"DLGQAI01", "UID"=>"postui", "PWD"=>"post123456","CharacterSet" => "UTF-8");
    $link = sqlsrv_connect( $serverName, $connectionInfo);
	
	$json = file_get_contents('php://input'); 	
	$obj = json_decode($json,true);


	$OfficeID = $obj['OfficeID'];		
	
	if ($link === false) {
      echo "Failed to connect to MySQL: " . sqlsrv_errors();
	  print(json_encode('Failed to connect')); 
	}


	$sql = 'SELECT absentnote.AbsentNoteID, absentnote.EmployeeID, absentnote.LeaveID, convert(varchar, absentnote.StartDate, 120)as StartDate , 
	convert(varchar, absentnote.EndDate, 120)as EndDate , convert(varchar, absentnote.ApplicationDate, 120)as ApplicationDate,  absentnote.Remark, absentnote.Audited, absentnote.Approve, 
	shiftschedule.OfficeID,shiftschedule.TaskID FROM dbo.absentnote RIGHT OUTER JOIN dbo.shiftschedule ON
	absentnote.EmployeeID = shiftschedule.EmployeeID where shiftschedule.OfficeID = (?)';
	
	
	$param = array($OfficeID);
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