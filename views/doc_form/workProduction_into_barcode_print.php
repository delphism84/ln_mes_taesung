<?
//구매입고 바코드 출력
session_start();
require_once('../../connection.php');
require_once('../../library/json.php');
require_once('../../library/function.php');
session_start();
extract($_POST);
extract($_GET);
?>

<?

$sql = "select * from erp_production_into_item where fid=".$uid;
//echo $sql;
$result = mysql_query($sql);
$qty=1;
while($t = mysql_fetch_object($result)) {
	
	$uid=$t->uid; 
	$item_cd[$qty]=$t->item_cd;  
	$item_nm[$qty]=$t->item_nm;  
	$standard1[$qty]=$t->standard1;  
	$unit[$qty]=$t->unit;  
	$lot_no_cd[$qty]=$t->lot_no_cd;  //공정명//,
	$cnt[$qty]=$t->cnt;  //계획시간//,
	
	$query = "select barcode from erp_item where item_cd='".$item_cd[$qty]."' and standard1='".$standard1[$qty]."' ";
	//echo $query;
	$row = mysql_fetch_object(mysql_query($query));
	$barcode[$qty] = trim($row->barcode);
	// 바코드 이미지 가져오기
	$url = "../barcodegen/image.php?code=".$t2->barcode."&style=196&type=C128B&width=167&height=70&xres=1&font=3";
	$img = "<img src='$url'>";
									
	$barcode_img = $img;
	$qty=$qty+1;
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>완제품 바코드 출력</title>
	<meta name="autdor" content="Daniel Arlandis - daniarlandis.es">
	<meta name="description" content="jQuery PrintMe - A jQuery plugin for print any page element ">
	<meta name="viewport" content="widtd=device-widtd">
	<link href="/assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="/assets/css/main.css" rel="stylesheet">

	<script src="/assets/js/jquery.min.js"></script>
	<script src="/assets/js/jquery-printme.js"></script>
	<script src="/assets/js/jquery.printElement.js"></script>
	<script src="/assets/js/jquery.mb.browser.min.js"></script>
	
	<script type="text/javascript">
	$(document).ready(function () {

		$("#example1").click(function(){
			$("#dataexample").printMe();
		});

		$("#example2").click(function(){
			$("#dataexample2").printMe({
				"patd" : ["/assets/css/main.css","/assets/css/example2.css","/assets/css/bootstrap.min.css"]
			});
		});

		$("#example3").click(function(){
			$("#dataexample3").printMe({
				"patd" : ["/assets/css/example.css"],
				"title" : "Document title"
			});
		});


	});
	</script>
	<!-- <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> -->
<script type="text/javascript" src="/assets/js/printPreview.js"></script>
<script type="text/javascript">
        $(function(){
            $("#btnPrintPreview").printPreview({
                obj2print:'#masterContent',
                widtd:'810'
                /*optional properties witd default values*/
                //obj2print:'body',     /*if not provided full page will be printed*/
                //style:'',             /*if you want to override or add more css assign here e.g: "<style>#masterContent:background:red;</style>"*/
                //widtd: '670',         /*if widtd is not provided it will be 670 (default print paper widtd)*/
                //height:screen.height, /*if not provided its height will be equal to screen height*/
                //top:0,                /*if not provided its top position will be zero*/
                //left:'center',        /*if not provided it will be at center, you can provide any number e.g. 300,120,200*/
                //resizable : 'yes',    /*yes or no default is yes, * do not work in some browsers*/
                //scrollbars:'yes',     /*yes or no default is yes, * do not work in some browsers*/
                //status:'no',          /*yes or no default is yes, * do not work in some browsers*/
                //title:'Print Preview' /*title of print preview popup window*/
            });
        });
    </script>
	<script type="text/javascript">
	<!--

	$(document).ready(function() {
		$("#btnPrint").click(function() { //이벤트 발생시킬 버튼 아이디
			printElem({ 
			printMode: 'popup', //팝업설정 printMode option = popup, iframe,
			overrideElementCSS:[ "/assets/css/main.css","/assets/css/example2.css","/assets/css/bootstrap.min.css", { href:'css경로',media:'print' } ], //overrideElement option : boolean, css경로 
			pageTitle:'공정 이동표 출력', //팝업 타이틀
			leaveOpen:true //인쇄하고도 창을 띄우기(true)/안띄우기(false). Default는 false
			});
		});

		$("#btnBarCodePrint").click(function() { //이벤트 발생시킬 버튼 아이디
			alert('전체 BarCode 출력 기능 준비 중입니다.');
			return false;
		});
	});
	  function printElem(options){	
			$('#masterContent').printElement(options); //팝업으로 띄울 영역 Div 아이디
			//$('#masterContent').printElement({}); //미리보기 창 없이 인쇄 
			//$('#masterContent').printElement({ printMode: 'popup' }); //인쇄 후 미리보기 창이 사라짐
			//$('#masterContent').printElement({ leaveOpen: true, printMode: 'popup' });  //인쇄 후 미리보기 창이 남아있음
			//$('#masterContent').printElement({ overrideElementCSS: true }); //CSS무시
			//$('#masterContent').printElement({ overrideElementCSS: ['http://xxxx.com/test.css'] })//외부 CSS적용
      } 

	   function BarcodePrintElem(barcode){	
		    location.href="http://127.0.0.1:49001?printer=barcodedefault&barcode="+barcode;
			alert('전체 BarCode 출력 기능 준비 중입니다.');
			return false;
       } 
	//-->
	</script>

	<style>
	.hr {
		border: none;
		border-top: 1px dotted black;
		color: #fff;
		background-color: #fff;
		height: 1px;
		width: 100%;

		/*Horizontal*/
		background-image: linear-gradient(to right, black 33%, rgba(255,255,255,0) 0%);
		background-position: bottom;
		background-size: 3px 1px;
		background-repeat: repeat-x;
	}
	.hr2 {
		border: none;
		border-left:1px dotted black;
		color: #fff;
		background-color: #fff;
		height: 290px;
		width: 1px;
		vertical-align: top;

		/*Vertical*/
		background-image: linear-gradient(black 33%, rgba(255,255,255,0) 0%);
		background-position: right;
		background-size: 1px 3px;
		background-repeat: repeat-y;
	}

	.table {
    border-spacing: 0;
    border-collapse: collapse;
	}
	.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
		padding: 8px;
		line-height: 1.42857143;
		vertical-align: top;
		border-top: 1px solid #ddd;
	}
	th {
		text-align: left;
	}

	.table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th {
		border: 1px solid #ddd;
	}

	.table-striped>tbody>tr:nth-of-type(odd) {
		background-color: #f9f9f9;
	}
	</style>

</head>
<body>
	
	<!-- Fixed navbar -->
	<div class="panel-body">
		<p>
			<button id="btnPrint" class="btn btn-primary"> Print </button>
			<button id="btnPrintPreview" class="btn btn-primary"> Print 미리보기</button>
			<span style="float:right;vertical-align:bottom;text-decoration:underline;padding-right:20px;padding-top:20px;letter-spacing:1.5px;" >1/2 p<span>
		</p>
		<hr>
	</div>
    <div class="container main">
		<div class="row">
			<div class="col-sm-12">
				<div id="dataexample2">
					<div id="masterContent"> 
							<table cellspacing="0" cellpadding="0" >
							<tbody>
							<?for ($i=1; $i <=$qty-1; $i++){?>
								<?
								if ($barcode[$i]==""){
									$url = "../../assets/images/noimg.gif";
								}else{
									$url = "../../barcodegen/image.php?barcode=".$lot_no_cd[$i];
								}
								if (($i % 2) == 1){
								echo "<tr>\n";
								}?>
									<td style='width:50%;'>
										<table class="table table-bordered" style='width:100%;height:130px;border: 2px solid #000000'>
										<tbody>
											<tr style="height:20px">
												<th class="col-xs-2" colspan="2" style="vertical-align: middle;white-space:nowrap;text-align:center;font-size:16pt;">자재 TAG </th>
											</tr>	
											<tr style="height:70px">
												<th colspan='2' class="col-xs-10 center" style="vertical-align: middle;white-space:nowrap;text-align:center;"><img src='<?=$url?>' ></td>
											</tr>
											<tr>
												<th class="col-xs-2" style="vertical-align: middle;white-space:nowrap"> 자제코드</th>
												<td style="vertical-align: middle;white-space:nowrap"><?=$item_cd[$i]?></td>
											</tr>
											<tr>
												<th class="col-xs-2" style="vertical-align: middle;white-space:nowrap"> 자재명</th>
												<td style="vertical-align: middle;white-space:nowrap"><?=$item_nm[$i]?></td>
											</tr>
											<tr>	
												<th class="col-xs-2" style="vertical-align: middle;white-space:nowrap"> 자재규격</th>
												<td style="vertical-align: middle;white-space:nowrap"><?=$standard1[$i]?></td>
											</tr>
											<tr>	
												<th class="col-xs-2" style="vertical-align: middle;white-space:nowrap"> LOT_NO</th>
												<td style="vertical-align: middle;white-space:nowrap"><?=trim($lot_no_cd[$i])?></td>
											</tr>
											<tr>	
												<th class="col-xs-2" style="vertical-align: middle;white-space:nowrap"> 수량</th>
												<td style="vertical-align: middle;white-space:nowrap"><?=trim($cnt[$i]).$unit[$i]?></td>
											</tr>
										</tbody>
										</table>
									</td>
									<?
									if (($i % 2) == 1){?>
										<td style="width:10px;height:130px; vertical-align: top;marging:0 5px;float:left" align="center" class="col-md-1"><p class='hr2'>&nbsp;</p></td>
									<?}?>
									<?
									if (($i % 2) == 0 ){
										if($i < $qty-1){
											echo "</tr>\n";
											echo "<tr><td colspan='3'><p class='hr'></p></td></tr>\n"; 
										}
									}?>
							<?}?>
							</tbody>
							</table>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>
