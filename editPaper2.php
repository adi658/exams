<?php
	if(!isset($_SESSION))
	{
		session_start();
	}

	include_once("config.php");

	if((isset($_GET["type"])) && $_GET["type"]=="del")
	{
		$paper_id = $_GET["paper_id"];
		$q2 = mysql_query("delete from questionpaper where paper_id = '$paper_id';");
		if($q2)
		{
			$_SESSION["Msg"] = "Question Paper deleted successfully";
		}
		else
		{
			$_SESSION["Msg"] = "Error occured.".mysql_error();
		}
	}
	else
	{
		$paper_id = $_POST["paper_id"];
		$template_id = trim($_POST["template_id"]);
        $paper_name= trim($_POST["paper_name"]);
        $month_year= trim($_POST["month"])."/".trim($_POST["year"]);    
        $status= trim($_POST["status"]);    
        $finalArr = array();
        
        $q1 = mysql_query("select * from questionpaper where paper_name = '$paper_name' and template_id = '$template_id' and month_year = '$month_year' and paper_id <> '$paper_id';");
        if(mysql_num_rows($q1)==0)
        {
            $q2 = mysql_query("update questionpaper set paper_name='$paper_name', template_id = '$template_id', month_year = '$month_year', status = '$status' where paper_id = '$paper_id';");
            if($q2)
            {
                $_SESSION["Msg"] = "Question Paper updated successfully";

                // form the paper and put it in "questionpaper_details"
                // get the template questions subtopic makrs and count
                $q3 = mysql_query("select * from template_question where template_id = '$template_id'; ");
                if(mysql_num_rows($q3)>0)
                {
                    while($r3 = mysql_fetch_array($q3))
                    {
                        $template_qn_id = $r3["template_qn_id"];
                        $subtopic_id = $r3["subtopic_id"];
                        $marks = $r3["marks"];
                        $count = $r3["count"];

                        echo "<hr><br>marks: ".$marks." | count: ".$count." | subtopic_id: ".$subtopic_id;
                        // get questions for this subtopicid, marks, 
                        $q4 = mysql_query("select * from questions where subtopic_id = '$subtopic_id' and marks = '$marks' and status = '1'; ");
                        if(mysql_num_rows($q4)>0)
                        {
                            $question_array = array();
                            while($r3 = mysql_fetch_array($q4))
                            {
                                $question_id = $r3["question_id"];
                                $question = $r3["question"];
                                array_push($question_array,$question_id);
                                echo "<br>questionId: ".$question_id." | question: ".$question;
                            }
                            echo "<br><pre>";
                            print_r($question_array);
                            echo "<br><pre>";
                            if($count>1)
                            {
                                foreach( array_rand($question_array, $count) as $key ) {
                                    echo $question_array[$key].",";
                                    array_push($finalArr,$question_array[$key]);
                                }
                            }
                            else
                            {
                                $randArrKey = array_rand($question_array,1);
                                echo $randArrKey;
                                array_push($finalArr,$question_array[$randArrKey]);                                
                            }
                        }
                    }
                }
            }
            else
            {
                $_SESSION["Msg"] = "Error occured.".mysql_error();
            }
            echo "<hr><hr><pre>";
            print_r($finalArr);

            for($k=0;$k<sizeof($finalArr);$k++)
            {
                $q5 = mysql_query("insert into questionpaper_details(paper_id,question_id) value ('$paper_id','$finalArr[$k]');");
            }
            $q6 = mysql_query("update questionpaper set status='2' where paper_id = '$paper_id';");
        }
        else
        {
            $_SESSION["Msg"] = "The combination already exists.";
        }
	}

	//header("Location: generatePaper.php");
?>