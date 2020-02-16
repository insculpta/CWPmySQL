<?php 

	//$link = mysqli_connect("140.114.55.208","newuser","Tt12345678","postui");
	$link = mysqli_connect("140.114.54.22","newuser","123","data");
	//$link = mysqli_connect("192.168.1.170","newuser","123","data");
	$json = file_get_contents('php://input'); 	
	$obj = json_decode($json,true);

	$EmployeeID = $obj['EmployeeID'];	
	

	$link -> set_charset("UTF8");
	$result = mysqli_query($link,"SELECT * FROM task where task.EmployeeID='$EmployeeID'");
		
	
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