<?php
	if(!isset($_SESSION))
	{
		session_start();
	}

	include_once("config.php");

	if((isset($_GET["type"])) && $_GET["type"]=="del")
	{
		$subject_id = $_GET["subject_id"];
		$q2 = mysql_query("delete from subjects where subject_id = '$subject_id';");
		if($q2)
		{
			$_SESSION["Msg"] = "Subject deleted successfully";
		}
		else
		{
			$_SESSION["Msg"] = "Error occured.".mysql_error();
		}
	}
	else
	{
		$subject_id = $_POST["subject_id"];
		$subject_name= $_POST["subject_name"];
		$q1 = mysql_query("select * from subjects where subject_name='$subject_name' and subject_id != '$subject_id';");
		if(mysql_num_rows($q1)==0)
		{
			$q2 = mysql_query("update subjects set subject_name='$subject_name' where subject_id = '$subject_id';");
			if($q2)
			{
				$_SESSION["Msg"] = "Subject updated successfully";
			}
			else
			{
				$_SESSION["Msg"] = "Error occured.".mysql_error();
			}
	
		}
		else
		{
			$_SESSION["Msg"] = "Subject name already exists";
		}

	}

	header("Location: addSubject.php");
?>