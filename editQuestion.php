<html>
	<head>
		<link rel="stylesheet" href="style.css">
		<script src = "main.js"></script>
		<title>Edit Question</title>
	</head>
	<body>
		<div class = "mainDiv" align = "center">
			<?php
				include_once("header.php");
				$question_id1 = $_GET["question_id"];
				$q3 = mysql_query("select q.marks as marks, q.status as status, s.subject_id as subject_id, s.subject_name as subject_name, st.subtopic_id as subtopic_id, st.subtopic_name as subtopic_name, q.question_id as question_id, q.question as question from subtopics as st, subjects as s, questions as q where q.question_id = '$question_id1' and st.subject_id = s.subject_id and st.subtopic_id = q.subtopic_id order by q.question, st.subtopic_name, s.subject_name asc;");
				if(mysql_num_rows($q3)>0)
				{
					$r3 = mysql_fetch_array($q3);
                    $question1= $r3["question"];
                    $subtopic_id1= $r3["subtopic_id"];
                    $subject_name1= $r3["subject_name"];
                    $subject_id1= $r3["subject_id"];
                    $marks1= $r3["marks"];
                    $status1= $r3["status"];
                    
            }
			?>
			<form action = "editquestion2.php" method = "POST" onSubmit = "return val_addquestion();">
            <table cellspacing = "1px" cellpadding = "5px" border = "1px" width = "100%" class = "mainTable" align = "center">
					<tr>
						<td width = "50%">
							Question Name:
						</td>
						<td>
							<textarea name = "question" id = "question" rows="4" cols = "30"><?php echo ($question1);?></textarea>
						</td>
					</tr>
					<tr>
						<td width = "50%">
							Subject Name:
						</td>
						<td>
							<select name = "subject_id" id = "subject_id" onChange = "getSubTopics()">
								<option value = "-1">Select Subject</option>
								<?php
									$q3 = mysql_query("select * from subjects order by subject_name asc;");
									if(mysql_num_rows($q3)>0)
									{
										while($r3 = mysql_fetch_array($q3))
										{
											$subject_id = $r3["subject_id"];
                                            $subject_name = $r3["subject_name"];
                                            
                                            if($subject_id == $subject_id1)
                                            {
                                                ?>
                                                    <option selected value = "<?php echo($subject_id);?>"><?php echo($subject_name);?></option>
                                                <?php
                                            }
                                            else{
                                                ?>
                                                    <option value = "<?php echo($subject_id);?>"><?php echo($subject_name);?></option>
                                                <?php
                                            }
										}
									}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td width = "50%">
							Question:
						</td>
						<td id = "subtopic_td">
                        <select name = "subtopic_id" id = "subtopic_id" style = "width:270px;">
                            <?php
                                $q3 = mysql_query("select * from subtopics where subject_id = '$subject_id1';");
                                if(mysql_num_rows($q3)>0)
                                {
                                    while($r3 = mysql_fetch_array($q3))
                                    {
                                        $subtopic_id = $r3["subtopic_id"];
                                        $subtopic_name = $r3["subtopic_name"];
                                        if($subtopic_id == $subtopic_id1)
                                        {
                                            ?>
                                                <option selected value = "<?php echo($subtopic_id);?>"><?php echo($subtopic_name);?></option>
                                            <?php
                                        }
                                        else
                                        {
                                            ?>
                                                <option value = "<?php echo($subtopic_id);?>"><?php echo($subtopic_name);?></option>
                                            <?php
                                        }
                                    }
                                }
                            ?>
                            </select>
                        </td>
                    </tr>
					<tr>
						<td width = "50%">
							Marks:
						</td>
						<td>
                            <select name = "marks" id = "marks">
                                <option value = "-1">Select Marks</option>
                                <?php
                                    $k=5;
                                    while($k<=15)
                                    {
                                        if($k == $marks1)
                                        {
                                            ?>
                                                <option selected value = "<?php echo ($k);?>"><?php echo ($k);?></option>
                                            <?php    
                                        }
                                        else
                                        {
                                            ?>
                                                <option value = "<?php echo ($k);?>"><?php echo ($k);?></option>
                                            <?php    
                                        }
                                        $k=$k+5;
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>
					<tr>
						<td width = "50%">
							Status:
						</td>
						<td>
                            <select name = "status" id = "status">
                                <?php 
                                    if($status1=="1")
                                    {
                                        ?>
                                            <option selected value = "1">Active</option>
                                            <option value = "0">InActive</option>
                                        <?php
                                    }
                                    else 
                                    {
                                        ?>
                                            <option value = "1">Active</option>
                                            <option selected value = "0">InActive</option>
                                        <?php
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>
					<tr>
						<td colspan = "2" align = "center">
							<input type = "hidden" value = "<?php echo ($question_id1);?>"  name = "question_id" id = "question_id">
							<input type = "submit" value = "Update">
						</td>
					</tr>
				</table>
			</form>
			<div>
				<?php
					include_once("listQuestion.php");
				?>
			</div>
		</div>
	</body>
</html>