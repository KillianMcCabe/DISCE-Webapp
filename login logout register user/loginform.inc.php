<?php

if (isset($_POST['username']) && isset($_POST['password'])){
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	$password_hash = md5($password);
	
	if (!empty($username) && !empty($password)){
		
		$query = "SELECT id FROM users WHERE username = '$username' AND password = '$password_hash'"; 
		if($query_run = mysql_query($query)){
			$query_num_rows = mysql_num_rows($query_run);
			if($query_num_rows == 0){
				echo 'Invalid username/password.';
			}
			else{
				$user_id = mysql_result($query_run, 0, 'id');
				$_SESSION['user_id'] = $user_id;
				header('Location: index.php');
			}
		}
	
	}
	else{
		echo 'Enter username and/or password.';
	}
}

?>

<form action="<?php echo $current_file; ?>" method = "POST">
Username: <input type = "text" name = "username"> 
Password: <input type = "password" name = "password">
<input type = "submit" value = "Log in">
</form>