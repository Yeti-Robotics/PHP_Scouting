</body>
<script type="text/javascript">
var searchSelect = document.getElementById("search-selector");
var searchForm = document.getElementById("search-form");
var searchBox = document.getElementById("search-box");

searchSelect.onchange = function() {
	switch (searchSelect.value) {
		case "team":
			searchForm.setAttribute("action", "team.php");
			searchBox.setAttribute("name", "team");
			searchBox.setAttribute("placeholder", "Enter a team number");
			break;
	
		case "pit":
			searchForm.setAttribute("action", "viewRobot.php");
			searchBox.setAttribute("name", "teamNumber");
			searchBox.setAttribute("placeholder", "Enter a team number");
			break;
	
		case "match":
			searchForm.setAttribute("action", "match.php");
			searchBox.setAttribute("name", "matchNumber");
			searchBox.setAttribute("placeholder", "Enter a match number");
			break;
	}
}
</script>
</html>