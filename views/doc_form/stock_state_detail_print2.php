

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head id="Head1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="robots" content="noindex,nofollow">
<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
<link type='text/css' rel='stylesheet'href='http://login.ecounterp.com/ECMain/ECount.Common/Css2/2_base.css?v=20150114122238' /><span></span>
<link type="text/css" rel="stylesheet" href="http://login.ecounterp.com/ECMain/ECount.Common/Css2/2_layout.css?2016011202" />
<link type="text/css" rel="stylesheet" href="http://login.ecounterp.com/ECMain/ECount.Common/Css2/2_table.css?2016011202" />
<link type="text/css" rel="stylesheet" href="http://login.ecounterp.com/ECMain/ECount.Common/Css2/2_menu.css?2015073001" />
<link type="text/css" rel="stylesheet" href="http://login.ecounterp.com/ECMain/ECount.Common/Css2/2_rpt_print.css?2015070601" /> 
<link type="text/css" rel="stylesheet" href="http://login.ecounterp.com/ECMain/ECount.Common/Css2/2_etc.css?2016011202" /> 
<link type='text/css' rel='stylesheet'href='http://login.ecounterp.com/ECMain/ECount.Common/Css2/2_setting.css?v=20150216182535' /><span></span>
<link type='text/css' rel='stylesheet'href='http://login.ecounterp.com/ECMain/ECount.Common/Css2/dhtmlwindow.css?v=20150313181130' /><span></span>
<link type='text/css' rel='stylesheet'href='http://login.ecounterp.com/ECMain/ECount.Common/Css2/tax.css?v=20140918195208' /><span></span>
<link type='text/css' rel='stylesheet'href='http://login.ecounterp.com/ECMain/ECount.Common/Css2/ECCalendar.css?v=20150119181649' /><span></span>
 </head>
<body>
<script language="javascript" type="text/javascript">
//<![CDATA[
// ----------------------------------------------------------------------------------
// 1. 전역변수 선언 영역
// ----------------------------------------------------------------------------------
    // 페이지정보
    var _Data = {
	    "flag": { "listOnly": false }
    };

// ----------------------------------------------------------------------------------
// 2. 초기 실행 함수 영역
// ----------------------------------------------------------------------------------
    // listOnly모드일 경우 부모창iframe설정
    $(function () {
	    if (_Data.flag.listOnly) {
		    $("#wrap").css("padding-top", "0px");
            $("#idPrint").removeClass();
            $("#divContainer").removeClass();
            $("#divContainer").addClass("container");
		    if (parent && parent.Iframe_onload && typeof parent.Iframe_onload == "function")
			    parent.Iframe_onload($("#fixScrollHeadList").width() + 10);
            $(":checkbox").attr("disabled", true);
	    }
    });

// ----------------------------------------------------------------------------------
// 3. 데이터 처리 함수 영역
// ----------------------------------------------------------------------------------


// ----------------------------------------------------------------------------------
// 4. 이벤트 호출 함수 영역
// ----------------------------------------------------------------------------------
    // 더보기
    function btnMore_onclick() {
	    if (parent && parent.MoreSearch && typeof parent.MoreSearch == "function")
		    parent.MoreSearch();

	    return false;
    }

    // 천건이상, 날짜클릭
    function PageMovement(Url, MType, MDate, MNo, MSerNo, flag) {
        var ChangeValue = $("#SearchXml").get(0).value;
        var FocusX = scroll_save("x", "body");
        var FocusY = scroll_save("y", "body");
        ChangeValue = fnXmlNodeChange(ChangeValue, "M_FocusX", FocusX);
        ChangeValue = fnXmlNodeChange(ChangeValue, "M_FocusY", FocusY);
        ChangeValue = fnXmlNodeChange(ChangeValue, "M_Pgm", "/ECMain/ESZ/ESZ003R.aspx");
        ChangeValue = fnXmlNodeChange(ChangeValue, "M_Type", MType);
        ChangeValue = fnXmlNodeChange(ChangeValue, "M_Date", MDate);
        ChangeValue = fnXmlNodeChange(ChangeValue, "M_No", MNo);
        ChangeValue = fnXmlNodeChange(ChangeValue, "M_SerNo", MSerNo);

        if (flag == "2" || "" == "Y") {
            if(!confirm("등록된 데이터가 1만개를 초과하는 경우, 1만개까지만 조회됩니다."))
                return false;
            ChangeValue = fnXmlNodeChange(ChangeValue, "M_BtnFlag", "Y");
        } else {
            ChangeValue = fnXmlNodeChange(ChangeValue, "M_BtnFlag", "");
        }

        $("#IO_DATE").get(0).value = MDate;
        $("#IO_TYPE").get(0).value = MType;
        $("#IO_NO").get(0).value =  MNo;
        $("#SER_NO").get(0).value =  MSerNo;
        $("#isOpenPopup").get(0).value = false; //팝업 구분값
        $("#isOldFramePreFlag").get(0).value = true; //구프레임웍 페이지 이동 구분값
        $("#isViewListButton").get(0).value = true; //하단의 리스트 버튼 보일지 구분값
        $("#isViewPreButton").get(0).value = true; //하단의 이전 버튼 보일지 구분값

        var target = '_self';

        if (_Data.flag.listOnly) {
            nW0("", "ESZ003", 1, 800, 600);
            target = 'ESZ003';
            Url = Url + "?ListYn=Y";
        }

        $("#SearchXml").get(0).value = ChangeValue; 
        $("#searchData").get(0).value = $("#SearchXml").get(0).value;
        $("#frmDetail").get(0).target = target;
        $("#frmDetail").get(0).action = fnSetUrlPath(Url,'ec_req_sid');
        $("#frmDetail").get(0).method = "post";
        $("#frmDetail").get(0).submit();
    }

    //엑셀변환
    function ExcelPageMovement(Url) {
        
            var ExcelBackupCountLimit = "30000";
            //var ExcelBackupCountLimit = 300;

            if (Number($("#hidTotalCnt").val()) > Number(ExcelBackupCountLimit)) { // 데이터가 3만 건 이상일 때 메시지
                alert(String.Format(GetResource("MSG05504"), ExcelBackupCountLimit));
                return false;
            }
            //엑셀변환중인지 확인한후 엑셀변환 진행
            $.ajax({
			    type: "POST",
			    dataType: "text",
                async: false,
			    url: fnSetUrlPath("../ESZ/ESZ_CM_DATA.aspx", "ec_req_sid"),
			    data: "Type=ExcelDic&KeyWord=ESZ_ESZ003RG1080GUEST636053172332215486",
			    error: function(errorMsg) {
				    alert("에러발생\nfnGetData:" + errorMsg);
				    //  return false;
			    },
			    success: function(returnXml) {
				    var dom = parseXML(returnXml);
				    var objResultXml = $(dom).find("RESULT");
				        if ($(objResultXml).find("EXCEL_DIC_YN").text() == "Y"){
                            alert("엑셀변환중입니다.");
                        }else{
                            var ChangeValue = $("#SearchXml").get(0).value;
                            ChangeValue = fnXmlNodeChange(ChangeValue, "M_SortAD", "");
                            $("#SearchXml").get(0).value = ChangeValue;
                            $("#frmDetail").get(0).method = "post";
                            $("#frmDetail").get(0).action = fnSetUrlPath(Url,'ec_req_sid');
                            $("#frmDetail").get(0).target = "ifrmExcel";
                            $("#frmDetail").submit();
                        }
				    }
		    });   
        
        
    }

    //PDF 변환
    function fnPdfBeta() {
        fnExportPdf("ECount", "ESZ003R", "ESZ003R", "ESZ003R", 2, $("#idPrint").html());
    }
// ----------------------------------------------------------------------------------
// 5. 기능 처리 함수 영역
// ----------------------------------------------------------------------------------

//]]>
</script>



    
<div id="wrap">

<!-- ***** 서치버튼 시작 **** -->
    <div class="print-search-fixed">
		<div class="print-search-layer">
			<!-- 검색창 -->					
			<div class="print-search-con">							
				
<script src="/ECMain/ECount.Common/Javascript/LoadProgressbar.js?2016021701" type="text/javascript"></script>
<script src="/ECMain/ECount.Common/Javascript/Util.js?2016021701" type="text/javascript"></script>
<script src="/ECMain/ECount.Common/Javascript/ECount.Common.Selectbox.Input.js?2016021701" type="text/javascript"></script>

<script language="javascript" type="text/javascript">
//팝업창 객체
var objDHtml = null;
var formCountType = 0;
var iFormCount1 = 0;
var iFormCount2 = 0;
var iFormCount3 = 0;
//Resource
var MSG04747 = '조회할 수 없는 년도입니다.\n년도를 다시 입력 바랍니다.';
var MSG00446 = '일자를 정확하게 입력 바랍니다.';


window.onload = function() {
    if($("#ddlFormSer") && $("#ddlFormSer option").length < 1)
        $("#ddlFormSer").attr("disabled", "true");
		
    windowonload();
      
    if("1" == "64")
    {
        fnChkMemo("0");
    }
    
    fnWorkTaget("");
    
    if("1" == "59"|| "1" == "58")
    {	 
	    var Gubun = $("input:radio[name=rbGubunChk]:checked").get(0).value;
        fnDisabledValue(Gubun);
    }

    if("1" == "21")//일별이익현황
        fnDayliWongaChange();
} 

$(document).ready(function () {    
    $("#ddlMenuIds").change(function() {         
        if( $("#ddlMenuIds").val() == "")
        {
            $("#ddlGroupIds").html("<option value='' selected='selected'>==선택==</option>");
            $("#ddlItems").html("<option value='' selected='selected'>==선택==</option>");

            if($("#ddlGroupIds_basic").get(0) != undefined) $("#ddlGroupIds_basic").html("<option value='' selected='selected'>==선택==</option>");
            if($("#ddlItems_basic").get(0) != undefined) $("#ddlItems_basic").html("<option value='' selected='selected'>==선택==</option>");
        }
        else
        {
	        fnGetData("Type=GETMANAGEITEMS&MenuId="+ $("#ddlMenuIds").val() +"&GroupId=", "", "", "", "", "N", "/ECMain/EMV/EMV002M_DATA.aspx","");
            $("#ddlItems").html("<option value='' selected='selected'>==선택==</option>");

            if($("#ddlItems_basic").get(0) != undefined) $("#ddlItems_basic").html("<option value='' selected='selected'>==선택==</option>");
        }
	});

    if($("#ddlMenuIds_basic").get(0) != undefined)
    {
        $("#ddlMenuIds_basic").change(function() {         
            if( $("#ddlMenuIds_basic").val() == "")
            {
                $("#ddlGroupIds").html("<option value='' selected='selected'>==선택==</option>");
                $("#ddlItems").html("<option value='' selected='selected'>==선택==</option>");

                $("#ddlGroupIds_basic").html("<option value='' selected='selected'>==선택==</option>");
                $("#ddlItems_basic").html("<option value='' selected='selected'>==선택==</option>");
            }
            else
            {
	            fnGetData("Type=GETMANAGEITEMS&MenuId="+ $("#ddlMenuIds_basic").val() +"&GroupId=", "", "", "", "", "N", "/ECMain/EMV/EMV002M_DATA.aspx","");
                $("#ddlItems").html("<option value='' selected='selected'>==선택==</option>");

                $("#ddlItems_basic").html("<option value='' selected='selected'>==선택==</option>");
            }
	    });
    }

    $("#ddlGroupIds").change(function() {         
        if( $("#ddlGroupIds").val() == "")
        {
            $("#ddlItems").html("<option value='' selected='selected'>==선택==</option>");

            if($("#ddlItems_basic").get(0) != undefined)
                $("#ddlItems_basic").html("<option value='' selected='selected'>==선택==</option>");
        }
        else
        {
	        fnGetData("Type=GETMANAGEITEMS&MenuId="+ $("#ddlMenuIds").val() +"&GroupId="+$("#ddlGroupIds").val(), "", "", "", "", "N", "/ECMain/EMV/EMV002M_DATA.aspx","");
        }
	});
    
    if($("#ddlGroupIds_basic").get(0) != undefined)
    {
        $("#ddlGroupIds_basic").change(function() {         
            if( $("#ddlGroupIds_basic").val() == "")
            {
                $("#ddlItems").html("<option value='' selected='selected'>==선택==</option>");

                $("#ddlItems_basic").html("<option value='' selected='selected'>==선택==</option>");
            }
            else
            {
	            fnGetData("Type=GETMANAGEITEMS&MenuId="+ $("#ddlMenuIds_basic").val() +"&GroupId="+$("#ddlGroupIds_basic").val(), "", "", "", "", "N", "/ECMain/EMV/EMV002M_DATA.aspx","");
            }
	    });
    }

    if($("#cbEtcWhCdOnly_basic").get(0) != undefined)
    {
        $("#cbEtcWhCdOnly_basic").mouseover(function() {
            $("#divEtcWhCdOnly_basic").show();
            return false;
        });
        $("#cbEtcWhCdOnly_basic").mouseout(function() {
            $("#divEtcWhCdOnly_basic").hide();
            return false;
        });
    }
    if($("#cbEtcWhCdOnly").get(0) != undefined)
    {
        $("#cbEtcWhCdOnly").mouseover(function() {
            $("#divEtcWhCdOnly").show();
            return false;
        });
        $("#cbEtcWhCdOnly").mouseout(function() {
            $("#divEtcWhCdOnly").hide();
            return false;
        });
    }

    if ("1" == "54" || "1" == "55"){
        if('0' == '2')
            fnSetDisCheckLocation(1);
        
        if('0' != '1' && "1" == "54")
            fnExcFlagCheck('N');

        if('0' != '1' && "1" == "55")
            fnExcFlagCheck('N');

        fnDisableInactive();
    }
    
    if ("1" == "811"){
        changeSNStatusType('0');
        
        if($("#ddlFormSer").get(0).options.length < 1)
            $("#ddlFormSer").hide();
        else
            $("#ddlFormSer").show();
    }
	
	
	//Set Focus for Business Expenses Status Report
	if ("1" == "791"){
		if($("#ddlSYear_basic").get(0) !=undefined)
				$("#ddlSYear_basic").get(0).focus();
				
		if($("#ddlFormSer").get(0).options.length < 1)
            $("#ddlFormSer").hide();
        else
            $("#ddlFormSer").show();

	}
    if ("1" == "812"){
        if($("#ddlSYear_basic").get(0) !=undefined)
				$("#ddlSYear_basic").get(0).focus();
    }


});

function windowonload()
{ 
    if("1" == "207")
      {
        ZeroItem("");
      }

    if("1" == "22" || "1" == "23" )
      {
        fnEtcChkSer();
      }

    $("#txtTSDay")
    .keyup(function() {
        return formatNumber(this.value, 0, this);
    })
    .blur(function() {
        if($("#ddlTSYear").get(0).value !="" && $("#ddlTSMonth").get(0).value !=""){
            fnlastday("ddlTSYear", "ddlTSMonth", "txtTSDay");
            if ($("#txtTSDay").get(0).value==""|| $("#txtTSDay").get(0).value=="0"|| $("#txtTSDay").get(0).value=="00")
            $("#txtTSDay").get(0).value="01";
        } else{
            $("#ddlTSYear").get(0).value = "";
            $("#ddlTSMonth").get(0).value = "";  
            $("#txtTSDay").get(0).value = "";  
        }
    });

    if($("#txtTSDay_basic").get(0) != undefined)
    {
        $("#txtTSDay_basic")
        .keyup(function() {
            return formatNumber(this.value, 0, this);
        })
        .blur(function() {
            if($("#ddlTSYear_basic").get(0).value !="" && $("#ddlTSMonth_basic").get(0).value !=""){
                fnlastday("ddlTSYear_basic", "ddlTSMonth_basic", "txtTSDay_basic");
                if ($("#txtTSDay_basic").get(0).value==""|| $("#txtTSDay_basic").get(0).value=="0"|| $("#txtTSDay_basic").get(0).value=="00")
                $("#txtTSDay_basic").get(0).value="01";
            } else{
                $("#ddlTSYear_basic").get(0).value = "";
                $("#ddlTSMonth_basic").get(0).value = "";  
                $("#txtTSDay_basic").get(0).value = "";  
            }
        });
    }

    $("#txtTEDay") 
    .keyup(function() {
        return formatNumber(this.value, 0, this);
    })
    .blur(function() {
        if($("#ddlTEYear").get(0).value !="" && $("#ddlTEMonth").get(0).value !=""){
            fnlastday("ddlTEYear", "ddlTEMonth", "txtTEDay");
                if ($("#txtTEDay").get(0).value==""|| $("#txtTEDay").get(0).value=="0"|| $("#txtTEDay").get(0).value=="00")
            $("#txtTEDay").get(0).value="01";
        } else {
            $("#ddlTEYear").get(0).value = "";
            $("#ddlTEMonth").get(0).value = "";
            $("#txtTEDay").get(0).value = "";
        }
    });

    if($("#txtTEDay_basic").get(0) != undefined)
    {
        $("#txtTEDay_basic") 
        .keyup(function() {
            return formatNumber(this.value, 0, this);
        })
        .blur(function() {
            if($("#ddlTEYear_basic").get(0).value !="" && $("#ddlTEMonth_basic").get(0).value !=""){
                fnlastday("ddlTEYear_basic", "ddlTEMonth_basic", "txtTEDay_basic");
                 if ($("#txtTEDay_basic").get(0).value==""|| $("#txtTEDay_basic").get(0).value=="0"|| $("#txtTEDay_basic").get(0).value=="00")
                $("#txtTEDay_basic").get(0).value="01";
            } else {
                $("#ddlTEYear_basic").get(0).value = "";
                $("#ddlTEMonth_basic").get(0).value = "";
                $("#txtTEDay_basic").get(0).value = "";
            }
        });
    }

    //출하일자
    $("#txtExpectSDay")
    .keyup(function() {
        return formatNumber(this.value, 0, this);
    })
    .blur(function() {
        if($("#ddlExpectSYear").get(0).value !="" && $("#ddlExpectSMonth").get(0).value !=""){
            fnlastday("ddlExpectSYear", "ddlExpectSMonth", "txtExpectSDay");
            if ($("#txtExpectSDay").get(0).value==""|| $("#txtExpectSDay").get(0).value=="0"|| $("#txtExpectSDay").get(0).value=="00")
            $("#txtExpectSDay").get(0).value="01";
        } else{
            $("#ddlExpectSYear").get(0).value = "";
            $("#ddlExpectSMonth").get(0).value = "";  
            $("#txtExpectSDay").get(0).value = "";  
        }
    });

    if($("#txtExpectSDay_basic").get(0) != undefined)
    {
        $("#txtExpectSDay_basic")
        .keyup(function() {
            return formatNumber(this.value, 0, this);
        })
        .blur(function() {
            if($("#ddlExpectSYear_basic").get(0).value !="" && $("#ddlExpectSMonth_basic").get(0).value !=""){
                fnlastday("ddlExpectSYear_basic", "ddlExpectSMonth_basic", "txtExpectSDay_basic");
                if ($("#txtExpectSDay_basic").get(0).value==""|| $("#txtExpectSDay_basic").get(0).value=="0"|| $("#txtExpectSDay_basic").get(0).value=="00")
                $("#txtExpectSDay_basic").get(0).value="01";
            } else{
                $("#ddlExpectSYear_basic").get(0).value = "";
                $("#ddlExpectSMonth_basic").get(0).value = "";  
                $("#txtExpectSDay_basic").get(0).value = "";  
            }
        });
    }

    $("#txtExpectEDay") 
    .keyup(function() {
        return formatNumber(this.value, 0, this);
    })
    .blur(function() {
        if($("#ddlExpectEYear").get(0).value !="" && $("#ddlExpectEMonth").get(0).value !=""){
            fnlastday("ddlExpectEYear", "ddlExpectEMonth", "txtExpectEDay");
             if ($("#txtExpectEDay").get(0).value==""|| $("#txtExpectEDay").get(0).value=="0"|| $("#txtExpectEDay").get(0).value=="00")
            $("#txtExpectEDay").get(0).value="01";
        } else {
            $("#ddlExpectEYear").get(0).value = "";
            $("#ddlExpectEMonth").get(0).value = "";
            $("#txtExpectEDay").get(0).value = "";
        }
    });

    if($("#txtExpectSDay_basic").get(0) != undefined)
    {
        $("#txtExpectEDay_basic") 
        .keyup(function() {
            return formatNumber(this.value, 0, this);
        })
        .blur(function() {
            if($("#ddlExpectEYear_basic").get(0).value !="" && $("#ddlExpectEMonth_basic").get(0).value !=""){
                fnlastday("ddlExpectEYear_basic", "ddlExpectEMonth_basic", "txtExpectEDay_basic");
                 if ($("#txtExpectEDay_basic").get(0).value==""|| $("#txtExpectEDay_basic").get(0).value=="0"|| $("#txtExpectEDay_basic").get(0).value=="00")
                $("#txtExpectEDay_basic").get(0).value="01";
            } else {
                $("#ddlExpectEYear_basic").get(0).value = "";
                $("#ddlExpectEMonth_basic").get(0).value = "";
                $("#txtExpectEDay_basic").get(0).value = "";
            }
        });
    }

    $("#txtSLastUpdatedDay")
    .keyup(function() {
        return formatNumber(this.value, 0, this);
    })
    .blur(function() {
        if($("#ddlSLastUpdatedYear").get(0).value !="" && $("#ddlSLastUpdatedMonth").get(0).value !=""){
            fnlastday("ddlSLastUpdatedYear", "ddlSLastUpdatedMonth", "txtSLastUpdatedDay");
            if ($("#txtSLastUpdatedDay").get(0).value==""|| $("#txtSLastUpdatedDay").get(0).value=="0"|| $("#txtSLastUpdatedDay").get(0).value=="00")
            $("#txtSLastUpdatedDay").get(0).value="01";
        } else{
            $("#ddlSLastUpdatedYear").get(0).value = "";
            $("#ddlSLastUpdatedMonth").get(0).value = "";  
            $("#txtSLastUpdatedDay").get(0).value = "";  
        }
    });

    if($("#txtSLastUpdatedDay_basic").get(0) != undefined)
    {
        $("#txtSLastUpdatedDay_basic")
        .keyup(function() {
            return formatNumber(this.value, 0, this);
        })
        .blur(function() {
            if($("#ddlSLastUpdatedYear_basic").get(0).value !="" && $("#ddlSLastUpdatedMonth_basic").get(0).value !=""){
                fnlastday("ddlSLastUpdatedYear_basic", "ddlSLastUpdatedMonth_basic", "txtSLastUpdatedDay_basic");
                if ($("#txtSLastUpdatedDay_basic").get(0).value==""|| $("#txtSLastUpdatedDay_basic").get(0).value=="0"|| $("#txtSLastUpdatedDay_basic").get(0).value=="00")
                $("#txtSLastUpdatedDay_basic").get(0).value="01";
            } else{
                $("#ddlSLastUpdatedYear_basic").get(0).value = "";
                $("#ddlSLastUpdatedMonth_basic").get(0).value = "";  
                $("#txtSLastUpdatedDay_basic").get(0).value = "";  
            }
        });
    }

    $("#txtELastUpdatedDay") 
    .keyup(function() {
        return formatNumber(this.value, 0, this);
    })
    .blur(function() {
        if($("#ddlELastUpdatedYear").get(0).value !="" && $("#ddlELastUpdatedMonth").get(0).value !=""){
            fnlastday("ddlELastUpdatedYear", "ddlELastUpdatedMonth", "txtELastUpdatedDay");
             if ($("#txtELastUpdatedDay").get(0).value==""|| $("#txtELastUpdatedDay").get(0).value=="0"|| $("#txtELastUpdatedDay").get(0).value=="00")
            $("#txtELastUpdatedDay").get(0).value="01";
        } else {
            $("#ddlELastUpdatedYear").get(0).value = "";
            $("#ddlELastUpdatedMonth").get(0).value = "";
            $("#txtELastUpdatedDay").get(0).value = "";
        }
    });

    if($("#txtELastUpdatedDay_basic").get(0) != undefined)
    {
        $("#txtELastUpdatedDay_basic") 
        .keyup(function() {
            return formatNumber(this.value, 0, this);
        })
        .blur(function() {
            if($("#ddlELastUpdatedYear_basic").get(0).value !="" && $("#ddlELastUpdatedMonth_basic").get(0).value !=""){
                fnlastday("ddlELastUpdatedYear_basic", "ddlELastUpdatedMonth_basic", "txtELastUpdatedDay_basic");
                 if ($("#txtELastUpdatedDay_basic").get(0).value==""|| $("#txtELastUpdatedDay_basic").get(0).value=="0"|| $("#txtELastUpdatedDay_basic").get(0).value=="00")
                $("#txtELastUpdatedDay_basic").get(0).value="01";
            } else {
                $("#ddlELastUpdatedYear_basic").get(0).value = "";
                $("#ddlELastUpdatedMonth_basic").get(0).value = "";
                $("#txtELastUpdatedDay_basic").get(0).value = "";
            }
        });
    }

    if("1" == "56")
    {
        if("N" == "N"){
            fnDangaCheck("");
        }
    }
    
    if("1" == "41" || "1" == "42" || "1" == "43")
    {
        chk_change("");
    }
    
    
    var field_ = $("#hidTabFirsts").get(0).value.split("|");
  
    if("1" != "19") {
        if (($("#hidLastField2").get(0).value == "" && field_[1] != "SimpleSearch") || ("1" == "800"))
        {
            $("#tab2").get(0).style.display = "none";
            MM_showHideLayers1("1");
        }
    }
    //fnGroupDisplaySet();  

	if("1" == "35" || "1" == "2" || "1" == "3" || "1" == "5" || "1" == "6")
		SumGubunChk("1","");
}

function TabChangeFocus()
{
    if ($("#hidTabGubun").get(0).value == "1")
    {
        if("1" == "31" || "1" == "32" || "1" == "70"|| "1" == "71")
        {
            $("#ddlYYMM_basic").get(0).focus();
        }
        else if("1" == "722" || "1" == "725")
        {        
            var field_ = $("#hidTabFirsts").get(0).value.split("|");
            if(field_[0] == "txtSerialS_basic")
            {
                $("#txtSerialS_basic").get(0).focus();
                $("#txtSerialS_basic").get(0).select();
            }else{
                $("#txtSProdCd_basic").get(0).focus();
                $("#txtSProdCd_basic").get(0).select();
            }
        }
        else
        {
            var field_ = $("#hidTabFirsts").get(0).value.split("|");
            if (field_[0] != "SimpleSearch" && field_[0] != "EtcChk_basic" && $("#hidLastField2").get(0).value !="")
            {
                if($("#"+field_[0] + "_basic").get(0) != undefined && $("#"+field_[0] + "_basic").get(0).type != "hidden")
                {                
                    $("#"+field_[0] + "_basic").get(0).focus();
                    if ($("#"+field_[0] + "_basic").get(0).type != "select-one")
                        $("#"+field_[0] + "_basic").get(0).select();
                }        
            }
        }
    }
    else
    {
        if("1" == "31" || "1" == "32" || "1" == "70"|| "1" == "71")
        {
            $("#ddlYYMM").get(0).focus();
        }
        else if("1" == "722" || "1" == "725" || "1" == "58" || "1" == "59" || "1" == "811")
        {        
            var field_ = $("#hidTabFirsts").get(0).value.split("|");
            if(field_[1] == "txtSerialS")
            {
                $("#txtSerialS").get(0).focus();
                $("#txtSerialS").get(0).select();
            }else{
                $("#txtSProdCd").get(0).focus();
                $("#txtSProdCd").get(0).select();
            }
        }
        else
        {
            var field_ = $("#hidTabFirsts").get(0).value.split("|");
            if (field_[1] != "SimpleSearch" && field_[1] != "EtcChk" && $("#hidLastField2").get(0).value !="")
            {           
                if($("#"+field_[1] + "_basic").get(0) != undefined && $("#"+field_[1]).get(0).type != "hidden")
                {                
                    $("#"+field_[1]).get(0).focus();
                    if ($("#"+field_[1]).get(0).type != "select-one")
                        $("#"+field_[1]).get(0).select();
                }        
            }         
        }
    }
}

function showBx(id) 
{
    var bx = document.getElementById(id);
    if (bx.style.display == "block") 
    {
        bx.style.display= "none";
    } 
    else
    {
        bx.style.display= "block" ;
    }
}
function Click_F8()
{
      frmSearchData(-1, true);
}
function fnClear()
{
    $("#frmSearch").clearForm();
}

function fnClear2(Gubun){
     $("#txtColCd" + Gubun).get(0).value = "";
     $("#txtColDes" + Gubun).get(0).value = ""; 

     if($("#txtColCd" + Gubun).get(0) != undefined)
     {
         $("#txtColCd" + Gubun + "_basic").get(0).value = "";
         $("#txtColDes" + Gubun + "_basic").get(0).value = ""; 
     }
}

function fnChkAcc_DataGet(strGubun, strRpt) 
{
    var strAccDate = "";
     $.ajax({
                async: false, 
                type: "POST",
                url: fnSetUrlPath("/ECMain/CM/EB/SummaryChkAcc_DataGet.aspx","ec_req_sid"),
                data: "Gubun="+strGubun+"&RptGubun="+strRpt,
                error: function(errMsg) {
                    alert('에러발생' + errMsg);
                },
                success: function(strValue) {
                    strAccDate = strValue;
                }
            });
    return strAccDate;

}



function fnTodaySearchData()
{

    $("#ddlSYear > option[value="+$("select[name=ddlEYear] option:selected").val()+"]").attr("selected","true"); ;
    $("#ddlSMonth > option[value="+$("select[name=ddlEMonth] option:selected").val()+"]").attr("selected","true"); 
    $("#txtSDay").get(0).value = $("#txtEDay").get(0).value;
    $("#ddlSYear_basic > option[value="+$("select[name=ddlEYear_basic] option:selected").val()+"]").attr("selected","true"); ;
    $("#ddlSMonth_basic > option[value="+$("select[name=ddlEMonth_basic] option:selected").val()+"]").attr("selected","true"); 
    $("#txtSDay_basic").get(0).value = $("#txtEDay_basic").get(0).value;
    frmSearchData();
}

function fnCheck3Years(objStart, objEnd, tabNo, justCheck) {
    if($("#"+objEnd).length && $("#"+objStart).length && $("#"+objEnd).get(0).value - $("#"+objStart).get(0).value >= 3) {
        if(justCheck) {
            return true;
        } else {
            if(confirm("검색기간이 3년을 초과할 경우 검색시간이 오래 걸릴 수 있습니다.\n조회기간을 재설정하겠습니까?")) {
                if(tabNo > 0) {
                    MM_showHideLayers1(tabNo);
                    TabChangeFocus();
                }
                $("#"+objStart).focus();
                return true;
            } else
                return false;
        }
    }
}

function fnCheckProdCd(sufix, tabNo, justCheck) {
    var objId1 = "#txtSProdCd"+sufix;
    var objId2_1 = "#txtClassCd"+sufix;
    var objId2_2 = "#txtClassCd2"+sufix;
    var objId2_3 = "#txtClassCd3"+sufix;
    var objId3 = "#txtTreeGroupCd"+sufix;
    
    if(($(objId1).length && $(objId1).get(0).value.trim() == "") &&
       ($(objId2_1).length && $(objId2_1).get(0).value.trim() == "") &&
       ($(objId2_2).length && $(objId2_2).get(0).value.trim() == "") &&
       ($(objId2_3).length && $(objId2_3).get(0).value.trim() == "") &&
       ($(objId3).length && $(objId3).get(0).value.trim() == "")) {
        if(justCheck) {
            return true;
        } else {
            if(confirm("품목개수가 많을 경우 검색시간이 오래 걸릴 수 있습니다.\n조회품목을 재지정하겠습니까?")) {
                if(tabNo > 0) {
                    MM_showHideLayers1(tabNo);
                    TabChangeFocus();
                }
                $(objId1).focus();
                return true;
            } else
                return false;
        }
    }
}
function frmSearchData(gubun, year_flag) {
    
    if((formCountType == "1" && iFormCount1 < 1) || //시리얼No.재고수불부양식 > 일반 (SO720), 시리얼No.재고현황 > 시리얼No. (SO721)
       (formCountType == "2" && iFormCount2 < 1) || //시리얼No.재고수불부양식 > 시리얼별집계 (SO724), 시리얼No.재고현황 > 시리얼No.(창고별) (SO722)
       (formCountType == "3" && iFormCount3 < 1)) { //시리얼No.재고현황 > 품목별집계 (SO723)
        alert("모든 양식에 대해 조회권한이 없습니다.\n마스터에게 문의 바랍니다.");
        return false;
    }
    var date = new Date();
    var strChkFlag = "N";
    var strInvenCloseChk = "N";

    // start : 기준일자 : 3년 이상 기간 조회, 년도 기준
    var checkYearProd = true;
    if(year_flag) {
        
        //재고수불부1/재고수불부2
        if($("#rbSumGubun0_basic").length == 0 || $("input:radio[name=rbSumGubun_basic]:checked").get(0).value =="0") {
            if($("#tab1").attr("class") == "nav_tabon") {
                if($("#txtSProdCd_basic").length) {
                    if(fnCheck3Years("ddlSYear_basic", "ddlEYear_basic", 0, true) && fnCheckProdCd("_basic", 0, true)) {
                        checkYearProd = false;
                        if(confirm("검색기간이 3년을 초과하거나 품목개수가 많을 경우 검색시간이 오래 걸릴 수 있습니다.\n검색조건을 재설정하겠습니까?")) {
                            MM_showHideLayers1(1);
                            TabChangeFocus();
                            $("#ddlSYear_basic").focus();
                            return false;
                        }
                    }
                } else {
                    if(fnCheck3Years("ddlSYear_basic", "ddlEYear_basic", 0, true) && fnCheckProdCd("", 2, true)) {
                        checkYearProd = false;
                        if(confirm("검색기간이 3년을 초과하거나 품목개수가 많을 경우 검색시간이 오래 걸릴 수 있습니다.\n검색조건을 재설정하겠습니까?")) {
                            MM_showHideLayers1(1);
                            TabChangeFocus();
                            $("#ddlSYear_basic").focus();
                            return false;
                        }
                    }
                }
            } else {
                if(fnCheck3Years("ddlSYear", "ddlEYear", 0, true) && fnCheckProdCd("", 0, true)) {
                    checkYearProd = false;
                    if(confirm("검색기간이 3년을 초과하거나 품목개수가 많을 경우 검색시간이 오래 걸릴 수 있습니다.\n검색조건을 재설정하겠습니까?")) {
                        MM_showHideLayers1(2);
                        TabChangeFocus();
                        $("#ddlSYear").focus();
                        return false;
                    }
                }
            }
        } else if($("#rbSumGubun0_basic").length && ($("input:radio[name=rbSumGubun_basic]:checked").get(0).value =="1" || $("input:radio[name=rbSumGubun_basic]:checked").get(0).value =="2")) {
            if($("#tab1").attr("class") == "nav_tabon") {
                if($("#txtSProdCd_basic").length) {
                    if(fnCheck3Years("ddlSYear_basic", "ddlEYear_basic", 0, false)) return false;
                } else {
                    if(fnCheck3Years("ddlSYear_basic", "ddlEYear_basic", 0, false)) return false;
                }
            } else {
                if(fnCheck3Years("ddlSYear", "ddlEYear", 0, false)) return false;
            }
        } else {
            checkYearProd = false;
        }
        
        if(checkYearProd) {
            if($("#tab1").attr("class") == "nav_tabon") {
                if(fnCheck3Years("ddlSYear_basic", "ddlEYear_basic", 0, false)) return false;
            } else {
                if(fnCheck3Years("ddlSYear", "ddlEYear", 0, false)) return false;
            }
        }
        
        // 품목 지정되도록(재고수불부1/재고수불부2)
        if(checkYearProd && ($("#rbSumGubun0_basic").length == 0 || $("input:radio[name=rbSumGubun_basic]:checked").get(0).value =="0")) {
            if($("#tab1").attr("class") == "nav_tabon") {
                if($("#txtSProdCd_basic").length) {
                    if(fnCheckProdCd("_basic", 0, false)) return false;
                } else {
                    if(fnCheckProdCd("", 2, false)) return false;
                }
            } else {
                if(fnCheckProdCd("", 0, false)) return false;
            }
        }
        
    }
    // end : 기준일자 : 3년 이상 기간 조회, 년도 기준

    // pms : 770,69(출하지시서) / 780,78(출하조회,현황) / 610,18(자가사용조회,현황) / 500,44(불량처리조회,현황) / 410,6(생산불출조회,현황) / 600,4 (창고이동조회, 현황) / 400,25,30(작업지시서조회, 현황, 작업지시서별진행현황) / 203,11,13(견적서조회, 현황, 미주문현황) / 207(발주계획조회) / 206,65(발주요청조회 , 현황) / 240(단가요청조회), 810 View transactions 
    if("1" =="203" || "1" == "11" || "1" =="13" || "1" =="2" || "1" =="12" || "1" =="5" || "1" =="15" 
        || "1" =="16" || "1" =="3" || "1" =="201" || "1" =="200" || "1" =="420" || "1" =="204" || "1" =="205" 
        || "1" =="770" || "1" =="69" || "1" =="780" || "1" =="78" || "1" =="610" || "1" =="18" || "1" =="500" 
        || "1" =="44" || "1" =="410" || "1" =="6" || "1" =="600" || "1" =="400" || "1" =="25" || "1" =="30" 
        || "1" =="203" || "1" =="11" || "1" =="13" || "1" =="207" || "1" =="206" || "1" =="65" || "1" =="240" 
        || "1" =="4" || "1" == "721"  || "1" =="212" || "1" =="810" || "1" =="58" || "1" == "811")
    {
        if (
             ('1900' > $("#ddlEYear_basic").get(0).value) || (date.getFullYear() + 1 < $("#ddlEYear_basic").get(0).value)
          || ('1900' > $("#ddlEYear").get(0).value) || (date.getFullYear() + 1 < $("#ddlEYear").get(0).value)
          || ('1900' > $("#ddlSYear").get(0).value) || (date.getFullYear() + 1 < $("#ddlSYear").get(0).value)
          || ('1900' > $("#ddlSYear_basic").get(0).value) || (date.getFullYear() + 1 < $("#ddlSYear_basic").get(0).value)
          || ($("#ddlEYear_basic").get(0).value.length != 4 || $("#ddlEYear").get(0).value.length != 4 || $("#ddlSYear").get(0).value.length != 4 || $("#ddlSYear_basic").get(0).value.length != 4 )
            /*pms*/	
			
			/*pms*/
			/*bji*/	
			
			/*bji*/
            )
        {
            window.Click_Blur_Call = 'false';
            alert(MSG04747); // 조회할 수 없는 년도 입니다.\n년도를 다시 입력바랍니다.
          
           window.setTimeout(function () {
                window.Click_Blur_Call = 'true';
            },200);  
            return false;
        }
    }
    if("1" == "722" || "1" == "725" || "1" == "58" || "1" == "59"){        
        if(($("#ddlEYearUdcDt1_basic").length > 0 && $("#ddlEYearUdcDt1_basic").get(0).value != "" && ($("#ddlEYearUdcDt1_basic").get(0).value.length != 4 || '1900' > $("#ddlEYearUdcDt1_basic").get(0).value || date.getFullYear() + 1 < $("#ddlEYearUdcDt1_basic").get(0).value))
          ||($("#ddlEYearUdcDt1").length > 0 && $("#ddlEYearUdcDt1").get(0).value != "" && ($("#ddlEYearUdcDt1").get(0).value.length != 4 || '1900' > $("#ddlEYearUdcDt1").get(0).value || date.getFullYear() + 1 < $("#ddlEYearUdcDt1").get(0).value))
          ||($("#ddlSYearUdcDt1").length > 0 && $("#ddlSYearUdcDt1").get(0).value != "" && ($("#ddlSYearUdcDt1").get(0).value.length != 4 || '1900' > $("#ddlSYearUdcDt1").get(0).value || date.getFullYear() + 1 < $("#ddlSYearUdcDt1").get(0).value))
          ||($("#ddlSYearUdcDt1_basic").length > 0 && $("#ddlSYearUdcDt1_basic").get(0).value != "" && ($("#ddlSYearUdcDt1_basic").get(0).value.length != 4 || '1900' > $("#ddlSYearUdcDt1_basic").get(0).value || date.getFullYear() + 1 < $("#ddlSYearUdcDt1_basic").get(0).value))
          ||($("#ddlEYearUdcDt2_basic").length > 0 && $("#ddlEYearUdcDt2_basic").get(0).value != "" && ($("#ddlEYearUdcDt2_basic").get(0).value.length != 4 || '1900' > $("#ddlEYearUdcDt2_basic").get(0).value || date.getFullYear() + 1 < $("#ddlEYearUdcDt2_basic").get(0).value))
          ||($("#ddlEYearUdcDt2").length > 0 && $("#ddlEYearUdcDt2").get(0).value != "" && ($("#ddlEYearUdcDt2").get(0).value.length != 4 || '1900' > $("#ddlEYearUdcDt2").get(0).value || date.getFullYear() + 1 < $("#ddlEYearUdcDt2").get(0).value))
          ||($("#ddlSYearUdcDt2").length > 0 && $("#ddlSYearUdcDt2").get(0).value != "" && ($("#ddlSYearUdcDt2").get(0).value.length != 4 || '1900' > $("#ddlSYearUdcDt2").get(0).value || date.getFullYear() + 1 < $("#ddlSYearUdcDt2").get(0).value))
          ||($("#ddlSYearUdcDt2_basic").length > 0 && $("#ddlSYearUdcDt2_basic").get(0).value != "" && ($("#ddlSYearUdcDt2_basic").get(0).value.length != 4 || '1900' > $("#ddlSYearUdcDt2_basic").get(0).value || date.getFullYear() + 1 < $("#ddlSYearUdcDt2_basic").get(0).value))
          ){
            window.Click_Blur_Call = 'false';
            alert(MSG04747); // 조회할 수 없는 년도 입니다.\n년도를 다시 입력바랍니다.
          
            window.setTimeout(function () {
            window.Click_Blur_Call = 'true';
            },200);  
            return false;
          }
          var strSUdcDt = "";
          var strEUdcDt = "";
          if(($("#ddlEYearUdcDt1_basic").length > 0 && $("#ddlSYearUdcDt1_basic").length > 0) && ($("#ddlEYearUdcDt1_basic").get(0).value != "" || $("#ddlSYearUdcDt1_basic").get(0).value != "")){
            strSUdcDt = $("#ddlSYearUdcDt1_basic").get(0).value + $("#ddlSMonthUdcDt1_basic").get(0).value + $("#txtSDayUdcDt1_basic").get(0).value;
            strEUdcDt = $("#ddlEYearUdcDt1_basic").get(0).value + $("#ddlEMonthUdcDt1_basic").get(0).value + $("#txtEDayUdcDt1_basic").get(0).value;
            if(strSUdcDt.length != 8 || strEUdcDt.length != 8 || strSUdcDt > strEUdcDt){
                alert(MSG00446);
                try{
                    if(strSUdcDt.length != 8)
                        $("#txtSDayUdcDt1_basic").get(0).focus();
                    else
                        $("#txtEDayUdcDt1_basic").get(0).focus();
                }catch(e){}
            return false;
            }
          }
          if(($("#ddlEYearUdcDt2_basic").length > 0 && $("#ddlSYearUdcDt2_basic").length > 0) && ($("#ddlEYearUdcDt2_basic").get(0).value != "" || $("#ddlSYearUdcDt2_basic").get(0).value != "")){
            strSUdcDt = $("#ddlSYearUdcDt2_basic").get(0).value + $("#ddlSMonthUdcDt2_basic").get(0).value + $("#txtSDayUdcDt2_basic").get(0).value;
            strEUdcDt = $("#ddlEYearUdcDt2_basic").get(0).value + $("#ddlEMonthUdcDt2_basic").get(0).value + $("#txtEDayUdcDt2_basic").get(0).value;
            if(strSUdcDt.length != 8 || strEUdcDt.length != 8 || strSUdcDt > strEUdcDt){
                alert(MSG00446);
                try{
                    if(strSUdcDt.length != 8)
                        $("#txtSDayUdcDt2_basic").get(0).focus();
                    else
                        $("#txtEDayUdcDt2_basic").get(0).focus();
                }catch(e){}
            return false;
            }
          }
          if(($("#ddlEYearUdcDt1").length > 0 && $("#ddlSYearUdcDt1").length > 0) && ($("#ddlEYearUdcDt1").get(0).value != "" || $("#ddlSYearUdcDt1").get(0).value != "")){
            strSUdcDt = $("#ddlSYearUdcDt1").get(0).value + $("#ddlSMonthUdcDt1").get(0).value + $("#txtSDayUdcDt1").get(0).value;
            strEUdcDt = $("#ddlEYearUdcDt1").get(0).value + $("#ddlEMonthUdcDt1").get(0).value + $("#txtEDayUdcDt1").get(0).value;
            if(strSUdcDt.length != 8 || strEUdcDt.length != 8 || strSUdcDt > strEUdcDt){
                alert(MSG00446);
                try{
                    if(strSUdcDt.length != 8)
                        $("#txtSDayUdcDt1").get(0).focus();
                    else
                        $("#txtEDayUdcDt1").get(0).focus();
                }catch(e){}
            return false;
            }
          }
          if(($("#ddlEYearUdcDt2").length > 0 && $("#ddlSYearUdcDt2").length > 0) && ($("#ddlEYearUdcDt2").get(0).value != "" || $("#ddlSYearUdcDt2").get(0).value != "")){
            strSUdcDt = $("#ddlSYearUdcDt2").get(0).value + $("#ddlSMonthUdcDt2").get(0).value + $("#txtSDayUdcDt2").get(0).value;
            strEUdcDt = $("#ddlEYearUdcDt2").get(0).value + $("#ddlEMonthUdcDt2").get(0).value + $("#txtEDayUdcDt2").get(0).value;
            if(strSUdcDt.length != 8 || strEUdcDt.length != 8 || strSUdcDt > strEUdcDt){
                alert(MSG00446);
                try{
                    if(strSUdcDt.length != 8)
                        $("#txtSDayUdcDt2").get(0).focus();
                    else
                        $("#txtEDayUdcDt2").get(0).focus();
                }catch(e){}
            return false;
            }
          }
    }

    var btnCnt = Number($("#hfButtonCnt").val()) + 1;
    
    if (btnCnt == 1) {
        $("#hfButtonCnt").get(0).value = btnCnt;

        if (1 < 200)
            fHidDes();
        
        //월별일 경우 일자 재세팅
        if("1" == "64")
        {
            var SumGubun = $("input:radio[name=rbSumGubun]:checked");
            if(SumGubun.get(0).value == "1")
                fnChkMemo('1');           
        }
            
        if (("1" == "49" || "1" == "50" || "1" == "80" || "1" == "81") && "" == "Y")
        {
            if ($("#txtSCustCd").get(0).value.trim() == "")
            {
               alert("검색창에 거래처코드를 입력하고 검색 바랍니다. "); 
                $("#txtSCustCd").get(0).focus();

                if($("#txtSCustCd_basic").get(0) != undefined)
                    $("#txtSCustCd_basic").get(0).focus();

                $("#hfButtonCnt").get(0).value="0";
                return false;
            }
        }
        if($("#txtSDay").get(0) != undefined )
        {
            if(Number(checkDate2($("#ddlSYear").get(0).value, $("#ddlSMonth").get(0).value)) < Number($("#txtSDay").get(0).value))
            {
                alert("시작일자를 정확하게 입력 바랍니다. ");
                $("#txtSDay").get(0).focus();

                if($("#txtSDay_basic").get(0) != undefined)
                    $("#txtSDay_basic").get(0).focus();

                $("#hfButtonCnt").get(0).value="0";
                return false;
            }

            if(/[^0123456789]/g.test($("#txtSDay").get(0).value)) 
            {
                if ($("#ddlSMonth").length > 0)
                {
                    $("#ddlSMonth").get(0).focus();

                    if($("#ddlSMonth_basic").get(0) != undefined)
                        $("#ddlSMonth_basic").get(0).focus();
                }
                $("#hfButtonCnt").get(0).value="0";
                return;
            }

            if($("#txtSDay").get(0).value.length == 0)
            {
                $("#txtSDay").get(0).value = "01";
            }

            if($("#txtSDay").get(0).value.length>0 && $("#txtSDay").get(0).value.length <2)
            {
                $("#txtSDay").get(0).value = "0" + $("#txtSDay").get(0).value;
            }
        }

        if($("#txtEDay").get(0) != undefined )
        {
            if(Number(checkDate2($("#ddlEYear").get(0).value, $("#ddlEMonth").get(0).value)) < Number($("#txtEDay").get(0).value))
            {
                alert("종료일자를 정확하게 입력 바랍니다. ");
                $("#txtEDay").get(0).focus();

                if($("#txtEDay_basic").get(0) != undefined)
                    $("#txtEDay_basic").get(0).focus();

                $("#hfButtonCnt").get(0).value="0";
                return false;
            }

            if(/[^0123456789]/g.test($("#txtEDay").get(0).value)) 
            {
                if ($("#ddlEMonth").length > 0)
                {
                    $("#ddlEMonth").get(0).focus();

                    if($("#ddlEMonth_basic").get(0) != undefined)
                        $("#ddlEMonth_basic").get(0).focus();
                }
                $("#hfButtonCnt").get(0).value="0";
                return;
            }

            if($("#txtEDay").get(0).value.length == 0)
            {
                $("#txtEDay").get(0).value = "01";
            }

            if($("#txtEDay").get(0).value.length>0 && $("#txtEDay").get(0).value.length <2)
            {
                $("#txtEDay").get(0).value = "0" + $("#txtEDay").get(0).value;
            }
        }
        if($("#txtSDay").get(0) != undefined  && $("#txtEDay").get(0) != undefined )
        {
            var StartDate = $("#ddlSYear").get(0).value + $("#ddlSMonth").get(0).value + $("#txtSDay").get(0).value;
            var EndDate = $("#ddlEYear").get(0).value + $("#ddlEMonth").get(0).value + $("#txtEDay").get(0).value;
           
            if(StartDate > EndDate )
            {
                alert("일자를 정확하게 입력 바랍니다. ");
                try{$("#txtSDay").get(0).focus();}catch(e){}
                try{
                     if($("#txtSDay_basic").get(0) != undefined)
                        $("#txtSDay_basic").get(0).focus();
                }catch(e){}
                $("#hfButtonCnt").get(0).value="0";
                return false;    
            }
            if("1" == "64") {
                if ($("input:radio[name=rbSumGubun]:checked").get(0).value == "0"){
                    var checkDateLimitFrom = new Date( $("#ddlSYear").get(0).value , Number($("#ddlSMonth").get(0).value)-1 , $("#txtSDay").get(0).value);
                    var checkDateLimitTo = new Date($("#ddlEYear").get(0).value , Number($("#ddlEMonth").get(0).value)-1 , $("#txtEDay").get(0).value);
                    var checkDateLimit = checkDateLimitTo - checkDateLimitFrom;
                    if(checkDateLimit/(24 * 60 * 60 * 1000) > 30 )
                    {
                        alert("최대 31일간 조회 가능합니다. ");
                        //alert("최대 31일간 조회 가능합니다.");
                        try{$("#txtSDay").get(0).focus();}catch(e){}
                        try{
                             if($("#txtSDay_basic").get(0) != undefined)
                                $("#txtSDay_basic").get(0).focus();
                        }catch(e){}
                        $("#hfButtonCnt").get(0).value="0";
                        return false;    
                    }
                }
            }
        }

         //기초잔액입력월 체크하여 안내창 띄우기
        if("1" == "26" || "1" == "17" || "1" == "22" || "1" == "23" || "1" == "33" || "1" == "34")
        {
            var yymm = $("#ddlSYear").get(0).value+""+$("#ddlSMonth").get(0).value;

            if (yymm < 201201) {
               alert("기초잔액입력월보다 이전일자입니다.\n\n2012년 1월 부터 조회하십시오.\n\n기초잔액입력월은 회계 I > 기초등록 > 기초잔액입력 > 재무제표별기초잔액입력 에서 확인 가능합니다.");
               //alert("2012년 01월부터 조회하십시오.");
                $("#hfButtonCnt").get(0).value="0";               
               $("#ddlSMonth").get(0).focus();

               if($("#ddlSMonth_basic").get(0) != undefined)
                    $("#ddlSMonth_basic").get(0).focus();
               return false;
            }
        }

        if("N" == "Y")
        {
            if($("#ddlTSYear").get(0).value != "" || $("#ddlTSMonth").get(0).value != "")
            {
                if((Number(checkDate2($("#ddlTSYear").get(0).value, $("#ddlTSMonth").get(0).value)) < Number($("#txtTSDay").get(0).value)) && "1" != "201")
                {
                    alert("일자를 정확하게 입력 바랍니다. ");
                    try{$("#txtTSDay").get(0).focus();}catch(e){}
                    try{
                        if($("#txtTSDay_basic").get(0) != undefined)
                            $("#txtTSDay_basic").get(0).focus();
                    }catch(e){}
                    $("#hfButtonCnt").get(0).value="0";
                    return false;
                }

                if((Number(checkDate2($("#ddlTEYear").get(0).value, $("#ddlTEMonth").get(0).value)) < Number($("#txtTEDay").get(0).value))  && "1" != "201")
                {
                    alert("일자를 정확하게 입력 바랍니다. ");
                    try{$("#txtTEDay").get(0).focus();}catch(e){}
                    try{
                        if($("#txtTEDay_basic").get(0) != undefined)
                            $("#txtTEDay_basic").get(0).focus();
                    }catch(e){}
                    $("#hfButtonCnt").get(0).value="0";
                    return false;
                }
                if($("#txtTSDay").get(0).value.length == 0)
                {
                    $("#txtTSDay").get(0).value = "01";
                }

                if($("#txtTSDay").get(0).value!="" && $("#txtTSDay").get(0).value.length <2)
                {
                    $("#txtTSDay").get(0).value = "0" + $("#txtTSDay").get(0).value;
                }

                if($("#txtTEDay").get(0).value.length == 0)
                {
                    $("#txtTEDay").get(0).value = "01";
                }
                if($("#txtTEDay").get(0).value!="" && $("#txtTEDay").get(0).value.length <2)
                {
                    $("#txtTEDay").get(0).value = "0" + $("#txtTEDay").get(0).value;
                }
				if($("#txtTSDay").get(0) != undefined  && $("#txtTEDay").get(0) != undefined )
				{
					var StartTDate = $("#ddlTSYear").get(0).value + $("#ddlTSMonth").get(0).value + $("#txtTSDay").get(0).value;
					var EndTDate = $("#ddlTEYear").get(0).value + $("#ddlTEMonth").get(0).value + $("#txtTEDay").get(0).value;
				   
					if(StartTDate > EndTDate )
					{
						alert("일자를 정확하게 입력 바랍니다. ");
						try{$("#txtTSDay").get(0).focus();}catch(e){}
                        try{
                            if($("#txtTSDay_basic").get(0) != undefined)
                                $("#txtTSDay_basic").get(0).focus();
                        }catch(e){}
						$("#hfButtonCnt").get(0).value="0";
						return false;				
					}                    
				}
            }
        }

        //출하일자
        if("N" == "Y")
        {
            if($("#ddlExpectSYear").get(0).value != "" || $("#ddlExpectSMonth").get(0).value != "")
            {
                if((Number(checkDate2($("#ddlExpectSYear").get(0).value, $("#ddlExpectSMonth").get(0).value)) < Number($("#txtExpectSDay").get(0).value)) && ("1" == "770" || "1" == "69" || "1" == "781" || "1" == "79"))
                {
                    alert('일자를 정확하게 입력 바랍니다.');
                    try{$("#txtExpectSDay").get(0).focus();}catch(e){}
                    try{
                        if($("#txtExpectSDay_basic").get(0) != undefined)
                            $("#txtExpectSDay_basic").get(0).focus();
                    }catch(e){}
                    $("#hfButtonCnt").get(0).value="0";
                    return false;
                }

                if((Number(checkDate2($("#ddlExpectEYear").get(0).value, $("#ddlExpectEMonth").get(0).value)) < Number($("#txtExpectEDay").get(0).value))  && ("1" == "770" || "1" == "69" || "1" == "781" || "1" == "79"))
                {
                    alert('일자를 정확하게 입력 바랍니다.');
                    try{$("#txtExpectEDay").get(0).focus();}catch(e){}
                    try{
                        if($("#txtExpectEDay_basic").get(0) != undefined)
                            $("#txtExpectEDay_basic").get(0).focus();
                    }catch(e){}
                    $("#hfButtonCnt").get(0).value="0";
                    return false;
                }
                if($("#txtExpectSDay").get(0).value.length == 0)
                {
                    $("#txtExpectSDay").get(0).value = "01";
                }

                if($("#txtExpectSDay").get(0).value!="" && $("#txtExpectSDay").get(0).value.length <2)
                {
                    $("#txtExpectSDay").get(0).value = "0" + $("#txtExpectSDay").get(0).value;
                }

                if($("#txtExpectEDay").get(0).value.length == 0)
                {
                    $("#txtExpectEDay").get(0).value = "01";
                }
                if($("#txtExpectEDay").get(0).value!="" && $("#txtExpectEDay").get(0).value.length <2)
                {
                    $("#txtExpectEDay").get(0).value = "0" + $("#txtExpectEDay").get(0).value;
                }
				if($("#txtExpectSDay").get(0) != undefined  && $("#txtExpectEDay").get(0) != undefined )
				{
					var StartEDate = $("#ddlExpectSYear").get(0).value + $("#ddlExpectSMonth").get(0).value + $("#txtExpectSDay").get(0).value;
					var EndEDate = $("#ddlExpectEYear").get(0).value + $("#ddlExpectEMonth").get(0).value + $("#txtExpectEDay").get(0).value;
				   
					if(StartEDate > EndEDate )
					{
						alert("일자를 정확하게 입력 바랍니다. ");
						try{$("#txtExpectEDay").get(0).focus();}catch(e){}
                        try{
                            if($("#txtExpectEDay_basic").get(0) != undefined)
                                $("#txtExpectEDay_basic").get(0).focus();
                        }catch(e){}
						$("#hfButtonCnt").get(0).value="0";
						return false;				
					}
				}
            }
        }

         if("1" == "723" || "1" == "724") {
            if($("#ddlSLastUpdatedYear").get(0).value != "" || $("#ddlSLastUpdatedMonth").get(0).value != "")
            {
                if((Number(checkDate2($("#ddlSLastUpdatedYear").get(0).value, $("#ddlSLastUpdatedMonth").get(0).value)) < Number($("#txtSLastUpdatedDay").get(0).value)) && "1" != "201")
                {
                    alert("일자를 정확하게 입력 바랍니다. ");
                    try{$("#txtSLastUpdatedDay").get(0).focus();}catch(e){}
                    try{
                        if($("#txtSLastUpdatedDay_basic").get(0) != undefined)
                            $("#txtSLastUpdatedDay_basic").get(0).focus();
                    }catch(e){}
                    $("#hfButtonCnt").get(0).value="0";
                    return false;
                }

                if((Number(checkDate2($("#ddlELastUpdatedYear").get(0).value, $("#ddlELastUpdatedMonth").get(0).value)) < Number($("#txtELastUpdatedDay").get(0).value))  && "1" != "201")
                {
                    alert("일자를 정확하게 입력 바랍니다. ");
                    try{$("#txtELastUpdatedDay").get(0).focus();}catch(e){}
                    try{
                        if($("#txtELastUpdatedDay_basic").get(0) != undefined)
                            $("#txtELastUpdatedDay_basic").get(0).focus();
                    }catch(e){}
                    $("#hfButtonCnt").get(0).value="0";
                    return false;
                }

                 if(fnNumberChk($("#txtSLastUpdatedDay").get(0).value) == true) {
                    alert("일자를 정확하게 입력 바랍니다. ");
                    try{$("#txtSLastUpdatedDay").get(0).focus();}catch(e){}
                    try{
                        if($("#txtSLastUpdatedDay_basic").get(0) != undefined)
                            $("#txtSLastUpdatedDay_basic").get(0).focus();
                    }catch(e){}
                    $("#hfButtonCnt").get(0).value="0";
                    return false;
                }

                  if(fnNumberChk($("#txtELastUpdatedDay").get(0).value) == true) {
                    alert("일자를 정확하게 입력 바랍니다. ");
                    try{$("#txtELastUpdatedDay").get(0).focus();}catch(e){}
                    try{
                        if($("#txtELastUpdatedDay_basic").get(0) != undefined)
                            $("#txtELastUpdatedDay_basic").get(0).focus();
                    }catch(e){}
                    $("#hfButtonCnt").get(0).value="0";
                    return false;
                }

                if($("#txtSLastUpdatedDay").get(0).value.length == 0)
                {
                    $("#txtSLastUpdatedDay").get(0).value = "01";
                }

                if($("#txtSLastUpdatedDay").get(0).value!="" && $("#txtSLastUpdatedDay").get(0).value.length <2)
                {
                    $("#txtSLastUpdatedDay").get(0).value = "0" + $("#txtSLastUpdatedDay").get(0).value;
                }

                if($("#txtELastUpdatedDay").get(0).value.length == 0)
                {
                    $("#txtELastUpdatedDay").get(0).value = "01";
                }
                if($("#txtELastUpdatedDay").get(0).value!="" && $("#txtELastUpdatedDay").get(0).value.length <2)
                {
                    $("#txtELastUpdatedDay").get(0).value = "0" + $("#txtELastUpdatedDay").get(0).value;
                }
            }

            if($("#txtSLastUpdatedDay").get(0) != undefined  && $("#txtELastUpdatedDay").get(0) != undefined )
            {
                if($("#txtSLastUpdatedDay").get(0).value != ""  && $("#txtELastUpdatedDay").get(0).value != "") 
                {
                    var StartDate = $("#ddlSLastUpdatedYear").get(0).value + $("#ddlSLastUpdatedMonth").get(0).value + $("#txtSLastUpdatedDay").get(0).value;
                    var EndDate = $("#ddlELastUpdatedYear").get(0).value + $("#ddlELastUpdatedMonth").get(0).value + $("#txtELastUpdatedDay").get(0).value;
           
                    if(StartDate > EndDate )
                    {
                        alert("일자를 정확하게 입력 바랍니다. ");
                        try{$("#txtELastUpdatedDay").get(0).focus();}catch(e){}
                        try{
                            if($("#txtELastUpdatedDay_basic").get(0) != undefined)
                                $("#txtELastUpdatedDay_basic").get(0).focus();
                        }catch(e){}    
                        $("#hfButtonCnt").get(0).value="0";
                        return false;
                    }
                }
            }	

            if("1" == "723")
            {
                if($("#ddlWorkTarget").get(0).value == "") {
                    alert("작업대상을 선택 바랍니다.");
                    $("#ddlWorkTarget").get(0).focus();

                    if($("#ddlWorkTarget_basic").get(0) != undefined)
                        $("#ddlWorkTarget_basic").get(0).focus();

                    $("#hfButtonCnt").get(0).value="0";
                    return false;
                }


                if($("#ddlLastHistory").get(0).value == "N") {
                    if($("#ddlWorkTarget").get(0).value != "42")
                    {
                        alert("[생산입고 II로 변경] 이력은 작업대상을 생산입고 II로 선택한 경우에만 조회 가능합니다. \n 작업대상을 확인 바랍니다.");
                        $("#ddlWorkTarget").get(0).focus();

                        if($("#ddlWorkTarget_basic").get(0) != undefined)
                            $("#ddlWorkTarget_basic").get(0).focus();

                        $("#hfButtonCnt").get(0).value="0";
                        return false;
                    }
                }

                if($("#ddlLastHistory").get(0).value == "C") {
                    if($("#ddlWorkTarget").get(0).value != "02")
                    {
                        alert("[확인(CS)] 이력은 작업대상을 주문서로 선택한 경우에만 조회 가능합니다.\n작업대상을 확인 바랍니다.");
                        $("#ddlWorkTarget").get(0).focus();

                        if($("#ddlWorkTarget_basic").get(0) != undefined)
                            $("#ddlWorkTarget_basic").get(0).focus();

                        $("#hfButtonCnt").get(0).value="0";
                        return false;
                    }
                }


                if($("#ddlLastHistory").get(0).value == "S" ) {
                    if($("#ddlWorkTarget").get(0).value != "13" && $("#ddlWorkTarget").get(0).value != "14")
                    {
                        alert("해당 이력은 작업대상을 거래처 또는 품목으로 선택한 경우에만 조회 가능합니다.\n작업대상을 확인 바랍니다.");
                        $("#ddlWorkTarget").get(0).focus();
                        
                        if($("#ddlWorkTarget_basic").get(0) != undefined)
                            $("#ddlWorkTarget_basic").get(0).focus();

                        $("#hfButtonCnt").get(0).value="0";
                        return false;
                    }
                }
                if($("#ddlLastHistory").get(0).value == "A" ) {
                    if($("#ddlWorkTarget").get(0).value != "13" && $("#ddlWorkTarget").get(0).value != "14")
                    {
                        alert("해당 이력은 작업대상을 거래처 또는 품목으로 선택한 경우에만 조회 가능합니다.\n작업대상을 확인 바랍니다.");
                        $("#ddlWorkTarget").get(0).focus();

                        if($("#ddlWorkTarget_basic").get(0) != undefined)
                            $("#ddlWorkTarget_basic").get(0).focus();

                        $("#hfButtonCnt").get(0).value="0";
                        return false;
                    }
                }
            }
        }
        
        if("1" == "21")
        {
            if($("#ddlWongaType").get(0).value == "3")
            {
                if($("#ddlGisu").get(0).value == "")
                {
                    alert("원가생성 내역이 없습니다.\n\n재고 II > 이익관리 > 원가생성/수정 에서 원가를 생성한 후, 해당 기준월을 선택하여 조회 바랍니다.");
                    $("#hfButtonCnt").get(0).value="0";
                    return false;
                }
            }
        }

        if("1" == "29")
        {   
            var chkSelVal = $("#ddlWongaType").get(0).value; 
            var chkRbVal = $("input:radio[name=rbProdChk]:checked").get(0).value;

            if(chkSelVal == "3")
            {
                if($("#ddlGisu").get(0).value == "")
                {
                    alert("원가생성 내역이 없습니다.\n\n재고 II > 이익관리 > 원가생성/수정 에서 원가를 생성한 후, 해당 기준월을 선택하여 조회 바랍니다.");
                    $("#hfButtonCnt").get(0).value="0";
                    return false;
                }
            }

            if(chkSelVal == "4" && chkRbVal != "3")
            {
                //alert("상품일때만 판매기준(선입선출)-상품 항목을 선택할 수 있습니다.");
                alert("품목구분이 상품일 때만 [판매기준(선입선출)-상품] 항목을 선택할 수 있습니다.\n품목구분을 확인 바랍니다.");
                $("#ddlWongaType").get(0).focus();

                if($("#ddlWongaType_basic").get(0) != undefined)
                    $("#ddlWongaType_basic").get(0).focus();

                $("#hfButtonCnt").get(0).value="0";
                return;
            }
        }

        if("1" == "721" || "1" == "722" || "1" == "725" || "1" == "58" || "1" == "59" || "1" == "811"){

            if("1" != "721" && "1" != "811")
            {
                for(var i = 1; i <= 3; i++)
                {
                    if($("#txtUdcNumS"+i).get(0).value !="" && $("#txtUdcNumE"+i).get(0).value !="")
                    {            
                        if(String($("#txtUdcNumS"+i).get(0).value.toUpperCase()) > String($("#txtUdcNumE"+i).get(0).value.toUpperCase()))
                        {
                            alert('작은 값에서 큰 값 순으로 입력 바랍니다. ');
                            $("#txtUdcNumE"+i).get(0).focus();

                            if($("#txtUdcNumE"+i+"_basic").get(0) != undefined)
                                $("#txtUdcNumE"+i+"_basic").get(0).focus();

                            $("#hfButtonCnt").get(0).value="0";
                            return false;
                        }
                    }
                }
            }

            if($("#txtSerialS").get(0).value !="" && $("#txtSerialE").get(0).value !="") {
            
                if(String($("#txtSerialS").get(0).value.toUpperCase()) > String($("#txtSerialE").get(0).value.toUpperCase()))
                {
                    alert('작은 값에서 큰 값 순으로 입력 바랍니다. ');
                    $("#txtSerialE").get(0).focus();

                    if($("#txtSerialE_basic").get(0) != undefined)
                        $("#txtSerialE_basic").get(0).focus();

                    $("#hfButtonCnt").get(0).value="0";
                    return false;
                }
            }
        }
        
        
        if("1" == "800" && $("input:radio[name=rbSumGubun]:checked").get(0).value =="2" && $("#txtSWhCd").get(0).value == "" )
            {
                alert("창고를 입력바랍니다.");
                $("#txtSWhCd").get(0).focus();
                 if($("#txtSWhCd_basic").get(0) != undefined && $("#txtSWhCd_basic").get(0).value == "")
                        $("#txtSWhCd_basic").get(0).focus();
                $("#hfButtonCnt").get(0).value="0";
                return false;
            }
            if("1" == "800" && $("input:radio[name=rbSumGubun_basic]:checked").get(0).value =="1" && $("#cbItemChk").get(0) != undefined && $("#cbItemChk").get(0).checked == false && $("#txtItemCd").get(0).value == "" )
            {
                alert("관리항목명을 입력 바랍니다.");
                $("#txtItemCd").get(0).focus();
                 if($("#txtItemCd_basic").get(0) != undefined && $("#txtItemCd_basic").get(0).value == "")
                        $("#txtItemCd_basic").get(0).focus();
                $("#hfButtonCnt").get(0).value="0";
                return false;
            }
        

        	// Expenses Status Date Period vs. Transaction Date Validation
	if("1" == "791") {
		var alias = "";
		if("1"=="1")
		{
			alias = "_basic";
		}
		if("N" == "Y") {
			
			if($("#txtPeriodSDay"+ alias).get(0) != undefined  && $("#txtPeriodEDay"+ alias).get(0) != undefined )
			{
				var PeriodStartDate = $("#ddlPeriodSYear"+ alias).get(0).value + $("#ddlPeriodSMonth"+ alias).get(0).value + $("#txtPeriodSDay"+ alias).get(0).value;
				var PeriodEndDate = $("#ddlPeriodEYear"+ alias).get(0).value + $("#ddlPeriodEMonth"+ alias).get(0).value + $("#txtPeriodEDay"+ alias).get(0).value;
			   
				if(PeriodStartDate > PeriodEndDate )
				{
					alert("일자를 정확하게 입력 바랍니다. ");
					try{$("#txtPeriodSDay"+ alias).get(0).focus();}catch(e){}
					try{
						 if($("#txtPeriodSDay"+ alias).get(0) != undefined)
							$("#txtPeriodSDay"+ alias).get(0).focus();
					}catch(e){}
					$("#hfButtonCnt").get(0).value="0";
					return false;    
				}
			}
		}
		
		
	}

        frmactionValueSetting($("#frmSearch").get(0));
        
        var ErrFlag = "N";
        var strXml = "<root>";
        var str = $("#frmSearch").formToArray();
        for (var i = 0; i < str.length; i++) {
            if (str[i].name != "hidSearchXml") {
                if (str[i].value.indexOf("'") > -1 || str[i].value.indexOf('"') > -1)
                {
                    ErrFlag = "Y";
                    str[i].value = fnReplace(str[i].value, "'", "");
                    str[i].value = fnReplace(str[i].value, '"', "");
                    if ($("#"+str[i].name).length > 0) {
                        $("#"+str[i].name).get(0).value = str[i].value;
                    }
                    else{
                        if (document.getElementsByName(str[i].name).length>0){
                            document.getElementsByName(str[i].name)[0].value = str[i].value;
                        }
                    }
                }

                strXml += "<" + str[i].name + "><![CDATA[" + str[i].value + "]]></" + str[i].name + ">";
            }
        }
        if("1" == "48" ||"1" == "49" || "1" == "50"||"1" == "67" ||"1" == "80" || "1" == "81"||"1" == "82")
        {
            strXml  += "<txtSiteCd><![CDATA[]]></txtSiteCd><txtSiteDes><![CDATA[]]></txtSiteDes>";
        }
        if("1" == "721" || "1" == "722"  || "1" == "725")
            strXml  += "<M_RptGubun><![CDATA[1]]></M_RptGubun><M_FormGubun><![CDATA[SO623]]></M_FormGubun><M_SortAD></M_SortAD><M_Sort></M_Sort><M_FocusX><![CDATA[0]]></M_FocusX><M_FocusY><![CDATA[0]]></M_FocusY><M_Date></M_Date><M_No><![CDATA[0]]></M_No><M_SerNo><![CDATA[1]]></M_SerNo><M_Type><![CDATA[]]></M_Type><M_TrxSer></M_TrxSer><M_TrxDate></M_TrxDate><M_TrxNo><![CDATA[0]]></M_TrxNo><M_Pgm><![CDATA["+$("#frmSearch").get(0).action+"]]></M_Pgm><M_Page><![CDATA[1]]></M_Page><M_EdmsFlag><![CDATA[N]]></M_EdmsFlag><M_EditFlag><![CDATA[M]]></M_EditFlag><M_FirstFlag></M_FirstFlag><M_PFlag><![CDATA[]]></M_PFlag><M_AFlag><![CDATA[]]></M_AFlag><M_BtnFlag></M_BtnFlag>";		    
        else
            strXml  += "<M_RptGubun><![CDATA[1]]></M_RptGubun><M_FormGubun><![CDATA[SO623]]></M_FormGubun><M_SortAD></M_SortAD><M_Sort></M_Sort><M_FocusX><![CDATA[0]]></M_FocusX><M_FocusY><![CDATA[0]]></M_FocusY><M_Date></M_Date><M_No><![CDATA[0]]></M_No><M_SerNo><![CDATA[1]]></M_SerNo><M_Type><![CDATA[]]></M_Type><M_TrxSer></M_TrxSer><M_TrxDate></M_TrxDate><M_TrxNo><![CDATA[0]]></M_TrxNo><M_Pgm><![CDATA["+$("#frmSearch").get(0).action+"]]></M_Pgm><M_Page><![CDATA[1]]></M_Page><M_EdmsFlag><![CDATA[N]]></M_EdmsFlag><M_EditFlag><![CDATA[M]]></M_EditFlag><M_FirstFlag></M_FirstFlag><M_FirstFlag2><![CDATA[1]]></M_FirstFlag2><M_PFlag><![CDATA[]]></M_PFlag><M_BtnFlag></M_BtnFlag>";

        if("1" == "723" || "1" == "724") {
            strXml += "";
        }

        if("1" == "209" ) {
            strXml += "<M_ddlTempIndex><![CDATA[]]></M_ddlTempIndex>";
        }
        if("1" == "211" ) {
            strXml += "<M_SortCustAD><![CDATA[A]]></M_SortCustAD>";
        }
        if("1" == "202" ) {
            strXml += "<outPlantCd><![CDATA["+$("#outplant").get(0).value+"]]></outPlantCd><outPlantDes><![CDATA["+$("#outplant_des").get(0).value+"]]></outPlantDes><bomFlag><![CDATA["+$("#bom_flag3").get(0).value+"]]></bomFlag>";
        }

        strXml += "</root>";
        
        if (ErrFlag == "Y")
        {
            $("#hfButtonCnt").get(0).value = "0";
            alert('\’ 또는 \" 기호는 검색할 수 없습니다.');
            return false;
        } 
               
        $("#frmSearch").get(0).hidSearchXml.value = strXml;
                        
        //미청구 채권/채무 월마감
        if("N" == "Y") {
            var UnBondChkDate;//미청구채권최종수정일
            var UnDebtChkDate;//미청구채무최종수정일
            var UnClaimeddate;//검색일
            var UnClaimedEnddate;//검색일
            var UnClaimedchkval;//구분값
            var UnClaimedFlag = "N";//에러플래그
            var UnClaimedToMonth = Number(-3);//3개월 전까지 집계함

            //전전월>전월변경
            switch("1")
            {
                case "19": //경영자보고서
                case "26": //일보
                case "22": //거래처별채권
                case "23": //거래처별채무
                case "17": //채권/채무현황
                case "42": //거래처관리대장 I
                case "61": //거래처관리대장 II
                case "33": //월별채권증감내역
                case "34": UnClaimedToMonth = Number(-2); break;//월별채무증감내역
            }

            if( "1" == "17" ) { //채권/채무현황
                if($("input:radio[name=rbSumGubun_basic]:checked").get(0) != undefined)
                    UnClaimedchkval = $("input:radio[name=rbSumGubun_basic]:checked").get(0).value;//1:채권   2:채무   3:채권/채무
                else if($("input:radio[name=rbSumGubun]:checked").get(0) != undefined)
                    UnClaimedchkval = $("input:radio[name=rbSumGubun]:checked").get(0).value;//1:채권   2:채무   3:채권/채무
                else
                    UnClaimedchkval = "1";
            } else if( "1" == "26" ) { //일보
                UnClaimedchkval = "";
                if($("#cbSelCode6").get(0).checked == true && $("#cbSelCode7").get(0).checked == false) UnClaimedchkval = "1";
                else if($("#cbSelCode6").get(0).checked == false && $("#cbSelCode7").get(0).checked == true) UnClaimedchkval = "2";
                else if($("#cbSelCode6").get(0).checked == true && $("#cbSelCode7").get(0).checked == true) UnClaimedchkval = "3";
            }else
                UnClaimedchkval = "";

            if("1" == "22" || "1" == "33" ) {//거래처별채권/월별채권증감내역
                UnBondChkDate = fnChkAcc_DataGet("SALE_BOND","1");
            } else if("1" == "23" || "1" == "34" ) {//거래처별채무/월별채무증감내역
                UnDebtChkDate = fnChkAcc_DataGet("BUY_DEBT","1");
            } else if( "1" == "17" ) {//채권/채무현황
                if( UnClaimedchkval == "1" )//채권
                    UnBondChkDate = fnChkAcc_DataGet("SALE_BOND","1");
                else if( UnClaimedchkval == "2" )//채무
                    UnDebtChkDate = fnChkAcc_DataGet("BUY_DEBT","1");
                else if( UnClaimedchkval == "3" ){//채권/채무
                    UnBondChkDate = fnChkAcc_DataGet("SALE_BOND","1");
                    UnDebtChkDate = fnChkAcc_DataGet("BUY_DEBT","1");
                }
                else
                    UnBondChkDate = fnChkAcc_DataGet("SALE_BOND","1");
            } else if( "1" == "19" ) {//경영자보고서
                UnBondChkDate = fnChkAcc_DataGet("SALE_BOND","1");
                UnDebtChkDate = fnChkAcc_DataGet("BUY_DEBT","1");
            } else if( "1" == "26" ) {//일보
                if(UnClaimedchkval == "1")
                    UnBondChkDate = fnChkAcc_DataGet("SALE_BOND","1");
                if(UnClaimedchkval == "2")
                    UnDebtChkDate = fnChkAcc_DataGet("BUY_DEBT","1");
                if(UnClaimedchkval == "3") {
                    UnBondChkDate = fnChkAcc_DataGet("SALE_BOND","1");
                    UnDebtChkDate = fnChkAcc_DataGet("BUY_DEBT","1");
                }
            }
            
//            //무조건 종료월 기준으로 처리되게 변경.(A15_01387)
//            UnClaimeddate = getCheckDate($("#ddlEYear"),$("#ddlEMonth"), UnClaimedToMonth+ 1);
//            UnClaimedEnddate = getCheckDate($("#ddlEYear"),$("#ddlEMonth"), UnClaimedToMonth);
            
            //경영자보고서19,일보26,거래처별채권22,거래처별채무23,거관142,거괄261,월채증33,월채감34
             //채권채무는 시작일만있음
                UnClaimeddate = getCheckDate($("#ddlSYear"),$("#ddlSMonth"), UnClaimedToMonth + 1);
                UnClaimedEnddate = getCheckDate($("#ddlSYear"),$("#ddlSMonth"), UnClaimedToMonth);
            

            if( UnClaimeddate == undefined ) UnClaimeddate = "";
            if( UnBondChkDate == undefined ) UnBondChkDate = "";
            if( UnDebtChkDate == undefined ) UnDebtChkDate = "";

            if( "1" == "17" || "1" == "19" ) {//17:채권/채무현황, 19:경영자보고서
                if( (UnClaimeddate.toString() > UnBondChkDate) || (UnClaimeddate.toString() > UnDebtChkDate) )
                    UnClaimedFlag = "Y";
            } else if("1" == "22" || "1" == "33" ) {//거래처별채권/월별채권증감내역
                if( UnClaimeddate.toString() > UnBondChkDate )
                    UnClaimedFlag = "Y";           
            } else if("1" == "23" || "1" == "34" ) {//거래처별채무/월별채무증감내역
                if( UnClaimeddate.toString() > UnDebtChkDate )
                    UnClaimedFlag = "Y";
            } else if( "1" == "26" ) {//일보
                if(UnClaimedchkval == "1") {
                    if( UnClaimeddate.toString() > UnBondChkDate )
                        UnClaimedFlag = "Y";
                }
                if(UnClaimedchkval == "2") {
                    if( UnClaimeddate.toString() > UnDebtChkDate )
                        UnClaimedFlag = "Y";
                }
                if(UnClaimedchkval == "3") { //채권/채무
                    if( (UnClaimeddate.toString() > UnBondChkDate) || (UnClaimeddate.toString() > UnDebtChkDate) )
                        UnClaimedFlag = "Y";
                }
            }           

            if( UnClaimedFlag == "Y" ) {
                var UnClaimedErrorMsg = "";
				var MenuType = "";
				if(UnClaimedchkval == "1") {
					MenuType = "R";
				}
				else if(UnClaimedchkval == "2") {
					MenuType = "P";
				}
				else {
					MenuType = "B"; //R and B
				}
				
				var sDay = $("#txtSDay").val();
                if($("#txtSDay_basic").get(0) != undefined)
                    $("#txtSDay_basic").val();
					
				var data = JSON.stringify({
					//RptGubun: "1",
					//UnClaimedEnddate: UnClaimedEnddate,
					//UnBondChkDate: UnBondChkDate,
					//UnDebtChkDate: UnDebtChkDate,
					base_from_date: UnClaimedEnddate + "01",
					base_to_date: UnClaimedEnddate + "01",
                    EnableCheckMonthsAgo: 0,
					MENU_TYPE: MenuType
				});
				
				ECAjax.apiPost("/Inventory/Common/InsertBatchUpdateBalanceForPreInvoiced", data, function(result) {
					var runSuccessFunc = false;
					
					if(result.Status != "200") {
						runSuccessFunc = result.Status == "202";				
						alert(result.fullErrorMsg);
					}
					else {
						runSuccessFunc = true;
					}
					
					if(runSuccessFunc) {
						UnClaimedErrorMsg = result.Data.split("∬")[1];
					}
					else {
						ECLoading.hide();
					}
					
				},
				{ 
					async:false,    //신규프레임워크에서는 callback방식으로 변경해야합니다.
					beforeSend: function() {
						ECLoading.show();
					}
				});	

//                $.ajax({
//                    async: false, 
//                    type: "POST",
//                    url: fnSetUrlPath("/ECMain/CM3/SummaryBondDebt.aspx","ec_req_sid"),
//                    data: "RptGubun=" + "1" + "&UnClaimedchkval=" + UnClaimedchkval + "&UnClaimedEnddate=" + UnClaimedEnddate + "&UnBondChkDate=" + UnBondChkDate + "&UnDebtChkDate=" + UnDebtChkDate + "&IniYymm=" + "20120101",
//                    error: function(errMsg) {
//                        alert('에러발생' + errMsg);
//                    },
//                    success: function(strValue) {
//                        UnClaimedErrorMsg = strValue;
//                    }
//                });
                if( UnClaimedErrorMsg != "0" )
                    alert(UnClaimedErrorMsg);
            }//if( UnClaimedFlag == "Y" )
        }//미청구 채권/채무 월마감

        //월마감 체크
        
                var ChkDate = fnChkAcc_DataGet("SALE","1");
            
            
            var ToMonth = Number(-3);//3개월 전까지 집계함

            
                //변경된 월마감
                var date;
                var year ;
                var month ;
                
                year = $("#ddlSYear").get(0).value;
                month =$("#ddlSMonth").get(0).value;

                if( month == "01")
                {            
                    year = year - 1;
                    date = year + "12";
                }
                else
                {
                    date =  year + month;
                    date = date - 1;
                } 

                //변경되지 않은 것
                var date1 = $("#ddlSYear").get(0).value + $("#ddlSMonth").get(0).value;
            

            //22:거래처별채권, 23:거래처별채무,17:채권/채무현황,26:일보,33:월별채권증감내역,34:월별채무증감내역,19:경영자보고서,53:재고현황,54:창고별재고현황
            

            if((date.toString() > ChkDate && ( 1 == "53" || 1 == "54" ||1 == "55" || 1 == "1" || 1 == "17" || 
                                               1 == "22" || 1 == "23" || 1 == "33" || 1 == "34" || 1 == "64" ||
                                               1 == "30" || 1 == "59" || 1 == "19" || 1 == "26" || 1 == "29" ||
                                               1 == "56"  ) ) )
            //if(($("#ddlSYear").get(0).value + $("#ddlSMonth").get(0).value) > ChkDate)
            {
                
                    $("#frmSearch").get(0).action = fnSetUrlPath("/ECMain/CM/ES/SummaryChk.aspx","ec_req_sid");
                    strInvenCloseChk = "Y";
                    if ("1" == "19" || ("1" == "26" && ($("#cbSelCode6").get(0).checked || $("#cbSelCode7").get(0).checked))){
                        if(fnNodeCheck(strXml, "hidSummaryFlag"))
                            strXml = fnXmlNodeChange(strXml, "hidSummaryFlag", "");
                        else
                            strXml = fnXmlSingleNodeAdd(strXml, "root", "hidSummaryFlag", "");
                        $("#frmSearch").get(0).hidSearchXml.value = strXml;

                        $("#hidAccCloseCheckDate").val(getCheckDate($("#ddlSYear"),$("#ddlSMonth"), ToMonth));
                    }
                
            }

            if (strInvenCloseChk != "Y"){
                // 경영자보고서,일보일 경우 회계 월마감 체크
                if("1" == "19" || ("1" == "26" && ($("#cbSelCode6").get(0).checked || $("#cbSelCode7").get(0).checked)))
                {
//                    var strYear = $("#ddlSYear").get(0).value;
//                    var strMonth = $("#ddlSMonth").get(0).value;
//                    var strCheckDateAcc = Math.min(fnChkAcc_DataGet("ACC","0"),fnChkAcc_DataGet("ACC","15")).toString();
//                    
//                    if(strYear >= strCheckDateAcc.substring(0,4))
//                    {
//                        if((strYear > strCheckDateAcc.substring(0,4)))
//                        {
//                            strChkFlag = "Y";
//                        }
//                        else
//                        {                
//                            if(strMonth > strCheckDateAcc.substring(4,6))
//                            {
//                                strChkFlag = "Y";
//                            }
//                            else if(strMonth == strCheckDateAcc.substring(4,6))
//                            {
//                                strChkFlag = "Y";                    
//                            }
//                        }
//                    }   

                    var date3 = getCheckDate($("#ddlSYear"),$("#ddlSMonth"), ToMonth );
                    var strCheckDateAcc = Math.min(fnChkAcc_DataGet("ACC","0"),fnChkAcc_DataGet("ACC","15")).toString();

                    if( date3.toString() >= strCheckDateAcc.substring(0,6))
                        strChkFlag = "Y";

                    if (strChkFlag == "Y")
                    {
                        if(fnNodeCheck(strXml, "hidSummaryFlag"))
                            strXml = fnXmlNodeChange(strXml, "hidSummaryFlag", "");
                        else
                            strXml = fnXmlSingleNodeAdd(strXml, "root", "hidSummaryFlag", "");
                        $("#frmSearch").get(0).hidSearchXml.value = strXml;
                        $("#frmSearch").get(0).action = fnSetUrlPath("/ECMain/CM/EB/SummaryChkAcc.aspx","ec_req_sid");
                    }
                }
            }

            if(date.toString() > ChkDate &&  "1" == "800")
            {
                var iSyymm = Number("");
                var iEyymm = Number("");
                var strSyymm = "";
                var strEyymm = "";
                var strSaleDate = "20120101";//재고수정일자
                var iStockDate = Number("20120101");//재고편집제한일자
                var strSettingYYmm = "200603";
                //미래전표가 있을 경우
                if (iSyymm > iEyymm) {
                    strSyymm = "";
                    strEyymm = "";
                }
                if(Number(strSettingYYmm) > iSyymm)
                {
                     alert("회사설립일자 부터 재집계를 할 수 있습니다. ");
                     $("#hfButtonCnt").get(0).value="0";
                    return false;
                }    
                if(iStockDate > ChkDate){
                    alert("재고 I > 출력물 > 잔량재집계에서 재집계 후 다시 시도 바랍니다. ");
                     $("#hfButtonCnt").get(0).value="0";
                    return false;
                }
                var strData = "Syymm=" + strSyymm + "&Eyymm=" + strEyymm + "&SaleDate=" + strSaleDate;
                fnGetDataSummary("/ECMain/CM/ES/SummaryChk_Data.aspx", strData);
            }
        
         if("1" == "800") {
         //편집제한일자 체크
          var yy = $("select[name=ddlSYear] option:selected").val(); 
            var mm = $("select[name=ddlSMonth] option:selected").val(); 
            var dd = $("#txtSDay").get(0).value.trim();
            if(dd.length <2)
            {
                $("#txtSDay").get(0).value = "0" + $("#txtSDay").get(0).value;
                dd = $("#txtSDay").get(0).value;
            } 
            if (dd == "") {
                alert("날짜를 입력 바랍니다.");
                $("#txtSDay").get(0).focus();

                if($("#txtSDay_basic").get(0) != undefined)
                    $("#txtSDay_basic").get(0).focus();

                $("#hfButtonCnt").get(0).value="0";
                return false;
            }
            if (checkDate(yy,mm,dd) == -1) {
                alert("일자를 정확하게 입력 바랍니다.");
                try{$("#txtSDay").get(0).focus();}catch(e){}
                try{
                    if($("#txtSDay_basic").get(0) != undefined)
                        $("#txtSDay_basic").get(0).focus();
                }catch(e){}
                $("#hfButtonCnt").get(0).value="0";
                return false;
             }
            time1=yy+mm+dd;
            if((20120101) > (time1)){
                alert("편집제한일자 이전 전표는 변경할 수 없습니다.\n\n재고 I > 출력물 > 잔량재집계 > 편집제한일자를 확인 바랍니다.");
                    $("#hfButtonCnt").get(0).value="0";
                return false;
            }
			//Physical Inventory Adjustment Hidden Search Field
            if(""=="Y") {
            var node= document.getElementById("frmSearch");


            var hidAdj2_Flag= document.createElement("input");
            hidAdj2_Flag.setAttribute("type", "hidden");
            hidAdj2_Flag.setAttribute("name", "strAdj2_Flag");
            hidAdj2_Flag.setAttribute("id", "strAdj2_Flag");
            hidAdj2_Flag.value= '';

            node.appendChild(hidAdj2_Flag);
            }
        }

        if(("1" == "49"  || "1" == "50" ||"1" == "80" || "1" == "81") && gubun == 4)
        {
            
                $("#frmSearch").get(0).action = fnSetUrlPath("/ECMain/ESD/ESD008M_02.aspx","ec_req_sid");
                $("#hfButtonCnt").get(0).value = "0";
                //$("#frmSearch").get(0).action = "/product/etc/state_trans_multi2.asp";
           
        }

//        if("1" == "2" || "1" == "53"){//판매현황 or 재고현황일 경우
//            if(($("#txtSProdCd_basic").length > 0 && $("#txtSProdCd_basic").get(0).value.substr($("#txtSProdCd_basic").get(0).value.length-1,1) == "*") || $("#txtSProdCd").get(0).value.substr($("#txtSProdCd").get(0).value.length-1,1) == "*"){
//                var prod_cd = $("#txtSProdCd").get(0).value;
//                if($("#txtSProdCd_basic").length > 0 && $("#txtSProdCd_basic").get(0).value.substr($("#txtSProdCd_basic").get(0).value.length-1,1) == "*"){
//                    prod_cd = $("#txtSProdCd_basic").get(0).value;
//                }
//                var strData = "Type=USECNT&UseCntType=REPORTS&MenuCd=SALE_1&MenuDes=" + encodeURIComponent(prod_cd);
//                fnGetDataSummary("/ECMain/ECP/ECP051M_DATA.aspx", strData);
//            }
//        }

        $("#frmSearch").get(0).submit();
        LoadProgressbar.show();
    }
    
}

//전월/전전월 데이타 구하기
function getCheckDate(objYear, objMonth, objInt) {    
    var checkDate;
    var checkYear = objYear.get(0).value;
    var checkMonth = objMonth.get(0).value;
    
    //선택한 월이 계산되는 월보다 작거나 같을때
    if(Number(checkMonth) <= Math.abs(objInt)) {
        var _i = Number(Math.abs(objInt) - checkMonth); //차이를 구한다

        checkYear = Number(checkYear) - 1; // 선택된 년도의 전년도를 구한다.
        checkDate = String(checkYear) + String(12 - _i) //12월에서 해당차이를 뺀다
    }
    else
    {
        checkDate = objYear.get(0).value + objMonth.get(0).value;
        checkDate = Number(checkDate) + Number(objInt);
    }
    return String(checkDate);
}

function fnWorkTaget(type)
{
    if($("#ddlWorkTarget" + type).get(0) != null)
    {
        var selectTaget = $("#ddlWorkTarget" + type).get(0).value;
        $("#trCustCd").get(0).style.display = "";
        $("#trTreeCustCd").get(0).style.display = "";
        $("#trProdCd").get(0).style.display = "";
        $("#trTreeGroupCd").get(0).style.display = "";
        $("#trWhCd").get(0).style.display = "";
        $("#trTreeWhCd").get(0).style.display = "";
        $("#trPjtDes").get(0).style.display = "";
        $("#trEmpCd").get(0).style.display = "";
        $("#trAmt").get(0).style.display = "";

        if( $("#trCustCd_basic").get(0) != undefined) $("#trCustCd_basic").get(0).style.display = "";
        if( $("#trTreeCustCd_basic").get(0) != undefined) $("#trTreeCustCd_basic").get(0).style.display = "";
        if( $("#trProdCd_basic").get(0) != undefined) $("#trProdCd_basic").get(0).style.display = "";
        if( $("#trTreeGroupCd_basic").get(0) != undefined) $("#trTreeGroupCd_basic").get(0).style.display = "";
        if( $("#trWhCd_basic").get(0) != undefined) $("#trWhCd_basic").get(0).style.display = "";
        if( $("#trTreeWhCd_basic").get(0) != undefined) $("#trTreeWhCd_basic").get(0).style.display = "";
        if( $("#trPjtDes_basic").get(0) != undefined) $("#trPjtDes_basic").get(0).style.display = "";
        if( $("#trEmpCd_basic").get(0) != undefined) $("#trEmpCd_basic").get(0).style.display = "";
        if( $("#trAmt_basic").get(0) != undefined) $("#trAmt_basic").get(0).style.display = "";

        switch(selectTaget)
        {
            //  01 견적서  02 주문서  03 판매  04 출하지시서  05 출하  06 발주요청  07 발주계획  08 발주서  09 구매
            //  10 A/S 접수 11 A/S 수리 12 작업지시서 13 거래처 14 품목 31 창고이동 32 생산불출 42 생산입고 II 44 생산입고 III 43 생산입고 I
            //  51 불량처리 58 재고조정 59 자가사용 71 재고실사
            //  25 BOM 이력
            case "13" :
                $("#trProdCd").get(0).style.display = "none";
                $("#trTreeGroupCd").get(0).style.display = "none";
                $("#trWhCd").get(0).style.display = "none";
                $("#trTreeWhCd").get(0).style.display = "none";
                $("#trPjtDes").get(0).style.display = "none";
                $("#trEmpCd").get(0).style.display = "none";
                $("#trAmt").get(0).style.display = "none";

                if( $("#trProdCd_basic").get(0) != undefined) $("#trProdCd_basic").get(0).style.display = "none";
                if( $("#trTreeGroupCd_basic").get(0) != undefined) $("#trTreeGroupCd_basic").get(0).style.display = "none";
                if( $("#trWhCd_basic").get(0) != undefined) $("#trWhCd_basic").get(0).style.display = "none";
                if( $("#trTreeWhCd_basic").get(0) != undefined) $("#trTreeWhCd_basic").get(0).style.display = "none";
                if( $("#trPjtDes_basic").get(0) != undefined) $("#trPjtDes_basic").get(0).style.display = "none";
                if( $("#trEmpCd_basic").get(0) != undefined) $("#trEmpCd_basic").get(0).style.display = "none";
                if( $("#trAmt_basic").get(0) != undefined) $("#trAmt_basic").get(0).style.display = "none";
            break;
            case "14" :
                $("#trCustCd").get(0).style.display = "none";
                $("#trTreeCustCd").get(0).style.display = "none";
                $("#trWhCd").get(0).style.display = "none";
                $("#trTreeWhCd").get(0).style.display = "none";
                $("#trPjtDes").get(0).style.display = "none";
                $("#trEmpCd").get(0).style.display = "none";
                $("#trAmt").get(0).style.display = "none";

                if( $("#trCustCd_basic").get(0) != undefined) $("#trCustCd_basic").get(0).style.display = "none";
                if( $("#trTreeCustCd_basic").get(0) != undefined) $("#trTreeCustCd_basic").get(0).style.display = "none";
                if( $("#trWhCd_basic").get(0) != undefined) $("#trWhCd_basic").get(0).style.display = "none";
                if( $("#trTreeWhCd_basic").get(0) != undefined) $("#trTreeWhCd_basic").get(0).style.display = "none";
                if( $("#trPjtDes_basic").get(0) != undefined) $("#trPjtDes_basic").get(0).style.display = "none";
                if( $("#trEmpCd_basic").get(0) != undefined) $("#trEmpCd_basic").get(0).style.display = "none";
                if( $("#trAmt_basic").get(0) != undefined) $("#trAmt_basic").get(0).style.display = "none";
            break;
            case "12" :
                $("#trWhCd").get(0).style.display = "none";
                $("#trTreeWhCd").get(0).style.display = "none";
                $("#trAmt").get(0).style.display = "none";

                if( $("#trWhCd_basic").get(0) != undefined) $("#trWhCd_basic").get(0).style.display = "none";
                if( $("#trTreeWhCd_basic").get(0) != undefined) $("#trTreeWhCd_basic").get(0).style.display = "none";
                if( $("#trAmt_basic").get(0) != undefined) $("#trAmt_basic").get(0).style.display = "none";
            break;
            case "32" :
                $("#trCustCd").get(0).style.display = "none";
                $("#trTreeCustCd").get(0).style.display = "none";
                $("#trAmt").get(0).style.display = "none";

                if( $("#trCustCd_basic").get(0) != undefined) $("#trCustCd_basic").get(0).style.display = "none";
                if( $("#trTreeCustCd_basic").get(0) != undefined) $("#trTreeCustCd_basic").get(0).style.display = "none";
                if( $("#trAmt_basic").get(0) != undefined) $("#trAmt_basic").get(0).style.display = "none";
            break;
            case "43" :
                $("#trCustCd").get(0).style.display = "none";
                $("#trTreeCustCd").get(0).style.display = "none";

                if( $("#trCustCd_basic").get(0) != undefined) $("#trCustCd_basic").get(0).style.display = "none";
                if( $("#trTreeCustCd_basic").get(0) != undefined) $("#trTreeCustCd_basic").get(0).style.display = "none";
            break;
            case "42" :
                $("#trCustCd").get(0).style.display = "none";
                $("#trTreeCustCd").get(0).style.display = "none";

                if( $("#trCustCd_basic").get(0) != undefined) $("#trCustCd_basic").get(0).style.display = "none";
                if( $("#trTreeCustCd_basic").get(0) != undefined) $("#trTreeCustCd_basic").get(0).style.display = "none";
            break;
            case "44" :
                $("#trCustCd").get(0).style.display = "none";
                $("#trTreeCustCd").get(0).style.display = "none";

                if( $("#trCustCd_basic").get(0) != undefined) $("#trCustCd_basic").get(0).style.display = "none";
                if( $("#trTreeCustCd_basic").get(0) != undefined) $("#trTreeCustCd_basic").get(0).style.display = "none";
            break;
            case "31" :
                $("#trCustCd").get(0).style.display = "none";
                $("#trTreeCustCd").get(0).style.display = "none";
                $("#trAmt").get(0).style.display = "none";

                if( $("#trCustCd_basic").get(0) != undefined) $("#trCustCd_basic").get(0).style.display = "none";
                if( $("#trTreeCustCd_basic").get(0) != undefined) $("#trTreeCustCd_basic").get(0).style.display = "none";
                if( $("#trAmt_basic").get(0) != undefined) $("#trAmt_basic").get(0).style.display = "none";
            break;
            case "59" :
                $("#trAmt").get(0).style.display = "none";

                if( $("#trAmt_basic").get(0) != undefined) $("#trAmt_basic").get(0).style.display = "none";
            break;
            case "51" :
                $("#trCustCd").get(0).style.display = "none";
                $("#trTreeCustCd").get(0).style.display = "none";
                $("#trAmt").get(0).style.display = "none";

                if( $("#trCustCd_basic").get(0) != undefined) $("#trCustCd_basic").get(0).style.display = "none";
                if( $("#trTreeCustCd_basic").get(0) != undefined) $("#trTreeCustCd_basic").get(0).style.display = "none";
                if( $("#trAmt_basic").get(0) != undefined) $("#trAmt_basic").get(0).style.display = "none";
            break;
            case "71" :
                $("#trCustCd").get(0).style.display = "none";
                $("#trTreeCustCd").get(0).style.display = "none";
                $("#trPjtDes").get(0).style.display = "none";
                $("#trAmt").get(0).style.display = "none";

                if( $("#trCustCd_basic").get(0) != undefined) $("#trCustCd_basic").get(0).style.display = "none";
                if( $("#trTreeCustCd_basic").get(0) != undefined) $("#trTreeCustCd_basic").get(0).style.display = "none";
                if( $("#trPjtDes_basic").get(0) != undefined) $("#trPjtDes_basic").get(0).style.display = "none";
                if( $("#trAmt_basic").get(0) != undefined) $("#trAmt_basic").get(0).style.display = "none";
            break;
            case "58" :
            case "60" :
                $("#trCustCd").get(0).style.display = "none";
                $("#trTreeCustCd").get(0).style.display = "none";
                $("#trPjtDes").get(0).style.display = "none";
                $("#trAmt").get(0).style.display = "none";

                if( $("#trCustCd_basic").get(0) != undefined) $("#trCustCd_basic").get(0).style.display = "none";
                if( $("#trTreeCustCd_basic").get(0) != undefined) $("#trTreeCustCd_basic").get(0).style.display = "none";
                if( $("#trPjtDes_basic").get(0) != undefined) $("#trPjtDes_basic").get(0).style.display = "none";
                if( $("#trAmt_basic").get(0) != undefined) $("#trAmt_basic").get(0).style.display = "none";
            break;
            case "10" :
                $("#trAmt").get(0).style.display = "none";

                if( $("#trAmt_basic").get(0) != undefined) $("#trAmt_basic").get(0).style.display = "none";
            break;
            case "11" :
                $("#trCustCd").get(0).style.display = "none";
                $("#trTreeCustCd").get(0).style.display = "none";
                $("#trWhCd").get(0).style.display = "none";
                $("#trTreeWhCd").get(0).style.display = "none";
                $("#trPjtDes").get(0).style.display = "none";
                $("#trAmt").get(0).style.display = "none";

                if( $("#trCustCd_basic").get(0) != undefined) $("#trCustCd_basic").get(0).style.display = "none";
                if( $("#trTreeCustCd_basic").get(0) != undefined) $("#trTreeCustCd_basic").get(0).style.display = "none";
                if( $("#trWhCd_basic").get(0) != undefined) $("#trWhCd_basic").get(0).style.display = "none";
                if( $("#trTreeWhCd_basic").get(0) != undefined) $("#trTreeWhCd_basic").get(0).style.display = "none";
                if( $("#trPjtDes_basic").get(0) != undefined) $("#trPjtDes_basic").get(0).style.display = "none";
                if( $("#trAmt_basic").get(0) != undefined) $("#trAmt_basic").get(0).style.display = "none";
            break;
            case "25":
                 $("#trCustCd").get(0).style.display = "none";
                $("#trTreeCustCd").get(0).style.display = "none";
                $("#trWhCd").get(0).style.display = "none";
                $("#trTreeWhCd").get(0).style.display = "none";
                $("#trPjtDes").get(0).style.display = "none";
                $("#trAmt").get(0).style.display = "none";
                $("#trEmpCd").get(0).style.display = "none";
                $("#trTreeGroupCd").get(0).style.display = "none";

                if( $("#trEmpCd_basic").get(0) != undefined) $("#trEmpCd_basic").get(0).style.display = "none";
                if( $("#trTreeGroupCd_basic").get(0) != undefined) $("#trTreeGroupCd_basic").get(0).style.display = "none";
                if( $("#trCustCd_basic").get(0) != undefined) $("#trCustCd_basic").get(0).style.display = "none";
                if( $("#trTreeCustCd_basic").get(0) != undefined) $("#trTreeCustCd_basic").get(0).style.display = "none";
                if( $("#trWhCd_basic").get(0) != undefined) $("#trWhCd_basic").get(0).style.display = "none";
                if( $("#trTreeWhCd_basic").get(0) != undefined) $("#trTreeWhCd_basic").get(0).style.display = "none";
                if( $("#trPjtDes_basic").get(0) != undefined) $("#trPjtDes_basic").get(0).style.display = "none";
                if( $("#trAmt_basic").get(0) != undefined) $("#trAmt_basic").get(0).style.display = "none";
            break;
            case "04":
            case "05":
                $("#trAmt").get(0).style.display = "none";
                if( $("#trAmt_basic").get(0) != undefined) $("#trAmt_basic").get(0).style.display = "none";
            break;
        }
    }
}

function frmactionValueSetting(frm)
{
    var SumGubun = $("input:radio[name=rbSumGubun]:checked");
    switch(1)
    {
        case 1 :
            if(SumGubun.get(0).value == "0" && $("#ddlFormSer").get(0).value != "99999")
                frm.action = fnSetUrlPath("/ECMain/ESZ/ESZ017R.aspx", "ec_req_sid");
            else if(SumGubun.get(0).value == "1")
                frm.action = fnSetUrlPath("/ECMain/ESZ/ESZ009R.aspx", "ec_req_sid");
            else if(SumGubun.get(0).value == "2")
                frm.action = fnSetUrlPath("/ECMain/ESZ/ESZ010R.aspx", "ec_req_sid");
            break;

        case 2: case 3:
            if(SumGubun.get(0).value != "4")
                frm.action = fnSetUrlPath("/ECMain/ESG/ESG011R.aspx", "ec_req_sid");
            break;

        case 4:
            if($("#ddlFormSer").get(0).value == "99999")
                frm.action = fnSetUrlPath("/ECMain/ESJ/ESJ014R.aspx", "ec_req_sid"); 
            break;

        case 5: case 6:
            if($("#ddlFormSer").get(0).value != "99999")
            {
                if(SumGubun.get(0).value != "4")
                {
                    if (1 == 5)
                        frm.action = fnSetUrlPath("/ECMain/ESJ/ESJ028R.aspx", "ec_req_sid"); 
                    else
                        frm.action = fnSetUrlPath("/ECMain/ESJ/ESJ027R.aspx", "ec_req_sid");
                }
            }
            else if(SumGubun.get(0).value == "3")
            {
                if (1 == 5)
                    frm.action = fnSetUrlPath("/ECMain/ESJ/ESJ025R.aspx", "ec_req_sid"); 
                else
                    frm.action = fnSetUrlPath("/ECMain/ESJ/ESJ024R.aspx", "ec_req_sid"); 
            }
            break;

        case 11:
            if($("#ddlFormSer").get(0).value == "99999")
                frm.action = fnSetUrlPath("/ECMain/ESD/ESD011R.aspx", "ec_req_sid");
            break;

        case 12:
            if($("#ddlFormSer").get(0).value == "99999")
                frm.action = fnSetUrlPath("/ECMain/ESD/ESD012R.aspx", "ec_req_sid");
            break;

        case 13:
            if($("#ddlFormSer").get(0).value == "99999")
                frm.action = fnSetUrlPath("/ECMain/ESD/ESD015R.aspx", "ec_req_sid");
            break;

        case 14:
            if($("#ddlFormSer").get(0).value == "99999")
                frm.action = fnSetUrlPath("/ECMain/ESD/ESD017R.aspx", "ec_req_sid");
            break;

        case 15:
            if($("#ddlFormSer").get(0).value == "99999")
                frm.action = fnSetUrlPath("/ECMain/ESG/ESG015R.aspx", "ec_req_sid");
            break;

        case 16:
            if($("#ddlFormSer").get(0).value == "99999")
                frm.action = fnSetUrlPath("/ECMain/ESG/ESG012R.aspx", "ec_req_sid");
            break;

        case 21:
            if(SumGubun.get(0).value == "1" || SumGubun.get(0).value == "3")
                frm.action = fnSetUrlPath("/ECMain/ESS/ESS014R.aspx", "ec_req_sid");
            if(SumGubun.get(0).value == "2" || SumGubun.get(0).value == "4")
                frm.action = fnSetUrlPath("/ECMain/ESS/ESS015R.aspx", "ec_req_sid");
            break;

        case 22:
            if($("#ddlFormSer").get(0).value == "99999")
                frm.action = fnSetUrlPath("/ECMain/ESD/ESD019R.aspx", "ec_req_sid");
            break;

		case 23:
            if($("#ddlFormSer").get(0).value == "99999")
                frm.action = fnSetUrlPath("/ECMain/ESD/ESD019R.aspx", "ec_req_sid");
            break;

        case 25:
            if($("#ddlFormSer").get(0).value == "99999")
                frm.action = fnSetUrlPath("/ECMain/ESJ/ESJ018R.aspx", "ec_req_sid");
            break;

        case 30:
            if(SumGubun.get(0).value == "3")
                frm.action = fnSetUrlPath("/ECMain/ESJ/ESJ015R.aspx", "ec_req_sid");
            break;

        case 31:
            if(SumGubun.get(0).value == "1" || SumGubun.get(0).value == "3")
                frm.action = fnSetUrlPath("/ECMain/ESS/ESS010R.aspx", "ec_req_sid");
            if(SumGubun.get(0).value == "2" || SumGubun.get(0).value == "4")
                frm.action = fnSetUrlPath("/ECMain/ESS/ESS011R.aspx", "ec_req_sid");
            break;

        case 32:
            if(SumGubun.get(0).value == "0")
                frm.action = fnSetUrlPath("/ECMain/ESS/ESS006R.aspx", "ec_req_sid");
            else if(SumGubun.get(0).value == "1")
                frm.action = fnSetUrlPath("/ECMain/ESS/ESS007R.aspx", "ec_req_sid");
            else if(SumGubun.get(0).value == "2")
                frm.action = fnSetUrlPath("/ECMain/ESS/ESS008R.aspx", "ec_req_sid");
            else if(SumGubun.get(0).value == "3")
                frm.action = fnSetUrlPath("/ECMain/ESS/ESS009R.aspx", "ec_req_sid");
            else if(SumGubun.get(0).value == "7")
                frm.action = fnSetUrlPath("/ECMain/ESS/ESS021R.aspx", "ec_req_sid");
            else if(SumGubun.get(0).value == "8")
                frm.action = fnSetUrlPath("/ECMain/ESS/ESS022R.aspx", "ec_req_sid");
            else
                frm.action = fnSetUrlPath("/ECMain/ESS/ESS009R.aspx", "ec_req_sid");
            break;

        case 35:
            if($("#ddlFormSer").get(0).value == "99999")
                frm.action = fnSetUrlPath("/ECMain/ESJ/ESJ021R.aspx", "ec_req_sid");
            else
                frm.action = fnSetUrlPath("/ECMain/ESJ/ESJ030R.aspx", "ec_req_sid");
            break;

        case 54 : case 55 :
            if(SumGubun.get(0).value == "2")
                frm.action = fnSetUrlPath("/ECMain/ESZ/ESZ002R.aspx", "ec_req_sid");
            break;

        case 57:
            if($("#ddlFormSer").get(0).value == "99999")
                frm.action = fnSetUrlPath("/ECMain/ESJ/ESJ022R.aspx", "ec_req_sid");
            else
                frm.action = fnSetUrlPath("/ECMain/ESJ/ESJ031R.aspx", "ec_req_sid");
            break;

        case 58: //시리얼No재고수불부 
            if($("#ddlFormSer").get(0).value != "99999")
                frm.action = fnSetUrlPath("/ECMain/ESQ/ESQ206R.aspx", "ec_req_sid");
		    break;	

        case 59: //시리얼No재고현황
            if($("#ddlFormSer").get(0).value != "99999")
                frm.action = fnSetUrlPath("/ECMain/ESQ/ESQ205R.aspx", "ec_req_sid");
            break;

        case 65:
            if($("#ddlFormSer").get(0).value == "99999")
                frm.action = fnSetUrlPath("/ECMain/ESG/ESG020R.aspx", "ec_req_sid");
            break;

        case 79:    // 미출하현황-출력물
            if($("#ddlFormSer").get(0).value == "99999")
                frm.action = fnSetUrlPath("/ECMain/ESE/ESE007R.aspx", "ec_req_sid");
            break;
		case 791:    // Expenses Status Report
            if($("#ddlFormSer").get(0).value == "99999")
                frm.action = fnSetUrlPath("/ECMain/EBO/EBO007R.aspx", "ec_req_sid");
            break;

        case 811: //Serial No. Status
            if($("#ddlFormSer").get(0).value != "99999")
                frm.action = fnSetUrlPath("/ECMain/ESQ/ESQ207R.aspx", "ec_req_sid");
		    break;
        case 812: //시리얼/로트No.이력조회
                frm.action = fnSetUrlPath("/ECMain/ESQ/ESQ208M.aspx", "ec_req_sid");
		    break;	
    }
}
//다음필드로 넘기기
function fnEnterHandles1(field, event, gubun, schfield, group) { //gubun 1: next, 2:return nextname
    var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
    if ($("#hidLastField"+$("#hidTabGubun").get(0).value).get(0).value == schfield)
    {
        return "btnSearch";
    }
	else
	{
        if("SM623" != "SM760" && (keyCode == 13 || gubun == "2"))
	    {
		    if($("#hidTabGubun").get(0).value == "1")
		    {
			    if($("#hidLastFieldGroup1").get(0).value != "")
			    {
				    //txtSWhCd|0,txtSCustCd|1,txtSProdCd|0
				    var groupBasicDisplayVals = $("#hidGroupBasicDisplay").val();
				    var arrGroupBasicDisplay = groupBasicDisplayVals.split(",");
				    var groupBasicDisplayCnt = arrGroupBasicDisplay.length;
				    var arrGDValue = "";
				    var fieldName = field.name.split("_");
				    var CheckFieldName = $("#hidLastFieldGroup1").get(0).value;

				    if( groupBasicDisplayVals != "")
				    {
					    for(var i = 0 ; i < groupBasicDisplayCnt ; i++)
					    {
						    arrGDValue = arrGroupBasicDisplay[i].split("|");
						    if( fieldName[0] == CheckFieldName && fieldName[0] == arrGDValue[0] && arrGDValue[1] == 0)
						    {
                                if(gubun == "1")
                                {
							        $("#btnSearch").focus();
                                    return;
                                }
                                else
							        return "btnSearch";
						    }
					    }
				    }
				    else
				    {
                        if( fieldName[0] == CheckFieldName)
					    {
						    if(gubun == "1")
                            {
							    $("#btnSearch").focus();
                                return;
                            }
                            else
							    return "btnSearch";
					    }
				    }
			    }
            }
	    }
	}

    var next = 0;
    if (keyCode == 13 || gubun == "2" ) {
        var iField;

        for (iField = 0; iField < field.form.elements.length; iField++) {
            if (field == field.form.elements[iField])
                break;
        }

        iField = (iField + 1) % field.form.elements.length;

        while (true) {
            if (field.form.elements[iField] != undefined) {
                tag = field.form.elements[iField].tagName.toLowerCase();
                
                if ((field.form.elements[iField].type == "text" || field.form.elements[iField].type == "textarea" || tag == "select" || field.form.elements[iField].type == "checkbox" || field.form.elements[iField].type == "radio" || field.form.elements[iField].type == "label" ) && field.form.elements[iField].readOnly != true &&  field.form.elements[iField].style.visibility == "" && field.form.elements[iField].disabled != true && $("#" + field.form.elements[iField].id).parent().parent().parent().css("display") != "none" && $("#" + field.form.elements[iField].id).parent().parent().css("display") != "none" && $("#" + field.form.elements[iField].id).parent().css("display") != "none") {
                    if (gubun == "1")
                        field.form.elements[iField].focus();
                    else
                        return field.form.elements[iField].id;

                    next = 1;
                    break;
                }
                else {
                    iField++;
                    continue;
                }
            }
            else {
                break;
            }
        }

        return next;

    }
    
}

function fn_getMul() {

    var strReVal;
    switch("1") {
        case "2": 
        case "3":
        case "9"://미청구현황(판매)
        case "11": 
        case "12": 
        case "13": 
        case "14": 
        case "15": 
        case "16": 
        case "17": //채권/채무현황
        case "18": //자가사용현황
        case "21": //이익현황
        case "22": 
        case "23":  
        case "25": //작업지시서
        case "30": //작업지시서별 진행현황
        case "31": // 품목/거래처별이익현황
        case "33": //월별채권증감내역
        case "34": //월별 채무 증감내역
        case "41": 
        case "42": //주문집계표 
        case "43": 
        case "48": 
        case "52": //구매할인명세
        case "68": //외주비할인명세
        case "72": //미청구현황(구매)
        case "210"://Service Hour List 
        case "212"://Service Hour List
        case "811"://Serial No. Status
		case "791"://Business Expenses Status
            strReVal = "Y";
            break;
        default :
            strReVal = "N";
            break;
    }
    
    return strReVal;
}

//품목코드 검색창 다중선택 여부
function fn_GetValue() {
    var strReVal;
    switch("1") {
        case "1" :
        case "2":
        case "3":
        case "4":  //창고이동현황
        case "5": //생산입고현황
        case "6": //생산불출현황
        case "7": //재고조정현황
        case "9": //미청구현황(판매)
        case "11":
        case "12": 
        case "13": 
        case "14": 
        case "15": 
        case "16": 
        case "17" :
        case "18" : //자가사용현황
        case "21" : //이익현황
        case "22" :
        case "23" :
        case "25": //작업지시서
        case "27": //재고실사현황
        case "30": //작업지시서별 진행현황
        case "26":
        case "29": //선입선출재고현황
        case "31": // 품목/거래처별이익현황
        case "32": //재고별원가계산현황
        case "33":
        case "34":
        case "35": //생산 입고/소모 현황1
        case "41": //이익현황 주석처리 판매기준 상품일때 
        case "42": //주문집계표 
        case "43": 
        case "44": //불량현황
        case "45": //대체 사용리스트 
        case "46": //페기리스트 
        case "48": 
        case "51":
        case "52": //구매할인금액명세
        case "68": //외주비할인금액명세
        case "53":
        case "54":
        case "55":
        case "56":
        case "57": //생산/입고소모현황2
        case "58": //시리얼넘버 재고수불부
        case "59": //시리얼넘버 재고현황
        case "64":
        case "210": //Service Hour List 
        case "211": //Collective Invoicing (Service)
        case "212": //Service Hour List
		case "214": //Collective Invoicing (Business Trip)
        case "70": //품목원가현황
        case "71": 
        case "72": //미청구현황(구매)
        case "725": //시리얼넘버 재고조정
        case "811": //Serial No. Status
		case "791": //Business Trip Expenses Status
        
            strReVal = "Y";
            break;
        default :
            strReVal = "N";
            break;
    }
    
    return strReVal;
}
function fn_GetValuePjt() //프로젝트 검색창 다중선택 여부
{
    var strReVal;
    //Service Hour Status = 212 need to be multi selected
   
   strReVal = "Y";
   
    
    return strReVal;
}

function fn_GetValueChargeID() //담당(ERP) 검색창 다중선택 여부
{
    var strReVal;
    
   
   strReVal = "N";
   
    
    return strReVal;
}

function search_code(gubun,pos,key_gubun,key_type, th, ev) {
    var objth = $("#"+th).get(0);
    var strparam = "";
    var strMergeFlag = fn_GetValue();
    var strMul = fn_getMul();
    var CustWidth ="500";
    switch(gubun)
    {
        case 1 :
        objName = $("#txtSCustDes");
        objCode = $("#txtSCustCd");
        objName_basic = $("#txtSCustDes_basic");
        objCode_basic = $("#txtSCustCd_basic");
        if("1"=="210")
            strMul="N";
        if(th.indexOf("_basic") > -1) strKey = objCode_basic.get(0).value;
        else strKey = objCode.get(0).value;

        if ((objCode.get(0).value!="" || (objCode_basic.get(0)!=undefined && objCode_basic.get(0).value!="")) || key_type=="double"){
            if (sub_prod(strKey)==false){
                if( key_type!="double" ){
                    objName.get(0).value = "";
                    objCode.get(0).value = "";
                    
                    if(objCode_basic.get(0) != undefined)
                    {
                        objName_basic.get(0).value = "";
                        objCode_basic.get(0).value = "";
                    }
                }else
                    strKey = "";
                    if(strMul =="Y") CustWidth=Number(CustWidth)+6; // 다중선택되면 칸이 하나 생겨서 좌우 스크롤이 생김 
                //fnGetData("Type=CUSTCM&CallType=102&GYECODE=&empflag=N&SPGubunFlag=3&strCallFlag=O&KeyWord="+encodeURIComponent(strKey)+"&strMultiFlag="+strMul, "../CM/CM022P.aspx", "거래처검색", CustWidth, "500", "Y", "../CM/ES/ES_CM_DATA.aspx", "#"+fnEnterHandles1(objth,ev,"2","txtSCustCd",""));
                fnGetData("Type=CUSTCM&CallType=102&GYECODE=&empflag=N&SPGubunFlag=3&strCallFlag=O&KeyWord="+encodeURIComponent(strKey)+"&strMultiFlag="+strMul, "/ECMain/CM/CM022P.aspx", "거래처검색", CustWidth, "500", "Y", "/ECMain/CM/ES/ES_CM_DATA.aspx", "#"+fnEnterHandles1(objth,ev,"2","txtSCustCd",""));
                
            }     
        }else{
            if (sub_prod(strKey)==false){   
                objName.get(0).value = "";
                objCode.get(0).value = "";
                
                if(objCode_basic.get(0) != undefined)
                {
                    objName_basic.get(0).value = "";
                    objCode_basic.get(0).value = "";
                }
            }
        }
        break;
        case 2 :
        objName = $("#txtPjtDes");
        objCode = $("#txtPjtCd");
        objName_basic = $("#txtPjtDes_basic");
        objCode_basic = $("#txtPjtCd_basic");
        
        if(th.indexOf("_basic") > -1) strKey = objCode_basic.get(0).value;
        else strKey = objCode.get(0).value;

        if ((objCode.get(0).value!="" || (objCode_basic.get(0)!=undefined && objCode_basic.get(0).value!="")) || key_type=="double"){
            if( key_type!="double" ){
                objName.get(0).value = "";
                objCode.get(0).value = "";
                
                if(objCode_basic.get(0) != undefined)
                {
                    objName_basic.get(0).value = "";
                    objCode_basic.get(0).value = "";
                }
            }else
                strKey = "";
                
            if("1" == "22" || "1" == "23" || "1" == "17")
                fnGetData("Type=SITEPJTCM&KeyWord="+encodeURIComponent(strKey)+"&MergeFlag="+fn_GetValuePjt()+"&ChkFlag=T", "/ECMain/CM/ES/ES007P.aspx", "프로젝트검색", "450", "500", '', "/ECMain/CM/ES/ES_CM_DATA.aspx", "#"+fnEnterHandles1(objth,ev,'2','txtPjtCd',""));
            else
                fnGetData("Type=SITEPJTCM&KeyWord="+encodeURIComponent(strKey)+"&MergeFlag="+fn_GetValuePjt()+"&ChkFlag=S", "/ECMain/CM/ES/ES007P.aspx", "프로젝트검색", "450", "500", '', "/ECMain/CM/ES/ES_CM_DATA.aspx", "#"+fnEnterHandles1(objth,ev,'2','txtPjtCd',""));
        }else{
            objName.get(0).value = "";
            objCode.get(0).value = "";
            
            if(objCode_basic.get(0) != undefined)
            {
                objName_basic.get(0).value = "";
                objCode_basic.get(0).value = "";
            }
        }
        break;
        case 3 :
        break;
        case 4 :
           var mFlag = "Y";
            
            var hidSearchData = "Z;wh_cd;3;"+mFlag+";;;;;0;N;Y;;;";
            
            if ("1" == "67" || "1" == "82")
            {
                hidSearchData = "Z;wh_cd;4;"+mFlag+";;;;;0;N;Y;;;";
            }

            if ("1" == "600")
            {
                if ("F" == "F")
                {
                   if (key_gubun == "F")
                    hidSearchData = "Z;wh_cd;3;"+mFlag+";;;;;0;N;Y;;;";
                    else
                    hidSearchData = "Z;wh_cd;3;"+mFlag+";;;;;0;N;Y;;;";
                }
                else
                {
                    if (key_gubun == "F")
                    hidSearchData = "Z;wh_cd;3;"+mFlag+";;;;;0;N;Y;;;";
                    else
                    hidSearchData = "Z;wh_cd;3;"+mFlag+";;;;;0;N;Y;;;";
                }
            }
        if(1 == "4" || (1 == "5" && key_gubun == "T")|| (1 == "6" && key_gubun == "F"))
            var hidSearchData = "Z;Swh_cd;;"+mFlag+";;;;;1;N;Y;;"
        else if((1 == "5" && key_gubun == "F") || (1 == "6" && key_gubun == "T") )
            var hidSearchData = "Z;Swh_cd;1;"+mFlag+";;;;;1;N;Y;;"
        var reForms = "1";
        if (reForms == "420" && key_gubun == "F")
            hidSearchData = ";outplant;1;"+mFlag+";;;GUEST;;;N;0;42;F";
        else if ((reForms == "54" || reForms == "55") && key_gubun == "F")    
        {
            var ioType = "42";

            if (reForms == "54")
                ioType = reForms;

            
            hidSearchData = ";inplant;;Y;;;GUEST;;0;N;Y;" + ioType + ";F";
            
        }
        else if (reForms == "800" && key_gubun == "F")    
        {
            var ioType = "42";

            if ($("input:radio[name=rbSumGubun]:checked").get(0).value =="1")
            {
                ioType = reForms;
                mFlag ="Y";
            }
            else{
                mFlag ="N";
            }
                
            
            hidSearchData = ";inplant;;"+mFlag+";;;GUEST;;0;N;Y;" + ioType + ";F";
            
        }
        else if (reForms == "420" && key_gubun == "T")    
            hidSearchData = ";inplant;;"+mFlag+";;;GUEST;;;N;0;42;T";
        else if (reForms == "25")    
            hidSearchData = "Z;wh_cd;1;"+mFlag+";;;;;0;N;Y;;;"
        if(key_gubun == "F")
        {
            objName = $("#txtSWhDes");
            objCode = $("#txtSWhCd");
            objName_basic = $("#txtSWhDes_basic");
            objCode_basic = $("#txtSWhCd_basic");
        }else{
            objName = $("#txtEWhDes");
            objCode = $("#txtEWhCd");
            objName_basic = $("#txtEWhDes_basic");
            objCode_basic = $("#txtEWhCd_basic");
        }
        var nfield = "txtSWhCd";
        

        if(th.indexOf("_basic") > -1) strKey = objCode_basic.get(0).value;
        else strKey = objCode.get(0).value;
            
        if ((objCode.get(0).value!="" || (objCode_basic.get(0)!=undefined && objCode_basic.get(0).value!="")) || key_type=="double"){
            if( key_type!="double" ){
                objName.get(0).value = "";
                objCode.get(0).value = "";
                
                if(objCode_basic.get(0) != undefined)
                {
                    objName_basic.get(0).value = "";
                    objCode_basic.get(0).value = "";
                }
            }else
                strKey = "";               
            fnGetData("Type=WHCD&KeyWord="+encodeURIComponent(strKey)+"&hidSearchData="+encodeURIComponent(hidSearchData), "/ECMain/CM/ES/ES008P.aspx", "창고검색", "450", "500", "", "/ECMain/CM/ES/ES_CM_DATA.aspx", "#"+fnEnterHandles1(objth,ev,"2", nfield, ""));
        }else{
            objName.get(0).value = "";
            objCode.get(0).value = "";            
            
            if(objCode_basic.get(0) != undefined)
            {
                objName_basic.get(0).value = "";
                objCode_basic.get(0).value = "";
            }
            SetCheckBoxMoveStore();
        }
        break;
        case 5 :   //관리항목 검색
        var strMultiFlag = "N";
        var strRptGubun = "1";    

        if (strRptGubun != "")
        {
            if( strRptGubun == "1" || // 재고수불부
                strRptGubun == "2" || // 판매현황
                strRptGubun == "3" || // 구매현황
                strRptGubun == "4" || // 창고이동현황
                strRptGubun == "5" || // 생산입고현황
                strRptGubun == "6" || // 생산불출현황
                strRptGubun == "7" || // 재고조정현황
                strRptGubun == "9" || // 미청구현황
                strRptGubun == "11" || // 견적서제출현황
                strRptGubun == "12" || // 판매주문서현황
                strRptGubun == "13" || // 미주문현황
                strRptGubun == "14" || // 미출고현황
                strRptGubun == "15" || // 미입고현황
                strRptGubun == "16" || // 발주서현황
                strRptGubun == "18" || // 자가사용현황
                strRptGubun == "21" || // 이익현황
                strRptGubun == "25" || // 작업지시서현황
                strRptGubun == "26" || // 일보
                strRptGubun == "27" || // 재고실사현황
                strRptGubun == "30" || // 작업지시서별진행현황
                strRptGubun == "31" || // 품목/거래처별이익현황
                strRptGubun == "41" || // 집계표
                strRptGubun == "44" || // 불량현황
                strRptGubun == "45" || // 대체사용리스트
                strRptGubun == "46" || // 폐기리스트
                strRptGubun == "47" || // 불량률 파악보고서
                strRptGubun == "48" || // 거래명세서출력
                strRptGubun == "51" || // 판매할인금액명세
                strRptGubun == "52" || // 구매한일금액명세
                strRptGubun == "68" || // 외주비한일금액명세
                strRptGubun == "53" || // 재고현황
                strRptGubun == "54" || // 창고별재고현황
                strRptGubun == "55" || // 관리항목별재고현황
                strRptGubun == "56" || // 재고수불부2
                strRptGubun == "64" || // 재고변동추이
                strRptGubun == "65" || // 발주요청현황
                strRptGubun == "66" || // 매출계획현황
                strRptGubun == "72" ||  // 미청구현황(구매)
                (strRptGubun == "800" && $("input:radio[name=rbSumGubun_basic]:checked").get(0).value =="2" )  ||// 재고실사입력2
                strRptGubun == "811" //Serial No. Status
               )
            {	
                strMultiFlag = "Y";
            }            	
        }
        else 
        {
            strMultiFlag = "N";
        }

        objName = $("#txtItemDes");
        objCode = $("#txtItemCd");
        objName_basic = $("#txtItemDes_basic");
        objCode_basic = $("#txtItemCd_basic");
        
        if(th.indexOf("_basic") > -1) strKey = objCode_basic.get(0).value;
        else strKey = objCode.get(0).value;

        if ((objCode.get(0).value!="" || (objCode_basic.get(0)!=undefined && objCode_basic.get(0).value!="")) || key_type=="double"){
            if( key_type!="double" ){
                objName.get(0).value = "";
                objCode.get(0).value = "";
                
                if(objCode_basic.get(0) != undefined)
                {
                    objName_basic.get(0).value = "";
                    objCode_basic.get(0).value = "";
                    if(strRptGubun == "800")
                    {
                        $("#cbItemChk").get(0).checked = true;
                        $("#cbItemChk_basic").get(0).checked = true;
                    }
                }
            }else
                strKey = "";
                if (strRptGubun == "811")
                    fnGetData("Type=SALE009CM&InputFlag=N&CodeClass=&KeyWord="+encodeURIComponent(strKey)+"&strMultiFlag="+strMultiFlag+"&strRptGubun="+strRptGubun+"&MultiCount=20", "/ECMain/CM/CM003P.aspx", "관리항목검색", "450", "500", "SALE009CM", "/ECMain/CM/ES/ES_CM_DATA.aspx", "#"+fnEnterHandles1(objth,ev,"2","txtItemCd",""));
                else
            fnGetData("Type=SALE009CM&InputFlag=N&CodeClass=&KeyWord="+encodeURIComponent(strKey)+"&strMultiFlag="+strMultiFlag+"&strRptGubun="+strRptGubun, "/ECMain/CM/CM003P.aspx", "관리항목검색", "450", "500", "SALE009CM", "/ECMain/CM/ES/ES_CM_DATA.aspx", "#"+fnEnterHandles1(objth,ev,"2","txtItemCd",""));
        }else{
            objName.get(0).value = "";
            objCode.get(0).value = "";
            
            if(objCode_basic.get(0) != undefined)
            {
                objName_basic.get(0).value = "";
                objCode_basic.get(0).value = "";
                if(strRptGubun == "800")
                {
                    $("#cbItemChk").get(0).checked = true;
                    $("#cbItemChk_basic").get(0).checked = true;
                }
            }
        }
        break;
        case 6 : //담당자
        objName = $("#txtEmpDes");
        objCode = $("#txtEmpCd");
        objName_basic = $("#txtEmpDes_basic");
        objCode_basic = $("#txtEmpCd_basic");
        var strRptGubun = "1";    
        var mFlag = "Y";
        
        
        if(th.indexOf("_basic") > -1) strKey = objCode_basic.get(0).value;
        else strKey = objCode.get(0).value;

        if ((objCode.get(0).value!="" || (objCode_basic.get(0)!=undefined && objCode_basic.get(0).value!="")) || key_type=="double"){
            if( key_type!="double" ){
                objName.get(0).value = "";
                objCode.get(0).value = "";
                
                if(objCode_basic.get(0) != undefined)
                {
                    objName_basic.get(0).value = "";
                    objCode_basic.get(0).value = "";
                }
            }else
                strKey = "";
                if (strRptGubun == "811")
                    fnGetData("Type=CUSTEMP&MergeFlag="+mFlag+"&KeyWord="+encodeURIComponent(strKey)+"&"+"&MultiCount=20", "/ECMain/CM/ES/ES006P.aspx", "담당자검색", "450", "500", "", "/ECMain/CM/ES/ES_CM_DATA.aspx", "#"+fnEnterHandles1(objth,ev,"2","txtEmpCd",""));
                else
            fnGetData("Type=CUSTEMP&MergeFlag="+mFlag+"&KeyWord="+encodeURIComponent(strKey)+"&", "/ECMain/CM/ES/ES006P.aspx", "담당자검색", "450", "500", "", "/ECMain/CM/ES/ES_CM_DATA.aspx", "#"+fnEnterHandles1(objth,ev,"2","txtEmpCd",""));

        }else{
            objName.get(0).value = "";
            objCode.get(0).value = "";
            
            if(objCode_basic.get(0) != undefined)
            {
                objName_basic.get(0).value = "";
                objCode_basic.get(0).value = "";
            }
        }
        break;
        case 7 :   //거래처그룹
        var title = "거래처그룹1";
        objName = $("#txtCustGroupDes1");
        objCode = $("#txtCustGroup1");
        objName_basic = $("#txtCustGroupDes1_basic");
        objCode_basic = $("#txtCustGroup1_basic");
        var nfields = "";
        if (key_gubun == "A12")
        {
            title = "거래처그룹2";
            objName = $("#txtCustGroupDes2");
            objCode = $("#txtCustGroup2");
            objName_basic = $("#txtCustGroupDes2_basic");
            objCode_basic = $("#txtCustGroup2_basic");
            var nfields = "txtCustGroup1";
        }
        
        if(th.indexOf("_basic") > -1) strKey = objCode_basic.get(0).value;
        else strKey = objCode.get(0).value;

        if ((objCode.get(0).value!="" || (objCode_basic.get(0)!=undefined && objCode_basic.get(0).value!="")) || key_type=="double"){
            if( key_type!="double" ){
                objName.get(0).value = "";
                objCode.get(0).value = "";

                if(objCode_basic.get(0) != undefined)
                {
                    objName_basic.get(0).value = "";
                    objCode_basic.get(0).value = "";
                }
            }else
                strKey = "";
            fnGetData("Type=CUSTGROUP&InputFlag=N&CodeClass="+encodeURIComponent(key_gubun)+"&KeyWord="+encodeURIComponent(strKey), "/ECMain/CM/CM002P.aspx", title, "450", "500", "", "/ECMain/CM/ES/ES_CM_DATA.aspx", "#"+fnEnterHandles1(objth,ev,"2",nfields,"2"));	                         
        }else{
            objName.get(0).value = "";
            objCode.get(0).value = "";

            if(objCode_basic.get(0) != undefined)
            {
                objName_basic.get(0).value = "";
                objCode_basic.get(0).value = "";
            }
        }
        break;
        case 8: //담당자
        objName = $("#txtCustEmpDes");
        objCode = $("#txtCustEmpCd");
        objName_basic = $("#txtCustEmpDes_basic");
        objCode_basic = $("#txtCustEmpCd_basic");
        
        if(th.indexOf("_basic") > -1) strKey = objCode_basic.get(0).value;
        else strKey = objCode.get(0).value;

        if ((objCode.get(0).value!="" || (objCode_basic.get(0)!=undefined && objCode_basic.get(0).value!="")) || key_type=="double"){
            if( key_type!="double" ){
                objName.get(0).value = "";
                objCode.get(0).value = "";

                if(objCode_basic.get(0) != undefined)
                {
                    objName_basic.get(0).value = "";
                    objCode_basic.get(0).value = "";
                }
            }else
                strKey = "";
            
            if ($("#txtCustEmpCd").val() == "")
            {  
                if ( strKey == "")
                {               
                    objDHtml = dhtmlPopUpOriginal("/ECMain/CM/ES/ES006P.aspx?Type=CUSTEMP&KeyWord="+encodeURIComponent(strKey)+"&", '담당자검색', "450", "500");
                    objNextBox = $("#"+fnEnterHandles1(objth,ev,"2","txtCustEmpCd","")); 
                }
                else
                    fnGetData("Type=CUSTEMP&KeyWord="+encodeURIComponent(strKey)+"&", "/ECMain/CM/ES/ES006P.aspx", "담당자검색", "450", "500", "", "/ECMain/CM/ES/ES_CM_DATA.aspx", "#"+fnEnterHandles1(objth,ev,"2","txtCustEmpCd",""));
            }
            else                    
                fnGetData("Type=CUSTEMP&KeyWord="+encodeURIComponent(strKey)+"&", "/ECMain/CM/ES/ES006P.aspx", "담당자검색", "450", "500", "", "/ECMain/CM/ES/ES_CM_DATA.aspx", "#"+fnEnterHandles1(objth,ev,"2","txtCustEmpCd",""));
                
        }else{
            objName.get(0).value = "";
            objCode.get(0).value = "";

            if(objCode_basic.get(0) != undefined)
            {
                objName_basic.get(0).value = "";
                objCode_basic.get(0).value = "";
            }
        }
        break;
        case 9:   //품목코드
        objCode = $("#" + th.replace(/_basic/g,""));
        objName = $("#" + th.replace(/_basic/g,"").replace("Cd","Des"));
        objCode_basic = $("#" + (th.indexOf("_basic") > -1 ? th : th + "_basic"));
        objName_basic = $("#" + (th.indexOf("_basic") > -1 ? th.replace("Cd","Des") : th.replace("Cd","Des") + "_basic"));
        var chkFlag = "";
        var addString = "";
        if( $("#ddlWorkTarget").get(0) != null)
        {
            chkFlag = $("#ddlWorkTarget").get(0).value;
            addString = "&BOM_FLAG=N";

            if (chkFlag == "25")
                addString = "&BOM_FLAG=Y";
        }
        if(th.indexOf("_basic") > -1) strKey = objCode_basic.get(0).value;
        else strKey = objCode.get(0).value;

        var hidSearchData;
        if("1" == "800")
        {
            strMergeFlag ="Y";
        }
        // 주품목기준환산
        var strMainParam = "";
        // 선입선출재고현황 or 일별이익현황
        if($("#cbMainProdFlag").is(":checked") &&
            ("1" === "21" || "1" === "29")) {
            strMainParam = "&MAIN_YN=Y";
        }

        if( "1" == "71" )
            hidSearchData = "93;uqty1;1;;;2;;;;1;;";
        if ((objCode.get(0).value!="" || (objCode_basic.get(0)!=undefined && objCode_basic.get(0).value!="")) || key_type=="double"){
            if (sub_prod2(strKey)==false){
                if( key_type!="double" ){
                    objName.get(0).value = "";
                    objCode.get(0).value = "";
                    
                    if(objCode_basic.get(0) != undefined)
                    {
                        objName_basic.get(0).value = "";
                        objCode_basic.get(0).value = "";
                    }
                }
                else{
                    strKey = "";
                }
                if( "1" != "71" )
                    fnGetData("Type=PROJECTCD" + addString + "&KeyWord=" + encodeURIComponent(strKey) + "&strCallFlag=O&MergeFlag="+strMergeFlag + "&strRptGubun=1" + strMainParam, "/ECMain/CM/ES/ES020P.aspx", "품목코드검색", "550", "600", "Y", "/ECMain/CM/ES/ES_CM_DATA.aspx", "#"+fnEnterHandles1(objth,ev,"2","txtSProdCd",""));
                else
                    fnGetData("Type=PROJECTCD" + addString + "&KeyWord=" + encodeURIComponent(strKey) + "&strCallFlag=O&MergeFlag="+strMergeFlag + "&strRptGubun=1"+"&hidSearchData="+encodeURIComponent(hidSearchData) + strMainParam, "/ECMain/CM/ES/ES020P.aspx", "품목코드검색", "550", "600", "Y", "/ECMain/CM/ES/ES_CM_DATA.aspx", "#"+fnEnterHandles1(objth,ev,"2","txtSProdCd",""));
            }
            else{
                objName.get(0).value = "";
                
                if(objName_basic.get(0) != null)
                {
                    objName_basic.get(0).value = "";
                }
            }
        }
        else{
            if (sub_prod2(strKey)==false){
                objName.get(0).value = "";
                objCode.get(0).value = "";
                
                if(objCode_basic.get(0) != undefined)
                {
                    objName_basic.get(0).value = "";
                    objCode_basic.get(0).value = "";
                }
            }
        }
        break;
        case 10 :   //품목그룹
        var classg = "1";
        var nfield = "";
        if (key_gubun != "")
            classg = key_gubun;

        if (classg == "1")
            nfield = "txtClassCd";
        else if (classg == "2")
            nfield = "txtClassCd2";
        else if (classg == "3")
            nfield = "txtClassCd3";

        objCode = $("#" + th.replace(/_basic/g,""));
        objName = $("#" + th.replace(/_basic/g,"").replace("Cd","Des"));
        objCode_basic = $("#" + (th.indexOf("_basic") > -1 ? th : th + "_basic"));
        objName_basic = $("#" + (th.indexOf("_basic") > -1 ? th.replace("Cd","Des") : th.replace("Cd","Des") + "_basic"));

        if(th.indexOf("_basic") > -1) strKey = objCode_basic.get(0).value;
        else strKey = objCode.get(0).value;

        if ((objCode.get(0).value!="" || (objCode_basic.get(0)!=undefined && objCode_basic.get(0).value!="")) || key_type=="double"){
            if (sub_prod(strKey)==false){
                if( key_type!="double" ){
                    objName.get(0).value = "";
                    objCode.get(0).value = "";
                    
                    if(objCode_basic.get(0) != undefined)
                    {
                        objName_basic.get(0).value = "";
                        objCode_basic.get(0).value = "";
                    }
                }else{
                    strKey = "";
                }
            fnGetData("Type=PJTCLASSCD&ClassGb="+classg+"&KeyWord=" + encodeURIComponent(strKey), "/ECMain/CM/ES/ES005P.aspx", "품목그룹검색", "450", "400", "N", "/ECMain/CM/ES/ES_CM_DATA.aspx", "#"+fnEnterHandles1(objth,ev,"2",nfield,""));
            }    
        }else{
            if (sub_prod(strKey)==false){
                objName.get(0).value = "";
                objCode.get(0).value = "";
                
                if(objCode_basic.get(0) != undefined)
                {
                    objName_basic.get(0).value = "";
                    objCode_basic.get(0).value = "";
                }
            }    
        }
        break;
        case 11 : //부서검색
        objName = $("#txtSiteDes");
        objCode = $("#txtSiteCd");
        objName_basic = $("#txtSiteDes_basic");
        objCode_basic = $("#txtSiteCd_basic");   
             
        
        if(th.indexOf("_basic") > -1) strKey = objCode_basic.get(0).value;
        else strKey = objCode.get(0).value;

        if ((objCode.get(0).value!="" || (objCode_basic.get(0)!=undefined && objCode_basic.get(0).value!="")) || key_type=="double"){
                if (sub_prod(strKey)==false){
                    if( key_type!="double" ){
                        objName.get(0).value = "";
                        objCode.get(0).value = "";
                       
                        if(objCode_basic.get(0) != undefined)
                        {
                            objName_basic.get(0).value = "";
                            objCode_basic.get(0).value = "";
                        }
                    }
                    else{
                        strKey = "";
                    }
                    fnGetData("Type=SITEDEPTCM&KeyWord=" + encodeURIComponent(strKey) + "&KeyWordType=5&ChkFlag=L&MergeFlag="+strMergeFlag, "/ECMain/CM/CM006P.aspx", "부서검색", "450", "500", "SITEDEPTCM", "/ECMain/CM/ES/ES_CM_DATA.aspx", "#"+fnEnterHandles1(objth,ev,"2","txtSiteCd",""));
                }
            }
            else{
                objName.get(0).value = "";
                objCode.get(0).value = "";
                
                if(objCode_basic.get(0) != undefined)
                {
                    objName_basic.get(0).value = "";
                    objCode_basic.get(0).value = "";
                }
            }
        break;
        case 12 : // 품목계층그룹 (Tree)
            objName = $("#txtTreeGroupNm");
            objCode = $("#txtTreeGroupCd");
            objName_basic = $("#txtTreeGroupNm_basic");
            objCode_basic = $("#txtTreeGroupCd_basic");
            
            if(th.indexOf("_basic") > -1) strKey = objCode_basic.get(0).value;
            else strKey = objCode.get(0).value;

            if ((objCode.get(0).value!="" || (objCode_basic.get(0)!=undefined && objCode_basic.get(0).value!="")) || key_type=="double"){
                if (sub_prod(strKey) == false) {
                    if (key_type != "double") {
                        objName.get(0).value = "";
                        objCode.get(0).value = "";
                       
                        if(objCode_basic.get(0) != undefined)
                        {
                            objName_basic.get(0).value = "";
                            objCode_basic.get(0).value = "";
                        }
                    } else {
                        strKey = "";
                    }
                    fnGetData("Type=SEARCH&Code=&Text=" + encodeURIComponent(strKey), "/ECMain/ESA/ESA066M.aspx", "계층그룹선택", "500", "560", "N", "/ECMain/ESA/ESA041M_DATA.aspx", "#" + fnEnterHandles1(objth, ev, "2"));
                }
            } else {
                if (sub_prod(strKey) == false) {
                    objName.get(0).value = "";
                    objCode.get(0).value = "";
                   
                    if(objCode_basic.get(0) != undefined)
                    {
                        objName_basic.get(0).value = "";
                        objCode_basic.get(0).value = "";
                    }
                }
            }
        break;
        case 13 : // 거래처계층그룹 (Tree)
            objName = $("#txtTreeCustNm");
            objCode = $("#txtTreeCustCd");
            objName_basic = $("#txtTreeCustNm_basic");
            objCode_basic = $("#txtTreeCustCd_basic");
            
            if(th.indexOf("_basic") > -1) strKey = objCode_basic.get(0).value;            
            else strKey = objCode.get(0).value;

            if ((objCode.get(0).value!="" || (objCode_basic.get(0)!=undefined && objCode_basic.get(0).value!="")) || key_type=="double"){
                if (sub_prod(strKey) == false) {
                    if (key_type != "double") {
                        objName.get(0).value = "";
                        objCode.get(0).value = "";
                       
                        if(objCode_basic.get(0) != undefined)
                        {
                            objName_basic.get(0).value = "";
                            objCode_basic.get(0).value = "";
                        }
                    } else {
                        strKey = "";
                    }
                    fnGetData("Type=SEARCH&Code=&Text=" + encodeURIComponent(strKey), "/ECMain/ESA/ESA065M.aspx", "계층그룹선택", "500", "560", "N", "/ECMain/ESA/ESA046M_DATA.aspx", "#" + fnEnterHandles1(objth, ev, "2"));
                }
            } else {
                if (sub_prod(strKey) == false) {
                    objName.get(0).value = "";
                    objCode.get(0).value = "";
                   
                    if(objCode_basic.get(0) != undefined)
                    {
                        objName_basic.get(0).value = "";
                        objCode_basic.get(0).value = "";
                    }
                }
            }
        break;
        case 14 : // 창고계층그룹 (Tree)
            objName = $("#txtTreeWhNm");
            objCode = $("#txtTreeWhCd");
            objName_basic = $("#txtTreeWhNm_basic");
            objCode_basic = $("#txtTreeWhCd_basic");

            if(th.indexOf("_basic") > -1) strKey = objCode_basic.get(0).value;            
            else strKey = objCode.get(0).value;

            if ((objCode.get(0).value!="" || (objCode_basic.get(0)!=undefined && objCode_basic.get(0).value!="")) || key_type=="double"){
                if (sub_prod(strKey) == false) {
                    if (key_type != "double") {
                        objName.get(0).value = "";
                        objCode.get(0).value = "";
                        
                        if(objCode_basic.get(0) != undefined)
                        {
                            objName_basic.get(0).value = "";
                            objCode_basic.get(0).value = "";
                        }
                    } else {
                        strKey = "";
                    }
                    fnGetData("Type=SEARCH&Code=&Text=" + encodeURIComponent(strKey), "/ECMain/ESA/ESA068M.aspx", "계층그룹선택", "400", "400", "N", "/ECMain/ESA/ESA051M_DATA.aspx", "#" + fnEnterHandles1(objth, ev, "2"));
                }
            } else {
                if (sub_prod(strKey) == false) {
                    objName.get(0).value = "";
                    objCode.get(0).value = "";
                    
                    if(objCode_basic.get(0) != undefined)
                    {
                        objName_basic.get(0).value = "";
                        objCode_basic.get(0).value = "";
                    }
                }
            }
        break;
        case 15 : // 수정자
            objName = $("#txtLastUpdatedName");
            objCode = $("#txtLastUpdatedID");
            objName_basic = $("#txtLastUpdatedName_basic");
            objCode_basic = $("#txtLastUpdatedID_basic");

            //전표 조회 권한과 상관없이 모든 사용자를 보여줘야 할 경우 hfNolimitFlag 추가
            var objNoLimit = "";
            if("1" == "83") // 83 : 재고2 > 오더관리
                objNoLimit = "&hfNolimitFlag=Y";

            if(th.indexOf("_basic") > -1) strKey = objCode_basic.get(0).value;            
            else strKey = objCode.get(0).value;

            if ((objCode.get(0).value!="" || (objCode_basic.get(0)!=undefined && objCode_basic.get(0).value!="")) || key_type=="double"){
                if (key_type != "double") {
                    objName.get(0).value = "";
                    objCode.get(0).value = "";

                    if(objCode_basic.get(0) != undefined)
                    {
                        objName_basic.get(0).value = "";
                        objCode_basic.get(0).value = "";
                    }
                } else
                    strKey = ""; 
                fnGetData("Type=WID&hfID=txtLastUpdatedID&hfName=txtLastUpdatedName&hfFocus="+ fnEnterHandles1(objth, ev, "2","txtLastUpdatedID","") +"&hfParam="+encodeURIComponent(strKey)+"&flag=Y"+"&hidSG=Y"+objNoLimit, "/ECMAIN/CM/CM013P.aspx", "담당자검색", "450", "500", "Y", "/ECMain/EGG/EGG001M_DATA.aspx", "#" + fnEnterHandles1(objth, ev, "2","txtLastUpdatedID",""));
            } else {
                objName.get(0).value = "";
                objCode.get(0).value = "";

                if(objCode_basic.get(0) != undefined)
                {
                    objName_basic.get(0).value = "";
                    objCode_basic.get(0).value = "";
                }
            }
        break;
         case 16 :   // 부서계층그룹
            objName = $("#txtTreeSiteNm");
            objCode = $("#txtTreeSiteCd");
            objName_basic = $("#txtTreeSiteNm_basic");
            objCode_basic = $("#txtTreeSiteCd_basic");

            if(th.indexOf("_basic") > -1) strKey = objCode_basic.get(0).value;            
            else strKey = objCode.get(0).value;

            if ((objCode.get(0).value!="" || (objCode_basic.get(0)!=undefined && objCode_basic.get(0).value!="")) || key_type=="double"){
                if (sub_prod(strKey) == false) {
                    if (key_type != "double") {
                        objName.get(0).value = "";
                        objCode.get(0).value = "";
                        
                        if(objCode_basic.get(0) != undefined)
                        {
                            objName_basic.get(0).value = "";
                            objCode_basic.get(0).value = "";
                        }
                    } else {
                        strKey = "";
                    }
                    fnGetData("Type=SEARCH&Gubun=ACCT&Code=&Text=" + encodeURIComponent(strKey), "/ECMain/ESA/ESA067M.aspx", "계층그룹선택", "400", "400", "N", "/ECMain/ESA/ESA056M_DATA.aspx", "#" + fnEnterHandles1(objth, ev, "2"));
                }
            } else {
                if (sub_prod(strKey) == false) {
                    objName.get(0).value = "";
                    objCode.get(0).value = "";
                    
                    if(objCode_basic.get(0) != undefined)
                    {
                        objName_basic.get(0).value = "";
                        objCode_basic.get(0).value = "";
                    }
                }
            }
        break;
		case 17 :	// 사용유형
			objName = $("#txtJagaTypeDes");
			objCode = $("#txtJagaTypeCd");
			objName_basic = $("#txtJagaTypeDes_basic");
			objCode_basic = $("#txtJagaTypeCd_basic");

			
			if(th.indexOf("_basic") > -1) strKey = objCode_basic.get(0).value;
			else strKey = objCode.get(0).value;
						
			if ((objCode.get(0).value!="" || (objCode_basic.get(0)!=undefined && objCode_basic.get(0).value!="")) || key_type=="double"){
				if (sub_prod(strKey)==false){
					if( key_type!="double" ){
						objName.get(0).value = "";
						objCode.get(0).value = "";
						
						if(objCode_basic.get(0) != undefined)
						{
							objName_basic.get(0).value = "";
							objCode_basic.get(0).value = "";
						}
					}else
						strKey = "";
						if(strMul =="Y") CustWidth=Number(CustWidth)+6;

					fnGetData("Type=CUSTGROUP&InputFlag=N&CodeClass=S20&KeyWord="+encodeURIComponent(strKey), "../CM/CM002P.aspx", '사용유형', "450", "500", '',"../CM/ES/ES_CM_DATA.aspx", "#" + fnEnterHandles1(objth, ev, "2"));
				}     
			}else{
				if (sub_prod(strKey)==false){   
					objName.get(0).value = "";
					objCode.get(0).value = "";
					
					if(objCode_basic.get(0) != undefined)
					{
						objName_basic.get(0).value = "";
						objCode_basic.get(0).value = "";
					}
				}
			}
		break;
		case 18 :	// 사용유형
			objName = $("#txtBadTypeDes");
			objCode = $("#txtBadTypeCd");
			objName_basic = $("#txtBadTypeDes_basic");
			objCode_basic = $("#txtBadTypeCd_basic");

			
			if(th.indexOf("_basic") > -1) strKey = objCode_basic.get(0).value;
			else strKey = objCode.get(0).value;
						
			if ((objCode.get(0).value!="" || (objCode_basic.get(0)!=undefined && objCode_basic.get(0).value!="")) || key_type=="double"){
				if (sub_prod(strKey)==false){
					if( key_type!="double" ){
						objName.get(0).value = "";
						objCode.get(0).value = "";
						
						if(objCode_basic.get(0) != undefined)
						{
							objName_basic.get(0).value = "";
							objCode_basic.get(0).value = "";
						}
					}else
						strKey = "";
						if(strMul =="Y") CustWidth=Number(CustWidth)+6;

					fnGetData("Type=CUSTGROUP&InputFlag=N&CodeClass=S09&KeyWord="+encodeURIComponent(strKey), "../CM/CM002P.aspx", "불량유형 검색", "450", "500", '',"../CM/ES/ES_CM_DATA.aspx", "#" + fnEnterHandles1(objth, ev, "2"));
				}     
			}else{
				if (sub_prod(strKey)==false){   
					objName.get(0).value = "";
					objCode.get(0).value = "";
					
					if(objCode_basic.get(0) != undefined)
					{
						objName_basic.get(0).value = "";
						objCode_basic.get(0).value = "";
					}
				}
			}
		break;
        case 19:   //시리얼 추가 코드항목
        	objCode = $("#" + th.replace(/_basic/g,""));
	        objName = $("#" + th.replace(/_basic/g,"").replace("Cd","CdDes"));
	        objCode_basic = $("#" + (th.indexOf("_basic") > -1 ? th : th + "_basic"));
	        objName_basic = $("#" + (th.indexOf("_basic") > -1 ? th.replace("Cd","CdDes") : th.replace("Cd","CdDes") + "_basic"));
		var iUdcCdSeq = objCode.attr('id').replace(/txtUdcCd/g,"");
	        if(th.indexOf("_basic") > -1)
		   strKey = objCode_basic.get(0).value;
	        else 
                   strKey = objCode.get(0).value;

	        if ((objCode.get(0).value!="" || (objCode_basic.get(0)!=undefined && objCode_basic.get(0).value!="")) || key_type=="double"){
	            if( key_type!="double" ){
	                objName.get(0).value = "";
	                objCode.get(0).value = "";
	
	                if(objCode_basic.get(0) != undefined)
	                {
	                    objName_basic.get(0).value = "";
	                    objCode_basic.get(0).value = "";
	                }
	            }else
	                strKey = "";
	            
	
	            if (objCode.val() == "")
	            {  
	                if ( strKey == "")
	                {               
	                    objDHtml = dhtmlPopUpOriginal("/ECMain/ESQ/ESQ202P_07.aspx?Type=UDC&KeyWord="+encodeURIComponent(strKey)+"&hidUdcCdSeq="+iUdcCdSeq, '항목검색', "450", "500");
	                    objNextBox = $("#"+fnEnterHandles1(objth,ev,"2")); 
	                }
	                else
	                    fnGetData("Type=UDC&KeyWord="+encodeURIComponent(strKey)+"&hidUdcCdSeq="+iUdcCdSeq, "/ECMain/ESQ/ESQ202P_07.aspx", "항목검색", "450", "500", "", "/ECMain/ESQ/ESQ202M_DATA.aspx", "#"+fnEnterHandles1(objth,ev,"2"));
	            }
	            else 
	                fnGetData("Type=UDC&KeyWord="+encodeURIComponent(strKey)+"&hidUdcCdSeq="+iUdcCdSeq, "/ECMain/ESQ/ESQ202P_07.aspx", "항목검색", "450", "500", "", "/ECMain/ESQ/ESQ202M_DATA.aspx", "#"+fnEnterHandles1(objth,ev,"2"));
                
	        }else{
	            objName.get(0).value = "";
	            objCode.get(0).value = "";

	            if(objCode_basic.get(0) != undefined)
	            {
	                objName_basic.get(0).value = "";
	                objCode_basic.get(0).value = "";
	            }
	        }
	break;

    case 20:   //주문처리유형검색   HAR추가 START
			objName = $("#txtTypeName");
            objCode = $("#txtTypeCd");
            objName_basic = $("#txtTypeName_basic");
            objCode_basic = $("#txtTypeCd_basic");

            if(th.indexOf("_basic") > -1) strKey = objCode_basic.get(0).value;            
            else strKey = objCode.get(0).value;

            if ((objCode.get(0).value!="" || (objCode_basic.get(0)!=undefined && objCode_basic.get(0).value!="")) || key_type=="double"){
                if (key_type != "double") {
                    objName.get(0).value = "";
                    objCode.get(0).value = "";

                    if(objCode_basic.get(0) != undefined)
                    {
                        objName_basic.get(0).value = "";
                        objCode_basic.get(0).value = "";
                    }
                } else
                    strKey = ""; 
                //objDHtml = dhtmlPopUpOriginal("../ESO/ESO003P_02.aspx?KeyWord="+encodeURIComponent(strKey), "오더관리유형검색", "450", "400");
                  fnGetData("Type=UDC&KeyWord="+encodeURIComponent(strKey), "/ECMain/ESO/ESO003P_02.aspx", "오더관리유형검색", "450", "500", "", "/ECMain/ESQ/ESQ202M_DATA.aspx", "#" + fnEnterHandles1(objth, ev, "2","txtProcNo",""));
                  objNextBox = $("#"+fnEnterHandles1(objth,ev,"2"));            
            } else {
                objName.get(0).value = "";
                objCode.get(0).value = "";

                if(objCode_basic.get(0) != undefined)
                {
                    objName_basic.get(0).value = "";
                    objCode_basic.get(0).value = "";
                }
            }

		break;
		case 21:   //주문처리번호
			objName = $("#txtProcName");
            objCode = $("#txtProcNo");
            objName_basic = $("#txtProcName_basic");
            objCode_basic = $("#txtProcNo_basic");

            if(th.indexOf("_basic") > -1) strKey = objCode_basic.get(0).value;            
            else strKey = objCode.get(0).value;

            if ((objCode.get(0).value!="" || (objCode_basic.get(0)!=undefined && objCode_basic.get(0).value!="")) || key_type=="double"){
                if (key_type != "double") {
                    objName.get(0).value = "";
                    objCode.get(0).value = "";

                    if(objCode_basic.get(0) != undefined)
                    {
                        objName_basic.get(0).value = "";
                        objCode_basic.get(0).value = "";
                    }
                } else
                    strKey = ""; 
                //objDHtml = dhtmlPopUpOriginal("../ESO/ESO003P_01.aspx?KeyWord="+encodeURIComponent(strKey), "오더관리번호검색", "450", "400");
                fnGetData("KeyWord="+encodeURIComponent(strKey), "/ECMain/ESO/ESO003P_01.aspx", "오더관리번호검색", "450", "500", "", "/ECMain/ESQ/ESQ202M_DATA.aspx", "#" + fnEnterHandles1(objth, ev, "2","txtChargeID",""));
                //objNextBox = $("#"+fnEnterHandles1(objth,ev,"2"));  
                
            } else {
                objName.get(0).value = "";
                objCode.get(0).value = "";

                if(objCode_basic.get(0) != undefined)
                {
                    objName_basic.get(0).value = "";
                    objCode_basic.get(0).value = "";
                }
            }

		break;
		case 22 :   //주문처리단계  HAR추가 END
			objName = $("#txtProcStepDesc");
            objCode = $("#txtProcStep");
            objName_basic = $("#txtProcStepDesc_basic");
            objCode_basic = $("#txtProcStep_basic");

            if(th.indexOf("_basic") > -1) strKey = objCode_basic.get(0).value;            
            else strKey = objCode.get(0).value;

            if ((objCode.get(0).value!="" || (objCode_basic.get(0)!=undefined && objCode_basic.get(0).value!="")) || key_type=="double"){
                if (key_type != "double") {
                    objName.get(0).value = "";
                    objCode.get(0).value = "";

                    if(objCode_basic.get(0) != undefined)
                    {
                        objName_basic.get(0).value = "";
                        objCode_basic.get(0).value = "";
                    }
                } else
                    strKey = ""; 
                objDHtml = dhtmlPopUpOriginal("../ESO/ESO003P_03.aspx?KeyWord="+encodeURIComponent(strKey), "처리단계검색", "450", "400");
            } else {
                objName.get(0).value = "";
                objCode.get(0).value = "";

                if(objCode_basic.get(0) != undefined)
                {
                    objName_basic.get(0).value = "";
                    objCode_basic.get(0).value = "";
                }
            }

		break;
        case 23 : // 수정자
            objName = $("#txtChargeName");
            objCode = $("#txtChargeID");
            objName_basic = $("#txtChargeName_basic");
            objCode_basic = $("#txtChargeID_basic");

            if(th.indexOf("_basic") > -1) strKey = objCode_basic.get(0).value;            
            else strKey = objCode.get(0).value;

            if ((objCode.get(0).value!="" || (objCode_basic.get(0)!=undefined && objCode_basic.get(0).value!="")) || key_type=="double"){
                if (key_type != "double") {
                    objName.get(0).value = "";
                    objCode.get(0).value = "";

                    if(objCode_basic.get(0) != undefined)
                    {
                        objName_basic.get(0).value = "";
                        objCode_basic.get(0).value = "";
                    }
                } else
                    strKey = ""; 
                fnGetData("Type=WID&hfID=txtChargeID&hfName=txtChargeName&MergeFlag="+fn_GetValueChargeID()+"&hfFocus="+ fnEnterHandles1(objth, ev, "2","txtChargeID","") +"&hfParam="+encodeURIComponent(strKey)+"&flag=Y"+"&hidSG=Y", "/ECMAIN/CM/CM013P.aspx", "담당자검색", "450", "500", "Y", "/ECMain/EGG/EGG001M_DATA.aspx", "#" + fnEnterHandles1(objth, ev, "2","txtChargeID",""));
            } else {
                objName.get(0).value = "";
                objCode.get(0).value = "";

                if(objCode_basic.get(0) != undefined)
                {
                    objName_basic.get(0).value = "";
                    objCode_basic.get(0).value = "";
                }
            }
        break;
        case 24: 
        objName = $("#txtServDes");
        objCode = $("#txtServCd");
        objName_basic = $("#txtServDes_basic");
        objCode_basic = $("#txtServCd_basic");
        
        if(th.indexOf("_basic") > -1) strKey = objCode_basic.get(0).value;
        else strKey = objCode.get(0).value;

        if(th.indexOf("_basic") > -1) strKey = objCode_basic.get(0).value;            
        else strKey = objCode.get(0).value;

        if ((objCode.get(0).value!="" || (objCode_basic.get(0)!=undefined && objCode_basic.get(0).value!="")) || key_type=="double"){
            if (key_type != "double") {
                objName.get(0).value = "";
                objCode.get(0).value = "";

                if(objCode_basic.get(0) != undefined)
                {
                    objName_basic.get(0).value = "";
                    objCode_basic.get(0).value = "";
                }
            } else
                strKey = ""; 
            fnGetData("Type=WID&hfID=txtChargeID&hfName=txtChargeName&MergeFlag="+fn_GetValueChargeID()+"&hfFocus="+ fnEnterHandles1(objth, ev, "2","txtChargeID","")
             +"&hfParam="+encodeURIComponent(strKey)+"&flag=Y"+"&hidSG=Y", "/ECMAIN/CM/EB/EB015P.aspx", "서비스검색", "450", "500", "Y", "/ECMain/EGG/EGG001M_DATA.aspx", "#" + fnEnterHandles1(objth, ev, "2","txtChargeID",""));
        } else {
            objName.get(0).value = "";
            objCode.get(0).value = "";

            if(objCode_basic.get(0) != undefined)
            {
                objName_basic.get(0).value = "";
                objCode_basic.get(0).value = "";
            }
        }
        break;
		case 25 :   // Business Trip Expenses Code
		    objName = $("#txtBizTripExpDes");
		    objCode = $("#txtBizTripExp");
		    objName_basic = $("#txtBizTripExpDes_basic");
		    objCode_basic = $("#txtBizTripExp_basic");
		
		    objExpenseArr = $("#hdExpenseArr_exp");
		    objUnit = $("#txtUnits_exp");
            objPrice = $("#txtPrice_exp");
		    objAmt  = $("#txtLimits_exp");
		    objQty  = $("#txtQty_exp");
		    objDecA = $("#hidDecA_exp");
		    strKey = objCode.get(0).value;
		    if (objCode.get(0).value != "" || key_type == "double") {
			    if (sub_prod(strKey) == false) {
				    if (key_type != "double") {
					    objName.get(0).value = "";
					    objCode.get(0).value = "";
					    if(objCode_basic.get(0) != undefined)
					    {
						    objName_basic.get(0).value = "";
						    objCode_basic.get(0).value = "";
					    }
				    } else {
					    strKey = "";
				    }
				    fnGetData("Type=EXP_GET&KeyWord=" + encodeURIComponent(strKey)+ "&strMultiFlag="+ strMul+"&MergeFlag="+strMul+"&ChkFlag=A&InputFlag=N&FormType=Search", "/ECMain/CM/EB/EB018P.aspx", "출장비항목등록", "500", "560", "N", "/ECMain/EBO/EBO001M_DATA.aspx", "#" + fnEnterHandles1(objth, ev, "2"));
			    }
		    } else {
			    if (sub_prod(strKey) == false) {
				    objName.get(0).value = "";
				    objCode.get(0).value = "";
				    if(objCode_basic.get(0) != undefined)
				    {
					    objName_basic.get(0).value = "";
					    objCode_basic.get(0).value = "";
				    }
			    }
		    }
            break;
		case 26 : // 오더관리 진행현황(코드형 추가항목 검색)
			var targetCd;
			var targetNm;
			var index;
			
			index = th.substr(5,1);
			
			if(th.indexOf("_basic") > -1) {
				targetCd = th.replace("_basic", "");
				targetNm = th.replace("_basic", "").replace("txtCd","txtCdNm");
			}
			else {
				targetCd = th;
				targetNm = th.replace("txtCd","txtCdNm");
			}
				
			objName = $("#"+targetNm);
		    objCode = $("#"+targetCd);
		    objName_basic = $("#"+targetNm+"_basic");
		    objCode_basic = $("#"+targetCd+"_basic");
			
			if(th.indexOf("_basic") > -1) 
				strKey = objCode_basic.get(0).value;            
            else 
				strKey = objCode.get(0).value;

            if ((objCode.get(0).value != "" || (objCode_basic.get(0) != undefined && objCode_basic.get(0).value != "")) || key_type == "double") {
                if (key_type != "double") {
                    objName.get(0).value = "";
                    objCode.get(0).value = "";

                    if(objCode_basic.get(0) != undefined) {
                        objName_basic.get(0).value = "";
                        objCode_basic.get(0).value = "";
                    }
                } else {
                    strKey = ""; 
				}
				
                fnGetData("Type=TYPECD&CdSeq="+index+"&KeyWord="+encodeURIComponent(strKey), "/ECMain/ESO/ESO002P_06.aspx", "코드형추가항목", "450", "500", "Y", "/ECMain/ESO/ESO001M_DATA.aspx","#"+fnEnterHandles1(objth,ev,"2","#"+th,""));
            } else {
                objName.get(0).value = "";
                objCode.get(0).value = "";

                if(objCode_basic.get(0) != undefined) {
                    objName_basic.get(0).value = "";
                    objCode_basic.get(0).value = "";
                }
            }
			
			break;
        case 27 :   // Business Trip Code
		    objName = $("#txtBizTripCdDes");
		    objCode = $("#txtBizTripCd");
		    objName_basic = $("#txtBizTripCdDes_basic");
		    objCode_basic = $("#txtBizTripCd_basic");
		    strKey = objCode.get(0).value;
		    if (objCode.get(0).value != "" || key_type == "double") {
			    if (sub_prod(strKey) == false) {
				    if (key_type != "double") {
					    objName.get(0).value = "";
					    objCode.get(0).value = "";
					    if(objCode_basic.get(0) != undefined)
					    {
						    objName_basic.get(0).value = "";
						    objCode_basic.get(0).value = "";
					    }
				    } else {
					    strKey = "";
				    }
				    fnGetData("Type=EXP_GET&KeyWord=" + encodeURIComponent(strKey)+ "&strMultiFlag="+ strMul+"&MergeFlag="+strMul+"&ChkFlag=A&InputFlag=N&FormType=Search", "/ECMain/CM/EB/EB019P.aspx", "출장코드등록", "500", "560", "N", "/ECMain/EBO/EBO001M_DATA.aspx", "#" + fnEnterHandles1(objth, ev, "2"));
			    }
		    } else {
			    if (sub_prod(strKey) == false) {
				    objName.get(0).value = "";
				    objCode.get(0).value = "";
				    if(objCode_basic.get(0) != undefined)
				    {
					    objName_basic.get(0).value = "";
					    objCode_basic.get(0).value = "";
				    }
			    }
		    }
        break;
    }
}

//* 검색		    
function sub_prod(l_prod){
    str_temp = new String(l_prod);
    l_str= str_temp.length;
//    for (var i=0; i< l_str; i++) {
//        schar = str_temp.charAt(i);
//        if (schar == "*" ){			
//            alert(schar);
//            return true;
//        }
//    }
    //입력한 품목코드의 마지막 글자가 * 일때만 팝업창 띄우지 않도록 수정
    if(l_str > 0 && str_temp.charAt(l_str-1) == "*") {
        return true;
    }
    return false;
}

//* 검색 (재고현황시 *뒤에 문자있으면 규격으로 인식되게
function sub_prod2(l_prod){
    var strFlag = false;
    str_temp = new String(l_prod);
    l_str= str_temp.length;
//    for (var i=0; i< l_str; i++) {
//        schar = str_temp.charAt(i);
//        if (schar == "*" ){
//            strFlag = true;
//        }
//    }
    //입력한 품목코드의 마지막 글자가 * 일때만 팝업창 띄우지 않도록 수정
    if(l_str > 0 && str_temp.charAt(l_str-1) == "*") {
        strFlag = true;
    }
    
    if("1" == "53" && str_temp.substring(str_temp.length-1, str_temp.length) != "*")
        strFlag = false;
    
    return strFlag;
}


//비동기식으로 데이타를 가져온다.
    function fnGetData(strData, strSearchUrl, strTitle, strWidth, strHeight, strModal, strDataUrl, strNextF) {
        if (strModal != "Y")
        {
            $.ajax({
                type: "POST",
                dataType: "text",                
                url: strDataUrl != '' ?fnSetUrlPath(strDataUrl, "ec_req_sid"):fnSetUrlPath("ESD006M_DATA.aspx", "ec_req_sid"),                
                data: strData,
                error: function(errorMsg) {
                    alert("에러발생\nfnGetData:" + errorMsg);
                    //  return false;
                },
                success: function(returnXml) {
                    var dom = parseXML(returnXml);
                    var objResultXml = $(dom).find("RESULT");
                    var strTypes = $(dom).find("TYPE").text();

                        if(strTypes == "GETMANAGEITEMS"){
                            if($(dom).find("GUBUN").text() == "G")
                            {
                                $("#ddlGroupIds").html($(dom).find("OPTIONSHTML").text());

                                if($("#ddlGroupIds_basic").get(0) != undefined ) $("#ddlGroupIds_basic").html($(dom).find("OPTIONSHTML").text());
                            }
                            else
                            {
                                $("#ddlItems").html($(dom).find("OPTIONSHTML").text());

                                if($("#ddlItems_basic").get(0) != undefined ) $("#ddlItems_basic").html($(dom).find("OPTIONSHTML").text());
                            }
                        }
                        else if (objResultXml.length == 1 && strTypes != "SITEDEPTCM" && strTypes != "SITEPJTCM") {
                            //결과 값이 1개일때
                                strName = $(objResultXml).find("NAME").text();
                                strCode = $(objResultXml).find("CODE").text();
                            
                            objName.get(0).value = strName;
                            objCode.get(0).value = strCode;

                            if(objName_basic != null && objName_basic.get(0) != undefined && objCode_basic != null && objCode_basic.get(0) != undefined)
                            {
                                objName_basic.get(0).value = strName;
                                objCode_basic.get(0).value = strCode;
                            }
                           
                            SetCheckBoxMoveStore();
                            
                            if (strTypes == "SITEACCCM")
                                objHidVal.get(0).value = $(objResultXml).find("HIDVAL").text();
                            if (strTypes == "SALE009CM")
                            {
                                if($("#cbItemChk").get(0) != undefined && $("#cbItemChk_basic").get(0) != undefined)
                                {
                                    $("#cbItemChk").get(0).checked = false;
                                    $("#cbItemChk_basic").get(0).checked = false;
                                }
                            }
                            
                            $(strNextF).get(0).focus();
                            
                        }
                        else {

                            // Tree관련 작업 필요 (품목, 거래처, 창고)
                             if (strTypes == "SEARCH") {
                                // 계층그룹 검색의 경우 팝업창 Width값을 조회 처리
                                var iTableWidth = Number($(dom).find("WIDTH").text());
                                var iTablePopWidth = iTableWidth + 260; // Tree 기본 넓이 추가 
                                strData = strData + "&LeftW="+String(iTableWidth);
                                
                                if(strSearchUrl == "/ECMain/ESA/ESA065M.aspx"|| strSearchUrl == "/ECMain/ESA/ESA066M.aspx"|| strSearchUrl == "/ECMain/ESA/ESA067M.aspx" || strSearchUrl == "/ECMain/ESA/ESA068M.aspx" ){
                                    var winTree = window.open(fnSetUrlPath(strSearchUrl + "?" + strData, "ec_req_sid"), "winTree_SEARCH", "toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=yes,copyhistory=no,width=400,height=400");
                                    if(winTree) winTree.focus();
                                }
                                else{
                                    var winTree = window.open(fnSetUrlPath(strSearchUrl + "?" + strData, "ec_req_sid"), "winTree_SEARCH", "toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=yes,copyhistory=no,width=" + String(iTablePopWidth) + ",height=560");
                                    if(winTree) winTree.focus();
                                }
                            }
                            else {
                                //검색창 열기
                                objDHtml = dhtmlPopUpOriginal(strSearchUrl + "?" + strData, strTitle, strWidth, strHeight);
                                objNextBox = $(strNextF);
                            }
                        }
                    }
                
            });
        }
        else
        {
               objDHtml = dhtmlPopUpOriginal(strSearchUrl + "?" + strData, strTitle, strWidth, strHeight);
               objNextBox = $(strNextF);
        }
    }

    
function fHidDes()
{
    if($("select[name=ddlSioType] option:selected").length >0)
    {
        var ddlSioType = '';
        if ("1" == "49" ||"1" == "50" ||"1" == "80" || "1" == "81")
        {
            arrTypes = $("select[name=ddlSioType] option:selected").get(0).value.split("ㆍ");
            ddlSioType = arrTypes[0];
        }
        else
           ddlSioType = $("select[name=ddlSioType] option:selected").get(0).value;
        if(ddlSioType == "99")
            $("#hidSioDes").get(0).value = "";
        else
            $("#hidSioDes").get(0).value = $("select[name=ddlSioType] option:selected").get(0).innerText;
    }
    if($("input:radio[name=rbProdChk]:checked").length >0)
    {
        if($("input:radio[name=rbProdChk]:checked").get(0).value == "")
            $("#hidProdChkDes").get(0).value = "";
        else if($("input:radio[name=rbProdChk]:checked").get(0).value == "0")
            $("#hidProdChkDes").get(0).value = "원재료";
        else if($("input:radio[name=rbProdChk]:checked").get(0).value == "4")
            $("#hidProdChkDes").get(0).value = "부재료";
        else if($("input:radio[name=rbProdChk]:checked").get(0).value == "1")
            $("#hidProdChkDes").get(0).value = "제품";
        else if($("input:radio[name=rbProdChk]:checked").get(0).value == "2")
            $("#hidProdChkDes").get(0).value = "반제품";
        else
            $("#hidProdChkDes").get(0).value = "상품";
    }
}
function WongaChk(type)
{
    if("1" == "29")
    {   
        var chkSelVal = $("#ddlWongaType" + type).get(0).value; 
        var chkRbVal = $("input:radio[name=rbProdChk]:checked").get(0).value;
        if(chkSelVal == "4" && chkRbVal != "3")
        {
            alert("상품일때만 판매기준(선입선출)-상품 항목을 선택할 수 있습니다.");
            return;
        }
    }

    if($("#ddlWongaType" + type).get(0).value == "3")
    {
        $("#ddlGisu").css("visibility", "visible");
        if($("#ddlGisu_basic").get(0) != undefined) $("#ddlGisu_basic").css("visibility", "visible");

		if("1" != "29" && "1" != "21")
			$("#ddlVariation").css("visibility", "visible");
			
        if($("#ddlVariation_basic").get(0) != undefined && "1" != "21" && "1" != "29")
            $("#ddlVariation_basic").css("visibility", "visible");

        if($("#ddlGisu" + type).get(0).length == 1)
        {
            //alert("MSG00904"+" "+"MSG00905");
            $("#ddlWongaType").get(0).value == "1";
            if($("#ddlWongaType_basic").get(0) != undefined) $("#ddlWongaType_basic").get(0).value == "1";
            return false;
        }
        else
        {            

            if("" == "")
            {
                $("select[name=ddlGisu]").get(0).selectedIndex = 0;
                if($("select[name=ddlGisu_basic]").get(0) != undefined) $("select[name=ddlGisu_basic]").get(0).selectedIndex = 0;
            }
        }

        if("1" == "21")//일별이익현황
            fnDayliWongaChange();
    }
    else
    {
        $("#ddlGisu").css("visibility", "hidden");
        if($("#ddlGisu_basic").get(0) != undefined) $("#ddlGisu_basic").css("visibility", "hidden");

        $("#ddlVariation").css("visibility", "hidden");
        if($("#ddlVariation_basic").get(0) != undefined) $("#ddlVariation_basic").css("visibility", "hidden");
    }
}

function WongaChkType2(type)
{
    if($("#ddlWongaType2" + type).get(0).value == "3")
    {
        $("#ddlTypeGisu2").css("visibility", "visible");
        if($("#ddlTypeGisu2_basic").get(0) != undefined) $("#ddlTypeGisu2_basic").css("visibility", "visible");

        $("#ddlVariation2").css("visibility", "visible");
        if($("#ddlVariation2_basic").get(0) != undefined) $("#ddlVariation2_basic").css("visibility", "visible");

        if($("#ddlTypeGisu2" + type).get(0).length == 1)
        {
            $("#ddlWongaType2").get(0).value == "1";
            if($("#ddlWongaType2_basic").get(0) != undefined) $("#ddlWongaType2_basic").get(0).value == "1";
            return false;
        }
        else
        {
            if("" == "")
            {
                $("select[name=ddlTypeGisu2]").get(0).selectedIndex = 0;
                if($("select[name=ddlTypeGisu2_basic]").get(0) != undefined) $("select[name=ddlTypeGisu2_basic]").get(0).selectedIndex = 0;
            }
        }
    }
    else
    {
        $("#ddlTypeGisu2").css("visibility", "hidden");
        if($("#ddlTypeGisu2_basic").get(0) != undefined) $("#ddlTypeGisu2_basic").css("visibility", "hidden");

        $("#ddlVariation2").css("visibility", "hidden");
        if($("#ddlVariation2_basic").get(0) != undefined) $("#ddlVariation2_basic").css("visibility", "hidden");
    }
}

function GisuChk(type)
{
    if($("#ddlGisu" + type).get(0).length == 1)
    {
        //alert("MSG00904"+"MSG00905");
        return;
    }
}



function fnExcProdChange(type)
{
    if( $("#cbExcProdFlag" + type).get(0).checked == true )
        alert("등록되어 있는 모든 품목이 검색됩니다.\n\n등록된 품목이 많은 경우 속도에 영향을 줄 수 있습니다.");

    
}

function fnExceptFlagChange(type, id)
{
    var obj = $("#" + id + type);
    var objTarget = $("#" + id + (type == "" ? "_basic" : "")); 

	var objOpposition = (id == "cbExceptFlag" ? "cbOnlyFlag" : "cbExceptFlag");
           
	if(obj.get(0).checked)
	{
        if(objTarget.get(0) != undefined){
		    objTarget.get(0).checked = true;
		}
		if($("#" + objOpposition).get(0).checked)
		{
			$("#" + objOpposition).get(0).checked = false;
			$("#" + objOpposition + "_basic").get(0).checked = false;
		}
	}
}

function fnNextField(strRptGubun, Id)
{
    if(Id == "rbSumGubun2")
    {
        if(strRptGubun == "1")
        {
            if($("#rbSumGubun2").get(0).checked == false)
                nextfield = "cbRptConfirm";
            else
                nextfield = "cbSumCheck";
        }
    }
    else if(Id == "cbZeroFlag2")
    {
        if(strRptGubun == "1")
        {
            if(($("#rbSumGubun").get(0).checked == true || $("#rbSumGubun1").get(0).checked == true) && $("#txtSWhCd").get(0).value == "")
                nextfield = "cbMoveStore";
            else
                nextfield = "search_bt";
        }
        else if(strRptGubun == "56")
        {
            if($("#txtSWhCd").get(0).value == "")
                nextfield = "cbMoveStore";
            else
                nextfield = "search_bt";
        }
    }
    else if(Id == "rbDanga2")
    {
        if(strRptGubun == "56")
        {
            if($("#rbDanga2").get(0).checked == true)
                nextfield = "ddlWongaType1";
            else
                nextfield = "cbRptConfirm";
        }
    }
    else if(Id == "ddlWongaType1")
    {
        if(strRptGubun == "56")
            nextfield = "ddlWongaType2";
    }
    else if(Id == "ddlWongaType2")
    {
        if(strRptGubun == "56")
            nextfield = "ddlWongaType3";
    }
    else if(Id == "ddlWongaType3")
    {
        if(strRptGubun == "56")
            nextfield = "cbRptConfirm";
    }
    else if(Id == "txtSWhCd")
    {
        SetCheckBoxMoveStore();
    }
     else if(Id == "txtTreeWhCd")
    {
        SetCheckBoxMoveStore();
    }
}

function SumGubunChk(strRptGubun, type)
{
    if(strRptGubun == 1)
    {
        if(($("input:radio[name=rbSumGubun"+ type +"]:checked").get(0).value == "0" || $("input:radio[name=rbSumGubun"+ type +"]:checked").get(0).value == "1") && $("#txtSWhCd"+ type +"").get(0).value == "")
        {
            $("#cbMoveStore").get(0).disabled = false;

            if($("#cbMoveStore_basic").get(0) != undefined)
                $("#cbMoveStore_basic").get(0).disabled = false;
        }
        else
        {
            $("#cbMoveStore").get(0).disabled = true;

            if($("#cbMoveStore_basic").get(0) != undefined)
                $("#cbMoveStore_basic").get(0).disabled = true;
        }

        if($("input:radio[name=rbSumGubun"+ type +"]:checked").get(0).value == "2")
        {
            nextfield = "cbSumCheck";
            $("#lblSumCheck").get(0).style.visibility = "visible";

            if($("#lblSumCheck_basic").get(0) != undefined)
                $("#lblSumCheck_basic").get(0).style.visibility = "visible";
            $("#ddlFormSer").get(0).disabled = true;
            $("#ddlFormSer option:eq(0)").attr("selected", "selected");
        }
        else
        {
            $("#lblSumCheck").get(0).style.visibility = "hidden";

            if($("#lblSumCheck_basic").get(0) != undefined) $("#lblSumCheck_basic").get(0).style.visibility = "hidden";

            if($("input:radio[name=rbSumGubun]:checked").get(0).value == "0")
            {
                if($("#ddlFormSer option").length > 0)
                    $("#ddlFormSer").get(0).disabled = false;
                if($("#ddlFormSer_basic").get(0) != undefined) $("#ddlFormSer_basic").get(0).disabled = false;
                $("#ddlFormSer option:last").attr("selected", "selected");
            }
            else
            {
                $("#ddlFormSer").get(0).disabled = true;
                if($("#ddlFormSer_basic").get(0) != undefined) $("#ddlFormSer_basic").get(0).disabled = true;
                $("#ddlFormSer option:eq(0)").attr("selected", "selected");
            }
        }
    }
    else if(strRptGubun == 2 || strRptGubun == 3 || strRptGubun == 5 || strRptGubun == 6 )
    {
        if($("input:radio[name=rbSumGubun"+ type +"]:checked").get(0).value != "4")
        {
            if($("#ddlFormSer option").length > 0)
                $("#ddlFormSer").get(0).disabled = false;

            if($("#ddlFormSer_basic").get(0) != undefined)
                $("#ddlFormSer_basic").get(0).disabled = false;

            if($("input:radio[name=rbSumGubun"+ type +"]:checked").get(0).value == "1" || $("input:radio[name=rbSumGubun"+ type +"]:checked").get(0).value == "2"){
                if($("#trDocNo").get(0) != undefined)
                {
                    $("tr[id='trDocNo']").css("display","none");
                    $("#hidtotal").get(0).value = "Y";
                }
            }
            else{
                if($("#trDocNo").get(0) != undefined)
                {
                    $("tr[id='trDocNo']").css("display","");
                    $("#hidtotal").get(0).value = "";
                }
            }
            

        }
        else
        {
            $("#ddlFormSer").get(0).disabled = true;

            if($("#ddlFormSer_basic").get(0) != undefined)
                $("#ddlFormSer_basic").get(0).disabled = true;

            if($("#trDocNo").get(0) != undefined)
            {
                $("tr[id='trDocNo']").css("display","");
                $("#hidtotal").get(0).value = "";
            }
        }
   }
    else if(strRptGubun == 35)
    {
        if($("input:radio[name=rbSumGubun"+ type +"]:checked").get(0).value == "0")
        {
            if($("#ddlFormSer option").length > 0)
                $("#ddlFormSer").get(0).disabled = false;
            
            if($("#ddlFormSer_basic").get(0) != undefined)
                $("#ddlFormSer_basic").get(0).disabled = false;

            if($("#trDocNo").get(0) != undefined)
            {
                $("tr[id='trDocNo']").css("display","");
                $("#hidtotal").get(0).value = "";
            }
        }
        else
        {
            $("#ddlFormSer").get(0).disabled = true;
             $("#ddlFormSer").get(0).value ="99999";

            if($("#ddlFormSer_basic").get(0) != undefined)
                $("#ddlFormSer_basic").get(0).disabled = true;

            if($("#trDocNo").get(0) != undefined)
            {
                $("tr[id='trDocNo']").css("display","none");
                $("#hidtotal").get(0).value = "Y";
            }
        }
    }
    else if(strRptGubun == 54 || strRptGubun == 55)
    {
        if($("input:radio[name=rbSumGubun"+ type +"]:checked").get(0).value == "1")
        {
            $("#cbExcFlag").get(0).disabled = false;
            $("#cbExcProdFlag").get(0).disabled = false;

            if($("#ddlFormSer_basic").get(0) != undefined)
            {
                $("#cbExcFlag_basic").get(0).disabled = false;
                $("#cbExcProdFlag_basic").get(0).disabled = false;
            }
        }
        else
        {
            $("#cbExcFlag").get(0).disabled = true;
            $("#cbExcProdFlag").get(0).disabled = true;

            if($("#ddlFormSer_basic").get(0) != undefined)
            {
                $("#cbExcFlag_basic").get(0).disabled = true;
                $("#cbExcProdFlag_basic").get(0).disabled = true;
            }
        }
    }
    else if(strRptGubun == 800 )
    {
        if($("input:radio[name=rbSumGubun"+ type +"]:checked").get(0).value == "1"){
            $("#lbExcFlag_basic" ).get(0).innerText = "재고수량0창고포함";
            $("#lbExcFlag").get(0).innerText = "재고수량0창고포함";
            $("#spItemChk").get(0).style.display = "";
            $("#spItemChk_basic").get(0).style.display = "";
            
            $("img[id=img_txtSWhCd]").each(function(){
                $(this).css("display","");
            });
		    if($("#hidGroupBasicDisplay").val().indexOf("txtSWhCd|1") > -1)
                $("tr[group^='txtSWhCd_B']").css("display", "");
		    if($("#hidGroupDisplay").val().indexOf("txtSWhCd|1") > -1)
                $("tr[group^='txtSWhCd_G']").css("display", "");
        }
        else{
            $("#lbExcFlag_basic").get(0).innerText="재고수량0관리항목포함";
            $("#lbExcFlag").get(0).innerText = "재고수량0관리항목포함";
            $("#spItemChk").get(0).style.display = "none";
            $("#spItemChk_basic").get(0).style.display = "none";
            $("img[id=img_txtSWhCd]").each(function(){
                $(this).css("display","none");
            });
            $("tr[group^='txtSWhCd_B']").css("display", "none");
            $("tr[group^='txtSWhCd_G']").css("display", "none");
        }
        if($("#txtSWhCd_basic").get(0) != undefined)
        {
            $("#txtSWhCd_basic").get(0).value ="";
            $("#txtSWhDes_basic").get(0).value ="";
        }
        if($("#txtItemCd_basic").get(0) != undefined)
        {
            $("#txtItemCd_basic").get(0).value ="";
            $("#txtItemDes_basic").get(0).value ="";
        }
        if($("#txtTreeWhCd_basic").get(0) != undefined)
        {
            $("#txtTreeWhCd_basic").get(0).value ="";
            $("#txtTreeWhNm_basic").get(0).value ="";
        }
        $("#txtTreeWhCd").get(0).value ="";
        $("#txtTreeWhNm").get(0).value ="";
        $("#txtSWhCd").get(0).value ="";
        $("#txtSWhDes").get(0).value ="";
        $("#txtItemCd").get(0).value ="";
        $("#txtItemDes").get(0).value ="";
    }
}
function ChangeValePFlag()
{
    if(1 == "26")
    {
        $("#hidPFlag").get(0).value = "G";
    }
}

function fnSumGubunChk(gubun,type)
{
    if (gubun == "17")
    {
        var chkval = $("input:radio[name=rbSumGubun"+ type +"]:checked").get(0).value;
        switch(chkval)
        {
            case "1":
                $("#cbMainCustFlag").get(0).disabled = false;

                if($("#cbMainCustFlag_basic").get(0) != undefined)
                    $("#cbMainCustFlag_basic").get(0).disabled = false;
                break;
            case "2":
            case "3":
                $("#cbMainCustFlag").get(0).disabled = true ;
                $("#cbMainCustFlag").get(0).checked = false ;

                if($("#cbMainCustFlag_basic").get(0) != undefined)
                {
                    $("#cbMainCustFlag_basic").get(0).disabled = true;
                    $("#cbMainCustFlag_basic").get(0).checked = false ;
                }
                break;
        }
    } else {

        if ($("#hidTabGubun").get(0).value == "1")
        {
            if($("#cbSelCode6_basic").get(0) != undefined)
            {
                if($("#cbSelCode6_basic").get(0).checked == true)
                {
                    $("#cbSelCode6").get(0).checked = $("#cbSelCode6_basic").get(0).checked;
                    $("#cbMainCustFlag").get(0).disabled = false;
                    if($("#cbMainCustFlag_basic").get(0) != undefined)
                        $("#cbMainCustFlag_basic").get(0).disabled = false;
                }
                else
                {
                    $("#cbMainCustFlag").get(0).disabled = true ;
                    $("#cbMainCustFlag").get(0).checked = false ;

                    if($("#cbMainCustFlag_basic").get(0) != undefined)
                    {
                       $("#cbMainCustFlag_basic").get(0).disabled = true;
                       $("#cbMainCustFlag_basic").get(0).checked = false ;
                    }
               }

            }
        }
        else
        {
            if ( $("#cbSelCode6").get(0).checked == true)
            {
                $("#cbMainCustFlag").get(0).disabled = false;
    
                if($("#cbSelCode6_basic").get(0) != undefined)
                    $("#cbSelCode6_basic").get(0).checked = $("#cbSelCode6").get(0).checked;
     
                if($("#cbMainCustFlag_basic").get(0) != undefined)
                    $("#cbMainCustFlag_basic").get(0).disabled = false;
            }
            else
            {
                $("#cbMainCustFlag").get(0).disabled = true ;
                $("#cbMainCustFlag").get(0).checked = false ;

                if($("#cbMainCustFlag_basic").get(0) != undefined)
                {
                    $("#cbMainCustFlag_basic").get(0).disabled = true;
                    $("#cbMainCustFlag_basic").get(0).checked = false ;
                }
            }
        }

   }
}


		
// 숫자와 날짜 유효성 체크
function fnCheckDateValidate(yearCtrl, monthCtrl, dayCtrl)
{
    if(/[^0123456789]/g.test($("#" + dayCtrl).get(0).value)) 
    {
        alert("일자를 정확하게 입력 바랍니다. ");
        if (dayCtrl == "txtSDay")
            $("#" + dayCtrl).get(0).value = "01";
        else if (dayCtrl == "txtEDay")
            $("#" + dayCtrl).get(0).value = "28";  
        else if (dayCtrl == "txtTSDay")
            $("#" + dayCtrl).get(0).value = "01";  
        else 
            $("#" + dayCtrl).get(0).value = "31";  
        $("#" + dayCtrl).get(0).focus();
    }
    var boolskip = false;
    
    if(!boolskip)
    {
        if(Number(checkDate2($("#" + yearCtrl).get(0).value, $("#" + monthCtrl).get(0).value)) < Number($("#" + dayCtrl).get(0).value))
        {
            if (checkDate2($("#" + yearCtrl).get(0).value, $("#" + monthCtrl).get(0).value) == "-1")
            {
                alert("일자를 정확하게 입력 바랍니다. ");
                $("#" + dayCtrl).get(0).value = "";
                $("#" + yearCtrl).get(0).focus();
            }    
            else
                $("#" + dayCtrl).get(0).value = checkDate2($("#" + yearCtrl).get(0).value, $("#" + monthCtrl).get(0).value);
        }

        if($("#" + dayCtrl).get(0).value.length > 0)
        {
            if($("#" + dayCtrl).get(0).value.length == 1)
            {
                if ($("#" + dayCtrl).get(0).value == "0") 
                    $("#" + dayCtrl).get(0).value = "01"
                else 
                    $("#" + dayCtrl).get(0).value = "0" + $("#" + dayCtrl).get(0).value                        
            }

            if($("#" + dayCtrl).get(0).value.length == 2 && $("#" + dayCtrl).get(0).value == "00")                                                   
                $("#" + dayCtrl).get(0).value = "01";
        }
       else
       {
            $("#" + dayCtrl).get(0).value = "01";
       }
    }

   //값 동기화 처리
    if(dayCtrl.indexOf("_basic") > -1)
        fnValueSync("_basic", dayCtrl.replace(/_basic/g,""));
    else
        fnValueSync("", dayCtrl);
} 
</script>

<script language="javascript" type="text/javascript">
<!--



function sendit(gubun) {
    if (gubun == "1"){
        if (($("#txtSDay").get(0).value < 1)||($("#txtSDay").get(0).value > 31)){
            alert("조건이 일별 / 월별 / 연별일 때는 검색할 수 없습니다.");
            $("#txtSDay").get(0).focus();
            return;
        }
        
        if (($("#txtEDay").get(0).value < 1)||($("#txtEDay").get(0).value > 31)){
            alert("조건이 일별 / 월별 / 연별일 때는 검색할 수 없습니다.");
            $("#txtEDay").get(0).focus();
            return;
        }
        
    
    }else if(gubun == "3"){
        var years = $("#ddlEYear").get(0).value;
        var months = $("#ddlEMonth").get(0).value;
        var days = $("#txtEDay").get(0).value;			

        $("#ddlSYear").get(0).value = years;
        $("#ddlSMonth").get(0).value = months;
        $("#txtSDay").get(0).value = days;
    }	
    
    var ColGubun1 = $("#ddlColGubun1").get(0).value;
    var ColGubun2 = $("#ddlColGubun2").get(0).value;
    var ColGubun3 = $("#ddlColGubun3").get(0).value;
    
    if (ColGubun3 != "") {
       if ($("input:radio[name=rbColSort1]").get(0).value == "2") {
          //alert("검색조건3 에서만 금액을 선택할 수 있습니다.");	//MSG00094, 검색조건{0} 에서만 금액을 선택할 수 있습니다.
          alert("검색조건3 에서만 [금액순]을 선택할 수 있습니다.");
          return;
          }
       if ($("input:radio[name=rbColSort2]").get(0).value == "2"){
          //alert("검색조건3 에서만 금액을 선택할 수 있습니다.");	//MSG00094, 검색조건{0} 에서만 금액을 선택할 수 있습니다.
          alert("검색조건3 에서만 [금액순]을 선택할 수 있습니다.");
          return;
          }
    } else {
       if ((ColGubun2 != "")&&($("input:radio[name=rbColSort1]").get(0).value == "2")) {
          //alert("검색조건2 에서만 금액을 선택할 수 있습니다.");	//MSG00094, 검색조건{0} 에서만 금액을 선택할 수 있습니다.
          alert("검색조건2 에서만 [금액순]을 선택할 수 있습니다.");
          return;
          }
       }
    
    					 
        document.forms[0].submit();
        LoadProgressbar.show();
}

function col_change (gubun)
{

    if (gubun == "2"){
        var col2_gubun = $('col2_gubun').value;
        if (col2_gubun == ""){			
            sub2.style.display = "none";  
        }else{
            sub2.style.display = "";  
        }	
    }else{
        var col3_gubun = $('col3_gubun').value;
        if (col3_gubun == ""){			
            sub3.style.display = "none";  
        }else{
            sub3.style.display = "";  
        }	
    }

    var col_gubun = $('col'+gubun+'_gubun').value;

    if ((col_gubun== "c_day")||(col_gubun== "c_mon")||(col_gubun== "c_year")) {
        if (gubun == "2"){
            sub2.style.display = "none";  
        }else if (gubun == "3"){
            sub3.style.display = "none";  
        }
    }
}

function Move_focus() {
        $('sday').focus();
}


function maxlength()
{
 
    var coll_gubun = $('col1_gubun').value;
    var maxlength = "0";
    
    if (coll_gubun == "")
    {
        alert("조건이 일별 / 월별 / 연별일 때는 검색할 수 없습니다.");
    }
    else if ((coll_gubun == "c_cust_group1") || (coll_gubun == "c_cust_group2"))
    {
        maxlength = "30";
    }
    else if ((coll_gubun == "c_item") || (coll_gubun == "c_pjt") || (coll_gubun == "c_prod_cd"))
    {
        maxlength = "50";
    }
    else
    {
        maxlength = "40";
    }
}

function AddOption(a,b,c,value){
/*
    var obj1 = eval(a)
    obj1.options[b] = new Option(c,value);
    obj1.value = value;
    */
//    var obj1 = eval(obj)
    //obj1.options[arrnum]=new Option(text,value);
    
    var v_value = value;
    var array_value = v_value.split("/");
    document.forms[0].elements[a].value = array_value[0];
    document.forms[0].elements[b].value = array_value[1];
    document.forms[0].elements[c].focus();

}

function goAsp(Mode)
{
    var strUrl = "http://login.ecounterp.com";
    switch(Mode)
    {
        case "2":
            alert("기존메뉴는 5월19일까지만 제공합니다.<br>5월19일 이후 다국어 지원을 위해 .net으로만 서비스 합니다.<br>업무에 착오 없으시기 바랍니다.");
            strUrl = strUrl + "/Product/Report/inputdate.asp?rpt_gubun=2";
            break;
        case "3":
            strUrl = strUrl + "/Product/Report/inputdate.asp?rpt_gubun=3";
            break;
        case "53":
            strUrl = strUrl + "/Product/Report/rpt_product.asp";
            break;
        case "54":
            strUrl = strUrl + "/Product/Report/rpt_product.asp?rpt_gubun=2";
            break;
        case "55":
            strUrl = strUrl + "/Product/Report/rpt_product.asp?rpt_gubun=3";
            break;
    }
    
    location.href = strUrl;
}

// 과세/면세관련
function gisuch(gubun){
   arrTypes = gubun.split("ㆍ");
   gubun = arrTypes[0];
  if (gubun == "99"){
    document.all['ddlTaxAtion'].style.visibility = "visible";

    if(document.all['ddlTaxAtion_basic'] != undefined)
        document.all['ddlTaxAtion_basic'].style.visibility = "visible";
  }else{
    document.all['ddlTaxAtion'].style.visibility = "hidden";

    if(document.all['ddlTaxAtion_basic'] != undefined)
        document.all['ddlTaxAtion_basic'].style.visibility = "hidden";
  }
}

function ExcelPageMovement2(gubun) {
      
    var ErrFlag = "N";
    var str = $("#frmSearch").formToArray();								
    for (var i = 0; i < str.length; i++) {
        if (str[i].name != "hidSearchXml") {
            if (str[i].value.indexOf("'") > -1 || str[i].value.indexOf('"') > -1)
            {
                ErrFlag = "Y";
                str[i].value = fnReplace(str[i].value, "'", "");
                str[i].value = fnReplace(str[i].value, '"', "");
                if ($("#"+str[i].name).length > 0) {
                    $("#"+str[i].name).get(0).value = str[i].value;
                } else {
                    if (document.getElementsByName(str[i].name).length>0){
                        document.getElementsByName(str[i].name)[0].value = str[i].value;
                    }
                }
            }                
        }
    }

    if (ErrFlag == "Y") {
        alert('\’ 또는 \" 기호는 검색할 수 없습니다.');
        return false;
    }

    var FormURL = "";
    if (gubun == "200")
        FormURL = "../ESD/ESD007E_01.aspx?exFirstFlag="+$("#hidFistFlag").get(0).value;
    else if (gubun == "201")
        FormURL = "../ESD/ESD005E_01.aspx?exFirstFlag="+$("#hidFistFlag").get(0).value;
    else if (gubun == "204")
        FormURL = "../ESG/ESG005E_01.aspx?exFirstFlag="+$("#strFistFlag").get(0).value;
    else if (gubun == "205")
        FormURL = "../ESG/ESG010E_01.aspx?exFirstFlag="+$("#hidFistFlag").get(0).value;
    else if (gubun == "203")
        FormURL = "../ESD/ESD002E_01.aspx?exFirstFlag="+$("#hidFistFlag").get(0).value;
    else if (gubun == "206")
        FormURL = "../ESG/ESG019E_01.aspx?exFirstFlag="+$("#strFistFlag").get(0).value;    
    else if (gubun == "400")
        FormURL = "../ESJ/ESJ005E_02.aspx?exFirstFlag="+$("#hidFirstFlag").get(0).value;
    else if (gubun == "410")
        FormURL = "../ESJ/ESJ007E_01.aspx?exFirstFlag="+$("#hfCurentPage").get(0).value;
    else if (gubun == "420")
        FormURL = "../ESJ/ESJ010E_01.aspx?exFirstFlag="+$("#hfCurentPage").get(0).value;
    else if (gubun == "600")
        FormURL = "../ESM/ESM002E_01.aspx?exFirstFlag="+$("#hfCurentPage").get(0).value;
    else if (gubun == "610")
        FormURL = "../ESM/ESM004E_01.aspx?io_type=59&exFirstFlag="+$("#hfCurentPage").get(0).value;
    else if (gubun == "500")
        FormURL = "../ESM/ESM006E_01.aspx?exFirstFlag="+$("#hfCurentPage").get(0).value;
    else if (gubun == "560")
        FormURL = "../ESM/ESM004E_01.aspx?io_type=58&exFirstFlag="+$("#hfCurentPage").get(0).value;
    else if (gubun == "561")
        FormURL = "../ESM/ESM004E_01.aspx?io_type=60&exFirstFlag="+$("#hfCurentPage").get(0).value;
    else if (gubun == "760")
        FormURL = "../ESQ/ESQ401E.aspx?exFirstFlag="+$("#hfCurentPage").get(0).value;
    else if (gubun == "770")
        FormURL = "../ESE/ESE002E_01.aspx";
    else if (gubun == "780")
        FormURL = "../ESE/ESE005E_01.aspx";
    else if (gubun == "781")
        FormURL = "../ESE/ESE007E.aspx";
    else if (gubun == "721")
        FormURL = "../ESQ/ESQ200E.aspx";
    else if (gubun == "209")
        FormURL = "../ESD/ESD028E.aspx";
    else
        FormURL = "../ESG/ESG002E_01.aspx?exFirstFlag="+$("#strFistFlag").get(0).value; //(gubun == "207")
    
    if(gubun == "770" ||</brun == "780" || gubun == "781" || gubun == "721") {
        FormURL = FormURL + "?hidSTETOrderPopupFlag=" + $("#hidStetOrderFlag").get(0).value;
    } else if (gubun == "209"){
        FormURL = FormURL + "?ddlTempIndex=";
    }else{
        FormURL = FormURL + "&hidSTETOrderPopupFlag=" + $("#hidStetOrderFlag").get(0).value;
    }

    //하단의 ifrmExcel2 구분값 추가 해줘야 해당 새창 뜨는 현상이 사라 집니다. 참고 하세요.
    $("#frmSearch").get(0).method = "post";
    $("#frmSearch").get(0).action = fnSetUrlPath(FormURL,"ec_req_sid");
    $("#frmSearch").get(0).target = "ifrmExcel2";
    $("#frmSearch").submit();
    $("#frmSearch").get(0).target = ""; 
    $("#frmSearch").get(0).action = fnSetUrlPath("/ECMain/ESZ/ESZ003R.aspx","ec_req_sid");
        
}
			


 function fnGetDataSummary(strUrl, strData) {
            $.ajax({
                type: "POST",
                async: false,
                //dataType: "text",
                url: fnSetUrlPath(strUrl,"ec_req_sid"),
                data: strData,
                error: function (errorMsg) {
                    alert("에러발생\nfnGetData:" + errorMsg);
                    //  return false;
                },
                success: function (returnXml) {
                    return false;

                }
            });
        }


//재고수불부2 관련 이벤트================================================================
//각 단가항목에서 재고단가 선택시 월별이익 항목 보여주기
function WongaChk1(type)
{
    if($("#ddlWongaType1" + type).get(0).value == "2")
    {
        $("#ddlGisu1").get(0).style.display = "";

        if($("#ddlGisu1_basic").get(0) != undefined)
            $("#ddlGisu1_basic").get(0).style.display = "";

        if($("#ddlGisu1" + type).get(0).length == 1)
        {
            $("#ddlWongaType1").get(0).value == "1";

            if($("#ddlWongaType1_basic").get(0) != undefined)
                $("#ddlWongaType1_basic").get(0).value == "1";
            return false;
        }
        else
        {            

            if("" == "")
            {
                $("select[name=ddlGisu1]").get(0).selectedIndex = 1;

                if($("select[name=ddlGisu1_basic]").get(0) != undefined)
                    $("select[name=ddlGisu1_basic]").get(0).selectedIndex = 1;
            }
            else
            {
                $("select[name=ddlGisu1]").get(0).value = "";

                if($("select[name=ddlGisu1_basic]").get(0) != undefined)
                    $("select[name=ddlGisu1_basic]").get(0).value = "";
            }
        }
    }
    else
    {
        $("#ddlGisu1").get(0).style.display = "none";

        if($("#ddlGisu1_basic").get(0) != undefined)
            $("#ddlGisu1_basic").get(0).style.display = "none";
    }
}
function WongaChk2(type)
{
    if($("#ddlWongaType2" + type).get(0).value == "2")
    {
        $("#ddlGisu2").get(0).style.display = "";
        
        if($("#ddlGisu2_basic").get(0) != undefined)
            $("#ddlGisu2_basic").get(0).style.display = "";

        if($("#ddlGisu2" + type).get(0).length == 1)
        {
            $("#ddlWongaType2").get(0).value == "1";

            if($("#ddlWongaType2_basic").get(0) != undefined)
                $("#ddlWongaType2_basic").get(0).value == "1";
            return false;
        }
        else
        {            

            if("" == "")
            {
                $("select[name=ddlGisu2]").get(0).selectedIndex = 1;

                if($("select[name=ddlGisu2_basic]").get(0) != undefined)
                    $("select[name=ddlGisu2_basic]").get(0).selectedIndex = 1;
            }
            else
            {
                $("select[name=ddlGisu2]").get(0).value = "";

                if($("select[name=ddlGisu2_basic]").get(0) != undefined)
                    $("select[name=ddlGisu2_basic]").get(0).value = "";
            }
        }
    }
    else
    {
        $("#ddlGisu2").get(0).style.display = "none";

        if($("#ddlGisu2_basic").get(0) != undefined)
            $("#ddlGisu2_basic").get(0).style.display = "none";
    }
}
function WongaChk3(type)
{
    if($("#ddlWongaType3" + type).get(0).value == "2")
    {
        $("#ddlGisu3").get(0).style.display = "";

        if($("#ddlGisu3_basic").get(0) != undefined)
            $("#ddlGisu3_basic").get(0).style.display = "";

        if($("#ddlGisu3" + type).get(0).length == 1)
        {
            $("#ddlWongaType3").get(0).value == "1";

            if($("#ddlWongaType3_basic").get(0) != undefined)
                $("#ddlWongaType3_basic").get(0).value == "1";
            return false;
        }
        else
        {            

            if("" == "")
            {
                $("select[name=ddlGisu3]").get(0).selectedIndex = 1;

                if($("select[name=ddlGisu3_basic]").get(0) != undefined)
                    $("select[name=ddlGisu3_basic]").get(0).selectedIndex = 1;
            }
            else
            {
                $("select[name=ddlGisu3]").get(0).value = "";

                if($("select[name=ddlGisu3_basic]").get(0) != undefined)
                    $("select[name=ddlGisu3_basic]").get(0).value = "";
            }
        }
    }
    else
    {
        $("#ddlGisu3").get(0).style.display = "none";

        if($("#ddlGisu3_basic").get(0) != undefined)
            $("#ddlGisu3_basic").get(0).style.display = "none";
    }
}

//월별이익 항목 선택시
function GisuChk2(type)
{
    if($("#ddlGisu1" + type).get(0).length == 1)
    {
        //alert("MSG00904"+"MSG00905");
        return;
    }

    if($("#ddlGisu2" + type).get(0).length == 1)
    {
        //alert("MSG00904"+"MSG00905");
        return;
    }

    if($("#ddlGisu3" + type).get(0).length == 1)
    {
        //alert("MSG00904"+"MSG00905");
        return;
    }
}

//단가표시 라디오버튼 이벤트 - 표시클릭시 하단 항목 보여주기
function fnDangaCheck(type)
{
    if($("input:radio[name=rbDanga"+ type +"]:checked").get(0).value == "0")
    {
        for( var i=1; i <4; i++ ){
            $("#trDanga"+i).get(0).style.display = "none";

            if($("#trDanga"+i+"_basic").get(0) != undefined)
                $("#trDanga"+i+"_basic").get(0).style.display = "none";
        }   
            $("[name=AmtFlag]").hide();     		
    }
    else
    { 
        for( var i=1; i <4; i++ ){
            $("#trDanga"+i).get(0).style.display = "";

            if($("#trDanga"+i+"_basic").get(0) != undefined)
                $("#trDanga"+i+"_basic").get(0).style.display = "";
        } 
            $("[name=AmtFlag]").show();
        if("N" == "N")
            WongaChk1("");
    }
}

//재고수불부1,2 품목구분 라디오버튼 이벤트 - 입출고수량 0제외 보여주기
function fn_ChkValue(obj) {
    //if("1" == "1" || "1" == "56")
    //{
    //    var chkVal = obj.value;
        
    //    if(chkVal != "") {
    //        $("#cbZeroFlag2").get(0).style.display = "none";
    //        $("#spZeroFlag2").get(0).style.display = "none";
    //    }
    //    else {
    //        $("#cbZeroFlag2").get(0).style.display = "";
    //        $("#spZeroFlag2").get(0).style.display = "";
    //    }
    //}
}
  //재고실사입력2에서 관리항목이 입력되지 않은 수량 체크박스 체크시 관리항목 검색값 제거
    function fn_ItemClick()
    {
        if($("#cbItemChk_basic").get(0).checked == true )
        {
            $("#txtItemCd_basic").get(0).value = "";
            $("#txtItemCd").get(0).value = "";
            $("#txtItemDes_basic").get(0).value = "";
            $("#txtItemDes").get(0).value = "";
        }
    }

function fnSimpleSearch(sdate, edate){
    if("N"=="Y"){
        $("#ddlSYear").get(0).value = sdate.split(",")[0];
        $("#ddlSMonth").get(0).value = sdate.split(",")[1];
        $("#txtSDay").get(0).value = sdate.split(",")[2];
        $("#ddlSYear_basic").get(0).value = sdate.split(",")[0];
        $("#ddlSMonth_basic").get(0).value = sdate.split(",")[1];
        $("#txtSDay_basic").get(0).value = sdate.split(",")[2];

        if("1" == "209" ){
            $("#ddlTSYear").get(0).value = sdate.split(",")[0];
            $("#ddlTSMonth").get(0).value = sdate.split(",")[1];
            $("#txtTSDay").get(0).value = sdate.split(",")[2];
            if($("#ddlTSYear_basic").get(0) != null)
            {
                $("#ddlTSYear_basic").get(0).value = sdate.split(",")[0];
                $("#ddlTSMonth_basic").get(0).value = sdate.split(",")[1];
                $("#txtTSDay_basic").get(0).value = sdate.split(",")[2];
            }
        }   
    }else if("Y"=="Y"){
        if(sdate == "EndDay"){  // 종료일
            
            // pms : 770,69(출하지시서) / 780,78(출하조회,현황) / 610,18(자가사용조회,현황) / 500,44(불량처리조회,현황) / 410,6(생산불출조회,현황) / 600,4 (창고이동조회, 현황) / 400,25,30(작업지시서조회, 현황, 작업지시서별진행현황) / 203,11,13(견적서조회, 현황, 미주문현황) / 207(발주계획조회) / 206,65(발주요청조회 , 현황) / 240(단가요청조회), 810 View transactions
            if("1" =="203" || "1" == "11" || "1" =="13" || "1" =="2" || "1" =="12" || "1" =="5" || "1" =="15" 
                || "1" =="16" || "1" =="3" || "1" =="201" || "1" =="200" || "1" =="420" || "1" =="204" || "1" =="205" 
                || "1" == "770" || "1" =="69" || "1" == "780" || "1" =="78" || "1" =="610" || "1" =="18" || "1" =="500" 
                || "1" =="44" || "1" =="410" || "1" =="6" || "1" =="600" || "1" =="400" || "1" =="25" || "1" =="30" 
                || "1" =="203" || "1" =="11" || "1" =="13" || "1" =="207" || "1" =="206" || "1" =="65" || "1" =="240" 
                || "1" =="4" || "1" == "721" || "1" =="212" || "1" == "810" || "1" == "58" || "1" =="811" || "1" =="791")
            {
                var objselectedval =$("#ddlEYear option:selected").val();
                var options = $("#ddlEYear > option").clone();
                $("#ddlSYear > option").remove();
                $("#ddlSYear").append(options);
                $("#ddlSYear").val(objselectedval);
                var objselectedval_basic =$("#ddlEYear_basic option:selected").val();
                var options_basic = $("#ddlEYear_basic > option").clone();
                $("#ddlSYear_basic > option").remove();
                $("#ddlSYear_basic").append(options_basic);
                $("#ddlSYear_basic").val(objselectedval_basic);
            }
            $("#ddlSYear").get(0).value = $("#ddlEYear").get(0).value;
            $("#ddlSMonth").get(0).value = $("#ddlEMonth").get(0).value;
            $("#txtSDay").get(0).value = $("#txtEDay").get(0).value;
            $("#ddlSYear_basic").get(0).value = $("#ddlEYear_basic").get(0).value;
            $("#ddlSMonth_basic").get(0).value = $("#ddlEMonth_basic").get(0).value;
            $("#txtSDay_basic").get(0).value = $("#txtEDay_basic").get(0).value;

            if("1" == "209"){
            $("#ddlTSYear").get(0).value = $("#ddlEYear").get(0).value;
            $("#ddlTSMonth").get(0).value = $("#ddlEMonth").get(0).value;
            $("#txtTSDay").get(0).value = $("#txtEDay").get(0).value;
            $("#ddlSYear_basic").get(0).value = $("#ddlEYear_basic").get(0).value;
            $("#ddlTSMonth_basic").get(0).value = $("#ddlEMonth_basic").get(0).value;
            $("#txtTSDay_basic").get(0).value = $("#txtEDay_basic").get(0).value;

        }   

        }else if(sdate == "Year")   //이번기수
            //$("#ddlSYear").get(0).value 
            //$("#ddlSMonth").get(0).value 
            //$("#txtSDay").get(0).value 
            //$("#ddlEYear").get(0).value 
            //$("#ddlEMonth").get(0).value 
            //$("#txtEDay").get(0).value 
        {
        }else if(sdate == "LastYear")   // 직전기수
            //$("#ddlSYear").get(0).value 
            //$("#ddlSMonth").get(0).value 
            //$("#txtSDay").get(0).value 
            //$("#ddlEYear").get(0).value 
            //$("#ddlEMonth").get(0).value 
            //$("#txtEDay").get(0).value 
        {
        }else{
            $("#ddlSYear").get(0).value = sdate.split(",")[0];
            $("#ddlSMonth").get(0).value = sdate.split(",")[1];
            $("#txtSDay").get(0).value = sdate.split(",")[2];
            $("#ddlEYear").get(0).value = edate.split(",")[0];
            $("#ddlEMonth").get(0).value = edate.split(",")[1];
            $("#txtEDay").get(0).value = edate.split(",")[2];       
            $("#ddlSYear_basic").get(0).value = sdate.split(",")[0];
            $("#ddlSMonth_basic").get(0).value = sdate.split(",")[1];
            $("#txtSDay_basic").get(0).value = sdate.split(",")[2];
            $("#ddlEYear_basic").get(0).value = edate.split(",")[0];
            $("#ddlEMonth_basic").get(0).value = edate.split(",")[1];
            $("#txtEDay_basic").get(0).value = edate.split(",")[2];  
            
            if("1" == "209"){
                $("#ddlTSYear").get(0).value = sdate.split(",")[0];
                $("#ddlTSMonth").get(0).value = sdate.split(",")[1];
                $("#txtTSDay").get(0).value = sdate.split(",")[2];
                $("#ddlTEYear").get(0).value = edate.split(",")[0];
                $("#ddlTEMonth").get(0).value = edate.split(",")[1];
                $("#txtTEDay").get(0).value = edate.split(",")[2];  
                if($("#ddlTSYear_basic").get(0) != null)
                {     
                    $("#ddlTSYear_basic").get(0).value = sdate.split(",")[0];
                    $("#ddlTSMonth_basic").get(0).value = sdate.split(",")[1];
                    $("#txtTSDay_basic").get(0).value = sdate.split(",")[2];
                    $("#ddlTEYear_basic").get(0).value = edate.split(",")[0];
                    $("#ddlTEMonth_basic").get(0).value = edate.split(",")[1];
                    $("#txtTEDay_basic").get(0).value = edate.split(",")[2];
                }
            }   
        }
    }


    searchit();
}

function searchit()
{
    frmSearchData();
}
function MM_showHideLayers1(gubun) { //v6.0
    for (i=1; i < 3;i++)
    {
        if (i == gubun)
        {
            $("#tab"+i).get(0).className = "nav_tabon";
            $("#tab0"+i).get(0).style.display = "block";
        }
        else
        {
             $("#tab"+i).get(0).className = "";
             $("#tab0"+i).get(0).style.display = "none";
        }
    }
    $("#hidTabGubun").get(0).value = gubun;
    //TabChangeFocus();
}

// 부서 계층그룹 조회갯수 체크
function fnSubTreeSiteChange(obj, type)
{
    if ($("#cbSubTreeSite" + type).get(0).checked)
    {
        var strValueCode = $("#txtTreeSiteCd" + type).get(0).value;
        if (strValueCode.split('ㆍ').length > 1)
        {
            alert("하위 그룹 포함 검색의 경우에는 1개의 그룹만 선택 가능합니다.");
            obj.checked = false;
        }
    }

    fnValueSync(type,'cbSubTreeSite');
}


function fnSubTreeGroupChange(obj, type)
{
    if ($("#cbSubTreeG" + type).get(0).checked)
    {
        var strValueCode = $("#txtTreeGroupCd" + type).get(0).value;
        if (strValueCode.split('ㆍ').length > 1)
        {
            alert("하위 그룹 포함 검색의 경우에는 1개의 그룹만 선택 가능합니다.");
            obj.checked = false;
        }
    }

    fnValueSync(type,'cbSubTreeG');
}

function fnSubTreeCustChange(obj, type)
{
    if ($("#cbSubTreeCust" + type).get(0).checked)
    {
        var strValueCode = $("#txtTreeCustCd" + type).get(0).value;
        if (strValueCode.split('ㆍ').length > 1)
        {
            alert("하위 그룹 포함 검색의 경우에는 1개의 그룹만 선택 가능합니다.");
            obj.checked = false;
        }
    }

    fnValueSync(type,'cbSubTreeCust');
}
// 창고계층그룹 조회갯수 체크
function fnSubTreeWhChange(obj, type)
{
    if ($("#cbSubTreeWh" + type).get(0).checked)
    {
        var strValueCode = $("#txtTreeWhCd" + type).get(0).value;
        if (strValueCode.split('ㆍ').length > 1)
        {
            alert("하위 그룹 포함 검색의 경우에는 1개의 그룹만 선택 가능합니다.");
            obj.checked = false;
        }
    }

    fnValueSync(type,'cbSubTreeWh');
}

// 기타창고만
function fnEtcWhCdOnlyChange(obj, type)
{
    if ($("#cbEtcWhCdOnly" + type).get(0).checked)
    {
	if($("#txtSWhCd").length > 0)
        {
           $("#txtSWhCd").val("");
           $("#txtSWhDes").val("");
	   $("#txtSWhCd").attr("disabled",true);
        }
        if($("#txtSWhCd_basic").length > 0)
        {
           $("#txtSWhCd_basic").val("");
           $("#txtSWhDes_basic").val("");
	   $("#txtSWhCd_basic").attr("disabled",true);
        }
    }
    else
    {
	if($("#txtSWhCd").length > 0)
        {
           $("#txtSWhCd").attr("disabled",false);
        }
        if($("#txtSWhCd_basic").length > 0)
        {
           $("#txtSWhCd_basic").attr("disabled",false);
        }
    }
    fnValueSync(type,'cbEtcWhCdOnly');
}


//월별일 경우 일자 세팅
function fnChkMemo(chkVal)
{
    if($("input:radio[name=rbSumGubun]:checked").get(0).value == "1"){
        var eYear = $("#ddlEYear").get(0).value;
        var eMonth = $("#ddlEMonth").get(0).value;
        var eEday = "01";
        var setDate = new Date(eYear, eMonth);
        $("#txtSDay").get(0).value = "01";
        $("#txtEDay").get(0).value = checkDate2(eYear, eMonth);
        $("#txtSDay").get(0).disabled = true;
        $("#txtEDay").get(0).disabled = true;
    }
    else{
        $("#txtSDay").get(0).disabled = false;
        $("#txtEDay").get(0).disabled = false;
    }
}

function ZeroItem(type)
{
    if ($("#cbJunFlag" + type).get(0).checked)
    {    
        $("#cbZeroItemFlag").get(0).checked = false;
        $("#cbZeroItemFlag").get(0).disabled = true; 

        if($("#cbZeroItemFlag_basic").get(0) != undefined)
        {
            $("#cbZeroItemFlag_basic").get(0).checked = false;
            $("#cbZeroItemFlag_basic").get(0).disabled = true;
        }
    }
    else
    {
        $("#cbZeroItemFlag").get(0).disabled = false; 

        if($("#cbZeroItemFlag_basic").get(0) != undefined)
            $("#cbZeroItemFlag_basic").get(0).disabled = false; 
    }
}

function fnBomFlagCheck(type) {
    if( "1" == "30" ) {
        var SumGubun = $("input:radio[name=rbSumGubun"+ type +"]:checked");
        if(SumGubun.get(0).value == "3")
        {
            $("#cbBomFlag").get(0).disabled = true;

            if($("#cbBomFlag_basic").get(0) != undefined)
                $("#cbBomFlag_basic").get(0).disabled = true;
        }
        else
        {
            $("#cbBomFlag").get(0).disabled = false;

            if($("#cbBomFlag_basic").get(0) != undefined)
                $("#cbBomFlag_basic").get(0).disabled = false;
        }
    }
}


//재고집계표(rtpGubun=41, 42, 43) 비교 체크
function fnCheckCompare(type)
{
    if($("#chkCompareFlag" + type).get(0).checked == true)
    {
        $("#ddlCompareGubun").get(0).style.display = "";

        if($("#ddlCompareGubun_basic").get(0) != undefined)
            $("#ddlCompareGubun_basic").get(0).style.display = "";
    }
    else
    {
        $("#ddlCompareGubun").get(0).style.display = "none";

        if($("#ddlCompareGubun_basic").get(0) != undefined)
            $("#ddlCompareGubun_basic").get(0).style.display = "none";
    }
}

function rbSumGubunChk(type)
{
    var SumGubun = $("input:radio[name=rbSumGubun"+ type +"]:checked").get(0).value;
    var strXml = "<root>";
    
    var str = $("#frmSearch").formToArray();
    for (var i = 0; i < str.length; i++) {
        if (str[i].name != "hidSearchXml") {
            strXml += "<" + str[i].name + "><![CDATA[" + str[i].value + "]]></" + str[i].name + ">";
        }
    }
    strXml  += "<M_RptGubun><![CDATA[1]]></M_RptGubun><M_FormGubun><![CDATA[SO623]]></M_FormGubun><M_SortAD></M_SortAD><M_Sort></M_Sort><M_FocusX><![CDATA[0]]></M_FocusX><M_FocusY><![CDATA[0]]></M_FocusY><M_Date></M_Date><M_No><![CDATA[0]]></M_No><M_SerNo><![CDATA[1]]></M_SerNo><M_Type></M_Type><M_TrxDate></M_TrxDate><M_TrxNo><![CDATA[0]]></M_TrxNo><M_Pgm></M_Pgm><M_Page><![CDATA[1]]></M_Page><M_EdmsFlag><![CDATA[N]]></M_EdmsFlag><M_EditFlag><![CDATA[M]]></M_EditFlag><M_FirstFlag></M_FirstFlag><M_PFlag><![CDATA[]]></M_PFlag>";
    if("1" == "209" ) {
        strXml += "<M_ddlTempIndex><![CDATA[]]></M_ddlTempIndex>";
    }
    strXml += "</root>";



    $("#frmSearch").get(0).hidSearchXml.value = strXml;
    $("#frmSearch").get(0).action = fnSetUrlPath("/ECMain/CM3/CM_Search_Sale2_Main.aspx?RptGubun=71&&rbSumGubun=" + SumGubun,"ec_req_sid");
    $("#frmSearch").get(0).submit();
    LoadProgressbar.show();
}

// 생산불출/창고이동 포함 체크 설정
function SetCheckBoxMoveStore()
{
    // 재고수불부1, 2
    if ("1" == "1" || "1" == "56")
    {
        if ($("#txtSWhCd").val() == "" )
            $("#cbMoveStore").attr("disabled","").attr("checked", "");
        else
            $("#cbMoveStore").attr("disabled","disabled").attr("checked", "checked");

        if($("#txtSWhCd_basic").get(0) != undefined)
        {
            if ($("#txtSWhCd_basic").val() == "")
                $("#cbMoveStore_basic").attr("disabled","").attr("checked", "");
            else
                $("#cbMoveStore_basic").attr("disabled","disabled").attr("checked", "checked");
        }
    }
}

// 거래처별 채권 채무
function fnEtcChkSer()
{
    var StrddlFormSer  = $("#ddlFormSer").get(0).value;

	if ((1 == "22" || 1 == "23") && StrddlFormSer !="99999")
	{
        $("#cbSumEmpGubun").get(0).disabled = true;
        $("#cbAgeGubun").get(0).disabled = true;

        if($("#cbSumEmpGubun_basic").get(0) != undefined)
        {
            $("#cbSumEmpGubun_basic").get(0).disabled = true;
            $("#cbAgeGubun_basic").get(0).disabled = true;
        }

        if (1 == "22")
        {
            $("#cbCustLimitFlag").get(0).disabled = true;

            if($("#cbCustLimitFlag_basic").get(0) != undefined)
                $("#cbCustLimitFlag_basic").get(0).disabled = true;
        }
    }
    else
    {
        if (1 == "22" || 1 == "23")
        {
            $("#cbSumEmpGubun").get(0).disabled = false;
            $("#cbAgeGubun").get(0).disabled = false;

            if($("#cbSumEmpGubun_basic").get(0) != undefined)
            {
                $("#cbSumEmpGubun_basic").get(0).disabled = false;
                $("#cbAgeGubun_basic").get(0).disabled = false;
            }
       
            if (1 == "22")
            {
                $("#cbCustLimitFlag").get(0).disabled = false;

                if($("#cbCustLimitFlag_basic").get(0) != undefined)
                    $("#cbCustLimitFlag_basic").get(0).disabled = false;
            }
        }
    }
    
       
}

// 양식설정팝업호출
function fnPopTemplate() {
    var strUrl = "/ECMain/CM3/CM100P_02.aspx?FORM_GUBUN=SO623";

    if ("SO623" == "SO770") {
        var strFormSeq = $("#ddlFormSer").val();
        strUrl = strUrl + "&FORM_SER=" + strFormSeq;
    }
    else if("SO623" == "SM721"){
		var IoGubun = "SO721";
		if($("input:radio[name=rbGubunChk]:checked").get(0).value == "1")	IoGubun = "SO721";
		else if($("input:radio[name=rbGubunChk]:checked").get(0).value == "2")	IoGubun = "SO722";
		else if($("input:radio[name=rbGubunChk]:checked").get(0).value == "3")	IoGubun = "SO723";
        strUrl = "/ECMain/CM3/CM100P_02.aspx?form_gubun=" + IoGubun;	
	}
    else if("SO623" == "SM720"){ 
		var IoGubun = "SO720";
		if($("input:radio[name=rbGubunChk]:checked").get(0).value == "1")	IoGubun = "SO720";
		else if($("input:radio[name=rbGubunChk]:checked").get(0).value == "2")	IoGubun = "SO724";
        strUrl = "/ECMain/CM3/CM100P_02.aspx?form_gubun=" + IoGubun;	
	}
    else if("SO623" == "SM811"){
		var IoGubun = "SO811";
        var strFormSeq = "9999";

        if ($("#ddlFormSer").get(0).options.length > 0)
            strFormSeq = $("#ddlFormSer").val();

        strUrl = "/ECMain/CM3/CM100P_02.aspx?form_gubun=" + IoGubun + "&FORM_SER=" + strFormSeq;
	}
    else if("1" == "791"){ 
        if ($("#ddlFormSer").get(0).options.length > 0)
            strFormSeq = $("#ddlFormSer").val();
        else
            strFormSeq = "1";
		var IoGubun = "AO310";
       		strUrl = "/ECMain/CM3/CM100P_02.aspx?form_gubun=" + IoGubun + "&FORM_SER=" + strFormSeq;	
	}
    //신규프레임웍-수퍼양식설정    
    if("SO623" == "SO030"){
        fnFormSettingOpen('/ECERP/Popup.Form/CM100P_51?FORM_TYPE=SO030&popupType=window&parentPageID=CMSEARCHOLD','CM100P_51','Y','500' ,'500');
    }else{
        fnFormSettingOpen(strUrl,'CM100P_02','Y','800' ,'700');
    }
}

//검색항목 그룹 display 처리
function fnSubItemOpen(obj, grouping, tabgubun)
{
    var groupobj ;
	
	if(tabgubun == "1")
		groupobj = $("tr[group^='"+ grouping +"_B']");
	else
		groupobj = $("tr[group^='"+ grouping +"_G']");
	
    if(obj.src.indexOf("footer_arrow_down.gif") > -1) 
    {
        obj.src = "/ECMain/ECount.Common/Images/footer_arrow_up.gif";
        groupobj.css("display", "");
    }
    else 
    {
        obj.src = "/ECMain/ECount.Common/Images/footer_arrow_down.gif";
        groupobj.css("display", "none");
    }

    fnGroupDisplayVal(tabgubun);
}
//값 동기화
function fnValueSync(type, targetId)
{
    var obj = $("#" + targetId + type);
    var objTarget = $("#" + targetId + (type == "" ? "_basic" : ""));
    var tagName = obj.get(0).tagName.toLowerCase();
    
    if(objTarget != null && objTarget.get(0) != undefined)
    {
        objTarget.get(0).value = obj.get(0).value;

        if(obj.get(0).type == "checkbox" || obj.get(0).type == "radio")
        {
            if(obj.get(0).type == "checkbox")
            {
                if(obj.get(0).checked)
                    objTarget.get(0).checked = true;
                else
                    objTarget.get(0).checked = false;
            }
            else
                objTarget.get(0).checked = true;
        }
    }

    if("1" == "21")//일별이익현황
        fnDayliWongaChange();
}

//일별이익현황이고 품목별/재고단가 일때
function fnDayliWongaChange()
{
    var wonga_gubun = "";
    var etc_gubun = "";

    if($("#ddlWongaType_basic").get(0) != undefined)
        wonga_gubun = "_basic";
    if($("#cbMainProdFlag_basic").get(0) != undefined)
        etc_gubun = "_basic";

    if($("#ddlWongaType" + wonga_gubun).get(0).value == "3" && $("input:radio[name=rbSumGubun]:checked").get(0).value == "2")
    {
        if($("select[name=ddlGisu"+ wonga_gubun +"]").get(0) != undefined)
        {
            if( $("select[name=ddlGisu"+ wonga_gubun +"]").get(0).value != "" )
            {
                var gisu_value  = $("select[name=ddlGisu"+ wonga_gubun +"]").get(0).value.split("/");
                if( gisu_value.length >= 2 )
                {
                    var wonga_value = gisu_value[2];
                    $("#cbMainProdFlag" + etc_gubun).get(0).disabled = true;
                    if( wonga_value == "1" )
                    {
                        $("#cbMainProdFlag").get(0).checked = true;
                        $("#cbMainProdFlag" + etc_gubun).get(0).checked = true;
                    }
                    else
                    {
                        $("#cbMainProdFlag").get(0).checked = false;
                        $("#cbMainProdFlag" + etc_gubun).get(0).checked = false;
                    }
                }
                else
                    $("#cbMainProdFlag" + etc_gubun).get(0).disabled = false;
            }
            else
                $("#cbMainProdFlag" + etc_gubun).get(0).disabled = false;
        }
        else
            $("#cbMainProdFlag" + etc_gubun).get(0).disabled = false;
    }
    else
        $("#cbMainProdFlag" + etc_gubun).get(0).disabled = false;
}

//그룹 열닫 상태저장
function fnGroupDisplayVal(tabgubun)
{
    var imgElement;
	
	if (tabgubun == "1")
		imgElement = $("#tab01 img");
	else
		imgElement = $("#tab02 img");
	
    var gorupingStr = "";

    imgElement.each(function (){
        if($(this).attr("id") != "undefined" && $(this).attr("id").indexOf("img_") > -1)
        {
            gorupingStr += $(this).attr("id").replace(/img_/g,"") + "|" + ($(this).attr("src").indexOf("footer_arrow_up") > -1 ? "1" : "0") + ",";
        }
    });

	if(tabgubun == "1")
		$("#hidGroupBasicDisplay").val(gorupingStr.substr(0,gorupingStr.lastIndexOf(",")));
	else
		$("#hidGroupDisplay").val(gorupingStr.substr(0,gorupingStr.lastIndexOf(",")));
	
}
//그룹 열닫 세팅
function fnGroupDisplaySet()
{
    var groupDisplayVals = $("#hidGroupDisplay").val();
	var groupBasicDisplayVals = $("#hidGroupBasicDisplay").val();
	
    var arrGroupDisplay = groupDisplayVals.split(",");
	var arrGroupBasicDisplay = groupBasicDisplayVals.split(",");
	
    var groupDisplayCnt = arrGroupDisplay.length;
	var groupBasicDisplayCnt = arrGroupBasicDisplay.length;
	var arrGDValue = "";
	// 기본항목
	if (groupBasicDisplayVals != "")
	{
		for(var i=0;i<groupBasicDisplayCnt;i++)
        {
            arrGDValue = arrGroupBasicDisplay[i].split("|");
            if(arrGDValue.length > 1)
            {
                var imgArrowObj = $("#tab01 img[id='img_"+ arrGDValue[0] +"']");
                var groupObj = $("tr[group^='"+ arrGDValue[0] +"_B']");              

                if(arrGDValue[1] == "1") 
                {
                    imgArrowObj.attr("src", "/ECMain/ECount.Common/Images/footer_arrow_up.gif");
                    groupObj.css("display", "");
                }
                else 
                {
                    imgArrowObj.attr("src", "/ECMain/ECount.Common/Images/footer_arrow_down.gif");
                    groupObj.css("display", "none");
                }
            }
        }
	}
	else
	{
		$("#tab01 img").each(function (){
            if($(this).attr("id") != "undefined" && $(this).attr("id").indexOf("img_") > -1)
            {
                var groupObjId = $(this).attr("id").replace(/img_/g,"");
                $("#tab01 img[id='img_"+ groupObjId +"']").attr("src", "/ECMain/ECount.Common/Images/footer_arrow_down.gif");
				//$("tr[group^='"+ groupObjId +"_B']").css("display", "none");
            }
        });
	}
	// 전체항목
    if(groupDisplayVals != "")
    {
		for(var i=0;i<groupDisplayCnt;i++)
        {
            arrGDValue = arrGroupDisplay[i].split("|");
            if(arrGDValue.length > 1)
            {
                var imgArrowObj = $("#tab02 img[id='img_"+ arrGDValue[0] +"']");
                var groupObj = $("tr[group^='"+ arrGDValue[0] +"_G']");              

                if(arrGDValue[1] == "1") 
                {
                    imgArrowObj.attr("src", "/ECMain/ECount.Common/Images/footer_arrow_up.gif");
                    groupObj.css("display", "");
                }
                else 
                {
                    imgArrowObj.attr("src", "/ECMain/ECount.Common/Images/footer_arrow_down.gif");
                    groupObj.css("display", "none");
                }
            }
        }
    }
    else
    {
        $("#tab02 img").each(function (){
            if($(this).attr("id") != "undefined" && $(this).attr("id").indexOf("img_") > -1)
            {
                var groupObjId = $(this).attr("id").replace(/img_/g,"");
                $("#tab02 img[id='img_"+ groupObjId +"']").attr("src", "/ECMain/ECount.Common/Images/footer_arrow_down.gif");
                //$("tr[group^='"+ groupObjId +"_G']").css("display", "none");
            }
        });
    }
}

//시리얼재고현황 양식관련
function fnChangeValue(SearchGubun)
{
	$("#ddlFormSer >option").remove();
	var FormSer = $("#ddlFormSer")</groupdisplaycntbledValue(SearchGubun);
	formCountType = SearchGubun;
    var iCnt = 0;

	if(SearchGubun == "1")
	{
		
	}
	else if(SearchGubun == "2")
	{		
		
	}
	else if(SearchGubun == "3")
	{			
		
	}

    if(FormSer.options.length < 1)
        $("#ddlFormSer").attr("disabled", "true");
    else
        $("#ddlFormSer").attr("disabled", "");
}

iFormCount1 = 0;
iFormCount2 = 0;
iFormCount3 = 0;

//시리얼재고현황, 시리얼재고수불부, 일별이익현황
function fnDisabledValue(SearchGubun)
{
    if("1" == "59") //재고현황
	{
	    if(SearchGubun == "3") //품목별집계일경우
	    {
		    //재고수량
		    $("#rbJagoQtyFlag0").get(0).disabled = true;
		    $("#rbJagoQtyFlag1").get(0).disabled = true;
		    $("#rbJagoQtyFlag2").get(0).disabled = true;
		    $("#rbJagoQtyFlag3").get(0).disabled = true;

		    if($("#rbJagoQtyFlag0_basic").get(0) != undefined) $("#rbJagoQtyFlag0_basic").get(0).disabled = true;		
		    if($("#rbJagoQtyFlag1_basic").get(0) != undefined) $("#rbJagoQtyFlag1_basic").get(0).disabled = true;		
		    if($("#rbJagoQtyFlag2_basic").get(0) != undefined) $("#rbJagoQtyFlag2_basic").get(0).disabled = true;		
		    if($("#rbJagoQtyFlag3_basic").get(0) != undefined) $("#rbJagoQtyFlag3_basic").get(0).disabled = true;		
		
		    //증감없는건포함
		    $("#cbEmptyFlag").get(0).disabled = true;		
		    if($("#cbEmptyFlag_basic").get(0) != undefined) $("#cbEmptyFlag_basic").get(0).disabled = true;		
	    }
	    else
	    {
		    //재고수량
		    $("#rbJagoQtyFlag0").get(0).disabled = false;
		    $("#rbJagoQtyFlag1").get(0).disabled = false;
		    $("#rbJagoQtyFlag2").get(0).disabled = false;
		    $("#rbJagoQtyFlag3").get(0).disabled = false;
		
		    if($("#rbJagoQtyFlag0_basic").get(0) != undefined) $("#rbJagoQtyFlag0_basic").get(0).disabled = false;		
		    if($("#rbJagoQtyFlag1_basic").get(0) != undefined) $("#rbJagoQtyFlag1_basic").get(0).disabled = false;		
		    if($("#rbJagoQtyFlag2_basic").get(0) != undefined) $("#rbJagoQtyFlag2_basic").get(0).disabled = false;		
		    if($("#rbJagoQtyFlag3_basic").get(0) != undefined) $("#rbJagoQtyFlag3_basic").get(0).disabled = false;		
			
		    //증감없는건포함
		    $("#cbEmptyFlag").get(0).disabled = false;		
		    if($("#cbEmptyFlag_basic").get(0) != undefined) $("#cbEmptyFlag_basic").get(0).disabled = false;			
	    }	
    }
    else if ("1" == "58") //재고수불부
	{
		if(SearchGubun == "2") //시리얼집계 
		{
            $("#cbAsFlag").get(0).checked = false;
			$("#cbAsFlag").get(0).disabled = true;
			if($("#cbAsFlag_basic").get(0) != undefined) $("#cbAsFlag_basic").get(0).disabled = true;		
		}
		else
		{
			$("#cbAsFlag").get(0).disabled = false;
			if($("#cbAsFlag_basic").get(0) != undefined) $("#cbAsFlag_basic").get(0).disabled = false;		
		}
			
	}
    else if ("1" == "21") //일별이익현황
    {
        if(SearchGubun == "0" || SearchGubun == "") //건별 
		{
            $("#cbProdCdGroup").get(0).checked = false;
			$("#cbProdCdGroup").get(0).disabled = true;
			if($("#cbProdCdGroup_basic").get(0) != undefined){
                $("#cbProdCdGroup_basic").get(0).checked = false;
                $("#cbProdCdGroup_basic").get(0).disabled = true;
             }		
		}
		else
		{
			$("#cbProdCdGroup").get(0).disabled = false;
			if($("#cbProdCdGroup_basic").get(0) != undefined) {            
                $("#cbProdCdGroup_basic").get(0).disabled = false;
            }			
		}

    }
}


$(function() {
    fnGroupDisplaySet();
});
//ie10에서 텍스트박스의 X표시눌렀을경우 항목 동기화
function fnXclearSync(obj)
{
    var input = $(obj),	oldValue = input.val();	
    if (oldValue == "") return;	
    setTimeout(function(){	
        var newValue = input.val();	
        if (newValue == ""){	
            if (input.attr("id").indexOf("_basic") > -1)
                $("#"+input.attr("id").replace("_basic","")).val("");
            else
                $("#"+input.attr("id")+"_basic").val("");
        }	
    }, 1);	
}

//사용중단/삭제창고포함 
function fnInactiveDelLocation(obj){
    if($("#hidExecValue").val() == "N")
    {
        if($(obj).attr("checked") == true){
            if($("#cbExcFlag_basic").get(0) != undefined) $("#cbExcFlag_basic").get(0).disabled = true;
            $("#cbExcFlag").get(0).disabled = true;
            if($("#cbExcProdFlag_basic").get(0) != undefined) $("#cbExcProdFlag_basic").get(0).disabled = true;
            $("#cbExcProdFlag").get(0).disabled = true;

            if($("#cbExcFlag_basic").get(0) != undefined) $("#cbExcFlag_basic").get(0).checked = false;
            if($("#cbExcProdFlag_basic").get(0) != undefined )$("#cbExcProdFlag_basic").get(0).checked = false;
            $("#cbExcFlag").get(0).checked = false;
            $("#cbExcProdFlag").get(0).checked = false;
        }else{
            if($("#cbExcFlag_basic").get(0) != undefined) $("#cbExcFlag_basic").get(0).disabled = false;
            $("#cbExcFlag").get(0).disabled = false;
            if($("#cbExcProdFlag_basic").get(0) != undefined) $("#cbExcProdFlag_basic").get(0).disabled = false;
            $("#cbExcProdFlag").get(0).disabled = false;
        }
    }
}

//창고별 종/횡에 따른 설정 변경.
function fnSetDisCheckLocation(type){
    var obj1 = null, obj2 = null;

    if("1" == "54"){
        obj1 = $("#cbInactiveDelLocation_basic");
        obj2 = $("#cbInactiveDelLocation");
    }
    else{
        obj1 = $("#cbDeactivateMgmtField_basic");
        obj2 = $("#cbDeactivateMgmtField");
    }


    if(type == "1"){
        $(obj1).attr("checked", false);
        if($(obj1).get(0) != undefined) $(obj1).get(0).disabled = true;
        $(obj2).attr("checked", false);
        $(obj2).get(0).disabled = true;

        $("#cbMainProdFlag_basic").attr("checked", false);
        if($("#cbMainProdFlag_basic").get(0) != undefined) $("#cbMainProdFlag_basic").get(0).disabled = true;
        $("#cbMainProdFlag").attr("checked", false);
        $("#cbMainProdFlag").get(0).disabled = true;
    }
    else{
        $(obj1).attr("checked", true);
        if($(obj1).get(0) != undefined) $(obj1).get(0).disabled = false;
        $(obj2).attr("checked", true);
        $(obj2).get(0).disabled = false;

        $("#cbMainProdFlag_basic").attr("checked", true);
        if($("#cbMainProdFlag_basic").get(0) != undefined) $("#cbMainProdFlag_basic").get(0).disabled = false;
        $("#cbMainProdFlag").attr("checked", true);
        $("#cbMainProdFlag").get(0).disabled = false;
    }

    fnInactiveDelLocation(obj1);
}

//사용중단/삭제된창고 체크여부.
function fnExcFlagCheck(val){
    if("1" == "54" || "1" == "55"){
        $("#hidExecValue").val(val);

        if(val == "Y"){
            if($("#cbExcFlag_basic").get(0) != undefined) $("#cbExcFlag_basic").get(0).disabled = true;
            $("#cbExcFlag").get(0).disabled = true;
            if($("#cbExcProdFlag_basic").get(0) != undefined) $("#cbExcProdFlag_basic").get(0).disabled = true;
            $("#cbExcProdFlag").get(0).disabled = true;
            if($("#cbExcFlag_basic").get(0) != undefined) $("#cbExcFlag_basic").get(0).checked = false;
            $("#cbExcFlag").get(0).checked = false;
        }
        else{
            if($("#cbExcFlag_basic").get(0) != undefined) $("#cbExcFlag_basic").get(0).disabled = false;
            $("#cbExcFlag").get(0).disabled = false;
        }
    }
}

function fnDisableInactive(){
     var obj1 = null, obj2 = null;

    if("1" == "54"){
        obj1 = $("#cbInactiveDelLocation_basic");
        obj2 = $("#cbInactiveDelLocation");
    }
    else{
        obj1 = $("#cbDeactivateMgmtField_basic");
        obj2 = $("#cbDeactivateMgmtField");
    }

    if($("#cbExcFlag").get(0).checked || $("#cbExcProdFlag").get(0).checked){
        $(obj1).attr("checked", false);
        if($(obj1).get(0) != undefined) $(obj1).get(0).disabled = true;
        $(obj2).attr("checked", false);
        if($(obj2).get(0) != undefined)$(obj2).get(0).disabled = true;
    }
    else{
        if($(obj1).get(0) != undefined) $(obj1).get(0).disabled = false;
        if($(obj2).get(0) != undefined) $(obj2).get(0).disabled = false;
    }
}

//Use for strRptGubun 810 (View Transactions)
function fnDocNoDisplay(gubun, flag)
{
	if ($("#trDocNo").get(0) != undefined)
	{
		if(flag.toUpperCase() == "TRUE")
			$("tr[id='trDocNo']").css("display","");
		else
			$("tr[id='trDocNo']").css("display","none");
	}
		
    if ($("#thDocNo").get(0) != undefined)
	{
		if(gubun == "1") // 판매
		{
			$("span[id='thDocNo']").html("판매No.");
		}
		else if(gubun == "2") // 구매
		{        
			$("span[id='thDocNo']").html("구매No.");
		}
		else if(gubun == "3") // 견적
		{        
			$("span[id='thDocNo']").html("견적No.");
		}
		else if(gubun == "4") // 주문
		{        
			$("span[id='thDocNo']").html("주문No.");
		}
		else if(gubun == "5") // 발주
		{          
			$("span[id='thDocNo']").html("발주No.");
		}
		else if(gubun == "6") // 단가
		{        
			$("span[id='thDocNo']").html("단가요청No.");
		}
	}
}

function changeSNStatusType(value) {
    //bind items
    $('#ddlSNStatusType2').find('option').remove().end().append('<option value="9999">전체=====================</option>'); //All
    if (value == "0")
    {
        $('#ddlSNStatusType2').append('<option value="2">구매</option>'); //Purchases
        $('#ddlSNStatusType2').append('<option value="42">생산입고</option>'); //Goods Receipt
        $('#ddlSNStatusType2').append('<option value="31">창고이동</option>'); //Location Trans.
        $('#ddlSNStatusType2').append('<option value="32">생산불출</option>'); //Goods Issued
        $('#ddlSNStatusType2').append('<option value="62">불량-품목대체(정상품목)</option>'); //Product Defect – Disassemble (Normal Item)
    }
    else if (value == "1")
    {
        $('#ddlSNStatusType2').append('<option value="-1">판매</option>'); //Sales
        $('#ddlSNStatusType2').append('<option value="-47">생산소모</option>'); //Goods Receipt - Consumed
        $('#ddlSNStatusType2').append('<option value="-31">창고이동</option>'); //Location Trans.
        $('#ddlSNStatusType2').append('<option value="-32">생산불출</option>'); //Goods Issued
        $('#ddlSNStatusType2').append('<option value="-59">자가사용</option>'); //Internal Use
        $('#ddlSNStatusType2').append('<option value="-52">불량-품목대체(불량품목)</option>'); //Product Defect – Disassemble (Defect Item) (02)
        $('#ddlSNStatusType2').append('<option value="-51">불량-폐기</option>'); //Product Defect – Dispose (01)
        $('#ddlSNStatusType2').append('<option value="-58">재고조정</option>'); //Inv. Adj.
    }
    else if (value == "2")
    {
        $('#ddlSNStatusType2').append('<option value="AS">A/S</option>'); //A/S
        $('#ddlSNStatusType2').append('<option value="71">품질검사요청</option>'); //Quality Inspection Request
        $('#ddlSNStatusType2').append('<option value="72">품질검사</option>'); //Quality Inspection
        $('#ddlSNStatusType2').append('<option value="53">불량-정상사용</option>'); //Product Defect – Normal Use (03)
    }

    //Syn data to other tab
    $('#ddlSNStatusType2_basic').find('option').remove();
    $('#ddlSNStatusType2_basic').append($("#ddlSNStatusType2 > option").clone());

    //Set default item
    $('#ddlSNStatusType2').val('9999');
    $('#ddlSNStatusType2_basic').val('9999');
}
//Use for Rpt 791 Business Trip 
function fnEnterSubmit(event) {
var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
if(keyCode == 13)
	frmSearchData(-1, true);
}

//-->
</script>

    <form id="frmSearch" name="frmSearch" method="post" action="/ECMain/ESZ/ESZ003R.aspx?ec_req_sid=00JbDuK7Cm8P">
         <!--cjy -->      
        <div class="new-title">
        <div class='title-leftarea page-bookmark' onclick='javascript:fnFavorityPopupOpen("재고수불부 I","E040702","1287","215","");'>재고수불부 I</div> 
		    <div class="title-rightarea">
                <span class="btn-setting" onclick="fnShowOption(); return false;"></span>
                <ul class="option_box_new" >
                    
                    
                      
						<li><a onclick="javascript:fnPopTemplate();">양식</a></li>	
						
                                            
                        <li><a onclick="javascript:gfnPopUp1('/ECMain/CM3/CM100P_24.aspx?FORM_GUBUN=SM623&FORM_SER=1&NetFlag=N&FIRST_FLAG=N','CM100P_14','Y','400' ,'390');" >검색항목설정</a></li>
                    
                </ul>
            </div>
            
        </div>
        <!-- cjy 삭제이력조회--> 
        
    <fieldset>
        <legend><span class="title">판매조회 조건입력</span></legend>
        <div class="H_5px">
        
        </div>
 
 <div id="contents"> 
        
    <div class="nav_tab p_t4px" >
        <ul>
            <li id="tab1" class="nav_tabon"><a href="#"  onclick="MM_showHideLayers1(1);TabChangeFocus();"><span>기본</span></a></li>
            <li id="tab2"><a href="#"  onclick="MM_showHideLayers1(2);TabChangeFocus();"><span>전체</span></a></li>
        </ul>
   </div>
 
    
    <!--기본사항-->
    
        <span id="tab01" style="display:">
            <table summary="" class="entry fixed">
            
                <tr group="">
                    <th  style="width:115px;" ><div class="float_left">기준일자 </div><div class="float_right">&nbsp;</div></th>                    
                    <td>                      
                    <span id="ECDateTimeF_basic"><select name="ddlSYear_basic" id="ddlSYear_basic" onkeypress="return fnEnterHandles1(this,event,&#39;1&#39;);" onchange="fnValueSync(&#39;_basic&#39;,&#39;ddlSYear&#39;);">
	<option value="2017">2017</option>
	<option selected="selected" value="2016">2016</option>
	<option value="2015">2015</option>
	<option value="2014">2014</option>
	<option value="2013">2013</option>
	<option value="2012">2012</option>
	<option value="2011">2011</option>
	<option value="2010">2010</option>
	<option value="2009">2009</option>
	<option value="2008">2008</option>
	<option value="2007">2007</option>
	<option value="2006">2006</option>
</select><select name="ddlSMonth_basic" id="ddlSMonth_basic" onkeypress="return fnEnterHandles1(this,event,&#39;1&#39;);" onchange="fnValueSync(&#39;_basic&#39;,&#39;ddlSMonth&#39;);fnCheckDateValidate(&#39;ddlSYear_basic&#39;,&#39;ddlSMonth_basic&#39;,&#39;txtSDay_basic&#39;);BlurColor(this);">
	<option value="01">1월</option>
	<option value="02">2월</option>
	<option value="03">3월</option>
	<option value="04">4월</option>
	<option value="05">5월</option>
	<option value="06">6월</option>
	<option selected="selected" value="07">7월</option>
	<option value="08">8월</option>
	<option value="09">9월</option>
	<option value="10">10월</option>
	<option value="11">11월</option>
	<option value="12">12월</option>
</select><input name="txtSDay_basic" type="text" id="txtSDay_basic" onkeyup="javascript:formatNumber(this.value,&#39;0&#39;,this,&#39;&#39;,2,&#39;&#39;);fnValueSync(&#39;_basic&#39;,&#39;ddlSYear&#39;);fnValueSync(&#39;_basic&#39;,&#39;ddlSMonth&#39;);fnValueSync(&#39;_basic&#39;,&#39;txtSDay&#39;);" value="01" maxlength="2" class="default" style="width:20px;" onblur="fnCheckDateValidate(&#39;ddlSYear_basic&#39;,&#39;ddlSMonth_basic&#39;,&#39;txtSDay_basic&#39;);BlurColor(this);" onkeypress="return fnEnterHandles1(this,event,&#39;1&#39;);" onfocus="fnValueSync(&#39;_basic&#39;,&#39;ddlSYear&#39;);fnValueSync(&#39;_basic&#39;,&#39;ddlSMonth&#39;);fnValueSync(&#39;_basic&#39;,&#39;txtSDay&#39;);this.select();FocusColor(this);" size="2" /><img src='/ECMain/ESZ/WebResource.axd?d=7PU6sqRt4oWi_hERdGpoHTES4K5-nQ1H5ux7MhbD4YkeMuOXJpRkeKKcCdaA_3H1T6o-30s_7X4l91wwPk9qQ4qw-_Gbd_L1mhIuusw_vB5fR4cZL2oiYjULxaJQ-GK2dE6faC98JApELeTA7lzwDPXbJ3rxBhfcSL3cut89t29bXdtcLn8XCalqd6SZEb5vWdXwLy_j95l28vjxp_vznVocY_A1&t=635955736124225069' id='btnCallCal_ECDateTimeF_basic' name='btnCallCal_ECDateTimeF_basic' style="cursor:pointer;" onclick='ECCalendar_ECDateTimeF_basic.toggle2("btnCallCal_ECDateTimeF_basic","N");'/><script type="text/javascript">
var ECCalendar_ECDateTimeF_basic;
ECCalendar_ECDateTimeF_basic = new ECCalendar('EcCalendar_ECDateTimeF_basic', 'popup', document.getElementById('btnCallCal_ECDateTimeF_basic'), 'ECDateTimeF_basic', 'ddlSYear_basic', 'ddlSMonth_basic', 'txtSDay_basic', false, 'ko-KR', '2006', '2017', '/ECMain/ESZ/WebResource.axd?d=X5hOdRhvxvVUijXPGjy11ChFz1sVsyu6vwkuq_OTHDHte_TDXuYUBlF15yAaSfav01HpJrTMNq-E4uEt9C3QwrnNnuAtRd0C74LkBkgrdTh1sRg2TyQ1B_16Dky9V-viRuxMIinIfM-eWIdCXFXGEX5-3BckStZMdUkYgGc8sKAIdWl8irDLfhSMrITgvRQa22m6umekwIX2imHWXxQaX7P-9bo1&t=635955736124225069', '/ECMain/ESZ/WebResource.axd?d=lUH5gyx3viKwZ61ppIG7FoVJNvzSJhIi7yHttrrdtL6JObWkbhVGT230-WvxeTtlUNdfV2KJGDCTfbXpGPBPMocDgZO3xaJk4LTjpJsIM5gF7dXndlO_aSP3w7-lMDzDyUrzckqu4ulnqNav5nMcKbz4KbaoiKSYkstuH6Exyp4kQoEAEV0ZbP5x_0IH1H3eTDiuCn0-WKSUTdCZN85OZeUgdJw1&t=635955736124225069', '/ECMain/ESZ/WebResource.axd?d=05_EeC2_D5JYjz_0ZYRNOhA8MGxOhVbn7EqBmR49N6eRwkugBVZv4fbgX9h3PwCXIgThN-E64KPG_MFbZLeHyfEwY38gZ4cFQczptNrQ9Gdmqtm1dd5G8lcEGPSvZWONxDmvI6lX6bDNi28pKasqUz3c8KZ2PHf0Ypa1zg3_bGFL-Zx4FFaWwyfSX82fkuxnTLWzDI0sZJe9rUn8y6efmppN2kw1&t=635955736124225069', '/ECMain/ESZ/WebResource.axd?d=3jZmiY6dxhtkKWiBilFYpdItbfNCccHVmle0jJjURpEE58yvnUOtPaUYd2V7N8953PWefx-p6NcK8MU88hA5iXBIqmZxHpAgPCk8aUXryRbl_WgxPKz8pXQce0FByLJG1Zi7kSktrqzJO6e411yUrrtbyI3DeSAj_BhckYz0n4DvehMomXhw24ZxLvywdn8pv134fJPuyAz7tDDQ3rXKtc0C82U1&t=635955736124225069', '/ECMain/ESZ/WebResource.axd?d=mpGJ5x1fF1AMz6abRfFz6M82Xp4oIO0ty9190Zp4FMwNyrHnTQCatdk2bDRI2If038hZQIhhAGVGHbRldz2fGq7OndkaPWALMGu9lhdJQnoRw8v8uew-Uo5LMCX4H6rXjSaxnMHqR5lbwZpL0aRK-S88W6u4PF5fRf7C3Tnm4NyxUQlnEu_HX82H6CiaDzBId-uGleZdCporZLwGmMLAE51lKHQ1&t=635955736124225069');
</script>
</span>
                        
                        <img src="/ECMain/ECount.Common/images/icon_to.gif" width="12px" height="18px" />
                    <span id="ECDateTimeT_basic"><select name="ddlEYear_basic" id="ddlEYear_basic" onkeypress="return fnEnterHandles1(this,event,&#39;1&#39;);" onchange="fnValueSync(&#39;_basic&#39;,&#39;ddlEYear&#39;);">
	<option value="2017">2017</option>
	<option selected="selected" value="2016">2016</option>
	<option value="2015">2015</option>
	<option value="2014">2014</option>
	<option value="2013">2013</option>
	<option value="2012">2012</option>
	<option value="2011">2011</option>
	<option value="2010">2010</option>
	<option value="2009">2009</option>
	<option value="2008">2008</option>
	<option value="2007">2007</option>
	<option value="2006">2006</option>
</select><select name="ddlEMonth_basic" id="ddlEMonth_basic" onkeypress="return fnEnterHandles1(this,event,&#39;1&#39;);" onchange="fnValueSync(&#39;_basic&#39;,&#39;ddlEMonth&#39;);fnCheckDateValidate(&#39;ddlEYear_basic&#39;,&#39;ddlEMonth_basic&#39;,&#39;txtEDay_basic&#39;);BlurColor(this);">
	<option value="01">1월</option>
	<option value="02">2월</option>
	<option value="03">3월</option>
	<option value="04">4월</option>
	<option value="05">5월</option>
	<option value="06">6월</option>
	<option selected="selected" value="07">7월</option>
	<option value="08">8월</option>
	<option value="09">9월</option>
	<option value="10">10월</option>
	<option value="11">11월</option>
	<option value="12">12월</option>
</select><input name="txtEDay_basic" type="text" id="txtEDay_basic" onkeyup="javascript:formatNumber(this.value,&#39;0&#39;,this,&#39;&#39;,2,&#39;&#39;);fnValueSync(&#39;_basic&#39;,&#39;ddlEYear&#39;);fnValueSync(&#39;_basic&#39;,&#39;ddlEMonth&#39;);fnValueSync(&#39;_basic&#39;,&#39;txtEDay&#39;);" value="28" maxlength="2" class="default" style="width:20px;" onblur="fnCheckDateValidate(&#39;ddlEYear_basic&#39;,&#39;ddlEMonth_basic&#39;,&#39;txtEDay_basic&#39;);BlurColor(this);" onkeypress="return fnEnterHandles1(this,event,&#39;1&#39;);" onfocus="fnValueSync(&#39;_basic&#39;,&#39;ddlEYear&#39;);fnValueSync(&#39;_basic&#39;,&#39;ddlEMonth&#39;);fnValueSync(&#39;_basic&#39;,&#39;txtEDay&#39;);this.select();FocusColor(this);" size="2" /><img src='/ECMain/ESZ/WebResource.axd?d=7PU6sqRt4oWi_hERdGpoHTES4K5-nQ1H5ux7MhbD4YkeMuOXJpRkeKKcCdaA_3H1T6o-30s_7X4l91wwPk9qQ4qw-_Gbd_L1mhIuusw_vB5fR4cZL2oiYjULxaJQ-GK2dE6faC98JApELeTA7lzwDPXbJ3rxBhfcSL3cut89t29bXdtcLn8XCalqd6SZEb5vWdXwLy_j95l28vjxp_vznVocY_A1&t=635955736124225069' id='btnCallCal_ECDateTimeT_basic' name='btnCallCal_ECDateTimeT_basic' style="cursor:pointer;" onclick='ECCalendar_ECDateTimeT_basic.toggle2("btnCallCal_ECDateTimeT_basic","N");'/><script type="text/javascript">
var ECCalendar_ECDateTimeT_basic;
ECCalendar_ECDateTimeT_basic = new ECCalendar('EcCalendar_ECDateTimeT_basic', 'popup', document.getElementById('btnCallCal_ECDateTimeT_basic'), 'ECDateTimeT_basic', 'ddlEYear_basic', 'ddlEMonth_basic', 'txtEDay_basic', false, 'ko-KR', '2006', '2017', '/ECMain/ESZ/WebResource.axd?d=X5hOdRhvxvVUijXPGjy11ChFz1sVsyu6vwkuq_OTHDHte_TDXuYUBlF15yAaSfav01HpJrTMNq-E4uEt9C3QwrnNnuAtRd0C74LkBkgrdTh1sRg2TyQ1B_16Dky9V-viRuxMIinIfM-eWIdCXFXGEX5-3BckStZMdUkYgGc8sKAIdWl8irDLfhSMrITgvRQa22m6umekwIX2imHWXxQaX7P-9bo1&t=635955736124225069', '/ECMain/ESZ/WebResource.axd?d=lUH5gyx3viKwZ61ppIG7FoVJNvzSJhIi7yHttrrdtL6JObWkbhVGT230-WvxeTtlUNdfV2KJGDCTfbXpGPBPMocDgZO3xaJk4LTjpJsIM5gF7dXndlO_aSP3w7-lMDzDyUrzckqu4ulnqNav5nMcKbz4KbaoiKSYkstuH6Exyp4kQoEAEV0ZbP5x_0IH1H3eTDiuCn0-WKSUTdCZN85OZeUgdJw1&t=635955736124225069', '/ECMain/ESZ/WebResource.axd?d=05_EeC2_D5JYjz_0ZYRNOhA8MGxOhVbn7EqBmR49N6eRwkugBVZv4fbgX9h3PwCXIgThN-E64KPG_MFbZLeHyfEwY38gZ4cFQczptNrQ9Gdmqtm1dd5G8lcEGPSvZWONxDmvI6lX6bDNi28pKasqUz3c8KZ2PHf0Ypa1zg3_bGFL-Zx4FFaWwyfSX82fkuxnTLWzDI0sZJe9rUn8y6efmppN2kw1&t=635955736124225069', '/ECMain/ESZ/WebResource.axd?d=3jZmiY6dxhtkKWiBilFYpdItbfNCccHVmle0jJjURpEE58yvnUOtPaUYd2V7N8953PWefx-p6NcK8MU88hA5iXBIqmZxHpAgPCk8aUXryRbl_WgxPKz8pXQce0FByLJG1Zi7kSktrqzJO6e411yUrrtbyI3DeSAj_BhckYz0n4DvehMomXhw24ZxLvywdn8pv134fJPuyAz7tDDQ3rXKtc0C82U1&t=635955736124225069', '/ECMain/ESZ/WebResource.axd?d=mpGJ5x1fF1AMz6abRfFz6M82Xp4oIO0ty9190Zp4FMwNyrHnTQCatdk2bDRI2If038hZQIhhAGVGHbRldz2fGq7OndkaPWALMGu9lhdJQnoRw8v8uew-Uo5LMCX4H6rXjSaxnMHqR5lbwZpL0aRK-S88W6u4PF5fRf7C3Tnm4NyxUQlnEu_HX82H6CiaDzBId-uGleZdCporZLwGmMLAE51lKHQ1&t=635955736124225069');
</script>
</span>
                    
                    </td>
                </tr>
                        
            
                <tr id="trWhCd" group="txtSWhCd_M">
                    <th style="width:115px"><div class="float_left">창고</div><div class="float_right"><img id="img_txtSWhCd" src="/ECMain/ECount.Common/Images/footer_arrow_down.gif" border="0" onclick="fnSubItemOpen(this, 'txtSWhCd', '1')" style="cursor:pointer;"></div></th>
                    <td><a href="#"><input type="text" name="txtSWhCd_basic" id="txtSWhCd_basic"   value="" onkeyup="fnValueSync('_basic','txtSWhCd');" ondblclick="search_code(4,'','F','double','txtSWhCd_basic',event);" onchange="search_code(4,'','F','search','txtSWhCd_basic',event);" onkeypress="return fnEnterHandles1(this,event,'1');" onfocus="FocusColor(this);this.select();"onblur="BlurColor2(this);fnNextField('1','txtSWhCd');"  class="rightnone"  style="width:66px;"  /><a href="#" onclick="search_code(4,'','F','double','txtSWhCd_basic',event);"><img src="/ECMain/ECount.Common/images/Icon_zoom.gif" width="22px" height="19px" alt="검색"  /></a><input type="text" name="txtSWhDes_basic" id="txtSWhDes_basic" class="grayleft"   value="" readonly value="" style="width:90px;"/>
                                   
                    </td>
                </tr>
        
            <tr id="trTreeWhCd"  style="display:none" group="txtSWhCd_B">
                <th style="width:115px"><div class="float_left">창고계층그룹</div><div class="float_right">&nbsp;</div></th>
                <td>
                    <input type="text" name="txtTreeWhCd_basic" id="txtTreeWhCd_basic" onkeyup="fnValueSync('_basic','txtTreeWhCd');" ondblclick="search_code(14,'','','double','txtTreeWhCd_basic',event);" onchange="search_code(14,'','','search','txtTreeWhCd_basic',event);" onkeypress="return fnEnterHandles1(this,event,'1');" onfocus="FocusColor(this);this.select();" onblur="BlurColor2(this);fnNextField('1','txtTreeWhCd');" class="rightnone" value="" style="width:66px;"/><a href="#" onclick="search_code(14,'','','double','txtTreeWhCd_basic',event);"><img src="/ECMain/ECount.Common/images/Icon_zoom.gif" width="22px" height="19px" alt="검색" /></a><input type="text" name="txtTreeWhNm_basic" id="txtTreeWhNm_basic" onkeyup="fnValueSync('_basic','txtTreeWhNm');" class="grayleft" onfocus="fnNextField('1','txtTreeWhCd');" value="" style="width:90px;" readonly />
                    <input type="checkbox" name="cbSubTreeWh_basic" id="cbSubTreeWh_basic" value="1" onclick="fnSubTreeWhChange(this, '_basic');" onkeypress="return fnEnterHandles1(this,event,'1');" onfocus="FocusColor(this);this.select();" />하위그룹포함검색
                </td>
            </tr>
        
                <input type="hidden" name="txtItemCd_basic" id="txtItemCd_basic" value="" />
                <input type="hidden" name="txtItemDes_basic" id="txtItemDes_basic" value="" />  
                       
                <tr id="trProdCd"  group="txtSProdCd_M">
                <th style="width:115px"><div class="float_left"  style="width:98px;" >품목코드</div><div class="float_right"><img id="img_txtSProdCd" src="/ECMain/ECount.Common/Images/footer_arrow_down.gif" border="0" onclick="fnSubItemOpen(this, 'txtSProdCd', '1')" style="cursor:pointer;"></div></th>
                <td><input type="text" name="txtSProdCd_basic" id="txtSProdCd_basic" onkeyup="fnValueSync('_basic','txtSProdCd');" ondblclick="search_code(9,'','','double','txtSProdCd_basic',event);" onchange="search_code(9,'','','search','txtSProdCd_basic',event);" onkeypress="return fnEnterHandles1(this,event,'1');" onfocus="FocusColor(this);this.select();" onblur="BlurColor2(this);" class="rightnone" value="A001" style="width:66px;"/><a href="#" onclick="search_code(9,'','','double','txtSProdCd_basic',event);"><img src="/ECMain/ECount.Common/images/Icon_zoom.gif" width="22px" height="19px" alt="검색" /></a><input type="text" name="txtSProdDes_basic" id="txtSProdDes_basic" class="grayleft" readonly  value="익스트림 울트라 명품 조립PC" style="width:90px;"/>&nbsp;&nbsp;
                
                <input type="hidden" name="hidProdChkDes_basic" id="hidProdChkDes_basic" />
                </td>
                </tr>
            
                <tr  style="display:none" group="txtSProdCd_B">
                    <input type="hidden" name="hidProdChkDes_basic" id="hidProdChkDes_basic" />
                    <th style="width:115px"><div class="float_left">품목구분</div><div class="float_right">&nbsp;</div></th>
                    <td><input type="radio" name="rbProdChk_basic" id="rbProdChk0_basic" onclick="fnValueSync('_basic','rbProdChk0');" value="" onkeypress="return fnEnterHandles1(this,event,'1');" onclick="fn_ChkValue(this);" checked>전체
                    <input type="radio" name="rbProdChk_basic" id="rbProdChk1_basic" onclick="fnValueSync('_basic','rbProdChk1');" value="0" onkeypress="return fnEnterHandles1(this,event,'1');" onclick="fn_ChkValue(this);" >원재료
                    <input type="radio" name="rbProdChk_basic" id="rbProdChk2_basic" onclick="fnValueSync('_basic','rbProdChk2');" value="4" onkeypress="return fnEnterHandles1(this,event,'1');" onclick="fn_ChkValue(this);" >부재료
                    <input type="radio" name="rbProdChk_basic" id="rbProdChk3_basic" onclick="fnValueSync('_basic','rbProdChk3');" value="1" onkeypress="return fnEnterHandles1(this,event,'1');" onclick="fn_ChkValue(this);" >제품
                    <input type="radio" name="rbProdChk_basic" id="rbProdChk4_basic" onclick="fnValueSync('_basic','rbProdChk4');" value="2" onkeypress="return fnEnterHandles1(this,event,'1');" onclick="fn_ChkValue(this);" >반제품
                    <input type="radio" name="rbProdChk_basic" id="rbProdChk5_basic" onclick="fnValueSync('_basic','rbProdChk5');" value="3" onkeypress="return fnEnterHandles1(this,event,'1');" onclick="fn_ChkValue(this);" >상품
                    </td>
                </tr>
        
                <tr  style="display:none" group="txtSProdCd_B">
                    <th style="width:115px"><div class="float_left">품목그룹</div><div class="float_right">&nbsp;</div></th>
                    <td><input type="text" name="txtClassCd_basic" id="txtClassCd_basic" onkeyup="fnValueSync('_basic','txtClassCd');" ondblclick="search_code(10,'','','double','txtClassCd_basic',event);" onchange="search_code(10,'','','search','txtClassCd_basic',event);" onkeypress="return fnEnterHandles1(this,event,'1');" onfocus=" FocusColor(this);this.select();" onblur="BlurColor2(this);" class="rightnone" value="" style="width:66px;"/><a href="#" onclick="search_code(10,'','','double','txtClassCd_basic',event);"><img src="/ECMain/ECount.Common/images/Icon_zoom.gif" width="22px" height="19px" alt="검색" /></a><input type="text" name="txtClassDes_basic" id="txtClassDes_basic" class="grayleft" readonly  value="" style="width:90px;"/><img src="/ECMain/ECount.Common/images/icon_s.gif" width="12px" height="18px" /><input type="text" name="txtClassCd2_basic" id="txtClassCd2_basic" onkeyup="fnValueSync('_basic','txtClassCd2');" ondblclick="search_code(10,'','2','double','txtClassCd2_basic',event);" onchange="search_code(10,'','2','search','txtClassCd2_basic',event);"  onkeypress="return fnEnterHandles1(this,event,'1');" onfocus="FocusColor(this);this.select();" onblur="BlurColor2(this);" class="rightnone" value="" style="width:66px;"/><a href="#"  onclick="search_code(10,'','2','double','txtClassCd2_basic',event);"><img src="/ECMain/ECount.Common/images/Icon_zoom.gif" width="22px" height="19px" alt="검색" /></a><input type="text" name="txtClassDes2_basic" id="txtClassDes2_basic" class="grayleft" readonly  value="" style="width:90px;"/><img src="/ECMain/ECount.Common/images/icon_s.gif" width="12px" height="18px"/><input type="text" name="txtClassCd3_basic" id="txtClassCd3_basic" onkeyup="fnValueSync('_basic','txtClassCd3');" ondblclick="search_code(10,'','3','double','txtClassCd3_basic',event);" onchange="search_code(10,'','3','search','txtClassCd3_basic',event);"  onkeypress="return fnEnterHandles1(this,event,'1');" onfocus="FocusColor(this);this.select();" onblur="BlurColor2(this);" class="rightnone" value="" style="width:66px;"/><a href="#" onclick="search_code(10,'','3','double','txtClassCd3_basic',event);"><img src="/ECMain/ECount.Common/images/Icon_zoom.gif" width="22px" height="19px" alt="검색" /></a><input type="text" name="txtClassDes3_basic" id="txtClassDes3_basic" class="grayleft" readonly  value="" style="width:90px;"/>
                    </td>
                </tr>
        
            <tr id="trTreeGroupCd"  style="display:none" group="txtSProdCd_B">
                <th style="width:115px"><div class="float_left">품목계층그룹</div><div class="float_right">&nbsp;</div></th>
                <td>
                    <input type="text" name="txtTreeGroupCd_basic" id="txtTreeGroupCd_basic" onkeyup="fnValueSync('_basic','txtTreeGroupCd');" ondblclick="search_code(12,'','','double','txtTreeGroupCd_basic',event);" onchange="search_code(12,'','','search','txtTreeGroupCd_basic',event);" onkeypress="return fnEnterHandles1(this,event,'1');" onfocus="FocusColor(this);this.select();" onblur="BlurColor2(this);" class="rightnone" value="" style="width:66px;"/><a href="#" onclick="search_code(12,'','','double','txtTreeGroupCd_basic',event);"><img src="/ECMain/ECount.Common/images/Icon_zoom.gif" width="22px" height="19px" alt="검색" /></a><input type="text" name="txtTreeGroupNm_basic" id="txtTreeGroupNm_basic" onkeyup="fnValueSync('_basic','txtTreeGroupNm');" class="grayleft" value="" style="width:90px;" readonly />
                    <input type="checkbox" name="cbSubTree_basic" id="cbSubTreeG_basic" value="1" onclick="fnSubTreeGroupChange(this, '_basic');" onkeypress="return fnEnterHandles1(this,event,'1');" onfocus="FocusColor(this);this.select();" />하위그룹포함검색
                </td>
            </tr>            
        
                <tr>
                    <th style="width:115px">기타</th><!--기타-->
                    <td>
                        <input type="checkbox" name="cbRptConfirm_basic" id="cbRptConfirm_basic" value="1" onclick="fnValueSync('_basic','cbRptConfirm');"
onfocus="nextfield='btnSearch';" />결재방표시<!--결재방r인쇄-->

                    
                        <input type="checkbox"  name="cbBalFlag_basic" id="cbBalFlag_basic" value="1" onclick="fnValueSync('_basic','cbBalFlag');" onkeypress="return fnEnterHandles1(this,event,'1');" />수량관리제외품목포함<!--수불제외품목 포함 -->
                    
                        <input type="checkbox"  name="cbZeroFlag2_basic" id="cbZeroFlag2_basic" value="1" onclick="fnValueSync('_basic','cbZeroFlag2');"   onkeypress="return fnEnterHandles1(this,event,'1');"  /><span id="spZeroFlag2" name="spZeroFlag2">입출고수량0제외</span><!--입출고수량 0 제외-->
                    
                        <input type="checkbox" name="cbMainProdFlag_basic" id="cbMainProdFlag_basic"  value = "1" onclick="fnValueSync('_basic','cbMainProdFlag');" onkeypress="return fnEnterHandles1(this,event,'1');" />주품목기준환산<!-- 주품목기준환산-->
                    
                            <input type="checkbox" name="cbMoveStore_basic"  onkeypress="return fnEnterHandles1(this,event,'1');" id="cbMoveStore_basic" onclick="fnValueSync('_basic','cbMoveStore');" value="1" onblur="nextfield='none';"    />생산불출/창고이동포함<!--생산불출/창고이동 포함-->
                        
                        <input type="checkbox" name="hicbProdNameSort_basic" id="hicbProdNameSort_basic" onclick="fnValueSync('_basic','hicbProdNameSort');"  onfocus="nextfield='btnSearch';" onblur="nextfield='none';" value="1" />품목명(정렬)
                    
                        <input type="checkbox" name="cbDelFlag_basic" id="cbDelFlag_basic"  value = "1" onclick="fnValueSync('_basic','cbDelFlag');" 
onfocus="nextfield='btnSearch';" checked  />사용중단품목포함
                    
                    </td>
                </tr>
            
                <input type="hidden" name="ddlSubCode_basic" id="ddlSubCode_basic" value="G1080/한국에어로(주)"/>
                                            
				<tr>
					<th style="width:115px">간편검색</th><!--간편검색-->
					
						<td><a href="#" id="btnToDay" name="btnToDay" class="list_link" onclick="fnSimpleSearch('2016,07,28','2016,07,28')">금일</a>&nbsp;&nbsp;<!--금일--><a href="#" id="btnYesterDay" name="btnYesterDay" class="list_link" onclick="fnSimpleSearch('2016,07,27','2016,07,27')">전일</a>&nbsp;&nbsp;<!--전일--><a href="#" id="btnWeek" name="btnWeek" class="list_link" onclick="fnSimpleSearch('2016,07,24','2016,07,28')">금주</a>&nbsp;&nbsp;<!--금주-->	<a href="#" id="btnLastWeek" name="btnLastWeek" class="list_link" onclick="fnSimpleSearch('2016,07,17','2016,07,23')" >전주</a>&nbsp;&nbsp;<!--전주--><a href="#" id="btnMonth" name="btnMonth" class="list_link" onclick="fnSimpleSearch('2016,07,01','2016,07,28')">금월</a>&nbsp;&nbsp;<!--금월--><a href="#" id="btnLastMonth" name="btnLastMonth" class="list_link" onclick="fnSimpleSearch('2016,06,01','2016,06,30')">전월</a>&nbsp;&nbsp;<!--전월--><a href="#" id="btnEndDay" name="btnEndDay" class="list_link" onclick="fnSimpleSearch('EndDay', '')">종료일</a>&nbsp;&nbsp;<!--종료일-->
                        </td>
					
				</tr>
			
            <input type="hidden" id="hidLastField1" name="hidLastField1" value="EtcChk" />
			<input type="hidden" id="hidLastFieldGroup1" name="hidLastFieldGroup1" value="" />
            </table>
        </span> <!--tab01-->
       
       
       
    
        <span id="tab02" style="display:none;">
            <table summary="" class="entry fixed">
            
                <tr group="">
                    <th  style="width:115px;" ><div class="float_left">기준일자 </div><div class="float_right">&nbsp;</div></th>                    
                    <td>                      
                    <span id="ECDateTimeF"><select name="ddlSYear" id="ddlSYear" onkeypress="return fnEnterHandles1(this,event,&#39;1&#39;);" onchange="fnValueSync(&#39;&#39;,&#39;ddlSYear&#39;);">
	<option value="2017">2017</option>
	<option selected="selected" value="2016">2016</option>
	<option value="2015">2015</option>
	<option value="2014">2014</option>
	<option value="2013">2013</option>
	<option value="2012">2012</option>
	<option value="2011">2011</option>
	<option value="2010">2010</option>
	<option value="2009">2009</option>
	<option value="2008">2008</option>
	<option value="2007">2007</option>
	<option value="2006">2006</option>
</select><select name="ddlSMonth" id="ddlSMonth" onkeypress="return fnEnterHandles1(this,event,&#39;1&#39;);" onchange="fnValueSync(&#39;&#39;,&#39;ddlSMonth&#39;);">
	<option value="01">1월</option>
	<option value="02">2월</option>
	<option value="03">3월</option>
	<option value="04">4월</option>
	<option value="05">5월</option>
	<option value="06">6월</option>
	<option selected="selected" value="07">7월</option>
	<option value="08">8월</option>
	<option value="09">9월</option>
	<option value="10">10월</option>
	<option value="11">11월</option>
	<option value="12">12월</option>
</select><input name="txtSDay" type="text" id="txtSDay" onkeyup="javascript:formatNumber(this.value,&#39;0&#39;,this,&#39;&#39;,2,&#39;&#39;);fnValueSync(&#39;&#39;,&#39;ddlSYear&#39;);fnValueSync(&#39;&#39;,&#39;ddlSMonth&#39;);fnValueSync(&#39;&#39;,&#39;txtSDay&#39;);" value="01" maxlength="2" class="default" style="width:20px;" onblur="fnCheckDateValidate(&#39;ddlSYear&#39;,&#39;ddlSMonth&#39;,&#39;txtSDay&#39;);BlurColor(this);" onkeypress="return fnEnterHandles1(this,event,&#39;1&#39;);" onfocus="fnValueSync(&#39;&#39;,&#39;ddlSYear&#39;);fnValueSync(&#39;&#39;,&#39;ddlSMonth&#39;);fnValueSync(&#39;&#39;,&#39;txtSDay&#39;);this.select();FocusColor(this);" size="2" /><img src='/ECMain/ESZ/WebResource.axd?d=7PU6sqRt4oWi_hERdGpoHTES4K5-nQ1H5ux7MhbD4YkeMuOXJpRkeKKcCdaA_3H1T6o-30s_7X4l91wwPk9qQ4qw-_Gbd_L1mhIuusw_vB5fR4cZL2oiYjULxaJQ-GK2dE6faC98JApELeTA7lzwDPXbJ3rxBhfcSL3cut89t29bXdtcLn8XCalqd6SZEb5vWdXwLy_j95l28vjxp_vznVocY_A1&t=635955736124225069' id='btnCallCal_ECDateTimeF' name='btnCallCal_ECDateTimeF' style="cursor:pointer;" onclick='ECCalendar_ECDateTimeF.toggle2("btnCallCal_ECDateTimeF","N");'/><script type="text/javascript">
var ECCalendar_ECDateTimeF;
ECCalendar_ECDateTimeF = new ECCalendar('EcCalendar_ECDateTimeF', 'popup', document.getElementById('btnCallCal_ECDateTimeF'), 'ECDateTimeF', 'ddlSYear', 'ddlSMonth', 'txtSDay', false, 'ko-KR', '2006', '2017', '/ECMain/ESZ/WebResource.axd?d=X5hOdRhvxvVUijXPGjy11ChFz1sVsyu6vwkuq_OTHDHte_TDXuYUBlF15yAaSfav01HpJrTMNq-E4uEt9C3QwrnNnuAtRd0C74LkBkgrdTh1sRg2TyQ1B_16Dky9V-viRuxMIinIfM-eWIdCXFXGEX5-3BckStZMdUkYgGc8sKAIdWl8irDLfhSMrITgvRQa22m6umekwIX2imHWXxQaX7P-9bo1&t=635955736124225069', '/ECMain/ESZ/WebResource.axd?d=lUH5gyx3viKwZ61ppIG7FoVJNvzSJhIi7yHttrrdtL6JObWkbhVGT230-WvxeTtlUNdfV2KJGDCTfbXpGPBPMocDgZO3xaJk4LTjpJsIM5gF7dXndlO_aSP3w7-lMDzDyUrzckqu4ulnqNav5nMcKbz4KbaoiKSYkstuH6Exyp4kQoEAEV0ZbP5x_0IH1H3eTDiuCn0-WKSUTdCZN85OZeUgdJw1&t=635955736124225069', '/ECMain/ESZ/WebResource.axd?d=05_EeC2_D5JYjz_0ZYRNOhA8MGxOhVbn7EqBmR49N6eRwkugBVZv4fbgX9h3PwCXIgThN-E64KPG_MFbZLeHyfEwY38gZ4cFQczptNrQ9Gdmqtm1dd5G8lcEGPSvZWONxDmvI6lX6bDNi28pKasqUz3c8KZ2PHf0Ypa1zg3_bGFL-Zx4FFaWwyfSX82fkuxnTLWzDI0sZJe9rUn8y6efmppN2kw1&t=635955736124225069', '/ECMain/ESZ/WebResource.axd?d=3jZmiY6dxhtkKWiBilFYpdItbfNCccHVmle0jJjURpEE58yvnUOtPaUYd2V7N8953PWefx-p6NcK8MU88hA5iXBIqmZxHpAgPCk8aUXryRbl_WgxPKz8pXQce0FByLJG1Zi7kSktrqzJO6e411yUrrtbyI3DeSAj_BhckYz0n4DvehMomXhw24ZxLvywdn8pv134fJPuyAz7tDDQ3rXKtc0C82U1&t=635955736124225069', '/ECMain/ESZ/WebResource.axd?d=mpGJ5x1fF1AMz6abRfFz6M82Xp4oIO0ty9190Zp4FMwNyrHnTQCatdk2bDRI2If038hZQIhhAGVGHbRldz2fGq7OndkaPWALMGu9lhdJQnoRw8v8uew-Uo5LMCX4H6rXjSaxnMHqR5lbwZpL0aRK-S88W6u4PF5fRf7C3Tnm4NyxUQlnEu_HX82H6CiaDzBId-uGleZdCporZLwGmMLAE51lKHQ1&t=635955736124225069');
</script>
</span>
                        
                        <img src="/ECMain/ECount.Common/images/icon_to.gif" width="12px" height="18px" />
                    <span id="ECDateTimeT"><select name="ddlEYear" id="ddlEYear" onkeypress="return fnEnterHandles1(this,event,&#39;1&#39;);" onchange="fnValueSync(&#39;&#39;,&#39;ddlEYear&#39;);">
	<option value="2017">2017</option>
	<option selected="selected" value="2016">2016</option>
	<option value="2015">2015</option>
	<option value="2014">2014</option>
	<option value="2013">2013</option>
	<option value="2012">2012</option>
	<option value="2011">2011</option>
	<option value="2010">2010</option>
	<option value="2009">2009</option>
	<option value="2008">2008</option>
	<option value="2007">2007</option>
	<option value="2006">2006</option>
</select><select name="ddlEMonth" id="ddlEMonth" onkeypress="return fnEnterHandles1(this,event,&#39;1&#39;);" onchange="fnValueSync(&#39;&#39;,&#39;ddlEMonth&#39;);">
	<option value="01">1월</option>
	<option value="02">2월</option>
	<option value="03">3월</option>
	<option value="04">4월</option>
	<option value="05">5월</option>
	<option value="06">6월</option>
	<option selected="selected" value="07">7월</option>
	<option value="08">8월</option>
	<option value="09">9월</option>
	<option value="10">10월</option>
	<option value="11">11월</option>
	<option value="12">12월</option>
</select><input name="txtEDay" type="text" id="txtEDay" onkeyup="javascript:formatNumber(this.value,&#39;0&#39;,this,&#39;&#39;,2,&#39;&#39;);fnValueSync(&#39;&#39;,&#39;ddlEYear&#39;);fnValueSync(&#39;&#39;,&#39;ddlEMonth&#39;);fnValueSync(&#39;&#39;,&#39;txtEDay&#39;);" value="28" maxlength="2" class="default" style="width:20px;" onblur="fnCheckDateValidate(&#39;ddlEYear&#39;,&#39;ddlEMonth&#39;,&#39;txtEDay&#39;);BlurColor(this);" onkeypress="return fnEnterHandles1(this,event,&#39;1&#39;);" onfocus="fnValueSync(&#39;&#39;,&#39;ddlEYear&#39;);fnValueSync(&#39;&#39;,&#39;ddlEMonth&#39;);fnValueSync(&#39;&#39;,&#39;txtEDay&#39;);this.select();FocusColor(this);" size="2" /><img src='/ECMain/ESZ/WebResource.axd?d=7PU6sqRt4oWi_hERdGpoHTES4K5-nQ1H5ux7MhbD4YkeMuOXJpRkeKKcCdaA_3H1T6o-30s_7X4l91wwPk9qQ4qw-_Gbd_L1mhIuusw_vB5fR4cZL2oiYjULxaJQ-GK2dE6faC98JApELeTA7lzwDPXbJ3rxBhfcSL3cut89t29bXdtcLn8XCalqd6SZEb5vWdXwLy_j95l28vjxp_vznVocY_A1&t=635955736124225069' id='btnCallCal_ECDateTimeT' name='btnCallCal_ECDateTimeT' style="cursor:pointer;" onclick='ECCalendar_ECDateTimeT.toggle2("btnCallCal_ECDateTimeT","N");'/><script type="text/javascript">
var ECCalendar_ECDateTimeT;
ECCalendar_ECDateTimeT = new ECCalendar('EcCalendar_ECDateTimeT', 'popup', document.getElementById('btnCallCal_ECDateTimeT'), 'ECDateTimeT', 'ddlEYear', 'ddlEMonth', 'txtEDay', false, 'ko-KR', '2006', '2017', '/ECMain/ESZ/WebResource.axd?d=X5hOdRhvxvVUijXPGjy11ChFz1sVsyu6vwkuq_OTHDHte_TDXuYUBlF15yAaSfav01HpJrTMNq-E4uEt9C3QwrnNnuAtRd0C74LkBkgrdTh1sRg2TyQ1B_16Dky9V-viRuxMIinIfM-eWIdCXFXGEX5-3BckStZMdUkYgGc8sKAIdWl8irDLfhSMrITgvRQa22m6umekwIX2imHWXxQaX7P-9bo1&t=635955736124225069', '/ECMain/ESZ/WebResource.axd?d=lUH5gyx3viKwZ61ppIG7FoVJNvzSJhIi7yHttrrdtL6JObWkbhVGT230-WvxeTtlUNdfV2KJGDCTfbXpGPBPMocDgZO3xaJk4LTjpJsIM5gF7dXndlO_aSP3w7-lMDzDyUrzckqu4ulnqNav5nMcKbz4KbaoiKSYkstuH6Exyp4kQoEAEV0ZbP5x_0IH1H3eTDiuCn0-WKSUTdCZN85OZeUgdJw1&t=635955736124225069', '/ECMain/ESZ/WebResource.axd?d=05_EeC2_D5JYjz_0ZYRNOhA8MGxOhVbn7EqBmR49N6eRwkugBVZv4fbgX9h3PwCXIgThN-E64KPG_MFbZLeHyfEwY38gZ4cFQczptNrQ9Gdmqtm1dd5G8lcEGPSvZWONxDmvI6lX6bDNi28pKasqUz3c8KZ2PHf0Ypa1zg3_bGFL-Zx4FFaWwyfSX82fkuxnTLWzDI0sZJe9rUn8y6efmppN2kw1&t=635955736124225069', '/ECMain/ESZ/WebResource.axd?d=3jZmiY6dxhtkKWiBilFYpdItbfNCccHVmle0jJjURpEE58yvnUOtPaUYd2V7N8953PWefx-p6NcK8MU88hA5iXBIqmZxHpAgPCk8aUXryRbl_WgxPKz8pXQce0FByLJG1Zi7kSktrqzJO6e411yUrrtbyI3DeSAj_BhckYz0n4DvehMomXhw24ZxLvywdn8pv134fJPuyAz7tDDQ3rXKtc0C82U1&t=635955736124225069', '/ECMain/ESZ/WebResource.axd?d=mpGJ5x1fF1AMz6abRfFz6M82Xp4oIO0ty9190Zp4FMwNyrHnTQCatdk2bDRI2If038hZQIhhAGVGHbRldz2fGq7OndkaPWALMGu9lhdJQnoRw8v8uew-Uo5LMCX4H6rXjSaxnMHqR5lbwZpL0aRK-S88W6u4PF5fRf7C3Tnm4NyxUQlnEu_HX82H6CiaDzBId-uGleZdCporZLwGmMLAE51lKHQ1&t=635955736124225069');
</script>
</span>
                    
                    </td>
                </tr>
                        
            
                <tr id="trWhCd" group="txtSWhCd_M">
                    <th style="width:115px"><div class="float_left">창고</div><div class="float_right"><img id="img_txtSWhCd" src="/ECMain/ECount.Common/Images/footer_arrow_down.gif" border="0" onclick="fnSubItemOpen(this, 'txtSWhCd', '2')" style="cursor:pointer;"></div></th>
                    <td><a href="#"><input type="text" name="txtSWhCd" id="txtSWhCd"   value="" onkeyup="fnValueSync('','txtSWhCd');" ondblclick="search_code(4,'','F','double','txtSWhCd',event);" onchange="search_code(4,'','F','search','txtSWhCd',event);" onkeypress="return fnEnterHandles1(this,event,'1');" onfocus="FocusColor(this);this.select();"onblur="BlurColor2(this);fnNextField('1','txtSWhCd');"  class="rightnone"  style="width:66px;"  /><a href="#" onclick="search_code(4,'','F','double','txtSWhCd',event);"><img src="/ECMain/ECount.Common/images/Icon_zoom.gif" width="22px" height="19px" alt="검색"  /></a><input type="text" name="txtSWhDes" id="txtSWhDes" class="grayleft"   value="" readonly value="" style="width:90px;"/>
                                   
                    </td>
                </tr>
        
            <tr id="trTreeWhCd"  style="display:none" group="txtSWhCd_G">
                <th style="width:115px"><div class="float_left">창고계층그룹</div><div class="float_right">&nbsp;</div></th>
                <td>
                    <input type="text" name="txtTreeWhCd" id="txtTreeWhCd" onkeyup="fnValueSync('','txtTreeWhCd');" ondblclick="search_code(14,'','','double','txtTreeWhCd',event);" onchange="search_code(14,'','','search','txtTreeWhCd',event);" onkeypress="return fnEnterHandles1(this,event,'1');" onfocus="FocusColor(this);this.select();" onblur="BlurColor2(this);fnNextField('1','txtTreeWhCd');" class="rightnone" value="" style="width:66px;"/><a href="#" onclick="search_code(14,'','','double','txtTreeWhCd',event);"><img src="/ECMain/ECount.Common/images/Icon_zoom.gif" width="22px" height="19px" alt="검색" /></a><input type="text" name="txtTreeWhNm" id="txtTreeWhNm" onkeyup="fnValueSync('','txtTreeWhNm');" class="grayleft" onfocus="fnNextField('1','txtTreeWhCd');" value="" style="width:90px;" readonly />
                    <input type="checkbox" name="cbSubTreeWh" id="cbSubTreeWh" value="1" onclick="fnSubTreeWhChange(this, '');" onkeypress="return fnEnterHandles1(this,event,'1');" onfocus="FocusColor(this);this.select();" />하위그룹포함검색
                </td>
            </tr>
               
                <tr id="trProdCd"  group="txtSProdCd_M">
                <th style="width:115px"><div class="float_left"  style="width:98px;" >품목코드</div><div class="float_right"><img id="img_txtSProdCd" src="/ECMain/ECount.Common/Images/footer_arrow_down.gif" border="0" onclick="fnSubItemOpen(this, 'txtSProdCd', '2')" style="cursor:pointer;"></div></th>
                <td><input type="text" name="txtSProdCd" id="txtSProdCd" onkeyup="fnValueSync('','txtSProdCd');" ondblclick="search_code(9,'','','double','txtSProdCd',event);" onchange="search_code(9,'','','search','txtSProdCd',event);" onkeypress="return fnEnterHandles1(this,event,'1');" onfocus="FocusColor(this);this.select();" onblur="BlurColor2(this);" class="rightnone" value="A001" style="width:66px;"/><a href="#" onclick="search_code(9,'','','double','txtSProdCd',event);"><img src="/ECMain/ECount.Common/images/Icon_zoom.gif" width="22px" height="19px" alt="검색" /></a><input type="text" name="txtSProdDes" id="txtSProdDes" class="grayleft" readonly  value="익스트림 울트라 명품 조립PC" style="width:90px;"/>&nbsp;&nbsp;
                
                <input type="hidden" name="hidProdChkDes" id="hidProdChkDes" />
                </td>
                </tr>
            
                <tr  style="display:none" group="txtSProdCd_G">
                    <input type="hidden" name="hidProdChkDes" id="hidProdChkDes" />
                    <th style="width:115px"><div class="float_left">품목구분</div><div class="float_right">&nbsp;</div></th>
                    <td><input type="radio" name="rbProdChk" id="rbProdChk0" onclick="fnValueSync('','rbProdChk0');" value="" onkeypress="return fnEnterHandles1(this,event,'1');" onclick="fn_ChkValue(this);" checked>전체
                    <input type="radio" name="rbProdChk" id="rbProdChk1" onclick="fnValueSync('','rbProdChk1');" value="0" onkeypress="return fnEnterHandles1(this,event,'1');" onclick="fn_ChkValue(this);" >원재료
                    <input type="radio" name="rbProdChk" id="rbProdChk2" onclick="fnValueSync('','rbProdChk2');" value="4" onkeypress="return fnEnterHandles1(this,event,'1');" onclick="fn_ChkValue(this);" >부재료
                    <input type="radio" name="rbProdChk" id="rbProdChk3" onclick="fnValueSync('','rbProdChk3');" value="1" onkeypress="return fnEnterHandles1(this,event,'1');" onclick="fn_ChkValue(this);" >제품
                    <input type="radio" name="rbProdChk" id="rbProdChk4" onclick="fnValueSync('','rbProdChk4');" value="2" onkeypress="return fnEnterHandles1(this,event,'1');" onclick="fn_ChkValue(this);" >반제품
                    <input type="radio" name="rbProdChk" id="rbProdChk5" onclick="fnValueSync('','rbProdChk5');" value="3" onkeypress="return fnEnterHandles1(this,event,'1');" onclick="fn_ChkValue(this);" >상품
                    </td>
                </tr>
        
                <tr  style="display:none" group="txtSProdCd_G">
                    <th style="width:115px"><div class="float_left">품목그룹</div><div class="float_right">&nbsp;</div></th>
                    <td><input type="text" name="txtClassCd" id="txtClassCd" onkeyup="fnValueSync('','txtClassCd');" ondblclick="search_code(10,'','','double','txtClassCd',event);" onchange="search_code(10,'','','search','txtClassCd',event);" onkeypress="return fnEnterHandles1(this,event,'1');" onfocus=" FocusColor(this);this.select();" onblur="BlurColor2(this);" class="rightnone" value="" style="width:66px;"/><a href="#" onclick="search_code(10,'','','double','txtClassCd',event);"><img src="/ECMain/ECount.Common/images/Icon_zoom.gif" width="22px" height="19px" alt="검색" /></a><input type="text" name="txtClassDes" id="txtClassDes" class="grayleft" readonly  value="" style="width:90px;"/><img src="/ECMain/ECount.Common/images/icon_s.gif" width="12px" height="18px" /><input type="text" name="txtClassCd2" id="txtClassCd2" onkeyup="fnValueSync('','txtClassCd2');" ondblclick="search_code(10,'','2','double','txtClassCd2',event);" onchange="search_code(10,'','2','search','txtClassCd2',event);"  onkeypress="return fnEnterHandles1(this,event,'1');" onfocus="FocusColor(this);this.select();" onblur="BlurColor2(this);" class="rightnone" value="" style="width:66px;"/><a href="#"  onclick="search_code(10,'','2','double','txtClassCd2',event);"><img src="/ECMain/ECount.Common/images/Icon_zoom.gif" width="22px" height="19px" alt="검색" /></a><input type="text" name="txtClassDes2" id="txtClassDes2" class="grayleft" readonly  value="" style="width:90px;"/><img src="/ECMain/ECount.Common/images/icon_s.gif" width="12px" height="18px"/><input type="text" name="txtClassCd3" id="txtClassCd3" onkeyup="fnValueSync('','txtClassCd3');" ondblclick="search_code(10,'','3','double','txtClassCd3',event);" onchange="search_code(10,'','3','search','txtClassCd3',event);"  onkeypress="return fnEnterHandles1(this,event,'1');" onfocus="FocusColor(this);this.select();" onblur="BlurColor2(this);" class="rightnone" value="" style="width:66px;"/><a href="#" onclick="search_code(10,'','3','double','txtClassCd3',event);"><img src="/ECMain/ECount.Common/images/Icon_zoom.gif" width="22px" height="19px" alt="검색" /></a><input type="text" name="txtClassDes3" id="txtClassDes3" class="grayleft" readonly  value="" style="width:90px;"/>
                    </td>
                </tr>
        
            <tr id="trTreeGroupCd"  style="display:none" group="txtSProdCd_G">
                <th style="width:115px"><div class="float_left">품목계층그룹</div><div class="float_right">&nbsp;</div></th>
                <td>
                    <input type="text" name="txtTreeGroupCd" id="txtTreeGroupCd" onkeyup="fnValueSync('','txtTreeGroupCd');" ondblclick="search_code(12,'','','double','txtTreeGroupCd',event);" onchange="search_code(12,'','','search','txtTreeGroupCd',event);" onkeypress="return fnEnterHandles1(this,event,'1');" onfocus="FocusColor(this);this.select();" onblur="BlurColor2(this);" class="rightnone" value="" style="width:66px;"/><a href="#" onclick="search_code(12,'','','double','txtTreeGroupCd',event);"><img src="/ECMain/ECount.Common/images/Icon_zoom.gif" width="22px" height="19px" alt="검색" /></a><input type="text" name="txtTreeGroupNm" id="txtTreeGroupNm" onkeyup="fnValueSync('','txtTreeGroupNm');" class="grayleft" value="" style="width:90px;" readonly />
                    <input type="checkbox" name="cbSubTree" id="cbSubTreeG" value="1" onclick="fnSubTreeGroupChange(this, '');" onkeypress="return fnEnterHandles1(this,event,'1');" onfocus="FocusColor(this);this.select();" />하위그룹포함검색
                </td>
            </tr>            
        
                <input type="hidden" name="txtItemCd" id="txtItemCd" value="" />
                <input type="hidden" name="txtItemDes" id="txtItemDes" value="" />  
                
                <tr group="">
                    <th style="width:115px"><div class="float_left">구분</div><div class="float_right">&nbsp;</div></th>
                    <td>
                            <input type="radio" id="rbSumGubun0" name="rbSumGubun" value="0" onclick="fnValueSync('','rbSumGubun0');SumGubunChk(1, '');" checked onkeypress="return fnEnterHandles1(this,event,'1');">일반
                            <input type="radio" id="rbSumGubun1" name="rbSumGubun" value="1"  onclick="fnValueSync('','rbSumGubun1');SumGubunChk(1, '');"  onkeypress="return fnEnterHandles1(this,event,'1');">집계표형식
                            <input type="radio" id="rbSumGubun2" name="rbSumGubun" value="2"  onclick="fnValueSync('','rbSumGubun2');SumGubunChk(1, '');"  onkeypress="return fnEnterHandles1(this,event,'1');">일자별(횡)
                            <label id="lblSumCheck" style="visibility:hidden">
                                <input type="checkbox" name="cbSumCheck" id="cbSumCheck" value="1" onclick="fnValueSync('','cbSumCheck');" onfocus="nextfield = 'cbRptConfirm'" >집계
                            </label>
                        
                    </td>
                </tr>
        
                <tr>
                    <th style="width:115px">기타</th><!--기타-->
                    <td>
                        <input type="checkbox" name="cbRptConfirm" id="cbRptConfirm" value="1" onclick="fnValueSync('','cbRptConfirm');"
onfocus="nextfield='btnSearch';" />결재방표시<!--결재방r인쇄-->

                    
                        <input type="checkbox"  name="cbBalFlag" id="cbBalFlag" value="1" onclick="fnValueSync('','cbBalFlag');" onkeypress="return fnEnterHandles1(this,event,'1');" />수량관리제외품목포함<!--수불제외품목 포함 -->
                    
                        <input type="checkbox"  name="cbZeroFlag2" id="cbZeroFlag2" value="1" onclick="fnValueSync('','cbZeroFlag2');"   onkeypress="return fnEnterHandles1(this,event,'1');"  /><span id="spZeroFlag2" name="spZeroFlag2">입출고수량0제외</span><!--입출고수량 0 제외-->
                    
                        <input type="checkbox" name="cbMainProdFlag" id="cbMainProdFlag"  value = "1" onclick="fnValueSync('','cbMainProdFlag');" onkeypress="return fnEnterHandles1(this,event,'1');" />주품목기준환산<!-- 주품목기준환산-->
                    
                            <input type="checkbox" name="cbMoveStore"  onkeypress="return fnEnterHandles1(this,event,'1');" id="cbMoveStore" onclick="fnValueSync('','cbMoveStore');" value="1" onblur="nextfield='none';"    />생산불출/창고이동포함<!--생산불출/창고이동 포함-->
                        
                        <input type="checkbox" name="hicbProdNameSort" id="hicbProdNameSort" onclick="fnValueSync('','hicbProdNameSort');"  onfocus="nextfield='btnSearch';" onblur="nextfield='none';" value="1" />품목명(정렬)
                    
                        <input type="checkbox" name="cbDelFlag" id="cbDelFlag"  value = "1" onclick="fnValueSync('','cbDelFlag');" 
onfocus="nextfield='btnSearch';" checked  />사용중단품목포함
                    
                    </td>
                </tr>
            
                <input type="hidden" name="ddlSubCode" id="ddlSubCode" value="G1080/한국에어로(주)"/>
                                            
				<tr>
					<th style="width:115px">간편검색</th><!--간편검색-->
					
						<td><a href="#" id="btnToDay" name="btnToDay" class="list_link" onclick="fnSimpleSearch('2016,07,28','2016,07,28')">금일</a>&nbsp;&nbsp;<!--금일--><a href="#" id="btnYesterDay" name="btnYesterDay" class="list_link" onclick="fnSimpleSearch('2016,07,27','2016,07,27')">전일</a>&nbsp;&nbsp;<!--전일--><a href="#" id="btnWeek" name="btnWeek" class="list_link" onclick="fnSimpleSearch('2016,07,24','2016,07,28')">금주</a>&nbsp;&nbsp;<!--금주-->	<a href="#" id="btnLastWeek" name="btnLastWeek" class="list_link" onclick="fnSimpleSearch('2016,07,17','2016,07,23')" >전주</a>&nbsp;&nbsp;<!--전주--><a href="#" id="btnMonth" name="btnMonth" class="list_link" onclick="fnSimpleSearch('2016,07,01','2016,07,28')">금월</a>&nbsp;&nbsp;<!--금월--><a href="#" id="btnLastMonth" name="btnLastMonth" class="list_link" onclick="fnSimpleSearch('2016,06,01','2016,06,30')">전월</a>&nbsp;&nbsp;<!--전월--><a href="#" id="btnEndDay" name="btnEndDay" class="list_link" onclick="fnSimpleSearch('EndDay', '')">종료일</a>&nbsp;&nbsp;<!--종료일-->
                        </td>
					
				</tr>
			
            <input type="hidden" id="hidLastField2" name="hidLastField2" value="EtcChk" />
			<input type="hidden" id="hidLastFieldGroup2" name="hidLastFieldGroup2" value="" />
            </table>
        </span> <!--tab01-->
       
       
       
    
     <!--기본사항끝-->
     

    <div class="search-button">
    

        <span class="btn blue-inverse"><input name="btnSearch" onclick="frmSearchData(-1, true);" type="button" id="btnSearch" onkeydown=""  value="검색(F8)" /></span>
    
        <label class="select_top">
    
        <select name="ddlFormSer" id="ddlFormSer"  onclick="fnEtcChkSer();" >
    
    
            <option  value="99999"selected>출력물</option>
    
            <option  value="0">현황</option>
    
    </select>
    
    </label>
    
    </div><!-- endof [search_btnpart] 검색버튼 -->
            
            
    </div>
    </fieldset>
    <input type="hidden" id="hidSearchXml" name="hidSearchXml" />
    <input type="hidden" name="hidFavSeq" id="hidFavSeq"/>
    
    <input type="hidden" id="hidSearchXml2" name="hidSearchXml2" value=""/>
    
    <input type="hidden" id="NEWFLAG" name="NEWFLAG" value="" /><!--센터 오픈시  제거해야함-->
    <input type="hidden" id="hidFmType" name="hidFmType" value="" />
    <input type="hidden" id="hidGubun" name="hidGubun" value="" />
    <input type="hidden" id="hidAFlag" name="hidAFlag" value="" />
    <input type="hidden" id="hidPageGubun" name="hidPageGubun" value="" />
     <input type="hidden" id="strListType" name="strListType" value="" />
    <input type="hidden" id="strListFlag" name="strListFlag" value="" />
     <input type="hidden" id="strSort" name="strSort" value="" />
    <input type="hidden" id="strSearchCode" name="strSearchCode" value="" />
    <input type="hidden" id="strSortAd" name="strSortAd" value="" />
    <input type="hidden" id="hidPFlag" name="hidPFlag" value="T" />
    <input type="hidden" id="hidSaleGubun" name="hidSaleGubun" value="" />
    <input type="hidden" id="hidPrev" name="hidPrev" value="" />
    <input type="hidden" id="hfButtonCnt" value="0" />
    <input type="hidden" id="hidTabGubun" name="hidTabGubun" value="1" />
    <input type="hidden" id="hidTabFirsts" name="hidTabFirsts" value="ddlSYear|ddlSYear" />

    <input type="hidden" name="hidGroupDisplay" id="hidGroupDisplay" value="">
	<input type="hidden" name="hidGroupBasicDisplay" id="hidGroupBasicDisplay" value="">

<input type="hidden" id="hidEyymm" name="hidEyymm" />
<input type="hidden" id="hidAccCloseCheckDate" name="hidAccCloseCheckDate" />
<input type="hidden" id="hidListYnSearch" name="hidListYnSearch" value="N" />

<input type="hidden" id="hidStetOrderFlag" name="hidStetOrderFlag" value="N"/>
</form>

 			
            </div>

			<span class="btn-print-search" onclick="fnShowSearch2(this); return false;"></span>
		</div>        
	</div>
    
    <!-- 이중추가버튼 -->
    <div class="dual-btn-fixed">
	    <div class="dual-btn-area p-print-btn">
		    <div class="float_left">           
                    
                <span class="btn blue-inverse"><input type="button" id="btnPrint" value="인쇄" onclick="printURL2(''); return false;" /></span>
                <span class="btn gray"><input type="button" id="btnExcel" onclick="ExcelPageMovement('/ECMain/ESZ/ESZ003E.aspx');" value="Excel" /></span>                      
                <span class="btn gray"><input type="button" id="btnPreview" value="미리보기" onclick="getPreviewPrint2(); return false;" /></span>                
               
            </div>            
	    </div>
    </div>
     
<!-- ***** 서치버튼 끝 **** -->

<!-- ***** 작업영역 시작 **** -->    

<!-- ***** 프린트 시작 ***** -->
<div id="idPrint" class="P_45px">
    <div id="contents" style="width:650px;">
        
                    <div id="print_title">
                        <ul>
                            <li > <table width='650px' border='0' cellspacing='0' cellpadding='0'>    <tr> <td align='center'> <table> <tr> <td align='center' class='bigtitle'>재고수불부 I</td> </tr> </table> </td> </tr> </table> </li>
                        </ul>
                    </div>
                    
                    <br />
                    <div id="divContainer" class="container H_35px">
                        <p class="float_left">회사명 : 한국에어로(주)
                                 / 익스트림 울트라 명품 조립PC
                        </p>
                        <p class="float_left p_txtBg">
                          A001
                        </p>
                        <p class="float_right">
                            2016/07/01 ~ 2016/07/28
                            
                        </p>   
                    </div>
                        <table class="p_table" summary="">
                        <col width="11%" /><col width="" /><col width="21%" /><col width="13%" /><col width="13%" /><col width="13%" />
	                        <thead>
                                <th class="p_th">날짜</th> <!--날 짜-->
                                <th class="p_th">거래처</th><!--거래처-->
                                <th class="p_th">적요</th><!--적요-->
                                <th class="p_th">입고수량</th><!--입고수량-->
                                <th class="p_th">출고수량</th><!--출고수량-->
                                <th class="p_th">재고수량</th><!--재고수량-->
                            </thead>
                            <tbody>

                        <tr>
                            <td class="p_td p_redC" colspan="5"><strong>전월이월</strong></td>
                            <td class="p_td right"><strong>1,241</strong></td>
                        </tr>
                
                        <tr>
                            <td class="p_td center"><a href="javascript:PageMovement('/ECMain/ESM/ESM003M.aspx','58','20160701','1','1','1');" class="list_link">16/07/01</a></td>
                            <td class="p_td"><div style="width:100;overflow:hidden;text-overflow:ellipsis;"><nobr>[조정] </nobr></div></td>
                            <td class="p_td"></td>
                            <td class="p_td right"></td>
                            <td class="p_td right">35</td>
                            <td class="p_td right">1,206</td>
                        </tr>
                
                        <tr>
                            <td class="p_td center"><a href="javascript:PageMovement('/ECMain/ESM/ESM003M.aspx','58','20160701','2','1','1');" class="list_link">16/07/01</a></td>
                            <td class="p_td"><div style="width:100;overflow:hidden;text-overflow:ellipsis;"><nobr>[조정] </nobr></div></td>
                            <td class="p_td"></td>
                            <td class="p_td right"></td>
                            <td class="p_td right">2</td>
                            <td class="p_td right">1,204</td>
                        </tr>
                
                        <tr>
                            <td class="p_td center"><a href="javascript:PageMovement('/ECMain/ESJ/ESJ009M.aspx','42','20160702','1','1','1');" class="list_link">16/07/02</a></td>
                            <td class="p_td"><div style="width:100;overflow:hidden;text-overflow:ellipsis;"><nobr>[생산] 작업지시서:06/02-1 - 조립공장</nobr></div></td>
                            <td class="p_td">생산전표에 표시될 비고사항을 입력할 수 있습니다.</td>
                            <td class="p_td right">90</td>
                            <td class="p_td right"></td>
                            <td class="p_td right">1,294</td>
                        </tr>
                
                        <tr>
                            <td class="p_td center"><a href="javascript:PageMovement('/ECMain/ESJ/ESJ009M.aspx','42','20160706','1','1','1');" class="list_link">16/07/06</a></td>
                            <td class="p_td"><div style="width:100;overflow:hidden;text-overflow:ellipsis;"><nobr>[생산] 작업지시서:06/06-1 - 조립공장</nobr></div></td>
                            <td class="p_td">생산전표에 표시될 비고사항을 입력할 수 있습니다.</td>
                            <td class="p_td right">90</td>
                            <td class="p_td right"></td>
                            <td class="p_td right">1,384</td>
                        </tr>
                
                        <tr>
                            <td class="p_td center"><a href="javascript:PageMovement('/ECErp/ESD/ESD006M','11','20160716','1','1','1');" class="list_link">16/07/16</a></td>
                            <td class="p_td"><div style="width:100;overflow:hidden;text-overflow:ellipsis;"><nobr>좋은컴퓨터</nobr></div></td>
                            <td class="p_td">다양한 내역을 입력해보세요</td>
                            <td class="p_td right"></td>
                            <td class="p_td right">700</td>
                            <td class="p_td right">684</td>
                        </tr>
                
                        <tr>
                            <td class="p_td center"><a href="javascript:PageMovement('/ECMain/ESM/ESM003M.aspx','59','20160716','1','1','1');" class="list_link">16/07/16</a></td>
                            <td class="p_td"><div style="width:100;overflow:hidden;text-overflow:ellipsis;"><nobr>[자가] 좋은컴퓨터</nobr></div></td>
                            <td class="p_td">다양한 내역을 입력해보세요</td>
                            <td class="p_td right"></td>
                            <td class="p_td right">1</td>
                            <td class="p_td right">683</td>
                        </tr>
                
                        <tr>
                            <td class="p_td center"><a href="javascript:PageMovement('/ECMain/ESJ/ESJ009M.aspx','42','20160725','1','1','1');" class="list_link">16/07/25</a></td>
                            <td class="p_td"><div style="width:100;overflow:hidden;text-overflow:ellipsis;"><nobr>[생산]  - 조립공장</nobr></div></td>
                            <td class="p_td"></td>
                            <td class="p_td right">100</td>
                            <td class="p_td right"></td>
                            <td class="p_td right">783</td>
                        </tr>
                
                        <tr>
                            <td class="p_td center"><a href="javascript:PageMovement('/ECMain/ESJ/ESJ008M.aspx','43','20160725','2','1','1');" class="list_link">16/07/25</a></td>
                            <td class="p_td"><div style="width:100;overflow:hidden;text-overflow:ellipsis;"><nobr>[생산] 작업지시서:07/02-1 - 조립공장</nobr></div></td>
                            <td class="p_td"></td>
                            <td class="p_td right">60</td>
                            <td class="p_td right"></td>
                            <td class="p_td right">843</td>
                        </tr>
                
                        <tr>
                            <td class="p_td center"><a href="javascript:PageMovement('/ECMain/ESJ/ESJ008M.aspx','43','20160726','1','1','1');" class="list_link">16/07/26</a></td>
                            <td class="p_td"><div style="width:100;overflow:hidden;text-overflow:ellipsis;"><nobr>[생산] 작업지시서:07/25-1 - 조립공장</nobr></div></td>
                            <td class="p_td"></td>
                            <td class="p_td right">10</td>
                            <td class="p_td right"></td>
                            <td class="p_td right">853</td>
                        </tr>
                
                        <tr>
                            <td class="p_td center"><a href="javascript:PageMovement('/ECMain/ESJ/ESJ008M.aspx','43','20160726','2','1','1');" class="list_link">16/07/26</a></td>
                            <td class="p_td"><div style="width:100;overflow:hidden;text-overflow:ellipsis;"><nobr>[생산] 작업지시서:07/25-1 - 포장공장</nobr></div></td>
                            <td class="p_td"></td>
                            <td class="p_td right">20</td>
                            <td class="p_td right"></td>
                            <td class="p_td right">873</td>
                        </tr>
                
                        <tr>
                            <td class="p_td center"><a href="javascript:PageMovement('/ECMain/ESJ/ESJ008M.aspx','43','20160726','3','1','1');" class="list_link">16/07/26</a></td>
                            <td class="p_td"><div style="width:100;overflow:hidden;text-overflow:ellipsis;"><nobr>[생산] 작업지시서:12/06-1 - 조립공장</nobr></div></td>
                            <td class="p_td"></td>
                            <td class="p_td right">90</td>
                            <td class="p_td right"></td>
                            <td class="p_td right">963</td>
                        </tr>
                
                        <tr>
                            <td class="p_td center"><a href="javascript:PageMovement('/ECErp/ESD/ESD006M','11','20160726','8','1','1');" class="list_link">16/07/26</a></td>
                            <td class="p_td"><div style="width:100;overflow:hidden;text-overflow:ellipsis;"><nobr>[구매]좋은컴퓨터</nobr></div></td>
                            <td class="p_td">다양한 내역을 입력해보세요</td>
                            <td class="p_td right"></td>
                            <td class="p_td right">50</td>
                            <td class="p_td right">913</td>
                        </tr>
                
                        <tr>
                            <td class="p_td center"><a href="javascript:PageMovement('/ECMain/ESJ/ESJ008M.aspx','43','20160728','3','2','1');" class="list_link">16/07/28</a></td>
                            <td class="p_td"><div style="width:100;overflow:hidden;text-overflow:ellipsis;"><nobr>[생산] 작업지시서:08/02-1 - 포장공장</nobr></div></td>
                            <td class="p_td"></td>
                            <td class="p_td right">80</td>
                            <td class="p_td right"></td>
                            <td class="p_td right">993</td>
                        </tr>
                
                        <tr>
                            <td class="p_td center"><a href="javascript:PageMovement('/ECMain/ESJ/ESJ009M.aspx','42','20160728','5','1','1');" class="list_link">16/07/28</a></td>
                            <td class="p_td"><div style="width:100;overflow:hidden;text-overflow:ellipsis;"><nobr>[생산] 작업지시서:07/28-1 - 조립공장</nobr></div></td>
                            <td class="p_td"></td>
                            <td class="p_td right">9,000</td>
                            <td class="p_td right"></td>
                            <td class="p_td right">9,993</td>
                        </tr>
                
                        <tr>
                            <td class="p_td center"><a href="javascript:PageMovement('/ECMain/ESJ/ESJ008M.aspx','43','20160728','6','2','1');" class="list_link">16/07/28</a></td>
                            <td class="p_td"><div style="width:100;overflow:hidden;text-overflow:ellipsis;"><nobr>[생산] 작업지시서:09/02-1 - 조립공장</nobr></div></td>
                            <td class="p_td"></td>
                            <td class="p_td right">90</td>
                            <td class="p_td right"></td>
                            <td class="p_td right">10,083</td>
                        </tr>
                
                        <tr>
                            <td class="p_td center"><a href="javascript:PageMovement('/ECMain/ESJ/ESJ009M.aspx','42','20160728','7','2','1');" class="list_link">16/07/28</a></td>
                            <td class="p_td"><div style="width:100;overflow:hidden;text-overflow:ellipsis;"><nobr>[생산] 작업지시서:12/06-1 - 포장공장</nobr></div></td>
                            <td class="p_td"></td>
                            <td class="p_td right">90</td>
                            <td class="p_td right"></td>
                            <td class="p_td right">10,173</td>
                        </tr>
                
                        <tr>
                            <td class="p_td center"><a href="javascript:PageMovement('/ECMain/ESJ/ESJ008M.aspx','43','20160728','8','2','1');" class="list_link">16/07/28</a></td>
                            <td class="p_td"><div style="width:100;overflow:hidden;text-overflow:ellipsis;"><nobr>[생산] 작업지시서:12/06-1 - 조립공장</nobr></div></td>
                            <td class="p_td"></td>
                            <td class="p_td right">90</td>
                            <td class="p_td right"></td>
                            <td class="p_td right">10,263</td>
                        </tr>
                
                        <tr>
                            <td class="p_td center"><a href="javascript:PageMovement('/ECMain/ESJ/ESJ009M.aspx','42','20160728','9','2','1');" class="list_link">16/07/28</a></td>
                            <td class="p_td"><div style="width:100;overflow:hidden;text-overflow:ellipsis;"><nobr>[생산] 작업지시서:12/06-1 - 조립공장</nobr></div></td>
                            <td class="p_td"></td>
                            <td class="p_td right">100</td>
                            <td class="p_td right"></td>
                            <td class="p_td right">10,363</td>
                        </tr>
                
                        <tr>
                            <td class="p_td center"><a href="javascript:PageMovement('/ECErp/ESD/ESD006M','11','20160728','5','1','1');" class="list_link">16/07/28</a></td>
                            <td class="p_td"><div style="width:100;overflow:hidden;text-overflow:ellipsis;"><nobr></nobr></div></td>
                            <td class="p_td"></td>
                            <td class="p_td right"></td>
                            <td class="p_td right">2</td>
                            <td class="p_td right">10,361</td>
                        </tr>
                
                        <tr class="p_graybgB"> 
                            <td class="p_td center" colspan="3">[ 2016년 7월 월계 ]</td>
                            <td class="p_td right">9,910</td>
                            <td class="p_td right">790</td>
                            <td class="p_td">&nbsp;</td>
                        </tr>

                                    <tr class="p_graybgB"> 
                                        <td class="p_td center" colspan="3">누계</td>
                                        <td class="p_td right">9,910</td>
                                        <td class="p_td right">790</td>                                        
                                        <td class="p_td right">10,361</td>
                                    </tr>

                            </tbody>
                        </table>
                    <div class="container H_2px">
                      <p class="float_left">[P. 1]</p>
                      <p class="float_right">2016년 7월 28일 오후 3:40:33</p>
                    </div>
                    
                
        
            </tbody>
        </table>
        
    </div><!-- //contents -->
</div> <!-- //idPrint -->

 </div> <!-- //wrap -->
 





<form id="frmDetail">
<input type="hidden" name="hidSearchXml" id="SearchXml" value="<root><ddlSYear><![CDATA[2016]]></ddlSYear><ddlSMonth><![CDATA[07]]></ddlSMonth><txtSDay><![CDATA[01]]></txtSDay><ddlEYear><![CDATA[2016]]></ddlEYear><ddlEMonth><![CDATA[07]]></ddlEMonth><txtEDay><![CDATA[28]]></txtEDay><txtSWhCd><![CDATA[]]></txtSWhCd><txtSWhDes><![CDATA[]]></txtSWhDes><txtItemCd><![CDATA[]]></txtItemCd><txtItemDes><![CDATA[]]></txtItemDes><txtSProdCd><![CDATA[A001]]></txtSProdCd><txtSProdDes><![CDATA[익스트림 울트라 명품 조립PC]]></txtSProdDes><txtClassCd><![CDATA[]]></txtClassCd><txtClassDes><![CDATA[]]></txtClassDes><txtClassCd2><![CDATA[]]></txtClassCd2><txtClassDes2><![CDATA[]]></txtClassDes2><txtClassCd3><![CDATA[]]></txtClassCd3><txtClassDes3><![CDATA[]]></txtClassDes3><rbProdChk><![CDATA[]]></rbProdChk><rbSumGubun><![CDATA[0]]></rbSumGubun><cbBalFlag><![CDATA[0]]></cbBalFlag><M_RptGubun><![CDATA[1]]></M_RptGubun><txtTreeGroupCd><![CDATA[]]></txtTreeGroupCd><txtTreeGroupNm><![CDATA[]]></txtTreeGroupNm><cbSubTree><![CDATA[0]]></cbSubTree><txtTreeWhCd><![CDATA[]]></txtTreeWhCd><txtTreeWhNm><![CDATA[]]></txtTreeWhNm><cbSubTreeWh><![CDATA[0]]></cbSubTreeWh><cbRptConfirm><![CDATA[0]]></cbRptConfirm><cbDelFlag><![CDATA[1]]></cbDelFlag><cbZeroFlag2><![CDATA[0]]></cbZeroFlag2><cbMoveStore><![CDATA[]]></cbMoveStore><hicbProdNameSort><![CDATA[]]></hicbProdNameSort><M_SortAD><![CDATA[]]></M_SortAD><M_Type><![CDATA[]]></M_Type><M_Date><![CDATA[]]></M_Date><M_No><![CDATA[0]]></M_No><cbMainProdFlag><![CDATA[]]></cbMainProdFlag><M_FocusX><![CDATA[0]]></M_FocusX><M_FocusY><![CDATA[0]]></M_FocusY><M_EditFlag><![CDATA[M]]></M_EditFlag><M_Pgm><![CDATA[]]></M_Pgm><M_SerNo><![CDATA[]]></M_SerNo><ddlFormSer><![CDATA[]]></ddlFormSer><M_BtnFlag><![CDATA[]]></M_BtnFlag></root>" />
<input type="hidden" name="hidSessionKey" id="hidSessionKey" value="ESZ_ESZ003RG1080GUEST636053172332215486" />
<input type="hidden" name="hidTotalCnt" id="hidTotalCnt" value="20" />  
<input type="hidden" name="IO_DATE" id="IO_DATE" /> 
<input type="hidden" name="IO_NO" id="IO_NO" /> 
<input type="hidden" name="IO_TYPE" id="IO_TYPE" /> 
<input type="hidden" name="SER_NO" id="SER_NO" value="1" /> 
<input type="hidden" name="EditFlag" id="EditFlag" value ="M" /> 
<input type="hidden" name="URL" id="URL" value ="/ECMAIN/ESZ/ESZ003R.aspx" /> 
<input type="hidden" name="isOpenPopup" id="isOpenPopup" />
<input type="hidden" name="searchData" id="searchData" value="<root><ddlSYear><![CDATA[2016]]></ddlSYear><ddlSMonth><![CDATA[07]]></ddlSMonth><txtSDay><![CDATA[01]]></txtSDay><ddlEYear><![CDATA[2016]]></ddlEYear><ddlEMonth><![CDATA[07]]></ddlEMonth><txtEDay><![CDATA[28]]></txtEDay><txtSWhCd><![CDATA[]]></txtSWhCd><txtSWhDes><![CDATA[]]></txtSWhDes><txtItemCd><![CDATA[]]></txtItemCd><txtItemDes><![CDATA[]]></txtItemDes><txtSProdCd><![CDATA[A001]]></txtSProdCd><txtSProdDes><![CDATA[익스트림 울트라 명품 조립PC]]></txtSProdDes><txtClassCd><![CDATA[]]></txtClassCd><txtClassDes><![CDATA[]]></txtClassDes><txtClassCd2><![CDATA[]]></txtClassCd2><txtClassDes2><![CDATA[]]></txtClassDes2><txtClassCd3><![CDATA[]]></txtClassCd3><txtClassDes3><![CDATA[]]></txtClassDes3><rbProdChk><![CDATA[]]></rbProdChk><rbSumGubun><![CDATA[0]]></rbSumGubun><cbBalFlag><![CDATA[0]]></cbBalFlag><M_RptGubun><![CDATA[1]]></M_RptGubun><txtTreeGroupCd><![CDATA[]]></txtTreeGroupCd><txtTreeGroupNm><![CDATA[]]></txtTreeGroupNm><cbSubTree><![CDATA[0]]></cbSubTree><txtTreeWhCd><![CDATA[]]></txtTreeWhCd><txtTreeWhNm><![CDATA[]]></txtTreeWhNm><cbSubTreeWh><![CDATA[0]]></cbSubTreeWh><cbRptConfirm><![CDATA[0]]></cbRptConfirm><cbDelFlag><![CDATA[1]]></cbDelFlag><cbZeroFlag2><![CDATA[0]]></cbZeroFlag2><cbMoveStore><![CDATA[]]></cbMoveStore><hicbProdNameSort><![CDATA[]]></hicbProdNameSort><M_SortAD><![CDATA[]]></M_SortAD><M_Type><![CDATA[]]></M_Type><M_Date><![CDATA[]]></M_Date><M_No><![CDATA[0]]></M_No><cbMainProdFlag><![CDATA[]]></cbMainProdFlag><M_FocusX><![CDATA[0]]></M_FocusX><M_FocusY><![CDATA[0]]></M_FocusY><M_EditFlag><![CDATA[M]]></M_EditFlag><M_Pgm><![CDATA[]]></M_Pgm><M_SerNo><![CDATA[]]></M_SerNo><ddlFormSer><![CDATA[]]></ddlFormSer><M_BtnFlag><![CDATA[]]></M_BtnFlag></root>" />
<input type="hidden" name="isOldFramePreFlag" id="isOldFramePreFlag" />
<input type="hidden" name="isViewPreButton" id="isViewPreButton" />
<input type="hidden" name="isViewListButton" id="isViewListButton" />
</form>
<iframe name="ifrmExcel" style="width:0px; height:0px"></iframe> 
<script language="javascript" type="text/javascript">
    scroll_focus("x",0,0,"body");
    scroll_focus("y",0,0,"body");
 </script>
</body>
</html>