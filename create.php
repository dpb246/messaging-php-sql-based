<html>
<head>
	<title>Create Account</title>
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
			<h2 class='form' id='form_title'>Create an Account:</h2>
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
	<script>
	</script>
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

		$stmt = $pdo->prepare('INSERT INTO users (username, password) VALUES (?, ?)');
		$stmt->execute([$username, $password]);
		
		$_SESSION['userid'] = $pdo->lastInsertId();

		header('Location: chat.php');
		exit;
	}
?>

