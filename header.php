<html>
<head>
<title>Yeti Robotics Scouting</title>
<?php
	if ($_SERVER['PHP_SELF'] == "/index.php" || $_SERVER['PHP_SELF'] == "/pit.php") {
		echo '<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">';
	} else {
		echo '<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">';
	}
?>
<meta name="apple-mobile-web-app-capable" content="yes">
<link href="scouting.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="scouting.js"></script>
</head>
<body>
	<div class="header">
	<nav>
		<a href="/">Yeti Scouting</a> | 
		<a href="/results.php">Results</a> | 
		<a href="/pit.php">Pit Form</a>
		<a href="/matches.php">Match list</a>
		<br/>
		<form id="search-form" class="search" action="team.php" method="get">
		<select id="search-selector">
		<option value="team" selected="selected">Teams</option>
		<option value="pit">Pits</option>
		<option value="match">Matches</option>
		</select>
			<input id="search-box" type="number" name="team" placeholder="Enter a team number">
			<button type="submit">Go</button>
		</form>
		</nav>
		<hr />
	</div>