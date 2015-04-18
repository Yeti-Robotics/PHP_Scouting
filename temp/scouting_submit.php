<?php
include ("connect.php");

$query = "INSERT INTO scout_data (team, match_number,
		 robot_moved, totes_auto, cans_auto, coopertition,
		 coopertition_totes, score, comments, rating) 
		VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

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
	$comment = null;
	if (isset($_POST["comments"])) {
		$comment = $_POST["comments"];
	}
	$stmt->bind_param("iiiiiiiisi", $_POST["team_number"],
		$_POST["match_number"],
		$robot_moved,
		$_POST["totes_auto"],
		$_POST["cans_auto"],
		$coopertition_number,
		$_POST["coopertition_totes"],
		$_POST["score"],
		$comment,
		$_POST["rating"]);
	
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
}
$db->close();
?>

