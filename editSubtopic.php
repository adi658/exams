<html>
	<head>
		<link rel="stylesheet" href="style.css">
		<script src = "main.js"></script>
		<title>Edit Subtopic</title>
	</head>
	<body>
		<div class = "mainDiv" align = "center">
			<?php
				include_once("header.php");
				$subtopic_id1 = $_GET["subtopic_id"];
				$subject_id1 = $_GET["subject_id"];
				$q3 = mysql_query("select s.subject_id as subject_id, s.subject_name as subject_name, st.subtopic_id as subtopic_id, st.subtopic_name as subtopic_name from subtopics as st, subjects as s where st.subject_id = '$subject_id1' and st.subtopic_id = '$subtopic_id1' and st.subject_id = s.subject_id order by st.subtopic_name, s.subject_name asc;");
				if(mysql_num_rows($q3)>0)
				{
					$r3 = mysql_fetch_array($q3);
                    $subtopic_id= $r3["subtopic_id"];
                    $subtopic_name= $r3["subtopic_name"];
                    $subject_name= $r3["subject_name"];
                    $subject_id= $r3["subject_id"];
            }
			?>
			<form action = "editSubtopic2.php" method = "POST" onSubmit = "return val_addsubtopic();">
				<table cellspacing = "1px" cellpadding = "5px" border = "1px" width = "100%" class = "mainTable" align = "center">
					<tr>
						<td width = "50%">
							Subtopic Name:
						</td>
						<td>
							<input type = "text" value = "<?php echo($subtopic_name);?>"  name = "subtopic_name" id = "subtopic_name">
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
						<td colspan = "2" align = "center">
							<input type = "hidden" value = "<?php echo ($subtopic_id);?>"  name = "subtopic_id" id = "subtopic_id">
							<input type = "submit" value = "Update">
						</td>
					</tr>
				</table>
			</form>
			<div>
				<?php
					include_once("listSubtopic.php");
				?>
			</div>
		</div>
	</body>
</html>