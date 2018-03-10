Create an Account: <br>
<FORM method="POST">

Username<INPUT name="username">
Password<INPUT name="password" type="password">
<INPUT type="submit"> 

</FORM>

<?php
	session_start();
	require('ipblock.php');
	$_SESSION['userid'] = -1;
	if( isset($_POST['username']) && isset ($_POST['password'])){
		$username = $_POST['username'];
		$password = $_POST['password'];

		require("dbusers.php");

		$stmt = $pdo->prepare('INSERT INTO users (username, password) VALUES (?, ?)');
		$stmt->execute([$username, $password]);
		
		$_SESSION['userid'] = $pdo->lastInsertId();

		header('Location: chat.html');
		exit;
	}
?>

