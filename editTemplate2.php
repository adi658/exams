<?php
	if(!isset($_SESSION))
	{
		session_start();
	}

	include_once("config.php");

	if((isset($_GET["type"])) && $_GET["type"]=="del")
	{
		$template_id = $_GET["template_id"];
		$q2 = mysql_query("delete from templates where template_id = '$template_id';");
		if($q2)
		{
			$_SESSION["Msg"] = "Template deleted successfully";
		}
		else
		{
			$_SESSION["Msg"] = "Error occured.".mysql_error();
		}
	}
	else
	{
		$template_id = $_POST["template_id"];
		$subject_id = $_POST["subject_id"];
		$template_name= $_POST["template_name"];
		$total_marks= $_POST["total_marks"];
        $q1 = mysql_query("select * from templates where template_name = '$template_name' and subject_id = '$subject_id' and total_marks = '$total_marks' and template_id <> '$template_id';");
        if(mysql_num_rows($q1)==0)
        {
            $q2 = mysql_query("update templates set template_name='$template_name', total_marks = '$total_marks', subject_id = '$subject_id' where template_id = '$template_id';");
            if($q2)
            {
                $_SESSION["Msg"] = "Template updated successfully";
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
	}

	header("Location: addTemplate.php");
?>