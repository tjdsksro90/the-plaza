<?php

	include "00_conn.php";

	$userid	= $_POST['userid'];
	$userpass = $_POST['userpass'];

	# echo "넘어오는 아이디확인 : ".$userid;
	
	$sql = "SELECT * FROM members WHERE userid='$userid' 
	AND userpass='$userpass' ";

	$result = mysqli_query($conn, $sql);


	# 3) 데이터가 있는지 확인하기!
	$row = mysqli_fetch_array($result);

	# 4) 출력이 되는지 확인하기!
	# echo $row['userid'];

	if( $row['userid'] == $userid && $row['userpass'] == $userpass ){
		
		/*
			순서중요!
				출력문을 먼저 띄우면 아래의 값을 읽지 못하고 수식이 끝남!

			+ session 사용하기
				: 서버에 자료 남기기 위한 선언
		*/	
		session_start();
		$_SESSION['userid'] = $userid;

		echo "<p style='text-align:center; color:#f00;'> '회원인증' 이 완료되었습니다. </p>";
	}
	else{
		echo "<script> alert('아이디 또는 비밀번호가 일치하지 않습니다.'); 
		history.go(-1); </script>";
	}

	mysqli_close( $conn );
	echo "<meta http-equiv='Refresh' content='1; url=list.php' />";

?>