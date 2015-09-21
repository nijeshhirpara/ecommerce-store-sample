<?php

	$db_host = "localhost";
	$db_name = "ecomm";
	$username = "root";
	$password = "";


	$db_con = mysql_connect($db_host,$username,$password);

	$mysqli = new mysqli($db_host, $username, $password, $db_name);
	
	if (!$db_con) {
		echo "Failed connect to database";
	} else {
		$db = mysql_select_db($db_name, $db_con) or die("Problem selecting database '{$db_name}'");
		//echo "Connection success!";
	}



?>