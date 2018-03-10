<?php

class Controller_Auth extends Controller
{
	
	function action_index()
	{	
		$this->view->generate('main_view.php', 'auth.tpl', '', '');
	}
	
	function action_login(){	

		if(isset($_POST['login']) && isset($_POST['password']))
		{
			$login = $_POST['login']; //user login
			$password = md5($_POST['password']); //user password_hash
			$keep_singin = isset($_POST['keep_singin']) ? $_POST['keep_singin'] : "0";

			$db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
			$res = $db->get_all("SELECT * FROM `users` WHERE `username` = '$login'");

			if($res) {
				if($res[0]["password"] == $password) {
					
					session_start();
					$_SESSION['test']='Hello world!';
					setcookie("username",$login,false,"/",false);
					setcookie("password",$password,false,"/",false);

					$domain = false;
					$domain = ($_SERVER['HTTP_HOST'] != 'http://192.168.64.2/') ? $_SERVER['HTTP_HOST'] : false;

					header('Location: ../workflow');
				}
				else {
					header('Location: ../auth');
				}
			}
			else {
				header('Location: ../auth');
			}
		}
		else
		{
			header('Location: ../mvc');
		}
	}

	function action_register() {

		if(isset($_POST['register_form'])) {

			$username = $_POST['username'];
			$email = $_POST['email'];
			$password = md5($_POST['password']);
			$userAlreadyExists = false;
			$userHasRegistered = false;

			$db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
			$res = $db->get_all("SELECT * FROM `users` WHERE `username` = '$username' OR `email` = '$email'");

			if($res) {
				$userAlreadyExists = true;
				$this->view->generate('main_view.php', 'alreadyExist.tpl', '', '');
			}
			else {
				$db->query("INSERT INTO `users`(`id`, `username`, `email`, `password`) VALUES ('','$username','$email','$password')");
		 		$userHasRegistered = true;
		 		$this->view->generate('main_view.php', 'registered.tpl', '', '');
			}

		}
		else {
			header('Location: ../auth');
		}
	}

	function action_logout() {
		setcookie("username",null,-1,"/",false);
		setcookie("password",null,-1,"/",false);
		header('Location: ../auth');
	}
	
}