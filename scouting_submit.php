<?php
print_r ( $_REQUEST );
include ("connect.php");

$query = "INSERT INTO scout_data (team, match_number,
		 robot_moved, totes_auto, cans_auto, coopertition,
		 coopertition_totes, score) 
		VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

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
	$stmt->bind_param("iiiiiiii", $_POST["match_number"],
		$_POST["team_number"],
		$robot_moved,
		$_POST["totes_auto"],
		$_POST["cans_auto"],
		$coopertition_number,
		$_POST["coopertition_totes"],
		$_POST["score"]);
	
	$stmt->execute();
	$insert_id = $stmt->insert_id;
	echo($insert_id);
	
}
$db->close();
?>

