<!--html / css작업-->
<?
require_once("library/caseby.php");
?>
<div class="main-content">
	<style>
		/*=============================== 내용 ===============================*/	
		/*레이아웃*/
		.wrap_box{border:1px solid #ddd; padding:10px;}
		.top_box{width: 100%; background-color: #FAFAFA; height:100px;}
		.content_box{width: 100%; height: 600px;  overflow-y: scroll; }
		.bottom_box{width: 100%; background-color: #FAFAFA; padding:30px 10px;}
		/*상단 css*/
		.top_box_btn{float: right;}	
		/*하단 css*/		
		.bottom_box_right{float: right;}
		/*select*/
		.select-style{height:35px;}
		/*1. td*/
		.td-1{font-size:15px; color:#33a4d9; padding:0 15px;}
		/*margin*/
		.margin-right15{margin-right:15px;}
		.margin-left15{margin-left:15px;}
		/*=============================== 내용 ===============================*/
	</style>
	<div class="main-content-inner">
	<?=$this->headNavi($controller_txt, $action_txt); ?>
		<div class="page-content">
		
			<div style="float:left; margin-left:15px; margin-top: 20px; position:relative; z-index:1000">
				
			</div>
			
			<div style="clear:both"></div>			
			<div class="row">
				<div class="col-xs-12">
				<!--=============================== 내용 ===============================-->
				<div class="wrap_box">
					
					<div class="top_box">
						<div style="width:50%; height:100%; float:left;padding:10px;">
							<table>
								<tr>
									<td class="td-1">
										기간
									</td>
									<td>									
										<span>
											<div class="input-group">
												<input class="date-picker form-control" name="start_dt" id="start_dt" type="text" style="width:100px" value='2018-08-11' data-date-format="yyyy-mm-dd" />
												<span class="input-group-addon">
													<i class="fa fa-calendar bigger-110"></i>
												</span>
											</div>
										</span>												
									</td>
									<td class="td-1">
										업체
									</td>
									<td>
										<select class="select-style">
											<option>삼오종합상사(공매입)</option>											
										</select>								
									</td>
								<tr>
								<tr>
									<td class="td-1">
										<label class="pos-rel" style="margin-rigth:15px;">
											<input type="checkbox" class="ace"" />
											<span class="lbl"></span>
											
										</label> 
									</td>
									<td>
										<span>
											<div class="input-group">
												<input class="date-picker form-control" name="start_dt" id="start_dt" type="text" style="width:100px" value='2018-08-11' data-date-format="yyyy-mm-dd" />
												<span class="input-group-addon">
													<i class="fa fa-calendar bigger-110"></i>
												</span>
											</div>
										</span>
									</td>
									<td>
									</td>
									<td>
										031-430-1309
									</td>
							</table>
						</div>
						<div style="width:50%; height:100%; float:left; padding:30px 10px;">
							<span class="top_box_btn">                                       	                		     
								<button type="button" class="btn btn-success margin-left15">전체(A)</button>
								<button type="button" class="btn btn-info margin-left15">범위(R)</button>
								<button type="button" class="btn btn-danger margin-left15">다시찾기(F)</button>
							</span>	
						</div>
					</div>
					<div class="content_box">
						<div class="widget-body">
							<div class="widget-main no-padding">
								<table id="tb" class="table table-bordered table-striped">
									<thead class="thin-border-bottom">
										<tr>														
											<th>
												<i class="ace-icon fa fa-caret-right blue"></i> 업체
											</th>				
											<th>
												<i class="ace-icon fa fa-caret-right blue"></i> 발주일자
											</th>				
											<th>
												<i class="ace-icon fa fa-caret-right blue"></i> 발주번호
											</th>				
											<th>
												<i class="ace-icon fa fa-caret-right blue"></i> 품명
											</th>				
											<th>
												<i class="ace-icon fa fa-caret-right blue"></i> 규격
											</th>				
											<th>
												<i class="ace-icon fa fa-caret-right blue"></i> 발주량
											</th>				
											<th>
												<i class="ace-icon fa fa-caret-right blue"></i> 발주금액
											</th>				
											<th>
												<i class="ace-icon fa fa-caret-right blue"></i> 입고량
											</th>				
											<th>
												<i class="ace-icon fa fa-caret-right blue"></i> 미입고량
											</th>
											<th>
												<i class="ace-icon fa fa-caret-right blue"></i> 미입고금액
											</th>
											<th style="width:30%;">
												<i class="ace-icon fa fa-caret-right blue"></i> 비고
											</th>					
										</tr>
									</thead>
									<tbody></tbody>
								</table>										
							</div>
						</div>
					</div>
					<div class="bottom_box">
						<label class="pos-rel margin-right15">
							<input type="checkbox" class="ace " />
							<span class="lbl"></span>
							일별합계
						</label> 
						<label class="pos-rel margin-right15">
							<input type="checkbox" class="ace"/>
							<span class="lbl"></span>
							기간총계
						</label>
						<label class="pos-rel margin-right15">
							<input type="radio" class="ace" name="orderstatus"/>
							<span class="lbl"></span>
							품목별
						</label>
						<label class="pos-rel margin-right15">
							<input type="radio" class="ace" name="orderstatus"/>
							<span class="lbl"></span>
							발주별
						</label>					
						<button type="button" class="btn btn-primary margin-left15">일별,번호별조회(D)</button>
						<span class="bottom_box_right">							
							<button type="button" class="btn btn-default margin-left15">
								<span class="glyphicon glyphicon-print" aria-hidden="true"></span>
							</button>
								<label class="pos-rel">
									<input type="checkbox" class="ace" />
									<span class="lbl"></span>
									
								</label>
								<label class="pos-rel">
									<input type="checkbox" class="ace" />
									<span class="lbl"></span>
									
								</label>
							<button type="button" class="btn btn-default margin-left15">
								<span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>
							</button>
						</span>
					</div>
				</div>
				<!--=============================== 내용 ===============================-->					
				</div>				
			</div>
		</div>
	</div>
</div>

<?
require_once ("assets/include_script.php");
?>
<!--html / css작업-->


