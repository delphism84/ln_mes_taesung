<?
mysql_connect("localhost","neblog","since1970","neblog") or die ("connect error");
mysql_select_db("neblog");

$query = "select * from ots_installation";
$result = mysql_query($query);
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="generator" content="editplus®">
	<meta name="author" content="">
	<meta name="keywords" content="">
	<meta name="description" content="">
	<title>document</title>
	<!-- latest compiled and minified css -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-bvyiisifek1dgmjrakycuhahrg32omucww7on3rydg4va+pmstsz/k68vbdejh4u" crossorigin="anonymous">

	<!-- optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rhyon1irsvxv4nd0jutlngaslcjuc7uwjduw9svrlvryoopp2bwygmgjqixwl/sp" crossorigin="anonymous">

	<!-- latest compiled and minified javascript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-tc5iqib027qvyjsmfhjomalkfuwvxzxupncja7l2mcwnipg9mgcd8wgnicpd7txa" crossorigin="anonymous"></script>
</head>
<body>
	<div class="col-md-6">
	<table class="table table-bordered">
		<tr>
			<td valign="middle">이미지</td>
			<td valign="middle">시 험 성 적 서<br>(test report)</td>
			<td valign="middle">이미지</td>
		</tr>
	</table>

	<table class="table table-bordered">
		<tr>
			<td colspan="3" valign="middle" bgcolor="#e5e5e5">성적서번호 (document number)</td>
			<td colspan="5" valign="middle" bgcolor="#e5e5e5">검사일 (date of test)</td>
		</tr>
		<tr>
			<td colspan="3" valign="middle">ots-q-(&nbsp;&nbsp; ?&nbsp; ) ?직접기록</td>
			<td colspan="5" valign="middle">2017-07-12 날짜 자동 처리</td>
		</tr>
		<tr>
			<td colspan="3" valign="middle" bgcolor="#e5e5e5">모델명 (type of designation)</td>
			<td colspan="5" valign="middle" bgcolor="#e5e5e5">일련번호 (serial number)</td>
		</tr>
		<tr>
			<td colspan="3" valign="middle">al-100a (수정 가능하게)</td>
			<td colspan="5" valign="middle">[ots-al100a]-(&nbsp;&nbsp; ?&nbsp;&nbsp; )&nbsp; ? 직접기록</td>
		</tr>
		<tr>
			<td valign="middle" bgcolor="#e5e5e5">분 류</td>
			<td valign="middle" bgcolor="#e5e5e5">항 목</td>
			<td colspan="5" valign="middle" bgcolor="#e5e5e5">기 준</td>
			<td valign="middle" bgcolor="#e5e5e5">결 과</td>
		</tr>
		<tr>
			<td rowspan="5" valign="middle">전원검사</td>
			<td rowspan="2" valign="middle">오토리프트 전압</td>
			<td colspan="5" valign="middle">전압 측정 시 24±2v 이내일 것</td>
			<td rowspan="2" valign="middle">합 □ /불 □</td>
		</tr>
		<tr>
			<td colspan="2" valign="middle">3회 측정 전압</td>
			<td valign="middle">자동기입v</td>
			<td valign="middle">자동기입v</td>
			<td valign="middle">자동기입v</td>
		</tr>
		<tr>
			<td rowspan="2" valign="middle">오토리프트 전류</td>
			<td colspan="5" valign="middle">전류 측정 시 2000±200ma</td>
			<td rowspan="2" valign="middle">합 □ /불 □</td>
		</tr>
		<tr>
			<td colspan="2" valign="middle">3회 측정 전류</td>
			<td valign="middle">자동기입v</td>
			<td valign="middle">자동기입v</td>
			<td valign="middle"'>자동기입v</td>
		</tr>
		<tr>
			<td valign="middle">전원 상태</td>
			<td colspan="3" valign="middle">적색 점등</td>
			<td colspan="2" valign="middle"></td>
			<td valign="middle">합 □ /불 □</td>
		</tr>
		<tr>
			<td rowspan="5" valign="middle">동작검사</td>
			<td valign="middle">승/하강 동작</td>
			<td colspan="3" valign="middle">승, 하강, 슬립 상태 확인</td>
			<td colspan="2" valign="middle"></td>
			<td valign="middle">합 □ /불 □</td>
		</tr>
		<tr>
			<td rowspan="2" valign="middle">높이설정</td>
			<td colspan="5" valign="middle">제한높이 설정 값 ±5 / 녹색 점등</td>
			<td rowspan="2" valign="middle">합 □ /불 □</td>
		</tr>
		<tr>
			<td colspan="2" valign="middle">3회 측정 카운트 값</td>
			<td valign="middle">자동기입</td>
			<td valign="middle">자동기입</td>
			<td valign="middle">지동기입</td>
		</tr>
		<tr>
			<td valign="middle">접점결합</td>
			<td colspan="5" valign="middle">[하강: 황색 점멸] [승강: 황색 점등]</td>
			<td valign="middle">합 □ /불 □</td>
		</tr>
		<tr>
			<td valign="middle">영상출력</td>
			<td colspan="5" valign="middle">영상출력 확인</td>
			<td valign="middle">합 □ /불 □</td>
		</tr>
		<tr>
			<td rowspan="3" valign="middle">출하검사</td>
			<td valign="middle">외관 청결</td>
			<td colspan="5" valign="middle">오염물 없을 것</td>
			<td valign="middle">합 □ /불 □</td>
		</tr>
		<tr>
			<td valign="middle">스티커 및 라벨</td>
			<td colspan="5" valign="middle">ci, kc, epc, 조달우수제품마크</td>
			<td valign="middle">합 □ /불 □</td>
		</tr>
		<tr>
			<td valign="middle">내용물 확인</td>
			<td colspan="5" valign="middle">볼트류, 카메라플렌지, 매뉴얼, 시험성적서 선택 사항: 유선/무선스위치/제어반</td>
			<td valign="middle">합 □ /불 □</td>
		</tr>
		<tr>
			<td valign="middle">test(기타 사항)</td>
			<td colspan="7" valign="middle">직접 기록</td>
		</tr>
		<tr>
			<td colspan="3" valign="middle">시 험 결 과 (result)</td>
			<td colspan="5" valign="middle"></td>
		</tr>
	</table>
	
	</p>
	<p class=hstyle0 style='line-height:100%;'></p>

	<p class=hstyle0 style='line-height:100%;'><span style='font-size:9.0pt;font-family:"돋움";line-height:100%'>&nbsp;</span></p>

	<p class=hstyle0 style='line-height:100%;'><span style='font-size:8.0pt;font-family:"돋움";line-height:100%'>&nbsp;- 대중소기업 협력재단 성과공유제 공장시험 기준 적용 (높이설정, 접점합, 영상출력)</span></p>

	<p class=hstyle0 style='line-height:100%;'><span style='font-size:8.0pt;font-family:"돋움";line-height:100%'>&nbsp;</span></p>

	<p class=hstyle0 style='line-height:100%;'><span style='font-size:8.0pt;font-family:"돋움";line-height:100%'>&nbsp;- 이 성적서는 (주)오티에스가 제공한 시료에 대한 시험결과이며, 용도외의 사용은 금합니다.</span></p>

	<p class=hstyle0 style='line-height:100%;'><span style='font-size:8.0pt;font-family:"돋움";line-height:100%'>&nbsp;&nbsp;&nbsp;this is certified that the above mentioned products have been tested for producted by ots co,.ltd and forbid the&nbsp;&nbsp;&nbsp;&nbsp; use except for original purpose.</span></p>

	<p class=hstyle0 style='line-height:100%;'><span style='font-size:8.0pt;font-family:"돋움";line-height:100%'><br></span></p>

	<p class=hstyle0 style='line-height:100%;'><span style='font-size:8.0pt;font-family:"돋움";line-height:100%'>&nbsp;- 이 성적서는 (주)오티에스의 승인 없이는 복제 및 재발급이 금지됩니다.</span></p>

	<p class=hstyle0 style='line-height:100%;'><span style='font-size:8.0pt;font-family:"돋움";line-height:100%'>&nbsp;&nbsp;&nbsp;no part of this document may be duplicated or reproduced by any means without the express written permission of&nbsp;&nbsp;&nbsp;&nbsp; ots co,.ltd</span></p>

	<p class=hstyle0 style='line-height:50%;'></p>
	<table class="table table-bordered">
		<tr>
			<td valign="middle">확인(affirmation)</td>
			<td valign="top">검사자 (inspected by)(주)오티에스 생산기술팀(sign)</td>
			<td valign="top"'>승인자 (approved by)(주)오티에스(sign)</td>
		</tr>
	</table>
	<p class=hstyle0 style='line-height:50%;'></p>

	<p class=hstyle0 style='text-align:center;'><span style='font-size:13.0pt;font-family:"휴먼명조";line-height:160%'><br></span></p>

	<p class=hstyle0 style='text-align:center;'><span style='font-size:18.0pt;font-family:"휴먼명조";line-height:160%'>(주)오티에스 생산기술팀</span></p>

	</div>

</body>
</html>