<?
session_start();

//=======================================================>
define('DB_HOST',"localhost");
define('DB_NAME',"exian");
define('DB_USER','exian');
define('DB_PASSWORD','since1970');
define('ROOT',$_SERVER["DOCUMENT_ROOT"]);

mysql_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die ("Connect Error");
$status = mysql_select_db(DB_NAME);
mysql_query("set names 'utf8'");
if(!$status) msg("Connect Error");
//=========================================================>
$sql = "update member set room_no=".$_GET['uid']." where mem_id='".$_SESSION['mem_id']."'";
mysql_query($sql);

$sql = "select * from qz_room where uid=".$_GET['uid'];
$result = mysql_query($sql);
$t = mysql_fetch_object($result);
?>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<div>
	<input type="button" value="로그아웃" onclick="logout()" /> <input type="button" value="방나가기" onclick="outRoom()" />
</div>

<input type="text" name="uid" id="uid" value="<?=$_GET['uid']?>" />

<div><?=$t->room_name?></div>
	<div>
	<div id="login_user" style="width:150px; height:200px; float:left; border:1px solid #000"></div>
	<div style="width:500px; float:left">
		<div id="msgWin" style="width:100%; border:1px solid #000; height:300px; overflow:scroll">
		</div>
		<div>
			<input type="text" name="msg" id="msg" /><input type="button" value="전송" onclick="registMsg()" />
		</div>
	</div>
	<div id="room_user" style="width:150px; height:200px; float:left; border:1px solid #000"></div>
</div>

<script>
$(function() {
	setInterval(function() {
		getUser();
		getRoomUser();
		getMsg();
	}, 1000); // 1분에 한번
});

function logout() {
	$.ajax({
		type : "post",
		url : "logout.php",
		success : function() {
			location.href = "login.php";
		}
	});
}

// 로그인한 사용자 가져오기
function getUser() {
	tag = "";
	$.getJSON("getUser.php",{},
		function(json) {
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++) {
					tag += "<div>" + json[i].mem_id + "</div>";
				}

				$("#login_user").html(tag);
			} else {
				$("#login_user").html("");
			}
		}
	);
}

function getRoomUser() {
	tags = "";
	$.getJSON("getUser1.php",{"uid" : $("#uid").val()},
		function(json) {
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++) {
					tags += "<div>" + json[i].mem_id + "</div>";
				}

				$("#room_user").html(tags);
			}
		}
	);
}

function registMsg() {
	var dataString = "msg=" + $("#msg").val() + "&uid=" + $("#uid").val();
	$.ajax({
		type : "post",
		data : dataString,
		url : "_registMsg.php",
		success : function(str) {
			$("#msg").val("");
		}
	});
}

function getMsg() {
	var tag = "";
	$.getJSON("getMsg.php",{"uid" : $("#uid").val()},
		function(json) {
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++) {
					if(json[i].mem_id == '<?=$_SESSION[mem_id]?>') {
						var sty = "float:right";
					} else {
						var sty = "float:left";
					}
					tag += "<div style='" + sty + "'>" + json[i].mem_id + " : " + json[i].msg + "[" + json[i].create_dt + "]</div>";
					tag += "<div style='clear:both'></div>";
				}

				$("#msgWin").html(tag);
			}
		}
	);
}

function outRoom() {
	var dataString = "uid=" + $("#uid").val();
	$.ajax({
		type : "post",
		data : dataString,
		url : "roomOut.php",
		success : function(str) {
			//if(str == "success") location.href = "roomList.php";
		} 
	});
}

// 현재 채팅방에 들어온 사용자 가져오기
// 채팅내용가져오기
</script>