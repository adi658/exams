<?php
   if(!isset($_SESSION))
   {
      session_start();
   }
   unset($_SESSION["userlogin"]);
   unset($_SESSION["Msg"]);
	header("Location: login.php");
?>
