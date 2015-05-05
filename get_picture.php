<?php 
	include('functions.php');
	
	$team = $_REQUEST['teamNumber'];
	$pic_num = $_REQUEST['pic'];
	
	echo getPic($team, $pic_num);
?>