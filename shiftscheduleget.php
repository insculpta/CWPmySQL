<?php 

	$link = mysqli_connect("140.114.55.208","newuser","Tt12345678","postui");
	//$link = mysqli_connect("140.114.54.22","newuser","123","data");
	//$link = mysqli_connect("192.168.1.170","newuser","123","data");
	$json = file_get_contents('php://input'); 	
	$obj = json_decode($json,true);

	$OfficeID = $obj['OfficeID'];
	
	if (mysqli_connect_errno($link)) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  print(json_encode('Failed to connect'));
	  
	  }


	$link -> set_charset("UTF8");
	$query = "SELECT * FROM shiftschedule where OfficeID = '$OfficeID'";
	
	if($result = mysqli_query($link,$query)){
	
	while ($res = mysqli_fetch_array($result,MYSQLI_ASSOC))
	{
		$output[] = $res;
	}
	
	mysqli_free_result($result);
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