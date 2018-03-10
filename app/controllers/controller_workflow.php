<?php

class Controller_Workflow extends Controller
{
	function action_index() {

		require_once("app/services/isautorised.php");
		$isAuthorised = isAuthorised();

		if($isAuthorised) {

			$username = $_COOKIE["username"];
			$db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
			$blocks = $db->get_all("SELECT * FROM `taskblocks` WHERE `username` = '$username'");

			if($blocks == '') {
				$this->view->generate('main_view.php', 'workflow.tpl', false, false); //вывод интерфейса шаблона
			}
			else {
				function taskBlocksMakeArray($blocks) {
					$counter = 0;
					foreach ($blocks as $value) {
						$blocksArray[$counter] = $value['id'];
						$counter++;
					}
					if($counter > 0) {
						return $blocksArray;
					}
					else return false;
					
				}

				$blocksIdArray = taskBlocksMakeArray($blocks);
				if($blocksIdArray) {
					$blocksCounter = count($blocksIdArray);
					$allTasks = $db->get_all("SELECT * FROM `tasks` WHERE `block_id` IN( '" . implode("','", $blocksIdArray) . "' )");
					$this->view->generate('main_view.php', 'workflow.tpl', $blocks, $allTasks); //вывод интерфейса шаблона
				}
				else {
					$this->view->generate('main_view.php', 'workflow.tpl', false, false); //вывод интерфейса шаблона
				}
			}

			
		}
		else {
			header('Location: ../mvc/auth');
		}
	}

	function action_removeblock() {
		if(isset($_POST['blockId'])) {

			$username = $_COOKIE["username"];
			$password = $_COOKIE["password"];
			$blockId = $_POST['blockId'];

			$db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
			$db->query("DELETE FROM `taskblocks` WHERE `username` = '$username' AND `id` = '$blockId'");
		}
		else {
			header('Location: ../mvc/workflow');
		}
	}

	function action_removetask() {

		if(isset($_POST['blockId'])) {

			$username = $_COOKIE["username"];
			$blockId = $_POST['blockId'];
			$taskhash = $_POST['taskhash'];
			$taskId = $_POST['taskId'];

			$db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
			$getByhash = $db->get_all("SELECT * FROM `tasks` WHERE `taskhash` = '$taskhash'");

			$db->query("DELETE FROM `tasks` WHERE `username` = '$username' AND (`id`='$taskId') OR (`taskhash`='$taskhash') AND `block_id`='$blockId' ");

			echo '12';
		}
		else {
			header('Location: ../mvc/workflow');
		}
	}

	function action_ischecked() {

		if(isset($_POST['blockId'])) {

			$username = $_COOKIE["username"];
			$password = $_COOKIE["password"];
			$blockId = $_POST['blockId'];
			$taskId = $_POST['taskId'];
			$isChecked = $_POST['isChecked'];
			$taskName = $_POST['taskName'];
			$taskhash = $_POST['taskhash'];

			$db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
			$getByhash = $db->get_all("SELECT * FROM `tasks` WHERE `taskhash` = '$taskhash'");

			$isChecked = ($isChecked == "true") ? 1 : 0;

			$db->query("UPDATE `tasks` SET `status`='$isChecked' WHERE `username`='$username' AND (`id`='$taskId') OR (`taskhash`='$taskhash') AND `block_id`='$blockId'");

		}
		else {
			header('Location: ../mvc/workflow');
		}
	}

	function action_headrename() {

		if(isset($_POST['blockId'])) {

			$username = $_COOKIE["username"];
			$blockname = $_POST['headtext'];
			$blockId = $_POST['blockId'];

			$db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
			$db->query("UPDATE `taskblocks` SET `blockname`='$blockname' WHERE `username`='$username' AND `id`='$blockId'");

		}
		else {
			header('Location: ../mvc/workflow');
		}
	}

	function action_taskname() {

		if(isset($_POST['blockId'])) {

			$username = $_COOKIE["username"];
			$password = $_COOKIE["password"];
			$blockId = $_POST['blockId'];
			$taskId = $_POST['taskId'];
			$taskName = $_POST['taskName'];
			$taskhash = $_POST['taskhash'];

			$db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
			$getByhash = $db->get_all("SELECT * FROM `tasks` WHERE `taskhash` = '$taskhash'");

			if(($taskId == 'undefined') && (count($getByhash) == "0")){
				$db->query("INSERT INTO `tasks`(`id`, `username`, `block_id`, `taskname`, `status`, `taskhash`) VALUES ('','$username','$blockId','$taskName','0','$taskhash')");

			}
			else {
				$db->query("UPDATE `tasks` SET `username`='$username',`block_id`='$blockId',`taskname`='$taskName' WHERE `username`='$username' AND (`id`='$taskId') OR (`taskhash`='$taskhash') AND `block_id`='$blockId'");
			}
		}
		else {
			header('Location: ../mvc/workflow');
		}
	}

	function action_createblock() {

		if(isset($_POST['createNewBlock'])) {

			$username = $_COOKIE["username"];
			$db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
			$db->query("INSERT INTO `taskblocks` (`id`, `username`, `blockname`) VALUES (NULL, '$username', 'Введите название');");
			
		}
		header('Location: ../workflow');	
	}
}