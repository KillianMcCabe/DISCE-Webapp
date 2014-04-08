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
	
	if (!empty($_POST['customer_persona-submit'])) {
		$segment_id = $_POST['segment_id'];
		$name = $_POST['name'];
		$persona_name = $_POST['persona_name'];
		$age = $_POST['age'];
		$location = $_POST['location'];
		$gender = $_POST['gender'];
		$family_size = $_POST['family_size'];
		$income = $_POST['income'];
		$occupation = $_POST['occupation'];
		$education = $_POST['education'];
	   
		$sql = "INSERT INTO customer_persona (customer_segments_id, name, persona_name, image_name, location, age, gender, family_size, income, occupation, education)
					VALUES ('$segment_id', '$name', '$persona_name', 'image_name', '$location', '$age', '$gender', '$family_size', '$income', '$occupation', '$education')";

		if (!mysql_query($sql)) {
			die('ERROR: ' . mysql_error());
		}
	}
	
	if (!empty($_POST['customer_persona-delete'])) {
		$customer_persona_id = $_POST['customer_persona-delete'];
		
		$sql = "DELETE FROM customer_persona WHERE id = '$customer_persona_id'";

		if (!mysql_query($sql)) {
			die('ERROR: ' . mysql_error());
		}
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
	
	/*
	 * Key Activities
	 */
	if (!empty($_POST['key_activities-submit'])) {
		$type = $_POST['type'];
		$name = $_POST['name'];
	   
		$sql = "INSERT INTO key_activities (canvas_id, type, name) VALUES ('$canvas_id', '$type', '$name')";

		if (!mysql_query($sql)) {
			die('ERROR: ' . mysql_error());
		}
	}
	
	if (!empty($_POST['key_activities-delete'])) {
		$id = $_POST['key_activities-delete'];
		
		$sql = "DELETE FROM key_activities WHERE id = '$id' AND canvas_id = '$canvas_id'";

		if (!mysql_query($sql)) {
			die('ERROR: ' . mysql_error());
		}
	}
	
	/*
	 * Key Resources
	 */
	if (!empty($_POST['key_resources-submit'])) {
		$type = $_POST['type'];
		$name = $_POST['name'];
	
		$sql = "INSERT INTO key_resources (canvas_id, type, name) VALUES ('$canvas_id', '$type', '$name')";

		if (!mysql_query($sql)) {
			die('ERROR: ' . mysql_error());
		}
	}
	
	if (!empty($_POST['key_resources-delete'])) {
		$id = $_POST['key_resources-delete'];
		
		$sql = "DELETE FROM key_resources WHERE id = '$id' AND canvas_id = '$canvas_id'";

		if (!mysql_query($sql)) {
			die('ERROR: ' . mysql_error());
		}
	}
	
	/*
	 * Key Partners
	 */
	if (!empty($_POST['key_partner_groups-submit'])) {
	   $name = $_POST['name'];
	   
	   $sql = "INSERT INTO key_partner_groups (canvas_id, name) VALUES ('$canvas_id', '$name')";

		if (!mysql_query($sql)) {
			die('ERROR: ' . mysql_error());
		}
	}

	if (!empty($_POST['key_partner_groups-delete'])) {
		$id = $_POST['key_partner_groups-delete'];
		
		$sql = "DELETE FROM key_partner_groups WHERE id = '$id' AND canvas_id = '$canvas_id'";

		if (!mysql_query($sql)) {
			die('ERROR: ' . mysql_error());
		}
		/* need to also delete key_partners that belong to this segment */
	}
	 
	if (!empty($_POST['key_partners-submit'])) {
		$key_partner_group_id = $_POST['group_id'];
		$name = $_POST['name'];
	   
		$sql = "INSERT INTO key_partners (key_partner_group_id, name) VALUES ('$key_partner_group_id', '$name')";

		if (!mysql_query($sql)) {
			die('ERROR: ' . mysql_error());
		}
	}

	if (!empty($_POST['key_partners-delete'])) {
		$id = $_POST['key_partners-delete'];
		
		$sql = "DELETE FROM key_partners WHERE id = '$id'";

		if (!mysql_query($sql)) {
			die('ERROR: ' . mysql_error());
		}
		/* need to also delete relationships and resources that belong to this segment */
	}
	
	if (!empty($_POST['key_partner_relationships-submit'])) {
		$name = $_POST['name'];
	    
		$sql = "INSERT INTO key_partner_relationships (partner_id, name) VALUES ('$partner_id', 'name')";

		if (!mysql_query($sql)) {
			die('ERROR: ' . mysql_error());
		}
	}
	
	if (!empty($_POST['key_partner_relationships-delete'])) {
		$partner_id = $_POST['key_partner_relationships-delete'];
		
		$sql = "DELETE FROM key_partner_relationships WHERE partner_id = '$partner_id'";

		if (!mysql_query($sql)) {
			die('ERROR: ' . mysql_error());
		}
	}
	
	if (!empty($_POST['key_partner_resources-submit'])) {
		$name = $_POST['name'];
	    
		$sql = "INSERT INTO key_partner_resources (partner_id, name) VALUES ('$partner_id', 'name')";

		if (!mysql_query($sql)) {
			die('ERROR: ' . mysql_error());
		}
	}
	
	if (!empty($_POST['key_partner_resources-delete'])) {
		$partner_id = $_POST['key_partner_resources-delete'];
		
		$sql = "DELETE FROM key_partner_resources WHERE partner_id = '$partner_id'";

		if (!mysql_query($sql)) {
			die('ERROR: ' . mysql_error());
		}
	}
	
	header('Location: canvas.php'); // redirect back to canvas.php page
?>