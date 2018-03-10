<?php
	session_start();
	$u = $_SESSION['userid'];
	$id = $_POST['id'];
	require('db.php');
	require('isadmin.php');
	
	$stmt = $pdo->prepare('DELETE FROM messages WHERE id=?');
	$stmt->execute([$id]);
	
	exit();
?>
