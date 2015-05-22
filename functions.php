<?php

function getTeamStacksTable($db, $team){
	$query = "SELECT match_number AS 'Match Number', totes AS 'Stack Height', cap_height AS 'Cap Height', COUNT(totes) AS 'Number of Stacks'
				FROM stacks
				LEFT JOIN scout_data ON scout_data.scout_data_id = stacks.scout_data_id
				WHERE totes > 0 AND team = ?
			    GROUP BY totes, cap_height, match_number
				ORDER BY match_number, totes";
	if($stmt = $db->prepare($query)){
		$stmt->bind_param("i", $team);
		$stmt->execute();
		return $stmt->get_result();
	} else{
		return null;
	}
}

function getTeamAutoTable($db, $team){
	$query = "SELECT match_number AS 'Match Number', if(robot_moved, 'yes', 'no') AS 'Robot Moved', totes_auto AS 'Number of totes moved', cans_auto AS 'Number of cans moved', if(cans_auto_origin, 'step', 'auto zone') AS 'Where did cans come from?', if(in_auto_zone, 'yes', 'no') AS 'Finishes in Auto Zone?'
				FROM scout_data
				WHERE team=?";
	if($stmt = $db->prepare($query)){
		$stmt->bind_param("i", $team);
		$stmt->execute();
		return $stmt->get_result();
	} else{
		return null;
	}
}

function getTeamRankings($db, $team){
	$query = "SELECT t1.team AS Team, ROUND(t1.avg_height,2) AS 'Avg. Stack Height', ROUND(t2.avg_stacks,2) AS 'Avg. Stacks per Match', MAX(t4.totes) AS 'Highest Stack Made', ROUND(rating,2) AS 'Rating'
FROM (SELECT team, AVG(totes) AS avg_height, totes
FROM stacks
LEFT JOIN scout_data ON scout_data.scout_data_id=stacks.scout_data_id
GROUP BY team) AS t1
LEFT JOIN (SELECT team, COUNT(totes > 0) / COUNT(DISTINCT match_number) AS avg_stacks
FROM stacks
RIGHT JOIN scout_data ON scout_data.scout_data_id = stacks.scout_data_id
GROUP BY team
ORDER BY team DESC) AS t2 ON t1.team = t2.team
LEFT JOIN (SELECT AVG(rating) AS rating, team
					FROM scout_data
					GROUP BY team) AS t3 ON t1.team=t3.team
                    
LEFT JOIN (SELECT team, totes
				FROM stacks
				LEFT JOIN scout_data ON scout_data.scout_data_id = stacks.scout_data_id
				WHERE totes > 0 AND team = ?
			    GROUP BY totes, cap_height, match_number
				ORDER BY match_number, totes) AS t4 ON t4.team=t1.team
WHERE t1.team=?";
	if($stmt = $db->prepare($query)){
		$stmt->bind_param("ii", $team, $team);
		$stmt->execute();
		return $stmt->get_result();
	} else{
		return null;
	}
}

function getTeamTotesOriginTable($db, $team){
	$query = "SELECT match_number AS 'Match Number', if(totes_from_landfill, 'yes', 'no') AS 'Totes Landfill?', if(totes_from_human, 'yes', 'no') AS 'Totes Human Player?'
				FROM `scout_data`
				WHERE team=?";
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

function getTeamCoopertition($db, $team){
	$query = "SELECT match_number AS 'Match Number', coopertition_totes AS 'Co-op Totes'
				FROM scout_data
				WHERE team = ?
				ORDER BY match_number";
	if($stmt = $db->prepare($query)){
		$stmt->bind_param("i", $team);
		$stmt->execute();
		return $stmt->get_result();
	} else{
		return null;
	}
}

function makeImageHTML($imgCode) {
	return "<img src='" . $imgCode . "' alt='php did not work'>";
}

function makeDir($team, $pic) {
	return "pics/" . $team . "/" . $pic . ".txt";
}

function getPic($team, $pic) {
	$file = file(makeDir($team, $pic));
	return $file[0];
}

function getPitComments($db, $team) {
	$query = "SELECT team_number AS 'Team', pit_comments AS 'Pit Scouters Comments', scouter_name AS 'Pit Scouter', UNIX_TIMESTAMP(timestamp) AS timestamp
				FROM pit_scouting
				WHERE team_number = ? AND pit_comments != ''";
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

function getPicInfo($db, $team) {
	$query = "SELECT team_number AS 'Team', scouter_name AS 'Pit Scouter', pic_num AS 'Picture Number', UNIX_TIMESTAMP(timestamp) AS timestamp
				FROM pit_scouting
				WHERE team_number = ? AND pic_num IS NOT NULL";
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

function resizeImage($src, $dst) {

	header ( 'Content-Type: image/jpeg' );

	list ( $width, $height ) = getimagesize ( $src );

	$newwidth = $width;
	$newheight = $height;

	if ($width > 640 || $height > 640) {
		$ratio = 640 / max ( [
				$width,
				$height
		] );
		$newwidth = $width * $ratio;
		$newheight = $height * $ratio;
	}

	$newImg = imagecreatetruecolor ( $newwidth, $newheight );
	$source = imagecreatefromjpeg( $src );

	imagecopyresized ( $newImg, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height );

	imagejpeg ( $newImg, $dst );
}
?>