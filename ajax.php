<?php
	require 'php/connect.inc.php';
	
	header('Content-Type: text/xml');
	echo '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>';
	
	echo '<response>';
		
		echo '<personas>';
		
		if (!empty($_GET['persona_id'])) {
			$id = $_GET['persona_id'];

			/* retrieve contents of customer_persona table and display results in html */
			$query = "SELECT * FROM customer_persona WHERE id = '$id'";
			if($query_run = mysql_query($query)){
				$query_num_rows = mysql_num_rows($query_run);
				if($query_num_rows == 0){
					die('Table SELECT failed.');
				} else {
					echo '<persona>';
					$persona_name = mysql_result($query_run, 0, 'persona_name');
					echo '<name>'.$persona_name.'</name>';
					
					$location = mysql_result($query_run, 0, 'location');
					echo '<location>'.$location.'</location>';
					
					$age = mysql_result($query_run, 0, 'age');
					echo '<age>'.$age.'</age>';
					
					$gender = mysql_result($query_run, 0, 'gender');
					echo '<gender>'.$gender.'</gender>';
					
					$family_size = mysql_result($query_run, 0, 'family_size');
					echo '<family_size>'.$family_size.'</family_size>';
					
					$income = mysql_result($query_run, 0, 'income');
					echo '<income>'.$income.'</income>';
					
					$occupation = mysql_result($query_run, 0, 'occupation');
					echo '<occupation>'.$occupation.'</occupation>';
					
					$education = mysql_result($query_run, 0, 'education');
					echo '<education>'.$education.'</education>';
					
					echo '</persona>';
				}
			}
		}
		echo '</personas>';
	echo '</response>'
?>