<?php

	if (!empty($_POST['get_relationship-submit'])) {
		$value = $_POST['relationship_name'];
		$type = $_POST['customer_dropdown'];
	   
		$sql = "INSERT INTO customer_relationships (canvas_id, type, name) VALUES ('$canvas_id', '$type', '$value')";

		if (!mysql_query($sql)) {
			die('ERROR: ' . mysql_error());
		}
	}
?>