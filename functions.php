<?php

function getTeamStacksTable($db, $team){
	$query = "SELECT match_number AS 'Match Number', totes AS 'Stack Height', COUNT(totes) AS 'Number of Stacks'
				FROM stacks
				LEFT JOIN scout_data ON scout_data.scout_data_id = stacks.scout_data_id
				WHERE totes > 0 AND team = ?
			    GROUP BY totes, match_number
				ORDER BY match_number, totes";
	if($stmt = $db->prepare($query)){
		$stmt->bind_param("i", $team);
		$stmt->execute();
		return $stmt->get_result();
	} else{
		return null;
	}
}

function timeAgo($timestamp){
	$difference = time() - $timestamp;
	$periods = array("second", "minute", "hour", "day", "week", "month", "years", "decade");
	$lengths = array("60","60","24","7","4.35","12","10");
	for($j = 0; $difference >= $lengths[$j]; $j++) {
		$difference /= $lengths[$j];
	}
	$difference = round($difference);
	if($difference != 1) $periods[$j].= "s";
	$text = "$difference $periods[$j] ago";
	return $text;
}


?>