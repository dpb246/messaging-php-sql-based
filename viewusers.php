<?php
	require("db.php");
	$stmt = $pdo->prepare('SELECT * FROM users WHERE active = 1');
	$stmt->execute([]);

	while ($row = $stmt->fetch())
	{
		echo $row['username'] . "<br>";
	}

?>

