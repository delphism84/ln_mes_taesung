/** JSON/API row helper: avoid showing the string "undefined" for missing or null fields */
function jv(obj, key) {
	if (obj == null || typeof obj !== 'object') return '';
	var v = obj[key];
	if (v === undefined || v === null) return '';
	if (typeof v === 'boolean' && v === false) return '';
	return v;
}

function check(formName){
	var valid = true;
	var form = $('#' + formName);

	form.find('input, textarea, select').each(function(key){
		var obj = $(this);
		if(obj.attr('validation') == 'yes') {
			if(isEmpty(obj.val())){
				alert(obj.attr('err'));
				valid = false;
				return false;
			}	
		}
	});
	
	if(valid == true) return true;
	else return false;
}


function isEmpty(val) {
	if(val == null || typeof val == 'undefind' || val.trim().length < 1) {
		return true;
	}
	return false;
}

function checkIdPattern(){
	var pattern = /^[a-z]+[a-z0-9_]+[a-z0-9_]$/;  // ^ 는 시작하는 문자 $ 는 끝나는 문자 
	   
	   // 아이디 체크 
	var id = $.trim($('#id').val());  //  jQuery를 이용하여 앞뒤 공백 제거 
	if(id=="") { 
		alert("아이디를 입력하세요!"); 
		$('#id').focus(); 
		return false; 
	} else { 
		if(!pattern.test(id)) { // test 는 패턴에 맞으면 true, 맞지 않으면 false 값 return
		alert("아이디는 영문소문자로 시작하고\r\n영문소문자, 숫자, 언더바(_)만 사용하실 수 있습니다! "); 
		$("#id").val("").focus();
			 return false; 
		} 
	}

	return true;
}

function checkPwdPattern(){
	var num = /^[0-9]+$/;    
	   
	// 비밀번호 체크 
	var pss = $.trim($('#pwd').val()); // jQuery를 이용하여 앞뒤 공백 제거 
	if(pss=="") { 
		alert("비밀번호를 입력하세요!"); 
		$('#pwd').focus();   
		return false; 
	} else { 
		if(!num.test(pss)) { 
			alert("비밀번호는 숫자만 가능합니다!");
			$("#pwd").val("");
			$('#pwd').focus();
			return false; 
		} 
	}

	return true;
}

// validation='yes'  err='입금자명을 입력하세요'

// $("#select_box option:selected").val();

function open_win(){ 
	window.open("/member/searchZipcode","우편번호검색", "width=400,height=300,scrollbars=yes,resizeable=no,left=150,top=150");
}

// 브라우저에 따라 체크되는 방식이 다르기 때문에 original script 로 처리
function check_str(str,txt){
	//var str = document.getElementById(str);

	if( str == '' || str == null ){
		alert( txt + '을(를) 입력해주세요' );
		return false;
	}

	var blank_pattern = /^\s+|\s+$/g;
	if( str.replace( blank_pattern, '' ) == "" ){
		alert(' 공백만 입력되었습니다 ');
		return false;
	}

	//공백 금지
	//var blank_pattern = /^\s+|\s+$/g;(/\s/g
	var blank_pattern = /[\s]/g;
	if( blank_pattern.test( str) == true){
		alert(' 공백은 사용할 수 없습니다. ');
		return false;
	}

	/*
	var special_pattern = /[`~!@#$%^&*|\\\'\";:\/?]/gi;

	if( special_pattern.test(str) == true ){
		alert('특수문자는 사용할 수 없습니다.');
		return false;
	}
	*/
	
	return true;
}

//콤마풀기
function uncomma(str) {
    str = String(str);
    return str.replace(/[^\d]+/g, '');
}

//콤마찍기
function comma(str) {
    str = String(str);
    return str.replace(/(\d)(?=(?:\d{3})+(?!\d))/g, '$1,');
}