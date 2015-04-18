<html>
<head>
<title>Yeti Robotics Scouting</title>
<meta name="viewport" content="width=device-width, intial-scale=1"/>
<link href="scouting.css" type="text/css" rel="stylesheet"/>
<script type="text/javascript" src="scouting.js"></script>
</head>
<?php
include ("connect.php");

$query = "INSERT INTO scout_data (team, match_number,
		 robot_moved, totes_auto, cans_auto, coopertition,
		 coopertition_totes, score, comments, rating, name) 
		VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

//  Insert team record
if($stmt = $db->prepare($query)){
	$robot_moved = 0;
	if(isset($_POST["robot_moved"])){
		$robot_moved = 1;
	} else{
		$robot_moved = 0;
	}
	$coopertition_number = 0;
	if(isset($_POST["coopertition_number"])){
		$coopertition_number = 1;
	} else{
		$coopertition_number = 0;
	}
	$stmt->bind_param("iiiiiiiisis", $_POST["team_number"],
		$_POST["match_number"],
		$robot_moved,
		$_POST["totes_auto"],
		$_POST["cans_auto"],
		$coopertition_number,
		$_POST["coopertition_totes"],
		$_POST["score"],
		$_POST["comments"],
		$_POST["rating"],
		$_POST["name"]);
	
	$stmt->execute();
	$insert_id = $stmt->insert_id;
	
	//  Insert stack records
	if (isset($_POST["stacks_totes"]) && isset($_POST["capped_stack"])) {
		foreach ($_POST["stacks_totes"] as $index => $totes) {
			$stack_query = "INSERT INTO stacks (scout_data_id, totes, cap_state)
					VALUES (?, ?, ?)";
			if ($stack_stmt = $db->prepare($stack_query)) {
				$stack_stmt->bind_param("iii", $insert_id, $totes, $_POST["capped_stack"][$index]);
				$stack_stmt->execute();
			}
		}
	}
	
	if ($insert_id > 0) {
		echo "<h1>Upload successful.</h1>";
	} else {
		echo "<h1>Upload failed.</h1>";
	}
}
$db->close();
?>
<h2><a href="/">Back</a></h2>
</body>
</html>

