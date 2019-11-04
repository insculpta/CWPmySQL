<?php 

	$link = mysqli_connect("140.114.54.22","newuser","123","data");
	$json = file_get_contents('php://input'); 	
	$obj = json_decode($json,true);

	$name = $obj['name'];	
	

	$link -> set_charset("UTF8");
	$result = mysqli_query($link,"SELECT * FROM staff where name='$name'");
		
	
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