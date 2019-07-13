<html>
	<head>
		<link rel="stylesheet" href="style.css">
		<script src = "main.js"></script>
		<title>Edit Subject</title>
	</head>
	<body>
		<div class = "mainDiv" align = "center">
			<?php
				include_once("header.php");
				$subject_id = $_GET["subject_id"];
				$q3 = mysql_query("select * from subjects where subject_id = '$subject_id';");
				if(mysql_num_rows($q3)>0)
				{
					$r3 = mysql_fetch_array($q3);
					$subject_name = $r3["subject_name"];
				}
			?>
			<form action = "editSubject2.php" method = "POST" onSubmit = "return val_addSubject();">
				<table cellspacing = "1px" cellpadding = "5px" border = "1px" width = "100%" class = "mainTable" align = "center">
					<tr>
						<td width = "50%">
							Subject Name:
						</td>
						<td>
							<input type = "text" value = "<?php echo($subject_name);?>"  name = "subject_name" id = "subject_name">
						</td>
					</tr>
					<tr>
						<td colspan = "2" align = "center">
							<input type = "hidden" value = "<?php echo ($subject_id);?>"  name = "subject_id" id = "subject_id">
							<input type = "submit" value = "Update">
						</td>
					</tr>
				</table>
			</form>
			<div>
				<?php
					include_once("listSubjects.php");
				?>
			</div>
		</div>
	</body>
</html>