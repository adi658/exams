<?php
    if(!isset($_SESSION))
	{
			session_start();
	}

	if((isset($_POST["submit"])) && $_POST["submit"]!="")
	{
		$username = $_POST["username"];
		$password = $_POST["password"];
		$encpassword = md5($password);

		include_once("config.php");
        $q1 = mysql_query("select * from users where username = '$username' and password = '$encpassword';");
		if(mysql_num_rows($q1)>0)
		{
			$_SESSION["userlogin"] = $username;
			?>
				<script>
					window.location.href = "index.php";
				</script>
			<?php
		}
		else
		{
            $_SESSION["userlogin"] = "";
            $_SESSION["Msg"] = "Incorrect Username/Password";
			?>
				<script>
					window.location.href = "login.php";
				</script>
			<?php
		}
	}
	else
	{
        if((isset($_SESSION["Msg"])) && $_SESSION["Msg"]!="")
        {
            echo "<center>".$_SESSION["Msg"]."</center>";
        }
        $_SESSION["Msg"]= "";
		?>
		<form action = "login.php" method = "POST">
			<div style = "background-color:#FFF;margin-top:100px;" align = "center">
				<!--<img src = "bg.png" style = "opacity:0.3" style = "position:absolute;left:400px;top:20%;">-->
					<h3 style = "color:Blue">On Demand Exam - User Login</h3><br>
					<b><span style = "font-size:12px;">Username</span></b>: <input type = "text" value = "" name = "username" id = "username"><br><br>
					<b><span style = "font-size:12px;">Password</span></b>: <input type = "password" value = "" name = "password" id = "password"><br><br>
					<input type = "submit" value = "Login" name = "submit"><br><br>
			</div>
		</form>
		<?php

	}
?>
