<!DOCTYPE html PUBLIC>
<?php 
require('ipblock.php'); 
require('check_login.php');
?>
<html >
<head>
<title>Chat</title>
<link type="text/css" rel="stylesheet" href="style.css" />
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
			<input name="usermsg" type="text" id="usermsg" size="63" />
			<input name="submitmsg" type="submit"  id="submitmsg" value="Send" />
		</form>
	</div>
</div>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
<script type="text/javascript">
	// jQuery Document
	$(document).ready(function(){
	 
	});
	$("#submitmsg").click(function(){	
		var clientmsg = $("#usermsg").val();
		$.post("add.php", {message: clientmsg});				
		$("#usermsg").attr("value", "");
		return false;
	});
	var oldscrollHeight = 0;
	function loadLog(){		
		$.ajax({
			url: "view.php",
			cache: false,
			success: function(html){
				$("#chatbox").html(html); //Insert chat log into the #chatbox div
				//Auto-scroll			
				var newscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height after the request
				if(newscrollHeight > oldscrollHeight){
					$("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
					oldscrollHeight = newscrollHeight;
				}
			},
		});
	}
	setInterval( loadLog, 250);
</script>
<a href="viewusers.php">See who's online!</a>
</body>
</html>