<?php
	
	include "00_conn.php";

	$userid = $_POST['userid'];
	$userpass = $_POST['userpass'];
	$username = $_POST['username'];
	$useremail = $_POST['useremail'];
	$userphone = $_POST['userphone'];

	## 우편번호는??
	# 123-456 무슨동 어느아파트...
	
	$post1 = $_POST['post1'];
	$post2 = $_POST['post2'];
	$add1 = $_POST['add1'];
	$add2 = $_POST['add2'];

	$address = $post1."-".$post2." ".$add1.$add2;

	# 값이 넘어오는지 확인하기
	# echo "출력: ".$username;

	# 대입되는 공간이 빈칸이 아닌경우 입력받기
	if( !empty($userid) && !empty($userpass) && !empty($username) && !empty($useremail) && !empty($userphone) ){
		$sql = "INSERT INTO members (userid, userpass, username, useremail, userphone, address) VALUES
		('$userid', '$userpass', '$username' , '$useremail', '$userphone', '$address' )";
		
		$result = mysqli_query($conn, $sql ) or die( mysqli_error() );
	}
	
	/*
		row[0] == 1
		$result == true
			+ true 생략가능
		
		$result
	*/

	if($result){
		echo "<p style='text-align:center; color:blue;'>회원가입에 성공했습니다.</p>";
		echo "<meta http-equiv='Refresh'  content='1; url=login.php'/>   ";
	}
	else{
		echo "<p style='text-align:center; color:red;'>회원가입에 실패했습니다.</p>";
	}





?>