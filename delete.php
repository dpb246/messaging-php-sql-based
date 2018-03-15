<?php
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	require('db.php');
	require('isadmin.php');
	$u = $_SESSION['userid'];
	$id = $_POST['id'];
		
	$stmt = $pdo->prepare('DELETE FROM messages WHERE id=?');
	$stmt->execute([$id]);
	
	exit();
?>
