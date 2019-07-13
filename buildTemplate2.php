<?php
	if(!isset($_SESSION))
	{
		session_start();
	}

	include_once("config.php");
    $current_records = trim($_POST["current_records"]);
    $template_id = trim($_POST["template_id"]);
    for($i=1;$i<=$current_records;$i++)
    {
        $subject_id = trim($_POST["subject_id_".$i]);
        $subtopic_id = trim($_POST["subtopic_id_".$i]);
        $marks = trim($_POST["marks_".$i]);
        $count = trim($_POST["count_".$i]);

        $q1 = mysql_query("select * from template_question where template_id = '$template_id' and subtopic_id = '$subtopic_id' and marks = '$marks';");
        if(mysql_num_rows($q1)==0)
        {
            $q2 = mysql_query("insert into template_question (template_id,subtopic_id,marks,count) values ('$template_id','$subtopic_id','$marks','$count');");
            if($q2)
            {
                $_SESSION["Msg"] = "Template Question created successfully";
            }
            else
            {
                $_SESSION["Msg"] = "Error occured.".mysql_error();
            }
        }
        else
        {
            $r1 = mysql_fetch_array($q1);
            $oldCount = $r1["count"];
            $newCount = $oldCount+$count;
            $q2 = mysql_query("update template_question set count = '$newCount' where template_id = '$template_id' and subtopic_id = '$subtopic_id' and marks = '$marks';");
        }
    }

	header("Location: buildTemplate.php");
?>
