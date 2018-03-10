<?php
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	$ip = $_SERVER['REMOTE_ADDR'];
	$validips = ['192.168.1.126', '127.0.0.1', '192.168.1.156','::1','192.168.1.136'];
	$allow = true;
	foreach($validips as $i) {
		if($i == $ip) {
			$allow = true;
		}
	}
	if(!$allow) {
		header('Location: youFailed.php');
		exit();
	}
?>
