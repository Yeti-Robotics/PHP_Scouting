<?php
include ("connect.php");

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
		echo "</tr>";
	}
	echo "</table>";
} else {
	$db->close ();
	die ( "<h2>query failed</h2>" );
}

$db->close ();

?>


