Login: <br>
<FORM method="POST">

Username<INPUT name="username">
Password<INPUT name="password" type="password">
<INPUT type="submit"> 

</FORM>
<A href="create.php">Make Account</A>
<?php
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	require("ipblock.php");
	$_SESSION['userid'] = -1;
	if( isset($_POST['username']) && isset ($_POST['password'])){
		$username = $_POST['username'];
		$password = $_POST['password'];
		$active = $_POST['active'];

		require("dbusers.php");

		if ($username && $password) 
		{
			$stmt = $pdo->prepare('SELECT userid FROM users WHERE username = ? AND password=?');
			$stmt->execute([$username, $password]);
			$userid = $stmt->fetch();
			$userid = $userid['userid'];
			if(isset($userid)) {
				$_SESSION['userid'] = $userid;
				echo "Success";
				header('Location: chat.html');
			}
			$stmt = $pdo->prepare('UPDATE users SET active = 1 WHERE userid = ?');
			$stmt->execute([ $_SESSION['userid'] ]);
		}
	}
?>

