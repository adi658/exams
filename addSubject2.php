<?php
	if(!isset($_SESSION))
	{
		session_start();
	}

	include_once("config.php");
	$subject_name= trim($_POST["subject_name"]);

	$q1 = mysql_query("select * from subjects where subject_name = '$subject_name';");
	if(mysql_num_rows($q1)==0)
	{
		$q2 = mysql_query("insert into subjects (subject_name) values ('$subject_name');");
		if($q2)
		{
			$_SESSION["Msg"] = "Subject created successfully";
		}
		else
		{
			$_SESSION["Msg"] = "Error occured.".mysql_error();
		}
	}
	else
	{
		$_SESSION["Msg"] = "Subject already exists.";
	}
	header("Location: addSubject.php");
?>
