<?php
$link = mysqli_connect("192.168.1.170","newuser","123","data");
$json = file_get_contents('php://input'); 	
$obj = json_decode($json,true);

$EmployeeID = $obj['EmployeeID'];
$LeaveID = $obj['LeaveID'];		
$StartDate = $obj['StartDate'];
$EndDate = $obj['EndDate'];
$ApplicationDate = $obj['ApplicationDate'];
$Remark = $obj['Remark'];
$Approve = $obj['Approve'];

if (mysqli_connect_errno($link)) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  print(json_encode('Failed to connect'));
}


$link -> set_charset("UTF8");
$sql = "insert into absentNote (EmployeeID,LeaveID,StartDate,EndDate,ApplicationDate,Remark,Approve) values ('$EmployeeID','$LeaveID','$StartDate','$EndDate','$ApplicationDate','$Remark','$Approve');";


$result = mysqli_query($link,$sql);
$insert_result =  mysqli_fetch_array(mysqli_query($link,"SELECT * FROM absentNote where EmployeeID='$EmployeeID' "));
	

/* while ($res = mysqli_fetch_assoc($result))
{
	$output[] = $res;
}

if (isset($output)){
	print(json_encode($output,JSON_UNESCAPED_UNICODE));

}
else if (isset($insert_result)){
   print(json_encode('apply successfully'));
}

else{
   print(json_encode('try again'));
}

$link -> close(); */
	
 
if(mysqli_query($link, $sql)){
 print(json_encode('apply successfully'));
}
else{
 print(json_encode('try again'));
}
mysqli_close($link); 




?>