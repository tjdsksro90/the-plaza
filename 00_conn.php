<?php
	
	header("content-type:text/html; charset=utf-8");
	/*들어가야할 내용*/
	$conn = mysqli_connect("localhost","root","","inboard");
	/*$conn = mysqli_connect("localhost","gmrdlsrkswnl","a1257845","gmrdlsrkswnl");*/
	if( $conn-> connect_error ){
		echo $conn-> connect_errorno;
		exit;
	}
	$conn -> set_charset("utf8");


?>