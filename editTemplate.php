<html>
	<head>
		<link rel="stylesheet" href="style.css">
		<script src = "main.js"></script>
		<title>Edit Template</title>
	</head>
	<body>
		<div class = "mainDiv" align = "center">
			<?php
				include_once("header.php");
				$template_id1 = $_GET["template_id"];
				$subject_id1 = $_GET["subject_id"];
				$q3 = mysql_query("select st.total_marks as total_marks, s.subject_id as subject_id, s.subject_name as subject_name, st.template_id as template_id, st.template_name as template_name from templates as st, subjects as s where st.subject_id = '$subject_id1' and st.template_id = '$template_id1' and st.subject_id = s.subject_id order by st.template_name, s.subject_name asc;");
				if(mysql_num_rows($q3)>0)
				{
					$r3 = mysql_fetch_array($q3);
                    $template_id= $r3["template_id"];
                    $template_name= $r3["template_name"];
                    $subject_name= $r3["subject_name"];
					$subject_id= $r3["subject_id"];
					$total_marks= $r3["total_marks"];
            }
			?>
			<form action = "editTemplate2.php" method = "POST" onSubmit = "return val_addTemplate();">
				<table cellspacing = "1px" cellpadding = "5px" border = "1px" width = "100%" class = "mainTable" align = "center">
					<tr>
						<td width = "50%">
							Template Name:
						</td>
						<td>
							<input type = "text" value = "<?php echo($template_name);?>"  name = "template_name" id = "template_name">
						</td>
					</tr>
					<tr>
						<td width = "50%">
							Subject Name:
						</td>
						<td>
							<select name = "subject_id" id = "subject_id">
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
                                            else 
                                            {
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
							Total Marks:
						</td>
						<td>
							<input type = "text" value = "<?php echo($total_marks);?>"  name = "total_marks" id = "total_marks">
						</td>
					</tr>
					<tr>
						<td colspan = "2" align = "center">
							<input type = "hidden" value = "<?php echo ($template_id);?>"  name = "template_id" id = "template_id">
							<input type = "submit" value = "Update">
						</td>
					</tr>
				</table>
			</form>
			<div>
				<?php
					include_once("listTemplate.php");
				?>
			</div>
		</div>
	</body>
</html>