<?
$title = "금형 부품 등록";
require_once("../../connection.php");
require_once("../../assets/phead.php");
require_once("../../library/function.php");
extract($_POST);
extract($_GET);

?>
<div class="page-content">
	<div class="row">
		<div class="col-xs-12">
			<!-- PAGE CONTENT BEGINS -->
			<form name="frmMold" id="frmMold" method="post" action="index.php" enctype="multipart/form-data" />
				<input type="hidden" name="controller" id="controller" value="mold" />
				<input type="hidden" name="action" id="action" value="insertPageMoldItem" />
				<input type="hidden" name="mode" id="mode" value="insertPageMoldItem" />
				<input type="hidden" name="dialogID" id="dialogID" value="<?=$dialogID?>" />
				<input type="hidden" name="fid" id="fid" value="<?=$uid?>" />
				<input type="hidden" name="mold_cd" id="mold_cd" value="<?=$mold_cd?>" />
				<input type="hidden" name="m_cd" id="m_cd" value="" />
				<table id="simple-table" class="table  table-bordered table-hover">
					<thead class="thin-border-bottom">
					<tr>
						<th class="center col-xs-1" style="background-color:#f1f1f1">품목코드</th>
						<th class="center col-xs-3" style="background-color:#f1f1f1">품목명</th>
						<th class="center col-xs-1" style="background-color:#f1f1f1">규격</th>
						<th class="center col-xs-1" style="background-color:#f1f1f1">재질</th>
						<th class="center col-xs-1" style="background-color:#f1f1f1">단위</th>
						<th class="center col-xs-1" style="background-color:#f1f1f1">수량</th>
						<th class="center col-xs-1" style="background-color:#f1f1f1">유효타수</th>
						<th class="center col-xs-1" style="background-color:#f1f1f1;">품목구분</th>
						<th class="center col-xs-1" style="background-color:#f1f1f1;">품목그룹</th>
						<th class="center col-xs-1" style="background-color:#f1f1f1">비고</th>
					</thead>
					<tbody style="border-bottom: 1px solid #dddddd">
						<tr>
						<td><input type="text" class="form-control item_cd" name="item_cd" id="item_cd" required/><label for="item_cd" style="display:none;">품목코드를 입력하세요.</label></td>
						<td><input type="text" class="form-control" name="item_nm" id="item_nm" required/><label for="item_nm" style="display:none;">품목명을 입력하세요.</label></td>
						<td><input type="text" class="form-control standard1" name="standard1" id="standard1" required/><label for="standard1" style="display:none;">규격을 입력하세요.</label></td>
						<td><input type="text" class="form-control material" name="material" id="material" required/><label for="material" style="display:none;">재질을 입력하세요.</label></td>
						<td><input type="text" class="form-control unit" name="unit" id="unit" required/><label for="unit" style="display:none;">단위를 입력하세요.</label></td>
						<td><input type="text" class="form-control text-right cnt" name="cnt" id="cnt" onkeyup="input_comma(this);" onclick="this.select();" required/><label for="cnt" style="display:none;">수량을 입력하세요.</label></td>
						<td><input type="text" class="form-control text-right valid_item_hit_cnt" name="valid_item_hit_cnt" id="valid_item_hit_cnt" onkeyup="input_comma(this);" onclick="this.select();" required/><label for="valid_item_hit_cnt" style="display:none;">유효타수를 입력하세요.</label></td>
						<td><input type="text" class="form-control text-right" name="item_gb" id="item_gb" /></td>
						<td><input type="text" class="form-control text-right" name="item_group_nm" id="item_group_nm"/>
						    <input type="hidden" name="item_group_cd" id="item_group_cd"></td>
						<td><input type="text" class="form-control text-right" name="remark" id="remark" /></td>
					</tbody>
					<tfoot >
					<tfoot>
					</table>
			</form>
		</div>
	</div><!-- /.row -->

	<!-- submit -->
	<div class="clearfix form-actions center">
		<div class="col-md-12">
			<button class="btn btn-info btn-xs" type="button" onclick="formItemSubmit()">
				<i class="ace-icon fa fa-check"></i>
				<span id="text1">저장</span>
			</button>
			<button class="btn btn-xs" type="button" onclick="self.close()">
				<i class="ace-icon fa fa-check bigger-110"></i>
				창닫기
			</button>
		</div>
	</div><!-- // submit -->
</div><!-- /.page-content -->
<?
require_once ("../../assets/include_script.php");
?>
<script>
	function formItemSubmit(){
	    var f  = "#frmMold";
        var $f = jQuery(f);
        var $b = jQuery(this);
        var $t, t;
        var result = true;
		//var updatePageMold	= $("#action").val();
		var fid	= $("#uid").val();

		if (fid=="")
		{
			alert('금형코드를 등록 후 금형 품목을 입력하세요.');
			return false
		}
        $f.find("input, select, textarea").each(function(i) {
            $t = jQuery(this);

            if($t.prop("required")) {
                if(!jQuery.trim($t.val())) {
                    t = jQuery("label[for='"+$t.attr("id")+"']").text();
                    result = false;
                    $t.focus();
                    //alert(t+" 필수 입력입니다.");
					alert(t);
                    return false;
                }
            }
        });


		//alert(result)
        if(!result){
            return false;
		}else{
			var result = confirm('금형부품을 등록 하시겠습니까?'); 
				if(result) {
					//$("#frmMold").attr("target", "hiddenIframe");
					//$("#frmMold").submit(); 
					insertMoldItem(fid);
				} else {
					return false;
				}
		}
}

//금형부품 등록
function insertMoldItem(fid) {
		var mold_cd = $("#mold_cd").val();
		$("#m_cd").val(mold_cd);
		var params = $("form[name=frmMold]").serialize();
		$.ajax({
			type : "post",
			data : params,
			contentType: 'application/x-www-form-urlencoded; charset=UTF-8', 
			url : "../../ajax/mold.php?mode=insertPageMoldItem",
			success : function(str) {
				alert(str)
				$(opener.location).attr("href", "javascript:getMoldItemList('"+fid+"');");
				self.close();
			}
		});
	//}
}

//-----------------------------------------------------------------------
// 기  능 : 금액을 숫자 형식으로
//-----------------------------------------------------------------------
function Money2Num(money) {
	if(money == undefined)	return false;
	var moneyString		=	new String;
	moneyString			=	money.toString();
	while (moneyString.indexOf(',') > -1){
		moneyString	=	moneyString.replace(',','');
	}
	if(isNaN(moneyString)){
		return false;
	}else{
		return moneyString;
	}
}
function commaSplit(n) {// 콤마 나누는 부분
	var txtNumber = '' + n;
	var rxSplit = new RegExp('([0-9])([0-9][0-9][0-9][,.])');
	var arrNumber = txtNumber.split('.');
	arrNumber[0] += '.';
	do {
		arrNumber[0] = arrNumber[0].replace(rxSplit, '$1,$2');
	}
	while (rxSplit.test(arrNumber[0]));
	if(arrNumber.length > 1) {
		return arrNumber.join('');
	} else {
		return arrNumber[0].split('.')[0];
	}
}

function removeComma(n) {  // 콤마제거
	if ( typeof n == "undefined" || n == null || n == "" ) {
		return "";
	}
	var txtNumber = '' + n;
	return txtNumber.replace(/(,)/g, "");
}
function input_comma(sfield) 
	{
		if ((event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 96 && event.keyCode <= 105) 
			|| (event.keyCode == 188) || (event.keyCode == 190) || (event.keyCode == 110) || (event.keyCode == 8) || (event.keyCode == 46))
		{			
			sfield.value = remove_comma(sfield);
			money = sfield.value;
			var tmpH="";
			if(money.charAt(0)=="-")
			{
				tmpH=money.substring(0,1);
				money=money.substring(1,money.length);
			}
		
			for (; money.indexOf("-") != -1 ;) 
			{ 
				money = money.replace("-","")
			}
		
			belowzero = "";
			if (check_dot(money)==true)
			{
				arr = money.split(".");
				money = arr[0];		
				belowzero = "." + arr[1];    
			}
			
			len = money.length ;
			result ="";
			for (i=0; i < len;i++)
			{
				comma="";
				schar = money.charAt(i);
				where = len - 1 - i;
				if ( ( where % 3 == 0) && (len > 3) && ( where != 0 )) 
				{
					comma = ",";	
				}
				result = result +   schar + comma ;
			}
			if(tmpH)
			{
 				result = tmpH + result;
	 		}

			sfield.value = result + belowzero;			
			
	   	}	
		return true;
	}

	function remove_comma(sfield)
	{
		money = sfield.value;
		var arr;
		arr = money.split(",");
		len = arr.length;	
		result = "";
		for (k=0; k < len; k++) 
		{
			result = result + arr[k];
		}
		return result;
	}	

	function check_dot(v_value)
	{
		v_len= v_value.length;
		for (var i=0; i< v_len; i++) 
		{
			schar = v_value.charAt(i);
			if (schar == "." )
			{
				return true;
			}
		}
		return false;
	}
		
	function onlyNumber() //onKeyPress 이벤트 기준
	{ 
  		if ( ((event.keyCode < 48) || (57 < event.keyCode) && (188 != event.keyCode)) && (45 != event.keyCode) 
  			&& (190 != event.keyCode) && (110 != event.keyCode) && (109 != event.keyCode) && (46 != event.keyCode)) 
  		{
  			event.returnValue=false;
  		}
	}

</script>
<?
require_once("../../assets/pfoot.php");
?>