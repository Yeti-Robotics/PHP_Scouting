<html>
<head>
<title>Yeti Robotics Scouting</title>
<meta name="viewport" content="width=device-width, intial-scale=1"/>
<link href="scouting.css" type="text/css" rel="stylesheet"/>
<script type="text/javascript" src="scouting.js"></script>
</head>


<?php
include ("connect.php");

$team = "";
$comments = [];
$query = "SELECT team, comments 
			FROM scout_data
			WHERE team = ?";

if($stmt = $db->prepare($query)){
	if (isset($_GET["team"])) {
		$stmt->bind_param("i", $_GET["team"]);
	}
	$stmt->execute();
	$result = $stmt->get_result();
	if ($result) {
		while ($row = $result->fetch_assoc()) {
			$team = $row["team"];
			if ($row["comments"] != "" && $row["comments"] != null) {
				$comments[] = $row["comments"];
			}
		}
	}
}
?>
<body>
	<div class="header">
		<h2 class="page_header">Team <?php echo $team;?></h2>
	</div>
<?php
$totes_query = "SELECT IFNULL(totes,1) AS \"Stack height\", COUNT(totes) AS \"Total number of stacks made\"
FROM stacks
LEFT JOIN scout_data ON scout_data.scout_data_id = stacks.scout_data_id
WHERE totes=1 AND scout_data.team=?
UNION

SELECT IFNULL(totes,2), COUNT(totes) AS \"Total number of stacks made\"
FROM stacks
LEFT JOIN scout_data ON scout_data.scout_data_id = stacks.scout_data_id
WHERE totes=2 AND scout_data.team=?
UNION

SELECT IFNULL(totes,3), COUNT(totes) AS \"Total number of stacks made\"
FROM stacks
LEFT JOIN scout_data ON scout_data.scout_data_id = stacks.scout_data_id
WHERE totes=3 AND scout_data.team=?
UNION

SELECT IFNULL(totes,4), COUNT(totes) AS \"Total number of stacks made\"
FROM stacks
LEFT JOIN scout_data ON scout_data.scout_data_id = stacks.scout_data_id
WHERE totes=4 AND scout_data.team=?
UNION

SELECT IFNULL(totes,5), COUNT(totes) AS \"Total number of stacks made\"
FROM stacks
LEFT JOIN scout_data ON scout_data.scout_data_id = stacks.scout_data_id
WHERE totes=5 AND scout_data.team=?
UNION

SELECT IFNULL(totes,6), COUNT(totes) AS \"Total number of stacks made\"
FROM stacks
LEFT JOIN scout_data ON scout_data.scout_data_id = stacks.scout_data_id
WHERE totes=6 AND scout_data.team=?";

if($stmt = $db->prepare($totes_query)){
	if (isset($_GET["team"])) {
		$stmt->bind_param("iiiiii", $_GET["team"] ,
				 $_GET["team"],
				 $_GET["team"],
				 $_GET["team"],
				 $_GET["team"],
				 $_GET["team"]);
	}
	$stmt->execute();
	$result = $stmt->get_result();
	echo "<h3>Teleop</h3>";
	if ($result) {
		echo "<table border='1'>";
		$fields = $result->fetch_fields();
		echo "<tr>";
		foreach ($fields as $field) {
				echo "<th>".$field->name."</th>";
		}
		echo "</tr>";
		while ( $row = $result->fetch_assoc () ) {
			echo "<tr class=\"team_row\">";
			foreach ( $row as $key => $value ) {
				echo "<td>" . $value . "</td>";
			}
			echo "</tr>";
		}
		echo "</table>";
	} else {
		$db->close ();
		die ( "<h2>Query failed</h2>" );
	}
}
$db->close();

?>


	
	<div>
		<h3>Comments:</h3>
		<?php 
			if (count($comments) == 0) {
				echo "<p class='team_comment'>No comments are available for this team.</p>";
			} else {
				foreach ($comments as $comment) {
					echo "<p class='team_comment'>";
					echo $comment;
					echo "</p>";
				}
			}
		?>
	</div>
</body>
</html>
