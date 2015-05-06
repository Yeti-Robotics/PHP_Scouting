<?php 
	include('header.php');
	include('functions.php');
	include('connect.php');
?>
<script>
	var picNum = 1;	
	var teamNumber = <?php echo json_encode($_GET['teamNumber']);?>;
	var picLimit = <?php 
		for($i = 1; file_exists("pics/" . $_GET['teamNumber'] . "/" . $i . ".txt"); $i++){}
		echo json_encode($i - 1);?>;
	
	$(document).ready(function(){
		if (picLimit > 1) {
			$.get("get_picture.php?teamNumber=" + teamNumber + "&pic=1", function(data, status) {
				$("#picture").attr("src", data);
			});
			refreshPicNum();
		} else {
			document.getElementById("left_arrow").innerHTML = "";
			document.getElementById("right_arrow").innerHTML = "";
			document.getElementById("img_div").innerHTML = "<center><h3>No pictures are available for this team</h3></center>";
		}
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
<?php
	$comments = [];
	
	$result = getPitComments($db, $_GET['teamNumber']);
	if ($result) {
		while ($row = $result->fetch_assoc()) {
			if ($row["Pit Scouters Comments"] != "" && $row["Pit Scouters Comments"] != null) {
				$comments[] = $row["Pit Scouters Comments"];
				$timestamps[] = intval($row["timestamp"]);
				$names[] = $row["Pit Scouter"];
			}
		}
	}
	
	echo "<center><span id='pic_num'></span></center>
			<span id='left_arrow' onclick='previousPicture()'>
				← Previous Picture
			</span>
			<span id='right_arrow'onclick='nextPicture()'>
				Next Picture →
			</span>
			<div id='img_div'>
				<img id='picture' src='' alt='What? Where's the picture?!?'>
			</div>
			<hr/>";
	$db->close();
?>
<div>
	<h3>Comments:</h3>
	<?php 
		if (count($comments) == 0) {
			echo "<p class='team_comment'>No comments are available for this team.</p>";
		} else {
			foreach ($comments as $key => $comment) {
				echo "<p class='team_comment'>";
				echo $comment;
				echo "<br/>";
				echo "<span class='timestamp'>-- ".$names[$key].", ".timeAgo($timestamps[$key])."</span>";
				echo "</p>";
			}
		}
	?>
</div>
<?php 
	include('footer.php');
?>















