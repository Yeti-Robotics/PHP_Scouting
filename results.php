<?php
include ("connect.php");

$teams = [ ];
$team_rounds = [ ];
$query = "SELECT *
		FROM scout_data";
$result = $db->query ( $query );
if ($result) {
	echo ($result->num_rows);
	echo "<table border='1'>";
	while ( $row = $result->fetch_assoc () ) {
		echo "<tr>";
		foreach ( $row as $key => $value ) {
			echo "<td>" . $key . " - " . $value . "</td>";
		}
		$stack_query = "SELECT totes FROM stacks WHERE scout_data_id = " . $row["scout_data_id"];
		$stack_result = $db->query ( $stack_query );
		if ($stack_result) {
			$team_number = $row ["team"];
			$round_pts = 0;
			$round = [ ];
			while ( $stack_row = $stack_result->fetch_assoc () ) {
				foreach ( $stack_row as $height ) {
					$round_pts += pow ( $height, 2 );
					array_push($round, $height);
				}
				if (! isset ( $teams ["" . $team_number] )) {
					$team_rounds["" . $team_number] = [ ];
				}
			}
			if (isset ( $teams ["" . $team_number] )) {
				$round_pts *= 100;
				$teams ["" . $team_number] [1] += 1;
				$teams ["" . $team_number] [0] = (
						($teams ["" . $team_number] [0] * $teams ["" . $team_number] [1] - 1) + $round_pts4
						) / $teams ["" . $team_number] [1];
			} elseif ( $round_pts > 0 ) {
				$teams ["" . $team_number] = [1, $round_pts];
			} else {
				$teams ["" . $team_number] = [0, 0];
			}
			if (! isset($team_rounds["" . $team_number])) {
				$team_rounds["" . $team_number] = [ ];
			}
			array_push($team_rounds["" . $team_number], $round);
		}
		echo "</tr>";
	}
	echo "</table>";
	$sorted_teams = [ ];
	foreach ($teams as $k => $v) {
		$highest_team = null;
		foreach ($teams as $key => $value) {
			if (! in_array($key, $sorted_teams)) {
				if ($highest_team == null || $highest_team[1] < $value[1]) {
					$highest_team = [$key, $value[1]];
				}
			}
		}
		array_push($sorted_teams, $highest_team[0]);
	}
	echo "<table border='1'>";
	foreach ($sorted_teams as $key => $value) {
		echo "<tr>";
		echo "<td>" . $value . "</td>";
		if (isset ($team_rounds[$value])) {
			echo "<td><table>";
			foreach ($team_rounds[$value] as $val) {
				foreach ($val as $stack) {
					echo "<tr>";
					echo "<td>" . $stack . "</td>";
					for ($i = 0; $i < $stack; $i++) {
						echo "<td>[]</td>";
					}
					echo "</tr>";
				}
			}
			echo "</table></td>";
		}
	}
	echo "</table>";
} else {
	$db->close ();
	die ( "<h2>query failed</h2>" );
}

$db->close ();

?>


