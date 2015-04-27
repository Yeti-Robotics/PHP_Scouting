<?php 
	include('header.php');
	
	function makeImageHTML($imgCode) {
		return "<img src='" . $imgCode . "' alt='php did not work'>";
	}
	
	function makeDir($number) {
		return "pics/" . $_GET['teamNumber'] . "/" . $number . ".txt";
	}
	
	function getPic($number) {
		$file = file(makeDir($number));
		return $file[0];
	}

	if(file_exists(makeDir(1)))  {
		for($i = 1; file_exists(makeDir($i)); $i++) {
			echo makeImageHTML(getPic($i));
			echo "<br>";
		}
	}
	
	i
?>