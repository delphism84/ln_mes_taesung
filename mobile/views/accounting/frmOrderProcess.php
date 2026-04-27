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
		/*하단 테이블*/
		.bottom-table td{padding:5px 10px;}
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
										발주번호
									</td>
									<td>									
										<input type="text" value/>												
									</td>
									<td class="td-1">
										일자
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
										<button type="button" class="btn btn-success margin-left15">목록</button>
									</td>
								<tr>
								<tr>
									<td class="td-1">
										발주업체
									</td>
									<td>
										<select class="select-style">
											<option></option>											
										</select>	
									</td>									
							</table>
						</div>
						<div style="width:50%; height:100%; float:left; padding:30px 10px;">
							
						</div>
					</div>
					<div class="content_box">
						<div class="widget-body">
							<div class="widget-main no-padding">
								<table id="tb" class="table table-bordered table-striped">
									<thead class="thin-border-bottom">
										<tr>														
											<th>
												<i class="ace-icon fa fa-caret-right blue"></i> NO
											</th>				
											<th>
												<i class="ace-icon fa fa-caret-right blue"></i> 품명
											</th>				
											<th>
												<i class="ace-icon fa fa-caret-right blue"></i> 규격
											</th>				
											<th>
												<i class="ace-icon fa fa-caret-right blue"></i> 단위
											</th>				
											<th>
												<i class="ace-icon fa fa-caret-right blue"></i> 수량
											</th>				
											<th>
												<i class="ace-icon fa fa-caret-right blue"></i> 단가
											</th>				
											<th>
												<i class="ace-icon fa fa-caret-right blue"></i> 금액
											</th>				
											<th>
												<i class="ace-icon fa fa-caret-right blue"></i> 부가세액
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
						<table class="bottom-table">
							<tr>
								<td style="width:5%;">
									유효기간
								</td>
								<td>
									<input type="text" />
								</td>
								<td style="width:35%;">
								</td>
								<td style="width:5%;">
									발주금액
								</td>
								<td>
									<input type="text" />
								</td>
								<td style="width:5%;">
									부가세액
								</td>
								<td>
									<input type="text" />
								</td>
								<td style="width:5%;">
									합계금액
								</td>
								<td>
									<input type="text" />
								</td>
							</tr>
							<tr>
								<td>
									납품기일
								</td>
								<td>
									<input type="text" />
								</td>
								<td style="width:35%;">
									납품장소
								</td>
								<td>
									계약금액
								</td>
								<td>
									<input type="text" />
								</td>
								<td>
									차감잔액
								</td>
								<td>
									<input type="text" />
								</td>
								<td>
									매입방법
								</td>
								<td>
									<input type="text" />
								</td>
							</tr>
							<tr>
								<td>
									납품기일
								</td>
								<td>
									<input type="text" />
								</td>
								<td style="width:35%;">
									<input type="text" />
								</td>
								<td>
									비고
								</td>
								<td colspan=5>
									<select class="select-style" style="width:100%;">
										<option></option>											
									</select>	
								</td>
							</tr>
						</table>
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


