<?
require_once("controllers/ajax_controller.php");

class ajax_override extends Ajax {
//--------------------------------------------------------------------------------------------------------------------------- 삭제금지
	var $parameter;
	var $now;

	public function __construct($parameter) {
		$this->parameter = $parameter;
		$this->now = date("Y-m-d H:i:s");
	}
//--------------------------------------------------------------------------------------------------------------------------- 삭제금지


// 백승현

///////////////////////////// 백승현 추가.

	// 거래처 정보 가져오기
	public function getAccountInfo() {
		$json = new Services_JSON();

		$sql = "select * from account where account_cd='".$this->parameter['account_cd']."' and account_nm='".$this->parameter['account_nm']."' ";
		$this->query($sql);
		
		$i = 0;
		$t = $this->fetch();

		$re[$i]['uid'] = $t->uid;
		$re[$i]['classify'] = $t->classify;
		$re[$i]['classify_nm'] = $this->getCompareName("account_classify","classify_nm","uid",$t->classify);
		$re[$i]['outsourcing'] = $t->outsourcing;
		$re[$i]['account_cd'] = $t->account_cd;
		$re[$i]['account_nm'] = $t->account_nm;
		$re[$i]['owner'] = $this->convertNull($t->owner);
		$re[$i]['owner_mobile'] = $this->convertNull($t->owner_mobile);
		$re[$i]['corp_reg_no'] = $this->convertNull($t->corp_reg_no);
		$re[$i]['corp_no'] = $this->convertNull($t->corp_no);
		$re[$i]['corp_condition'] = $this->convertNull($t->corp_condition);
		$re[$i]['corp_event'] = $this->convertNull($t->corp_event);
		$re[$i]['corp_phone'] = $this->convertNull($t->corp_phone);
		$re[$i]['corp_fax'] = $this->convertNull($t->corp_fax);
		$re[$i]['corp_email'] = $this->convertNull($t->corp_email);
		$re[$i]['corp_zipcode'] = $this->convertNull($t->corp_zipcode);
		$re[$i]['corp_address'] = $this->convertNull($t->corp_address);
		$re[$i]['manager'] = $this->convertNull($t->manager);
		$re[$i]['bank'] = $this->convertNull($t->bank);
		$re[$i]['account'] = $this->convertNull($t->account);
		$re[$i]['account_holder'] = $this->convertNull($t->account_holder);
		$re[$i]['account_id'] = $this->convertNull($t->account_id);
		$re[$i]['account_pwd'] = $this->convertNull($t->account_pwd);
		$re[$i]['create_dt'] = $t->create_dt;

		echo $json->encode($re);
	}

	// 미수금 품목내역 가져오기
	public function getReceivablesItemList() {
		$json = new Services_JSON;
		$sql = "select * from receivables_item where fid='".$this->parameter['fid']."' ";
		
		$this->query($sql);

		$i = 0;
		while($t = $this->fetch()) {

			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['standard'] = $t->standard;
			$re[$i]['unit'] = $t->unit;
			$re[$i]['cnt'] = $t->cnt;
			$re[$i]['sales_price'] = $t->sales_price;
			$re[$i]['rate'] = $t->rate;
			$re[$i]['reversion_sales_price'] = $t->reversion_sales_price;
			$re[$i]['supply_price'] = $t->supply_price;
			$re[$i]['tax'] = $t->tax;
			$re[$i]['total_cost'] = $t->total_cost;
						
			$i++;
		}

		echo $json->encode($re);		
	}

	// 미지급 품목내역 가져오기
	public function getPayableItemList() {
		$json = new Services_JSON;
		$sql = "select * from payable_item where fid='".$this->parameter['fid']."' ";
		
		$this->query($sql);

		$i = 0;
		while($t = $this->fetch()) {

			$re[$i]['item_cd'] = $t->item_cd;
			$re[$i]['item_nm'] = $t->item_nm;
			$re[$i]['standard'] = $t->standard;
			$re[$i]['unit'] = $t->unit;
			$re[$i]['cnt'] = $t->cnt;
			$re[$i]['cost'] = $t->cost;
			$re[$i]['total_cost'] = $t->total_cost;
			
			$i++;
		}

		echo $json->encode($re);		
	}

	//회사기본정보
	public function getCompanyInfo(){

		$json = new Services_JSON;

		$sql ="select * from company";
		$this->query($sql);
		
		$i= 0;
		while($t = $this->fetch()){
			$re[$i]['corp_nm'] = $t->corp_nm;
			$re[$i]['business_no'] = $t->business_no;
			$re[$i]['owner'] = $t->owner;
			$re[$i]['telephone'] = $t->telephone;
			$re[$i]['fax'] = $t->fax;
			$re[$i]['zipcode'] = $t->zipcode;
			$re[$i]['address'] = $t->address;
			$re[$i]['corp_type'] = $t->corp_type;
			$re[$i]['corp_event'] = $t->corp_event;
			$re[$i]['sign'] = $t->sign;
			$re[$i]['admin'] = $t->admin;
		}

		echo $json->encode($re);
	}


////////////////////////////////////////////////





// -----------------------------------인권------------------------------------
	
	public function getAccountOrdersList(){
		$json = new Services_JSON;
		$sql = "select * from orders where account_cd='".$this->parameter['account_cd']."' and (date(create_dt) between '".$this->parameter['start_dt']."' and '".$this->parameter['end_dt']."')";
		

		
		$this->query($sql);
		$i = 0;
		while($t = $this->fetch()){
			$sql = "select * from orders_item where fid=".$t->uid;
			$this->sub_query($sql);
			while($r = $this->sub_fetch()){
				$re[$i]['uid'] = $r->uid;
				$re[$i]['account_nm'] = $t->account_nm;
				$re[$i]['create_dt'] = $r->create_dt;
				$re[$i]['order_cd'] = $t->order_cd;
				$re[$i]['item_nm'] = $r->item_nm;
				$re[$i]['standard'] = $r->standard;
				$re[$i]['total_cost'] = $r->total_cost;
				$re[$i]['cnt'] = $t->cnt;
				$re[$i]['in_cnt'] = $r->cnt - $r->remain_cnt;
				$re[$i]['remain_cnt'] = $r->remain_cnt;
				$re[$i]['remain_cost'] = $r->cost * $r->remain_cnt;
				$re[$i]['memo'] = $t->memo;

				$i++;
			}
		}

		echo $json->encode($re);
	}

	public function getAccountPurchaseRanking(){
		$json = new Services_JSON;

		$sql = "select account from orders where (date(create_dt) between '".$this->parameter['start_dt']."' and '".$this->parameter['end_dt']."') group by account";
		
		$this->query($sql);
		$i = 0;
		$all_total = 0;
		$a = array();
		while($t = $this->fetch()){
			$sql = "select * from orders_item where account=".$t->account;
			$this->sub_query($sql);
			
			$y = 0;
			$total = 0;

			while($q = $this->sub_fetch()){
				$total = $total + $q->total_cost; // 매입총액
				$y++; // 건수

			}

			if($total > 0){
				
				array_push($a,$total);

				$ave = $total / $y;  //1회 평균액

				// 전체매출
				$all_total = $all_total + $total;
				$re[$i]['account_nm'] = $this->getCompareName("account","account_nm","uid",$t->account);
				$re[$i]['cnt'] = $y;
				$re[$i]['ave_cost'] = $ave;
				$re[$i]['total_cost'] = $total;
				$i++;

			}

		}

		for($i = 0 ; $i < sizeof($a) ; $i++) {
			$re[$i]['gravity'] = number_format(($a[$i] / $all_total)*100,1);
		}
		

		// 가상테이블을 만든다 ... 필드는 뿌려줄 내용대로

		$sql = "
			create temporary table imsi( 
				account_nm varchar(50),
				cnt int(11),
				ave_cost int(11),
				total_cost int(11),
				gravity float(2)
			)
		";
		$this->query($sql);


		// 반복문을 써서 $re 값을 가상테이블에 넣는다

		for($i = 0; $i < sizeof($re); $i++){
			$sql = "
				insert into imsi (
					account_nm, 
					cnt, 
					ave_cost, 
					total_cost, 
					gravity
				) values(
					'".$re[$i]['account_nm']."',
					".$re[$i]['cnt'].",
					".$re[$i]['ave_cost'].",
					".$re[$i]['total_cost'].",
					".$re[$i]['gravity']."
				)
			";

			$this->query($sql);
		}

		// select 가상테이블..order by gravity desc
		$sql = "select * from imsi order by gravity desc";
		$this->query($sql);
		// while 문을 써서 $re 를 재구성한다
		$i = 0;
		while($t = $this->fetch()){
			$re[$i]['account_nm'] = $t->account_nm;
			$re[$i]['cnt'] = $t->cnt;
			$re[$i]['ave_cost'] = $t->ave_cost;
			$re[$i]['total_cost'] = $t->total_cost;
			$re[$i]['gravity'] = $t->gravity;
			$re[$i]['all_total'] = $all_total;
			$i++;
		}
		// 가상테이블을 drop 한다
		$sql = "drop table imsi";
		$this->query($sql);

		echo $json->encode($re);
	}


	public function getAccountSaleRanking(){
		$json = new Services_JSON; 

			$sql = "select * from obtain_order where (date(order_dt) between '".$this->parameter['start_dt']."' and '".$this->parameter['end_dt']."') group by account_cd";

			
			$this->query($sql);
			$i = 0;
			$all_total = 0;
			$a = array();

			while($t=$this->fetch()){
				$y = 0;
				$total = 0;

				$sql = "select * from obtain_order_item where account_cd='".$t->account_cd."'";
				$this->sub_query($sql);

				while($q = $this->sub_fetch()){
					$total = $total + $q->total_price; // 매출총액
					$y++; // 건수
				}

				array_push($a,$total);

				$ave =  $total / $y;  //1회 평균액

				// 전체매출
				$all_total = $all_total + $total;

				$re[$i]['account_nm'] = $t->account_nm;
				$re[$i]['total_cost'] = $total;
				$re[$i]['cnt'] = $y;
				$re[$i]['ave'] = $ave;
				$i++;
			}


			for($i = 0; $i < sizeof($a); $i++){
				$re[$i]['gravity'] = number_format(($a[$i] / $all_total)*100,1);
			}



			// 가상테이블을 만든다 ... 필드는 뿌려줄 내용대로

			$sql = "
				create temporary table imsi( 
					account_nm varchar(50),
					cnt int(11),
					ave int(11),
					total_cost int(11),
					gravity float(2)
				)
			";
			$this->query($sql);


			// 반복문을 써서 $re 값을 가상테이블에 넣는다

			for($i = 0; $i < sizeof($re); $i++){
				$sql = "
					insert into imsi (
						account_nm, 
						cnt, 
						ave, 
						total_cost, 
						gravity
					) values(
						'".$re[$i]['account_nm']."',
						".$re[$i]['cnt'].",
						".$re[$i]['ave'].",
						".$re[$i]['total_cost'].",
						".$re[$i]['gravity']."
					)
				";

				$this->query($sql);
			}

			// select 가상테이블..order by gravity desc
			$sql = "select * from imsi order by gravity desc";
			$this->query($sql);
			// while 문을 써서 $re 를 재구성한다
			$i = 0;
			while($t = $this->fetch()){
				$re[$i]['account_nm'] = $t->account_nm;
				$re[$i]['cnt'] = $t->cnt;
				$re[$i]['ave'] = $t->ave;
				$re[$i]['total_cost'] = $t->total_cost;
				$re[$i]['gravity'] = $t->gravity;
				$re[$i]['all_total'] = $all_total;
				$i++;
			}
			// 가상테이블을 drop 한다
			$sql = "drop table imsi";
			$this->query($sql);

			echo $json->encode($re);
	}


	



//--------------------------------------------------------------------
//							인권 2018-10-05
//--------------------------------------------------------------------
	public function getAccountSaleTotal(){
		$json = new Services_JSON();
		$dt = $this->parameter['dt'];

		
		$sql = "select * from obtain_order_item where account_cd='".$this->parameter['account_cd']."' and DATE_FORMAT( order_dt,'%Y')='".$dt."'";
		
		
		$this->query($sql);
		
		$i = 0;
		
		
		while($t = $this->fetch()){
				$re[$i]['account_nm'] = $t->account_nm;
				$re[$i]['item_nm'] = $t->item_nm;
				$re[$i]['standard'] = $t->standard;
				$re[$i]['unit'] = $t->unit;
				$re[$i]['order_dt'] = substr($t->order_dt,5,2);
				$re[$i]['total_price'] = $t->total_price;
				

				$i++;
			}
		
		
		echo $json->encode($re);
	}



//-----------------------------------------------------------------------
//-----------------------------------------------------------------------
//샘희 출근기록 가져오가 ajax.php에서 옮김
//-----------------------------------------------------------------------
// 출근기록 가져오기	
public function getCommute() {
		$json = new Services_JSON;

		//$sql = "select * from employee";
		$this->getTable("employee", $this->parameter['where'], $this->parameter['rpp'], $this->parameter['page'],"uid","asc");
		//$this->query($sql);

		$i = 0;
		while($t = $this->fetch()) {
			$date = date("Y-m-d H:i:s");
			$work_tm_value = @mktime(9,0,0,date('m'),date('d'),date('Y'));

			$sql = "select * from commute where emp_id='".$t->emp_id."' and date(create_dt) = date('".$date."')";
			$res = mysql_fetch_object(mysql_query($sql));

			if(!isset($res->work_tm)) $work_tm = ""; else $work_tm = $res->work_tm;
			if(!isset($res->leave_tm)) $leave_tm = ""; else $leave_tm = $res->leave_tm;

			$wt = explode(":",$res->work_tm);
			$cwork_tm = @mktime($wt[0],$wt[1],$wt[2],date('m'),date('d'),date('Y'));
			if($work_tm_value < $cwork_tm) $color = "red";
			else $color = "";
			
			if($t->big_department_cd != "") $department_nm = $this->getCompareName("department_big","department_nm","uid",$t->big_department_cd);
			if($t->middle_department_cd != "") $department_nm .= "-".$this->getCompareName("department_middle","department_nm","uid",$t->middle_department_cd);
			if($t->small_department_cd != "") $department_nm .= "-".$this->getCompareName("department_small","department_nm","uid",$t->small_department_cd);
			$re[$i]['uid'] = $t->uid;
			$re[$i]['emp_cd'] = $t->emp_cd;
			$re[$i]['department_nm'] = $this->convertNull($department_nm);
			$re[$i]['position_nm'] = $this->convertNull($this->getCompareName("position","position_nm","uid",$t->position_cd));
			$re[$i]['uid'] = $res->uid;
			$re[$i]['color'] = $color;
			$re[$i]['emp_id'] = $res->emp_id;
			$re[$i]['emp_nm'] = $t->emp_nm;
			$re[$i]['work_tm'] = $work_tm;
			$re[$i]['leave_tm'] = $leave_tm;
			$re[$i]['create_dt'] = $this->convertNull(substr($res->create_dt,11,16));
			$i++;
		}
		echo $json->encode($re);
	}
//-----------------------------------------------------------------------
	// 업체별 세부매입현황 > 거래처 선택안했을경우에는 모두 표시되게 하기위해 수정.
	public function getAccountPurchaseList(){
		$json = new Services_JSON;
		
		if( $this->parameter['account_cd'] != "" ){
			
			$sql = "select * from payable as a inner join payable_item as b on a.uid=b.fid where a.account_cd='".$this->parameter['account_cd']."' and a.year='".$this->parameter['s_year']."' and a.month='".$this->parameter['s_month']."' order by b.days desc";
			
		}else{
			$sql = "select * from payable as a inner join payable_item as b on a.uid=b.fid where a.year='".$this->parameter['s_year']."' and a.month='".$this->parameter['s_month']."' order by b.days desc";
		}

		$this->query($sql);
		$i = 0;
		while($r = $this->fetch()){

			$re[$i]['days'] = $r->days;
			$re[$i]['item_cd'] = $r->item_cd;
			$re[$i]['item_nm'] = $r->item_nm;
			$re[$i]['standard'] = $r->standard;
			$re[$i]['account_nm'] = $r->account_nm;
			$re[$i]['cnt'] = $r->cnt;
			$re[$i]['price'] = $r->cost;
			$re[$i]['purchase_price'] = $r->purchase_price;
			$re[$i]['tax'] = $r->tax;			
			$re[$i]['total_cost'] = $r->total_price; //입고한 수량의 합계금액
			$i++;
			
		}

		echo $json->encode($re);
	}

	//품목별 매입현황
	public function getItemPurchaseList(){

		$json = new Services_JSON;
		if( $this->parameter['where'] != "" ){
			
			$sql = "select * from payable as a inner join payable_item as b on a.uid=b.fid where a.year='".$this->parameter['s_year']."' and a.month='".$this->parameter['s_month']."' and ".$this->parameter['where']." order by b.days desc";
			
		}else{
			$sql = "select * from payable as a inner join payable_item as b on a.uid=b.fid where a.year='".$this->parameter['s_year']."' and a.month='".$this->parameter['s_month']."' order by b.days desc";
		}

		$this->query($sql);
		$i = 0;
		while($r = $this->fetch()){
			
			$re[$i]['days'] = $r->days;
			$re[$i]['item_cd'] = $r->item_cd;
			$re[$i]['item_nm'] = $r->item_nm;
			$re[$i]['standard'] = $r->standard;
			$re[$i]['account_nm'] = $r->account_nm;
			$re[$i]['cnt'] = $r->cnt;
			$re[$i]['price'] = $r->cost;
			$re[$i]['purchase_price'] = $r->purchase_price;
			$re[$i]['tax'] = $r->tax;			
			$re[$i]['total_cost'] = $r->total_price; //입고한 수량의 합계금액
			$i++;
			
		}
		echo $json->encode($re);
	}

	//기간별 매입현황
	public function getItemPurchasePeriodList(){

		$json = new Services_JSON;
		$sql = "select a.account_nm, b.* from payable as a inner join payable_item as b on a.uid=b.fid ".$this->parameter['where']." order by b.days desc";
				
		$this->query($sql);
		$i = 0;
		
		while($r = $this->fetch()){
			
			$re[$i]['days'] = $r->days;
			$re[$i]['item_cd'] = $r->item_cd;
			$re[$i]['item_nm'] = $r->item_nm;
			$re[$i]['standard'] = $r->standard;
			$re[$i]['account_nm'] = $r->account_nm;
			$re[$i]['cnt'] = $r->cnt;
			$re[$i]['price'] = $r->cost;
			$re[$i]['purchase_price'] = $r->purchase_price;
			$re[$i]['tax'] = $r->tax;			
			$re[$i]['total_cost'] = $r->total_price; //입고한 수량의 합계금액
			$re[$i]['create_dt'] = $r->create_dt;
			$i++;
			
		}
		echo $json->encode($re);
	}


}
?>