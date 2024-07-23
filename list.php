<?php
	
	include "00_conn.php";

	session_cache_expire(30);
	session_start();

	$sql = "SELECT * FROM freeboard ORDER BY no DESC";
	$result = mysqli_query($conn, $sql);

	$sqlCount = "SELECT COUNT(*) FROM freeboard";
	$count = mysqli_query($conn, $sqlCount);
	$rowCnt = mysqli_fetch_array($count);
	#echo "총갯수: ".$rowCnt[0];
	
?>
<!DOCTYPE html>
<html lang="ko">
 <head>
  <meta charset="utf-8"/>
  <title> list </title>
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1"/>
  <link href="https://fonts.googleapis.com/css?family=Noto+Sans" type="text/css" rel="stylesheet"/>
  <link rel="shortcut icon" href="img/icon_home.ico"/>
  <link rel="apple-touch-icon" href="img/icon_home.ico"/>
  <link rel="stylesheet" type="text/css" href="css/reset.css"/>
  <link rel="stylesheet" type="text/css" href="css/headerFooter.css"/>
  <script src="js/jquery-1.12.4.js"></script>
  <style>
	#container{font:12px/1.2em "Malgun Gothic";background-image:url("img/blur.jpg"); background-position:center; overflow:hidden;}
	#section{ width:940px; background-color:#fff; margin:50px auto; padding:100px;}
	#section h3{ text-align:center; font-size:25px; color:#ddd; text-transform:uppercase; padding-bottom:50px;}
	#section a:link, #section a:visited{ color:#333; text-decoration:none; }
	#section a:hover, #section a:focus{ color:rgba(60,22,80,1); text-decoration:underline;}

	#link{ width:100%; text-align:right; padding:10px 0; }
	#link a{ padding:0 8px; color:#000; text-shadow:1px 1px 3px rgba(0,0,0,0.2); display:inline-block;}
	#link a:hover, #link a:focus{ background-color:rgba(60,22,80,1); color:#fff;}

	#freeboard{ width:100%; line-height:22px; font-size:14px;}
	#freeboard caption{ display:none; }
	#freeboard th, #freeboard td{padding:10px; border-bottom:1px solid #eee;}
	#freeboard th{ background-color:#f5f5f5; color:<form action="https://www.google.co.kr/search" method="get">; border-right:1px solid #f7f7f7;}

	#freeboard td{ color:#333; padding-left:30px;}
	#freeboard .writeClk td{ border:none;}

	#freeboard .writeClk{ text-align:right;}
	#freeboard .writeClk a{ border:1px solid #ccc; padding:5px 10px; color:#333;}

	#freeboard .writeClk a:hover, #freeboard .writeClk a:focus{ font-weight:700; 
	background-color:rgba(60,22,80,1); color:#fff; text-decoration:none;}
  
  </style>
    <script>
	/*header 제이쿼리 영역(검색,모바일부분) + (infoNav 위치 변경 부분)*/
		jQuery(document).ready(function(){
			jQuery("#search_icon").click(function(){
				jQuery("#search_box").show().css({"display":"inline","width":"208px","opacity":"1"});
			});
			jQuery("#mobHeaderX").hide();
			jQuery("#mobHeader").click(function(){
				jQuery("#gnb_area, #infoNav_area").css({"left":"0"});
				jQuery("#mobHeaderX").show(1000);
			});
			jQuery("#mobHeaderX").click(function(){
				jQuery("#gnb_area, #infoNav_area").css({"left":"-700px"});
				jQuery("#mobHeaderX").hide();
			});
		
		//창크기 변화 감지
			$( window ).resize(function() {
			  var windowWidth = $( window ).width();
				if(windowWidth < 768) {
					//창 가로 크기가 500 미만일 경우 
					$("#gnb_subBg,.gnb_subArea").hide();
					$("#gnb_area li").mouseover(function(){
						$(this).children(".gnb_subArea").stop().slideDown(500);
					}).mouseout(function(){
						$(this).children(".gnb_subArea").stop().slideUp(500);
					});
				} else {
					//창 가로 크기가 500보다 클 경우
					$(".gnb_subArea, #gnb_subBg").hide();
					$("#gnb_area ul").mouseover(function(){
						$(".gnb_subArea, #gnb_subBg").stop().slideDown(500);
					}).mouseout(function(){
						$(".gnb_subArea, #gnb_subBg").stop().slideUp(500);
					});
				}
			}).resize();

		/*########### 적용할 영역 #############*/
			header = $("#header");
			gnb = $("#gnb");
			gnb_area = $("#gnb_area");
			infoNav = $("#infoNav");

			wrapMarginT = parseInt($("#wrap").css("marginTop"));

			headerH = $("#header").height();
			headH = wrapMarginT + headerH;
			infoNavH = $("#infoNav").height();

		/*########### 스크롤의 위치값 ############*/

			$(window).scroll(function(){
				var nowScroll = $(document).scrollTop();

				if(nowScroll >= headH){
					header.addClass("fixed");
				}
				else{
					header.removeClass("fixed");
				}
				console.log(nowScroll);
				console.log(infoNavH);
				if(nowScroll >= infoNavH){
					$('#infoNav_area').stop().animate({"right":"-450px"},500);
					$('#scrollHeader').stop().animate({"top":"30px","opacity":"1"},500);
					$('#scrollHeader').click(function(){
						$('#infoNav_area').stop().animate({"right":"50px"},500);
                        $(this).stop().animate({"top":"-130px","opacity":"0"},500);
					});
				}
				else{
					$('#infoNav_area').stop().animate({"right":"50px"},500);
					$('#scrollHeader').stop().animate({"top":"-130px","opacity":"0"},500);
				}
			});
		});

	/*#############*/
  </script>
 </head>
 <body>
	<div class="plaza_index">
		<a class="plaza_link" href="sub_intro_1.html">
			<span>THE PLAZA</span>
		</a>
		<a class="plaza_link" href="reservation.html">
			<span>RESERVATION</span>
		</a>
		<a class="plaza_link" href="sub_special_1.html">
			<span>SPECIAL</span>
		</a>
		<a class="plaza_link" href="sub_room_all.html">
			<span>ROOM</span>
		</a>
		<a class="plaza_link" href="sub_dining_all.html">
			<span>DINING</span>
		</a>
		<a class="plaza_link" href="sub_membership.html">
			<span>MEMBERSHIP</span>
		</a>
	</div>
	<div id="wrap">
		<header id="header">
			<div id="infoNav">
				<h1>
					<a href="index.html" title="index">
						<img src="img/tit_bg_main.png" alt="THE PLAZA"/>
					</a>
				</h1>
				<div id="infoNav_area">
					<h5>infoNav</h5>
					<ul class="weather_info">
						<li><a href="#" title="SEOUL">SEOUL</a></li>
						<li><a href="#" title="11:09PM">11:09PM</a></li>
						<li><a href="#" title="흐림 12.7ºC">흐림 12.7ºC</a></li>
					</ul>
					<ul class="user_info">
						<li><a href="login.html" title="LOGIN">LOGIN</a></li>
						<li><a href="join_form.html" title="JOIN">JOIN</a></li>
					</ul>
					<select class="lang_info">
						<option value="kor">KOREAN</option>
						<option value="eng">ENGLISH</option>
					</select>
				</div>
			</div>
			<nav id="gnb">
				<div id="gnb_area">
				<h5>gnb</h5>
					<ul>
						<li>
							<h6>더 플라자</h6>
							<a class="gnb_areaA" href="sub_intro_1.html" title="더 플라자">더 플라자</a>
							<span class="bar">|</span>
							<div class="gnb_subArea">
								<div class="gnb_sub">
									<a href="sub_intro_1.html" title="브랜드 소개">브랜드 소개</a>
								</div>
								<div class="gnb_sub">
									<a href="sub_intro_2_reward.html" title="수상이력">수상이력</a>
								</div>
								<div class="gnb_sub">
									<a href="sub_ready.html" title="오시는 길">오시는 길</a>
								</div>
								<div class="gnb_sub">
									<a href="sub_ready.html" title="여행 가이드">여행 가이드</a>
								</div>
								<div class="gnb_sub">
									<a href="sub_ready.html" title="공지뉴스">공지뉴스</a>
								</div>
							</div>
						</li>
						<li>
							<h6>스폐셜 오퍼</h6>
							<a class="gnb_areaA" href="sub_special_1.html" title="스폐셜 오퍼">스폐셜 오퍼</a>
							<span class="bar">|</span>
							<div class="gnb_subArea">
								<div class="gnb_sub">
									<a href="sub_special_1.html" title="패키지 and 프로모션">패키지 &amp; 프로모션</a>
								</div>
								<div class="gnb_sub">
									<a href="sub_special_2.html" title="더 플라자 이숍">더 플라자 이숍</a>
								</div>
							</div>
						</li>
						<li>
							<h6>객실</h6>
							<a class="gnb_areaA" href="sub_room_all.html" title="객실">객실</a>
							<span class="bar">|</span>
							<div class="gnb_subArea">
								<div class="gnb_sub">
									<a href="sub_room_all.html" title="전체보기">전체보기</a>
								</div>
								<div class="gnb_sub">
									<a href="sub_room_1_deluxe_room.html" title="룸 and 스위트">룸 &amp; 스위트</a>
								</div>
								<div class="gnb_sub">
									<a href="sub_room_7_royal_room.html" title="클럽라운지">클럽라운지</a>
								</div>
							</div>
						</li>
						<li>
							<h6>다이닝</h6>
							<a class="gnb_areaA" href="sub_dining_all.html" title="다이닝">다이닝</a>
							<span class="bar">|</span>
							<div class="gnb_subArea">
								<div class="gnb_sub">
									<a href="sub_dining_all.html" title="전체보기">전체보기</a>
								</div>
								<div class="gnb_sub">
									<a href="sub_dining_all.html" title="레스토랑 and 바">레스토랑 &amp; 바</a>
								</div>
								<div class="gnb_sub">
									<a href="sub_dining_all.html" title="베이커리">베이커리</a>
								</div>
							</div>
						</li>
						<li>
							<h6>웨딩 &amp; 연회</h6>
							<a class="gnb_areaA" href="#none" title="웨딩 n 연회">웨딩 &amp; 연회</a>
							<span class="bar">|</span>
							<div class="gnb_subArea">
								<div class="gnb_sub">
									<a href="#none" title="전체보기">전체보기</a>
								</div>
								<div class="gnb_sub">
									<a href="#none" title="웨딩">웨딩</a>
								</div>
								<div class="gnb_sub">
									<a href="#none" title="연회">연회</a>
								</div>
								<div class="gnb_sub">
									<a href="#none" title="패밀리 파티">패밀리 파티</a>
								</div>
								<div class="gnb_sub">
									<a href="#none" title="케이터링 서비스">케이터링 서비스</a>
								</div>
							</div>
						</li>
						<li>
							<h6>부대시설</h6>
							<a class="gnb_areaA" href="#none" title="부대시설">부대시설</a>
							<span class="bar">|</span>
							<div class="gnb_subArea">
								<div class="gnb_sub">
									<a href="#none" title="비즈니스 센터">비즈니스 센터</a>
								</div>
								<div class="gnb_sub">
									<a href="#none" title="휘트니스클럽">휘트니스클럽</a>
								</div>
								<div class="gnb_sub">
									<a href="#none" title="더벨스파">더벨스파</a>
								</div>
								<div class="gnb_sub">
									<a href="#none" title="지스텀">지스텀</a>
								</div>
								<div class="gnb_sub">
									<a href="#none" title="기프트샵">기프트샵</a>
								</div>
							</div>
						</li>
						<li>
							<h6>멤버십</h6>
							<a class="gnb_areaA" href="sub_membership.html" title="멤버십">멤버십</a>
							<span class="bar">|</span>
						</li>
						<li>
							<h6>온라인 컨시어지</h6>
							<a class="gnb_areaA" href="sub_online_news.html" title="온라인 컨시어지">온라인 컨시어지</a>
							<div class="gnb_subArea">
								<div class="gnb_sub">
									<a href="#none" title="호텔 연락처">호텔 연락처</a>
								</div>
								<div class="gnb_sub">
									<a href="sub_ready.html" title="층별안내">층별안내</a>
								</div>
								<div class="gnb_sub">
									<a href="#none" title="자주하는 질문">자주하는 질문</a>
								</div>
								<div class="gnb_sub">
									<a href="sub_ready.html" title="문의하기">문의하기</a>
								</div>
								<div class="gnb_sub">
									<a href="#none" title="관광 컨시어시">관광 컨시어시</a>
								</div>
								<div class="gnb_sub">
									<a href="sub_ready.html" title="고객의 소리">고객의 소리</a>
								</div>
								<div class="gnb_sub">
									<a href="#none" title="온라인 뉴스레터">온라인 뉴스레터</a>
								</div>
							</div>
						</li>
					</ul>
				</div>
				<div id="gnb_subBg">
				</div>
				<!--https://search.naver.com/search.naver?sm=nnf_hty&query={query}&x=0&y=0-->
				<div id="search_area">
					<form action="https://www.google.co.kr/search" method="get">
						<fieldset>
							<legend>검색부분</legend>
							<input id="search_box" type="text" name="q" autocomplete="off"  title="search" placeholder="search"/>
							<input id="search_icon" type="button" name="search_icon" title="serach_icon" value="버튼"/>
							<a href="reservation.html" title="예약" id="reservation">
								<span class="img">
									<img src="img/table_icon.svg" alt="예약 이미지"/>
								</span>
								<span class="text">
									예약하기
								</span>
							</a>
						</fieldset>
					</form>
				</div>
			</nav>
			<div id="mobHeader">
				<p>
					<span>─</span>
					<span>─</span>
					<span>─</span>
				</p>
			</div>
			<div id="mobHeaderX">
			</div>
			<div id="scrollHeader">
				<p>
					<span class="scroll_1">─</span>
					<span class="scroll_2">─</span>
					<span class="scroll_3">─</span>
				</p>
			</div>
		</header>
		<div id="container">
			<div id="section">
				<h3>Free Board Produce</h3>
				<div id="link">
					<span>*</span><a href="#" title="home">HOME</a>

			<?php if( empty($_SESSION['userid'] )  ){?>
					<span>*</span><a href="#" title="login">LOGIN</a>
			<?php }else{   ?>		
					<strong style='color:#f09;'><?=$_SESSION['userid']?></strong> 님 환영합니다.
					<span>*</span><a href="logout.php" title="logout">LOGOUT</a>
			<?php } echo "<meta http-equiv='Refresh' content='60; url=03_01_logout.php'/>" ?>


					<span>*</span><a href="#" title="join">JOIN</a>
				</div>
				<table id="freeboard" title="게시판 제작">
					<caption>FREE BOARD</caption>
					<colgroup>
						<col width="10%">
						<col width="52%">
						<col width="13%">
						<col width="15%">
						<col width="10%">
					</colgroup>
					<thead>
						<tr>
							<th scope="col">번호</th>
							<th scope="col">제목</th>
							<th scope="col">글쓴이</th>
							<th scope="col">작성일</th>
							<th scope="col">조회수</th>
						</tr>
					</thead>
					<tbody>

			<?php 
				$cnt=0;
				while( $row = mysqli_fetch_array($result) ){
			?>
						<tr>
							<td><a href="read.php?no=<?=$row['no']?>" title="no"><?=$rowCnt[0]-$cnt?></a></td>
							<td><a href="read.php?no=<?=$row['no']?>" title="title"><?=$row['title']?></a></td>
							<td><?=$row['name']?></td>
							<td><?=$row['wdate']?></td>
							<td><?=$row['view']?></td>
						</tr>

			<?php  $cnt++; } ?>


						<tr class="writeClk">
							<td colspan="5">
			<?php if( empty($_SESSION['userid']) ){ ?>
								<a href="login.php" title="로그인">로그인</a>
			<?php } else{ ?>
								<a href="write.php" title="글쓰기">글쓰기</a>
			<?php }?>		
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div><!--container 닫는 부분-->
		<footer id="footer">
			<div id="footerArea">
				<div class="footerLogo">
					<p class="bottomLogo1">
						<a href="https://www.hoteltheplaza.com/kr/" title="footer logo1">
							<img src="img/footer_logo1.png" alt="footer logo1"/>
						</a>
					</p>
					<p class="bottomLogo2">
						<a href="https://autograph-hotels.marriott.com/" title="footer logo2">
							<img src="img/footer_logo2.png" alt="footer logo2"/>
						</a>
					</p>
					<p class="bottomLogo2">
						<a href="https://www.marriott.co.kr/rewards/rewards-program.mi" title="footer logo3">
							<img src="img/footer_logo3.png" alt="footer logo3"/>
						</a>
					</p>

				</div>
				<div class="footerDesc">
					<div class="footerDesc_fac">
						<ul class="desc">
							<li>
								<a href="https://www.hoteltheplaza.com/kr/footer/sitemap.jsp" title="사이트맵"><span class="text">사이트맵</span></a><span class="bar">|</span>
							</li>
							<li>
								<a href="https://www.hoteltheplaza.com/kr/footer/termsofuse.jsp" title="이용약관"><span class="text">이용약관</span></a><span class="bar">|</span>
							</li>
							<li>
								<a href="https://www.hoteltheplaza.com/kr/footer/personal.jsp" title="개인정보처리방침"><strong class="text">개인정보처리방침</strong></a><span class="bar">|</span>
							</li>
							<li>
								<a href="https://www.hoteltheplaza.com/kr/footer/privacy.jsp" title="영상정보처리기기 운영·관리 방침"><strong class="text">사이트맵</strong></a><span class="bar">|</span>
							</li>
							<li>
								<a href="https://www.hoteltheplaza.com/kr/footer/email_security.jsp" title="이메일무단수집금지"><span class="text">이메일무단수집금지</span></a><span class="bar">|</span>
							</li>
							<li>
								<a href="https://www.hwrc.co.kr/index.asp" title="채용정보"><span class="text">채용정보</span></a><span class="bar">|</span>
							</li>
							<li>
								<a href="https://www.hoteltheplaza.com/_resource/pdf/Sales_Kit_KOR.pdf" title="온라인 브로셔"><span class="text">온라인 브로셔</span></a>
							</li>
						</ul>
						<ul class="sns">
							<li>
								<a href="https://www.facebook.com/theplaza.seoul" title="facebook">
									<span class="icon"><img src="img/facebook.svg" alt="facebook 아이콘"/></span>
								</a>
							</li>
							<li>
								<a href="https://www.instagram.com/theplazaseoul/" title="instagram">
									<span class="icon"><img src="img/instagram.svg" alt="instagram 아이콘"/></span>
								</a>
							</li>
							<li>
								<a href="https://www.tripadvisor.co.kr/Hotel_Review-g294197-d306139-Reviews-THE_PLAZA_Seoul_Autograph_Collection-Seoul.html" title="tripadvisor">
									<span class="icon"><img src="img/tripadvisor-logotype.svg" alt="tripadvisor 아이콘"/></span>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div id="footerCopy">
				<div class="copyArea">
					<address class="adress">
						서울특별시 중구 소공로 119 (우) 04525 TEL 02.771.2200 FAX 02.755.8897 
					</address>
					<address class="copy">
						Copyright © THE PLAZA All Rights Reserved
					</address>
				</div>
			</div>
		</footer>
	</div>
 </body>
</html>
