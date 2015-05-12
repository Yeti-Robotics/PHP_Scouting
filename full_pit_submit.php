<?php 
	include('header.php');
	include('connect.php');
	
	//Picture submition
	$teamNumber = $_POST['teamnumber'];
	
	if(empty($_POST["scouter_name"])) {
		die("<h1>You must put your name!</h1>
			<br>
			<a href='/Pit.php'>Back</a>");
	}
	
	if(!empty($_FILES["RobotPicture"])) {
	if(!file_exists("pics/")) {
		mkdir("pics/");
	}
	if(!file_exists("pics/".$teamNumber)) {
		mkdir("pics/" . $teamNumber);
	}
	
	function getFileExtension($fileName) {
		$pathInfo = pathinfo($fileName);
		return $pathInfo['extension'];
	}
	
	$dir = scandir("pics/".$teamNumber);
	array_splice($dir, 0, 2);
	$dirLength = count($dir);
	move_uploaded_file($_FILES['RobotPicture']['tmp_name'], "pics/" . $teamNumber . "/" . ($dirLength + 1) . "." . getFileExtension($_FILES['RobotPicture']['name']));
	}
	
	if(!empty($_POST["comments"])) {
	//Comments submition
	$query = "INSERT INTO pit_scouting (team_number, pit_comments, scouter_name)
				VALUES (?, ?, ?)";
	if($stmt = $db->prepare($query)){
		$stmt->bind_param("iss", $_POST["teamnumber"], 
					$_POST["comments"], 
					$_POST["scouter_name"]);
			$stmt->execute();
			$insert_id = $stmt->insert_id;
		if ($insert_id > 0) {
			header("Location: http://" . $_SERVER['HTTP_HOST'] . "/pit.php");
		} else {
			echo "<h1>Upload failed. Please review your data and try again.</h1>";
		}
	}
	$db->close();
	}
	
	echo "<h2 class='link' onclick'history.back()'>Back</h2>";
	include('footer.php');	
?>