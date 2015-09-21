<?php

include_once('functions.php');

$route = "";

if(isset($_GET['route'])){
	$route = $_GET['route'];
}

switch($route)
{
	case 'HOME':		get_home();
						break;

	case 'UPLOAD':		get_upload();
						break;

	case 'PRODUCT':		get_product();
						break;

	default:			get_home();
}

