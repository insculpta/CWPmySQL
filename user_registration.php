<?php
	$con = mysqli_connect("localhost","root","","data");
// Creating connection.
 //$con = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);
 
 // Getting the received JSON into $json variable.
 $json = file_get_contents('php://input','r');
 
 // decoding the received JSON and store into $obj variable.
 $obj = json_decode($json,true);
 
 // Populate User name from JSON $obj array and store into $name.

$id = $obj['id'];
$employee = $obj['employee'];
$date = $obj['date'];
$work = $obj['work'];
//Checking Email is already exist or not using SQL query.
$CheckSQL = "SELECT * FROM test WHERE id='$id'";
 
// Executing SQL Query.
$check = mysqli_fetch_array(mysqli_query($con,$CheckSQL));
 
 
if(isset($check)){
 
 $idExistMSG = 'id Already id, Please Try Again !!!';
 
 // Converting the message into JSON format.
$idExistJson = json_encode($idExistMSG);
 
// Echo the message.
 echo $idExistJson ; 
 
 }
 else{
 
 // Creating SQL query and insert the record into MySQL database table.
$Sql_Query = "insert into test (id, employee, date ,work) values ('$id','$employee','$date','$work')";
 
 
 if(mysqli_query($con,$Sql_Query)){
 
 // If the record inserted successfully then show the message.
$MSG = 'User Registered Successfully' ;
 
// Converting the message into JSON format.
$json = json_encode($MSG);
 
// Echo the message.
 echo $json ;
 
 }
 else{
 
 echo 'Try Again';
 
 }
 }
 mysqli_close($con);
?>