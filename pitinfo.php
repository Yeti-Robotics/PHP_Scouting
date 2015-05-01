<?php 
	include('header.php');
	include('connect.php');
	
	$query = "INSERT INTO pit_scouting (team_number, pit_comments, scouter_name)
				VALUES (?, ?, ?)";
	if($stmt = $db->prepare($query)){
		if(!empty($_POST['scouter_name'])) {
			$stmt->bind_param("iss", $_POST["teamnumber"], 
					$_POST["comments"], 
					$_POST["scouter_name"]);
			$stmt->execute();
			echo('So apperently ' . $_POST['teamnumber'] . " does some sort of thing and it can <br>" . $_POST['comments']. "<br> or something. Isn't that right " . $_POST['scouter_name'] . '?');
		}
		else {
			echo('You did not state your name! This is very important. Please go back and do so.');
		}
	}
	$db->close();
			
	function getPitComments($db, $team) {
		$query = "SELECT team_number AS 'Team', pit_comments AS 'Pit Scouters Comments', scouter_name AS 'Pit Scouter', timestamp
					FROM pit_scouting
					WHERE team_number = ?";
					//Time stamps?
		if($stmt = $db->prepare($query)) {
			$stmt->bind_param("i", $team);
			$stmt->execute();
			return $stmt->get_result();
		}
		else {
			return null;
		}
	}
	
	include('footer.php');	
?>