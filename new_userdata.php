<?php 

	$link = mysqli_connect("140.114.54.22","newuser","123","data");
	$json = file_get_contents('php://input'); 	
	$obj = json_decode($json,true);

	$account = $obj['account'];	
	$password = $obj['password'];
	
	
/* 	if($obj['account']!=""){
		
	$CheckAccountSQL = "SELECT * FROM staff_info where account='$account'";
	$CheckSQL = "SELECT name FROM staff where account='$account' and password='$password'";
	
	$account_result = mysqli_fetch_array(mysqli_query($con,$CheckAccountSQL));
	// Executing SQL Query. */


	$link -> set_charset("UTF8");
	$result = mysqli_query($link,"SELECT * FROM staff_info where account='$account' and password='$password'");
	while ($res = mysqli_fetch_assoc($result))
	{
		$output[] = $res;
	}
	print(json_encode($output,JSON_UNESCAPED_UNICODE));
	$link -> close();

?>