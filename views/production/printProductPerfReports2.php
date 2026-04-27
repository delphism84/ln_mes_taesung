<?require_once("assets/head_pop.php");?>
<?
session_start();
extract($_POST);
extract($_GET);
?>
<style>
    *{
        margin:0px;
        padding:0px;
        font-family: arial;
    }
    body{
        background: #EEE;
    }
    #header{
        background: #666;
        color:#FFF;
        height:100px;
        padding: 10px;
    }
    .clear{
        clear:both;
    }
    #sideMenu{
        width:200px;
        float:left;
        background: #FFC;
        margin: 10px;
        min-height: 700px;
    }
    #sideMenu ul li{
        list-style: none;
        padding: 5px;
        border-bottom: 1px dotted #CCC;
    }
    #masterContent{
        background: #FFF;
        float: left;
        width: 760px;
        padding: 10px;
        margin: 10px;
    }
    #masterContent ol{
        margin-left: 20px;
    }
    #masterContent pre{
        background: #EEE;
        color:blue;
        padding:10px;
        width: 96%;
        display: inline-block;
        overflow: auto;
        font-size: 85%;
    }
    .note{
        color:red;
    }
    #footer{
        text-align: center;
        padding: 20px;
        font-size: 85%;
        background: #666;
        color:#FFF;
    }
</style>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/printPreview.js"></script>
<script type="text/javascript">
        $(function(){
            $("#btnPrint").printPreview({
                obj2print:'#masterContent',
                width:'810'
                
                /*optional properties with default values*/
                //obj2print:'body',     /*if not provided full page will be printed*/
                //style:'',             /*if you want to override or add more css assign here e.g: "<style>#masterContent:background:red;</style>"*/
                //width: '670',         /*if width is not provided it will be 670 (default print paper width)*/
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
<div class="main-content">
	<div class="main-content-inner">
		<!-- 페이지 상단 Location -->
		<div class="breadcrumbs ace-save-state subpage" id="breadcrumbs">
			<ul class="breadcrumb">
			<button id="btnPrint">Print Preview</button>
				<i class="ace-icon fa fa-print bigger-110"></i>
				Print
				<i class="ace-icon fa fa-arrow-right icon-on-right"></i>
			</button>
			</ul>
		</div>

		<div id = "printArea">
		<!-- // 페이지 상단 Location -->

		 <div id="masterContent"> 
			<?for ($i=1; $i <5; $i++){?>
			<div class="row">
				<div class="col-xs-5">
					<table class="table table-bordered">
							<tr>
								<th class="col-xs-1"><i class="ace-icon fa fa-caret-right black"></i> 이미지</th><td></td>
							</tr>
							<tr>
								<th class="col-xs-1"><i class="ace-icon fa fa-caret-right black"></i> 구분</th><td></td>
							</tr>
							<tr>
								<th class="col-xs-2"><i class="ace-icon fa fa-caret-right black"></i> 품목코드</th><td></td>
							</tr>
							<tr>	
								<th class="col-xs-2"><i class="ace-icon fa fa-caret-right black"></i> 품목명</th><td></td>
							</tr>
					</table>
				</div>
				<div class="col-xs-5">	
					<table class="table table-bordered">

							<tr >
								<th class="col-xs-1"><i class="ace-icon fa fa-caret-right black"></i> 이미지</th><td></td>
							</tr>
							<tr >
								<th class="col-xs-1"><i class="ace-icon fa fa-caret-right black"></i> 구분</th><td></td>
							</tr>
							<tr >
								<th class="col-xs-2"><i class="ace-icon fa fa-caret-right black"></i> 품목코드</th><td></td>
							</tr>
							<tr >	
								<th class="col-xs-2"><i class="ace-icon fa fa-caret-right black"></i> 품목명</th><td></td>
							</tr>
					</table>
				</div>
			</div>
			<div class="row">
			</div>
			<?}?>

			</div>
</div>
</div>
<?
require_once ("assets/include_script.php");
?>
