<html>
	<head>
		<link rel="stylesheet" href="style.css">
		<script src = "main.js"></script>
		<title>Add Subject</title>
	</head>
	<body>
		<div class = "mainDiv" align = "center">
			<?php
				include_once("header.php");
			?>
			<form action = "addSubject2.php" method = "POST" onSubmit = "return val_addSubject();">
				<table cellspacing = "1px" cellpadding = "5px" border = "1px" width = "100%" class = "mainTable" align = "center">
					<tr>
						<td width = "50%">
							Subject Name:
						</td>
						<td>
							<input type = "text" value = ""  name = "subject_name" id = "subject_name">
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
					include_once("listSubjects.php");
				?>
			</div>
		</div>
	</body>
</html>