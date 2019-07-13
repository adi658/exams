<?php
	if(!isset($_SESSION))
	{
		session_start();
	}

	include_once("config.php");

	if((isset($_GET["type"])) && $_GET["type"]=="del")
	{
		$question_id = $_GET["question_id"];
		$q2 = mysql_query("delete from questions where question_id = '$question_id';");
		if($q2)
		{
			$_SESSION["Msg"] = "Question deleted successfully";
		}
		else
		{
			$_SESSION["Msg"] = "Error occured.".mysql_error();
		}
	}
	else
	{
		$question_id = trim($_POST["question_id"]);
		$subject_id = trim($_POST["subject_id"]);
        $subtopic_id = trim($_POST["subtopic_id"]);
        $marks = trim($_POST["marks"]);
        $status = trim($_POST["status"]);
        $question = trim($_POST["question"]);

        $q1 = mysql_query("select * from questions where question = '$question' and subtopic_id = '$subtopic_id' and question_id <> '$question_id';");
        if(mysql_num_rows($q1)==0)
        {
            $q2 = mysql_query("update questions set question='$question', subtopic_id = '$subtopic_id', marks = '$marks', status = '$status' where question_id = '$question_id';");
            echo("update questions set question='$question', subtopic_id = '$subtopic_id', marks = '$marks', status = '$status' where question_id = '$question_id';");
            if($q2)
            {
                $_SESSION["Msg"] = "Question updated successfully";
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

	header("Location: addQuestion.php");
?>