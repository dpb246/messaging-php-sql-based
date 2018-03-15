<!DOCTYPE html PUBLIC>
<?php 
require('ipblock.php'); 
require('check_login.php');
$_SESSION['lastmsgsent'] = -1;
?>
<html >
<head>
<title>Chat</title>
<link type="text/css" rel="stylesheet" href="style.css?7" />
</head>
<body >
<div id="all" >
	<div id="wrapper">
		<div id="menu">
			<p class="welcome">Welcome, <b></b></p>
			<p class="logout"><a id="exit" href="logout.php">Exit Chat</a></p>
			<div style="clear:both"></div>
		</div>
		 
		<div id="chatbox"></div>
		 
		<form name="message" action="">
			<input name="usermsg" type="text" id="usermsg" size="63" required autofocus>
			<input name="submitmsg" type="submit"  id="submitmsg" value="Send">
		</form>
	</div>
	<div id="wrapper2">
		<h3 id="title2">Active Users:</h3>
		<div id="userbox"></div>
	</div>
</div>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
<script type="text/javascript">
	// jQuery Document
	$(document).ready(function(){
	 
	});
	$("#submitmsg").click(function(){
		var clientmsg = $("#usermsg").val();
		if(clientmsg != "") {	
			$.post("add.php", {message: clientmsg});
		}			
		$("#usermsg").attr("value", "");
		loadActiveUsers();
		return false;
	});
	var oldscrollHeight = 0;
	var oldHtml = "";
	var displayedHtml = "";
	function loadLog(){		
		$.ajax({
			url: "view.php",
			cache: false,
			success: function(html){
				if(oldHtml != html) {
					oldHtml=html;
					displayedHtml = html;
					$("#chatbox").html(displayedHtml); //Insert chat log into the #chatbox div
					//Auto-scroll			
					var newscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height after the request
					if(newscrollHeight > oldscrollHeight){
						$("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
						oldscrollHeight = newscrollHeight;
					}
				}
			},
		});
	}
	setInterval( loadLog, 250);
	var oldHtml2 = "";
	var displayedHtml2 = "";
	function loadActiveUsers(){		
		$.ajax({
			url: "viewusers.php",
			cache: false,
			success: function(html){
				if(oldHtml2 != html) {
					oldHtml2=html;
					displayedHtml2 = html;
					$("#userbox").html(displayedHtml2); //Insert chat log into the #chatbox div
				}
			},
		});
	}
	loadActiveUsers();
	setInterval( loadActiveUsers, 10000);
</script>
</body>
</html>
