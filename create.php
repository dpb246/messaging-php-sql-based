<html>
<head>
	<title>Create Account</title>
	<link rel="stylesheet" type="text/css" href="Login_Create.css?1">
</head>
<body>
	<div id='screen'>
		<div id='container'>
			<h2 class='form' id='form_title'>Create an Account:</h2>
			<FORM id="userinfo" method="POST">
			<p class='form'>Username</p><p id="usernameexist"></p>
			<input type="text" name="username" required maxlength="24">
			<p class='form'>Password</p>
			<INPUT type="password" name="password"  required maxlength="24"><br><br>
			<INPUT type="submit" value="Create Account"> 
			</FORM>
		</div>
		<div id='explication'>
			<hr>
			<a href='login.php'>Already Have Account? Login</a><br>
			<h3 class='agreement'>User Agreement</h3>
			<p class='agreement' id='disclaimer'>By creating an account you agree to the following:</p>
			<br>
			<p class='agreement' id='why'>There once was a user named Gus<br> Whose postings caused such a fuss<br> He didn't agree with the license you see<br> And now he is not one of us</p>
			<br>
			<p class='agreement'><b>The rules are simple, don't make a moderator mad.</b></p>
			<p class='agreement'>What exactly will make a moderator mad is changing.  <br>Swearing, insulting, belittling are common things.<br>  Remember to keep language and topic clean.  <br>Your grandma could be in this server, if you wouldn't want her to see it then.</p>
			<p class='agreement emphasis'><b>Then don't say it.</b></p>
			<p class='agreement'>That is the best advice.</p>
		</div>
	</div>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
</body>
</html>

<?php
	session_start();
	require('ipblock.php');
	$_SESSION['userid'] = -1;
	if( isset($_POST['username']) && isset ($_POST['password'])){
		$username = $_POST['username'];
		$password = $_POST['password'];

		require("dbusers.php");
		$stmt = $pdo->prepare('SELECT userid FROM users WHERE username=?');
		$stmt->execute([$username]);
		if($stmt->fetch() != NULL) {
			echo "<script> $('#usernameexist').html('Username is taken'); </script>";
			exit;
		}
		$stmt = $pdo->prepare('INSERT INTO users (username, password) VALUES (?, ?)');
		$stmt->execute([$username, $password]);
		
		$_SESSION['userid'] = $pdo->lastInsertId();
		$ip = $_SERVER['REMOTE_ADDR']; 
		$file = fopen('ips.txt', 'a+');
		fwrite($file, date("Y/m/d h:i:sa") . ": $username: $ip\r\n");
		fclose($file);
		header('Location: chat.php');
		exit;
	}
?>

