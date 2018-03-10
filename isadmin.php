<?php
	function isAdmin() {
		require('db.php');
		$u = $_SESSION['userid'];
		$stmt = $pdo->prepare('SELECT admin FROM users WHERE userid=?');
		$stmt->execute([$u]);
		return $stmt->fetch()['admin'];
	}
?>

