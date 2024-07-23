<?php
	
	include "00_conn.php";

	$q = $_REQUEST['q'];
	#1) echo "넘겨받은 값 확인: ".$q;'';

	#2) members에 해당하는 id가 있는지 검색하기
	$memSql = "SELECT * FROM members WHERE userid='$q' ";
	$result = mysqli_query($conn, $memSql);
	
	/*
	  3) 입력된 정보가 있는지 확인하기
		+ phpMyAdmin 을 통해서 정보기입하기
		+ 사용할 테이블 선택하기 (members 선택 )
		+ 상단의 삽입탭 클릭
		+ no를 제외하고 기입! ( 자동증가와 기본키 작성이 되어 있으므로 제외! )
	*/

	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	/*
		정보가 있을때 숫자 1출력이 되는데..
		문제는 blue가 아닌 red가 있어도 정보가 있다고 
		검색이 되기 때문에 숫자로 비교X

		$row[0] == 1
			무조건 값이 있으면 나타남!
		
		+ 정확하게 구현하기 위해서 필드명에서 
		$q와 같은 값이 있는지 확인하기
	*/

	if($row['userid'] == $q){
		echo "<strong style='color:red'>아이디 중복-사용 불가능</strong>";
	}
	else{
		echo "<strong style='color:blue'>아이디 사용가능</strong>";
	}
?>