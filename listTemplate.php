<?php
	include_once("config.php");
	$q3 = mysql_query("select st.status as status, st.total_marks as total_marks, s.subject_id as subject_id, s.subject_name as subject_name, st.template_id as template_id, st.template_name as template_name from Templates as st, subjects as s where st.subject_id = s.subject_id order by st.template_name, s.subject_name asc;");
	if(mysql_num_rows($q3)>0)
	{
		?>
			<table cellspacing = "1px" cellpadding = "5px" border = "1px" width = "100%" class = "mainTable" align = "center">
				<tr style = "background-color:#CBC3E8">
					<td align = "center" colspan = "6">
						<b style = 'color:#C43B05;'>Template List</b>
					</td>
				</tr>
				<tr style = "background-color:#CBC3E8">
					<td align = "center" width "20px">
						Sno.
					</td>
					<td align = "center" width "200px">
						Template Name
					</td>
					<td align = "center" width "200px">
						Subject Name
					</td>
					<td align = "center" width "200px">
						Total Marks
					</td>
					<td align = "center" width "200px">
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
						$template_id= $r3["template_id"];
						$template_name= $r3["template_name"];
						$subject_name= $r3["subject_name"];
						$subject_id= $r3["subject_id"];
						$total_marks= $r3["total_marks"];
						$template_status= $r3["status"];
						if($template_status == "1") { $template_status = "<b style = 'color:green;font-weight:bold'>Active</b>"; } else { $template_status = "<b style = 'color:red;font-weight:bold'>InActive</b>"; } 
						?>
							<tr>
								<td align = "center">
									<?php echo($i);?>
								</td>
								<td align = "left">
                                    <?php echo($template_name);?>
								</td>
								<td>
                                    <?php echo($subject_name);?>
								</td>
								<td>
                                    <?php echo($total_marks);?>
								</td>
								<td>
                                    <?php echo($template_status);?>
								</td>
								<td align = "center">
									<a href = "editTemplate.php?template_id=<?php echo($template_id);?>&subject_id=<?php echo($subject_id);?>">Edit</a> |
									<a href = "editTemplate2.php?template_id=<?php echo($template_id);?>&subject_id=<?php echo($subject_id);?>&type=del">Delete</a>
								</td>
							</tr>
						<?php
					}
				?>
			</table>
		<?php
	}
?>