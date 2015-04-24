<?php 
	include ('header.php');
?>

	<div id='file-upload'>
		<form action="Picture.php" method="POST">
			<fieldset>
				<legend>Upload Pictures here</legend>
				<input type="image" name="Robot Picture" required>
				<input type="submit">
			</fieldset>
		</form>
	</div>
	<form action="PitInfo.php">
		<fieldset>
			<legend>Type Your comments here</legend>
			
		</fieldset>
	</form>

<?php 
	include('footer.php');
?>