<?php 
	include ('header.php');
?>
	<form name='pit' action="full_pit_submit.php" method="POST" enctype="multipart/form-data">
	<input type='number' name='teamnumber' id='teamnumber' placeholder='Enter Team Number here' required>
	<fieldset id='imageField'>
		<img alt="Please Upload a File!" id='displayarea' style="width: 140px" height='20px'>
		<br>
		<br>
		<legend>Upload Pictures here</legend>
		<input type="file" id='robotimage' name="RobotPicture">
		<input type="hidden" id='imgcode' name='image'>
		<br>
	</fieldset>
	<fieldset id='commentsField'>
		<legend>Type Your comments here</legend>
		<input id="scouter_name" type="text" name='scouter_name' placeholder='Please enter your name'><br/>
		<br>
		<input type='hidden' name='teamnumber' id='teamnumber2'>
		<textarea id="comments" rows="3" cols="64" name='comments' placeholder='Enter comments about the team here'></textarea>
		<br>
	</fieldset>
	<div class="submit_button_container">
		<input type="submit" value="Submit" class="submit_button"/>
	</div>
	</form>

	<script>
	var reader, display, imageCode, input, teamNumber, teamNumber2, submitButton, submitButton2, 
		teamEntered, commentsField, imageField, nameField, commentsInput, forms;

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
	nameField = document.getElementById('scouter_name');
	commentsInput = document.getElementById('comments');
	forms = document.getElementsByTagName('form');
	
	teamNumber.oninput = function() {
		teamNumber2.value = teamNumber.value;
		if(teamEntered == false) {
			teamEntered = true;
		}
	};
	
	commentsInput.oninput = function() {
		if (commentsInput.value !== "") {
			nameField.setAttribute("required", "required");
		} else {
			nameField.removeAttribute("required");
		}
	};
	
	fileInput.onchange = function(e) {
		reader.onload = function() {
			rawData = reader.result;
			display.src = rawData;
			display.setAttribute("height", "auto");
			imageCode.value = rawData;
		}
		reader.readAsDataURL(e.target.files[0]);
	};

	for (var i = 0; i < forms.length; i++) {
	    forms[i].noValidate = true;
	    forms[i].addEventListener('submit', function(event) {
	        if (!event.target.checkValidity()) {
	            event.preventDefault();
	            alert("Looks like some fields have some invalid data. Why would that be?");
	        }
	    }, false);
	}
	
	</script>
<?php 
	include('footer.php');
?>