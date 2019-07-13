<?php
	if(!isset($_SESSION))
	{
		session_start();
	}

	include_once("config.php");
	$question = trim($_POST["question"]);
	$subject_id = trim($_POST["subject_id"]);
	$subtopic_id = trim($_POST["subtopic_id"]);
	$marks = trim($_POST["marks"]);
	$status = trim($_POST["status"]);

	$q1 = mysql_query("select * from questions where question = '$question' and subtopic_id = '$subtopic_id';");
	if(mysql_num_rows($q1)==0)
	{
		$q2 = mysql_query("insert into questions (question,subtopic_id,marks,status) values ('$question','$subtopic_id','$marks','$status');");
		if($q2)
		{
			$_SESSION["Msg"] = "Question created successfully";
		}
		else
		{
			$_SESSION["Msg"] = "Error occured.".mysql_error();
		}
	}
	else
	{
		$_SESSION["Msg"] = "The question already exists.";
	}
	header("Location: addQuestion.php");
?>
