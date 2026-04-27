<?
session_start();
require_once('../../connection.php');
require_once('../../library/json.php');
require_once('../../library/function.php');
session_start();
extract($_POST);
extract($_GET);
?>

<?

$sql = "select * from erp_product_perf_repost_lotno where uid=".$uid;
//echo $sql;
$result = mysql_query($sql);
$t = mysql_fetch_object($result);
	
	$uid			=$t->uid; //유니크아이디//,
	$production_cd	=$t->production_cd;
	$production_dt	=$t->production_dt;
	$lot_no			=$t->lot_no;
	$day_gubun		=$t->day_gubun;
	$process_cd		=$t->process_cd;
	$process_nm		=$t->process_nm;
	$p_plan_tm		=$t->p_plan_tm;
	$account_cd		=$t->account_cd;
	$account_nm		=$t->account_nm;
	$item_cd		=$t->item_cd;
	$item_nm		=$t->item_nm;
	$output_qty		=$t->output_qty;  //생산실적수량//,
	$publish_qty	=$t->publish_qty;  //라벨필요수량//,
	$box_limit_qty	=$t->box_limit_qty;  //한박스당 수량//,
	$dobeon			=$t->dobeon; 
	$manufacture_dt	=$t->manufacture_dt; 
	$delivery_dt	=$t->delivery_dt;
	$emp_id			=$t->emp_id;  //작업자ID//,
	$regdate		=$t->regdate; //등록일//,

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title> 공정 이동표 출력</title>
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
                width:'900px'
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
		$("[id='btnPrints']").attr("disabled",true);
		setTimeout(function() {
			$("[id='btnPrints']").attr("disabled",false);
		}, 2000);
		$("#btnPrint").click(function() { //이벤트 발생시킬 버튼 아이디
			printElem({ 
			printMode: 'popup', //팝업설정 printMode option = popup, iframe,
			overrideElementCSS:[ "/assets/css/main.css","/assets/css/example2.css","/assets/css/bootstrap.min.css", { href:'css경로',media:'print' } ], //overrideElement option : boolean, css경로 
			pageTitle:'공정 이동표 출력', //팝업 타이틀
			leaveOpen:false //인쇄하고도 창을 띄우기(true)/안띄우기(false). Default는 false
			});
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
		height: 190px;
		width: 1px;
		vertical-align: top;

		/*Vertical*/
		background-image: linear-gradient(black 33%, rgba(255,255,255,0) 0%);
		background-position: right;
		background-size: 1px 3px;
		background-repeat: repeat-y;
	}
	</style>
	<script>
		
		
	</script>
</head>
<body>
	
	<!-- Fixed navbar -->
	<div class="panel-body">
		<p>	<button id="btnPrints" class="btn btn-primary" onclick="window.print()"> Print </button>
			<!-- <button id="btnPrint" class="btn btn-primary"> Print </button> -->
			<button id="btnPrintPreview" class="btn btn-primary"> Print 미리보기</button>&nbsp;&nbsp;<font size="2" color="red">※페이지가 많을 수록 바코드를 불러오는 로딩 시간이 오래 소요 되므로 2초 정도 후 버튼이 활성화 됩니다.</font> 
			<span style="float:right;vertical-align:bottom;text-decoration:underline;padding-right:20px;padding-top:20px;letter-spacing:1.5px;" >1/1 p<span>
		</p> 
		<hr>
	</div>
    <div class="container main" style='width:100%;'>
		<div class="row">
			<div class="col-sm-12">
				<div id="dataexample2">
					<div id="masterContent"> 
							<table cellspacing="0" cellpadding="0">
							<?for ($i=1; $i <=$publish_qty; $i++){?>
								<?
								if ($lot_no==""){
									$url[] = "/barcodegen/image.php?barcode="."TS-LOT".date("Ymdhi",time()).$i;
								}else{
									$url[] = "/barcodegen/image.php?barcode=".$lot_no.($i);
								}
								if (($i % 2) == 1){
								echo "<tr>\n";
								/*
								if ($lot_no==""){
									$url[] = "/library/barcodegen.1d-php.v6.0.0/example/html/image.php?filetype=PNG&dpi=72&scale=1&rotation=0&font_family=Arial.ttf&font_size=8&thickness=30&start=NULL&code=BCGcode128&text="."TS-LOT".date("Ymdhi",time()).$i;
									
								}else{
									$url[] = "/library/barcodegen.1d-php.v6.0.0/example/html/image.php?filetype=PNG&dpi=72&scale=1&rotation=0&font_family=Arial.ttf&font_size=8&thickness=30&start=NULL&code=BCGcode128&text=".$lot_no.($i);
								}
								if (($i % 2) == 1){
								echo "<tr>\n";
								*/
								}?>
									<td style='width:50%;'>
										<table class="table table-bordered" style='width:100%;height:190px;border:2px solid #000000'>
											<tr style="height:50px">
												<th class="col-xs-2" style="vertical-align: middle;white-space:nowrap"> Lot.NO</th>
												<td colspan=3 class="col-xs-10" style="vertical-align: middle;white-space:nowrap"><img src='<?=$url[$i-1]?>' ></td>
											</tr>
											<tr>
												<th class="col-xs-2" style="vertical-align: middle;white-space:nowrap"> 모델명</th>
												<td style="vertical-align: middle;white-space:nowrap"><?=$item_nm?></td>
												<th class="col-xs-2" style="vertical-align: middle;white-space:nowrap"> 공급자</th>
												<td style="font-size:9pt;vertical-align: middle;white-space:nowrap;padding:1px 1px 1px 8px;">TAESUNG<br>PRECISION CO.,</td>
											</tr>
											<tr>
												<th class="col-xs-2" style="vertical-align: middle;white-space:nowrap"> 수량</th>
												<td style="vertical-align: middle;white-space:nowrap"><?echo ($i==$publish_qty) ? number_format($output_qty%$box_limit_qty): number_format($box_limit_qty)?></td>
												<th class="col-xs-2" style="vertical-align: middle;white-space:nowrap"> 도번</th>
												<td style="vertical-align: middle;white-space:nowrap"><?=$item_cd?></td>
											</tr>
											<tr>	
												<th class="col-xs-2" style="vertical-align: middle;white-space:nowrap"> 제조일자</th>
												<td style="vertical-align: middle;white-space:nowrap"><?=substr($production_dt,0,10)?></td>
												<th class="col-xs-2" style="vertical-align: middle;white-space:nowrap"> 납품일자</th>
												<td style="vertical-align: middle;white-space:nowrap"><?=substr($delivery_dt,0,10)?></td>
											</tr>
										</table>
									</td>
									<?
									if (($i % 2) == 1){?>
										<td style="width:10px; vertical-align: top;marging:0 5px; float:left" align="center" class="col-md-1"><p class='hr2'>&nbsp;</p></td>
									<?}?>
									<?
									if (($i % 2) == 0){
									 echo "</tr>\n";
									 echo "<tr><td colspan='3'><p class='hr'></p></td></tr>\n"; 
									}?>
							<?}?>
							</table>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>
