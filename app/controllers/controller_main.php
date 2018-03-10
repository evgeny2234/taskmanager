<?php


class Controller_Main extends Controller
{
	function action_index()
	{	
		require_once("app/services/isautorised.php");
		$isAuthorised = isAuthorised();
		
		if($isAuthorised) {

			$username = $_COOKIE["username"];
			$db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
			$res = $db->get_all("SELECT * FROM `users` WHERE `username` = '$username'");
			header('Location: ../mvc/workflow');

		}
		else {
			header('Location: ../mvc/auth');
		}

	}
}