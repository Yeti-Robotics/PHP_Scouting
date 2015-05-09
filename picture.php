<?php 
	include ('header.php');
?>
	You Submitted:
	<br>
	<img src="<?php	echo($_POST['image']); ?>" alt="You submitted NOTHING">
	<br>
	For team:
	<br>
	<?php echo ($_POST['teamnumber']);?>
<?php

	$teamNumber = $_POST['teamnumber'];
	$dir = scandir("pics/".$teamNumber);
	array_splice($dir, 0, 2);
	$dirLength = count($dir);

	//Handle writing to file here
		if(!file_exists("pics/")) {
			mkdir("pics/");
		}
		if(!file_exists("pics/".$teamNumber)) {
			mkdir("pics/" . $teamNumber);
		}
		move_uploaded_file($_FILES['RobotPicture']['tmp_name'], "pics/$teamNumber/".($dirLength + 1).".".getFileExtension($_FILES['RobotPicture']['name']));
	
	function getFileExtension($fileName) {
		$pathInfo = pathinfo($fileName);
		return $pathInfo['extension'];
	}
	include ('footer.php');
?>