<html>
<head>
<title>Yeti Robotics Scouting</title>
<meta name="viewport" content="width=device-width, intial-scale=1"/>
<link href="scouting.css" type="text/css" rel="stylesheet"/>
<script type="text/javascript" src="scouting.js"></script>
</head>

<body>
	<div class="header">
		<h2 class="page_header">Yeti Scouting</h2>
		<hr />
	</div>

	<div>
		<form id="scouting_form" action="scouting_submit.php" method="POST">
			<fieldset>
				<legend>Info</legend>
				<div class="aligned_controls">
					<label for="name">Name:</label>
					<input type="text" name="name" placeholder="Enter your name" required="required"/><br/>
					<label>Match #:</label> 
					<input type="number" name="match_number" placeholder="Enter the match number" required="required"/><br/>
					<label>Team #:</label>  
					<input type="number" name="team_number" placeholder="Enter the team number" required="required"/><br/>
				</div>
			</fieldset>
			<fieldset>
				<legend>Autonomous</legend>
				<div class="aligned_controls">
					<label for="robot_moved">Did the robot move?</label>
					<input type="checkbox" name="robot_moved" onchange="toggleAutonomous(this.checked)"/><br/>
					<div id="autonmous_container" class="aligned_controls">
						<label for="totes_auto">How many totes?</label>
						<select name="totes_auto" id="totes_auto">
							<option value="0" selected="selected">0</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
						</select>
						<label for="cans_auto">How many cans?</label>
						<select name="cans_auto" class="cans_dropdown">
							<option value="0" selected="selected">0</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
						</select>
					</div>
				</div>
			</fieldset>
			<fieldset>
				<legend>Coopertition</legend>
				<div class="aligned_controls">
					<label for="coopertition">Was coopertition attempted?</label>
					<input type="checkbox" name="coopertition"/>
					<label for="coopertition_totes">How many totes?</label>
					<select name="coopertition_totes" id="coopertition_totes">
						<option value="0" selected="selected">0</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
					</select>
				</div>
			</fieldset>
			<fieldset>
				<legend>Stacks</legend>
				<div id="stack_row_container">
					<label for="add_button">Click to add a stack</label>
					<input type="button" value="Add" class="add_button" onclick="addStackRow()"/>
				</div>
			</fieldset>
			<fieldset>
				<legend>Match Score</legend>
				<div class="aligned_controls">
					<label for="score">Score:</label>
					<input type="number" name="score" placeholder="Enter the alliance's score" required="required"/>
				</div>
			</fieldset>
			<div class="submit_button_container">
				<input type="submit" value="Submit" class="submit_button"/>
			</div>
		</form>
		<div id="stack_row" class="stack_row">
			<hr class="stack_row_divider"/>
			<label for="stacks_totes">Totes:</label>
			<select name="stacks_totes[]" class="totes_dropdown">
				<option value="0" selected="selected">0</option>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				<option value="6">6</option>
			</select>
			<label for="capped_stack">Cap:</label>
			<select name="capped_stack[]" class="cans_dropdown">
				<option value="0" selected="selected">No cap</option>
				<option value="1">Cap w/o litter</option>
				<option value="2">Cap w/ litter</option>
			</select>
			<img id="delete_button" src="red_x.png" class="delete_button"/>
		</div>
		
	</div>


</body>






</html>