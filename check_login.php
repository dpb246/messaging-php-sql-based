<?php
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	if( ! ($_SESSION['userid'] > 0)) {
		header('Location: youFailed.php');
		exit();
	}
?>
