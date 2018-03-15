<html>
<head>
	<title>Login</title>
	<style> 
		#screen {
			position: relative;
			width: 100%;
			hieght: 100%;
			text-align: center;
		}
		#container {
			text-align: center;
		}
		#message {
			font-size: 700%;
			color: blue;
		}
		.emphasis{
			font-size: 150%;
		}
		.agreement {
			color: green;
			margin: 0px;
		}
		.form {
			color: blue;
		}
		#disclaimer {
			font-style: italic;
		}
		#why {
			color: #018982;
		}
		.form {
			margin: 4px;
		}
	</style>
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
			<INPUT type="submit"> 
			</FORM>
		</div>
		<div id='explication'>
			<hr>
			<A href="create.php">Make Account</A>
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
				header('Location: chat.php');
			}
			$stmt = $pdo->prepare('UPDATE users SET active = 1 WHERE userid = ?');
			$stmt->execute([ $_SESSION['userid'] ]);
		}
	}
?>

