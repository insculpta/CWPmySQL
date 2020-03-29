<?php

	$serverName = "140.114.55.208"; //serverName
    $connectionInfo = array( "Database"=>"DLGQAI01", "UID"=>"postui", "PWD"=>"post123456","CharacterSet" => "UTF-8");
    $link = sqlsrv_connect( $serverName, $connectionInfo);
	$json = file_get_contents('php://input','r'); 	
	$obj = json_decode($json,true);

	$EmployeeID = $obj['EmployeeID'];
	$LeaveID = $obj['LeaveID'];		
	$StartDate = $obj['StartDate'];
	$EndDate = $obj['EndDate'];
	$ApplicationDate = $obj['ApplicationDate'];
	$Remark = $obj['Remark'];
	$Audited = $obj['Audited'];
	$Approve = $obj['Approve'];

	if ($link === false) {
      echo "Failed to connect to MySQL: " . sqlsrv_errors();
	  print(json_encode('Failed to connect')); 
	}

	$sql="INSERT into [absentnote] ( [EmployeeID],[LeaveID],[StartDate],[EndDate],[ApplicationDate],[Remark],[Audited],[Approve] ) values (?,?,?,?,?,?,?,?)"; 
	//$sql = 'insert into absentNote (EmployeeID,LeaveID,StartDate,EndDate,ApplicationDate,Remark,Audited,Approve) values (?,?,?,?,?,?,?,?)';
	//$param = array(905855,$LeaveID,$StartDate,$EndDate,$ApplicationDate,$Remark,$Audited,$Approve);
	//$param = array('905855','S','2020-03-29','2020-03-29','2020-03-29','病假',0,1);
	$param = array($EmployeeID,$LeaveID,$StartDate,$EndDate,$ApplicationDate,$Remark,$Audited,$Approve);
	$result = sqlsrv_query($link,$sql,$param);	



	//$sql = "insert into absentNote (EmployeeID,LeaveID,StartDate,EndDate,ApplicationDate,Remark,Audited,Approve) values ('$EmployeeID','$LeaveID','$StartDate','$EndDate','$ApplicationDate','$Remark','$Audited','$Approve');";
	//$result = mysqli_query($link,$sql);
	
	//$result_sql = 'SELECT * FROM absentNote where EmployeeID=(?)';
	//$result_param = array($EmployeeID);
	//$insert_result =  sqlsrv_query($link,$sql,$param);
		


	/* while ($res = mysqli_fetch_assoc($result))
	{
		$output[] = $res;
	}

	if (isset($output)){
		print(json_encode($output,JSON_UNESCAPED_UNICODE));

	}
	else if (isset($insert_result)){
	   print(json_encode('apply successfully'));
	}

	else{
	   print(json_encode('try again'));
	}

	$link -> close(); */
	
	/* Prepare and execute the query. */  

	if ($result) {  
		//echo "Row successfully inserted.\n";
		print(json_encode('apply successfully'));		
		
	} else {  
		//echo "Row insertion failed.\n"; 
		print(json_encode('try again'));		
		die(print_r(sqlsrv_errors(), true));  
	}  	
	 
	// if(mysqli_query($link, $sql)){
	 // print(json_encode('apply successfully'));
	// }
	// else{
		// ini_set('display_errors', 1);
		// ini_set('display_startup_errors', 1);
		// error_reporting(E_ALL);
	 // print(json_encode('try again'));
	// }
	
	
	sqlsrv_free_stmt($result);
	sqlsrv_close($link);




?>