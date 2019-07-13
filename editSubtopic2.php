<?php
	if(!isset($_SESSION))
	{
		session_start();
	}

	include_once("config.php");

	if((isset($_GET["type"])) && $_GET["type"]=="del")
	{
		$subtopic_id = $_GET["subtopic_id"];
		$q2 = mysql_query("delete from subtopics where subtopic_id = '$subtopic_id';");
		if($q2)
		{
			$_SESSION["Msg"] = "Subtopic deleted successfully";
		}
		else
		{
			$_SESSION["Msg"] = "Error occured.".mysql_error();
		}
	}
	else
	{
		$subtopic_id = $_POST["subtopic_id"];
		$subject_id = $_POST["subject_id"];
		$subtopic_name= $_POST["subtopic_name"];
        $q1 = mysql_query("select * from subtopics where subtopic_name = '$subtopic_name' and subject_id = '$subject_id' and subtopic_id != '$subtopic_id';");
        if(mysql_num_rows($q1)==0)
        {
            $q2 = mysql_query("update subtopics set subtopic_name='$subtopic_name', subject_id = '$subject_id' where subtopic_id = '$subtopic_id';");
            if($q2)
            {
                $_SESSION["Msg"] = "Subtopic updated successfully";
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

	header("Location: addSubtopic.php");
?>