<?php

	$serverName = "140.114.55.208"; //serverName
    $connectionInfo = array( "Database"=>"DLGQAI01", "UID"=>"postui", "PWD"=>"post123456","CharacterSet" => "UTF-8");
    $link = sqlsrv_connect( $serverName, $connectionInfo);
	$json = file_get_contents('php://input','r');
	$obj = json_decode($json,true);
 

	$AbsentNoteID = $obj['AbsentNoteID'];
	
	if ($link === false) {
      echo "Failed to connect to MySQL: " . sqlsrv_errors();
	  print(json_encode('Failed to connect')); 
	}
	
	//確認有該差假的流水號	
	$Checksql = 'SELECT AbsentNoteID FROM dbo.absentNote WHERE AbsentNoteID=(?)';
	$check_param = array($AbsentNoteID);
	$res = sqlsrv_query($link,$Checksql,$check_param);	
	
	
	//傳回的值
	$check = sqlsrv_fetch_array($res,SQLSRV_FETCH_ASSOC);
				
	//刪除的指令
	$sql = 'DELETE From AbsentNote where AbsentNoteID = (?)';
	$param = array($AbsentNoteID);
	
		
	if(isset($check)){
	$result = sqlsrv_query($link,$sql,$param);
	}
	else{
	print(json_encode('No such leave')); 	
	}


	if($result){
	print(json_encode('audit successfully')); 
	}
	else{
	print(json_encode('try again')); 	
	}
	

	sqlsrv_free_stmt($result);  
	sqlsrv_close($link);
?>
