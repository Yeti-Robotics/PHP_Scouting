<html>
<head>
<title>Yeti Robotics Scouting</title>
<meta name="viewport" content="width=device-width, intial-scale=1"/>
<link href="scouting.css" type="text/css" rel="stylesheet"/>
<script type="text/javascript" src="scouting.js"></script>
</head>

<body>
	<div class="header">
		<h2 class="page_header">Yeti Scouting Results</h2>
	</div>
	<div class="results_description">Click a row to view detailed data on that team.</div>
<?php
include ("connect.php");

$query = "SELECT Team, TRUNCATE(SUM(avg_height)/SUM(num_stacks),2) AS \"Avg. Stack Height\", TRUNCATE(AVG(num_stacks),2) AS \"Avg. Stacks per Match\", TRUNCATE((AVG(num_stacks) * SUM(avg_height)/SUM(num_stacks)),2) AS \"Avg. Totes per Match\"
                FROM (SELECT scout_data.*, COUNT(totes) AS num_stacks, IFNULL(AVG(totes),0) AS avg_height
                        FROM stacks
                        RIGHT JOIN scout_data ON scout_data.scout_data_id = stacks.scout_data_id
                        GROUP BY team, match_number) AS t
                GROUP BY Team
                ORDER BY \"Avg. Totes per Match\" DESC";
$result = $db->query ( $query );
if ($result) {
	echo "<table border='1'>";
	$fields = $result->fetch_fields();
	echo "<tr>";
	foreach ($fields as $field) {
		echo "<th>".$field->name."</th>";
	}
	echo "</tr>";
	while ( $row = $result->fetch_assoc () ) {
		echo "<tr class=\"results_row\" onclick=\"document.location='team.php?team=".$row["Team"]."'\">";
		foreach ( $row as $key => $value ) {
			echo "<td>" . $value . "</td>";
		}
		echo "</tr>";
	}
	echo "</table>";
} else {
	$db->close ();
	die ( "<h2>query failed</h2>" );
}

$db->close ();

?>
</body>
</html>

