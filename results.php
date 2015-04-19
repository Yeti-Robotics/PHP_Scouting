<?php 
	include('header.php');
?>
	<div class="results_description">Click a row to view detailed data on that team.</div>
<?php
include ("connect.php");
$query = "SELECT t1.team AS Team, t1.avg_height AS 'Avg. Stack Height', t2.avg_stacks AS 'Avg. Stacks per Match', t1.avg_height * t2.avg_stacks AS 'Avg. Totes per Match', rating AS 'Rating'
FROM (SELECT team, AVG(totes) AS avg_height
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
ORDER BY 'Avg. Totes per Match' DESC";
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
	die ( "<h2>Query failed</h2>" );
}

$db->close ();

include("footer.php");
?>