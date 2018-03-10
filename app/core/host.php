<?php 

	define("DB_HOST", "xkuklohd.beget.tech");
	define("DB_DATABASE", "xkuklohd_mvc2");
	define("DB_USER", "xkuklohd_mvc2");
	define("DB_PASSWORD", "xkuklohd_mvc2");

	require 'database.php';
	$db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);