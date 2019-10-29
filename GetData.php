<?php
	$link = mysqli_connect("140.114.54.22","newuser","123","data");
	$link -> set_charset("UTF8");
	$result = mysqli_query($link,"SELECT * FROM test ");
	while ($res = mysqli_fetch_assoc($result))
	{
		$output[] = $res;
	}
	print(json_encode($output,JSON_UNESCAPED_UNICODE));
	$link -> close();
?>
