<?
if(strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile') !== false){
    $agent = "모바일";
}else{
   $agent = "PC";
}

$sql = "select * from warehouse";
$this->query($sql);
while($t = $this->fetch()){
	$table = "warehouse_".$t->uid;
	if(!$this->isTable($table,DB_NAME)){
		$sql = "
			CREATE TABLE `$table` (
				`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
				`fid` INT(11) NULL DEFAULT NULL COMMENT 'warehouse uid',
				`classify` VARCHAR(50) NULL DEFAULT NULL COMMENT '품목구분',
				`item_cd` VARCHAR(50) NULL DEFAULT NULL COMMENT '품목코드',
				`item_nm` VARCHAR(50) NULL DEFAULT NULL COMMENT '품목명',
				`standard` VARCHAR(50) NULL DEFAULT NULL COMMENT '규격',
				`unit` VARCHAR(50) NULL DEFAULT NULL COMMENT '단위',
				`cnt` INT(11) NULL DEFAULT NULL COMMENT '수량',
				`lot_no` VARCHAR(50) NULL DEFAULT NULL COMMENT 'LotNo',
				`create_dt` DATETIME NULL DEFAULT NULL COMMENT '입고일',
				PRIMARY KEY (`uid`),
				INDEX `fid` (`fid`),
				INDEX `item_cd` (`item_cd`),
				INDEX `standard` (`standard`),
				INDEX `lot_no` (`lot_no`)
			)
			COLLATE='utf8_general_ci'
			ENGINE=InnoDB
			;
		";
		$this->query($sql);
	}
}

$sql = "select * from process";
$this->query($sql);
while($t = $this->fetch()){
	$table = "process_warehouse_".$t->uid;
	if(!$this->isTable($table,DB_NAME)){
		$sql = "
			CREATE TABLE `$table` (
				`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
				`fid` INT(11) NULL DEFAULT NULL COMMENT 'warehouse uid',				
				`item_cd` VARCHAR(50) NULL DEFAULT NULL COMMENT '품목코드',
				`item_nm` VARCHAR(50) NULL DEFAULT NULL COMMENT '품목명',
				`standard` VARCHAR(50) NULL DEFAULT NULL COMMENT '규격',
				`unit` VARCHAR(50) NULL DEFAULT NULL COMMENT '단위',
				`cnt` INT(11) NULL DEFAULT NULL COMMENT '수량',
				`lot_no` VARCHAR(50) NULL DEFAULT NULL COMMENT 'LotNo',
				`create_dt` DATETIME NULL DEFAULT NULL COMMENT '입고일',
				PRIMARY KEY (`uid`),
				INDEX `fid` (`fid`),
				INDEX `item_cd` (`item_cd`),
				INDEX `standard` (`standard`),
				INDEX `lot_no` (`lot_no`)
			)
			COLLATE='utf8_general_ci'
			ENGINE=InnoDB
			;
		";
		$this->query($sql);
	}
}


$sql = "select * from account where outsourcing='y'";
$this->query($sql);
while($t = $this->fetch()){
	$table = "account_warehouse_".$t->uid;
	if(!$this->isTable($table,DB_NAME)){
		$sql = "
			CREATE TABLE `$table` (
				`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',							
				`item_cd` VARCHAR(50) NULL DEFAULT NULL COMMENT '품목코드',
				`item_nm` VARCHAR(50) NULL DEFAULT NULL COMMENT '품목명',
				`standard` VARCHAR(50) NULL DEFAULT NULL COMMENT '규격',
				`unit` VARCHAR(50) NULL DEFAULT NULL COMMENT '단위',
				`cnt` INT(11) NULL DEFAULT NULL COMMENT '수량',				
				`create_dt` DATETIME NULL DEFAULT NULL COMMENT '입고일',
				PRIMARY KEY (`uid`),				
				INDEX `item_cd` (`item_cd`),
				INDEX `standard` (`standard`)			
			)
			COLLATE='utf8_general_ci'
			ENGINE=InnoDB
			;
		";
		$this->query($sql);
	}
}

?>
<?
require_once("library/caseby.php");
?>
<div class="main-content">
	<div class="main-content-inner">				
		<div>				
			<div class="col-xs-12">
				<div class="wrap_box">					
					<div class="wrap_content_box">
						<div id="sortable">
							<ul class="column" style="padding-bottom:10px;">
								<li class="portlet" style="width:100%;">
									<div class="portlet-header">수주현황 <input class="more_show" type='button'  value='더보기 +'/></div>
									<div class="portlet-content">
										<?
										$sql = "select * from obtain_order order by obtain_order_dt desc limit 5";
										$this->query($sql);
										?>
										<table class="table table-bordered">
											<tr>
												<?$this->th("수주일")?>
												<?$this->th("거래처")?>
												<?$this->th("납기일")?>
											</tr>
										<?
										while($t = $this->fetch()) {
											echo "<tr>";
											echo "<td>".substr($t->obtain_order_dt,0,10)."</td>";
											echo "<td>".$t->account_nm."</td>";
											echo "<td>".substr($t->delivery_dt,0,10)."</td>";
											echo "</tr>";
										}
										?>
										</table>
									</div>
								</li>
								<li class="portlet" style="width:100%;">
									<div class="portlet-header">작업지시 <input class="more_show" type='button'  value='더보기 +'/></div>
									<div class="portlet-content">
										<?
										$sql = "select * from work order by uid desc limit 5";
										$this->query($sql);
										?>
										<table class="table table-bordered">
											<tr>
												<?$this->th("시작일")?>
												<?$this->th("거래처")?>
												<?$this->th("잔여수량")?>
											</tr>
										<?
										while($t = $this->fetch()) {
											echo "<tr>";
											echo "<td>".substr($t->work_dt,0,10)."</td>";
											echo "<td>".$t->account_nm."</td>";
											echo "<td>".$t->remain_cnt."</td>";
											echo "</tr>";
										}
										?>
										</table>
									</div>
								</li>
							</ul>                                      				
						</div> 
					</div>
				</div>						
			</div>					
		</div>
	</div>
</div>
<?
require_once ("assets/include_script.php");
?>
<script>
	$(function(){
		$('.menu_open').click(function(){
			$('.slide_menu_pop').css('right','0');
			$('.menu_open').css('display','none');
			$('.menu_close').css('display','block');
			$('.set').css('right','-100%');
		});
		$('.menu_close').click(function(){
			$('.slide_menu_pop').css('right','-50%');
			$('.menu_open').css('display','block');
			$('.menu_close').css('display','none');
		});
	});	
</script>
