<?php
require 'core.inc.php';
require 'connect.inc.php';

if(loggedin()){
	echo 'You have logged in. <a href="logout.php"> Log out</a>';
}
else if(!loggedin()){
	include 'loginform.inc.php';
	include 'register_button.inc.php';
}

?>