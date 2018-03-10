<?php 
	

	function isAuthorised()
	{	
		if (isset($_COOKIE["username"]) && isset($_COOKIE["password"]))   
		{
			//require_once 'app/core/host.php';
			$username = $_COOKIE["username"];
			$password = $_COOKIE["password"];
			$db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
			$res = $db->get_all("SELECT * FROM `users` WHERE `username` = '$username'");

			if($res) {
				if($res[0]["password"] == $password) {
					return true;
				}
			}
			else {
				return false;
			}
		}
		else {
			return false;
		}
	}

?>