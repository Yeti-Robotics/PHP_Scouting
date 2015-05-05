<?php 
	include('header.php');
?>
<script>
	var picNum = 1;	
	var teamNumber = <?php echo json_encode($_GET['teamNumber']);?>;
	var picLimit = <?php 
		for($i = 1; file_exists("pics/" . $_GET['teamNumber'] . "/" . $i . ".txt"); $i++){}
		echo json_encode($i - 1);?>;
	
	$(document).ready(function(){
		$.get("get_picture.php?teamNumber=" + teamNumber + "&pic=1", function(data, status) {
			$("#picture").attr("src", data);
		});
		refreshPicNum();
	});
	
	function previousPicture() {
		if (picNum > 1) {
			picNum--;
		} else {
			picNum = picLimit;
		}
		$(document).ready(function(){
			$.get("get_picture.php?teamNumber=" + teamNumber + "&pic=" + picNum, function(data, status) {
				$("#picture").attr("src", data);
			});
		});
		refreshPicNum();
	}

	function nextPicture() {
		$(document).ready(function() {
			if (picNum < picLimit) {
				picNum++;
			} else {
				picNum = 1;
			}
			$.get("get_picture.php?teamNumber=" + teamNumber + "&pic=" + picNum, function(data, status) {
				$("#picture").attr("src", data);
			});
		});
		refreshPicNum();
	};
	
	function refreshPicNum() {
		document.getElementById("pic_num").innerHTML = picNum + "/" + picLimit;
	}
</script>
<center><span id='pic_num'></span></center>
<span class='left_arrow' onclick="previousPicture()">
	← Previous Picture
</span>
<span class='right_arrow'onclick="nextPicture()">
	Next Picture →
</span>
<img id='picture' src='' alt='What? No picture?!?'>
<?php
	include('footer.php');
?>