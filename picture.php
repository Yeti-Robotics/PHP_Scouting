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

	//Handle writing to file here
	if(! file_exists("pics/" . $teamNumber . "/1.txt")) {
		mkdir("pics/" . $teamNumber);
		writeToFile("pics/" . $teamNumber . "/1.txt", $_POST['image']);
	}
	else {
		for($i = 1; file_exists("/pics/" . $teamNumber . "/" . $i . ".png"); $i++){}
		writeToFile("pics/" . $teamNumber . "/" . ($i+1) . ".txt", $_POST['image']);
	}
	
	function writeToFile($fileName, $data) {
		if(file_exists($fileName)) {
			return false;
		}
		else {
			$file = fopen($fileName, 'x');
			fwrite($file, $data);
			fclose($file);
		}
	}
	include ('footer.php');
?>