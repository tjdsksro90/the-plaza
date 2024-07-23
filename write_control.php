<?php
	
	include "00_conn.php";

	$title = $_POST['title'];
	$name = $_POST['name'];
	$email = $_POST['email'];
	$pass = $_POST['pass'];
	$content = $_POST['content'];

	# ip주소받기
	$ipADD = $_SERVER['REMOTE_ADDR'];

	# 입력한 값이 비어있지 않다면 입력받은 값 넘겨주기
	if( !empty($title) && !empty($name) && !empty($email) && !empty($pass) && !empty($content)){
		$sql = "INSERT INTO freeboard (name, email, pass, title, content, wdate, ip) VALUES
		('$name','$email', '$pass', '$title', '$content', now(), '$ipADD' )";

		mysqli_query($conn, $sql) or die( mysqli_errorno() );
	}
	else{
		echo "<script> alert('필수 입력정보를 입력해주세요.'); history.go(-1);</script>";
	}

	mysqli_close( $conn );
	echo "<meta http-equiv='Refresh' content='1; url=list.php' />";

?>