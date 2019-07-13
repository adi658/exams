<?php
	include_once("config.php");
	$q3 = mysql_query("select * from subjects order by subject_name asc;");
	if(mysql_num_rows($q3)>0)
	{
		?>
			<table cellspacing = "1px" cellpadding = "5px" border = "1px" width = "100%" class = "mainTable" align = "center">
				<tr style = "background-color:#CBC3E8">
					<td align = "center" colspan = "5">
						<b style = 'color:#C43B05;'>Subjects List</b>
					</td>
				</tr>
				<tr style = "background-color:#CBC3E8">
					<td align = "center" width "20px">
						Sno.
					</td>
					<td align = "center" width "200px">
						SubjectName
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
						$subject_id= $r3["subject_id"];
						$subject_name= $r3["subject_name"];

						?>
							<tr>
								<td align = "center">
									<?php echo($i);?>
								</td>
								<td>
									<?php echo($subject_name);?>
								</td>
								<td align = "center">
									<a href = "editSubject.php?subject_id=<?php echo($subject_id);?>">Edit</a> |
									<a href = "editSubject2.php?subject_id=<?php echo($subject_id);?>&type=del">Delete</a>
								</td>
							</tr>
						<?php
					}
				?>
			</table>
		<?php
	}
?>