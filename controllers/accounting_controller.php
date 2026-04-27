<?
session_start();
class AccountingController {
	public function __construct() {
		extract($_POST);
		extract($_GET);
	}

	public function movePage($controller,$action) {
		echo "<script>";
		echo "location.href = 'index.php?controller=".$controller."&action=".$action."' ";
		echo "</script>";
	}

	public function movePagePop($controller,$action) {
		echo "<script>";
		echo "$(\".modal\").modal(\"hide\")";
		echo "parent.$(\".modal\").modal(\"hide\")";
		echo "opener.$(\".modal\").modal(\"hide\")";
		echo "parent.$.modal.close();";
		echo "parent.$.modal.close();";
		echo "parent.parent.$.modal.close();";
		echo "parent.close_popup();";
		echo "opener.close_popup();";
		echo "$.modal.close();";
		//echo "location.href = 'index.php?controller=".$controller."&action=".$action."' ";
		echo "</script>";
	}

	public function movePageClose($dialogID) {
		//echo $dialogID;
		echo "<script>";
		echo "window.parent.closeModal('".$dialogID."');";
		echo "window.parent.location.reload();";
		echo "</script>";
	}
		
	public function inputPageAccounting(){
		require_once ('views/accounting/basic/openingbalance_list.php');
	}

	public function listPageAccountingCode(){
		require_once ('views/accounting/accountcode/accountingcode_list.php');
	}

	public function listPageAccountingCodeTree(){
		require_once ('views/accounting/accountcode/accountingcodeTree_list.php');
	}

	public function listPageAccountingCodePop(){
		require_once ('views/accounting/accountcode/accountingcode_list_pop.php');
	}
	
	public function inputPageAccountingCode(){
		require_once ('views/accounting/accountcode/accountingcode_regist.php');
	}
	
	public function registAccountingCode(){
		require_once ('views/accounting/accountcode/account_reg.php');
	}

	public function registAccountingCodePop(){
		require_once ('views/accounting/accountcode/account_code_reg_pop.php');
	}
	public function modifyAccountingCodePop(){
		require_once ('views/accounting/accountcode/account_code_view_pop.php');
	}
	public function listAccountingCodeRemarkPop(){
		require_once ('views/accounting/accountcode/account_code_remark_list_pop.php');
	}
	public function modifyAccountingCodeRemarkPop(){
		require_once ('views/accounting/accountcode/account_code_remark_reg_pop.php');
	}
	
	public function registAccountingCodeRemarkPop(){
		require_once ('views/accounting/accountcode/account_code_remark_reg.php');
	}

	public function listAccountingCodeSearchPop(){
		require_once ('views/accounting/accountcode/account_code_search_list_pop.php');
	}

	public function creditcard_regist(){
		require_once ('views/accounting/basic/card/creditcard_list.php');
	}
	
	public function registCreditCardPop(){
		require_once ('views/accounting/basic/card/creditcard_reg_pop.php');
	}

	public function bank_regist(){
		require_once ('views/accounting/basic/bank/bank_list.php');
	}

	public function registBankPop(){
		require_once ('views/accounting/basic/bank/bank_reg_pop.php');
	}

	public function modifyBankPop(){
		require_once ('views/accounting/basic/bank/bank_reg_pop.php');
	}

	public function registPrintApproval(){
		require_once ('views/accounting/basic/print/print_approval_regist.php');
	}
	
	public function cardCompany_regist(){
		require_once ('views/accounting/basic/card/cardcompany_list.php');
	}
	
	public function registcardCompanyPop(){
		require_once ('views/accounting/basic/card/cardcompany_reg_pop.php');
	}

	public function listGeneralStatement(){
		require_once ('views/accounting/statement/general_statement_list.php');
	}

	public function registGeneralStatementPop(){
		require_once ('views/accounting/statement/general_statement_regist_pop.php');
	}

	public function modifyGeneralStatementPop(){
		$t = Accounting::getGeneralStatement($_GET['gid']);	 
		require_once ('views/accounting/statement/general_statement_modify_pop.php');
	}

	public function contract_view(){
		$t = Contract::viewContract($_GET['uid']);
		require_once('views/contract/contract_view.php');
	}


	public function printGeneralstatement(){
		require_once ('views/accounting/statement/general_statement_print.php');
	}

	public function listSalesStatement(){
		require_once ('views/accounting/statement/sales_statement_list.php');
	}

	public function registSalesStatementPop(){
		require_once ('views/accounting/statement/sales_statement_regist_pop.php');
	}

	public function modifySalesStatementPop(){
		$t = Accounting::getSalesStatement($_GET['sid']);	 
		require_once ('views/accounting/statement/sales_statement_modify_pop.php');
	}

	public function listPurchaseStatement(){
		require_once ('views/accounting/statement/purchase_statement_list.php');
	}

	public function registPurchaseStatementPop(){
		require_once ('views/accounting/statement/purchase_statement_regist_pop.php');
	}
	
	public function modifyPurchaseStatementPop(){
		$t = Accounting::getPurchaseStatement($_GET['pid']);	 
		require_once ('views/accounting/statement/purchase_statement_modify_pop.php');
	}

	public function registPartReg(){
		require_once ('views/accounting/basic/part_regist.php');
	}

	public function registTaxInvoicePop(){
		require_once ('views/accounting/statement/tax_invoice_pop.php');
	}

	public function modifyTaxInvoicePop(){
		$t = Accounting::getTaxInvoice($_GET['statement_no']);
		require_once ('views/accounting/statement/tax_invoice_modify_pop.php');
	}

	

	public function accountingCodeRemarkInsert(){
	$now = date("Y-m-d H:i:s");
	$data = array(
		"table" => "erp_account_code_remark",
		"aci_cd" => $_POST['aci_cd'],
		"remark_code" => $_POST['remark_code'],
		"remark_name" => $_POST['remark_name'],
		"regdate" => $now
	);

	$accounting_code = new Accounting;
	$result = $accounting_code->insertAccountingCodeRemark($data);
	if($result) $this->movePage("accounting","listAccountingCodeRemarkPop");
	}

	public function accountingCodeRemarkUpdate() {
		$now = date("Y-m-d H:i:s");
		$data = array(
			"table" => "erp_account_code_remark",
			"where" => "uid=".$_POST['uid'],
			"remark_name" => $_POST['remark_name'],
			"regdate" => $now
		);
		$accounting_code = new Accounting;
		$result = $accounting_code->UpdateAccountingCodeRemark($data);
		if($result) $this->movePage("accounting","listAccountingCodeRemarkPop");
	}


	public function accountingCodeInsert(){
	$now = date("Y-m-d H:i:s");
	$data = array(
		"table"					=> "erp_account_code",
		"aci_cd"				=> $_POST['aci_cd'],
		"aci_nm"				=> $_POST['aci_nm'],
		"search_box"			=> $_POST['search_box'],
		"aci_type"				=> $_POST['aci_type'],
		"credit_gb"				=> $_POST['credit_gb'],
		"in_gb"					=> $_POST['in_gb'],
		"remark1"				=> $_POST['remark1'],
		"remark2"				=> $_POST['remark2'],
		"related_business"		=> $_POST['related_business'],
		"confirmation"			=> $_POST['confirmation'],
		"valuation_account_gb"	=> $_POST['valuation_account_gb'],
		"fs_hyperlink"			=> $_POST['fs_hyperlink'],
		"val_account_order"		=> $_POST['val_account_order'],
		"fs_num_account1"			=> $_POST['high_account_code'],
		"high_account_code"		=> $_POST['high_account_code'],
		"regdate"				=> $now
	);

	$accounting_code = new Accounting;
	$result = $accounting_code->insertAccountingCode($data);
	//if($result) $this->movePage("accounting","listPageAccountingCode");
	if($result) require_once ("views/accounting/accountcode/account_code_reg_pop.php");
	}

	public function accountingCodeUpdate() {
		$now = date("Y-m-d H:i:s");
		$data = array(
			"table" => "erp_account_code",
			"where" => "uid=".$_POST['uid'],
			"aci_nm"				=> $_POST['aci_nm'],
			"search_box"			=> $_POST['search_box'],
			"aci_type"				=> $_POST['aci_type'],
			"credit_gb"				=> $_POST['credit_gb'],
			"in_gb"					=> $_POST['in_gb'],
			"remark1"				=> $_POST['remark1'],
			"remark2"				=> $_POST['remark2'],
			"related_business"		=> $_POST['related_business'],
			"confirmation"			=> $_POST['confirmation'],
			"valuation_account_gb"	=> $_POST['valuation_account_gb'],
			"fs_hyperlink"			=> $_POST['fs_hyperlink'],
			"val_account_order"		=> $_POST['val_account_order'],
			"fs_num_account1"			=> $_POST['high_account_code'],
			"high_account_code"		=> $_POST['high_account_code'],
			"regdate" => $now
		);
		$accounting_code = new Accounting;
		$result = $accounting_code->UpdateAccountingCode($data);
		//if($result) $this->movePage("accounting","listPageAccountingCode");
		if($result) require_once ("views/accounting/accountcode/account_code_reg_pop.php");
	}

	public function registCreditCardInsert(){
		$now = date("Y-m-d H:i:s");
		$data = array(
			"table"					=> "erp_creditcard",
			"card_num"				=> $_POST['card_num'],
			"card_name"				=> $_POST['card_name'],
			"card_type"				=> $_POST['card_type'],
			"pay_account_name"		=> $_POST['pay_account_name'],
			"aci_cd"				=> $_POST['aci_cd'],
			"aci_nm"				=> $_POST['aci_nm'],
			"card_manager"			=> $_POST['card_manager'],
			"search_box"			=> $_POST['search_box'],
			"use_yn"				=> $_POST['use_yn'],
			"re_mark"				=> $_POST['re_mark'],
			"regdate"				=> $now
		);

		$create_card = new Accounting;
		$result = $create_card->insertCreditCardCode($data);
		//if($result) $this->movePage("accounting","listPageAccountingCode");
		if($result) require_once ("views/accounting/basic/card/creditcard_reg_pop.php");
		}

	public function registCreditCardUpdate() {
		$now = date("Y-m-d H:i:s");
		$data = array(
			"table" => "erp_creditcard",
			"where" => "idx=".$_POST['idx'],
			"card_name"				=> $_POST['card_name'],
			"card_type"				=> $_POST['card_type'],
			"pay_account_name"		=> $_POST['pay_account_name'],
			"aci_cd"				=> $_POST['aci_cd'],
			"aci_nm"				=> $_POST['aci_nm'],
			"card_manager"			=> $_POST['card_manager'],
			"search_box"			=> $_POST['search_box'],
			"use_yn"				=> $_POST['use_yn'],
			"re_mark"				=> $_POST['re_mark'],
			"regdate"				=> $now
		);
		$create_card = new Accounting;
		$result = $create_card->UpdateCreditCardCode($data);
		//if($result) $this->movePage("accounting","listPageAccountingCode");
		if($result) require_once ("views/accounting/basic/card/creditcard_reg_pop.php");
	}
	

	public function registBankInsert(){
		$now = date("Y-m-d H:i:s");
		$data = array(
			"table"					=> "erp_cardcompany",
			"bank_num"				=> $_POST['bank_num'],
			"bank_name"				=> $_POST['bank_name'],
			"bank_type"				=> $_POST['bank_type'],
			"pay_account_name"		=> $_POST['pay_account_name'],
			"aci_cd"				=> $_POST['aci_cd'],
			"aci_nm"				=> $_POST['aci_nm'],
			"bank_manager"			=> $_POST['bank_manager'],
			"search_box"			=> $_POST['search_box'],
			"use_yn"				=> $_POST['use_yn'],
			"re_mark"				=> $_POST['re_mark'],
			"regdate"				=> $now
		);

		$bank_list = new Accounting;
		$result = $bank_list->insertBankData($data);
		//if($result) $this->movePage("accounting","listPageAccountingCode");
		if($result) require_once ("views/accounting/basic/bank/bank_reg_pop.php");
		}

	public function registBankUpdate() {
		$now = date("Y-m-d H:i:s");
		$data = array(
			"table" => "erp_cardcompany",
			"where" => "idx=".$_POST['idx'],
			"bank_name"				=> $_POST['bank_name'],
			"bank_type"				=> $_POST['bank_type'],
			"pay_account_name"		=> $_POST['pay_account_name'],
			"aci_cd"				=> $_POST['aci_cd'],
			"aci_nm"				=> $_POST['aci_nm'],
			"bank_manager"			=> $_POST['bank_manager'],
			"search_box"			=> $_POST['search_box'],
			"use_yn"				=> $_POST['use_yn'],
			"re_mark"				=> $_POST['re_mark'],
			"regdate"				=> $now
		);
		$bank_list = new Accounting;
		$result = $bank_list->UpdateBankData($data);
		//if($result) $this->movePage("accounting","listPageAccountingCode");
		if($result) require_once ("views/accounting/basic/bank/bank_reg_pop.php");
	}
	

	public function registPrintAppLineInsert(){
		$now = date("Y-m-d H:i:s");

		$ARRAY_DIVID = ",";
		for($i=0; $i<count($_POST['approval_name1']); $i++) {
			$NAME1_ARR[$i] = $_POST['approval_name1'][$i];
			$WIDTH1_ARR[$i] = $_POST['approval_width1'][$i];
			$FONT1_ARR[$i] = $_POST['approval_font1'][$i];
			$NAME2_ARR[$i] = $_POST['approval_name2'][$i];
			$WIDTH2_ARR[$i] = $_POST['approval_width2'][$i];
			$FONT2_ARR[$i] = $_POST['approval_font2'][$i];
		}
		$NAME1 = implode($ARRAY_DIVID,$NAME1_ARR);
		$WIDTH1 = implode($ARRAY_DIVID,$WIDTH1_ARR);
		$FONT1 = implode($ARRAY_DIVID,$FONT1_ARR);
		$NAME2 = implode($ARRAY_DIVID,$NAME2_ARR);
		$WIDTH2 = implode($ARRAY_DIVID,$WIDTH2_ARR);
		$FONT2 = implode($ARRAY_DIVID,$FONT2_ARR);
		
		$data = array(
			"table"					=> "erp_print_appline",
			"approval_name1"		=> $NAME1,
			"approval_width1"		=> $WIDTH1,
			"approval_font1"		=> $FONT1,
			"approval_name2"		=> $NAME2,
			"approval_width2"		=> $WIDTH2,
			"approval_font2"		=> $FONT2,
			"regdate"				=> $now
		);

		$print_appline_list = new Accounting;
		$result = $print_appline_list->insertPrintApplineData($data);
		//if($result) $this->movePage("accounting","listPageAccountingCode");
		if($result) require_once ("views/accounting/basic/print/print_approval_regist.php");
		}


	public function registPrintAppLineUpdate() {
		$now = date("Y-m-d H:i:s");
		$ARRAY_DIVID = ",";
		for($i=0; $i<count($_POST['approval_name1']); $i++) {
			$NAME1_ARR[$i] = $_POST['approval_name1'][$i];
			$WIDTH1_ARR[$i] = $_POST['approval_width1'][$i];
			$FONT1_ARR[$i] = $_POST['approval_font1'][$i];
			$NAME2_ARR[$i] = $_POST['approval_name2'][$i];
			$WIDTH2_ARR[$i] = $_POST['approval_width2'][$i];
			$FONT2_ARR[$i] = $_POST['approval_font2'][$i];
		}
		$NAME1 = implode($ARRAY_DIVID,$NAME1_ARR);
		$WIDTH1 = implode($ARRAY_DIVID,$WIDTH1_ARR);
		$FONT1 = implode($ARRAY_DIVID,$FONT1_ARR);
		$NAME2 = implode($ARRAY_DIVID,$NAME2_ARR);
		$WIDTH2 = implode($ARRAY_DIVID,$WIDTH2_ARR);
		$FONT2 = implode($ARRAY_DIVID,$FONT2_ARR);
		$data = array(
			"table"					=> "erp_print_appline",
			"where"					=> "uid=".$_POST['uid'],
			"approval_name1"		=> $NAME1,
			"approval_width1"		=> $WIDTH1,
			"approval_font1"		=> $FONT1,
			"approval_name2"		=> $NAME2,
			"approval_width2"		=> $WIDTH2,
			"approval_font2"		=> $FONT2,
			"regdate"				=> $now
		);
		$print_appline_list = new Accounting;
		$result = $print_appline_list->UpdatePrintApplineData($data);
		//if($result) $this->movePage("accounting","registPrintApproval");
		if($result) require_once ("views/accounting/basic/print/print_approval_regist.php");
	}

	
		
	public function test($uid) {

		$query = "select * from erp_print_appline where uid=".$uid;
		$res = mysql_fetch_object(mysql_query($query));

		$data = array(
			"approval_name1" => $res->approval_name1,
			"approval_width1" => $res->approval_width1,
			"approval_font1" => $res->approval_font1,
			"approval_name2" => $res->approval_name1,
			"approval_width2" => $res->approval_width1,
			"approval_font2" => $res->approval_font1
		);
	
	return $data;
	}
	

	public function registCardCompanyInsert(){
		$now = date("Y-m-d H:i:s");
		$data = array(
			"table"					=> "erp_cardcompany",
			"card_ccode"			=> $_POST['card_ccode'],
			"card_cname"			=> $_POST['card_cname'],
			"card_cnum"				=> $_POST['card_cnum'],
			"aci_cd"				=> $_POST['aci_cd'],
			"aci_nm"				=> $_POST['aci_nm'],
			"com_rate"				=> $_POST['com_rate'],
			"search_box"			=> $_POST['search_box'],
			"use_yn"				=> $_POST['use_yn'],
			"re_mark"				=> $_POST['re_mark'],
			"regdate"				=> $now
		);

		$bank_list = new Accounting;
		$result = $bank_list->insertCardCompany($data);
		//if($result) $this->movePage("accounting","listPageAccountingCode");
		if($result) require_once ("views/accounting/basic/card/cardcompany_reg_pop.php");
		}

	public function registCardCompanyUpdate() {
		$now = date("Y-m-d H:i:s");
		$data = array(
			"table" => "erp_cardcompany",
			"where"					=> "uid=".$_POST['uid'],
			"card_ccode"			=> $_POST['card_ccode'],
			"card_cname"			=> $_POST['card_cname'],
			"card_cnum"				=> $_POST['card_cnum'],
			"aci_cd"				=> $_POST['aci_cd'],
			"aci_nm"				=> $_POST['aci_nm'],
			"com_rate"				=> $_POST['com_rate'],
			"search_box"			=> $_POST['search_box'],
			"use_yn"				=> $_POST['use_yn'],
			"re_mark"				=> $_POST['re_mark'],
			"regdate"				=> $now
		);
		$bank_list = new Accounting;
		$result = $bank_list->UpdateCardCompany($data);
		//if($result) $this->movePage("accounting","listPageAccountingCode");
		if($result) require_once ("views/accounting/basic/card/cardcompany_reg_pop.php");
	}
	
		public function upload($file) {
		// 폴더생성
		@mkdir("attach/", 0777);

		$dir = "attach/"; //저장될 폴더 경로(끝에 '/'슬래시 꼭 붙여주세요...^^)
		chmod("$dir", 0777);

		$varName = $file; //이전 페이지에서 설정된 file 변수명
		$allowExt = "jpg,gif,png,jpeg,JPG,GIF,PNG,doc,DOC,docx,Docx"; //업로드 가능한 확장자 (,)콤마로 구분

		$prefix = time(); //파일명 앞에 자동으로 붙을 단어

		
		if($_FILES[$varName][name] && $_FILES[$varName][error] == 0) {
			// $dir 폴더가 지정됐고, 사용가능 한지 검사
			if(!$dir) {
				$this->goBack("업로드 폴더가 지정되지 않았습니다.");
				exit;
			}
			if(!is_writable($dir)) {
				$this->goBack("업로드 폴더 권한을 확인해 주세요.");
				exit;
			}

			// php.ini 파일에 설정된 upload_max_filesize 값을 이용해서 업로드 파일이 용량을 초과했는지검사
			$allowSize = intval(substr(ini_get(upload_max_filesize),0,-1)) * 1024 * 1024;
			if($allowSize < $_FILES[$varName][size]) {
				$this->goBack("파일 용량이 허용된 용량을 초과했습니다.");
				exit;
			}

			// 정상적인 방법으로 업로드 된 파일인지 검사 후 정상이면 파일 업로드 처리
			if(is_uploaded_file($_FILES[$varName][tmp_name])) {
				// 확장자 검사
				$ext = substr(strrchr($_FILES[$varName][name],"."),1);
				if($ext) {
					$allow = explode(",",$allowExt);
					if(is_array($allow)) $check = in_array($ext,$allow);
					else $check = ($ext == $allow) ? true : false;
				}
		
				if(!$ext || !$check) {
					$this->goBack("업로드 불가능한 확장자 입니다.");
					exit;
				}

				// 파일명 생성 및 존재하는지 검사
				// $newfile = md5($prefix.$_FILES[$varName][name]).".".$ext;
				$newfile = $prefix.$_FILES[$varName][name];

				if(file_exists($dir.$newfile)) {
					$this->goBack("같은이름의 화일이 있습니다. 화일명을 변경하고 업로드 하시기 바랍니다.");
					exit;
				}

				// $dir 에 파일 저장
				if(!move_uploaded_file($_FILES[$varName][tmp_name], $dir.$newfile)) {
					$this->goBack("파일 업로드에 실패했습니다.");
					exit;
				}
		
				if(!chmod($dir.$newfile,0707)) {
					$this->goBack("퍼미션변경에 실패했습니다.");
					exit;
				}

				return $newfile;
			}
		}
	}
	
	public function replaceComma($num) {
		$number = (int)str_replace(",","",$num);
		return $number;
	}
	
	public function registGeneralStatementInsert() {
		$now = date("Y-m-d H:i:s");
		//$fileAttach = $this->upload('attach');
		$query = "select MAX(statement_ca) AS macha from erp_g_statement where statement_dt='" . $_POST['statement_dt'] ."'";
		$row = mysql_fetch_array(mysql_query($query));
		$cha = $row['macha']+1;

		$data = array(
			"table" => "erp_g_statement",
			"statement_dt"	=> $_POST['statement_dt'],
			"statement_ca"	=> $cha,
			"statement_type"	=> $_POST['statement_type'],
			"etc"			=> $_POST['etc'],
			"total_price"	=> $_POST['totalprice'],
			"regdate"		=> $now
		);

		$statement = new Accounting;
		$gid = $statement->registGeneralStatementInsertId($data); //gid 값 맥스
		//$cha = $statement->StatementChaMax($_POST['statement_dt'],$_POST['statement_ca']); 
			
		$statement_gid = $_POST['statement_dt']."-".$cha;
		//일반전표 참조키 구하기
		$slip_gubun		= $_POST['slip_gubun'];
		$aci_cd			= $_POST['aci_cd'];
		$aci_nm			= $_POST['aci_nm'];
		$account_cd		= $_POST['account_cd'];
		$account_nm		= $_POST['account_nm'];
		$debtor			= $_POST['debtor'];
		$creditor		= $_POST['creditor'];
		$remark_code	= $_POST['remark_code'];
		$summary		= $_POST['summary'];
		$writer			= $_POST['writer'];
		$project_cd		= $_POST['project_cd'];
		$project_nm		= $_POST['project_nm'];
		$regdate		= $now;

		foreach($aci_cd as $key => $val) {
			if($val != "") {
				$data = array(
					"table" => "erp_g_statement_item",
					"gid"			=> $gid,
					"statement_gid" => $statement_gid,
					"slip_gubun"	=> $slip_gubun[$key],
					"aci_cd"		=> $val,
					"aci_nm"		=> $aci_nm[$key],
					"account_cd"	=> $account_cd[$key],
					"account_nm"	=> $account_nm[$key],
					"debtor"		=> $debtor[$key],
					"creditor"		=> $creditor[$key],
					"remark_code"	=> $remark_code[$key],
					"remark"		=> $remark[$key],
					"writer"		=> $writer[$key],
					"project_cd"	=> $project_cd[$key],
					"project_nm"	=> $project_nm[$key],
				);
				$statement->registGeneralStatementItem($data);
			}
		}
		
		if ($_POST['remark']==""){
			$remarks = $remark[0];
		}else{
			$remarks = $_POST['remark'][0];
		}

		$data = array(
		"table" => "erp_statement",
		"statement_dt"		=> $_POST['statement_dt'],
		"statement_ca"		=> $cha,
		"trade_type"		=> "G",
		"department_cd"		=> $_POST['department_cd'],
		"department_nm"		=> $_POST['department_nm'],
		"project_cd"		=> $_POST['project_cd'],
		"project_nm"		=> $_POST['project_nm'],
		"account_cd"		=> $account_cd[0],
		"account_nm"		=> $account_nm[0],
		"aci_cd"			=> $aci_cd[0],
		"aci_nm"			=> $aci_nm[0],
		"statement_no"		=> $gid,
		"bill_matured_date"	=> $_POST['bill_matured_date'],
		"vattype_cd"		=> $_POST['vattype_cd'],
		"vattype_nm"		=> $_POST['vattype_nm'],
		"invoiceType"		=> $_POST['invoiceType'],
		"supply_price"		=> str_replace(",","",$supply_price[0]),
		"tax"				=> str_replace(",","",$tax[0]),
		"fee"				=> str_replace(",","",$_POST['fee']),
		"total_price"		=> str_replace(",","",$_POST['totalprice']),
		"total_tax"			=> str_replace(",","",$_POST['totaltax']),
		"total_amount"		=> str_replace(",","",$_POST['totalprice']),
		"foreign_currency"	=> str_replace(",","",$_POST['foreign_currency']),
		"debtor"			=> str_replace(",","",$_POST['debtor']),
		"creditor"			=> str_replace(",","",$_POST['creditor']),
		"bond_debt_no"		=> $_POST['bond_debt_no'],
		"expired_date"		=> $_POST['expired_date'],
		"remark"			=> $_POST['summary'],
		"inventory_slips_yn"=> $_POST['inventory_slips_yn'],
		"approval_date"		=> $_POST['approval_date'],
		"approval_date_no"	=> $_POST['approval_date_no'],
		"accounting_no"		=> $_POST['accounting_no'],
		"writer"			=> $_POST['writer'],
		"regdate"			=> $now,
		"modifier"			=> $_POST['modifier'],
		"modifydate"		=> $now,
		);
	
		$statement->registStatementInsert($data); //gid 값 맥스

		//$this->movePagePop("accounting","registGeneralStatementPop");
		$this->movePageClose($_POST['dialogid']);
	}

	public function registGeneralStatementUpdate() {
		$now = date("Y-m-d H:i:s");

		$data = array(
			"table" => "erp_g_statement",
			"where" =>	"gid=".$_POST['gid'],
			"invoiceType"	=> $_POST['invoiceType'],
			"etc"			=> $_POST['etc'],
			"total_price"	=> $_POST['totalprice'],
			"regdate"		=> $now
		);

		$statement = new Accounting;
		$statement->generalStatementUpdate($data); //gid 값 맥스
		//$cha = $statement->StatementChaMax($_POST['statement_dt'],$_POST['statement_ca']); 

		$statement_gid = $_POST['statement_dt']."-".$_POST['statement_ca'];
		$gid = $_POST['gid'];

		$idx_arr		= $_POST['idx_arr'];
		$slip_gubun		= $_POST['slip_gubun'];
		$aci_cd			= $_POST['aci_cd'];
		$aci_nm			= $_POST['aci_nm'];
		$account_cd		= $_POST['account_cd'];
		$account_nm		= $_POST['account_nm'];
		$debtor			= $_POST['debtor'];
		$creditor		= $_POST['creditor'];
		$remark_code	= $_POST['remark_code'];
		$remark			= $_POST['remark'];
		$writer			= $_POST['writer'];
		$project_cd		= $_POST['project_cd'];
		$project_nm		= $_POST['project_nm'];
		$regdate		= $now;

		foreach($aci_cd as $key => $val) {
			if($val != "") {
				$data = array(
					"table"			=> "erp_g_statement_item",
					"where"			=> "uid=".$idx_arr[$key],
					"slip_gubun"	=> $slip_gubun[$key],
					"aci_cd"		=> $val,
					"aci_nm"		=> $aci_nm[$key],
					"account_cd"	=> $account_cd[$key],
					"account_nm"	=> $account_nm[$key],
					"debtor"		=> $debtor[$key],
					"creditor"		=> $creditor[$key],
					"remark_code"	=> $remark_code[$key],
					"remark"		=> $remark[$key],
					"writer"		=> $writer[$key],
					"project_cd"	=> $project_cd[$key],
					"project_nm"	=> $project_nm[$key],
				);
				$result=$statement->generalStatementItemUpdate($data);

				if ($result==false){
					$data = array(
					"table"				=> "erp_g_statement_item",
					"gid"				=> $gid,
					"statement_gid"		=> $statement_gid,
					"aci_cd"			=> $val,
					"aci_nm"			=> $aci_nm[$key],
					"account_cd"		=> $account_cd[$key],
					"account_nm"		=> $account_nm[$key],
					"debtor"			=> $debtor[$key],
					"creditor"			=> $creditor[$key],
					"remark_code"		=> $remark_code[$key],
					"remark"			=> $remark[$key],
					"writer"			=> $writer[$key],
					"project_cd"		=> $project_cd[$key],
					"project_nm"		=> $project_nm[$key],
					);
				$statement->registGeneralStatementItem($data);
			}
		}

		if ($_POST['remark']==""){
			$remarks = $remark[0];
		}else{
			$remarks = $_POST['remark'][0];
		}
		if ($_POST['uid']==""){
			$query = "select uid from erp_statement where 1=1 and statement_dt='" . $_POST['statement_dt'] ."' and statement_ca='" . $_POST['statement_ca'] ."' and trade_type='G' and statement_no='" . $_POST['gid'] ."'";
			$row = mysql_fetch_array(mysql_query($query));
			$uid = $row['uid'];
		}else{
			$uid = $_POST['uid'];
		}
		//  매출전표리스트에서 수정하면 해당 전표조회 테이블에 수정사항이 반영되지 않아 전표저회테이블의 UID 값을 저장해서 연동해야 함.

		$data = array(
		"table"				=> "erp_statement",
		"where"				=> "uid=".$uid,
		"statement_dt"		=> $_POST['statement_dt'],
		"statement_ca"		=> $_POST['statement_ca'],
		"trade_type"		=> "G",
		"department_cd"		=> $_POST['department_cd'],
		"department_nm"		=> $_POST['department_nm'],
		"project_cd"		=> $_POST['project_cd'],
		"project_nm"		=> $_POST['project_nm'],
		"account_cd"		=> $account_cd[0],
		"account_nm"		=> $account_nm[0],
		"aci_cd"			=> $aci_cd[0],
		"aci_nm"			=> $aci_nm[0],
		"statement_no"		=> $_POST['gid'],
		"bill_matured_date"	=> $_POST['bill_matured_date'],
		"vattype_cd"		=> $_POST['vattype_cd'],
		"vattype_nm"		=> $_POST['vattype_nm'],
		"invoiceType"		=> $_POST['invoiceType'],
		"supply_price"		=> str_replace(",","",$supply_price[0]),
		"tax"				=> str_replace(",","",$tax[0]),
		"fee"				=> str_replace(",","",$_POST['fee']),
		"total_price"		=> str_replace(",","",$_POST['totalprice']),
		"total_tax"			=> str_replace(",","",$_POST['totaltax']),
		"total_amount"		=> str_replace(",","",$_POST['totalprice']),
		"foreign_currency"	=> str_replace(",","",$_POST['foreign_currency']),
		"debtor"			=> str_replace(",","",$_POST['debtor']),
		"creditor"			=> str_replace(",","",$_POST['creditor']),
		"bond_debt_no"		=> $_POST['bond_debt_no'],
		"expired_date"		=> $_POST['expired_date'],
		"remark"			=> $_POST['summary'],
		"inventory_slips_yn"=> $_POST['inventory_slips_yn'],
		"approval_date"		=> $_POST['approval_date'],
		"approval_date_no"	=> $_POST['approval_date_no'],
		"accounting_no"		=> $_POST['accounting_no'],
		//"writer"			=> $_POST['writer'],
		//"regdate"			=> $now,
		"modifier"			=> $_POST['modifier'],
		"modifydate"		=> $now,
		);
	
		$statement->registStatementUpdate($data); //gid 값 맥스
	}
		//$this->movePagePop("accounting","registGeneralStatementPop");
		$this->movePageClose($_POST['dialogid']);
	
	}

	public function registSalesStatementInsert() {
		$now = date("Y-m-d H:i:s");
		//$fileAttach = $this->upload('attach');
		$query = "select MAX(statement_ca) AS macha from erp_s_statement where statement_dt='" . $_POST['statement_dt'] ."'";
		$row = mysql_fetch_array(mysql_query($query));
		$cha = $row['macha']+1;

		$data = array(
			"table" => "erp_s_statement",
			"statement_dt"				=> $_POST['statement_dt'],
			"statement_ca"				=> $cha,
			"department_cd"				=> $_POST['department_cd'],
			"department_nm"				=> $_POST['department_nm'],
			"project_cd"				=> $_POST['project_cd'],
			"project_nm"				=> $_POST['project_nm'],
			"account_cd"				=> $_POST['account_cd'],
			"account_nm"				=> $_POST['account_nm'],
			"vattype"					=> $_POST['vattype'],
			"tax_deduct"				=> $_POST['tax_deduct'],
			"invoiceType"				=> $_POST['invoiceType'],
			"total_price"				=> str_replace(",","",$_POST['totalprice']),
			"total_tax"					=> str_replace(",","",$_POST['totaltax']),
			"summary"					=> $_POST['summary'],
			"receiptfee_cd"				=> $_POST['receiptfee_cd'],
			"receiptfee_nm"				=> $_POST['receiptfee_nm'],
			"receiptfee_price"			=> str_replace(",","",$_POST['receiptfee_price']),
			"bank_num"					=> $_POST['bank_num'],
			"bank_name"					=> $_POST['bank_name'],
			"receiptbank_num"			=> str_replace(",","",$_POST['receiptbank_num']),
			"accountsrecev_cd"			=> $_POST['accountsrecev_cd'],
			"accountsrecev_nm"			=> $_POST['accountsrecev_nm'],
			"accounts_recev_price"		=> str_replace(",","",$_POST['accounts_recev_price']),
			"regdate"		=> $now
		);

		$statement = new Accounting;
		$sid = $statement->registSalesStatementInsertId($data); //gid 값 맥스
		//$cha = $statement->StatementChaMax($_POST['statement_dt'],$_POST['statement_ca']); 
			
		$statement_sid = $_POST['statement_dt']."-".$cha;
		//일반전표 참조키 구하기
		$slip_gubun		= $_POST['slip_gubun'];
		$aci_cd			= $_POST['aci_cd'];
		$aci_nm			= $_POST['aci_nm'];
		$supply_price		= $_POST['supply_price'];
		$tax			= $_POST['tax'];
		$remark			= $_POST['remark'];
		$writer			= $_POST['writer'];
		$regdate		= $now;
		//echo $remark[0]."<BR>";
		foreach($aci_cd as $key => $val) {
			if($val != "") {
				$data = array(
					"table"				=> "erp_s_statement_item",
					"sid"				=> $sid,
					"statement_sid"		=> $statement_sid,
					"aci_cd"			=> $val,
					"aci_nm"			=> $aci_nm[$key],
					"supply_price"		=> $supply_price[$key],
					"tax"				=> $tax[$key],
					"remark"			=> $remark[$key],
					"writer"			=> $writer[$key],
				);
				$statement->registSalesStatementItem($data);
				"remark".$key=$remark[$key];
				//echo "remark".$key."<BR>";
			}
		}
		

		$data = array(
		"table" => "erp_statement",
		"statement_dt"		=> $_POST['statement_dt'],
		"statement_ca"		=> $cha,
		"trade_type"		=> "S",
		"department_cd"		=> $_POST['department_cd'],
		"department_nm"		=> $_POST['department_nm'],
		"project_cd"		=> $_POST['project_cd'],
		"project_nm"		=> $_POST['project_nm'],
		"account_cd"		=> $_POST['account_cd'],
		"account_nm"		=> $_POST['account_nm'],
		"aci_cd"			=> $aci_cd[0],
		"aci_nm"			=> $aci_nm[0],
		"statement_no"		=>  $sid,
		"bill_matured_date"	=> $_POST['bill_matured_date'],
		"vattype_cd"		=> $_POST['vattype_cd'],
		"vattype_nm"		=> $_POST['vattype_nm'],
		"invoiceType"		=> $_POST['invoiceType'],
		"supply_price"		=> str_replace(",","",$supply_price[0]),
		"tax"				=> str_replace(",","",$tax[0]),
		"fee"				=> str_replace(",","",$_POST['fee']),
		"total_price"		=> str_replace(",","",$_POST['totalprice']),
		"total_tax"			=> str_replace(",","",$_POST['totaltax']),
		"total_amount"		=> str_replace(",","",$_POST['totalprice']) + str_replace(",","",$_POST['totaltax']),
		"foreign_currency"	=> str_replace(",","",$_POST['foreign_currency']),
		"debtor"			=> str_replace(",","",$_POST['totalprice']) + str_replace(",","",$_POST['totaltax']),
		"creditor"			=> str_replace(",","",$_POST['totalprice']) + str_replace(",","",$_POST['totaltax']),
		"bond_debt_no"		=> $_POST['bond_debt_no'],
		"expired_date"		=> $_POST['expired_date'],
		"remark"			=> $_POST['summary'],
		"inventory_slips_yn"=> $_POST['inventory_slips_yn'],
		"approval_date"		=> $_POST['approval_date'],
		"approval_date_no"	=> $_POST['approval_date_no'],
		"accounting_no"		=> $_POST['accounting_no'],
		"writer"			=> $_POST['writer'],
		"regdate"			=> $now,
		"modifier"			=> $_POST['modifier'],
		"modifydate"		=> $now,
		);
	
		$statement->registStatementInsert($data); //gid 값 맥스
			
		//$this->movePagePop("accounting","registSalesStatementPop");
		$this->movePageClose($_POST['dialogid']);
	}


	public function registSalesStatementUpdate() {
		$now = date("Y-m-d H:i:s");
		$data = array(
			"table"				=> "erp_s_statement",
			"where"				=> "sid=".$_POST['sid'],
			"department_cd"		=> $_POST['department_cd'],
			"department_nm"		=> $_POST['department_nm'],
			"project_cd"		=> $_POST['project_cd'],
			"project_nm"		=> $_POST['project_nm'],
			"account_cd"		=> $_POST['account_cd'],
			"account_nm"		=> $_POST['account_nm'],
			"vattype"			=> $_POST['vattype'],
			"tax_deduct"		=> $_POST['tax_deduct'],
			"invoiceType"		=> $_POST['invoiceType'],
			"total_price"		=> str_replace(",","",$_POST['totalprice']),
			"total_tax"			=> str_replace(",","",$_POST['totaltax']),
			"summary"			=> $_POST['summary'],
			"receiptfee_cd"		=> $_POST['receiptfee_cd'],
			"receiptfee_nm"		=> $_POST['receiptfee_nm'],
			"receiptfee_price"	=> str_replace(",","",$_POST['receiptfee_price']),
			"bank_num"			=> $_POST['bank_num'],
			"bank_name"			=> $_POST['bank_name'],
			"receiptbank_num"	=> str_replace(",","",$_POST['receiptbank_num']),
			"accountsrecev_cd"	=> $_POST['accountsrecev_cd'],
			"accountsrecev_nm"	=> $_POST['accountsrecev_nm'],
			"accounts_recev_price"=> str_replace(",","",$_POST['accounts_recev_price']),
			"regdate"		=> $now
		);

		$statement = new Accounting;
		$statement->salesStatementUpdate($data); //gid 값 맥스
		
		$statement_sid = $_POST['statement_dt']."-".$_POST['statement_ca'];
		$sid = $_POST['sid'];

		$idx_arr		= $_POST['idx_arr'];
		$slip_gubun		= $_POST['slip_gubun'];
		$aci_cd			= $_POST['aci_cd'];
		$aci_nm			= $_POST['aci_nm'];
		$supply_price	= $_POST['supply_price'];
		$tax			= $_POST['tax'];
		$remark			= $_POST['remark'];
		$writer			= $_POST['writer'];
		$regdate		= $now;

		foreach($aci_cd as $key => $val) {
			if($val != "") {
				$data = array(
					"table"				=> "erp_s_statement_item",
					"where"				=> "uid=".$idx_arr[$key],
					"aci_cd"			=> $val,
					"aci_nm"			=> $aci_nm[$key],
					"supply_price"		=> $supply_price[$key],
					"tax"				=> $tax[$key],
					"remark"			=> $remark[$key],
					"writer"			=> $writer[$key],
				);
				$result = $statement->salesStatementItemUpdate($data);

				if ($result==false){
					$data = array(
					"table"				=> "erp_s_statement_item",
					"sid"				=> $sid,
					"statement_sid"		=> $statement_sid,
					"aci_cd"			=> $val,
					"aci_nm"			=> $aci_nm[$key],
					"supply_price"		=> $supply_price[$key],
					"tax"				=> $tax[$key],
					"remark"			=> $remark[$key],
					"writer"			=> $writer[$key],
					);
				$statement->registSalesStatementItem($data);
				}
			}
		}
		

		if ($_POST['uid']==""){
			$query = "select uid from erp_statement where 1=1 and statement_dt='" . $_POST['statement_dt'] ."' and statement_ca='" . $_POST['statement_ca'] ."' and trade_type='S' and statement_no='" . $_POST['sid'] ."'";
			$row = mysql_fetch_array(mysql_query($query));
			$uid = $row['uid'];
		}else{
			$uid = $_POST['uid'];
		}
		//  매출전표리스트에서 수정하면 해당 전표조회 테이블에 수정사항이 반영되지 않아 전표저회테이블의 UID 값을 저장해서 연동해야 함.

		$data = array(
		"table"				=> "erp_statement",
		"where"				=> "uid=".$uid,
		"statement_dt"		=> $_POST['statement_dt'],
		"statement_ca"		=> $_POST['statement_ca'],
		"trade_type"		=> "S",
		"department_cd"		=> $_POST['department_cd'],
		"department_nm"		=> $_POST['department_nm'],
		"project_cd"		=> $_POST['project_cd'],
		"project_nm"		=> $_POST['project_nm'],
		"account_cd"		=> $_POST['account_cd'],
		"account_nm"		=> $_POST['account_nm'],
		"aci_cd"			=> $aci_cd[0],
		"aci_nm"			=> $aci_nm[0],
		"statement_no"		=> $_POST['sid'],
		"bill_matured_date"	=> $_POST['bill_matured_date'],
		"vattype_cd"		=> $_POST['vattype_cd'],
		"vattype_nm"		=> $_POST['vattype_nm'],
		"invoiceType"		=> $_POST['invoiceType'],
		"supply_price"		=> str_replace(",","",$supply_price[0]),
		"tax"				=> str_replace(",","",$tax[0]),
		"fee"				=> str_replace(",","",$_POST['fee']),
		"total_price"		=> str_replace(",","",$_POST['totalprice']),
		"total_tax"			=> str_replace(",","",$_POST['totaltax']),
		"total_amount"		=> str_replace(",","",$_POST['totalprice']) + str_replace(",","",$_POST['totaltax']),
		"foreign_currency"	=> str_replace(",","",$_POST['foreign_currency']),
		"debtor"			=> str_replace(",","",$_POST['totalprice']) + str_replace(",","",$_POST['totaltax']),
		"creditor"			=> str_replace(",","",$_POST['totalprice']) + str_replace(",","",$_POST['totaltax']),
		"bond_debt_no"		=> $_POST['bond_debt_no'],
		"expired_date"		=> $_POST['expired_date'],
		"remark"			=> $_POST['summary'],
		"inventory_slips_yn"=> $_POST['inventory_slips_yn'],
		"approval_date"		=> $_POST['approval_date'],
		"approval_date_no"	=> $_POST['approval_date_no'],
		"accounting_no"		=> $_POST['accounting_no'],
		//"writer"			=> $_POST['writer'],
		//"regdate"			=> $now,
		"modifier"			=> $_POST['modifier'],
		"modifydate"		=> $now,
		);
	
		$statement->registStatementUpdate($data); //gid 값 맥스
	
		//$this->movePagePop("accounting","registSalesStatementPop");
		$this->movePageClose($_POST['dialogid']);
	}

	public function registPurchaseStatementInsert() {
		$now = date("Y-m-d H:i:s");
		//$fileAttach = $this->upload('attach');
		$query = "select MAX(statement_ca) AS macha from erp_p_statement where statement_dt='" . $_POST['statement_dt'] ."'";
		$row = mysql_fetch_array(mysql_query($query));
		$cha = $row['macha']+1;

		$data = array(
			"table" => "erp_p_statement",
			"statement_dt"	=> $_POST['statement_dt'],
			"statement_ca"	=> $cha,
			"department_cd"	=> $_POST['department_cd'],
			"department_nm"	=> $_POST['department_nm'],
			"project_cd"	=> $_POST['project_cd'],
			"project_nm"	=> $_POST['project_nm'],
			"vattype"		=> $_POST['vattype'],
			"tax_deduct"	=> $_POST['tax_deduct'],
			"invoiceType"	=> $_POST['invoiceType'],
			"account_cd"	=> $_POST['account_cd'],
			"account_nm"	=> $_POST['account_nm'],
			"supply_price"	=> str_replace(",","",$_POST['supply_price']),
			"tax"			=> str_replace(",","",$_POST['tax']),
			"total_amount"    => str_replace(",","",$_POST['supply_price']) + str_replace(",","",$_POST['tax']),
			"remark"		=> $_POST['remark'],
			"aci_cd"		=> $_POST['aci_cd'],
			"aci_nm"		=> $_POST['aci_nm'],
			"bank_num"		=> $_POST['bank_num'],
			"bank_name"		=> $_POST['bank_name'],
			"etc"			=> $_POST['etc'],
			"regdate"		=> $now
		);

		$statement = new Accounting;
		$pid = $statement->registPurchaseStatementInsertId($data); 

		$data = array(
		"table" => "erp_statement",
		"statement_dt"		=> $_POST['statement_dt'],
		"statement_ca"		=> $cha,
		"trade_type"		=> "P",
		"department_cd"		=> $_POST['department_cd'],
		"department_nm"		=> $_POST['department_nm'],
		"project_cd"		=> $_POST['project_cd'],
		"project_nm"		=> $_POST['project_nm'],
		"account_cd"		=> $_POST['account_cd'],
		"account_nm"		=> $_POST['account_nm'],
		"aci_cd"			=> $_POST['aci_cd'],
		"aci_nm"			=> $_POST['aci_nm'],
		"statement_no"		=> $pid,
		"bill_matured_date"	=> $_POST['bill_matured_date'],
		"vattype_cd"		=> $_POST['vattype_cd'],
		"vattype_nm"		=> $_POST['vattype_nm'],
		"invoiceType"		=> $_POST['invoiceType'],
		"supply_price"		=> str_replace(",","",$_POST['supply_price']),
		"tax"				=> str_replace(",","",$_POST['tax']),
		"fee"				=> str_replace(",","",$_POST['fee']),
		"total_price"		=> str_replace(",","",$_POST['totalprice']),
		"total_tax"			=> str_replace(",","",$_POST['totaltax']),
		"total_amount"		=> str_replace(",","",$_POST['supply_price']) + str_replace(",","",$_POST['tax']),
		"foreign_currency"	=> str_replace(",","",$_POST['foreign_currency']),
		"debtor"			=> str_replace(",","",$_POST['supply_price']) + str_replace(",","",$_POST['tax']),
		"creditor"			=> str_replace(",","",$_POST['supply_price']) + str_replace(",","",$_POST['tax']),
		"bond_debt_no"		=> $_POST['bond_debt_no'],
		"expired_date"		=> $_POST['expired_date'],
		"remark"			=> $_POST['remark'],
		"inventory_slips_yn"=> $_POST['inventory_slips_yn'],
		"approval_date"		=> $_POST['approval_date'],
		"approval_date_no"	=> $_POST['approval_date_no'],
		"accounting_no"		=> $_POST['accounting_no'],
		"writer"			=> $_POST['writer'],
		"regdate"			=> $now,
		"modifier"			=> $_POST['modifier'],
		"modifydate"		=> $now,
		);
	
		$statement->registStatementInsert($data); //gid 값 맥스

		//$this->movePagePop("accounting","registPurchaseStatementPop");
		$this->movePageClose($_POST['dialogid']);
	}

	public function registPurchaseStatementUpdate() {
		$now = date("Y-m-d H:i:s");
		
		$data = array(
			"table"			=> "erp_p_statement",
			"where"			=> "pid=".$_POST['pid'],
			"department_cd"	=> $_POST['department_cd'],
			"department_nm"	=> $_POST['department_nm'],
			"project_cd"	=> $_POST['project_cd'],
			"project_nm"	=> $_POST['project_nm'],
			"vattype"		=> $_POST['vattype'],
			"tax_deduct"	=> $_POST['tax_deduct'],
			"invoiceType"	=> $_POST['invoiceType'],
			"account_cd"	=> $_POST['account_cd'],
			"account_nm"	=> $_POST['account_nm'],
			"supply_price"	=> str_replace(",","",$_POST['supply_price']),
			"tax"			=> str_replace(",","",$_POST['tax']),
			"total_amount"  => str_replace(",","",$_POST['supply_price']) + str_replace(",","",$_POST['tax']),
			"remark"		=> $_POST['remark'],
			"aci_cd"		=> $_POST['aci_cd'],
			"aci_nm"		=> $_POST['aci_nm'],
			"bank_num"		=> $_POST['bank_num'],
			"bank_name"		=> $_POST['bank_name'],
			"etc"			=> $_POST['etc'],
			"regdate"		=> $now
		);
		
		$statement = new Accounting;
		$pid = $statement->purchaseStatementUpdate($data); 

		if ($_POST['uid']==""){
			$query = "select uid from erp_statement where 1=1 and statement_dt='" . $_POST['statement_dt'] ."' and statement_ca='" . $_POST['statement_ca'] ."' and trade_type='P' and statement_no='" . $_POST['pid'] ."'";
			$row = mysql_fetch_array(mysql_query($query));
			$uid = $row['uid'];
		}else{
			$uid = $_POST['uid'];
		}
		//  매입전표리스트에서 수정하면 해당 전표조회 테이블에 수정사항이 반영되지 않아 전표저회테이블의 UID 값을 저장해서 연동해야 함.
		$data = array(
		"table"				=> "erp_statement",
		"where"				=> "uid=".$uid,
		"statement_dt"		=> $_POST['statement_dt'],
		"statement_ca"		=> $_POST['statement_ca'],
		"trade_type"		=> "P",
		"department_cd"		=> $_POST['department_cd'],
		"department_nm"		=> $_POST['department_nm'],
		"project_cd"		=> $_POST['project_cd'],
		"project_nm"		=> $_POST['project_nm'],
		"account_cd"		=> $_POST['account_cd'],
		"account_nm"		=> $_POST['account_nm'],
		"aci_cd"		=> $_POST['aci_cd'],
		"aci_nm"		=> $_POST['aci_nm'],
		//"statement_no"		=> $_POST['pid'],
		"bill_matured_date"	=> $_POST['bill_matured_date'],
		"vattype_cd"		=> $_POST['vattype_cd'],
		"vattype_nm"		=> $_POST['vattype_nm'],
		"invoiceType"		=> $_POST['invoiceType'],
		"supply_price"		=> str_replace(",","",$_POST['supply_price']),
		"tax"				=> str_replace(",","",$_POST['tax']),
		"fee"				=> str_replace(",","",$_POST['fee']),
		"total_price"		=> str_replace(",","",$_POST['totalprice']),
		"total_tax"			=> str_replace(",","",$_POST['totaltax']),
		"total_amount"		=> str_replace(",","",$_POST['supply_price']) + str_replace(",","",$_POST['tax']),
		"foreign_currency"	=> str_replace(",","",$_POST['foreign_currency']),
		"debtor"			=> str_replace(",","",$_POST['supply_price']) + str_replace(",","",$_POST['tax']),
		"creditor"			=> str_replace(",","",$_POST['supply_price']) + str_replace(",","",$_POST['tax']),
		"bond_debt_no"		=> $_POST['bond_debt_no'],
		"expired_date"		=> $_POST['expired_date'],
		"remark"			=> $_POST['remark'],
		"inventory_slips_yn"=> $_POST['inventory_slips_yn'],
		"approval_date"		=> $_POST['approval_date'],
		"approval_date_no"	=> $_POST['approval_date_no'],
		"accounting_no"		=> $_POST['accounting_no'],
		//"writer"			=> $_POST['writer'],
		//"regdate"			=> $now,
		"modifier"			=> $_POST['modifier'],
		"modifydate"		=> $now,
		);
	
		$statement->registStatementUpdate($data); //gid 값 맥스
		//exit;
		//$this->movePagePop("accounting","registPurchaseStatementPop");
		$this->movePageClose($_POST['dialogid']);
	}

	public function registTaxInvoiceInsert() {

		$now = date("Y-m-d H:i:s");
		//$fileAttach = $this->upload('attach');
		$query = "select MAX(tax_invoice_ca) AS cha from erp_tax_invoice where tax_invoice_dt='" . $_POST['tax_invoice_dt'] ."'";
		$row = mysql_fetch_array(mysql_query($query));
		$cha = $row['cha']+1;

		$data = array(
			"table" => "erp_tax_invoice",
			//"where" => "pid=".$_POST['pid'],
			"tax_invoice_dt"	=> $_POST['tax_invoice_dt'],
			"tax_invoice_ca"	=> $cha,
			"statement_no"		=> $_POST['statement_no'],
			"statement_type"	=> $_POST['statement_type'],
			"settle"			=> $_POST['settle'],
			"settle_amt1"		=> str_replace(",","",$_POST['settle_amt1']),
			"settle_amt2"		=> str_replace(",","",$_POST['settle_amt2']),
			"settle_amt3"		=> str_replace(",","",$_POST['settle_amt3']),
			"settle_amt4"		=> str_replace(",","",$_POST['settle_amt4']),
			"summary"			=> $_POST['summary'],
			"regdate"			=> $now
		);

		$taxinvoice = new Accounting;
		$tid = $taxinvoice->registTaxInvoiceInsertId($data); //tid 값 맥스

		$tax_invoice_dt		= $_POST['tax_invoice_dt'];
		$purchasedt1		= $_POST['purchasedt1'];
		$purchasedt2		= $_POST['purchasedt2'];
		$item_cd			= $_POST['item_cd'];
		$item_nm			= $_POST['item_nm'];
		$standard			= $_POST['standard'];
		$cnt				= $_POST['cnt'];
		$unit_price			= $_POST['unit_price'];
		$supply_price		= $_POST['supply_price'];
		$tax				= $_POST['tax'];
		$total_price		= $_POST['total_price'];
		$total_tax			= $_POST['total_tax'];
		$regdate			= $now;

		foreach($purchasedt1 as $key => $val) {
			if($val != "") {
				$data = array(
					"table"				=> "erp_tax_invoice_item",
					"tid"				=> $tid,
					"tax_invoice_dt"	=> $tax_invoice_dt,
					"purchasedt1"		=> $val,
					"purchasedt2"		=> $purchasedt2[$key],
					"item_cd"			=> $item_cd[$key],
					"item_nm"			=> $item_nm[$key],
					"standard"			=> $standard[$key],
					"cnt"				=> $cnt[$key],
					"unit_price"		=> str_replace(",","",$unit_price[$key]),
					"pro_unit_price"	=> str_replace(",","",$pro_unit_price[$key]),
					"tax"				=> str_replace(",","",$tax[$key]),
					"total_price"		=> str_replace(",","",$total_price[$key]),
					"total_tax"			=> str_replace(",","",$total_tax[$key]),
				);
				$taxinvoice->registTaxInvoiceItem($data);
			}
		}

		$this->movePagePop("accounting","registTaxInvoicePop");
	}

	
	public function registTaxInvoiceUpdate() {
		$now = date("Y-m-d H:i:s");
		$data = array(
			"table"				=> "erp_tax_invoice",
			"where"				=> "tid=".$_POST['tid'],
			//"tax_invoice_dt"	=> $_POST['tax_invoice_dt'],
			"statement_no"		=> $_POST['statement_no'],
			"statement_type"	=> $_POST['statement_type'],
			"settle"			=> $_POST['settle'],
			"settle_amt1"		=> str_replace(",","",$_POST['settle_amt1']),
			"settle_amt2"		=> str_replace(",","",$_POST['settle_amt2']),
			"settle_amt3"		=> str_replace(",","",$_POST['settle_amt3']),
			"settle_amt4"		=> str_replace(",","",$_POST['settle_amt4']),
			"remarks"			=> $_POST['remarks'],
			"regdate"			=> $now
		);

		$taxinvoice = new Accounting;
		$tid = $_POST['tid'];
		$taxinvoice->taxInvoiceUpdate($data); //gid 값 맥스
		//$statement_sid = $_POST['statement_dt']."-".$cha;
		
		$idx_arr			= $_POST['idx_arr'];
		$tax_invoice_dt		= $_POST['tax_invoice_dt'];
		$purchasedt1		= $_POST['purchasedt1'];
		$purchasedt2		= $_POST['purchasedt2'];
		$item_cd			= $_POST['item_cd'];
		$item_nm			= str_replace("'","",$_POST['item_nm']);
		$standard			= str_replace("'","",$_POST['standard']);
		$cnt				= $_POST['cnt'];
		$unit_price			= str_replace(",","",$_POST['unit_price']);
		$pro_unit_price		= str_replace(",","",$_POST['pro_unit_price']);
		$tax				= str_replace(",","",$_POST['tax']);
		$total_price		= str_replace(",","",$_POST['total_price']);
		$total_tax			= str_replace(",","",$_POST['total_tax']);
		$regdate			= $now;

		foreach($purchasedt1 as $key => $val) {
			
			if($val != "") {
				$data = array(
					"table"				=> "erp_tax_invoice_item",
					"where"				=> "uid=".$idx_arr[$key],
					"tax_invoice_dt"	=> $tax_invoice_dt,
					"purchasedt1"		=> $val,
					"purchasedt2"		=> $purchasedt2[$key],
					"item_cd"			=> $item_cd[$key],
					"item_nm"			=> $item_nm[$key],
					"standard"			=> $standard[$key],
					"cnt"				=> $cnt[$key],
					"unit_price"		=> str_replace(",","",$unit_price[$key]),
					"pro_unit_price"	=> str_replace(",","",$pro_unit_price[$key]),
					"tax"				=> str_replace(",","",$tax[$key]),
					"total_price"		=> str_replace(",","",$total_price[$key]),
					"total_tax"			=> str_replace(",","",$total_tax[$key]),
				);
				$result = $taxinvoice->taxInvoiceItemUpdate($data);
				
					if ($result==false){
						$data = array(
						"table"				=> "erp_tax_invoice_item",
						"tid"				=> $tid,
						"tax_invoice_dt"	=> $tax_invoice_dt,
						"purchasedt1"		=> $val,
						"purchasedt2"		=> $purchasedt2[$key],
						"item_cd"			=> $item_cd[$key],
						"item_nm"			=> $item_nm[$key],
						"standard"			=> $standard[$key],
						"cnt"				=> $cnt[$key],
						"unit_price"		=> str_replace(",","",$unit_price[$key]),
						"pro_unit_price"	=> str_replace(",","",$pro_unit_price[$key]),
						"tax"				=> str_replace(",","",$tax[$key]),
						"total_price"		=> str_replace(",","",$total_price[$key]),
						"total_tax"			=> str_replace(",","",$total_tax[$key]),
					);
					$taxinvoice->registTaxInvoiceItem($data);
				} 
			}
		}

		$this->movePagePop("accounting","registTaxInvoicePop");
	}


		
	public function registDepositReport(){
		require_once ('views/accounting/cash/deposit_report_regist.php');
	}

	public function registDepositReportInsert() {

		$now = date("Y-m-d H:i:s");
		//$fileAttach = $this->upload('attach');
		$query = "select MAX(deposit_report_ca) AS cha from erp_deposit_report where deposit_report_dt='" . $_POST['deposit_report_dt'] ."'";
		$row = mysql_fetch_array(mysql_query($query));
		$cha = $row['cha']+1;

		$data = array(
			"table" => "erp_deposit_report",
			"deposit_report_dt"	=> $_POST['deposit_report_dt'],
			"deposit_report_ca"	=> $cha,
			"summary"			=> $_POST['summary'],
			"writer"			=> $_POST['writer'],
			"regdate"			=> $now
		);

		$DepositReport = new Accounting;
		$rid = $DepositReport->registDepositReportInsertId($data); //tid 값 맥스
		
		$deposit_report_rid = $_POST['deposit_report_dt']."-".$cha;

		$bank_num		= $_POST['bank_num'];
		$bank_name		= $_POST['bank_name'];
		$aci_cd			= $_POST['aci_cd'];
		$aci_nm			= $_POST['aci_nm'];
		$account_cd		= $_POST['account_cd'];
		$account_nm		= $_POST['account_nm'];
		$amount			= $_POST['amount'];
		$fee			= $_POST['fee'];
		$remark			= $_POST['remark'];
		$department_cd	= $_POST['department_cd'];
		$department_nm	= $_POST['department_nm'];
		$project_cd		= $_POST['project_cd'];
		$project_nm		= $_POST['project_nm'];
		$regdate		= $now;

		foreach($bank_num as $key => $val) {
			if($val != "") {
				$data = array(
					"table"					=> "erp_deposit_report_item",
					"rid"					=> $rid,
					"deposit_report_rid"	=> $deposit_report_rid,
					"bank_num"				=> $val,
					"bank_name"				=> $bank_name[$key],
					"aci_cd"				=> $aci_cd[$key],
					"aci_nm"				=> $aci_nm[$key],
					"account_cd"			=> $account_cd[$key],
					"account_nm"			=> $account_nm[$key],
					"amount"				=> str_replace(",","",$amount[$key]),
					"fee"					=> str_replace(",","",$tax[$key]),
					"remark"				=> $remark[$key],
					"department_cd"			=> $department_cd[$key],
					"department_nm"			=> $department_nm[$key],
					"project_cd"			=> $project_cd[$key],
					"project_nm"			=> $project_nm[$key],
				);
				$DepositReport->registDepositReportItem($data);
			}
		}

		$this->movePage("accounting","registDepositReport");
	}

	
	public function registDepositReportUpdate() {
		$now = date("Y-m-d H:i:s");
		$data = array(
			"table"				=> "erp_deposit_report",
			"where"				=> "sid=".$_POST['sid'],
			"deposit_report_dt"	=> $_POST['deposit_report_dt'],
			"deposit_report_ca"	=> $cha,
			"summary"			=> $_POST['summary'],
			"writer"			=> $_POST['writer'],
			"regdate"			=> $now
		);

		$DepositReport = new Accounting;
		$DepositReport->depositReportUpdate($data);
		$tid = $_POST['tid'];

		$deposit_report_rid = $_POST['deposit_report_dt']."-".$_POST['deposit_report_ca'];

		$bank_num		= $_POST['bank_num'];
		$bank_name		= $_POST['bank_name'];
		$aci_cd			= $_POST['aci_cd'];
		$aci_nm			= $_POST['aci_nm'];
		$account_cd		= $_POST['account_cd'];
		$account_nm		= $_POST['account_nm'];
		$amount			= $_POST['amount'];
		$fee			= $_POST['fee'];
		$remark			= $_POST['remark'];
		$department_cd	= $_POST['department_cd'];
		$department_nm	= $_POST['department_nm'];
		$project_cd		= $_POST['project_cd'];
		$project_nm		= $_POST['project_nm'];
		$regdate		= $now;

		foreach($purchasedt1 as $key => $val) {
			if($val != "") {
				$data = array(
					"table"					=> "erp_deposit_report_item",
					"where"					=> "uid=".$idx_arr[$key],
					//"deposit_report_rid"	=> $deposit_report_rid,
					"bank_num"				=> $val,
					"bank_name"				=> $bank_name[$key],
					"aci_cd"				=> $aci_cd[$key],
					"aci_nm"				=> $aci_nm[$key],
					"account_cd"			=> $account_cd[$key],
					"account_nm"			=> $account_nm[$key],
					"amount"				=> str_replace(",","",$amount[$key]),
					"fee"					=> str_replace(",","",$tax[$key]),
					"remark"				=> $remark[$key],
					"department_cd"			=> $department_cd[$key],
					"department_nm"			=> $department_nm[$key],
					"project_cd"			=> $project_cd[$key],
					"project_nm"			=> $project_nm[$key],
				);
				$result = $DepositReport->depositReportItemUpdate($data);
				
					if ($result==false){
						$data = array(
						"table"					=> "erp_deposit_report_item",
						"rid"					=> $rid,
						"deposit_report_rid"	=> $deposit_report_rid,
						"bank_num"				=> $val,
						"bank_name"				=> $bank_name[$key],
						"aci_cd"				=> $aci_cd[$key],
						"aci_nm"				=> $aci_nm[$key],
						"account_cd"			=> $account_cd[$key],
						"account_nm"			=> $account_nm[$key],
						"amount"				=> str_replace(",","",$amount[$key]),
						"fee"					=> str_replace(",","",$tax[$key]),
						"remark"				=> $remark[$key],
						"department_cd"			=> $department_cd[$key],
						"department_nm"			=> $department_nm[$key],
						"project_cd"			=> $project_cd[$key],
						"project_nm"			=> $project_nm[$key],
						);
					$DepositReport->registDepositReportItem($data);
				} 
			}
		}

		$this->movePage("accounting","registDepositReport");
	}
	

	public function registCustomerDeposit(){  //매출처 입금
		require_once ('views/accounting/cash/customer_deposit_regist.php');
	}
	
	public function registCustomerDepositInsert() {  //매출처 입금

		$now = date("Y-m-d H:i:s");
		//$fileAttach = $this->upload('attach');
		$query = "select MAX(customer_deposit_ca) AS cha from erp_customer_deposit where customer_deposit_dt='" . $_POST['customer_deposit_dt'] ."'";
		$row = mysql_fetch_array(mysql_query($query));
		$cha = $row['cha']+1;

		$data = array(
			"table" => "erp_customer_deposit",
			//"where" => "pid=".$_POST['pid'],
			"customer_deposit_dt"	=> $_POST['customer_deposit_dt'],
			"customer_deposit_ca"	=> $cha,
			"department_cd"			=> $_POST['department_cd'],
			"department_nm"			=> $_POST['department_nm'],
			"project_cd"			=> $_POST['project_cd'],
			"project_nm"			=> $_POST['project_nm'],
			"bank_num"				=> $_POST['bank_num'],
			"bank_name"				=> $_POST['bank_name'],
			"account_cd"			=> $_POST['account_cd'],
			"account_nm"			=> $_POST['account_nm'],
			"amount"				=> str_replace(",","",$_POST['amount']),
			"fee"					=> str_replace(",","",$_POST['fee']),
			"remark"				=> $_POST['remark'],
			"writer"				=> $_POST['writer'],
			"regdate"				=> $now
		);

		$CustomerDeposit = new Accounting;
		$tid = $CustomerDeposit->registCustomerDepositInsert($data); //tid 값 맥스
		$this->movePage("accounting","registCustomerDeposit");
	}

	
	public function registCustomerDepositUpdate() {
		$now = date("Y-m-d H:i:s");
		$data = array(
			"table"					=> "erp_customer_deposit",
			"where"					=> "uid=".$_POST['uid'],
			//"customer_deposit_dt"	=> $_POST['customer_deposit_dt'],
			//"customer_deposit_ca"	=> $cha,
			"department_cd"			=> $_POST['department_cd'],
			"department_nm"			=> $_POST['department_nm'],
			"project_cd"			=> $_POST['project_cd'],
			"project_nm"			=> $_POST['project_nm'],
			"bank_num"				=> $_POST['bank_num'],
			"bank_name"				=> $_POST['bank_name'],
			"account_cd"			=> $_POST['account_cd'],
			"account_nm"			=> $_POST['account_nm'],
			"amount"				=> str_replace(",","",$_POST['amount']),
			"fee"					=> str_replace(",","",$_POST['fee']),
			"remark"				=> $_POST['remark'],
			"writer"				=> $_POST['writer'],
			"regdate"				=> $now
		);

		$CustomerDeposit = new Accounting;
		$CustomerDeposit->CustomerDepositUpdate($data); //gid 값 맥스
		$this->movePage("accounting","registCustomerDeposit");
	}
	
	
	public function registSpendingResolution(){
		require_once ('views/accounting/cash/spending_resolution_regist.php');
	}

	public function registSpendingResolutionInsert() {

		$now = date("Y-m-d H:i:s");
		//$fileAttach = $this->upload('attach');
		$query = "select MAX(spending_resolution_ca) AS cha from erp_spending_resolution where spending_resolution_dt='" . $_POST['spending_resolution_dt'] ."'";
		$row = mysql_fetch_array(mysql_query($query));
		$cha = $row['cha']+1;

		$data = array(
			"table" => "erp_spending_resolution",
			"spending_resolution_dt"	=> $_POST['spending_resolution_dt'],
			"spending_resolution_ca"	=> $cha,
			"summary"					=> $_POST['summary'],
			"total_admount"				=> $_POST['totaladmount'],
			"total_fee"				=> $_POST['totalfee'],
			"writer"				=> $_POST['writer'],
			"regdate"				=> $now
		);

		$SpendingResolution = new Accounting;
		$rid = $SpendingResolution->registSpendingResolutionInsertId($data); //tid 값 맥스
		
		$spending_resolution_rid = $_POST['spending_resolution_dt']."-".$cha;

		$bank_num		= $_POST['bank_num'];
		$bank_name		= $_POST['bank_name'];
		$aci_cd			= $_POST['aci_cd'];
		$aci_nm			= $_POST['aci_nm'];
		$account_cd		= $_POST['account_cd'];
		$account_nm		= $_POST['account_nm'];
		$amount			= $_POST['amount'];
		$fee			= $_POST['fee'];
		$remark			= $_POST['remark'];
		$department_cd	= $_POST['department_cd'];
		$department_nm	= $_POST['department_nm'];
		$project_cd		= $_POST['project_cd'];
		$project_nm		= $_POST['project_nm'];
		$regdate		= $now;

		foreach($bank_num as $key => $val) {
			if($val != "") {
				$data = array(
					"table"						=> "erp_spending_resolution_item",
					"rid"						=> $rid,
					"spending_resolution_rid"	=> $spending_resolution_rid,
					"bank_num"					=> $val,
					"bank_name"					=> $bank_name[$key],
					"aci_cd"					=> $aci_cd[$key],
					"aci_nm"					=> $aci_nm[$key],
					"account_cd"				=> $account_cd[$key],
					"account_nm"				=> $account_nm[$key],
					"amount"					=> str_replace(",","",$amount[$key]),
					"fee"						=> str_replace(",","",$fee[$key]),
					"remark"					=> $remark[$key],
					"department_cd"				=> $department_cd[$key],
					"department_nm"				=> $department_nm[$key],
					"project_cd"				=> $project_cd[$key],
					"project_nm"				=> $project_nm[$key],
				);
				$SpendingResolution -> registSpendingResolutionItem($data);
			}
		}

		$this->movePage("accounting","registSpendingResolution");
	}

	
	public function registSpendingResolutionUpdate() {
		$now = date("Y-m-d H:i:s");
		$data = array(
			"table"				=> "erp_spending_resolution",
			"where"				=> "sid=".$_POST['sid'],
			//"spending_resolution_dt"	=> $_POST['spending_resolution_dt'],
			//"spending_resolution_ca"	=> $cha,
			"total_admount"				=> $_POST['totaladmount'],
			"total_fee"				=> $_POST['totalfee'],
			"summary"			=> $_POST['summary'],
			"writer"			=> $_POST['writer'],
			"regdate"			=> $now
		);

		$SpendingResolution = new Accounting;
		$SpendingResolution->SpendingResolutionUpdate($data);
		$rid = $_POST['rid'];

		$spending_resolution_rid = $_POST['spending_resolution_dt']."-".$_POST['spending_resolution_ca'];

		$bank_num		= $_POST['bank_num'];
		$bank_name		= $_POST['bank_name'];
		$aci_cd			= $_POST['aci_cd'];
		$aci_nm			= $_POST['aci_nm'];
		$account_cd		= $_POST['account_cd'];
		$account_nm		= $_POST['account_nm'];
		$amount			= $_POST['amount'];
		$fee			= $_POST['fee'];
		$remark			= $_POST['remark'];
		$department_cd	= $_POST['department_cd'];
		$department_nm	= $_POST['department_nm'];
		$project_cd		= $_POST['project_cd'];
		$project_nm		= $_POST['project_nm'];
		$regdate		= $now;

		foreach($purchasedt1 as $key => $val) {
			if($val != "") {
				$data = array(
					"table"					=> "erp_spending_resolution_item",
					"where"					=> "uid=".$idx_arr[$key],
					//"spending_resolution_rid"	=> $spending_resolution_rid,
					"bank_num"				=> $val,
					"bank_name"				=> $bank_name[$key],
					"aci_cd"				=> $aci_cd[$key],
					"aci_nm"				=> $aci_nm[$key],
					"account_cd"			=> $account_cd[$key],
					"account_nm"			=> $account_nm[$key],
					"amount"				=> str_replace(",","",$amount[$key]),
					"fee"					=> str_replace(",","",$fee[$key]),
					"remark"				=> $remark[$key],
					"department_cd"			=> $department_cd[$key],
					"department_nm"			=> $department_nm[$key],
					"project_cd"			=> $project_cd[$key],
					"project_nm"			=> $project_nm[$key],
				);
				$result = $SpendingResolution->SpendingResolutionItemUpdate($data);
				
					if ($result==false){
						$data = array(
						"table"					=> "erp_spending_resolution_item",
						"rid"					=> $rid,
						"spending_resolution_rid"	=> $spending_resolution_rid,
						"bank_num"				=> $val,
						"bank_name"				=> $bank_name[$key],
						"aci_cd"				=> $aci_cd[$key],
						"aci_nm"				=> $aci_nm[$key],
						"account_cd"			=> $account_cd[$key],
						"account_nm"			=> $account_nm[$key],
						"amount"				=> str_replace(",","",$amount[$key]),
						"fee"					=> str_replace(",","",$tax[$key]),
						"remark"				=> $remark[$key],
						"department_cd"			=> $department_cd[$key],
						"department_nm"			=> $department_nm[$key],
						"project_cd"			=> $project_cd[$key],
						"project_nm"			=> $project_nm[$key],
						);
					$SpendingResolution->registSpendingResolutionItem($data);
				} 
			}
		}

		$this->movePage("accounting","registSpendingResolution");
	}
	

	public function registPurchaseDeposit(){
		require_once ('views/accounting/cash/purchase_deposit_regist.php');
	}
	
	public function registPurchaseDepositInsert() {

		$now = date("Y-m-d H:i:s");
		//$fileAttach = $this->upload('attach');
		$query = "select MAX(purchase_deposit_ca) AS cha from erp_purchase_deposit where purchase_deposit_dt='" . $_POST['purchase_deposit_dt'] ."'";
		$row = mysql_fetch_array(mysql_query($query));
		$cha = $row['cha']+1;

		$data = array(
			"table" => "erp_purchase_deposit",
			//"where" => "pid=".$_POST['pid'],
			"purchase_deposit_dt"	=> $_POST['purchase_deposit_dt'],
			"purchase_deposit_ca"	=> $cha,
			"department_cd"			=> $_POST['department_cd'],
			"department_nm"			=> $_POST['department_nm'],
			"project_cd"			=> $_POST['project_cd'],
			"project_nm"			=> $_POST['project_nm'],
			"bank_num"				=> $_POST['bank_num'],
			"bank_name"				=> $_POST['bank_name'],
			"account_cd"			=> $_POST['account_cd'],
			"account_nm"			=> $_POST['account_nm'],
			"amount"				=> str_replace(",","",$_POST['amount']),
			"fee"					=> str_replace(",","",$_POST['fee']),
			"remark"				=> $_POST['remark'],
			"writer"				=> $_POST['writer'],
			"regdate"				=> $now
		);

		$PurchaseDeposit = new Accounting;
		$tid = $PurchaseDeposit->registCustomerDepositInsert($data); 

		$this->movePage("accounting","registPurchaseDeposit");
	}

	
	public function registPurchaseDepositUpdate() {
		$now = date("Y-m-d H:i:s");
		$data = array(
			"table"				=> "erp_purchase_deposit",
			"where"				=> "tid=".$_POST['uid'],
			//"purchase_deposit_dt"	=> $_POST['purchase_deposit_dt'],
			//"purchase_deposit_ca"	=> $cha,
			"department_cd"			=> $_POST['department_cd'],
			"department_nm"			=> $_POST['department_nm'],
			"project_cd"			=> $_POST['project_cd'],
			"project_nm"			=> $_POST['project_nm'],
			"bank_num"				=> $_POST['bank_num'],
			"bank_name"				=> $_POST['bank_name'],
			"account_cd"			=> $_POST['account_cd'],
			"account_nm"			=> $_POST['account_nm'],
			"amount"				=> str_replace(",","",$_POST['amount']),
			"fee"					=> str_replace(",","",$_POST['fee']),
			"remark"				=> $_POST['remark'],
			"writer"				=> $_POST['writer'],
			"regdate"				=> $now
		);

		$PurchaseDeposit = new Accounting;
		$tid = $PurchaseDeposit->PurchaseDepositUpdate($data); //gid 값 맥스
		$this->movePage("accounting","registPurchaseDeposit");
	}
	
	
	public function registGeneralReceipts(){
		require_once ('views/accounting/cash/general_receipts_regist.php');
	}
	
	public function registGeneralReceiptsInsert() {

		$now = date("Y-m-d H:i:s");
		//$fileAttach = $this->upload('attach');
		$query = "select MAX(general_receipts_ca) AS cha from erp_general_receipts where general_receipts_dt='" . $_POST['general_receipts_dt'] ."'";
		$row = mysql_fetch_array(mysql_query($query));
		$cha = $row['cha']+1;

		$data = array(
			"table" => "erp_general_receipts",
			//"where" => "pid=".$_POST['pid'],
			"general_receipts_dt"	=> $_POST['general_receipts_dt'],
			"general_receipts_ca"	=> $cha,
			"department_cd"			=> $_POST['department_cd'],
			"department_nm"			=> $_POST['department_nm'],
			"project_cd"			=> $_POST['project_cd'],
			"project_nm"			=> $_POST['project_nm'],
			"emp_cd"				=> $_POST['emp_cd'],
			"emp_nm"				=> $_POST['emp_nm'],
			"account_cd"			=> $_POST['account_cd'],
			"account_nm"			=> $_POST['account_nm'],
			"amount"				=> str_replace(",","",$_POST['amount']),
			"fee"					=> str_replace(",","",$_POST['fee']),
			"remark"				=> $_POST['remark'],
			"writer"				=> $_POST['writer'],
			"regdate"				=> $now
		);

		$GeneralReceipts = new Accounting;
		$tid = $GeneralReceipts->GeneralReceiptsInsert($data); 
		$this->movePage("accounting","registGeneralReceipts");
	}

	
	public function registGeneralReceiptsUpdate() {
		$now = date("Y-m-d H:i:s");
		$data = array(
			"table"				=> "erp_general_receipts",
			"where"				=> "tid=".$_POST['uid'],
			//"general_receipts_dt"	=> $_POST['general_receipts_dt'],
			//"general_receipts_ca"	=> $cha,
			"department_cd"			=> $_POST['department_cd'],
			"department_nm"			=> $_POST['department_nm'],
			"project_cd"			=> $_POST['project_cd'],
			"project_nm"			=> $_POST['project_nm'],
			"emp_cd"				=> $_POST['emp_cd'],
			"emp_nm"				=> $_POST['emp_nm'],
			"account_cd"			=> $_POST['account_cd'],
			"account_nm"			=> $_POST['account_nm'],
			"amount"				=> str_replace(",","",$_POST['amount']),
			"fee"					=> str_replace(",","",$_POST['fee']),
			"remark"				=> $_POST['remark'],
			"writer"				=> $_POST['writer'],
			"regdate"				=> $now
		);

		$GeneralReceipts = new Accounting;
		$tid = $GeneralReceipts->GeneralReceiptsUpdate($data); //gid 값 맥스
		$this->movePage("accounting","registGeneralReceipts");
	}
	
	public function registCardSalesSlips(){
		require_once ('views/accounting/cash/card_sales_slips_regist.php');
	}
	
	public function registCardSalesSlipsInsert() {

		$now = date("Y-m-d H:i:s");
		//$fileAttach = $this->upload('attach');
		$query = "select MAX(card_sales_slips_ca) AS cha from erp_card_sales_slips where card_sales_slips_dt='" . $_POST['card_sales_slips_dt'] ."'";
		$row = mysql_fetch_array(mysql_query($query));
		$cha = $row['cha']+1;

		$data = array(
			"table" => "erp_card_sales_slips",
			//"where" => "pid=".$_POST['pid'],
			"card_sales_slips_dt"	=> $_POST['card_sales_slips_dt'],
			"card_sales_slips_ca"	=> $cha,
			"department_cd"			=> $_POST['department_cd'],
			"department_nm"			=> $_POST['department_nm'],
			"project_cd"			=> $_POST['project_cd'],
			"project_nm"			=> $_POST['project_nm'],
			"card_no"				=> $_POST['card_no'],
			"card_nm"				=> $_POST['card_nm'],
			"account_cd"			=> $_POST['account_cd'],
			"account_nm"			=> $_POST['account_nm'],
			"amount"				=> str_replace(",","",$_POST['amount']),
			"fee"					=> str_replace(",","",$_POST['fee']),
			"remark"				=> $_POST['remark'],
			"writer"				=> $_POST['writer'],
			"regdate"				=> $now
		);

		$CardSalesSlips = new Accounting;
		$uid = $CardSalesSlips->CardSalesSlipsInsert($data); 
		$this->movePage("accounting","registCardSalesSlips");
	}

	
	public function registCardSalesSlipsUpdate() {
		$now = date("Y-m-d H:i:s");
		$data = array(
			"table"				=> "erp_card_sales_slips",
			"where"				=> "tid=".$_POST['uid'],
			//"card_sales_slips_dt"	=> $_POST['card_sales_slips_dt'],
			//"card_sales_slips_ca"	=> $cha,
			"department_cd"			=> $_POST['department_cd'],
			"department_nm"			=> $_POST['department_nm'],
			"project_cd"			=> $_POST['project_cd'],
			"project_nm"			=> $_POST['project_nm'],
			"card_no"				=> $_POST['card_no'],
			"card_nm"				=> $_POST['card_nm'],
			"account_cd"			=> $_POST['account_cd'],
			"account_nm"			=> $_POST['account_nm'],
			"amount"				=> str_replace(",","",$_POST['amount']),
			"fee"					=> str_replace(",","",$_POST['fee']),
			"remark"				=> $_POST['remark'],
			"writer"				=> $_POST['writer'],
			"regdate"				=> $now
		);

		$CardSalesSlips = new Accounting;
		$tid = $CardSalesSlips->CardSalesSlipsUpdate($data); //gid 값 맥스
		$this->movePage("accounting","registCardSalesSlips");
	}


	public function registSettleAccPrepayments(){   //가 지급금정산서
		require_once ('views/accounting/cash/settle_acc_prepayments_regist.php');
	}
	
	public function registSettleAccPrepaymentsInsert() {

		$now = date("Y-m-d H:i:s");
		//$fileAttach = $this->upload('attach');
		$query = "select MAX(settle_acc_prepayments_ca) AS cha from erp_settle_acc_prepayments where settle_acc_prepayments_dt='" . $_POST['settle_acc_prepayments_dt'] ."'";
		$row = mysql_fetch_array(mysql_query($query));
		$cha = $row['cha']+1;

		$data = array(
			"table" => "erp_settle_acc_prepayments",
			"settle_acc_prepayments_dt"	=> $_POST['settle_acc_prepayments_dt'],
			"settle_acc_prepayments_ca"	=> $cha,
			"summary"					=> $_POST['summary'],
			"total_admount"				=> $_POST['totaladmount'],
			"total_fee"				=> $_POST['totalfee'],
			"writer"				=> $_POST['writer'],
			"regdate"				=> $now
		);

		$SettleAccPrepayments = new Accounting;
		$rid = $SettleAccPrepayments->SettleAccPrepaymentsInsertId($data); //tid 값 맥스
		
		$settle_acc_prepayments_rid = $_POST['settle_acc_prepayments_dt']."-".$cha;

		$emp_cd		= $_POST['emp_cd'];
		$emp_nm		= $_POST['emp_nm'];
		$aci_cd			= $_POST['aci_cd'];
		$aci_nm			= $_POST['aci_nm'];
		$account_cd		= $_POST['account_cd'];
		$account_nm		= $_POST['account_nm'];
		$amount			= $_POST['amount'];
		$fee			= $_POST['fee'];
		$remark			= $_POST['remark'];
		$department_cd	= $_POST['department_cd'];
		$department_nm	= $_POST['department_nm'];
		$project_cd		= $_POST['project_cd'];
		$project_nm		= $_POST['project_nm'];
		$regdate		= $now;

		foreach($emp_cd as $key => $val) {
			if($val != "") {
				$data = array(
					"table"						=> "erp_settle_acc_prepayments_item",
					"rid"						=> $rid,
					"settle_acc_prepayments_rid"	=> $settle_acc_prepayments_rid,
					"emp_cd"					=> $val,
					"emp_nm"					=> $emp_nm[$key],
					"aci_cd"					=> $aci_cd[$key],
					"aci_nm"					=> $aci_nm[$key],
					"account_cd"				=> $account_cd[$key],
					"account_nm"				=> $account_nm[$key],
					"amount"					=> str_replace(",","",$amount[$key]),
					"fee"						=> str_replace(",","",$fee[$key]),
					"remark"					=> $remark[$key],
					"department_cd"				=> $department_cd[$key],
					"department_nm"				=> $department_nm[$key],
					"project_cd"				=> $project_cd[$key],
					"project_nm"				=> $project_nm[$key],
				);
				$SettleAccPrepayments -> registSettleAccPrepaymentsItem($data);
			}
		}

		$this->movePage("accounting","registSettleAccPrepayments");
	}

	
	public function registSettleAccPrepaymentsUpdate() {
		$now = date("Y-m-d H:i:s");
		$data = array(
			"table"				=> "erp_settle_acc_prepayments",
			"where"				=> "sid=".$_POST['sid'],
			//"settle_acc_prepayments_dt"	=> $_POST['settle_acc_prepayments_dt'],
			//"settle_acc_prepayments_ca"	=> $cha,
			"total_admount"				=> $_POST['totaladmount'],
			"total_fee"				=> $_POST['totalfee'],
			"summary"			=> $_POST['summary'],
			"writer"			=> $_POST['writer'],
			"regdate"			=> $now
		);

		$SettleAccPrepayments = new Accounting;
		$SettleAccPrepayments->SettleAccPrepaymentsUpdate($data);
		$rid = $_POST['rid'];

		$settle_acc_prepayments_rid = $_POST['settle_acc_prepayments_dt']."-".$_POST['settle_acc_prepayments_ca'];

		$emp_cd		= $_POST['emp_cd'];
		$emp_nm		= $_POST['emp_nm'];
		$aci_cd			= $_POST['aci_cd'];
		$aci_nm			= $_POST['aci_nm'];
		$account_cd		= $_POST['account_cd'];
		$account_nm		= $_POST['account_nm'];
		$amount			= $_POST['amount'];
		$fee			= $_POST['fee'];
		$remark			= $_POST['remark'];
		$department_cd	= $_POST['department_cd'];
		$department_nm	= $_POST['department_nm'];
		$project_cd		= $_POST['project_cd'];
		$project_nm		= $_POST['project_nm'];
		$regdate		= $now;

		foreach($emp_cd as $key => $val) {
			if($val != "") {
				$data = array(
					"table"					=> "erp_settle_acc_prepayments_item",
					"where"					=> "uid=".$idx_arr[$key],
					//"settle_acc_prepayments_rid"	=> $settle_acc_prepayments_rid,
					"emp_cd"				=> $val,
					"emp_nm"				=> $emp_nm[$key],
					"aci_cd"				=> $aci_cd[$key],
					"aci_nm"				=> $aci_nm[$key],
					"account_cd"			=> $account_cd[$key],
					"account_nm"			=> $account_nm[$key],
					"amount"				=> str_replace(",","",$amount[$key]),
					"fee"					=> str_replace(",","",$fee[$key]),
					"remark"				=> $remark[$key],
					"department_cd"			=> $department_cd[$key],
					"department_nm"			=> $department_nm[$key],
					"project_cd"			=> $project_cd[$key],
					"project_nm"			=> $project_nm[$key],
				);
				$result = $SettleAccPrepayments->SettleAccPrepaymentsItemUpdate($data);
				
					if ($result==false){
						$data = array(
						"table"					=> "erp_settle_acc_prepayments_item",
						"rid"					=> $rid,
						"settle_acc_prepayments_rid"	=> $settle_acc_prepayments_rid,
						"emp_cd"				=> $val,
						"emp_nm"				=> $emp_nm[$key],
						"aci_cd"				=> $aci_cd[$key],
						"aci_nm"				=> $aci_nm[$key],
						"account_cd"			=> $account_cd[$key],
						"account_nm"			=> $account_nm[$key],
						"amount"				=> str_replace(",","",$amount[$key]),
						"fee"					=> str_replace(",","",$tax[$key]),
						"remark"				=> $remark[$key],
						"department_cd"			=> $department_cd[$key],
						"department_nm"			=> $department_nm[$key],
						"project_cd"			=> $project_cd[$key],
						"project_nm"			=> $project_nm[$key],
						);
					$SettleAccPrepayments->registSettleAccPrepaymentsItem($data);
				} 
			}
		}

		$this->movePage("accounting","registSettleAccPrepayments");
	}
	
	
	


	public function listDressingSettlement(){
		require_once ('views/accounting/cash/dressing_settlement_list.php');
	}

		
	public function registEtcDeposit(){
		require_once ('views/accounting/cash/etc_deposit_regist.php');
	}
	
	public function registEtcDepositInsert() {

		$now = date("Y-m-d H:i:s");
		//$fileAttach = $this->upload('attach');
		$query = "select MAX(etc_deposit_ca) AS cha from erp_etc_deposit where etc_deposit_dt='" . $_POST['etc_deposit_dt'] ."'";
		$row = mysql_fetch_array(mysql_query($query));
		$cha = $row['cha']+1;

		$data = array(
			"table" => "erp_etc_deposit",
			//"where" => "pid=".$_POST['pid'],
			"etc_deposit_dt"	=> $_POST['etc_deposit_dt'],
			"etc_deposit_ca"	=> $cha,
			"department_cd"			=> $_POST['department_cd'],
			"department_nm"			=> $_POST['department_nm'],
			"project_cd"			=> $_POST['project_cd'],
			"project_nm"			=> $_POST['project_nm'],
			"debtor_cd"				=> $debtor_cd[$key],
			"debtor_nm"				=> $debtor_nm[$key],
			"creditor_cd"			=> $creditor_cd[$key],
			"creditor_nm"			=> $creditor_nm[$key],
			"account_cd"			=> $_POST['account_cd'],
			"account_nm"			=> $_POST['account_nm'],
			"amount"				=> str_replace(",","",$_POST['amount']),
			"fee"					=> str_replace(",","",$_POST['fee']),
			"remark"				=> $_POST['remark'],
			"writer"				=> $_POST['writer'],
			"regdate"				=> $now
		);

		$EtcDeposit = new Accounting;
		$uid = $EtcDeposit->EtcDepositInsert($data); 
		$this->movePage("accounting","registEtcDeposit");
	}

	
	public function registEtcDepositUpdate() {
		$now = date("Y-m-d H:i:s");
		$data = array(
			"table"				=> "erp_etc_deposit",
			"where"				=> "tid=".$_POST['uid'],
			//"etc_deposit_dt"	=> $_POST['etc_deposit_dt'],
			//"etc_deposit_ca"	=> $cha,
			"department_cd"			=> $_POST['department_cd'],
			"department_nm"			=> $_POST['department_nm'],
			"project_cd"			=> $_POST['project_cd'],
			"project_nm"			=> $_POST['project_nm'],
			"debtor_cd"				=> $_POST['debtor_cd'],
			"debtor_nm"				=> $_POST['debtor_nm'],
			"creditor_cd"			=> $_POST['creditor_cd'],
			"creditor_nm"			=> $_POST['creditor_nm'],
			"account_cd"			=> $_POST['account_cd'],
			"account_nm"			=> $_POST['account_nm'],
			"amount"				=> str_replace(",","",$_POST['amount']),
			"fee"					=> str_replace(",","",$_POST['fee']),
			"remark"				=> $_POST['remark'],
			"writer"				=> $_POST['writer'],
			"regdate"				=> $now
		);

		$EtcDeposit = new Accounting;
		$tid = $EtcDeposit->EtcDepositUpdate($data); //gid 값 맥스
		$this->movePage("accounting","registEtcDeposit");
	}

	

	public function listFixedAssets(){
		require_once ('views/accounting/assets/fixed_assets_ledger_list.php');
	}
	
	public function registFixedAssetsInsert() {

		$now = date("Y-m-d H:i:s");
		//$fileAttach = $this->upload('attach');
		$query = "select MAX(etc_deposit_ca) AS cha from erp_etc_deposit where etc_deposit_dt='" . $_POST['etc_deposit_dt'] ."'";
		$row = mysql_fetch_array(mysql_query($query));
		$cha = $row['cha']+1;

		$data = array(
			"table" => "erp_etc_deposit",
			//"where" => "pid=".$_POST['pid'],
			"etc_deposit_dt"	=> $_POST['etc_deposit_dt'],
			"etc_deposit_ca"	=> $cha,
			"department_cd"			=> $_POST['department_cd'],
			"department_nm"			=> $_POST['department_nm'],
			"project_cd"			=> $_POST['project_cd'],
			"project_nm"			=> $_POST['project_nm'],
			"debtor_cd"				=> $_POST['debtor_cd'],
			"debtor_nm"				=> $_POST['debtor_nm'],
			"creditor_cd"			=> $_POST['creditor_cd'],
			"creditor_nm"			=> $_POST['creditor_nm'],
			"account_cd"			=> $_POST['account_cd'],
			"account_nm"			=> $_POST['account_nm'],
			"amount"				=> str_replace(",","",$_POST['amount']),
			"fee"					=> str_replace(",","",$_POST['fee']),
			"remark"				=> $_POST['remark'],
			"writer"				=> $_POST['writer'],
			"regdate"				=> $now
		);

		$FixedAssets = new Accounting;
		$uid = $FixedAssets->FixedAssetsInsert($data); 
		$this->movePage("accounting","registFixedAssets");
	}

	
	public function registFixedAssetsUpdate() {
		$now = date("Y-m-d H:i:s");
		$data = array(
			"table"				=> "erp_etc_deposit",
			"where"				=> "tid=".$_POST['uid'],
			//"etc_deposit_dt"	=> $_POST['etc_deposit_dt'],
			//"etc_deposit_ca"	=> $cha,
			"department_cd"			=> $_POST['department_cd'],
			"department_nm"			=> $_POST['department_nm'],
			"project_cd"			=> $_POST['project_cd'],
			"project_nm"			=> $_POST['project_nm'],
			"debtor_cd"				=> $_POST['debtor_cd'],
			"debtor_nm"				=> $_POST['debtor_nm'],
			"creditor_cd"			=> $_POST['creditor_cd'],
			"creditor_nm"			=> $_POST['creditor_nm'],
			"account_cd"			=> $_POST['account_cd'],
			"account_nm"			=> $_POST['account_nm'],
			"amount"				=> str_replace(",","",$_POST['amount']),
			"fee"					=> str_replace(",","",$_POST['fee']),
			"remark"				=> $_POST['remark'],
			"writer"				=> $_POST['writer'],
			"regdate"				=> $now
		);

		$FixedAssets = new Accounting;
		$tid = $FixedAssets->FixedAssetsUpdate($data); //gid 값 맥스
		$this->movePage("accounting","registFixedAssets");
	}
	
	public function listFixedAssetsStatement(){
		require_once ('views/accounting/assets/fixed_assets_statement_list.php');
	}

	public function registFixedAssetsStatementPop(){
		require_once ('views/accounting/assets/fixed_assets_statement_regist_pop.php');
	}

	public function modifyFixedAssetsStatementPop() {
		$t = Accounting::getFixedAssetsStatement($_GET['uid']);	 
		require_once ('views/accounting/assets/fixed_assets_statement_modify_pop.php');
	}

	public function registFixedAssetsStatementInsert() {

		$now = date("Y-m-d H:i:s");
		$query = "select MAX(statement_ca) AS cha from erp_fixed_assets_statement where statement_dt='" . $_POST['statement_dt'] ."'";
		$row = mysql_fetch_array(mysql_query($query));
		$cha = $row['cha']+1;

		$data = array(
			"table" => "erp_fixed_assets_statement",
			"statement_dt"			=> $_POST['statement_dt'],
			"statement_ca"			=> $cha,
			"invoiceType"			=> $_POST['invoiceType'],
			"fac_cd"				=> $_POST['fac_cd'],
			"fac_nm"				=> $_POST['fac_nm'],
			"asset_ac_cd"			=> $_POST['asset_ac_cd'],
			"asset_ac_nm"			=> $_POST['asset_ac_nm'],
			"qty"					=> $_POST['qty'],
			"cost"					=> str_replace(",","",$_POST['cost']),
			"disposal_price"		=> str_replace(",","",$_POST['disposal_price']),
			"remark"				=> $_POST['remark'],
			"writer"				=> $_POST['writer'],
			"regdate"				=> $now
		);

		$FixedAssetsStatement = new Accounting;
		$uid = $FixedAssetsStatement->fixedAssetsStatementInsert($data); 
		$this->movePageClose($_POST['dialogid']);
	}

	
	public function registFixedAssetsStatementUpdate() {
		$now = date("Y-m-d H:i:s");
		$data = array(
			"table"					=> "erp_fixed_assets_statement",
			"where"					=> "uid=".$_POST['uid'],
			//"etc_deposit_dt"		=> $_POST['etc_deposit_dt'],
			//"etc_deposit_ca"		=> $cha,
			"invoiceType"			=> $_POST['invoiceType'],
			"fac_cd"				=> $_POST['fac_cd'],
			"fac_nm"				=> $_POST['fac_nm'],
			"asset_ac_cd"			=> $_POST['asset_ac_cd'],
			"asset_ac_nm"			=> $_POST['asset_ac_nm'],
			"qty"					=> $_POST['qty'],
			"cost"					=> str_replace(",","",$_POST['cost']),
			"disposal_price"		=> str_replace(",","",$_POST['disposal_price']),
			"remark"				=> $_POST['remark'],
			"writer"				=> $_POST['writer'],
			"regdate"				=> $now
		);

		$FixedAssetsStatement = new Accounting;
		$tid = $FixedAssetsStatement->fixedAssetsStatementUpdate($data); //gid 값 맥스
		$this->movePageClose($_POST['dialogid']);
	}


	public function listFixedAssetsCode(){
		require_once ('views/accounting/assets/fixed_assets_code_list.php');
	}
	
	public function registFixedAssetsCodePop(){
		require_once ('views/accounting/assets/fixed_assets_code_regist_pop.php');
	}

	public function registFixedAssetsCodePopInsert() {

		$now = date("Y-m-d H:i:s");
		//$fileAttach = $this->upload('attach');
		//$query = "select MAX(statement_ca) AS cha from erp_fixed_assets_type where statement_dt='" . $_POST['statement_dt'] ."'";
		//$row = mysql_fetch_array(mysql_query($query));
		//$cha = $row['cha']+1;
		
		$data = array(
			"table"							=> "erp_fixed_assets_code",
			"fac_cd"						=> $_POST['fac_cd'],
			"fac_nm"						=> $_POST['fac_nm'],
			"department_cd"					=> $_POST['department_cd'],
			"department_nm"					=> $_POST['department_nm'],			
			"fat_cd"						=> $_POST['fat_cd'],
			"fat_nm"						=> $_POST['fat_nm'],
			"asset_ac_cd"					=> $_POST['asset_ac_cd'],
			"asset_ac_nm"					=> $_POST['asset_ac_nm'],
			"allowance_depreciation_cd"		=> $_POST['allowance_depreciation_cd'],
			"allowance_depreciation_nm"		=> $_POST['allowance_depreciation_nm'],
			"depreciation_cost_cd"			=> $_POST['depreciation_cost_cd'],
			"depreciation_cost_nm"			=> $_POST['depreciation_cost_nm'],
			"depreciable_type"				=> $_POST['depreciable_type'],
			"service_life_unit"				=> $_POST['service_life_unit'],
			"service_life"					=> str_replace(",","",$_POST['service_life']),
			"salvage_value"					=> str_replace(",","",$_POST['salvage_value']),
			"status"						=> $_POST['status'],
			"remark"						=> $_POST['remark'],
			"use_yn"						=> $_POST['use_yn'],
			"writer"						=> $_POST['writer'],
			"regdate"						=> $now
		);

		$fixedAssetsCode = new Accounting;
		$uid = $fixedAssetsCode->fixedAssetsCodeInsert($data); 
		$this->movePageClose($_POST['dialogid']);
	}

	
	public function registFixedAssetsCodePopUpdate() {
		$now = date("Y-m-d H:i:s");
		$data = array(
			"table"							=> "erp_fixed_assets_code",
			"where"							=> "uid=".$_POST['uid'],
			"fac_nm"						=> $_POST['fac_nm'],
			"department_cd"					=> $_POST['department_cd'],
			"department_nm"					=> $_POST['department_nm'],			
			"fat_cd"						=> $_POST['fat_cd'],
			"fat_nm"						=> $_POST['fat_nm'],
			"asset_ac_cd"					=> $_POST['asset_ac_cd'],
			"asset_ac_nm"					=> $_POST['asset_ac_nm'],
			"allowance_depreciation_cd"		=> $_POST['allowance_depreciation_cd'],
			"allowance_depreciation_nm"		=> $_POST['allowance_depreciation_nm'],
			"depreciation_cost_cd"			=> $_POST['depreciation_cost_cd'],
			"depreciation_cost_nm"			=> $_POST['depreciation_cost_nm'],
			"depreciable_type"				=> $_POST['depreciable_type'],
			"service_life_unit"				=> $_POST['service_life_unit'],
			"service_life"					=> str_replace(",","",$_POST['service_life']),
			"salvage_value"					=> str_replace(",","",$_POST['salvage_value']),
			"status"						=> $_POST['status'],
			"remark"						=> $_POST['remark'],
			"use_yn"						=> $_POST['use_yn'],
			"writer"						=> $_POST['writer'],
			"regdate"						=> $now
		);

		$fixedAssetsCode = new Accounting;
		$uid = $fixedAssetsCode->fixedAssetsCodeUpdate($data); //gid 값 맥스
		$this->movePageClose($_POST['dialogid']);
		
		
	}

	
	public function modifyFixedAssetsCodePop() {
		$t = Accounting::getFixedAssetsCode($_GET['uid']);	 
		require_once ('views/accounting/assets/fixed_assets_code_modify_pop.php');
	}

	public function listFixedAssetsType(){
		require_once ('views/accounting/assets/fixed_assets_type_list.php');
	}

	public function registFixedAssetsTypePop(){
		require_once ('views/accounting/assets/fixed_assets_type_regist_pop.php');
	}
	
	public function registFixedAssetsTypePopInsert() {

		$now = date("Y-m-d H:i:s");
		//$fileAttach = $this->upload('attach');
		//$query = "select MAX(statement_ca) AS cha from erp_fixed_assets_type where statement_dt='" . $_POST['statement_dt'] ."'";
		//$row = mysql_fetch_array(mysql_query($query));
		//$cha = $row['cha']+1;
		
		$data = array(
			"table"							=> "erp_fixed_assets_type",
			"fat_cd"						=> $_POST['fat_cd'],
			"fat_nm"						=> $_POST['fat_nm'],
			"asset_ac_cd"					=> $_POST['asset_ac_cd'],
			"asset_ac_nm"					=> $_POST['asset_ac_nm'],
			"allowance_depreciation_cd"		=> $_POST['allowance_depreciation_cd'],
			"allowance_depreciation_nm"		=> $_POST['allowance_depreciation_nm'],
			"depreciation_cost_cd"			=> $_POST['depreciation_cost_cd'],
			"depreciation_cost_nm"			=> $_POST['depreciation_cost_nm'],
			"depreciable_type"				=> $_POST['depreciable_type'],
			"service_life_unit"				=> $_POST['service_life_unit'],
			"service_life"					=> str_replace(",","",$_POST['service_life']),
			"salvage_value"					=> str_replace(",","",$_POST['salvage_value']),
			"use_yn"						=> $_POST['use_yn'],
			"writer"						=> $_POST['writer'],
			"regdate"						=> $now
		);

		$fixedAssetsType = new Accounting;
		$uid = $fixedAssetsType->fixedAssetsTypeInsert($data); 
		$this->movePageClose($_POST['dialogid']);
	}

	
	public function registFixedAssetsTypePopUpdate() {
		$now = date("Y-m-d H:i:s");
		$data = array(
			"table"							=> "erp_fixed_assets_type",
			"where"							=> "uid=".$_POST['uid'],
			//"fat_cd"						=> $_POST['fat_cd'],
			"fat_nm"						=> $_POST['fat_nm'],
			"asset_ac_cd"					=> $_POST['asset_ac_cd'],
			"asset_ac_nm"					=> $_POST['asset_ac_nm'],
			"allowance_depreciation_cd"		=> $_POST['allowance_depreciation_cd'],
			"allowance_depreciation_nm"		=> $_POST['allowance_depreciation_nm'],
			"depreciation_cost_cd"			=> $_POST['depreciation_cost_cd'],
			"depreciation_cost_nm"			=> $_POST['depreciation_cost_nm'],
			"depreciable_type"				=> $_POST['depreciable_type'],
			"service_life_unit"				=> $_POST['service_life_unit'],
			"service_life"					=> str_replace(",","",$_POST['service_life']),
			"salvage_value"					=> str_replace(",","",$_POST['salvage_value']),
			"use_yn"						=> $_POST['use_yn'],
			"writer"						=> $_POST['writer'],
			"regdate"						=> $now
		);

		$fixedAssetsType = new Accounting;
		$tid = $fixedAssetsType->fixedAssetsTypeUpdate($data); //gid 값 맥스
		$this->movePageClose($_POST['dialogid']);
		//$this->movePageClose("id-btn-dialog2");
		
	}

	
	public function modifyFixedAssetsTypePop() {
		$t = Accounting::getFixedAssetsType($_GET['uid']);	 
		require_once ('views/accounting/assets/fixed_assets_type_modify_pop.php');
	}
	

	public function registFixedAssetsIncrement(){
		require_once ('views/accounting/assets/fixed_assets_increment_regist.php');
	}
	
	public function modifyFixedAssetsIncrement() {
		$t = Accounting::getFixedAssetsIncrement($_GET['uid']);	 
		require_once ('views/accounting/assets/fixed_assets_increment_modify.php');
	}

	public function registFixedAssetsIncrementInsert() {

		$now = date("Y-m-d H:i:s");
		//$fileAttach = $this->upload('attach');
		$query = "select MAX(statement_ca) AS cha from erp_fixed_assets_increment where statement_dt='" . $_POST['statement_dt'] ."'";
		$row = mysql_fetch_array(mysql_query($query));
		$cha = $row['cha']+1;
		
		$data = array(
			"table"							=> "erp_fixed_assets_increment",
			"statement_dt"	=> $_POST['statement_dt'],
			"statement_ca"	=> $cha,
			"department_cd"	=> $_POST['department_cd'],
			"department_nm"	=> $_POST['department_nm'],
			"project_cd"	=> $_POST['project_cd'],
			"project_nm"	=> $_POST['project_nm'],
			"vattype"		=> $_POST['vattype'],
			"tax_deduct"	=> $_POST['tax_deduct'],
			"invoiceType"	=> $_POST['invoiceType'],
			"account_cd"	=> $_POST['account_cd'],
			"account_nm"	=> $_POST['account_nm'],
			"fac_cd"		=> $_POST['fac_cd'],
			"fac_nm"		=> $_POST['fac_nm'],
			"unit_price"	=> str_replace(",","",$_POST['unit_price']),
			"tax"			=> str_replace(",","",$_POST['tax']),
			"fee"			=> str_replace(",","",$_POST['fee']),
			"remark"		=> $_POST['remark'],
			"bank_num"		=> $_POST['bank_num'],
			"bank_name"		=> $_POST['bank_name'],
			"regdate"		=> $now
		);

		$fixedAssetsIncrement = new Accounting;
		$uid = $fixedAssetsIncrement->fixedAssetsIncrementInsert($data); 
		$this->movePage("accounting","registFixedAssetsIncrement");
	}


	public function registFixedAssetsIncrementUpdate() {
		$now  = date("Y-m-d H:i:s");
		$data = array(
			"table"					=> "erp_fixed_assets_increment",
			"where"					=> "uid=".$_POST['uid'],
			"department_cd"			=> $_POST['department_cd'],
			"department_nm"			=> $_POST['department_nm'],
			"project_cd"			=> $_POST['project_cd'],
			"project_nm"			=> $_POST['project_nm'],
			"vattype"				=> $_POST['vattype'],
			"tax_deduct"			=> $_POST['tax_deduct'],
			"invoiceType"	=> $_POST['invoiceType'],
			"account_cd"			=> $_POST['account_cd'],
			"account_nm"			=> $_POST['account_nm'],
			"fac_cd"				=> $_POST['fac_cd'],
			"fac_nm"				=> $_POST['fac_nm'],
			"unit_price"			=> str_replace(",","",$_POST['unit_price']),
			"tax"					=> str_replace(",","",$_POST['tax']),
			"fee"					=> str_replace(",","",$_POST['fee']),
			"remark"				=> $_POST['remark'],
			"bank_num"				=> $_POST['bank_num'],
			"bank_name"				=> $_POST['bank_name'],
			"regdate"				=> $now
		);

		$fixedAssetsIncrement = new Accounting;
		$tid = $fixedAssetsIncrement->fixedAssetsIncrementUpdate($data); //gid 값 맥스
		$this->movePage("accounting","registFixedAssetsIncrement");
	}
	

	public function registFixedAssetsDecrease(){
		require_once ('views/accounting/assets/fixed_assets_decrease_regist.php');
	}
	
	public function modifyFixedAssetsDecrease() {
		$t = Accounting::getFixedAssetsDecrease($_GET['uid']);	 
		require_once ('views/accounting/assets/fixed_assets_decrease_modify.php');
	}

	public function registFixedAssetsDecreaseInsert() {

		$now = date("Y-m-d H:i:s");
		//$fileAttach = $this->upload('attach');
		$query = "select MAX(statement_ca) AS cha from erp_fixed_assets_decrease where statement_dt='" . $_POST['statement_dt'] ."'";
		$row = mysql_fetch_array(mysql_query($query));
		$cha = $row['cha']+1;
		
		$data = array(
			"table"					=> "erp_fixed_assets_decrease",
			"statement_dt"			=> $_POST['statement_dt'],
			"statement_ca"			=> $cha,
			"department_cd"			=> $_POST['department_cd'],
			"department_nm"			=> $_POST['department_nm'],
			"project_cd"			=> $_POST['project_cd'],
			"project_nm"			=> $_POST['project_nm'],
			"vattype"				=> $_POST['vattype'],
			"tax_deduct"			=> $_POST['tax_deduct'],
			"invoiceType"	=> $_POST['invoiceType'],
			"account_cd"			=> $_POST['account_cd'],
			"account_nm"			=> $_POST['account_nm'],
			"fac_cd"				=> $_POST['fac_cd'],
			"fac_nm"				=> $_POST['fac_nm'],
			"fac_qty"				=> $_POST['fac_qty'],
			"fac_res_qty"			=> $_POST['fac_res_qty'],
			"fad_gubun"				=> $_POST['fad_gubun'],
			"acquisition_cost"		=> str_replace(",","",$_POST['acquisition_cost']),
			"accumulated_amount"	=> str_replace(",","",$_POST['accumulated_amount']),
			"unit_price"			=> str_replace(",","",$_POST['unit_price']),
			"tax"					=> str_replace(",","",$_POST['tax']),
			"fee"					=> str_replace(",","",$_POST['fee']),
			"gain_loss_disposition"	=> str_replace(",","",$_POST['gain_loss_disposition']),
			"income_account_cd"		=> $_POST['income_account_cd'],
			"income_account_nm"		=> $_POST['income_account_nm'],
			"remark"				=> $_POST['remark'],
			"bank_num"				=> $_POST['bank_num'],
			"bank_name"				=> $_POST['bank_name'],
			"regdate"				=> $now
		);

		$fixedAssetsDecrease = new Accounting;
		$uid = $fixedAssetsDecrease->fixedAssetsDecreaseInsert($data); 
		$this->movePage("accounting","registFixedAssetsDecrease");
	}

	
	public function registFixedAssetsDecreaseUpdate() {
		$now = date("Y-m-d H:i:s");
		$data = array(
			"table"					=> "erp_fixed_assets_decrease",
			"where"					=> "uid=".$_POST['uid'],
			"department_cd"			=> $_POST['department_cd'],
			"department_nm"			=> $_POST['department_nm'],
			"project_cd"			=> $_POST['project_cd'],
			"project_nm"			=> $_POST['project_nm'],
			"vattype"				=> $_POST['vattype'],
			"tax_deduct"			=> $_POST['tax_deduct'],
			"invoiceType"			=> $_POST['invoiceType'],
			"account_cd"			=> $_POST['account_cd'],
			"account_nm"			=> $_POST['account_nm'],
			"fac_cd"				=> $_POST['fac_cd'],
			"fac_nm"				=> $_POST['fac_nm'],
			"fac_qty"				=> $_POST['fac_qty'],
			"fac_res_qty"			=> $_POST['fac_res_qty'],
			"fad_gubun"				=> $_POST['fad_gubun'],
			"acquisition_cost"		=> str_replace(",","",$_POST['acquisition_cost']),
			"accumulated_amount"	=> str_replace(",","",$_POST['accumulated_amount']),
			"unit_price"			=> str_replace(",","",$_POST['unit_price']),
			"tax"					=> str_replace(",","",$_POST['tax']),
			"fee"					=> str_replace(",","",$_POST['fee']),
			"gain_loss_disposition"	=> str_replace(",","",$_POST['gain_loss_disposition']),
			"income_account_cd"		=> $_POST['income_account_cd'],
			"income_account_nm"		=> $_POST['income_account_nm'],
			"remark"				=> $_POST['remark'],
			"bank_num"				=> $_POST['bank_num'],
			"bank_name"				=> $_POST['bank_name'],
			"regdate"						=> $now
		);

		$fixedAssetsDecrease = new Accounting;
		$tid = $fixedAssetsDecrease->fixedAssetsDecreaseUpdate($data); //gid 값 맥스
		$this->movePage("accounting","registFixedAssetsDecrease");
		
	}

	
	public function registDepreciationCost() {
		require_once ('views/accounting/assets/depreciation_cost_regist.php');
	}
	
	public function listAccountingSearch() {
		require_once ('views/accounting/slip/accounting_search_list.php');
	}

	public function listAccountingPrint() {
		require_once ('views/accounting/slip/accounting_print_list.php');
	}
	
	
	public function listGeneralLedgerAccount() {
		require_once ('views/accounting/ledger/general_ledger_account_list.php');
	}
	
	public function listCustomerAccountLedger(){
		require_once ('views/accounting/ledger/customer_account_ledger.php');
	}
	
	public function listPurchaseSalesLedger(){
		require_once ('views/accounting/ledger/purchase_sales_ledger_list.php');
	}

	public function listCashBook(){
		require_once ('views/accounting/ledger/cash_book.php');
	}

	public function listJournal(){
		require_once ('views/accounting/ledger/journal_table_list.php');
	}

	public function listDailyMonthlyAccount(){
		require_once ('views/accounting/ledger/daily_monthly_account.php');
	}

	public function listTransactionalBillTable(){
		require_once ('views/accounting/ledger/transactional_bill_table_list.php');
	}
	
	public function listCompoundTrialBalance(){
		require_once ('views/accounting/management/compound_trial_balance_list.php');
	}

	public function listStatementFinancialPosition(){
		require_once ('views/accounting/management/statement_financial_position_list.php');
	}

	public function listIncomeStatement(){
		require_once ('views/accounting/management/income_statement_list.php');
	}

	public function listCostSpecification(){
		require_once ('views/accounting/management/cost_specification_list.php');
	}
	
	public function listAccountStatement(){
		require_once ('views/accounting/management/account_statement_list.php');
	}

	public function listFundsJournal(){
		require_once ('views/accounting/management/funds_journal_list.php');
	}

	public function listCostBenefitAnalysis(){
		require_once ('views/accounting/management/cost_benefit_analysis_list.php');
	}

	public function viewCostBenefitAnalysis(){
		require_once ('views/accounting/management/cost_benefit_analysis_view.php');
	}

	public function listCostAnalysis(){
		require_once ('views/accounting/management/cost_analysis_list.php');
	}

	public function registAllowanceItem(){
		require_once ('views/accounting/pay/allowance_item_regist.php');
	}

	public function registDeclarationItem(){
		require_once ('views/accounting/pay/declaration_item_regist.php');
	}



}
?>