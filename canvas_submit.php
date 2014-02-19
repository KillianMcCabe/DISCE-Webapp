<?php

define('DB_NAME', 'disce');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_HOST', 'localhost');

$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);

if (!$link) {
	die('Could not connect: ' . mysql_error());
}

$db_selected = mysql_select_db(DB_NAME, $link);

if (!$db_selected) {
	die('Can\'t use ' . DB_NAME . ': ' . mysql_error());
}

//
// enter non-empty forms to database
//

$canvas_id = 0; // would be read from session or something

if (!empty($_POST['customer_segment-submit'])) {
   $value = $_POST['customer_group'];
   
   $sql = "INSERT INTO customer_segments (canvas_id, name) VALUES ('$canvas_id', '$value')";

	if (!mysql_query($sql)) {
		die('ERROR: ' . mysql_error());
	}
}

if (!empty($_POST['customer_persona-submit'])) {
   $name = $_POST['name'];
   $persona_name = $_POST['persona_name'];
   $image_name = 'default';
   $location = $_POST['location'];
   $age = $_POST['age'];
   $gender = $_POST['gender'];
   $family_size = $_POST['family_size'];;
   $income = $_POST['income'];;
   $occupation = $_POST['occupation'];
   $education = $_POST['education'];
   
   $customer_segments_id = 0;
   
   $sql = "INSERT INTO customer_persona (customer_segments_id, name, persona_name, image_name, location, age, gender, family_size, income, occupation, education) VALUES ('$customer_segments_id', '$name', '$persona_name', '$image_name', '$location', '$age', '$gender', '$family_size', '$income', '$occupation', '$education')";

	if (!mysql_query($sql)) {
		die('ERROR: ' . mysql_error());
	}
}

if (!empty($_POST['customer_relationship_paid-submit'])) {
   $canvas_id = 0;
   $type = 'paid';
   $name = $_POST['name'];
   $cost = $_POST['cost'];
   
   $sql = "INSERT INTO customer_relationships (canvas_id, type, name, cost) VALUES ('$canvas_id', '$type', '$name', '$cost')";

	if (!mysql_query($sql)) {
		die('ERROR: ' . mysql_error());
	}
}

if (!empty($_POST['customer_relationship_earned-submit'])) {
   $canvas_id = 0;
   $type = 'earned';
   $name = $_POST['name'];
   $cost = $_POST['cost'];
   
   $sql = "INSERT INTO customer_relationships (canvas_id, type, name, cost) VALUES ('$canvas_id', '$type', '$name', '$cost')";

	if (!mysql_query($sql)) {
		die('ERROR: ' . mysql_error());
	}
}

if (!empty($_POST['customer_relationship_keep-submit'])) {
   $canvas_id = 0;
   $type = 'keep';
   $name = $_POST['name'];
   $cost = $_POST['cost'];
   
   $sql = "INSERT INTO customer_relationships (canvas_id, type, name, cost) VALUES ('$canvas_id', '$type', '$name', '$cost')";

	if (!mysql_query($sql)) {
		die('ERROR: ' . mysql_error());
	}
}

if (!empty($_POST['customer_relationship_grow-submit'])) {
   $canvas_id = 0;
   $type = 'grow';
   $name = $_POST['name'];
   $cost = $_POST['cost'];
   
   $sql = "INSERT INTO customer_relationships (canvas_id, type, name, cost) VALUES ('$canvas_id', '$type', '$name', '$cost')";

	if (!mysql_query($sql)) {
		die('ERROR: ' . mysql_error());
	}
}


if (!empty($_POST['key_partners-submit'])){
	$canvas_id = 0;
	$partners = $_POST['partners'];
	
	$sql = "INSERT INTO key_partners (canvas_id, partners) VALUES ('$canvas_id', '$partners')";
	
	if (!mysql_query($sql)) {
	
		die('ERROR: ' . mysql_error());
	}
}



if (!empty($_POST['cost_structure-submit'])){

	$canvas_id = 0;
	$salaries = $_POST['salaries'];
	$equipment = $_POST['equipment'];
	$marketing = $_POST['marketing'];
	$legal = $_POST['legal'];
	$accounting = $_POST['accounting'];
	$premises_and_bills = $_POST['premises_and_bills'];
	$expenses = $_POST['expenses'];
	
	$sql = "INSERT INTO cost_structure (canvas_id, salaries, equipment, marketing, legal, accounting, premises_and_bills, expenses)
	VALUES('$canvas_id', '$salaries', '$equipment', '$marketing', '$legal', '$accounting', '$premises_and_bills', '$expenses')";
	
	if (!mysql_query($sql)) {
		die('ERROR: ' . mysql_error());
	}
}

if (!empty($_POST['revenue_streams-submit'])){
	$canvas_id = 0;
	$market_type = $_POST['market_type'];
	$value_driven_strategy = $_POST['value_driven_strategy'];
	$subscriptions = $_POST['subscriptions'];
	
	$sql = "INSERT INTO revenue_streams (canvas_id, market_type, value_driven_strategy, subscriptions) VALUES 
	('$canvas_id', '$market_type', '$value_driven_strategy', '$subscriptions')";
	
	if (!mysql_query($sql)) {
		die('ERROR: ' . mysql_error());
	}
}

mysql_close();

?>