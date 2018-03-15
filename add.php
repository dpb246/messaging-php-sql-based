<?php
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	$u = $_SESSION['userid'];
	$m = $_POST['message'];
	require('check_login.php');
	require("db.php");
	require("dbusers.php");
	if($u != -1) {
		$stmt = $pdo->prepare('INSERT INTO messages (user_id, message) VALUES (?, ?)');
		$stmt->execute([$u, $m]);
		$stmt = $pdo->prepare('UPDATE users SET lastactive = DEFAULT WHERE userid = ?');
		$stmt->execute([$u]);
	}
	exit();
?>

