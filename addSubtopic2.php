<?php
	if(!isset($_SESSION))
	{
		session_start();
	}

	include_once("config.php");
	$subtopic_name= trim($_POST["subtopic_name"]);
	$subject_id= trim($_POST["subject_id"]);

	$q1 = mysql_query("select * from subtopics where subtopic_name = '$subtopic_name' and subject_id = '$subject_id';");
	if(mysql_num_rows($q1)==0)
	{
		$q2 = mysql_query("insert into subtopics (subtopic_name,subject_id) values ('$subtopic_name','$subject_id');");
		if($q2)
		{
			$_SESSION["Msg"] = "Subtopic created successfully";
		}
		else
		{
			$_SESSION["Msg"] = "Error occured.".mysql_error();
		}
	}
	else
	{
		$_SESSION["Msg"] = "The combination already exists.";
	}
	header("Location: addsubtopic.php");
?>
