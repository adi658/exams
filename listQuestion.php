<?php
	include_once("config.php");
    $q3 = mysql_query("select q.marks as marks, q.status as status, s.subject_id as subject_id, s.subject_name as subject_name, st.subtopic_id as subtopic_id, st.subtopic_name as subtopic_name, q.question_id as question_id, q.question as question from subtopics as st, subjects as s, questions as q where st.subject_id = s.subject_id and st.subtopic_id = q.subtopic_id order by s.subject_name, q.question,  st.subtopic_name asc;");
	if(mysql_num_rows($q3)>0)
	{
		?>
			<table cellspacing = "1px" cellpadding = "5px" border = "1px" width = "100%" class = "mainTable" align = "center">
				<tr style = "background-color:#CBC3E8">
					<td align = "center" colspan = "7">
						<b style = 'color:#C43B05;'>Question List</b>
					</td>
				</tr>
				<tr style = "background-color:#CBC3E8">
					<td align = "center" width "20px">
						Sno.
					</td>
					<td align = "center" width "200px">
						Question Name
					</td>
					<td align = "center" width "100px">
						Subtopic Name
					</td>
					<td align = "center" width "100px">
						Subject Name
					</td>
					<td align = "center" width "50px">
						Marks
					</td>
					<td align = "center" width "100px">
						Status
					</td>
					<td align = "center" width "100px">
						Action
					</td>
				</tr>
				<?php
					$i=0;
					while($r3 = mysql_fetch_array($q3))
					{
						$i++;
						$question_id= $r3["question_id"];
                        $question= $r3["question"];
                        $subtopic_name=$r3["subtopic_name"];
						$subject_name= $r3["subject_name"];
						$marks= $r3["marks"];
						$status= $r3["status"];

						?>
							<tr>
								<td align = "center">
									<?php echo($i);?>
								</td>
								<td align = "left">
                                    <?php echo($question);?>
								</td>
								<td>
                                    <?php echo($subtopic_name);?>
								</td>
								<td>
                                    <?php echo($subject_name);?>
								</td>
								<td align = 'center'>
                                    <?php echo($marks);?>
								</td>
								<td>
                                    <?php 
                                        $statusName = "<div style = 'color:green;weight:bold;'>Active</div>";
                                        if ($status == "0")
                                        {
                                            $statusName = "<div style = 'color:red;weight:bold;'>InActive</div>";
                                        }
                                        echo $statusName;
                                    ?>
								</td>
								<td align = "center">
									<a href = "editQuestion.php?question_id=<?php echo($question_id);?>">Edit</a> |
									<a href = "editQuestion2.php?question_id=<?php echo($question_id);?>&type=del">Delete</a>
								</td>
							</tr>
						<?php
					}
				?>
			</table>
		<?php
	}
?>