<?php
session_start(); // Starting Session
$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) 
{
	if (empty($_POST['username']) || empty($_POST['password'])) 
	{
		$error = "Username or Password is invalid";
		echo $error;
	}
	else
	{
		
		// Define $username and $password
		$username=$_POST['username'];
		$password=$_POST['password'];
		// Establishing Connection with Server by passing server_name, user_id and password as a parameter
		$connection = mysql_connect("localhost", "root", "1234");
		// To protect MySQL injection for Security purpose
		$username = stripslashes($username);
		$password = stripslashes($password);
		$username = mysql_real_escape_string($username);
		$password = mysql_real_escape_string($password);
		// Selecting Database
		echo $username;
		echo $password;
		$db = mysql_select_db("company", $connection);
		// SQL query to fetch information of registerd users and finds user match.
		//echo $username;
		$query = mysql_query("select * from login where password='$password' AND username='$username';");	
		//debug($query);
		echo $username;
		//echo $query
		$rows = mysql_num_rows($query);
		if ($rows == 1) 
		{
			$_SESSION['login_user']=$username;
			echo "success"; // Initializing Session
			header("Location: http://localhost/profile.html"); // Redirecting To Other Page
		} 
		else 
		{
			$error = "Username or Password is invalid";
			echo $error;
		}
	}
	mysql_close($connection); // Closing Connection
}

?>
