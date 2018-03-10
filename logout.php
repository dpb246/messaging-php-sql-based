<?php
	session_destroy();
	header('Location: login.php');
	$stmt = $pdo->prepare('UPDATE users SET active = 0 WHERE userid = ?');
			$stmt->execute([ $_SESSION['userid'] ]);
?>
