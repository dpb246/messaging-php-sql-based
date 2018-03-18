<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="Login_Create.css?1">
</head>
<body>
	<div id='screen'>
		<div id='container'>
			<h2 class='form' id='form_title'>Login:</h2>
			<FORM method="POST">
			<p class='form'>Username</p>
			<INPUT name="username">
			<p class='form'>Password</p>
			<INPUT name="password" type="password"><br><br>
			<INPUT type="submit" value="Login"> 
			</FORM>
		</div>
		<div id='explication'>
			<hr>
			<A href="create.php">Make Account</A>
			<p class='agreement emphasis'>Don't Forget what you agreed to</p>
		</div>
	</div>
	<script>
	</script>
</body>
</html>
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
				$stmt = $pdo->prepare('UPDATE users SET lastactive = DEFAULT WHERE userid = ?');
				$stmt->execute([ $_SESSION['userid'] ]);
				
				$ip = $_SERVER['REMOTE_ADDR']; 
				$file = fopen('ips.txt', 'a+');
				fwrite($file, date("Y/m/d h:i:sa") . ": $username: $ip\r\n");
				fclose($file);
				header('Location: chat.php');
			}
			exit;
		}
	}
?>

