<?php 

	$con = mysqli_connect("140.114.54.22","newuser","123","data");
	$json = file_get_contents('php://input'); 	
	$obj = json_decode($json,true);

	$account = $obj['account'];	
	$password = $obj['password'];
	
	
	
		
	$CheckAccountSQL = "SELECT * FROM  staff_info where account='$account'";
	$CheckSQL = "SELECT * FROM staff_info where account='$account' and password='$password'";
	
	$account_result = mysqli_fetch_array(mysqli_query($con,$CheckAccountSQL));
	// Executing SQL Query.
	$result = mysqli_fetch_array(mysqli_query($con,$CheckSQL));
	
	
		if(isset($result)){
			echo json_encode('Correct');				
		}
		else if (isset($account_result)){
			echo json_encode('Wrong Password');
		}
		else{		
		echo json_encode('Wrong Account');				
		}
		



?>

