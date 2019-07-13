<?php
	if(!isset($_SESSION))
	{
		session_start();
	}

	include_once("config.php");
	$template_name= trim($_POST["template_name"]);
	$subject_id= trim($_POST["subject_id"]);
	$total_marks= trim($_POST["total_marks"]);

	$q1 = mysql_query("select * from templates where template_name = '$template_name' and total_marks = '$total_marks' and subject_id = '$subject_id';");
	if(mysql_num_rows($q1)==0)
	{
		$q2 = mysql_query("insert into templates (template_name,subject_id,total_marks) values ('$template_name','$subject_id','$total_marks');");
		if($q2)
		{
			$_SESSION["Msg"] = "Template created successfully";
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
	header("Location: addTemplate.php");
?>
