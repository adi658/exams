<html>
	<head>
		<link rel="stylesheet" href="style.css">
		<script src = "main.js"></script>
		<title>Add Subtopic</title>
	</head>
	<body>
		<div class = "mainDiv" align = "center">
			<?php
				include_once("header.php");
			?>
			<form action = "generatePaper2.php" method = "POST" onSubmit = "return val_addSubtopic();">
				<table cellspacing = "1px" cellpadding = "5px" border = "1px" width = "100%" class = "mainTable" align = "center">
					<tr>
						<td width = "50%">
							Paper Name:
						</td>
						<td>
							<input type = "text" value = ""  name = "paper_name" id = "paper_name">
						</td>
					</tr>
					<tr>
						<td width = "50%">
							Month Year:
						</td>
						<td>
							<select name = "month" id = "month">
								<?php
									for($i=1;$i<=12;$i++)
									{
										?><option value = "<?php echo($i);?>"><?php echo($i);?></option><?php
									}
								?>
							</select>
							<select name = "year" id = "year">
								<?php
									for($i=2019;$i<=2030;$i++)
									{
										?><option value = "<?php echo($i);?>"><?php echo($i);?></option><?php
									}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td width = "50%">
							Template Name:
						</td>
						<td>
							<select name = "template_id" id = "template_id">
								<option value = "-1">Select Template</option>
								<?php
									$q3 = mysql_query("select * from templates where status = '1' order by template_name asc;");
									if(mysql_num_rows($q3)>0)
									{
										while($r3 = mysql_fetch_array($q3))
										{
											$template_id = $r3["template_id"];
											$template_name = $r3["template_name"];
											?>
												<option value = "<?php echo($template_id);?>"><?php echo($template_name);?></option>
											<?php
										}
									}
								?>
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
					include_once("listPapers.php");
				?>
			</div>
		</div>
	</body>
</html>