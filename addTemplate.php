<html>
	<head>
		<link rel="stylesheet" href="style.css">
		<script src = "main.js"></script>
		<title>Add Template</title>
	</head>
	<body>
		<div class = "mainDiv" align = "center">
			<?php
				include_once("header.php");
			?>
			<form action = "addTemplate2.php" method = "POST" onSubmit = "return val_addTemplate();">
				<table cellspacing = "1px" cellpadding = "5px" border = "1px" width = "100%" class = "mainTable" align = "center">
					<tr>
						<td width = "50%">
							Template Name:
						</td>
						<td>
							<input type = "text" value = ""  name = "template_name" id = "template_name">
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
							Total Marks:
						</td>
						<td>
							<input type = "text" value = ""  name = "total_marks" id = "total_marks">
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
					include_once("listTemplate.php");
				?>
			</div>
		</div>
	</body>
</html>