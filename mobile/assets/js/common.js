function centerOpenWindow(theURL, winName, width, height, fstate, scrollbars){ 
	var features = "width=" + width ; 
	features += ",height=" + height ; 
	var state = ""; 
	var scrollbars = "yes";
	var res_w = ( $(window).width() - width ) / 2; 
	var res_h = ( $(window).height() - height ) / 2; 
	if ( window.screenLeft >= window.screen.width ) { 
		res_w = window.screen.width + res_w; 
	} 
	if (fstate == "") { // 옵션 
		state = features + ", left=" + res_w + ",top=" + res_h + ",scrollbars=yes";
	} else { 
		state = fstate + ", " + features + ", left=" + res_w + ",top=" + res_h + ",scrollbars=yes";
	} 
	var win = window.open(theURL,winName,state); 
	win.focus(); 
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



// 페이지 세트
function setPage(page){
	$("#page").val(page);
	getData(page);
}

// 페이징 가져오기
function getPaging(table,where,rpp,adjacents, setPage){
	var data_string = "page=" + $("#page").val() + "&table=" + table + "&where=" + where + "&rpp=" + rpp + "&adjacents=" + adjacents + "&setPage=" + setPage;
	$.ajax({
		type : "post",
		url : "_get_paging.php",
		data : data_string,
		success : function(str) {
			$("#paging_area").html(str);
		}
	});
}



// 선택 삭제
function deleteSelect(table, p = null){
	$(".chk").each(function(){
		if($(this).prop('checked')) {
			var new_uid = $("#check_uids").val() + "," + $(this).val();
			$("#check_uids").val(new_uid);
		}
	});
	
	if($("#check_uids").val() == "") {
		showAlert("삭제할 데이터를 선택하세요");
		return;
	}

	var parameter = {"mode" : "deleteSelect", "table" : table, "uids" : $("#check_uids").val()};
	$.ajax({
		type : "post",
		url : "ajax.php",
		data : parameter,
		async : false,
		success : function(){
			$("#checkedAll").prop('checked',false);
			$("#check_uids").val("");
			if(p == null) getData(1);
			else if(p == 1) getItemAccount(1); // 품목매입처 관리의 매입거래처 다시 가져오기
			else if(p == 2) getItemCost(); // 품목 단가 리스트 가져오기
			else if(p == 3) getTeam(); // 생산팀명 가져오기
		}
	});
}

function showAlert(txt) {
	$("#message").html(txt);
	$("#alertModal").modal("show");
}

function showModal(modal_nm) {
	$("#" + modal_nm).modal('show');
}

function hideModal(modal_nm) {
	$("#" + modal_nm).modal("hide");
}