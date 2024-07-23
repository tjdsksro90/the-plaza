<!doctype html>
<html lang="ko">
 <head>
  <meta charset="utf-8"/>
  <title> join </title>
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1"/>
  <link href="https://fonts.googleapis.com/css?family=Noto+Sans" type="text/css" rel="stylesheet"/>
  <link rel="shortcut icon" href="img/icon_home.ico"/>
  <link rel="apple-touch-icon" href="img/icon_home.ico"/>
  <link rel="stylesheet" type="text/css" href="css/reset.css"/>
  <link rel="stylesheet" type="text/css" href="css/headerFooter.css"/>
  <script src="js/jquery-1.12.4.js"></script>
  <style>
	#container{padding-bottom:100px; background-image:url("img/blur.jpg"); background-position:center;}
		#container form{ width:300px; margin:100px auto 0; box-shadow:3px 3px 20px rgba(0,0,0,0.1); border:1px solid #ccc; border-radius:3px; padding:10px 20px; font-size:12px; background-color:rgba(255,255,255,0.8);
		transition:all 0.3s; }
		#container form:hover{box-shadow:0 0 50px 5px rgba(255,255,255,0.5);}

			#container form legend{ text-align:center;  width:100%; font-size:16px; padding:10px 0; font-weight:700;}
			#container form label{width:80px; background-color:rgba(60,22,80,0.2); display:block; float:left; text-align:center; line-height:27px; border:1px solid #ccc;}
			
			#container form p{ padding:5px 0;}
				#container form input{ width:210px; border:1px solid #ccc; border-left:none; text-indent:10px; height:26px; line-height:26px; vertical-align:bottom;}
					#container form p#button{ width:150px; margin:0 auto;}
						#container form p#button input{display:inline-block; width:60px; height:26px; background-color:#fff; text-indent:0; border-left:1px solid #ccc; }
						#container form p#button input:hover{ background-color:rgba(60,22,80,1); color:#fff; cursor:pointer; }

				#container #IDchkDesc{ width:220px; font-size:12px; height:20px;  float:left; text-align:right; padding:10px 5px; overflow:hidden;}
				#container #IDchkBtn{ width:60px; font-size:12px; text-align:center; text-indent:0; margin:5px 0; background-color:rgba(60,22,80,1); color:#fff;}

				#container #postArea{ width:100%; }
					#container #postArea input{ width:97px; border:1px solid #ccc;}
					#container #postArea #post3{ width:110px; text-indent:5px; display:inline-block;}
					#container #postArea #postBtn{ text-indent:0; width:90px; margin-left:5px;background-color:rgba(60,22,80,1); color:#fff;}

				#container #add1, #container #add2{ width:148px; border:1px solid #ccc;}
				#container #add2{ width:298px;}
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

	 function IDchkBtns(){
		// 1) userid공간을 id 객체로 만들기
		var userid = document.getElementById("userid");
		var IDchkDesc = document.getElementById("IDchkDesc");

		if(userid.value==""){
			alert("아이디가 비어있습니다.");
			userid.focus();
			IDchkDesc.innerHTML="<strong style='color:red;'>아이디 필수입력</strong>";
		}
		else{
			
			xmlhttp = new XMLHttpRequest();	
			xmlhttp.open("GET","02_idDouble.php?q="+userid.value,true);

			xmlhttp.onreadystatechange = function(){
				if(xmlhttp.readyState == 4 && xmlhttp.status == 200 ){
					IDchkDesc.innerHTML = xmlhttp.responseText;
				}
			};
			xmlhttp.send();
		}
	 }
  </script>
	<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
	<script>
		function postcode(){
			new daum.Postcode({
				oncomplete: function(data) {
					document.getElementById("post1").value = data.postcode1;
					document.getElementById("post2").value = data.postcode2;
					document.getElementById("post3").value = data.zonecode;
					document.getElementById("add1").value= data.address;
					document.getElementById("add2").focus();
				}
			}).open();
		}
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
			<form action="join_control.php" method="post">
				<legend>간편 회원가입</legend>
				<p>
					<label for="userid"> 아이디 </label>
					<input id="userid" type="text" name="userid" maxlength="10" placeholder="10자 까지 입력가능"/>
					<span id="IDchkDesc"> ※ 아이디 중복체크 </span>
					<input id="IDchkBtn" type="button" name="IDchkBtn" value="중복체크" onclick="IDchkBtns();"/>
				</p>
				<p>
					<label for="userpass"> 비밀번호 </label>
					<input id="userpass" type="password" name="userpass" placeholder="8자 까지 입력가능" maxlength="8" required/>
				</p>
				<p>
					<label for="username"> 이름 </label>
					<input id="username" type="text" name="username" required/>
				</p>
				<p>
					<label for="useremail"> 이메일 </label>
					<input id="useremail" type="email" name="useremail" required/>
				</p>
				<p>
					<label for="userphone"> 전화번호 </label>
					<input id="userphone" type="tel" name="userphone" pattern="\d{3}-\d{3,4}-\d{4}" placeholder="010-123-4567"  required/>
				</p>

				<p id="postArea">
					<label for="post1">우편번호</label><input id="post1" type="text" name="post1" title="우편번호 앞자리"/> - <input id="post2" type="text" name="post2" title="우편번호 뒷자리"/><br/>
					<input id="post3" type="text" name="post3" title="새로운 우편번호" placeholder="새로운 우편번호"/>
					<input id="postBtn" type="button" value="우편번호찾기" onclick="postcode();"/>
				</p>

				<p>
					<label for="add1">상세주소</label><input id="add1" type="text" name="add1" title="상세주소1"/>
					- <input id="add2" type="text" name="add2" title="상세주소2"/>
				</p>

				<p id="button">
					<input type="submit" value="가입하기" title="가입하기"/> <input type="reset" value="다시작성" title="다시작성"/>
				</p>
			</form>
		</div>
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
