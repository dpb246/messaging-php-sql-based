<?php
	require("db.php");
	session_start();
	require("check_login.php");
	require("isadmin.php");
	$stmt = $pdo->prepare('SELECT * FROM messages');
	$stmt2 = $pdo->prepare('SELECT username FROM users WHERE userid=?');
	
	$lastIDsent = $_SESSION['lastmsgsent'];
	$stmt->execute([]);
	foreach($stmt->fetchAll() as $row) {
		$stmt2->execute([$row['user_id']]);
		$name = $stmt2->fetch();
		$name = $name['username'];
		$time = new DateTime($row['time']);
		$time = $time->format('h:i:s');
		echo '<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>';
		if(isAdmin()) {
			$id = $row['id'];
			echo "<div class='msgln'><span class='action' id='$id'>$time</span> <b>$name</b>: ".$row['message']."<script>var myEl = document.getElementById($id);
					myEl.addEventListener('click', function() {
						$.post('delete.php', {id: $id});
					}, false);</script><br></div>";	
		} else {
			echo "<div class='msgln'>$time <b>$name</b>: ".$row['message']."<br></div>";
		}
	}
	
?>
