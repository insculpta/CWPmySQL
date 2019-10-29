<?php
$con = mysqli_connect("140.114.54.22","newuser","123","data");
$id = $_POST['id'];
$employee = $_POST['employee'];
$date = $_POST['date'];
$work = $_POST['work'];
$sql = "insert into test values ('$id', '$employee', '$date', '$work');";
if(mysqli_query($con, $sql)){
echo 'success';
}
else{
echo 'try again';
}
mysqli_close($con);
?>