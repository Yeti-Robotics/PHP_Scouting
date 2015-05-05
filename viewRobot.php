<?php 
	include('header.php');
?>
<script>
	var xmlHttp = new XMLHttpRequest();
	var picNum = 1;	

	
	$.urlParam = function(name){
	    var results = new RegExp('[\?&amp;]' + name + '=([^&amp;#]*)').exec(window.location.href);
	    return results[1] || 0;
	}
	
	$(document).ready(function(){
		$.get("get_picture.php?teamNumber=" + $.urlParam("teamNumber") + "&pic=1", function(data, status) {
			$("#picture").attr("src", data);
		});
		refreshPicNum();
	});
	
	function previousPicture() {
		if (picNum > 1) {
			picNum--;
		}
		$(document).ready(function(){
			$.get("get_picture.php?teamNumber=" + $.urlParam("teamNumber") + "&pic=" + picNum, function(data, status) {
				$("#picture").attr("src", data);
			});
		});
		refreshPicNum();
	}

	function nextPicture() {
// 		$(document).ready(function() {
// 			$.get("get_picture.php?teamNumber=" + $.urlParam("teamNumber") + "&pic=" + (picNum + 1), function(data, status) {
// 				console.log("\"" + dataString + "\"" + "\n \"" + data.slice(0, 11) + "\"");
// 				if (data != "<br /><b>Warning</b>:  file(pics/1024/" + (picNum + 1) + ".txt): failed to open stream: No such file or directory in <b>C:\xampp\htdocs\scouting\functions.php</b> on line <b>105</b><br />") {
// 					console.log("Looks good");
// 					picNum++;
// 				}
// 			});
// 		});
		$(document).ready(function() {

			$.get("get_picture.php?teamNumber=" + $.urlParam("teamNumber") + "&pic=" + (picNum + 1), function(data, status) {
				if (data[0] !== "<") {
					picNum++;
				}
			});
			
			$.get("get_picture.php?teamNumber=" + $.urlParam("teamNumber") + "&pic=" + picNum, function(data, status) {
				$("#picture").attr("src", data);
			});
		});
		refreshPicNum();	
	};
	
	function refreshPicNum() {
		document.getElementById("pic_num").innerHTML = "Picure #" + picNum;
	}
</script>
<center>
	<span id='left_arrow' class="link" onclick="previousPicture()">
		  ←
	</span>
	</br></br>
	<span id='right_arrow' class="link" onclick="nextPicture()">
		  →
	</span>
</center>
<img id='picture' src='' alt='What? No picture?!?'>
<p id='pic_num'></p>
<?php
	

// 	if(file_exists(makeDir(1)))  {
// 		for($i = 1; file_exists(makeDir($i)); $i++) {
// 			echo makeImageHTML(getPic($i));
// 			echo "<br>";
// 		}
// 	}
	
	include('footer.php');
?>