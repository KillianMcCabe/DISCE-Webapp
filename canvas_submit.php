<?php
	require 'php/connect.inc.php';
	
	$canvas_id = 0;
	
	
	/*
	 * Customer Segments
	 */
	if (!empty($_POST['customer_segment-submit'])) {
	   $value = $_POST['name'];
	   
	   $sql = "INSERT INTO customer_segments (canvas_id, name) VALUES ('$canvas_id', '$value')";

		if (!mysql_query($sql)) {
			die('ERROR: ' . mysql_error());
		}
	}

	if (!empty($_POST['customer_segment-delete'])) {
		$customer_segment_id = $_POST['customer_segment-delete'];
		
		$sql = "DELETE FROM customer_segments WHERE id = '$customer_segment_id' AND canvas_id = '$canvas_id'";

		if (!mysql_query($sql)) {
			die('ERROR: ' . mysql_error());
		}
		/*need to also delete personas that belong to this segment*/
	}
	
	
	/*
	 * Customer Relationships
	 */
	if (!empty($_POST['get_relationship-submit'])) {
		$value = $_POST['relationship_name'];
		$type = $_POST['customer_dropdown'];
	   
		$sql = "INSERT INTO customer_relationships (canvas_id, type, name) VALUES ('$canvas_id', '$type', '$value')";

		if (!mysql_query($sql)) {
			die('ERROR: ' . mysql_error());
		}
	}
	
	if (!empty($_POST['keep_relationship-submit'])) {
		$value = $_POST['relationship_name'];
	   
		$sql = "INSERT INTO customer_relationships (canvas_id, type, name) VALUES ('$canvas_id', 'keep', '$value')";

		if (!mysql_query($sql)) {
			die('ERROR: ' . mysql_error());
		}
	}
	
	if (!empty($_POST['grow_relationship-submit'])) {
		$value = $_POST['relationship_name'];
	   
		$sql = "INSERT INTO customer_relationships (canvas_id, type, name) VALUES ('$canvas_id', 'grow', '$value')";

		if (!mysql_query($sql)) {
			die('ERROR: ' . mysql_error());
		}
	}
	
	if (!empty($_POST['relationship-delete'])) {
		$relationship_id = $_POST['relationship-delete'];
		
		$sql = "DELETE FROM customer_relationships WHERE id = '$relationship_id' AND canvas_id = '$canvas_id'";

		if (!mysql_query($sql)) {
			die('ERROR: ' . mysql_error());
		}
		
	}
	
	header('Location: canvas.php'); // redirect back to canvas.php page
?>