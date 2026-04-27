<!DOCTYPE html>
<html lang="ko">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">   
    <title>친구목록 페이지</title>   

  </head>
  <body>
    <div class="wrap_Friends">
      <h1>개설된 방 리스트</h1>
      <table id="tb">
	<thead>
		<tr>
			<td>방제목</td>
			<td>개설자</td>
			<td>참여자</td>
		</tr>
	</thead>
	<tbody></tbody>
	</table>
	<button onclick="location.href='createRoom.php'">방개설</button>
    </div> 
  

    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>    
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript">
    </script>
  </body>
</html>

<script>
$(document).ready(function() {
	getRoom();
});

function getRoom() {
	var tag = "";
	$.getJSON("_getRoom.php",{},
		function(json) {
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++) {
					tag += "<tr>";
					tag += "<td><a href='chat.php?uid=" + json[i].uid + "'>" + json[i].room_name + "</a></td>";
					tag += "<td>" + json[i].mem_id + "</td>";
					tag += "<td>" + json[i].create_dt + "</td>";
					tag += "</tr>";
				}

				$("#tb tbody").html(tag);
			}
		}
	);
}
</script>