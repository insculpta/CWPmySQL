<?php

$link = mysqli_connect("192.168.1.170","newuser","123","data");
// Creating connection.
 //$con = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);
 // Getting the received JSON into $json variable.
 $json = file_get_contents('php://input','r');
 // decoding the received JSON and store into $obj variable.
 $obj = json_decode($json,true);

$AbsentNoteID = $obj['AbsentNoteID'];	
$EmployeeID = $obj['EmployeeID'];	
$Audited = $obj['Audited'];
$Approve = $obj['Approve'];

if (mysqli_connect_errno($link)) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  print(json_encode('Failed to connect'));
}



//Checking Email is already exist or not using SQL query.
$CheckSQL = "SELECT * FROM absentNote WHERE AbsentNoteID='69'  "; 
// Executing SQL Query.
$check = mysqli_fetch_array(mysqli_query($link,$CheckSQL));

$link -> set_charset("UTF8"); 
$sql = "UPDATE absentNote SET Audited = '$Audited', Approve = '$Approve' where AbsentNoteID = '69';"; 

if($Audited = null ){
	print(json_encode('get audit'));	
}
if($Approve = null ){
	print(json_encode('get approve'));	
}


if(isset($check)){

$result = mysqli_query($link,$sql); 
}
else{
 print(json_encode('No this ID'));
}


	
if(mysqli_query($link, $sql)){
 print(json_encode('audit successfully'));
 print(json_encode($Audited));
}
else{
 print(json_encode('try again'));
}

mysqli_close($link); 



?>






