<?php
	require 'php/connect.inc.php';
	
	$canvas_id = 0;
	
	
	/*
	 * Customer Segments
	 */
	if (!empty($_POST['customer_segment-submit'])) {
	   $name = $_POST['name'];
	   
	   $sql = "INSERT INTO customer_segments (canvas_id, name) VALUES ('$canvas_id', '$name')";

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
		$name = $_POST['relationship_name'];
		$type = $_POST['customer_dropdown'];
	   
		$sql = "INSERT INTO customer_relationships (canvas_id, type, name) VALUES ('$canvas_id', '$type', '$name')";

		if (!mysql_query($sql)) {
			die('ERROR: ' . mysql_error());
		}
	}
	
	if (!empty($_POST['keep_relationship-submit'])) {
		$name = $_POST['relationship_name'];
	   
		$sql = "INSERT INTO customer_relationships (canvas_id, type, name) VALUES ('$canvas_id', 'keep', '$name')";

		if (!mysql_query($sql)) {
			die('ERROR: ' . mysql_error());
		}
	}
	
	if (!empty($_POST['grow_relationship-submit'])) {
		$name = $_POST['relationship_name'];
	   
		$sql = "INSERT INTO customer_relationships (canvas_id, type, name) VALUES ('$canvas_id', 'grow', '$name')";

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
	
	/*
	 * Channels
	 */
	if (!empty($_POST['channel-submit'])) {
		$type = $_POST['channel_type'];
		$name = $_POST['channel_name'];
	   
		$sql = "INSERT INTO channels (canvas_id, type, name) VALUES ('$canvas_id', '$type', '$name')";

		if (!mysql_query($sql)) {
			die('ERROR: ' . mysql_error());
		}
	}
	
	if (!empty($_POST['channel-delete'])) {
		$channel_id = $_POST['channel-delete'];
		
		$sql = "DELETE FROM channels WHERE id = '$channel_id' AND canvas_id = '$canvas_id'";

		if (!mysql_query($sql)) {
			die('ERROR: ' . mysql_error());
		}
	}
	
	
	header('Location: canvas.php'); // redirect back to canvas.php page
?>