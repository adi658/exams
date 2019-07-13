<link rel="stylesheet" href="style.css">
<script src = "main.js"></script>
<?php
	include("config.php");
	$doOper = $_POST["doOper"];

	if($doOper == "getSubTopics")
	{
		$subject_id = $_POST["subject_id"];
		?>
			<select name = "subtopic_id" id = "subtopic_id" style = "width:270px;">
			<?php
				$q3 = mysql_query("select * from subtopics where subject_id = '$subject_id';");
				if(mysql_num_rows($q3)>0)
				{
					while($r3 = mysql_fetch_array($q3))
					{
						$subtopic_id = $r3["subtopic_id"];
						$subtopic_name = $r3["subtopic_name"];
						?>
							<option value = "<?php echo($subtopic_id);?>"><?php echo($subtopic_name);?></option>
						<?php
					}
				}
			?>
			</select>
		<?php
	}
	else if($doOper == "getTemplateDetails")
	{
		$template_id = $_POST["template_id"];
		$rowNo = $_POST["rowNo"];
		$current_records = $_POST["current_records"];
		$q3 = mysql_query("select s.subject_id as subject_id, s.subject_name as subject_name, t.template_id as template_id, t.template_name as template_name from templates as t, subjects as s where t.template_id = '$template_id' and t.subject_id = s.subject_id order by t.template_name, s.subject_name asc;");
		if(mysql_num_rows($q3)>0)
		{
			$r3 = mysql_fetch_array($q3);
			$template_id= $r3["template_id"];
			$template_name= $r3["template_name"];
			$subject_name= $r3["subject_name"];
			$subject_id= $r3["subject_id"];

			?>
				<input type = "text" value = "<?php echo ($subject_id);?>"  name = "ajax_subject_id_<?php echo ($rowNo);?>" id = "ajax_subject_id_<?php echo ($rowNo);?>">
				<input type = "text" value = "<?php echo ($subject_name);?>"  name = "ajax_subject_name_<?php echo ($rowNo);?>" id = "ajax_subject_name_<?php echo ($rowNo);?>">
			<?php
			echo $current_records;
			for($j=1;$j<=$current_records;$j++)
			{
				?><div id = "ajax_subtopic_td_<?php echo ($j);?>">
					<select name = "subtopic_id_<?php echo ($j);?>" id = "subtopic_id_<?php echo ($j);?>" style = "width:270px;">
						<?php
							$q3 = mysql_query("select * from subtopics where subject_id = '$subject_id';");
							if(mysql_num_rows($q3)>0)
							{
								while($r3 = mysql_fetch_array($q3))
								{
									$subtopic_id = $r3["subtopic_id"];
									$subtopic_name = $r3["subtopic_name"];
									?>
										<option value = "<?php echo($subtopic_id);?>"><?php echo($subtopic_name);?></option>
									<?php
								}
							}
						?>
					</select>
				</div><?php
			}
		}
	}
	else if($doOper == "addTemplateRow")
	{
		$current_records = $_POST["current_records"];
		$new_record = $current_records + 1;
		?>
			<table cellspacing = "0px" cellpadding = "0px" border = "0px" width = "100%" class = "mainTable" align = "center">
				<tr>
					<td id = "subject_td_<?php echo($new_record);?>" width = "300px">
						<input type = "hidden" value = "" name = "subject_id_<?php echo($new_record);?>" id = "subject_id_<?php echo($new_record);?>" readonly> 
						<input type = "text" value = "" name = "subject_name_<?php echo($new_record);?>" id = "subject_name_<?php echo($new_record);?>" readonly> 
					</td>
					<td id = "subtopic_td_<?php echo($new_record);?>" width = "300px">
						<select name = "subtopic_id_<?php echo($new_record);?>" id = "subtopic_id_<?php echo($new_record);?>">
							<option value = "-1">Select Subtopic</option>
						</select>
					</td>
					<td width = "300px">
						<select name = "marks_<?php echo($new_record);?>" id = "marks_<?php echo($new_record);?>" >
							<option value = "-1">Select Marks</option>
							<option value = "5">5</option>
							<option value = "10">10</option>
							<option value = "10">15</option>
						</select>
					</td>
					<td width = "300px">
						<select name = "count_<?php echo($new_record);?>" id = "count_<?php echo($new_record);?>">
							<?php
								for($i=1;$i<=10;$i++)
								{
									?>
											<option value = "<?php echo($i);?>"><?php echo($i);?></option>
									<?php
								}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan = "4" id = "table_<?php echo($new_record+1);?>"></td>
				</tr>
			</table>
		<?php
	}
	else if($doOper == "getCurrentTemplateValues")
	{
		$template_id = $_POST["template_id"];
		$q3 = mysql_query("select tq.template_qn_id as template_qn_id, t.status as template_status, s.subject_name as subject_name, st.subtopic_name as subtopic_name, t.template_name as template_name, 
							tq.marks as marks, tq.count as count, t.total_marks as total_marks 
							from templates as t, subjects as s, subtopics as st, template_question as tq
							where tq.template_id = t.template_id and tq.subtopic_id = st.subtopic_id and st.subject_id = s.subject_id
							and t.template_id = '$template_id' order by st.subtopic_name, tq.marks, tq.count asc;");
		if(mysql_num_rows($q3)>0)
		{
			$template_total_marks = 0;
			?>
				<table cellspacing = "0px" cellpadding = "0px" border = "0px" width = "100%" class = "mainTable" align = "center">
					<?php
						$ct = 0;
						while($r3 = mysql_fetch_array($q3))
						{
							$ct++;
							$autoId = $r3["template_qn_id"];
							$subject_name= $r3["subject_name"];
							$subtopic_name= $r3["subtopic_name"];
							$template_name= $r3["template_name"];
							$marks= $r3["marks"];
							$count= $r3["count"];
							$total_marks = $r3["total_marks"];
							$template_status = $r3["template_status"];
							if($template_status == "1") { $template_status = "<b style = 'color:green;font-weight:bold'>Status: Active</b>"; } else { $template_status = "<b style = 'color:red;font-weight:bold'>Status: InActive</b>"; } 
							$template_total_marks = $template_total_marks + ($marks*$count);
				
							if($ct==1)
							{
								?>
									<tr>
										<td width = "300px" style = "padding:5px;font-weight:bold;" colspan = "4">
											<?php echo("Template Name: ".$template_name);?>
										</td>
									</tr>
									<tr>
										<td width = "300px" style = "padding:5px;font-weight:bold;">
											Subject Name
										</td>
										<td width = "300px" style = "padding:5px;font-weight:bold;">
											Subtopic Name
										</td>
										<td width = "300px" style = "padding:5px;font-weight:bold;">
											Marks
										</td>
										<td width = "300px" style = "padding:5px;font-weight:bold;">
											Count
										</td>
										<td width = "300px" style = "padding:5px;font-weight:bold;">
											Delete Entry
										</td>
									</tr>
								<?php	
							}
							?>
								<tr>
									<td width = "300px" style = "padding:5px;font-weight:bold;">
										<?php echo($subject_name);?>
									</td>
									<td width = "300px" style = "padding:5px;font-weight:bold;">
										<?php echo($subtopic_name);?>
									</td>
									<td width = "300px" style = "padding:5px;font-weight:bold;">
										<?php echo($marks);?>
									</td>
									<td width = "300px" style = "padding:5px;font-weight:bold;">
										<?php echo($count);?>
									</td>
									<td width = "300px" style = "padding:5px;font-weight:bold;">
										<input type = "button" value = "X" onClick = "deleteTemplateEntry('<?php echo($autoId);?>');">
									</td>
								</tr>				
							<?php	
						}
					?>
					<tr>
						<td colspan = "5" style = "padding:5px;font-weight:bold;">
							<?php echo ("Template Total Marks Added: ".$template_total_marks."/".$total_marks);?> | <?php echo($template_status);?>
						</td>
					</tr>
					<tr>
						<td colspan = "5" style = "padding:5px;font-weight:bold;text-align:center" align = "center">
							<input type = "button" value = "Confirm Template" onClick = "confirmTemplate('<?php echo($template_total_marks);?>','<?php echo($total_marks);?>')">
						</td>
					</tr>
				</table>
			<?php
		}
		else{
			echo "<b>No template built yet</b><br>";
		}
	}
	else if($doOper == "confirmTemplate")
	{
		$template_id = $_POST["template_id"];
		$q3 = mysql_query("update templates set status = '1' where template_id = '$template_id'");
		if($q3)
		{
			?><div id = 'MsgDiv'>Template confirmed successfully</div><?php
		}
		else
		{
			?><div id = 'MsgDiv'>Error occured <?php mysql_error();?></div><?php
		}
	}
	else if ($doOper == "deleteTemplateEntry")
	{
		$autoId = $_POST["autoId"];
		$template_id = $_POST["template_id"];
		$q3 = mysql_query("delete from template_question where template_qn_id = '$autoId'");
		if($q3)
		{
			?><div id = 'MsgDiv'>Entry Deleted Successfully</div><?php
			$q4 = mysql_query("update templates set status = '0' where template_id = '$template_id'");
		}
		else
		{
			?><div id = 'MsgDiv'>Error occured <?php mysql_error();?></div><?php
		}
	}
	?>