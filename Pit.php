<?php 
	include ('header.php');
?>
	<form name='picture' action="picture.php" method="POST" enctype="multipart/form-data">
	<input type='number' name='teamnumber' id='teamnumber' placeholder='Enter Team Number here' required>
	<div id='file-upload'>
		<fieldset id='imageField'>
			<img alt="Please Upload a File!" id='displayarea' width='140px' height='20px'>
			<br>
			<br>
			<legend>Upload Pictures here</legend>
			<input type="file" id='robotimage' name="RobotPicture"  required>
			<input type="hidden" id='imgcode' name='image'>
			<br>
		</fieldset>
	</div>
	</form>
	<form action="pitinfo.php" method="POST">
		<fieldset id='commentsField'>
			<legend>Type Your comments here</legend>
			<input type="text" name='scouter_name' placeholder='Please enter your name'><br/>
			<br>
			<input type='hidden' name='teamnumber' id='teamnumber2'>
			<textarea rows="3" cols="64" name='comments' placeholder='Enter comments about the team here' required></textarea>
			<br>
		</fieldset>
	</form>

	<script>
	var reader, display, imageCode, input, teamNumber, teamNumber2, submitButton, submitButton2, teamEntered, commentsField, imageField;

	teamEntered = false;
	submitButton = document.createElement('input');
	submitButton.type = 'submit';
	submitButton2 = document.createElement('input');
	submitButton2.type = 'submit';

	reader = new FileReader();
	display = document.getElementById('displayarea');
	imageCode = document.getElementById('imgcode');
	teamNumber = document.getElementById('teamnumber');
	teamNumber2 = document.getElementById('teamnumber2');
	fileInput = document.getElementById('robotimage');
	commentsField = document.getElementById('commentsField');
	imageField = document.getElementById('imageField');
	
	teamNumber.onchange = function() {
		teamNumber2.value = teamNumber.value;
		if(teamEntered == false) {
			imageField.appendChild(submitButton);
			commentsField.appendChild(submitButton2);
			teamEntered = true;
		}
	}
	
	
	fileInput.addEventListener('change', function(e) {
		reader.onload = function() {
			rawData = reader.result;
			display.src = rawData;
			display.style.height = 'auto';
			imageCode.value = rawData;
		}
		reader.readAsDataURL(e.target.files[0]);
	});

	
	</script>
<?php 
	include('footer.php');
?>