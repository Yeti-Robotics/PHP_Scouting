<?php 
	include('header.php');
	include('connect.php');
	
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
	echo "<h2 class='link' onclick'history.back()'>Back</h2>";
	include('footer.php');	
?>