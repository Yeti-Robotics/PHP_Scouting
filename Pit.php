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
		<br>
	</fieldset>
	<fieldset id='commentsField'>
		<legend>Type Your comments here</legend>
		<input id="scouter_name" type="text" name='scouter_name' placeholder='Please enter your name'><br/>
		<br>
		<textarea id="comments" rows="3" cols="64" name='comments' placeholder='Enter comments about the team here'></textarea>
		<br>
	</fieldset>
	<div id="submit_button_container">
	</div>
	</form>

	<script>
	var reader, display, imageCode, input, teamNumber, teamNumber2, submitButton, submitButtonContainer, 
		teamEntered, commentsField, imageField, nameField, commentsInput, forms;

	teamEntered = false;
	submitButton = document.createElement('input');
	submitButton.type = 'submit';
	submitButton.classList.add('submit_button');

	reader = new FileReader();
	reader.onload = function() {
		rawData = reader.result;
		display.src = rawData;
		display.setAttribute("height", "auto");
	}
	
	display = document.getElementById('displayarea');
	teamNumber = document.getElementById('teamnumber');
	fileInput = document.getElementById('robotimage');
	nameField = document.getElementById('scouter_name');
	commentsInput = document.getElementById('comments');
	form = document.getElementsByTagName('form')[0];
	submitButtonContainer = document.getElementById('submit_button_container');
	
	teamNumber.oninput = function() {
		if(teamEntered == false) {
			submitButtonContainer.appendChild(submitButton);
			teamEntered = true;
		}
	};
	
	commentsInput.oninput = function() {
		if (commentsInput.value != "") {
			nameField.setAttribute("required", "required");
		} else {
			nameField.removeAttribute("required");
		}
	};
	
	fileInput.onchange = function(e) {
		reader.readAsDataURL(e.target.files[0]);
	};

    form.noValidate = true;
    form.addEventListener('submit', function(event) {
        if (!event.target.checkValidity()) {
            event.preventDefault();
            alert("Looks like some fields have some invalid data. Why would that be?");
        }
    }, false);

	</script>
<?php 
	include('footer.php');
?>
