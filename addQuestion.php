<html>
	<head>
		<link rel="stylesheet" href="style.css">
		<script src = "main.js"></script>
		<title>Add Question</title>
	</head>
	<body>
		<div class = "mainDiv" align = "center">
			<?php
				include_once("header.php");
			?>
			<form action = "addQuestion2.php" method = "POST" onSubmit = "return val_addQuestion();">
				<table cellspacing = "1px" cellpadding = "5px" border = "1px" width = "100%" class = "mainTable" align = "center">
					<tr>
						<td width = "50%">
							Question Name:
						</td>
						<td>
							<textarea name = "question" id = "question" rows="4" cols = "30"></textarea>
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
											?>
												<option value = "<?php echo($subject_id);?>"><?php echo($subject_name);?></option>
											<?php
										}
									}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td width = "50%">
							Subtopic Name:
						</td>
						<td id = "subtopic_td">
                            <select name = "subtopic_id" id = "subtopic_id">
                                <option value = "-1">Select Subtopic</option>
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
                                <option value = "5">5</option>
                                <option value = "10">10</option>
                                <option value = "10">15</option>
                            </select>
                        </td>
                    </tr>
					<tr>
						<td width = "50%">
							Status:
						</td>
						<td>
                            <select name = "status" id = "status">
                                <option value = "1">Active</option>
                                <option value = "0">InActive</option>
                            </select>
                        </td>
                    </tr>
					<tr>
						<td colspan = "2" align = "center">
							<input type = "submit" value = "Add">
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