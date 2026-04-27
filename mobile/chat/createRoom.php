<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>    
<table width="100" cellpadding="0" cellspacing="0" border="1">
	<tr>
		<td>방제</td>
		<td><input type="text" name="room_name" id="room_name" /></td>
	</tr>
</table>
<input type="button" value="방생성" onclick="createRoom()" />
<script>
function createRoom() {
	var dataString = "room_name=" + $("#room_name").val();
	$.ajax({
		type : "post",
		data : dataString,
		url : "_createRoom.php",
		success : function(str) {
			if(str == "success") {
				location.href = "chat.php";
			} else {
				alert(str);
			}
		}
	});
}
</script>