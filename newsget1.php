<?php 

	//$link = mysqli_connect("140.114.55.208","newuser","Tt12345678","postui");
	//$link = mysqli_connect("140.114.55.208","postui","post123456","DLGQAI01");
	$serverName = "140.114.55.208"; //serverName\instanceName
    $connectionInfo = array( "Database"=>"DLGQAI01", "UID"=>"postui", "PWD"=>"post123456","CharacterSet" => "UTF-8");
    $link = sqlsrv_connect( $serverName, $connectionInfo);
	
	$json = file_get_contents('php://input'); 	
	$obj = json_decode($json,true);

	$OfficeID = $obj['OfficeID'];	
	
	if ($link === false) {
      echo "Failed to connect to MySQL: " . sqlsrv_errors();
	  print(json_encode('Failed to connect'));  
	}
	
	$sql ='SELECT NewsID,OfficeID, [From], [Content], convert(varchar, Date, 120) as Date, convert(varchar, EndDate, 120) as EndDate FROM dbo.news where OfficeID= (?)';
	//$sql ='SELECT NewsID,OfficeID,From,Content FROM dbo.news  ';
	//$sql ='SELECT NewsID,OfficeID,Content,convert(varchar, Date, 120) FROM dbo.news where OfficeID= (?) ';
	$param = array($OfficeID);
	$result = sqlsrv_query($link,$sql,$param);

	//$result = sqlsrv_query($link,"SELECT * FROM dbo.news where OfficeID = '$OfficeID' ");
	//$result = mysqli_query($link,"SELECT * FROM dbo.news where OfficeID = '$OfficeID' ");
		
	
	while ($res = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC))
	{
		$output[] = $res;
	}
	
	if (!function_exists('json_last_error_msg')) {
        function json_last_error_msg() {
            static $ERRORS = array(
                JSON_ERROR_NONE => 'No error',
                JSON_ERROR_DEPTH => 'Maximum stack depth exceeded',
                JSON_ERROR_STATE_MISMATCH => 'State mismatch (invalid or malformed JSON)',
                JSON_ERROR_CTRL_CHAR => 'Control character error, possibly incorrectly encoded',
                JSON_ERROR_SYNTAX => 'Syntax error',
                JSON_ERROR_UTF8 => 'Malformed UTF-8 characters, possibly incorrectly encoded'
            );

            $error = json_last_error();
            return isset($ERRORS[$error]) ? $ERRORS[$error] : 'Unknown error';
        }
    }
	
//	print(json_encode($output,JSON_UNESCAPED_UNICODE));
		if (isset($output)){
		print(json_encode($output,JSON_UNESCAPED_UNICODE));
		//echo json_encode(['data' => $output]);

	}
		else{		
	print(json_encode('Nothing'));
	
	}
	
	sqlsrv_free_stmt($result);  
	sqlsrv_close($link);


?>