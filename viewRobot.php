<?php 
	include('header.php');
	include('functions.php');
	include('connect.php');

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
	
	$db->close();
?>
<center>
	<span id='pic_num'>
	</span>
</center>
<span id='left_arrow' onclick='previousPicture()'>
	← Previous Picture
</span>
<span id='right_arrow'onclick='nextPicture()'>
	Next Picture →
</span>
<div id='img_div'>
	<img id='picture' src='' alt='What? Where's the picture?!?'>
</div>
<span id='rotate_ccw' onclick='rotateCCW()' class='link' style=''>
	Rotate 90° CCW
</span>
<span id='rotate_cw' onclick='rotateCW()' class='link' style=''>
	Rotate 90° CW
</span>
<hr/>
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
<script>
	var picNum = 1;	
	var teamNumber = <?php echo json_encode($_GET['teamNumber']);?>;
	var pics = <?php
					$dir = scandir("pics/".$_GET['teamNumber']);
					array_splice($dir, 0, 2);
					echo json_encode($dir);				
				?>;
	for (var i = 0; i < pics.length; i++) {
		pics[i] = "pics/" + teamNumber + "/" + pics[i];
	}
	console.log(typeof pics[0]);
	var picLimit = pics.length;
	var picture;
	var angle = 0;
	var ogOrientation = true;

	picture = document.getElementById("picture");
	if (picLimit > 1) {
		picture.setAttribute("src", pics[0]);
		console.log("loaded");
		refreshPicNum();
	} else {
		document.getElementById("left_arrow").innerHTML = "";
		document.getElementById("right_arrow").innerHTML = "";
		document.getElementById("img_div").innerHTML = "<center><h3>No pictures are available for this team</h3></center>";
	}
	
	function previousPicture() {
		if (picNum > 1) {
			picNum--;
		} else {
			picNum = picLimit;
		}
		resetPicture();
		picture.setAttribute("src", pics[picNum - 1]);
		refreshPicNum();
	}

	function nextPicture() {
		if (picNum < picLimit) {
			picNum++;
		} else {
			picNum = 1;
		}
		resetPicture();
		picture.setAttribute("src", pics[picNum - 1]);
		refreshPicNum();
	};
	
	function refreshPicNum() {
		document.getElementById("pic_num").innerHTML = picNum + "/" + picLimit;
	}

	function setRotationValue(degree) {
		if (ogOrientation == true) {
			picture.removeAttribute("width");
			picture.setAttribute("height", "500px");
		} else {
			picture.removeAttribute("height");
			picture.setAttribute("width", "500px");
		}
		angle += degree;
		picture.style.WebkitTransform = "rotate(" + angle + "deg)";
		picture.style.msTransform = "rotate(" + angle + "deg)";
		picture.style.transform = "rotate(" + angle + "deg)";
		ogOrientation = !ogOrientation;
	}

	function rotateCCW() {
		setRotationValue(-90);
	}
	
	function rotateCW() {
		setRotationValue(90);
	}

	function resetPicture() {
		picture.removeAttribute("width");
		picture.removeAttribute("height");
		picture.style.WebkitTransform = "rotate(0deg)";
		picture.style.msTransform = "rotate(0deg)";
		picture.style.transform = "rotate(0deg)";
	}
</script>
</body>
</html>