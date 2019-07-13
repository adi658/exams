<?php
	if(!isset($_SESSION))
	{
		session_start();
	}

	include_once("config.php");
	$paper_name= trim($_POST["paper_name"]);
	$template_id= trim($_POST["template_id"]);
	$month_year= trim($_POST["month"])."/".trim($_POST["year"]);

	$q1 = mysql_query("select * from questionpaper where paper_name = '$paper_name' and template_id = '$template_id' and month_year = '$month_year';");
	if(mysql_num_rows($q1)==0)
	{
		$q2 = mysql_query("insert into questionpaper (paper_name,template_id,month_year) values ('$paper_name','$template_id','$month_year');");
		if($q2)
		{
			$_SESSION["Msg"] = "Paper record created successfully";
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
	header("Location: generatePaper.php");
?>
