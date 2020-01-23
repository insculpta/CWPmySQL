<?php
$con = mysqli_connect("140.114.55.208","newuser","Tt12345678","postui");
$id = $_POST['id'];
$employee = $_POST['employee'];
$date = $_POST['date'];
$work = $_POST['work'];
$sql = "insert into AbsentNote values ('$id', '$employee', '$date', '$work');";
if(mysqli_query($con, $sql)){
echo 'success';
}
else{
echo 'try again';
}
mysqli_close($con);
?>