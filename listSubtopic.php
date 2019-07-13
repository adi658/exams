<?php
	include_once("config.php");
	$q3 = mysql_query("select s.subject_id as subject_id, s.subject_name as subject_name, st.subtopic_id as subtopic_id, st.subtopic_name as subtopic_name from subtopics as st, subjects as s where st.subject_id = s.subject_id order by st.subtopic_name, s.subject_name asc;");
	if(mysql_num_rows($q3)>0)
	{
		?>
			<table cellspacing = "1px" cellpadding = "5px" border = "1px" width = "100%" class = "mainTable" align = "center">
				<tr style = "background-color:#CBC3E8">
					<td align = "center" colspan = "5">
						<b style = 'color:#C43B05;'>Subtopic List</b>
					</td>
				</tr>
				<tr style = "background-color:#CBC3E8">
					<td align = "center" width "20px">
						Sno.
					</td>
					<td align = "center" width "200px">
						Subtopic Name
					</td>
					<td align = "center" width "200px">
						Subject Name
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
						$subtopic_id= $r3["subtopic_id"];
						$subtopic_name= $r3["subtopic_name"];
						$subject_name= $r3["subject_name"];
						$subject_id= $r3["subject_id"];

						?>
							<tr>
								<td align = "center">
									<?php echo($i);?>
								</td>
								<td align = "center">
                                    <?php echo($subtopic_name);?>
								</td>
								<td>
                                    <?php echo($subject_name);?>
								</td>
								<td align = "center">
									<a href = "editSubtopic.php?subtopic_id=<?php echo($subtopic_id);?>&subject_id=<?php echo($subject_id);?>">Edit</a> |
									<a href = "editSubtopic2.php?subtopic_id=<?php echo($subtopic_id);?>&subject_id=<?php echo($subject_id);?>&type=del">Delete</a>
								</td>
							</tr>
						<?php
					}
				?>
			</table>
		<?php
	}
?>