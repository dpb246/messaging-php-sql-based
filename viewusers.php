<?php
	require("db.php");
	$stmt = $pdo->prepare("SELECT * FROM users WHERE lastactive >= CURRENT_TIMESTAMP - interval '4' minute;");
	$stmt->execute([]);
	while ($row = $stmt->fetch())
	{
		echo $row['username'] . "<br>";
	}
?>

