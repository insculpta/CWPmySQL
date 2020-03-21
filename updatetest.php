<?php

//$con = mysqli_connect("140.114.55.208","newuser","Tt12345678","postui");
//$con = mysqli_connect("192.168.1.170","newuser","123","data");
$con = mysqli_connect("140.114.54.22","newuser","123","data");
$json = file_get_contents('php://input','r');
$obj = json_decode($json,true);



$AbsentNoteID = $obj['AbsentNoteID'];
$Audited = $obj['Audited'];
$Approve = $obj['Approve'];

$CheckSQL = "SELECT AbsentNoteID FROM absentNote WHERE AbsentNoteID='$AbsentNoteID'";


if (mysqli_connect_errno($con)) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  print(json_encode('Failed to connect'));
} 
// Executing SQL Query.
$check = mysqli_fetch_array(mysqli_query($con,$CheckSQL));
$Sql_Query = "UPDATE absentNote SET Audited = '$Audited', Approve = '$Approve' where AbsentNoteID = '$AbsentNoteID';";

if(isset($check)){
$result = mysqli_query($con,$Sql_Query);
} 


if(mysqli_query($con,$Sql_Query)){
print(json_encode('audit successfully')); 
}
else{
print(json_encode('try again')); 	
}

mysqli_close($con);
?>