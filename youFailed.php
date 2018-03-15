
<?php
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	session_destroy();
?>
<html>
<head>
	<title>Blocked</title>
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
			color: #0070FF;
		}
		#why {
			font-size: 200%;
			color: green;
		}
		body {
			background-color: #911e1e;
		}
	</style>
</head>
<body>
	<div id='screen'>
		<div id='container'>
			<p id='message'>Game Over!</p>
		</div>
		<div id='explication'>
			<p id='why'>You broke a site rule<br> Which you had agreed to follow<br> Maybe this leave, will teach you<br> how not to break suit</p>
		</div>
	</div>
</body>
</html>